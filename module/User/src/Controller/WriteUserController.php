<?php
/**
 * stockfoto-nik cms
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Service\UserWriteManagerInterface;
use User\Entity\User;

/**
 * WriteUserController
 *
 * @package User
 * @subpackage User\Controller
 */
class WriteUserController extends AbstractActionController
{
    /**
     * @var UserWriteManagerInterface
     */
    private $manager;
    
    /**
     * Constructor.
     * 
     * @param UserWriteManagerInterface $manager
     * 
     *
     */ 
    public function __construct(UserWriteManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * This action will display a page allowing to create a new user.
     * 
     * @return ViewModel
     */
    public function addAction()
    {
        $form = $this->manager->getAddForm();
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            $form->setData($data);
            // Validate form
            if($form->isValid()) {
                if ($this->manager->addUser($form)) {
                    $this->flashmessenger()
                        ->addSuccessMessage('user_add_was_successful');
                    
                    return $this->redirect()
                        ->toRoute('read-users', ['locale' => $this->params()->fromRoute('locale')]);
                }
            }
        }
        
        return new ViewModel(['form' => $form,]);
    }
    
    /**
     * This action will display a page for updating an existing user.
     * 
     * @return ViewModel
     */
    public function editAction() 
    {
        $id = $this->params()->fromRoute('id');
        $user = $this->manager->getRepository()->find($id);
        
        if (!$user | !$user instanceof User ) {
            $locale = $this->params()->fromRoute('locale');
            
            return $this->redirect()
                ->toRoute('read-users', ['locale' => $locale]);
        }
        $form = $this->manager->getEditForm();
        // Fill in the form with user data
        $data = $user->getArrayCopy();
        // Override roles
        $data['roles'] = $this->manager->getRepository()->getRoleIds($user);
        $form->setData($data);
        if ($this->getRequest()->isPost()) {
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            $form->setData($data);
            // Validate form
            if($form->isValid()) {
                $affectedRows = $this->manager->editUser($form, $user);
                if ( 1 === $affectedRows) {
                    $this->flashmessenger()
                        ->addSuccessMessage('user_edit_was_successful');
                } elseif (0 === $affectedRows) {
                    $this->flashmessenger()
                        ->addWarningMessage('user_edit_no_changes');
                }
                $params = [
                    'locale' => $this->params()->fromRoute('locale'),
                    'id'     => $user->getId(),
                ];
                
                return $this->redirect()->toRoute('read-user', $params);
            }
        }
        
        return new ViewModel(['user' => $user, 'form' => $form,]);
    }
    
    /**
     * This action displays a page where users can change their own password.
     */
    public function changePasswordAction() 
    {
        $locale = $this->params()->fromRoute('locale');
        if (!$this->identity()) {
            return $this->redirect()
                ->toRoute('login-user', ['locale' => $locale,]);
        }
        
        $user = $this->manager->getRepository()->findByEmail($this->identity());
        
        if (!$user instanceof User) {
            $locale = $this->params()->fromRoute('locale');
            
            return $this->redirect()
                ->toRoute('logout-user', ['locale' => $locale]);
        }
        
        $form = $this->manager->getPasswordChangeForm();
        if ($this->getRequest()->isPost()) {
            $form->setData($this->params()->fromPost());
            if($form->isValid()) {
                if (1 === $this->manager->changePassword($form, $user)) {
                    $this->flashMessenger()
                        ->addSuccessMessage('user_change_password_was_successful');
                } else {
                    $this->flashMessenger()
                        ->addErrorMessage('user_change_password_no_changes');
                }
                
                return $this->redirect()
                    ->toRoute('user-account', ['locale' => $locale,]);
            }
        }
        
        return new ViewModel(['form' => $form,]);
    }
    
    /**
     * This action displays a page allowing to reset user's password.
     */
    public function resetPasswordAction()
    {
        $form = $this->manager->getPasswordResetForm();
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            // Fill in the form with POST data
            $form->setData($this->params()->fromPost());
            // Validate form
            if($form->isValid()) {              
                if ($this->manager->generatePwdResetToken($form)) {
                    $this->flashmessenger()
                        ->addSuccessMessage('user_reset_password_was_successful');
                } else {
                    $this->flashMessenger()
                        ->addErrorMessage('user_reset_password_problem');
                }
                
                return $this->redirect()
                    ->toRoute('home', ['locale' => $this->params()->fromRoute('locale')]);
            }
        }
        
        return new ViewModel(['form' => $form,]); 
    }
    
    /**
     * This action displays a page allowing to set user's new password.
     */
    public function setPasswordAction()
    {
        $locale = $this->params()->fromRoute('locale');
        $token = $this->params()->fromRoute('token');
        $user = $this->manager->getRepository()->findByPwdResetToken($token);
        if (!$user instanceof User) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $tokenCreatedOn = $user->getPwdResetTokenCreatedOn();
        // lifetime token 12h
        $before12Hours = date('Y-m-d H:i:s', strtotime('-12 hour'));
        // check if token expire
        if (strtotime($tokenCreatedOn) < strtotime($before12Hours)) {
            $this->flashMessenger()
                ->addErrorMessage('user_set_password_token_expire');
            
            return $this->redirect()
                ->toRoute('reset-password', ['locale' => $locale]);
        }
        $form = $this->manager->getPasswordSetForm();
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            // Fill in the form with POST data
            $form->setData($this->params()->fromPost());
            // Validate form
            if($form->isValid()) {    
                if ($this->manager->setPassword($user, $form)) {
                    $this->flashmessenger()
                        ->addSuccessMessage('user_set_password_was_successful');
                    
                    return $this->redirect()
                        ->toRoute('login-user', ['locale' => $locale]);
                }
            }
        }
        
        return new ViewModel(['user' => $user, 'form' => $form]); 
    }
}
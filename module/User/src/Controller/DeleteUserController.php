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
use User\Service\UserDeleteManagerInterface;
use User\Entity\User;
use Zend\View\Model\ViewModel;

/**
 * DeletUserController
 *
 * @package User
 * @subpackage User\Controller
 */
class DeleteUserController extends AbstractActionController
{
    /**
     * @var UserDeleteManagerInterface
     */
    private $manager;
    
    /**
     * Constructor.
     * 
     * @param UserDeleteManagerInterface $manager
     * 
     *
     */ 
    public function __construct(UserDeleteManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * This action will display a page allowing to delete a user account.
     * 
     * @return ViewModel
     */
    public function deleteAction()
    {
        $locale = $this->params()->fromRoute('locale');
        $id = $this->params()->fromRoute('id');
        $user = $this->manager->getRepository()->find($id);
        if (! $user instanceof User) {
                $this->flashmessenger()
                    ->addErrorMessage('user_delete_user_not_found');
           
            return $this->redirect()
                ->toRoute('read-users', ['locale' => $locale]);
        }
        $form = $this->manager->getDeleteForm();
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            if (array_key_exists('cancel', $data)) {
                $this->flashmessenger()
                    ->addSuccessMessage('user_delete_was_cancel');
                
                return $this->redirect()
                    ->toRoute('read-user', ['locale' => $locale, 'id' => $id]);
            }
            $form->setData($data);
            if($form->isValid()) {
                if ($this->manager->delete($form)) {
                    $this->flashmessenger()
                            ->addSuccessMessage('user_delete_was_successful');
                    return $this->redirect()
                        ->toRoute('read-users', ['locale' => $locale]);
                }
            }
        }
        
        return new ViewModel([
            'user' => $user,
            'form' => $form,
        ]);
    }
    
    /**
     * This action will display a page allowing to delete own user account.
     * 
     * @return ViewModel
     */
    public function deleteOwnAction()
    {
        $locale = $this->params()->fromRoute('locale');
        if (! $this->identity()) {
            
            return $this->redirect()
                ->toRoute('login-user', ['locale' => $locale,]);
        }
        $user = $this->manager->getRepository()->findByEmail($this->identity());
        if (!$user instanceof User) {
            $locale = $this->params()->fromRoute('locale');
            
            return $this->redirect()
                ->toRoute('logout-user', ['locale' => $locale]);
        }
        $form = $this->manager->getAccountDeleteForm();
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            if (array_key_exists('cancel', $data)) {
                $this->flashmessenger()
                    ->addSuccessMessage('user_delete_was_cancel');
                
                return $this->redirect()
                    ->toRoute('user-account', ['locale' => $locale]);
            }
            // Fill in the form with POST data
            $form->setData($data);
            if($form->isValid()) {
                if ($this->manager->delete($form)) {
                    $this->flashmessenger()
                        ->addSuccessMessage('user_delete_was_successful');
                    
                    return $this->redirect()
                        ->toRoute('logout-user', ['locale' => $locale]);
                } else {
                    $this->flashmessenger()
                        ->addErrorMessage('user_delete_no_successful');
                    
                    return $this->redirect()
                        ->toRoute('user-account', ['locale' => $locale]);
                }
            }
        }
            
        return new ViewModel([
            'user' => $user,
            'form' => $form,
        ]);
    }
}
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
use User\Service\RegistrationManagerInterface;
use Zend\View\Model\ViewModel;
use User\Entity\Registration;

/**
 * RegistrationController
 *
 * @package User
 * @subpackage User\Controller
 */
class RegistrationController extends AbstractActionController
{
    /**
     * @var RegistrationManagerInterface
     */
    private $manager;
    
    /**
     * Constructor.
     * 
     * @param RegistrationManagerInterface $manager
     * 
     *
     */ 
    public function __construct(RegistrationManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * This action will display a page allowing to create a user registration.
     * 
     * @return ViewModel
     */
    public function createAction()
    {
        $locale = $this->params()->fromRoute('locale');
        // Allow to registry only when user is logged out.
        if ($this->identity()) {
            return $this->redirect()->toRoute('home', ['locale' => $locale]);
        }
        $form = $this->manager->getRegistrationForm();
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            $form->setData($data);
            // Validate form
            if($form->isValid()) {
                if ($this->manager->addRegistation($form)) {
                    $this->flashmessenger()
                        ->addSuccessMessage('user_registration_was_successful'); 
                } else {
                    $this->flashmessenger()
                        ->addErrorMessage('user_registration_not_successful');
                }
                    
                return $this->redirect()->toRoute('home', ['locale' => $locale]);
            }
        }
        
        return new ViewModel([
            'form' => $form,
        ]);
    }
    
    /**
     * This action will display a page allowing to confirm the user registration.
     * 
     * @return ViewModel
     */
    public function confirmAction()
    {
        $locale = $this->params()->fromRoute('locale');
        $token = $this->params()->fromRoute('token');
        $registration = $this->manager->getRepository()->findByToken($token);
        if (! $registration instanceof Registration) {
            $this->getResponse()->setStatusCode(404);
            
            return;
        }
        $tokenCreatedOn = $registration->getCreatedOn();
        // lifetime token 12h
        $before12Hours = date('Y-m-d H:i:s', strtotime('-12 hour'));
        // check if token expire
        if (strtotime($tokenCreatedOn) < strtotime($before12Hours)) {
            $this->manager->getRepository()->delete($registration);
            $this->flashMessenger()
                ->addErrorMessage('user_registration_token_expire');
            
            return $this->redirect()
                ->toRoute('registration', ['locale' => $locale]);
        }
        $form = $this->manager->getPasswordSetFortm();
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            $form->setData($data);
            //Validate form
            if($form->isValid()) {
                if ($this->manager->confirmRegistration($registration, $form)) {
                    $this->manager->getRepository()->delete($registration);
                    $this->flashMessenger()
                        ->addSuccessMessage('user_registration_confirm_was_successful');
            
                    return $this->redirect()
                        ->toRoute('login-user', ['locale' => $locale]);
                }
            }
        }
        
        return new ViewModel(['form' => $form, ]);
    }
}
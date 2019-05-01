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
use User\Service\AuthManagerInterface;
use Zend\Http\Header\SetCookie;
use Zend\View\Model\ViewModel;

/**
 * AuthController
 *
 * @package User
 * @subpackage User\Controller
 */
class AuthController extends AbstractActionController
{
    
    /**
     * @var AuthManagerInterface $manager 
     */
    private $manager;
    
    /**
     * Constructor.
     * 
     * @param AuthManagerInterface $manager
     */
    public function __construct( $manager )
    {
        $this->manager = $manager;
    }

    /**
     * Authenticates user given email address and password credentials.
     */
    public function loginAction()
    {
        // Allow to login only when user is logged out.
        if ($this->identity()) {
            return $this->redirect()
                ->toRoute('home', ['locale' => $this->params()->fromRoute('locale')]);
        }
        $loginForm = $this->manager->getLoginForm();
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            
            $loginForm->setData($data);
            // Validate form
            if($loginForm->isValid()) {
                // Get filtered and validated data
                $cleanData = $loginForm->getData();
                $email = $cleanData['email'];
                $password = $cleanData['password'];
                $rememberMe = intval($cleanData['remember_me']);
                $loginData = $this->manager
                    ->login($email, $password, $rememberMe);
                if (isset($loginData['code']) && 0 <= $loginData['code']) {
                    $flash = $this->flashmessenger();
                    if (0 === $loginData['code']) {
                        // 'User is blocked.'
                        $flash->addErrorMessage('user_account_was_blocked');
                    }
                    if (1 === $loginData['code']) {     
                        if ($rememberMe) {                                 
                            $this->getResponse()->getHeaders()
                                ->addHeader($loginData['identifier']);                                                        
                            $this->getResponse()->getHeaders()
                                ->addHeader($loginData['securitytoken']);                        
                        }
                        $flash->addSuccessMessage('user_sing_in_was_successful');
                    }
                    if(isset($this->manager->getLastURLSessionContainer()->lastURL)) {
                        
                        return $this->redirect()
                            ->toUrl($this->manager->getLastURLSessionContainer()->lastURL);
                    } else {

                        return $this->redirect()
                                ->toRoute('home', ['locale' => $this->params()->fromRoute('locale')]);
                    }
                }
            }
        }
                
        return new ViewModel(['form' => $loginForm,]);
    }
    
    /**
     * The "logout" action performs logout operation.
     */
    public function logoutAction()
    {
        $this->manager->logout();
        // Remove security cookies
        $cookieIdentifier = new SetCookie('identifier', '', time()-(3600*24*365), '/');
        $this->getResponse()->getHeaders()->addHeader($cookieIdentifier);                            
        $cookieToken = new SetCookie('securitytoken', '', time()-(3600*24*365), '/');
        $this->getResponse()->getHeaders()->addHeader($cookieToken);
        
        return $this->redirect()
            ->toRoute('home', ['locale' => $this->params()->fromRoute('locale')]); 
    }
    
    /**
     * This action will display a web page not authorized.
     * 
     * @return ViewModel
     */
    public function notAuthorizedAction()
    {
        return new ViewModel();
    }
}
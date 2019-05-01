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

namespace User\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;
use User\Entity\Securitytoken;
use User\Service\RbacManagerInterface;
use Zend\Authentication\AuthenticationServiceInterface;
use User\Service\AuthManagerInterface;
use Zend\Http\Header\SetCookie;
use User\Controller\AuthController;
use User\Controller\RegistrationController;

/**
 * User listener
 * 
 * @package User
 * @subpackage User\Listener
 */
class UserListener extends AbstractListenerAggregate
{
    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events, $priority = -100)
    {
        
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH, 
            [$this, 'setupRememberMe'],
            $priority
        );
        
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH, 
            [$this, 'setupLogg'],
            $priority
        );
        
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH, 
            [$this, 'setupAccess'],
            $priority
        );  
    }
    
    /**
     * Setup access
     *
     * @param  MvcEvent $e
     * @return void
     */
    public function setupAccess(EventInterface $e)
    {
        $serviceManager = $e->getApplication()->getServiceManager();
        $permission = $e->getRouteMatch()->getMatchedRouteName();
        $rbacManager = $serviceManager->get(RbacManagerInterface::class);
        $identity = $serviceManager->get(AuthenticationServiceInterface::class)
            ->getIdentity();
        $result = $rbacManager->isGranted($identity, $permission);
        if (! $result) {
            $controller = $e->getTarget();
            // Redirect the user to the not authorized page.
            $locale = $e->getRouteMatch()->getParam('locale');
            
            return $controller->redirect()
                ->toRoute('not-authorized', [$locale,]);
        }
    }
    
    /**
     * Setup logg set redirect URL to session
     *
     * @param  MvcEvent $e
     * @return void
     */
    public function setupLogg(EventInterface $e)
    {
        $controllerName = $e->getRouteMatch()->getParam('controller', null);
        if ((AuthController::class != $controllerName)
            || (RegistrationController::class != $controllerName)
        ) {
            // Retrieve an instance of the session manager
            // from the service manager.
            $serviceManager = $e->getApplication()->getServiceManager();
            $lastURLSessionContainer = $serviceManager
                ->get('lastURLSessionContainer');                        
            $lastURL = $e->getApplication()->getRequest()->getUri();
            // Make the URL string (remove user info and port)
            $lastURL->setPort(null)->setUserInfo(null);
            $redirectUrl = $lastURL->toString();
            // If you have the session container, you can store
            // the redirectUrl there.
            $lastURLSessionContainer->lastURL = $redirectUrl;
        }
    }
    
    /**
     * Setup remember me
     *
     * @param  MvcEvent $e
     * @return void
     */
    public function setupRememberMe(EventInterface $e)
    {
        $serviceManager = $e->getApplication()->getServiceManager();
        $authService = $serviceManager
            ->get(AuthenticationServiceInterface::class);
        $checkIdentity = $authService->hasIdentity();
        $controller = $e->getTarget();
        // Zend\Http\Header\Cookie
        $cookie = $controller->getRequest()->getCookie();
        if ((! $checkIdentity && isset($cookie->identifier))
            && (isset($cookie->securitytoken))
        ) {
            $authManager = $serviceManager->get(AuthManagerInterface::class);    
            $securitytoken = $authManager->getRepository()
                ->findByIdentifier($cookie->identifier);
            if (! $securitytoken instanceof Securitytoken) {
                
                return;
            }            
            if (sha1($cookie->securitytoken) != $securitytoken->getToken()) {
                
                return;
            } else {
                $authAdapter = $authService->getAdapter();
                $authAdapter->setEmail($securitytoken->getIdentity());
                $authAdapter->setToken($securitytoken->getToken());
                $result = $authService->authenticate();
                if (1 === $result->getCode()) {
                    // update securitytoken in db and set new cookies
                    $randomString = Securitytoken::randomString();                
                    $securitytoken->setToken($randomString);
                    $authManager->getRepository()->update($securitytoken);                
                    $cookieToken = new SetCookie(
                        'securitytoken', $randomString, time()+(3600*24*365), '/'
                    );
                    $controller->getResponse()->getHeaders()
                        ->addHeader($cookieToken);
                    $cookieIdentifier = new SetCookie(
                        'identifier', $securitytoken->getIdentifier(),
                        time()+(3600*24*365), '/'
                    );
                    $controller->getResponse()->getHeaders()
                        ->addHeader($cookieIdentifier);
                } else {
                    // delete securitytoken and remove cookies
                    $authManager->getRepository()->delete($securitytoken);
                    $cookieToken = new SetCookie(
                        'securitytoken', $randomString, time()-(3600*24*365), '/'
                    );
                    $controller->getResponse()->getHeaders()->addHeader($cookieToken);
                    $cookieIdentifier = new SetCookie(
                        'identifier', '', time()-(3600*24*365), '/'
                    );
                    $controller->getResponse()->getHeaders()
                        ->addHeader($cookieIdentifier);
                }
            // Redirect the same page and use identity.
            $locale = $e->getRouteMatch()->getParam('locale');
            $routeName = $e->getRouteMatch()->getMatchedRouteName();
                          
            return $controller->redirect()->toRoute($routeName, [$locale,]);   
            }
        } 
    }
}
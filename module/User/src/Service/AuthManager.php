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

namespace User\Service;

use User\Form\LoginForm;
use User\Repository\SecuritytokenInterface;
use Zend\Http\Header\SetCookie;
use User\Entity\Securitytoken;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Session\Container;

/**
 * AuthManager
 *
 * @package User
 * @subpackage User\Service
 */
class AuthManager implements AuthManagerInterface
{
    /**
     * Login form
     *
     * @var LoginForm 
     */
    private $loginForm;
    
    /**
     * @var AuthenticationServiceInterface
     */
    private $authService;
    
    /**
     * @var SecuritytokenInterface
     */
    private $repository;
    
    /**
     *
     * @var Container
     */
    private $lastURLSessionContainer;

    /**
     * Constructs the service.
     * 
     * @param LoginForm $loginForm
     * @param AuthenticationServiceInterface $authService
     * @param SecuritytokenInterface $repository
     * @param Container $lastURLSessionContainer
     */
    public function __construct(
        LoginForm $loginForm,
        AuthenticationServiceInterface $authService,
        SecuritytokenInterface $repository,
        Container $lastURLSessionContainer
    ) {
        $this->loginForm = $loginForm;
        $this->authService = $authService;
        $this->repository = $repository;
        $this->lastURLSessionContainer = $lastURLSessionContainer;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLoginForm()
    {
        return $this->loginForm;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getAuthService()
    {
        return $this->authService;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getRepository()
    {
        return $this->repository;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLastURLSessionContainer()
    {
        return $this->lastURLSessionContainer;
    }

    /**
     * {@inheritDoc}
     */
    public function login($email, $password, $rememberMe = 0)
    {
            $data = [];
        // Allow login only if the user is not logged in.
        if ($this->authService->getIdentity() == null) {
            // Authenticate with email/password.
            $authAdapter = $this->authService->getAdapter();
            $authAdapter->setEmail($email);
            $authAdapter->setPassword($password);
            // \Zend\Authentication\Result
            $result = $this->authService->authenticate();
            $resultCode = $result->getCode();
            $data['code'] = $resultCode;
            if (1 === $resultCode) {
                // Delete token in db
                $securitytoken = $this->repository->findByIdentity($email);
                if ($securitytoken instanceof Securitytoken) {
                    $this->repository->delete($securitytoken); 
                }
            }
            if ($rememberMe && 1 === $resultCode) {
                // Insert securitytoken to db
                $securitytoken = new Securitytoken(
                    $email, null, null, date('Y-m-d H:i:s')
                );
                $securitytoken->setIdentifier();
                $randomString = Securitytoken::randomString();
                $securitytoken->setToken($randomString);
                $this->repository->insert($securitytoken);
                $cookieIdentifier = new SetCookie(
                    'identifier', $securitytoken->getIdentifier(),
                    time()+(3600*24*365), '/'
                );
                $data['identifier'] = $cookieIdentifier;
                $cookieToken = new SetCookie(
                    'securitytoken', $randomString, time()+(3600*24*365), '/'
                );
                $data['securitytoken'] = $cookieToken;
            }
        }
        
        return $data;
    }

    /**
     * {@inheritDoc}
     */
    public function logout()
    {
        $identity = $this->authService->getIdentity();
        // Allow to log out only when user is logged in.
        if ($identity != null) {
            // Delete securitytoken from db
            $securitytoken = $this->repository->findByIdentity($identity);
            if ($securitytoken instanceof Securitytoken) {
                $this->repository->delete($securitytoken);
            }
            // Remove identity from session.
            $this->authService->clearIdentity();
        }
    }
}
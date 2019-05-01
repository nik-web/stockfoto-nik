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

/**
 * AuthManagerInterface
 *
 * @package User\
 * @subpackage User\Service
 */
interface AuthManagerInterface
{
    /**
     * Get login form
     * 
     * @return \User\Form\LoginForm
     */
    public function getLoginForm();
    
    /**
     * Get authentication service
     * 
     * @return AuthenticationServiceInterface;
     */
    public function getAuthService();
    
    /**
     * Get securitykoken repository
     * 
     * @return \User\Repository\Securitytoken
     */
    public function getRepository();
    
    /**
     * Get last URL session container
     * 
     * @return \Zend\Session\Container
     */
    public function getLastURLSessionContainer();
    
    /**
     * Executes a user login
     * 
     * @param string $email E-mail address of the user
     * @param string $password Password of the user
     * @param iteger $rememberMe
     * @return Zend\Authentication\Result $result
     */
    public function login($email, $password, $rememberMe = 0);
    
    /**
     * Performs a user logout
     */
    public function logout();
}

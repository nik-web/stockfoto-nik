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

use User\Entity\User;
use User\Service\AuthAdapterInterface;
use User\Repository\UserInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;

/**
 * Adapter used for authenticating user. It takes login and password on input
 * and checks the database if there is a user with such login (email) and password.
 * If such user exists, the service returns his identity (email). The identity
 * is saved to session and can be retrieved later with Identity view helper provided
 * by ZF3.
 * 
 * @package User
 * @subpackage User\Service
 */
class AuthAdapter implements AuthAdapterInterface
{
    /**
     * User email address.
     * 
     * @var string 
     */
    private $email = null;
    
    /**
     * User password
     * 
     * @var string 
     */
    private $password = null;
    
    /**
     * Securitytoken
     * 
     * @var string
     */
    private $token = null;


    /**
     * Repository
     * 
     * @var UserInterface
     */
    private $repository;
    
    /**
     * Constructor.
     */
    public function __construct(UserInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setEmail($email) 
    {
        $this->email = $email;        
    }
    
    /**
     * {@inheritDoc}
     */
    public function setPassword($password) 
    {
        $this->password = (string)$password;        
    }
    
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * {@inheritDoc}
     */
    public function authenticate()
    {
        // Check the database if there is a user with such email.
        $user = $this->repository->findByEmail($this->email);
        // If there is no such user, return 'Identity Not Found' status.
        if ($user === null || ! $user instanceof User) {
            return new Result(
                Result::FAILURE_IDENTITY_NOT_FOUND, 
                null, 
                ['Invalid user not found.']);        
        }   
        // If the user with such email exists, we need to check if it is active or blocked.
        // Do not allow blocked users to log in.
        if ($user->getStatus() === User::STATUS_BLOCKED) {
            return new Result(
                Result::FAILURE, 
                null, 
                ['User is blocked.']);        
        }
        if (null != $this->password) {
            // Now we need to calculate hash based on user-entered password and compare
            // it with the password hash stored in database.
            $bcrypt = new Bcrypt();
            $passwordHash = $user->getPassword();
            if ($bcrypt->verify($this->password, $passwordHash)) {
                // The password hash matches. 
                // Return user identity (email) to be saved in session for later use.
                return new Result(
                    Result::SUCCESS, 
                    $this->email,
                    ['Authenticated successfully.']);        
            }             
            // If password check didn't pass return 'Invalid Credential' failure status.
            return new Result(
                Result::FAILURE_CREDENTIAL_INVALID, 
                null, 
                ['Invalid credentials.']);
        } elseif (null != $this->token) {
            return new Result(
                Result::SUCCESS, 
                $this->email,
                ['Authenticated successfully.']);
        }
    }
}
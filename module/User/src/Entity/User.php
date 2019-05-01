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

namespace User\Entity;

/**
 * User entity
 * 
 * @package User
 * @subpackage User\Entity
 */
class User
{
   
    /**
     * User status active constants .
     */
    const STATUS_ACTIVE = 1;
    
    /**
     * User status blocked constants .
     */
    const STATUS_BLOCKED = 0;
    
    /**
     * @var integer|null Should contain a identifier
     */
    private $id = null;
    
    /**
     * @var string|null Should contain a alias
     */
    private $alias = null;
    
    /**
     * @var string|null Should contain a e-mail address
     */
    private $email = null;
    
    /**
     * @var string|null Shoud contain a passwordhash
     */
    private $password = null;
    
    /**
     * @var integer|null Should contain a status
     */
    private $status = null;

    /**
     * @var string|null Shound contain a create date-time
     */
    private $createdOn = null;
    
    /**
     * @var string|null Shound contain a update date-time
     */
    private $updatedOn = null;
    
    /**
     * @var string|null Shound contain a password reset token
     */
    private $pwdResetToken = null;
    
    /**
     * @var string|null Shound contain a password reset token create date-time
     */
    private $pwdResetTokenCreatedOn = null;
    
    /**
     *
     * @var array roles assigned to this user
     */
    private $roles = [];

    /**
     * Constructor
     * 
     * @param string $alias
     * @param string $email
     * @param string $password
     * @param integer $status
     * @param string $createdOn
     * @param string $updatedOn
     * @param string $pwdResetToken
     * @param string $pwdResetTokenCreatedOn
     * @param integer $id
     */
    public function __construct(
        $alias, $email, $password, $status, $createdOn, $updatedOn,
        $pwdResetToken, $pwdResetTokenCreatedOn, $id = null
    ){
        $this->alias = $alias;
        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
        $this->createdOn = $createdOn;
        $this->updatedOn = $updatedOn;
        $this->pwdResetToken = $pwdResetToken;
        $this->pwdResetTokenCreatedOn = $pwdResetTokenCreatedOn;
        $this->id = $id;
    }

    /**
     * Set identifier
     * 
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * Get identifier
     * 
     * @return integer|null
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set e-mail address
     * 
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    /**
     * Get e-mail address
     * 
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set alias
     * 
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }
    
    /**
     * Get alias
     * 
     * @return string|null
     */
    public function getAlias()
    {
        return $this->alias;
    }
    
    /**
     * Set passwordhash
     * 
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    /**
     * Get passwordhash
     * 
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Set status
     * 
     * @param integer $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
    
    /**
     * Get status
     * 
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }
       
    /**
     * Sets the date when this user was created.
     * 
     * @param string $date    
     */
    public function setCreatedOn($date) 
    {
        $this->createdOn = $date;
    }

    /**
     * Returns the date of user creation.
     * 
     * @return string     
     */
    public function getCreatedOn() 
    {
        return $this->createdOn;
    }
       

    /**
     * Sets the date when this user was updated.
     * 
     * @param string $date  
     */
    public function setUpdatedOn($date) 
    {
        $this->updatedOn = $date;
    }

    /**
     * Returns the date when user was updated.
     * 
     * @return string     
     */
    public function getUpdatedOn() 
    {
        return $this->updatedOn;
    }
    
    /**
     * Sets password reset token.
     * 
     * @param string $token
     */
    public function setPwdResetToken($token) 
    {
        $this->pwdResetToken = $token;
    }  
    
    /**
     * Returns password reset token.
     * 
     * @return string
     */
    public function getPwdResetToken()
    {
        return $this->pwdResetToken;
    }
    
    /**
     * Sets password reset token's creation date.
     * 
     * @param string $date
     */
    public function setPwdResetTokenCreatedOn($date) 
    {
        $this->pwdResetTokenCreatedOn = $date;
    }
    
    /**
     * Returns password reset token's creation date.
     * 
     * @return string
     */
    public function getPwdResetTokenCreatedOn()
    {
        return $this->pwdResetTokenCreatedOn;
    }
    
    /**
     * 
     * @param array $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * Get roles assigned to this user
     * 
     * @return array of \User\Entity\Role assigned to this user
     */
    public function getRoles()
    {
        return $this->roles;
    }
   
    /**
     * Exchange array
     * 
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $id = intval($data['id']);
        
        if (1 === intval ($data['status']) | 0 === intval ($data['status'])) {
            $status = intval ($data['status']);
        } else {
            $status = null;
        }
        
        $this->id = !empty($id) ? $id : null;
        $this->alias = !empty($data['alias']) ? $data['alias'] : null;
        $this->email  = !empty($data['email']) ? $data['email'] : null;
        $this->password = !empty($data['password']) ? $data['password'] : null;
        $this->status = $status;
        $this->createdOn = !empty($data['created_on']) ? $data['created_on'] : null;
        $this->updatedOn = !empty($data['updated_on']) ? $data['updated_on'] : null;
        $this->pwdResetToken = !empty($data['pwd_reset_token']) ? $data['pwd_reset_token'] : null;
        $this->pwdResetTokenCreatedOn = !empty($data['pwd_reset_token_created_on']) ? $data['pwd_reset_token_created_on'] : null;
    }
    
    /**
     * Get array copy
     * 
     * @return array
     */
    public function getArrayCopy()
    {
        return [
            'id'                         => $this->id,
            'alias'                      => $this->alias,
            'email'                      => $this->email,
            'password'                   => $this->password,
            'status'                     => $this->status,
            'created_on'                 => $this->createdOn,
            'updated_on'                 => $this->updatedOn,
            'pwd_reset_token'            => $this->pwdResetToken,
            'pwd_reset_token_created_on' => $this->pwdResetTokenCreatedOn,
            'roles'                      => $this->roles,
        ];
    }
}
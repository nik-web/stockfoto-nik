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
 * Registration entity
 * 
 * @package User
 * @subpackage User\Entity
 */
class Registration
{
   
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
     * @var string|null Shound contain a create date-time
     */
    private $createdOn = null;
    
    /**
     * @var string|null Shound contain a token
     */
    private $token = null;

    /**
     * Constructor
     * 
     * @param string $alias
     * @param string $email
     * @param string $createdOn
     * @param string $token
     * @param integer $id
     */
    public function __construct($alias, $email, $createdOn, $token, $id = null)
    {
        $this->alias = $alias;
        $this->email = $email;
        $this->createdOn = $createdOn;
        $this->token = $token;
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
     * Sets the date when this registration was created.
     * 
     * @param string $date    
     */
    public function setCreatedOn($date) 
    {
        $this->createdOn = $date;
    }

    /**
     * Returns the date of registration creation.
     * 
     * @return string|null    
     */
    public function getCreatedOn() 
    {
        return $this->createdOn;
    }
    
    /**
     * Set token.
     * 
     * @param string $token
     */
    public function setToken($token) 
    {
        $this->token = $token;
    }  
    
    /**
     * Returns token.
     * 
     * @return string|null
     */
    public function getToken()
    {
        return $this->token;
    }
    
    /**
     * Exchange array
     * 
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $id = intval($data['id']);
        
        $this->id = !empty($id) ? $id : null;
        $this->alias = !empty($data['alias']) ? $data['alias'] : null;
        $this->email  = !empty($data['email']) ? $data['email'] : null;
        $this->createdOn = !empty($data['created_on']) ? $data['created_on'] : null;
        $this->token = !empty($data['token']) ? $data['token'] : null;
    }
    
    /**
     * Get array copy
     * 
     * @return array
     */
    public function getArrayCopy()
    {
        return [
            'id'         => $this->id,
            'alias'      => $this->alias,
            'email'      => $this->email,
            'created_on' => $this->createdOn,
            'token'      => $this->token,
        ];
    }
}
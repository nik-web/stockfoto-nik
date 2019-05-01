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
 * User role entity
 * 
 * @package User
 * @subpackage User\Entity
 */
class Role
{
    /**
     * @var integer|null Should contain a identifier
     */
    protected $id = null;
    
    /**
     * @var string
     */
    protected $name = null;

    /**
     * @var string|null Should contain the description
     */
    protected $description;

    /**
     * @var string|null Shound contain a create date-time
     */
    protected $createdOn;

    /**
     * Constructor.
     * 
     * @param string $name
     * @param string $description
     * @param string $createdOn
     * @param integer $id
     */
    public function __construct($name, $description, $createdOn, $id = null) 
    {
        $this->name = $name;
        $this->description = $description;
        $this->createdOn = $createdOn;
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
     * Set name
     * 
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Get the name of the role.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set description
     * 
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    /**
     * Get description
     * 
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Set date created on
     * 
     * @param string $date
     */
    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
    }
    
    /**
     * Get date created on
     * 
     * @return string|null
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
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
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->description  = !empty($data['description']) ? $data['description'] : null;
        $this->createdOn = !empty($data['created_on']) ? $data['created_on'] : null;
    }
    
    /**
     * Get array copy
     * 
     * @return array
     */
    public function getArrayCopy()
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'created_on'  => $this->createdOn,
        ];
    }
}
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

namespace User\Form;

use Zend\Form\Form;
use User\Repository\RoleInterface;
use Zend\InputFilter\InputFilter;

/**
 * Edit Form
 * 
 * This form is used to update users.
 * 
 * @package User
 * @subpackage User\Form
 */
class UserEditForm extends Form
{
    /**
     * @var RoleInterface
     */
    private $roleRepository;

    /**
     * Constructor.
     *  
     * @param RoleInterface $roleRepository   
     */
    public function __construct(RoleInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        
        // Define form name
        parent::__construct('edit-form');
     
        // Set POST method for this form
        $this->setAttribute('method', 'post');
        
        $this->addElements();
        $this->addInputFilter();          
    }
    
    protected function getRolesValueOptions()
    {
        
        $options = [];
        // object(Zend\Db\ResultSet\ResultSet)
        $resultSet = $this->roleRepository->findAll();
        // create role value options
        foreach ($resultSet as $role) {
            $options[$role->getId()] = $role->getName();
        }
        
        return $options;
    }

    /**
     * This method adds elements to form.
     */
    protected function addElements()
    {
        // Add "status" field
        $this->add([
            'type'    => 'select',
            'name'    => 'status',
            'options' => [
                'label'         => 'user_status_label',
                'value_options' => [
                    1 => 'Aktiv',
                    0 => 'Gesperrt',
                ],
            ],
        ]);
        // Add "roles" field
        $this->add([            
            'type'  => 'select',
            'name' => 'roles',
            'attributes' => [
                'multiple' => 'multiple',
            ],
            'options' => [
                'label' => 'user_roles_label',
                'value_options' => $this->getRolesValueOptions(),
                'class_options' => 'my_class',
            ],
        ]);
        // Add the CSRF field
        $this->add([
            'type' => 'csrf',
            'name' => 'csrf',
            'options' => [
                'csrf_options' => [
                'timeout' => 600
                ]
            ],
        ]);
        // Add the Submit button
        $this->add([
            'type'       => 'submit',
            'name'       => 'submit',
            'attributes' => [                
                'value' => 'user_submit_value_save',
            ],
        ]);  
    }
    
    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter() 
    {     
        // Create main input filter
        $inputFilter = new InputFilter();
        // Add input for "status" field
        $inputFilter->add([
            'name'     => 'status',
            'required' => false,
            'filters'  => [                    
            ],                
            'validators' => [
                [
                    'name'    => 'InArray',
                    'options' => [
                        'haystack' => [1, 0],
                        'messages' => [
                            \Zend\Validator\InArray::NOT_IN_ARRAY => 'user_status_InArray::NOT_IN_ARRAY',
                        ],
                    ]
                ],
            ],
        ]);
        // Set input filter to this form       
        $this->setInputFilter($inputFilter);
    }
}
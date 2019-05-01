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
use Zend\InputFilter\InputFilter;

/**
 * PasswordResetForm
 *
 * @package User
 * @subpackage User\Form
 */
class PasswordSetForm extends Form
{
    
    /**
     * Constructor
     *   
     */
    public function __construct()
    {
        // Define form name
        parent::__construct('password-set-form');
        // Set POST method for this form
        $this->setAttribute('method', 'post');
        $this->addElements();
        $this->addInputFilter();          
    }
    
    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements() 
    {
        // Add "new_password" field
        $this->add([            
            'type'  => 'password',
            'name' => 'new_password',
            'options' => [
                'label' => 'user_new_password_label',
            ],
        ]);
        // Add "confirm_new_password" field
        $this->add([            
            'type'  => 'password',
            'name' => 'confirm_new_password',
            'options' => [
                'label' => 'user_confirm_new_password_label',
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
        // Add the submit button
        $this->add([
            'type'  => 'submit',
            'name' => 'submit',
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
        $this->setInputFilter($inputFilter);
        // Add input for "new_password" field
        $inputFilter->add([
            'name'     => 'new_password',
            'required' => true,
            'filters'  => [                    
            ],                
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'options' => [
                        'messages' => [
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'user_password_NotEmpty::IS_EMPTY',
                        ],
                    ],
                ],
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 6, // if change the number, change first \User\Form\UserAddForm
                        'max' => 64, // if change the number, change first \User\Form\UserAddForm
                        'messages' => [
                            \Zend\Validator\StringLength::TOO_SHORT => 'user_password_StringLength::TOO_SHORT',
                            \Zend\Validator\StringLength::TOO_LONG  => 'user_confirm_password_label',
                        ],
                    ],
                ],
            ],
        ]);
        // Add input for "confirm_new_password" field
        $inputFilter->add([
            'name'     => 'confirm_new_password',
            'required' => true,
            'filters'  => [                    
            ],                
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'options' => [
                        'messages' => [
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'user_confirm_password_NotEmpty::IS_EMPTY',
                        ],
                    ],
                ],
                [
                    'name'    => 'Identical',
                    'options' => [
                        'token'    => 'new_password',
                        'messages' => [
                            \Zend\Validator\Identical::NOT_SAME => 'user_confirm_password_Identical::NOT_SAME',
                        ],                            
                    ],
                ],
            ],
        ]);
    }
}

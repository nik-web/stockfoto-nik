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
 * AccountDelete Form
 * 
 * This form is used to delete the user account by the user.
 * 
 * @package User
 * @subpackage User\Form
 */
class AccountDeleteForm extends Form
{
    /**
     * Constructor.
     *     
     */
    public function __construct()
    {
        // Define form name
        parent::__construct('account-delete-form');
     
        // Set POST method for this form
        $this->setAttribute('method', 'post');
        
        $this->addElements();
        $this->addInputFilter();        
    }
    
    /**
     * This method adds elements to form.
     */
    protected function addElements()
    {
        // Add "current_password" field
        $this->add([            
            'type'  => 'password',
            'name' => 'current_password',
            'options' => [
                'label' => 'user_current_password_label',
            ],
        ]);
        // Add hidden element
        $this->add([
            'type'       => 'hidden',
            'name'       => 'hidden_id',
            'attributes' => [                
                'value' => null,
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
        // Add the Submit button for confirm
        $this->add([
            'type'       => 'submit',
            'name'       => 'confirm',
            'attributes' => [                
                'value' => 'user_submit_value_confirm',
            ],
        ]);
        // Add the Submit button for cancel
        $this->add([
            'type'       => 'submit',
            'name'       => 'cancel',
            'attributes' => [                
                'value' => 'user_submit_value_cancel',
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
        
        // Add input for "current_password" field
        $inputFilter->add([
            'name'     => 'current_password',
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
                        'min' => 6,// if change the number, change first \User\Form\UserAddForm
                        'max' => 64,// if change the number, change first \User\Form\UserAddForm
                        'messages' => [
                            \Zend\Validator\StringLength::TOO_SHORT => 'user_password_StringLength::TOO_SHORT',
                            \Zend\Validator\StringLength::TOO_LONG  => 'user_password_StringLength::TOO_LONG',
                        ],
                    ],
                ],
            ],
        ]);
    }
}
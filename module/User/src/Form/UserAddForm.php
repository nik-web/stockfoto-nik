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

use Zend\Db\Adapter\AdapterInterface; // Configuring the default adapter
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

/**
 * Add Form
 * 
 * This form is used to create users.
 * 
 * @package User
 * @subpackage User\Form
 */
class UserAddForm extends Form
{
    /**
     * @var Adapter 
     */
    private $dbAdapter;
    
    /**
     * Constructor.
     * 
     * @param AdapterInterface $dbAdapter    
     */
    public function __construct(AdapterInterface $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
        
        // Define form name
        parent::__construct('add-form');
     
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
        // Add "alias" field
        $this->add([            
            'type'    => 'text',
            'name'    => 'alias',
            'options' => [
                'label' => 'user_alias_label',
            ],
        ]);
        // Add "email" field
        $this->add([            
            'type'    => 'text',
            'name'    => 'email',
            'options' => [
                'label' => 'user_email_label',
            ],
        ]);
        // Add "password" field
        $this->add([            
            'type'    => 'password',
            'name'    => 'password',
            'options' => [
                'label' => 'user_password_label',
            ],
        ]);
        // Add "confirm_password" field
        $this->add([            
            'type'    => 'password',
            'name'    => 'confirm_password',
            'options' => [
                'label' => 'user_confirm_password_label',
            ],
        ]);        
        // Add the CSRF field
        $this->add([
            'type' => 'csrf',
            'name' => 'login_csrf',
            'options' => [
                'csrf_options' => [
                     'timeout' => 600,
                ],
            ]
        ]);
        // Add the Submit button
        $this->add([
            'type'       => 'submit',
            'name'       => 'submit',
            'attributes' => [                
                'value' => 'user_submit_value_add-user',
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
        
        // Add input for "alias" field
        $inputFilter->add(
            [
                'name'     => 'alias',
                'required' => true,
                'filters'  => [                    
                    ['name' => 'StringTrim'],
                ],                
                'validators' => [
                    [
                        'name' => 'NotEmpty',
                        'options' => [
                            'messages' => [
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'user_alias_NotEmpty::IS_EMPTY',
                            ],
                        ],
                    ],
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 3, // If the number changes, change the translation
                            'max' => 128, // If the number changes, change the translation
                            'messages' => [
                                \Zend\Validator\StringLength::TOO_SHORT => 'user_alias_StringLength::TOO_SHORT',
                                \Zend\Validator\StringLength::TOO_LONG  => 'user_alias_StringLength::TOO_LONG',
                            ],
                        ],
                    ],
                    [
                        'name' => 'DbNoRecordExists',
                        'options' => [
                            'table'   => 'registration',
                            'field'   => 'alias',
                            'adapter' => $this->dbAdapter,
                            'messages' => [
                                \Zend\Validator\Db\AbstractDb::ERROR_RECORD_FOUND => 'user_alias_Db_AbstractDb::ERROR_RECORD_FOUND',
                            ],
                        ],
                    ],
                    [
                        'name' => 'DbNoRecordExists',
                        'options' => [
                            'table'   => 'user',
                            'field'   => 'alias',
                            'adapter' => $this->dbAdapter,
                            'messages' => [
                                \Zend\Validator\Db\AbstractDb::ERROR_RECORD_FOUND => 'user_alias_Db_AbstractDb::ERROR_RECORD_FOUND',
                            ],
                        ],
                    ],
                ],
            ]
        );
        // Add input for "email" field
        $inputFilter->add([
            'name'     => 'email',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],                    
            ],                
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'options' => [
                        'messages' => [
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'user_email_NotEmpty::IS_EMPTY',
                        ],
                    ],
                ],
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min'      => 5, // If the number changes, change the translation
                        'max'      => 128, // If the number changes, change the translation
                        'messages' => [
                            \Zend\Validator\StringLength::TOO_SHORT => 'user_email_StringLength::TOO_SHORT',
                            \Zend\Validator\StringLength::TOO_LONG  => 'user_email_StringLength::TOO_LONG',
                        ],
                    ],
                ],
                [
                    'name'     => 'EmailAddress',
                    'options'  => [
                        'allow'      => \Zend\Validator\Hostname::ALLOW_DNS,
                        'useMxCheck' => false,
                        'messages'   => [
                            \Zend\Validator\EmailAddress::INVALID_FORMAT => 'user_email_EmailAddress::INVALID_FORMAT',
                        ],
                    ],
                ],
                [
                    'name' => 'DbNoRecordExists',
                    'options' => [
                        'table'   => 'registration',
                        'field'   => 'email',
                        'adapter' => $this->dbAdapter,
                            'messages' => [
                                \Zend\Validator\Db\AbstractDb::ERROR_RECORD_FOUND => 'user_email_Db_AbstractDb::ERROR_RECORD_FOUND',
                            ],
                    ],
                ],
                [
                    'name' => 'DbNoRecordExists',
                    'options' => [
                        'table'   => 'user',
                        'field'   => 'email',
                        'adapter' => $this->dbAdapter,
                            'messages' => [
                                \Zend\Validator\Db\AbstractDb::ERROR_RECORD_FOUND => 'user_email_Db_AbstractDb::ERROR_RECORD_FOUND',
                            ],
                    ],
                ],                  
            ],
        ]);
        // Add input for "password" field
        $inputFilter->add([
                'name'     => 'password',
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
                            'min' => 6, // If the number changes, change the translation
                            'max' => 64, // If the number changes, change the translation
                            'messages' => [
                                \Zend\Validator\StringLength::TOO_SHORT => 'user_password_StringLength::TOO_SHORT',
                                \Zend\Validator\StringLength::TOO_LONG  => 'user_password_StringLength::TOO_LONG',
                            ],
                        ],
                    ],
                ],
            ]);
        // Add input for "confirm_password" field
        $inputFilter->add([
            'name'     => 'confirm_password',
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
                        'token'    => 'password',
                        'messages' => [
                            \Zend\Validator\Identical::NOT_SAME => 'user_confirm_password_Identical::NOT_SAME',
                        ],                            
                    ],
                ],
            ],
        ]);
        // Set input filter to this form       
        $this->setInputFilter($inputFilter);
    }
}
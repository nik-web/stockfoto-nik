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
use Zend\Db\Adapter\AdapterInterface; // Configuring the default adapter

/**
 * PasswordResetForm
 *
 * @package User
 * @subpackage User\Form
 */
class PasswordResetForm extends Form
{
    /**
     * @var AdapterInterface 
     */
    private $dbAdapter;
    
    /**
     * Constructor
     * 
     * @param AdapterInterface $dbAdapter    
     */
    public function __construct(AdapterInterface $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
        // Define form name
        parent::__construct('password-reset-form');
     
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
        // Add "email" field
        $this->add([            
            'type'  => 'text',
            'name' => 'email',
            'options' => [
                'label' => 'user_email_label',
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
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [                
                'value' => 'user_submit_value_request',
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
                    'name' => 'EmailAddress',
                    'options' => [
                        'allow' => \Zend\Validator\Hostname::ALLOW_DNS,
                        'useMxCheck' => false,
                        'messages'   => [
                            \Zend\Validator\EmailAddress::INVALID_FORMAT => 'user_email_EmailAddress::INVALID_FORMAT',
                        ],                          
                    ],
                ],
                [
                    'name' => 'DbRecordExists',
                    'options' => [
                        'table'   => 'user',
                        'field'   => 'email',
                        'adapter' => $this->dbAdapter,
                            'messages' => [
                                \Zend\Validator\Db\AbstractDb::ERROR_NO_RECORD_FOUND => 'user_email_Db_AbstractDb::ERROR_NO_RECORD_FOUND',
                            ],
                    ],
                ],
            ],
        ]);
    }        
}

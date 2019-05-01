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

/**
 * Delete Form
 * 
 * This form is used to delete users.
 * 
 * @package User
 * @subpackage User\Form
 */
class UserDeleteForm extends Form
{
  
    /**
     * Constructor.
     *     
     */
    public function __construct()
    {
        // Define form name
        parent::__construct('delete-form');
     
        // Set POST method for this form
        $this->setAttribute('method', 'post');
        
        $this->addElements();          
    }
    
    /**
     * This method adds elements to form.
     */
    protected function addElements()
    {
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
}
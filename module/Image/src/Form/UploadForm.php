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

namespace Image\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Image\ValueObject\Data;

/**
 * UploadForm
 * 
 * This form is used for uploading an image file.
 * 
 * @package Image
 * @subpackage Image\Form
 */
class UploadForm extends Form
{

    /**
     * Constructor
     */    
    public function __construct()
    {
        // Define form name.
        parent::__construct('upload-form');
        // Set POST method for this form.
        $this->setAttribute('method', 'post');
        // Set binary content encoding.
        $this->setAttribute('enctype', 'multipart/form-data');	
        $this->addElements();
        // Add validation rules
        $this->addInputFilter();
    }
    
    /**
     * This method adds elements to form
     */
    protected function addElements() 
    {
        // Add "file" field.
        $this->add([
            'type'  => 'file',
            'name' => 'file',
            'options' => [
                'label' => 'image_file_label',
            ],
        ]);        
          
        // Add the submit button.
        $this->add([
            'type'       => 'submit',
            'name'       => 'submit',
            'attributes' => [                
                'value' => 'image_submit_value_upload',
            ],
        ]);               
    }
    
    /**
     * This method creates input filter (used for form filtering/validation)
     */
    private function addInputFilter() 
    {
        $inputFilter = new InputFilter();   
        $this->setInputFilter($inputFilter);
        // Add validation rules for the "file" field.	 
        $inputFilter->add([
            'type'     => 'Zend\InputFilter\FileInput',
            'name'     => 'file',
            'required' => true,   
            'validators' => [
                ['name'    => 'FileUploadFile'],
                [
                    'name'    => 'FileMimeType',                        
                    'options' => [                            
                        'mimeType'  => ['image/jpeg', 'image/png']
                    ]
                ],
                ['name'    => 'FileIsImage'],
                [
                    'name'    => 'FileImageSize',
                    'options' => [
                        'minWidth'  => Data::IMAGE_MIN_SIDE_WIDTH,
                        'minHeight' => Data::IMAGE_MIN_SIDE_WIDTH,
                        'maxWidth'  => Data::IMAGE_MAX_SIDE_WIDTH,
                        'maxHeight' => Data::IMAGE_MAX_SIDE_WIDTH,
                    ]
                ],
            ],
            'filters'  => [                    
                [
                    'name' => 'FileRenameUpload',
                    'options' => [  
                        'target'             => substr(Data::IMAGE_UPLOAD_DIR, 0, -1),
                        'useUploadName'      => true,
                        'useUploadExtension' => true,
                        'overwrite'          => true,
                        'randomize'          => false
                    ]
                ]
            ],   
        ]);                
    }
}
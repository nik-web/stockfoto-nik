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

namespace Image\Service;

use Image\Form\RemoveForm;
use Image\ValueObject\Data;

/**
 * ImageRemoveManager
 * 
 * The image remove manager service.
 *
 * @package Image
 * @subpackage Image\Service
 */
class ImageRemoveManager implements ImageRemoveManagerInterface
{
    /**
     * @var RemoveForm
     */
    private $form;
    
    /**
     * Constructs the service.
     * 
     * @param RemoveForm $form
     */
    public function __construct(RemoveForm $form)
    {
        $this->form = $form;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * {@inheritDoc}
     */
    public function removeImage($fileName)
    {
        $fileName = str_replace("/", "", $fileName);  // Remove slashes.
        $fileName = str_replace("\\", "", $fileName); // Remove back-slashes.
        $imagePath = Data::IMAGE_UPLOAD_DIR . $fileName; 
        if (file_exists($imagePath)) {
            if (unlink($imagePath)) {
                $output = 'file_unlink';
            } else {
                $output = 'file_not_unlink';
            }
        } else {
            $output = 'file_not_exists';
        }
        
        return $output; 
    }
}

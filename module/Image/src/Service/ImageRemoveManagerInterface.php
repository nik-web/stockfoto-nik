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

/**
 * ImageRemoveManagerInterface
 * 
 * The image remove manager interface.
 *
 * @package Image
 * @subpackage Image\Service
 */
interface ImageRemoveManagerInterface
{
    /**
     * Get remove form
     * 
     * @return \Image\Form\RemoveForm
     */
    public function getForm();
    
    /**
     * Remove the image file from the image upload directory
     * 
     * @param string $fileName
     * @return string $output
     */
    public function removeImage($fileName);
}

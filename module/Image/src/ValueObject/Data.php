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

namespace Image\ValueObject;

/**
 * Image Data
 * 
 * @package Image
 * @subpackage Image\ValueObject
 */

class Data {
    
    /**
     * @const IMAGE_UPLOAD_DIR
     */
    const IMAGE_UPLOAD_DIR = PROJECT_ROOT . '/data/uploads/image/';
    
    /**
     * @const IMAGE_MAX_SIDE_WIDTH
     */
    const IMAGE_MAX_SIDE_WIDTH = 5472;
    
    /**
     * @const IMAGE_MIN_SIDE_WIDTH
     */
    const IMAGE_MIN_SIDE_WIDTH = 128;
}
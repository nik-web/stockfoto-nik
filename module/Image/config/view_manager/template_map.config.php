<?php
/**
 * stockfoto-nik cms
 * 
 * Image module template map configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Image;

$imagePath = IMAGE_MODULE_ROOT . '/view/image/';

return [
    'image/index/index'  => $imagePath . 'index/index.phtml',
    'image/remove/index' => $imagePath . 'remove/index.phtml',
    'image/show/index'   => $imagePath . 'show/index.phtml',
    'image/upload/index' => $imagePath . 'upload/index.phtml',
];
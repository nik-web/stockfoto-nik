<?php
/** 
 * stockfoto-nik cms
 * 
 * Image module view manager configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Image;

$templateMap = include IMAGE_MODULE_ROOT
    . '/config/view_manager/template_map.config.php';

return [
    'template_map'             => $templateMap,
    'template_path_stack'      => [
        IMAGE_MODULE_ROOT . '/view',
    ],
];
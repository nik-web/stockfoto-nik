<?php
/** 
 * stockfoto-nik cms
 * 
 * Application module view manager configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Application;

$templateMap = include APPLICATION_MODULE_ROOT
    . '/config/view_manager/template_map.config.php';

return [
    'display_not_found_reason' => false, // controls whether to display the detailed information about the "Page not Found" error
    'display_exceptions'       => false, // defines whether to display information about an unhandled exception and its stack trace
    'doctype'                  => 'HTML5',
    'not_found_template'       => 'error/404', // defines the template name for the 404 error
    'exception_template'       => 'error/index',
    'template_map'             => $templateMap,
    'template_path_stack'      => [
        APPLICATION_MODULE_ROOT . '/view',
    ],
];
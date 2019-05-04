<?php
/**
 * stockfoto-nik cms
 * 
 * Image module configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Image;

$confPath = IMAGE_MODULE_ROOT . '/config/';

return [
    'controllers'     => include $confPath . 'controllers/controllers.config.php',
    'navigation'      => include $confPath . 'navigation/navigation.config.php',
    'router'          => include $confPath . 'router/router.config.php',
    'service_manager' => include $confPath . 'service_manager/service_manager.config.php',
    'translator'      => include $confPath . 'translator/translator.config.php',
    'view_manager'    => include $confPath . 'view_manager/view_manager.config.php',
];

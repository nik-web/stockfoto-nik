<?php
/**
 * stockfoto-nik cms
 * 
 * Application module layout segments configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Application;

return [
    'layout/segments/footer'     => APPLICATION_MODULE_ROOT . '/view/layout/segments/site-footer.phtml',
    'layout/segments/header'     => APPLICATION_MODULE_ROOT . '/view/layout/segments/site-header.phtml',
    'layout/segments/navigation' => APPLICATION_MODULE_ROOT . '/view/layout/segments/navigation.phtml',
];
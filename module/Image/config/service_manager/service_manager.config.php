<?php
/**
 * stockfoto-nik cms
 * 
 * Image module service manager configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Image;

use Zend\ServiceManager\Factory\InvokableFactory;

return[
    'factories' => [
        Service\ImageShowManager::class            => InvokableFactory::class,
        Service\ImageRemoveManagerInterface::class => Service\Factory\ImageRemoveManagerFactory::class,
    ],
];
<?php
/**
 * stockfoto-nik cms
 * 
 * Application module controllers configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Application\Controller;

use Zend\ServiceManager\Factory\InvokableFactory;

return[
    'factories' => [
        IndexController::class => InvokableFactory::class,
    ],
];
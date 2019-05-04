<?php
/**
 * stockfoto-nik cms
 * 
 * Image module controllers configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Image\Controller;

use Zend\ServiceManager\Factory\InvokableFactory;

return[
    'factories' => [
        IndexController::class   => InvokableFactory::class,
        RemoveController::class  => Factory\RemoveControllerFactory::class,
        ShowController::class    => Factory\ShowControllerFactory::class,
        UploadController::class  => Factory\UploadControllerFactory::class,
    ],
];
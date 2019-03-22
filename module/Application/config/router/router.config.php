<?php
/**
 * stockfoto-nik cms
 * 
 * Application module router configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Application;

use Application\Controller\IndexController;
use Zend\Router\Http\Literal;

return [
    'routes' => [
        'home' => [
            'type' => Literal::class,
            'options' => [
                'route'    => '/',
                'defaults' => [
                    'controller' => IndexController::class,
                    'action'     => 'index',
                ],
            ],
        ],
        'imprint' => [
            'type' => Literal::class,
            'options' => [
                'route'    => '/imprint',
                'defaults' => [
                    'controller' => IndexController::class,
                    'action'     => 'imprint',
                ],
            ],
        ],
        'privacy-policy' => [
            'type' => Literal::class,
            'options' => [
                'route'    => '/privacy-policy',
                'defaults' => [
                    'controller' => IndexController::class,
                    'action'     => 'privacy-policy',
                ],
            ],
        ],
    ],
];
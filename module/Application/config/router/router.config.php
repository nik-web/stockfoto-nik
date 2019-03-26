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

use Zend\Router\Http\Segment;

return [
    'routes' => [
        'home' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/[:locale]',
                'constraints' => [
                    'locale'     => implode('|', ValueObject\Data::MY_LOCALES),
                ],
                'defaults' => [
                    'controller' => Controller\IndexController::class,
                    'action'     => 'index',
                    'locale'     => ValueObject\Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'imprint' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/imprint',
                'constraints' => [
                    'locale'     => implode('|', ValueObject\Data::MY_LOCALES),
                ],
                'defaults' => [
                    'controller' => Controller\IndexController::class,
                    'action'     => 'imprint',
                    'locale'     => ValueObject\Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'privacy-policy' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/privacy-policy',
                'constraints' => [
                    'locale'     => implode('|', ValueObject\Data::MY_LOCALES),
                ],
                'defaults' => [
                    'controller' => Controller\IndexController::class,
                    'action'     => 'privacy-policy',
                    'locale'     => ValueObject\Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
    ],
];
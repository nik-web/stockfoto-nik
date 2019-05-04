<?php
/**
 * stockfoto-nik cms
 * 
 * Image module router configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Image;

use Zend\Router\Http\Segment;
use Application\ValueObject\Data;

return [
    'routes' => [
        'image-start'    => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/image',
                'constraints' => [
                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'locale'     => implode('|', Data::MY_LOCALES),
                ],
                'defaults' => [
                    'controller' => Controller\IndexController::class,
                    'action'     => 'index',
                    'locale'     => Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'image-show'    => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/image/archive[/:page]',
                'constraints' => [
                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'locale'     => implode('|', Data::MY_LOCALES),
                    'page'       => '[1-9]\d*',
                ],
                'defaults' => [
                    'controller' => Controller\ShowController::class,
                    'action'     => 'index',
                    'locale'     => Data::MY_FALLBACK_LOCALE,
                    'page' => 1,
                ],
            ],
        ],
        'image-file' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/file[/:name][/:thumbnail]',
                'constraints' => [
                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                ],
                'defaults' => [
                    'controller' => Controller\ShowController::class,
                    'action'     => 'file',
                ],
            ],
        ],
        'public-image-file' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/public-file[/:name][/:thumbnail]',
                'constraints' => [
                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                ],
                'defaults' => [
                    'controller' => Controller\ShowController::class,
                    'action'     => 'public-file',
                ],
            ],
        ],
        'image-upload'    => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/image/upload',
                'constraints' => [
                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'locale'     => implode('|', Data::MY_LOCALES),
                ],
                'defaults' => [
                    'controller' => Controller\UploadController::class,
                    'action'     => 'index',
                    'locale'     => Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'image-remove'    => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/image/remove[/:page][/:name][/:thumbnail]',
                'constraints' => [
                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'locale'     => implode('|', Data::MY_LOCALES),
                    'page'       => '[1-9]\d*',
                ],
                'defaults' => [
                    'controller' => Controller\RemoveController::class,
                    'action'     => 'index',
                    'locale'     => Data::MY_FALLBACK_LOCALE,
                    'page' => 1,
                ],
            ],
        ],
    ],
];
<?php
/**
 * stockfoto-nik cms
 * 
 * User module router configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace User;

use Zend\Router\Http\Segment;
use Application\ValueObject\Data;

return [
    'routes' => [
        'read-users' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/read-users[/:page]',
                'constraints' => [
                    'locale'     => implode('|', Data::MY_LOCALES),
                    'page'       => '[1-9]\d*',
                ],
                'defaults' => [
                    'controller' => Controller\ReadUserController::class,
                    'action'     => 'index',
                    'locale'     => Data::MY_FALLBACK_LOCALE,
                    'page'       => 1,
                ],
            ],
        ],
        'read-user' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/read-user/:id',
                'constraints' => [
                    'locale'     => implode('|', Data::MY_LOCALES),
                    'id' => '[1-9]\d*',
                ],
                'defaults' => [
                    'controller' => Controller\ReadUserController::class,
                    'action' => 'detail',
                    'locale' => Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'user-account' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/user-account',
                'constraints' => [
                    'locale'     => implode('|', Data::MY_LOCALES),
                ],
                'defaults' => [
                    'controller' => Controller\ReadUserController::class,
                    'action'     => 'account',
                    'locale'     => Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'login-user' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/login',
                'constraints' => [
                    'locale'     => implode('|', Data::MY_LOCALES),
                ],
                'defaults' => [
                    'controller' => Controller\AuthController::class,
                    'action'     => 'login',
                    'locale'     => Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'logout-user' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/logout',
                'constraints' => [
                    'locale'     => implode('|', Data::MY_LOCALES),
                ],
                'defaults' => [
                    'controller' => Controller\AuthController::class,
                    'action'     => 'logout',
                    'locale'     => Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'not-authorized' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/not-authorized',
                'constraints' => [
                    'locale'     => implode('|', Data::MY_LOCALES),
                ],
                'defaults' => [
                    'controller' => Controller\AuthController::class,
                    'action'     => 'notAuthorized',
                    'locale'     => Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'add-user' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/add-user',
                'constraints' => [
                    'locale'     => implode('|', Data::MY_LOCALES),
                ],
                'defaults' => [
                    'controller' => Controller\WriteUserController::class,
                    'action'     => 'add',
                    'locale'     => Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'change-password' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/change-password',
                'constraints' => [
                    'locale'     => implode('|', Data::MY_LOCALES),
                ],
                'defaults' => [
                    'controller' => Controller\WriteUserController::class,
                    'action'     => 'change-password',
                    'locale'     => Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'edit-user' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/edit-user/:id',
                'constraints' => [
                    'locale'     => implode('|', Data::MY_LOCALES),
                    'id' => '[1-9]\d*',
                ],
                'defaults' => [
                    'controller' => Controller\WriteUserController::class,
                    'action' => 'edit',
                    'locale' => Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'reset-password' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/reset-password',
                'constraints' => [
                    'locale'     => implode('|', Data::MY_LOCALES),
                ],
                'defaults' => [
                    'controller' => Controller\WriteUserController::class,
                    'action'     => 'reset-password',
                    'locale'     => Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'set-password' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/set-password/:token',
                'constraints' => [
                    'locale'     => implode('|', Data::MY_LOCALES),
                    'token'      => '[a-z0-9]{32}',
                ],
                'defaults' => [
                    'controller' => Controller\WriteUserController::class,
                    'action'     => 'set-password',
                    'locale'     => Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'delete-user' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/delete-user/:id',
                'constraints' => [
                    'locale'     => implode('|', Data::MY_LOCALES),
                    'id' => '[1-9]\d*',
                ],
                'defaults' => [
                    'controller' => Controller\DeleteUserController::class,
                    'action' => 'delete',
                    'locale' => Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'user-account-delete' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/user-account-delete',
                'constraints' => [
                    'locale'     => implode('|', Data::MY_LOCALES),
                ],
                'defaults' => [
                    'controller' => Controller\DeleteUserController::class,
                    'action'     => 'delete-own',
                    'locale'     => Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'registration' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/registration',
                'constraints' => [
                    'locale'     => implode('|', Data::MY_LOCALES),
                ],
                'defaults' => [
                    'controller' => Controller\RegistrationController::class,
                    'action'     => 'create',
                    'locale'     => Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
        'confirm-registration' => [
            'type' => Segment::class,
            'options' => [
                'route'    => '/:locale/confirm-registration/:token',
                'constraints' => [
                    'locale'     => implode('|', Data::MY_LOCALES),
                    'token'      => '[a-z0-9]{32}',
                ],
                'defaults' => [
                    'controller' => Controller\RegistrationController::class,
                    'action'     => 'confirm',
                    'locale'     => Data::MY_FALLBACK_LOCALE,
                ],
            ],
        ],
    ],
];
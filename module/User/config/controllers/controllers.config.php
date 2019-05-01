<?php
/**
 * stockfoto-nik cms
 * 
 * User module controllers configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace User\Controller;

return[
    'factories' => [
        RegistrationController::class => Factory\RegistrationControllerFactory::class,
        ReadUserController::class     => Factory\ReadUserControllerFactory::class,
        AuthController::class         => Factory\AuthControllerFactory::class,
        WriteUserController::class    => Factory\WriteUserControllerFactory::class,
        DeleteUserController::class   => Factory\DeleteUserControllerFactory::class,
    ],
];
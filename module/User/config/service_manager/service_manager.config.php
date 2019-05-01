<?php
/**
 * stockfoto-nik cms
 * 
 * User module service manager configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace User;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Authentication\AuthenticationServiceInterface;

return[
    'factories' => [
        Repository\RegistrationInterface::class       => Repository\Factory\ZendDbTableGatewayRegistrationFactory::class,
        Repository\UserInterface::class               => Repository\Factory\ZendDbTableGatewayUserFactory::class,
        Repository\RoleInterface::class               => Repository\Factory\ZendDbTableGatewayRoleFactory::class,
        Repository\SecuritytokenInterface::class      => Repository\Factory\ZendDbTableGatewaySecuritytokenFactory::class,
        Form\RegistrationForm::class                  => Form\Factory\RegistrationFormFactory::class,
        Form\LoginForm::class                         => Form\Factory\LoginFormFactory::class,
        Service\AuthManagerInterface::class           => Service\Factory\AuthManagerFactory::class,
        Service\AuthAdapterInterface::class           => Service\Factory\AuthAdapterFactory::class,
        'sing_in_nav'                                 => Service\Factory\SingInNavFactory::class,
        'sing_out_nav'                                => Service\Factory\SingOutNavFactory::class,
        AuthenticationServiceInterface::class         => Service\Factory\AuthenticationServiceFactory::class,
        Service\UserWriteManagerInterface::class      => Service\Factory\UserWriteManagerFactory::class,
        Form\UserAddForm::class                       => Form\Factory\UserAddFormFactory::class,
        Form\UserDeleteForm::class                    => InvokableFactory::class,
        Form\AccountDeleteForm::class                 => InvokableFactory::class,
        Form\UserEditForm::class                      => Form\Factory\UserEditFormFactory::class,
        Form\PasswordChangeForm::class                => InvokableFactory::class,
        Form\PasswordResetForm::class                 => Form\Factory\PasswordResetFormFactory::class,
        Form\PasswordSetForm::class                   => InvokableFactory::class,
        Service\RbacManagerInterface::class           => Service\Factory\RbacManagerFactory::class,
        Service\UserDeleteManagerInterface::class     => Service\Factory\UserDeleteManagerFactory::class,
        Service\UserReadManagerInterface::class       => Service\Factory\UserReadManagerFactory::class,
        Service\RegistrationManagerInterface::class   => Service\Factory\RegistrationManagerFactory::class,
    ],
];
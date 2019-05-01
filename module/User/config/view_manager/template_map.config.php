<?php
/**
 * stockfoto-nik cms
 * 
 * User module template map configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace User;

$viewPathReadUser = USER_MODULE_ROOT . '/view/user/read-user/';
$vievPathAuth = USER_MODULE_ROOT . '/view/user/auth/';
$viewPathWriteUser = USER_MODULE_ROOT . '/view/user/write-user/';
$viewPathDeleteUser = USER_MODULE_ROOT . '/view/user/delete-user/';
$viewPathRegistration = USER_MODULE_ROOT . '/view/user/registration/';
$viewPathPartials = USER_MODULE_ROOT . '/view/partials/';

return [
    'user/read-user/account'           => $viewPathReadUser . 'account.phtml',
    'user/read-user/index'             => $viewPathReadUser . 'index.phtml',
    'user/read-user/detail'            => $viewPathReadUser . 'detail.phtml',
    'user/auth/login'                  => $vievPathAuth . 'login.phtml',
    'user/auth/not-authorized'         => $vievPathAuth . 'not-authorized.phtml',
    'user/write-user/add'              => $viewPathWriteUser . 'add.phtml',
    'user/write-user/change-password'  => $viewPathWriteUser . 'change-password.phtml',
    'user/write-user/edit'             => $viewPathWriteUser . 'edit.phtml',
    'user/write-user/reset-password'   => $viewPathWriteUser . 'reset-password.phtml',
    'user/write-user/set-password'     => $viewPathWriteUser . 'set-password.phtml',
    'user/delete-user/delete'          => $viewPathDeleteUser . 'delete.phtml',
    'user/delete-user/delete-own'      => $viewPathDeleteUser . 'delete-own.phtml',
    'user/registration/create'         => $viewPathRegistration . 'create.phtml',
    'user/registration/confirm'        => $viewPathRegistration . 'confirm.phtml',
    'partials/nav-bars/sing_in.phtml'  => $viewPathPartials . 'nav-bars/sing_in_default.phtml',
    'partials/nav-bars/sing_out.phtml' => $viewPathPartials . 'nav-bars/sing_out_default.phtml',
];
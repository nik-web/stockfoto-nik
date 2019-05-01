<?php
/**
 * stockfoto-nik cms
 * 
 * User module translate de_DE
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace User;

$locale = 'de_DE';

return array_merge(
    include 'config/navigation/' . $locale . '.php',
    include 'flash-messanges/' . $locale . '.php',
    include 'validator-messanges/' . $locale . '.php',
    include 'form-elements/' . $locale . '.php',
    include 'view/user/read-user/index/' . $locale . '.php',
    include 'view/user/read-user/detail/' . $locale . '.php',
    include 'view/user/read-user/account/' . $locale . '.php',
    include 'view/user/auth/login/' . $locale . '.php',
    include 'view/user/auth/not-authorized/' . $locale . '.php',    
    include 'view/user/write-user/add/' . $locale . '.php',
    include 'view/user/write-user/change-password/' . $locale . '.php',
    include 'view/user/write-user/edit/' . $locale . '.php',
    include 'view/user/write-user/reset-password/' . $locale . '.php',
    include 'view/user/write-user/set-password/' . $locale . '.php',
    include 'view/user/delete-user/delete-own/' . $locale . '.php',
    include 'view/user/delete-user/delete/' . $locale . '.php',
    include 'view/user/registration/confirm/' . $locale . '.php',
    include 'view/user/registration/create/' . $locale . '.php'
);
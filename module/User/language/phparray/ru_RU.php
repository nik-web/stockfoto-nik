<?php
/**
 * stockfoto-nik cms
 * 
 * User module translate ru_RU
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace User;

$locale = 'ru_RU';

return array_merge(
    include 'config/navigation/' . $locale . '.php',
    include 'form-elements/' . $locale . '.php',
    include 'validator-messanges/' . $locale . '.php',
    include 'view/user/auth/not-authorized/' . $locale . '.php',
    include 'view/user/read-user/index/' . $locale . '.php',
    include 'view/user/auth/login/' . $locale . '.php'
);
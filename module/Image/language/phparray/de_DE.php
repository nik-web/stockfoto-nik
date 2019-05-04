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
    include 'form-elements/' . $locale . '.php',
    include 'validator-messanges/' . $locale . '.php',
    include 'view/image/index/index/' . $locale . '.php',
    include 'view/image/remove/index/' . $locale . '.php',
    include 'view/image/show/index/' . $locale . '.php',
    include 'view/image/upload/index/' . $locale . '.php'
);
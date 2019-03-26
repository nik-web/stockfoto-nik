<?php
/**
 * stockfoto-nik cms
 * 
 * Application module translate en_US
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

$locale = 'en_US';

return array_merge(
    include 'config/navigation/' . $locale . '.php',
    include 'view/application/index/index/' . $locale . '.php',
    include 'view/application/index/imprint/' . $locale . '.php',
    include 'view/error/404/' . $locale . '.php',
    include 'view/error/index/' . $locale . '.php'
);
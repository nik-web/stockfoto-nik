<?php
/**
 * stockfoto-nik cms
 * 
 * Application module translate ru_RU
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Application;

$locale = 'ru_RU';

return array_merge(
    include 'config/navigation/' . $locale . '.php',
    include 'view/application/index/index/' . $locale . '.php',
    include 'view/application/index/imprint/' . $locale . '.php'
);
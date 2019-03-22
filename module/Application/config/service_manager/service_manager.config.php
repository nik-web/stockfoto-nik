<?php
/**
 * stockfoto-nik cms
 * 
 * Application module service manager configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Application;

use Application\Service\Factory\BrandNavFactory;
use Application\Service\Factory\MainNavFactory;
use Application\Service\Factory\MetaNavFactory;

return[
    'factories' => [
        'brand_nav' => BrandNavFactory::class,
        'main_nav'  => MainNavFactory::class,
        'meta_nav'  => MetaNavFactory::class,
    ],
];


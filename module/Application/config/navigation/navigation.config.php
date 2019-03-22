<?php
/**
 * stockfoto-nik cms
 * 
 * Application module navigation configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Application;

return[
    'brand_nav' => [
        [
            'label' => ValueObject\Data::NAME,
            'route' => 'home',
        ],
    ],
    'main_nav'  => [
        [
            'label' => 'Home',
            'route' => 'home',
        ],
    ],
    'meta_nav'  => [
        [
            'label' => 'Impressum',
            'route' => 'imprint',
        ],
        [
            'label' => 'Datenschutz',
            'route' => 'privacy-policy',
        ],
    ],
];
<?php
/**
 * stockfoto-nik cms
 * 
 * Application module navigation configuration
 * 
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
            'useRouteMatch' => true,
        ],
    ],
    'main_nav'  => [
        [
            'label' => 'home_label_main_nav',
            'route' => 'home',
            'useRouteMatch' => true,
        ],
    ],
    'meta_nav'  => [
        [
            'label' => 'impressum_label_meta_nav',
            'route' => 'imprint',
            'useRouteMatch' => true,
        ],
        [
            'label' => 'privacy-policy_label_meta_nav',
            'route' => 'privacy-policy',
            'useRouteMatch' => true,
        ],
    ],
];
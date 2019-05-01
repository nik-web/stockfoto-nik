<?php
/**
 * stockfoto-nik cms
 * 
 * User module navigation configuration
 * 
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace User;

return[
    'sing_in_nav' => [
        [
            'label' => 'login-user_label_sing_in_nav',
            'route' => 'login-user',
            'useRouteMatch' => true,
            'order' => 5,
        ],
        [
            'label' => 'regisration_label_sing_in_nav',
            'route' => 'registration',
            'useRouteMatch' => true,
            'order' => 10,
        ],
    ],
    'sing_out_nav'  => [
        [
            'label' => 'user-account_label_sing_out_nav',
            'route' => 'user-account',
            'useRouteMatch' => true,
            'order' => 5,
        ],
        [
            'label' => 'logout-user_label_sing_out_nav',
            'route' => 'logout-user',
            'useRouteMatch' => true,
            'order' => 10,
        ],
    ],
];
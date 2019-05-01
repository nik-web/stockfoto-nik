<?php
/**
 * stockfoto-nik cms
 * 
 * User module view helpers configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace User\View\Helper;

return [
    'factories' => [
        Alias::class  => Factory\AliasFactory::class,
        Access::class => Factory\AccessFactory::class,
    ],
    'aliases' => [
        'alias'  => Alias::class,
        'access' => Access::class,
    ]
];

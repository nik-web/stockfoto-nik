<?php
/**
 * stockfoto-nik cms
 * 
 * Application module view helpers configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Application;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'factories' => [
        View\Helper\Owner::class      => InvokableFactory::class,
        View\Helper\Data::class       => InvokableFactory::class,
        View\Helper\Locale::class     => View\Helper\Factory\LocaleFactory::class,
        View\Helper\RouteMatch::class => View\Helper\Factory\RouteMatchFactory::class,
    ],
    'aliases' => [
        'applicationOwner' => View\Helper\Owner::class,
        'applicationData'  => View\Helper\Data::class,
        'locale'           => View\Helper\Locale::class,
        'routeMatch'       => View\Helper\RouteMatch::class,
    ]
];

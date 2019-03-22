<?php
/**
 * stockfoto-nik cms
 * 
 * Application development configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

return [
    // Additional modules to include when in development mode
    'modules' => [
    ],
    // Configuration overrides during development mode
    'module_listener_options' => [
        'config_glob_paths' => [
            realpath(__DIR__) . '/autoload/{,*.}{global,local}-development.php',
        ],
        'config_cache_enabled' => false,
        'module_map_cache_enabled' => false,
    ],
    'view_manager' => [
        'display_not_found_reason' => true, // controls whether to display the detailed information about the "Page not Found" error
        'display_exceptions'       => true, // defines whether to display information about an unhandled exception and its stack trace
    ],
];

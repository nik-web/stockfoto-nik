<?php
/**
 * stockfoto-nik cms
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

use Zend\Mvc\Application;
use Zend\Stdlib\ArrayUtils;

// Define application root for better file path definitions
define('PROJECT_ROOT', realpath(__DIR__ . '/..'));

// Define application environment, needs to be set within virtual host
// but could be chosen by any other identifier
define(
    'APPLICATION_ENV', (getenv('APPLICATION_ENV')
    ? getenv('APPLICATION_ENV')
    : 'production')
);

// Display all errors if APPLICATION_ENV is development.
if (APPLICATION_ENV === 'development') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

// Change working dir
// This makes our life easier when dealing with paths.
// Everything is relative to the application root now.
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

// Composer autoloading
include PROJECT_ROOT . '/vendor/autoload.php';

// Exception
if (! class_exists(Application::class)) {
    throw new RuntimeException(
        "Unable to load application.\n"
        . "- Type `composer install` if you are developing locally.\n"
    );
}

// Retrieve configuration
$appConfig = require PROJECT_ROOT . '/config/application.config.php';
if (APPLICATION_ENV === 'development') {
    $appConfig = ArrayUtils::merge($appConfig, require PROJECT_ROOT . '/config/development.config.php');
}

// Run the application!
Application::init($appConfig)->run();

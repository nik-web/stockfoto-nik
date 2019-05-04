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

namespace Image;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;

/**
 * Image module class
 * 
 * @package Image
 */
class Module implements ConfigProviderInterface, InitProviderInterface
{
    /**
     * {@inheritDoc}
     * 
     */
    public function init(ModuleManagerInterface $manager)
    {
        if (!defined('IMAGE_MODULE_ROOT')) {
            define('IMAGE_MODULE_ROOT', realpath(__DIR__ . '/../'));
        }
    }
    
    /**
     * {@inheritDoc}
     * 
     */
    public function getConfig()
    {
        return include IMAGE_MODULE_ROOT . '/config/module.config.php';
    }
}
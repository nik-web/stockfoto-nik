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

namespace User;

use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\EventManager\EventInterface;
use User\Listener\UserListener;

/**
 * User module class
 * 
 * @package User
 */
class Module
    implements InitProviderInterface,
               ConfigProviderInterface,
               BootstrapListenerInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function init(ModuleManagerInterface $manager)
    {
        if (!defined('USER_MODULE_ROOT')) {
            define('USER_MODULE_ROOT', realpath(__DIR__ . '/../'));
        }
    }
    
    /**
     * {@inheritDoc}
     * 
     */
    public function getConfig()
    {
        return include USER_MODULE_ROOT . '/config/module.config.php';
    }
    
    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $e)
    {
        $application = $e->getApplication();
        
        $eventManager = $application->getEventManager();
        // attach module listener
        $userListener = new UserListener();
        $userListener->attach($eventManager); 
    }
}
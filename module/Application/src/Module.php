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
 
namespace Application;

use Application\Listener\ApplicationListener;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Session\SessionManager;

/**
 * Application module class
 * 
 * @package Application
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
        if (!defined('APPLICATION_MODULE_ROOT')) {
            define('APPLICATION_MODULE_ROOT', realpath(__DIR__ . '/../'));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include APPLICATION_MODULE_ROOT . '/config/module.config.php';
    }
    
    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $e)
    {
        $application = $e->getApplication();
        
        $eventManager = $application->getEventManager();
        // Attach module listener
        $applicationListener = new ApplicationListener();
        $applicationListener->attach($eventManager); 
        
        $serviceManager = $application->getServiceManager();
        // The following line instantiates the SessionManager and automatically
        // makes the SessionManager the 'default' one.
        $sessionManager = $serviceManager->get(SessionManager::class);
        $sessionManager->start();
    }
}
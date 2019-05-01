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

namespace User\Service\Factory;

use Interop\Container\ContainerInterface;
use User\Service\AuthAdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session;
use Zend\Authentication\AuthenticationService;

/**
 * AuthenticationServiceFactory
 *
 * @package User
 * @subpackage User\Service\Factory
 */
class AuthenticationServiceFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return AuthenticationService
     */
    public function __invoke(ContainerInterface $container, 
                    $requestedName, array $options = null)
    {
        $sessionManager = $container->get(SessionManager::class);
        $authStorage = new Session('Zend_Auth', 'session', $sessionManager);
        $authAdapter = $container->get(AuthAdapterInterface::class);

        // Create the service and inject dependencies into its constructor.
        return new AuthenticationService($authStorage, $authAdapter);
    }
}

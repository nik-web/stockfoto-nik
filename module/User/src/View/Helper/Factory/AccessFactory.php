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

namespace User\View\Helper\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationServiceInterface;
use User\Repository\UserInterface;
use User\View\Helper\Access;

/**
 * AccessFactory
 *
 * @package User
 * @subpackage User\View\Helper\Factory
 */
class AccessFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return 
     */
    public function __invoke(ContainerInterface $container, 
                    $requestedName, array $options = null)
    {   
        $userRepository = $container->get(UserInterface::class);
        $authService = $container->get(AuthenticationServiceInterface::class);
        
        return new Access($userRepository, $authService);
    }
}
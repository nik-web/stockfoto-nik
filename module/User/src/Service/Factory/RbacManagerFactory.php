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
use Zend\ServiceManager\Factory\FactoryInterface;
use User\Repository\UserInterface;
use User\Service\RbacManager;

/**
 * RbacmanagerFactory
 *
 * @package User
 * @subpackage User\Service\Factory
 */
class RbacManagerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return RbacManager
     */
    public function __invoke(ContainerInterface $container, 
                    $requestedName, array $options = null)
    {
        $repository = $container->get(UserInterface::class);
        // Create the service
        return new RbacManager($repository);
    }
}

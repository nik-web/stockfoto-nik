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

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use User\Repository\UserInterface;
use User\Service\AuthAdapter;

/**
 * AuthAdapterFactory
 *
 * @package User
 * @subpackage User\Service
 */
class AuthAdapterFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return AuthAdapter
     */
    public function __invoke(ContainerInterface $container, 
                    $requestedName, array $options = null)
    {
        $repository = $container->get(UserInterface::class);
        
        return new AuthAdapter($repository);
    }
}

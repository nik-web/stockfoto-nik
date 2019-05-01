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

namespace User\Controller\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use User\Controller\WriteUserController;
use User\Service\UserWriteManagerInterface;

/**
 * WriteUserControllerFactory
 *
 * @package User
 * @subpackage User\Controller\Factory
 */
class WriteUserControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return AuthController
     */
    public function __invoke(ContainerInterface $container, $requestedName,
        array $options = null
    ) {
        $manager = $container->get(UserWriteManagerInterface::class);
        
        return new WriteUserController($manager);
        
    }
}
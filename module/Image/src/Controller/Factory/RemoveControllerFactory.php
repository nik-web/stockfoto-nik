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

namespace Image\Controller\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Image\Service\ImageRemoveManagerInterface;
use Image\Controller\RemoveController;

/**
 * Remove controller factory
 * 
 * @package Image
 * @subpackage Image\Cotroller\Factory
 */
class RemoveControllerFactory implements FactoryInterface
{
    /**
     *  {@inheritDoc}
     * @return ShowController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $manager = $container->get(ImageRemoveManagerInterface::class);
        
        return new RemoveController($manager);
    }
}
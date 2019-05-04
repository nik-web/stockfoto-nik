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
use Image\Controller\ShowController;
use Image\Service\ImageShowManager;

/**
 * Show controller factory
 * 
 * @package Image\Cotroller\Factory
 * @subpackage Image
 */
class ShowControllerFactory implements FactoryInterface
{
    /**
     *  {@inheritDoc}
     * @return ShowController
     */
    public function __invoke(ContainerInterface $container, $requestedName,
            array $options = null
    ) {
        $manager = $container->get(ImageShowManager::class);
        
        return new ShowController($manager);
    }
}
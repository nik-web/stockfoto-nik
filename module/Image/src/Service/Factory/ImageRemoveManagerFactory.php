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

namespace Image\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Image\Form\RemoveForm;
use Image\Service\ImageRemoveManager;

/**
 * ImageRemoveManagerFactory
 *
 * @package Image
 * @subpackage Image\Service\Factory
 */
class ImageRemoveManagerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return ImageRemoveManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formManager = $container->get('FormElementManager');
        $form = $formManager->get(RemoveForm::class);
        $manager = new ImageRemoveManager($form);
        
        return $manager;
    }
}
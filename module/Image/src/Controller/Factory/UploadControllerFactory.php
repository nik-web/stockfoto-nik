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

/**
 * Usage
 */
use Image\Controller\UploadController;
use Image\Form\UploadForm;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Upload controller factory
 * 
 * @package Test Test
 * @subpackage Image
 */
class UploadControllerFactory implements FactoryInterface
{
    /**
     *  {@inheritDoc}
     * @return UploadController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formManager = $container->get('FormElementManager');
        return new UploadController(
            $formManager->get(UploadForm::class)
        );
    }
}
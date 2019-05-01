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

namespace User\Form\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\Adapter\AdapterInterface;
use User\Form\PasswordResetForm;

/**
 * PasswordResetFormFactory
 *
 * @package User
 * @subpackage User\Form
 */
class PasswordResetFormFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return PasswortResetForm
     */
    public function __invoke(ContainerInterface $container, $requestedName,
        array $options = null
    ) {
        
        $dbAdapter = $container->get(AdapterInterface::class);
        $form = new PasswordResetForm($dbAdapter);
        
        return $form; 
    }
}
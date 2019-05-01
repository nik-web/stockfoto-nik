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
use User\Repository\RoleInterface;
use User\Form\UserEditForm;

/**
 * UserEditFormFactory
 *
 * @package User
 * @subpackage User\Form
 */
class UserEditFormFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return UserEditForm
     */
    public function __invoke(ContainerInterface $container, $requestedName,
        array $options = null
    ) {
        
        $roleRepository = $container->get(RoleInterface::class);
        $form = new UserEditForm($roleRepository);
        
        return $form; 
    }
}
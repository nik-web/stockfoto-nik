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
use User\Form\UserAddForm;
use User\Form\UserEditForm;
use User\Form\PasswordChangeForm;
use User\Form\PasswordResetForm;
use User\Form\PasswordSetForm;
use User\Service\UserWriteManager;

/**
 * UserWriteManagerFactory
 *
 * @package User
 * @subpackage User\Service\Factory
 */
class UserWriteManagerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return UserWriteManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $repository = $container->get(UserInterface::class);
        $addForm = $container->get(UserAddForm::class);
        $editForm = $container->get(UserEditForm::class);
        $passwordChangeForm = $container->get(PasswordChangeForm::class);
        $passwordResetForm = $container->get(PasswordResetForm::class);
        $passwordSetForm = $container->get(PasswordSetForm::class);
        
        $manager = new UserWriteManager(
            $repository, $addForm, $editForm, $passwordChangeForm,
            $passwordResetForm, $passwordSetForm
        );
        
        return $manager;
    }
}
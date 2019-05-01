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
use User\Repository\RegistrationInterface;
use User\Form\RegistrationForm;
use User\Form\PasswordSetForm;
use User\Repository\UserInterface;
use User\Service\RegistrationManager;

/**
 * RegistrationManagerFactory
 *
 * @package User
 * @subpackage User\Service\Factory
 */
class RegistrationManagerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return RegistrationManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $repository = $container->get(RegistrationInterface::class);
        $registrationForm = $container->get(RegistrationForm::class);
        $passwordSetForm = $container->get(PasswordSetForm::class);
        $userRepository = $container->get(UserInterface::class);
        
        $manager = new RegistrationManager(
            $repository, $registrationForm, $passwordSetForm, $userRepository
        );
        
        return $manager;
    }
}
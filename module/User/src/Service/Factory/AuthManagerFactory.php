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
use User\Form\LoginForm;
use Zend\Authentication\AuthenticationServiceInterface;
use User\Repository\SecuritytokenInterface;
use User\Service\AuthManager;

/**
 * AuthManagerFactory
 *
 * @package User
 * @subpackage User\Service
 */
class AuthManagerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return AuthManager
     */
    public function __invoke(ContainerInterface $container, 
                    $requestedName, array $options = null)
    {   
        $loginForm = $container->get(LoginForm::class);
        $authService = $container->get(AuthenticationServiceInterface::class);
        $repository = $container->get(SecuritytokenInterface::class);
        $lastURLSessionContainer = $container->get('lastURLSessionContainer');
        
        return new AuthManager(
            $loginForm, $authService, $repository, $lastURLSessionContainer
        );
    }
}

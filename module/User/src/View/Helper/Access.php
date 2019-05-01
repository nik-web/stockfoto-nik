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

namespace User\View\Helper;

use Zend\View\Helper\AbstractHelper;
use User\Repository\UserInterface;
use Zend\Authentication\AuthenticationServiceInterface;

/**
 * User access view helper
 *
 * @package User
 * @subpackage User\View\Helper
 */
class Access extends AbstractHelper
{
    /**
     * 
     *
     * @var UserInterface $repository 
     */
    protected $repository;
    
    /**
     * @var AuthenticationServiceInterface $authService
     */
    protected $authService;

    /**
     * Constructor
     * 
     * @param UserInterface $repository
     * @param AuthenticationServiceInterface $authService
     */
    
    public function __construct(
            UserInterface $repository,
            AuthenticationServiceInterface $authService
    ) {
        $this->repository = $repository;
        $this->authService = $authService;
    }
    
    /**
     * 
     * @param strig $role
     * @return boolean
     */
    public function __invoke($role)
    {
        if (!$this->authService->hasIdentity()) {
            return false;
        }
        $identity = $this->authService->getIdentity();
        $user = $this->repository->findByEmail($identity);
        $roles = $user->getRoles();
        
        return in_array($role, $roles);
    }
}
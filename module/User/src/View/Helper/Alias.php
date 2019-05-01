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
 * User alias view helper
 *
 * @package User
 * @subpackage User\View\Helper
 */
class Alias extends AbstractHelper
{
    /**
     * 
     *
     * @var UserInterface $repository 
     */
    protected $repository;
    
    /**
     * @var AuthenticationServiceInterface $service
     */
    protected $service;

    /**
     * Constructor
     * 
     * @param UserInterface $repository
     * @param AuthenticationServiceInterface $service
     */
    
    public function __construct(
            UserInterface $repository, AuthenticationServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }
    
    /**
     * @return null|string user alias
     */
    public function __invoke()
    {
        if (!$this->service->hasIdentity()) {
            return;
        }
        $identity = $this->service->getIdentity();
        $user = $this->repository->findByEmail($identity);
        $alias = $user->getAlias();
        
        return $alias;
    }
}

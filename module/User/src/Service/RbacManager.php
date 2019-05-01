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

namespace User\Service;

use User\Repository\UserInterface;
use Zend\Permissions\Rbac\Rbac;
use Zend\Permissions\Rbac\Role;

/**
 * Description of RbacManager
 *
 * @package User
 * @subpackage User\Service
 */
class RbacManager implements RbacManagerInterface {
    
    /**
     * @var Zend\Permissions\Rbac\Rbac
     */
    private $rbac;
    
    /**
     * @var UserInterface 
     */
    private $repository;
    
    /**
     * Construct
     * 
     * @param UserInterface $repository
     */
    public function __construct($repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * {@inheritDoc}
     */
    public function init()
    {
        if ($this->rbac != null) {
            // Already initialized; do nothing.
            return;
        }
        
        // Create Rbac container.
        $rbac = new Rbac();
        $this->rbac = $rbac;
        
        // Construct role hierarchy without database

        // Create some roles
        $guest= new Role('guest');
        $guest->addPermission('home');
        $guest->addPermission('privacy-policy');
        $guest->addPermission('imprint');
        $guest->addPermission('login-user');
        $guest->addPermission('logout-user');
        $guest->addPermission('not-authorized');
        $guest->addPermission('reset-password');
        $guest->addPermission('set-password');
        $guest->addPermission('registration');
        $guest->addPermission('confirm-registration');
        
        $customer = new Role('customer');
        $customer->addChild($guest);
        $customer->addPermission('user-account');
        $customer->addPermission('change-password');
        $customer->addPermission('user-account-delete');
        
        $contributor = new Role('contributor');
        $contributor->addChild($customer);
        
        $editor = new Role('editor');
        $editor->addChild($contributor);
        
        $moderator = new Role('moderator');
        $moderator->addChild($editor);
        
        $admin = new Role('admin');
        $admin->addChild($moderator);
        $admin->addPermission('read-users');
        $admin->addPermission('read-user');
        $admin->addPermission('add-user');
        $admin->addPermission('edit-user');
        $admin->addPermission('delete-user');
        
        // add Roles
        $this->rbac->addRole($guest);
        $this->rbac->addRole($customer);
        $this->rbac->addRole($contributor);
        $this->rbac->addRole($editor);
        $this->rbac->addRole($moderator);
        $this->rbac->addRole($admin);
    }
    
    /**
     * {@inheritDoc}
     */
    public function isGranted($identity, $permission)
    {
        $this->repository->findByEmail($identity);
        
        if (null === $identity) {
            $roleNames = ['guest',];
        } else {
            $user = $this->repository->findByEmail($identity);
            if (! $user instanceof \User\Entity\User) {
                $roleNames = ['guest',];
            } else {
                $roleNames = $user->getRoles();
            }
            if (empty($roleNames)) {
                $roleNames = ['guest',];
            }
        }
        
        if ($this->rbac == null) {
            $this->init();
        }
        
        foreach ($roleNames as $roleName) {
            if ($this->rbac->isGranted($roleName, $permission)) {

                return true;
            }
        }
        
        return false;
    }
}

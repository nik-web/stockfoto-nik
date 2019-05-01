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

use Zend\Crypt\Password\Bcrypt;
use User\Entity\User;
use User\Repository\UserInterface;
use User\Form\UserDeleteForm;
use User\Form\AccountDeleteForm; // secure form

/**
 * UserDeleteManager
 *
 * @package User
 * @subpackage User\Service
 */
class UserDeleteManager implements UserDeleteManagerInterface
{
    /**
     * @var UserInterface
     */
    private $repository;

    /**
     * @var UserDeleteForm
     */
    private $form;
    
    /**
     * @var AccountDeleteForm
     */
    private $secureForm;

    /**
     * Constructs the service.
     * 
     * @param UserInterface $repository
     * @param UserDeleteForm $form
     * @param AccountDeleteForm $secureForm
     */
    public function __construct(
        UserInterface $repository,
        UserDeleteForm $form,
        AccountDeleteForm $secureForm
    ) {
        $this->repository = $repository;
        $this->form = $form;
        $this->secureForm = $secureForm;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getRepository()
    {
        return $this->repository;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getDeleteForm()
    {
        return $this->form;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getAccountDeleteForm()
    {
        return $this->secureForm;
    }
    
    /**
     * {@inheritDoc}
     */
    public function validatePassword(User $user, $password) 
    {
        $bcrypt = new Bcrypt();
        $passwordHash = $user->getPassword();
        if ($bcrypt->verify($password, $passwordHash)) {
            
            return true;
        }
        
        return false;
    }
    
    /**
     * {@inheritDoc}
     */
    public function delete($form)
    {
        $data = $form->getData();
        $id = intval($data['hidden_id']);
        $user = $this->repository->find($id);
        if (! $user instanceof User) {
           
            return false;
        }
        if (isset($data['current_password'])) {
            if (! $this->validatePassword($user, $data['current_password'])) {
                
                return false;
            }
        }
        $this->repository->delete($user);
        $this->repository->deleteUserRoleConnectionsByUserId($id);
        
        return true;
    }
}
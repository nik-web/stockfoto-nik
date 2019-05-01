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

use User\Entity\User;

/**
 * UserDeleteManagerInterface
 *
 * @package User
 * @subpackage User\Service
 */
interface UserDeleteManagerInterface
{
    /**
     * return \User\Repository\UserInterface
     */
    public function getRepository();

    /**
     * Get delete user form
     * 
     * @return \User\Form\UserDeleteForm
     */
    public function getDeleteForm();
    
    /**
     * Get delete user account delete form
     * 
     * @return \User\Form\AccountDeleteForm
     */
    public function getAccountDeleteForm();
    
    /**
     * Checks that the given password is correct.
     * 
     * @param User $user
     * @param string $password
     * 
     * @return boolean
     */
    public function validatePassword(User $user, $password);
    
    /**
     * Deleter user data
     * 
     * @param object $form
     * @return boolean
     */
    public function delete($form);
    
}
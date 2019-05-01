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
use User\Form\UserAddForm;
use User\Form\UserEditForm;
use User\Form\PasswordChangeForm;
use User\Form\PasswordResetForm;
use User\Form\PasswordSetForm;

/**
 * UserWriteManagerInterface
 *
 * @package User
 * @subpackage User\Service
 */
interface UserWriteManagerInterface
{
    /**
     * return \User\Repository\UserInterface
     */
    public function getRepository();
    
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
     * Get add user form
     * 
     * @return \User\Form\UserAddForm
     */
    public function getAddForm();
    
    /**
     * Add new user record
     * 
     * @param \User\Form\UserAddForm
     */
    public function addUser(UserAddForm $form);
    
    /**
     * Get edit user form
     * 
     * @return \User\Form\UserEditForm
     */
    public function getEditForm();
    
    /**
     * Edit user record and user_role records with user_id
     * 
     * @param \User\Service\Edit $form
     * @param User $user
     * @return boolean
     */
    public function editUser(UserEditForm $form, User $user);
    
    /**
     * Get user password change form
     * 
     * @return \User\Form\PasswordChangeForm
     */
    public function getPasswordChangeForm();
    
    /**
     * Change users own password
     * 
     * @param PasswordChangeForm $form
     * @param User $user
     * @return boolea
     */
    public function changePassword(PasswordChangeForm $form, User $user);
    
    /**
     * Get user password reset form
     * 
     * @return \User\Form\PasswordResetForm
     */
    public function getPasswordResetForm();
    
    /**
     * Generates a password reset token for the user and send a confirm e-mail
     * 
     * This token is then stored in database and sent to the user's E-mail address. 
     * When the user clicks the link in E-mail message, he is directed to the 
     * set-password page.
     * 
     * @param PasswordResetForm $form
     */
    public function generatePwdResetToken(PasswordResetForm $form);
    
    /**
     * Get user password set form
     * 
     * @return \User\Form\PasswordSetForm
     */
    public function getPasswordSetForm();
    
    /**
     * Set password
     * 
     * @param User $user
     * @param PasswordSetForm $form
     * @return boolean
     */
    public function setPassword(User $user, PasswordSetForm $form);
    
}
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

use User\Entity\Registration;
use User\Form\RegistrationForm;
use User\Form\PasswordSetForm;

/**
 * RegistrationManagerInterface
 *
 * @package User\
 * @subpackage User\Service
 */
interface RegistrationManagerInterface
{
    /**
     * Get registration repository
     * 
     * @return User\Repository\RegistrationInterface
     */
    public function getRepository();
    
    /**
     * Get registration form
     * 
     * @return RegistrationForm
     */
    public function getRegistrationForm();
    
    /**
     * Get password set form
     * 
     * @return PasswordSetForm
     */
    public function getPasswordSetFortm();

    /**
     * Add new registration record to db and send e-mail
     * 
     * @param RegistrationForm $form
     */
    public function addRegistation(RegistrationForm $form);
    
    /**
     * Add new user record to db from registration and form
     * 
     * @param Registration $registration
     * @param PasswordSetForm $form
     * @return boolean
     */
    public function confirmRegistration(Registration $registration, PasswordSetForm $form);
    
}

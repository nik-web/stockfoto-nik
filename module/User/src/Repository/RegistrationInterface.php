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

namespace User\Repository;

use User\Entity\Registration;

/**
 * Describes the interface of the registration repository
 * 
 * @package User
 * @subpackage User\Repository
 */
interface RegistrationInterface
{
    
    /**
     * Persist a new registratio in the system.
     *
     * @param Registration $registration
     * @return boolean
     */
    public function insert(Registration $registration);
    
    /**
     * Find registration by token
     * 
     * @param string $token
     * @return Registration
     */
    public function findByToken($token);
    
    /**
     * Delete a registration from the system.
     *
     * @param Registration $registration Registration to delete.
     * @return bool
     */
    public function delete(Registration $registration);
    
}
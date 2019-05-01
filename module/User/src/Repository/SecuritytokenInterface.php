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

use User\Entity\Securitytoken;

/**
 * Describes the interface of the securitytoken repository
 * 
 * @package User
 * @subpackage User\Repository
 */
interface SecuritytokenInterface
{
    /**
     * Return a single securitytoken.
     * 
     * @param string $identity user auth identity
     * @return Securitytoken|boolean
     */
    public function findByIdentity($identity);
    
    /**
     * Return a single securitytoken.
     * 
     * @param string $identifier
     * @return Securitytoken|boolean
     */
    public function findByIdentifier($identifier);
    
    /**
     * Persist a new securitytoken in the system.
     *
     * @param Securitytoken $securitytoken The securitytoken to insert; may or may not have an identifier.
     * @return boolean
     */
    public function insert(Securitytoken $securitytoken);
    
    /**
     * Update an existing securitytoken in the system.
     *
     * @param Securitytoken $securitytoken The securitytoken to update; must have an identifier.
     */
    public function update(Securitytoken $securitytoken);
    
    /**
     * Delete a securitytoken from the system.
     *
     * @param Securitytoken $securitytoken The securitytoken to delete.
     * @return bool
     */
    public function delete(Securitytoken $securitytoken);
    
}
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

/**
 * Describes the interface of the role repository
 * 
 * @package User
 * @subpackage User\Repository
 */
interface RoleInterface
{
    /**
     * Return a set of all user roles that we can iterate over.
     *
     * Each entry should be a role instance.
     *
     * @return array
     */
    public function findAll();
    
}
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

/**
 * RbacManagerInterface
 *
 * @package User
 * @subpackage User\Service
 */
interface RbacManagerInterface {
    
    /**
     * Initializes the RBAC container.
     */
    public function init();
    
    /**
     * Checks whether the given roles has permission.
     * 
     * @param string|null $identity User auth instance
     * @param string $permission
     * 
     * @return bolean
     */
    public function isGranted($identity, $permission);
    
}

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

use Zend\Authentication\Adapter\AdapterInterface;

/**
 * AdapterInterface used for authenticating user.
 * 
 * @package User
 * @subpackage User\Service
 */
interface AuthAdapterInterface extends AdapterInterface
{
    /**
     * Sets user email address.
     * 
     * @param string $email
     */
    public function setEmail($email);
    
    /**
     * Sets user password.
     * 
     * @param string $password
     */
    public function setPassword($password);
    
}

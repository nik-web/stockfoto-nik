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

use User\Entity\User;

/**
 * Describes the interface of the user repository
 * 
 * @package User
 * @subpackage User\Repository
 */
interface UserInterface
{
    /**
     * Return a set of all user users that we can iterate over.
     *
     * Each entry should be a user instance.
     *
     * @return array
     */
    public function findAll();

    /**
     * Return a single user user.
     *
     * @param  int $id Identifier of the user to return.
     * @return \User\Entity\User $user
     */
    public function find($id);
    
    /**
     * Return a single user.
     * 
     * @param string $email User email adress
     * @return \User\Entity\User $user
     */
    public function findByEmail($email);
    
    /**
     * Return a single user.
     * 
     * @param string $token User password reset token
     * @return \User\Entity\User $user
     */
    public function findByPwdResetToken($token);
    
    /**
     * Insert user role connections to db
     * 
     * @param integer $userId
     * @param array $roleIds
     */
    public function insertUserRoleConnections($userId, $roleIds);
    
    /**
     * Deletete user role connectios
     * 
     * @param integer $userId
     */
    public function deleteUserRoleConnectionsByUserId($userId);

    /**
     * Persist a new user in the system.
     *
     * @param User $user The user to insert; may or may not have an identifier.
     * @return boolean
     */
    public function insert(User $user);

    /**
     * Update an existing user in the system.
     *
     * @param User $user The user to update; must have an identifier.
     * @return int $affectedRows
     */
    public function update(User $user);
    
    /**
     * Delete a user from the system.
     *
     * @param User $user The user to delete.
     * @return bool
     */
    public function delete(User $user);
    
    /**
     * Get role namens from user
     * 
     * @param User $user
     * @return array $roleNames
     */
    public function getRoleNames(User $user);
    
}
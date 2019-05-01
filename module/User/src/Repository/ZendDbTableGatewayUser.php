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

use Zend\Db\TableGateway\TableGateway;
use User\Entity\User;

/**
 * ZendDbTableGatewayUser
 *
 * @package User
 * @subpackage User\Repository
 */
class ZendDbTableGatewayUser implements UserInterface
{
    /**
     * @var TableGateway
     */
    private $tableGateway;

    /**
     * Construct an repository
     * 
     * @param $tableGateway TableGateway
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    /**
     * {@inheritDoc}
     */
    public function findAll()
    {
        $select = $this->tableGateway->getSql()->select();
        $select->order('id DESC');
        $entities = $this->tableGateway->selectWith($select);
        $users = [];
        foreach ($entities as $user) {
            $roles = $this->getRoleNames($user);
            $user->setRoles($roles);
            $users[] = $user;
        }
        
        return $users;
    }
    
    /**
     * {@inheritDoc}
     */
    public function find($id)
    {
        $rowset = $this->tableGateway->select(['id' => (int) $id]);
        // \User\Entity\User
        $user = $rowset->current();
 
        if (! $user instanceof User) {
            return false;
        }
        
        $roles = $this->getRoleNames($user);
        $user->setRoles($roles);
        
        return $user;
    }
    
    /**
     * {@inheritDoc}
     */
    public function findByEmail($email)
    {
        $rowset = $this->tableGateway->select(['email' => $email]);
        $user = $rowset->current();
        if (! $user instanceof User) {
            return false;
        }
        $roles = $this->getRoleNames($user);
        $user->setRoles($roles);
        
        return $user;
    }
    
    /**
     * {@inheritDoc}
     */
    public function findByPwdResetToken($token)
    {
        $rowset = $this->tableGateway->select(['pwd_reset_token' => $token]);
        $user = $rowset->current();
        if (! $user instanceof User) {
            return false;
        }
        $roles = $this->getRoleNames($user);
        $user->setRoles($roles);
        
        return $user;
    }
    
    /**
     * {@inheritDoc}
     */
    public function insertUserRoleConnections($userId, $roleIds)
    {
        $sql = 'INSERT INTO user_role (user_id, role_id) VALUES (?, ?)';
        foreach ($roleIds as $roleId) {
            $this->tableGateway->getAdapter()->query($sql, [$userId, $roleId]);
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function deleteUserRoleConnectionsByUserId($userId)
    {
        $sql = 'DELETE FROM user_role WHERE user_id = ?';
        $this->tableGateway->getAdapter()->query($sql, [$userId,]);
    }

    /**
     * {@inheritDoc}
     */
    public function insert(User $user)
    {
        $data = $user->getArrayCopy();
        unset($data['roles']);
        $affectedRows = $this->tableGateway->insert($data);
        if (1 != $affectedRows) {
            return false;
        }
        // get int last insert id
        $userId = intval($this->tableGateway->getLastInsertValue());
        // Set oly role customer to a new user
        $roleCustemerId = 2;
        $roleIds = [$roleCustemerId,];
        $this->insertUserRoleConnections($userId, $roleIds);
        
        return true;
    }
    
    /**
     * {@inheritDoc}
     */
    public function update(User $user)
    {
        $data = $user->getArrayCopy();
        unset($data['roles']);
        $id = (int) $user->getId();
        $this->tableGateway->update($data,  ['id' => $id]);
    }
    
    /**
     * {@inheritDoc}
     */
    public function delete(User $user)
    {
        $id = (int) $user->getId();
        $where = ['id' => $id,];
        $this->tableGateway->delete($where);
    }
    
    /**
     * Get role namens from user
     * 
     * @param User $user
     * @return array $roleNames
     */
    public function getRoleNames(User $user)
    {
        $adapter = $this->tableGateway->getAdapter();
        $sql = 'SELECT name FROM role'
            . ' LEFT JOIN (user_role INNER JOIN user ON user_role.user_id = user.id)'
            . ' ON user_role.role_id = role.id  WHERE user.id = ?';
        $userId = $user->getId();
        $resultSet= $adapter->query($sql, [$userId]);
        
        $roleNames = [];
        foreach ($resultSet as $row) {
            $roleNames[] = $row->name;
        }
        
        return $roleNames;
    }
    
    /**
     * Get role ids by user
     * 
     * @param User $user
     * @return array $roleIds
     */
    public function getRoleIds(User $user)
    {
        $adapter = $this->tableGateway->getAdapter();
        $sql = 'SELECT role_id FROM role'
            . ' LEFT JOIN (user_role INNER JOIN user ON user_role.user_id = user.id)'
            . ' ON user_role.role_id = role.id  WHERE user.id = ?';
        $userId = $user->getId();
        $resultSet= $adapter->query($sql, [$userId]);
        
        $roleIds = [];
        foreach ($resultSet as $row) {
            $roleIds[] = $row->role_id;
        }
        return $roleIds;
    }
}
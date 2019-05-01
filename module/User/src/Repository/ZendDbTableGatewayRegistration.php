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
use User\Entity\Registration;

/**
 * ZendDbTableGatewayRegistration
 *
 * @package User
 * @subpackage User\Repository
 */
class ZendDbTableGatewayRegistration implements RegistrationInterface
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
    public function insert(Registration $registration)
    {
        $data = $registration->getArrayCopy();
        $affectedRows = $this->tableGateway->insert($data);
        if (1 != $affectedRows) {
            
            return false;
        }
        
        return true;
    }
    
    /**
     * {@inheritDoc}
     */
    public function findByToken($token)
    {
        $rowset = $this->tableGateway->select(['token' => $token]);
        $entity = $rowset->current();

        return $entity;
    }
    
    /**
     * {@inheritDoc}
     */
    public function delete(Registration $registration)
    {
        $id = (int) $registration->getId();
        $where = ['id' => $id,];
        $this->tableGateway->delete($where);
    }
}
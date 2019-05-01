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
use User\Entity\Securitytoken;

/**
 * Securitytoken
 *
 * @package User
 * @subpackage User\Repository
 */
class ZendDbTableGatewaySecuritytoken implements SecuritytokenInterface
{
    /**
     * @var TableGatewayInterface
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
    public function findByIdentity($identity)
    {
        $rowset = $this->tableGateway->select(['identity' => $identity]);
        $securitytoken = $rowset->current();
        if (! $securitytoken instanceof Securitytoken) {
            return false;
        }
        
        return $securitytoken;
    }
    
    /**
     * {@inheritDoc}
     */
    public function findByIdentifier($identifier)
    {
        $rowset = $this->tableGateway->select(['identifier' => $identifier]);
        $securitytoken = $rowset->current();
        if (! $securitytoken instanceof Securitytoken) {
            return false;
        }
        
        return $securitytoken;
    }

    /**
     * {@inheritDoc}
     */
    public function insert(Securitytoken $securitytoken)
    {
        $data = $securitytoken->getArrayCopy();
        $affectedRows = $this->tableGateway->insert($data);
        if (1 != $affectedRows) {
            return false;
        }
        
        return true;
    }
    
    /**
     * {@inheritDoc}
     */
    public function update(Securitytoken $securitytoken)
    {
        $data = $securitytoken->getArrayCopy();
        $id = (int) $securitytoken->getId();
        $this->tableGateway->update($data,  ['id' => $id]);
    }
    
    /**
     * {@inheritDoc}
     */
    public function delete(Securitytoken $securitytoken)
    {
        $id = (int) $securitytoken->getId();
        $where = ['id' => $id,];
        $this->tableGateway->delete($where);
    }
}
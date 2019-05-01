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

/**
 * ZendDbTableGatewayRole
 *
 * @package User
 * @subpackage User\Repository
 */
class ZendDbTableGatewayRole implements RoleInterface
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
    public function findAll()
    {
        $entities = $this->tableGateway->select();
        return $entities;
    }
}
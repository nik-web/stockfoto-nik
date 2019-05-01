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

namespace User\Repository\Factory;


use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface; // Configuring the default adapter
use Zend\Db\ResultSet\ResultSet;
use User\Entity\User;
use Zend\Db\TableGateway\TableGateway;
use User\Repository\ZendDbTableGatewayUser;

/**
 * ZendDbTableGatewayUserFactory
 *
 * @package User
 * @subpackage User\Repository\Factory
 */
class ZendDbTableGatewayUserFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return ZendDbTableGatewayReadUser
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        
        $table = 'user';
        $adapter = $container->get(AdapterInterface::class); // default adapter
        $features = null;
        $resultSet = new ResultSet();
        $arrayObjectPrototype = new User(null, null, null, null, null, null, null, null, null, null);
        $resultSet->setArrayObjectPrototype($arrayObjectPrototype);
        $tableGateway = new TableGateway($table, $adapter, $features, $resultSet);
        
        return new ZendDbTableGatewayUser($tableGateway); 
    }
}
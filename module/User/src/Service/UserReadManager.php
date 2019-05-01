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

use User\Repository\UserInterface;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;

/**
 * UserReadManager
 *
 * @package User
 * @subpackage User\Service
 */
class UserReadManager implements UserReadManagerInterface
{
    /**
     * @var UserInterface
     */
    private $repository;

    /**
     * Constructs the service.
     * 
     * @param UserInterface $repository
     */
    public function __construct(UserInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getRepository()
    {
        return $this->repository;
    }
    
    /**
     * {@inheritDoc}
     */
    public function paginateEntities($entities, $itemContPerPage, $pageRange)
    {
        $paginatorArrayAdapter = new ArrayAdapter($entities);
        $paginator = new Paginator($paginatorArrayAdapter);
        $paginator->setDefaultItemCountPerPage($itemContPerPage);
        $paginator->setPageRange($pageRange);
        
        //PaginationControl::setDefaultViewPartial('pagination_control_default.phtml');
        
        return $paginator;  
    }
}
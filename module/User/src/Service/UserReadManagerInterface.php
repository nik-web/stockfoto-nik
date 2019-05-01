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
 * UserReadManagerInterface
 *
 * @package User
 * @subpackage User\Service
 */
interface UserReadManagerInterface
{
    /**
     * return \User\Repository\UserInterface
     */
    public function getRepository();
    
    /**
     * Pagenate entities
     * 
     * @param array $entities
     * @param integer $itemContPerPage
     * @param integer $pageRange
     * @return \Zend\Paginator\Paginator
     */
    public function paginateEntities($entities, $itemContPerPage, $pageRange);
  
}
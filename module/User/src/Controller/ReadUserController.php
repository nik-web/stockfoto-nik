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

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use User\Service\UserReadManagerInterface;
use User\Entity\User;
use Zend\View\Model\ViewModel;

/**
 * ReadUserController
 *
 * @package User
 * @subpackage User\Cotroller
 */
class ReadUserController extends AbstractActionController
{
    /**
     * @var UserReadManagerInterface 
     */
    private $manager;

    /**
     * Construct a read user controller
     * 
     * @param UserReadManagerInterface
     */
    public function __construct($manager)
    {
        $this->manager = $manager;
    }
    
    /**
     * This action will display a web page containing the list of all users.
     * 
     * @return ViewModel
     */
    public function indexAction()
    {
        $page = $this->params()->fromRoute('page');
        $users = $this->manager->getRepository()->findAll();
        $itemContPerPage = 3;
        $pageRange = 7;
        $paginator = $this->manager
            ->paginateEntities($users, $itemContPerPage, $pageRange);
        $paginator->setCurrentPageNumber($page);
        
        return new ViewModel(['paginator' => $paginator,]);
    }
    
    /**
     * The "detail" action displays a page allowing to view user's details.
     * 
     * @return ViewModel
     */
    public function detailAction() 
    {
        $id = $this->params()->fromRoute('id');
        $user = $this->manager->getRepository()->find($id);
        
        if (!$user instanceof User) {
            $locale = $this->params()->fromRoute('locale');
            
            return $this->redirect()
                ->toRoute('read-users', ['locale' => $locale]);
        }

        return new ViewModel(['user' => $user,]);
    }
    
    /**
     * The "account" action displays a page to view logged user datails.
     */
    public function accountAction()
    {
        $locale = $this->params()->fromRoute('locale');
        if (!$this->identity()) {
            
            return $this->redirect()
                ->toRoute('login-user', ['locale' => $locale]);
        }
        $user = $this->manager->getRepository()->findByEmail($this->identity());
        if (!$user instanceof User) {
            $locale = $this->params()->fromRoute('locale');
            
            return $this->redirect()
                ->toRoute('logout-user', ['locale' => $locale]);
        }
        
        return new ViewModel(['user' => $user,]);
    }
}
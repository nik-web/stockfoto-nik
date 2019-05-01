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

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * IndexController
 *
 * @package Application
 * @subpackage Application\Controller
 */
class IndexController extends AbstractActionController
{
    
    /**
     * This action will display the home web page.
     * 
     * @return ViewModel
     */
    public function indexAction()
    {
        return new ViewModel();
    }
    
    /**
     * This action will display the imprint web page.
     * 
     * @return ViewModel
     */
    public function imprintAction()
    {
        return new ViewModel();
    }
    
    /**
     * This action will display the privacy policy web page.
     * 
     * @return ViewModel
     */
    public function privacyPolicyAction()
    {
        return new ViewModel();
    }
}
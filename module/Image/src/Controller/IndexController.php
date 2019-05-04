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

namespace Image\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * IndexController
 * 
 * @package Image
 * @subpackage Image\Controller
 */
class IndexController extends AbstractActionController
{
    /**
     * Index action
     * 
     * This is the default "index" action of the controller. 
     * It displays the homepage of the image module.
     * 
     * @return ViewModel
     */
    public function indexAction() 
    {
        return new ViewModel([]);
    }
}

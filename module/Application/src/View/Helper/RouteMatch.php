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

namespace Application\View\Helper;

use Zend\Http\Request;
use Zend\Router\RouteStackInterface;
use Zend\View\Helper\AbstractHelper;



/**
 * Application route match view helper
 *
 * @package Application
 * @subpackage Application\View\Helper
 */
class RouteMatch extends AbstractHelper
{
    /**
     * RouteStckIterface instanze
     *
     * @var RouteStackInterface $router 
     */
    protected $router;
    
    /**
     * @var Request $request
     */
    protected $request;

    /**
     * Constructor
     * 
     * @param RouteStackInterface  $router
     * @param Request $request
     */
    
    public function __construct(RouteStackInterface $router, Request $request)
    {
        $this->router = $router;
        $this->request = $request;
    }
    
    /**
     * @return \Zend\Router\RouteMatch
     */
    public function __invoke()
    {
        return $this->router->match($this->request);
    }
}

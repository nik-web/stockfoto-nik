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

use Application\ValueObject\Owner as ApplicationOwner;
use Zend\View\Helper\AbstractHelper;

/**
 * Application ower view helper
 *
 * @package Application
 * @subpackage Application\View\Helper
 */
class Owner extends AbstractHelper
{
    public function renderItem($itemKey)
    {
      $items = ApplicationOwner::getItems();
      $item = $items[$itemKey];
      
      return $item;
    }
    
}

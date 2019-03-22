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

use Application\ValueObject\Data as ApplicationData;
use Zend\View\Helper\AbstractHelper;

/**
 * Application data view helper
 *
 * @package Application
 * @subpackage Application\View\Helper
 */
class Data extends AbstractHelper
{
    /**
     * Render application name
     * 
     * @return string
     */
    public function renderName()
    {
      return ApplicationData::NAME;
    }
    
}

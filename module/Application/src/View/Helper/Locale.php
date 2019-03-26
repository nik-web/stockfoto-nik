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

use Zend\View\Helper\AbstractHelper;

/**
 * Applicatio locale view helper
 *
 * @package Application
 * @subpackage Application\View\Helper
 */
class Locale extends AbstractHelper
{
    /**
     *
     * @var string $locale
     */
    protected $locale;
    
    /**
     * Constructor
     * 
     * @param string $locale
     */
    
    public function __construct($locale)
    {
        $this->locale = $locale;
    }
    
    /**
     * Get locale and output it
     * 
     * @return string
     */
    public function __invoke()
    {
        return $this->locale;
    }
}

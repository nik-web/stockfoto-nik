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

namespace Application\Service\Factory;

use Zend\Navigation\Service\AbstractNavigationFactory;

/**
 * MainNavFactory
 *
 * @package Application
 * @subpackage Application\Service\Factory
 */
class MainNavFactory extends AbstractNavigationFactory
{
    /**
     * Returns config name of the main navigation
     * 
     * @return string
     */
    public function getName()
    {
        return 'main_nav';
    }
}
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

namespace User\Service\Factory;

use Zend\Navigation\Service\AbstractNavigationFactory;

/**
 * SingInNavFactory
 *
 * @package User
 * @subpackage User\Service\Factory
 */
class SingInNavFactory extends AbstractNavigationFactory
{
    /**
     * Returns config name of the sing in navigation
     * 
     * @return string
     */
    public function getName()
    {
        return 'sing_in_nav';
    }
}
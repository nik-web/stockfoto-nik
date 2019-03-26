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

namespace Application\ValueObject;

/**
 * Application Data
 * 
 * @package Application
 * @subpackage Application\ValueObject
 */

class Data {
    
    const NAME = 'stockfoto-nik';
    
    const MY_FALLBACK_LOCALE = 'de_DE';
    
    const MY_LOCALES = [self::MY_FALLBACK_LOCALE, 'en_US', 'ru_RU'];
    // if only one locale on homepage
    //const MY_LOCALES = [self::MY_FALLBACK_LOCALE,];  
}
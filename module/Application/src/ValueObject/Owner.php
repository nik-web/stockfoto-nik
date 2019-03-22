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
 * Application Owner
 * 
 * @package Application
 * @subpackage Application\ValueObject
 */

class Owner {
    
    const FORENAME = 'Niklaus';
    
    const SURNAME = 'Höpfner';
    
    const STREET = 'Wittelsbacherstraße';
    
    const HOUSE_NUMBER = '25c';
    
    const POSTCODE = '90475';
    
    const CITY = 'Nürnberg';
    
    const PHONE_NUMBER = '';
    
    const MOBILE_PHONE_NUMBER = '+49 162 6178597';

    const FAX_NUMBER = '';
    
    const CONTACT_EMAIL_ADDRESS = 'kontakt@nik-web.net';
    
    const TAX_ID_NUMBER = 'DE294394395';
    
    /**
     * Applicatio owner items
     *
     * @var array
     */
    protected static $items = [
        'forename'         => self::FORENAME,
        'surname'          => self::SURNAME,
        'street'           => self::STREET,
        'house_number'     => self::HOUSE_NUMBER,
        'postcode'         => self::POSTCODE,
        'city'             => self::CITY,
        'phone_number'     => self::PHONE_NUMBER,
        'mob_phone_number' => self::MOBILE_PHONE_NUMBER,
        'fax_number'       => self::FAX_NUMBER,
        'contact_mail'     => self::CONTACT_EMAIL_ADDRESS,
        'tax_id_number'    => self::TAX_ID_NUMBER,
    ];
    
    /**
     * Get application owner items
     * 
     * @return array
     */
    public static function getItems()
    {
        return self::$items;
    }
}

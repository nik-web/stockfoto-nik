<?php
/**
 * This file is part of Nik Test
 * 
 * List of enabled modules for this application.
 * This should be an array of module namespaces used in the application.
 * 
 * @package    Nik Test
 * @subpackage Config
 * @author     Niklaus Höpfner <author@nik-web.net>
 * @copyright  Copyright (c) Niklaus Höpfner
 * @version    1.0.0
 * @since      1.0.0
 */

return [
    'Zend\Paginator',
    'Zend\Navigation',
    //'Zend\Mvc\Plugin\FilePrg',
    'Zend\Mvc\Plugin\FlashMessenger',
    'Zend\Mvc\Plugin\Identity',
    //'Zend\Mvc\Plugin\Prg',
    //'Zend\Cache',
    'Zend\Session',
    //'Zend\Mail',
    'Zend\Form',
    'Zend\InputFilter',
    'Zend\Filter',
    'Zend\Hydrator',
    'Zend\Mvc\I18n',
    'Zend\I18n',
    'Zend\Db',
    'Zend\Router',
    'Zend\Validator',
    'Application',
    'User',
    'Image',
];

<?php
/**
 * stockfoto-nik cms
 * 
 * Application module translate error index template en_US
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Application;

// Individual part of the placeholder
$path = '_module_application_view_error_index';

return array(
    'title' . $path                    => 'An error occurred',
    'meta_description_content' . $path => 'An error occurred',
    'meta_keywords_content' . $path    => 'error, occurred, Skeleton',
    'h1' . $path                       => 'An error occurred',
    'h2' . $path . '_add_information'  => 'Additional information',
    'dt' . $path . '_file'             => 'File',
    'dt' . $path . '_message'          => 'Message',
    'dt' . $path . '_stack_trace'      => 'Stack trace',
    'h2' . $path . '_exceptions'       => 'Previous exceptions',
    'li' . $path . '_more_exceptions'  => 'There may be more exceptions, but we '
        . 'have no enough memory to proccess it.',
    'h3' . $path . '_no_exceptions'    => 'No Exception available',
);
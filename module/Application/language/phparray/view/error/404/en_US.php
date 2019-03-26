<?php
/**
 * This file is part of Nik Test
 * 
 * Application translate error 404 template en_GB
 * 
 * @package    Nik Test
 * @subpackage Application
 * @author     Niklaus Höpfner <author@nik-web.net>
 * @copyright  Copyright (c) Niklaus Höpfner
 * @version    1.0.0
 * @since      1.0.0
 */

// Individual part of the placeholder
$path = '_module_application_view_error_404';

return array(
    'title' . $path                           => '404 Error by %s',
    'meta_description_content' . $path        => '404 error, the page was not '
        . 'found.',
    'meta_keywords_content' . $path           => 'error, 404, not found',
    'h1' . $path                              => 'A 404 error occurred',
    'p' . $path . '_message_unable'           => 'The requested controller was '
        . 'unable to dispatch the request.',
    'p' . $path . '_message_not_mapped'       => 'The requested controller could '
        . 'not be mapped to an existing controller class.',
    'p' . $path . '_message_not_dispatchable' => 'The requested controller was '
        . 'not dispatchable.',
    'p' . $path . '_message_not_matched'      => 'The requested URL could not '
        . 'be matched by routing.',
    'p' . $path . '_message_not_determine'    => 'We cannot determine at this '
        . 'time why a 404 was generated.',
    'dt' . $path . '_controller'              => 'Controller',
    'dd' . $path . '_resolves'                => 'resolves to %s',
    'h2' . $path . '_add_information'         => 'Additional information',
    'dt' . $path . '_file'                    => 'File',
    'dt' . $path . '_message'                 => 'Message',
    'dt' . $path . '_stack_trace'             => 'Stapelüberwachung',
    'h2' . $path . '_exceptions'              => 'Previous exceptions',
    'li' . $path . '_more_exceptions'         => 'There may be more exceptions, '
        . 'but we have no enough memory to proccess it.',
    'h3' . $path . '_no_exceptions'           => 'No Exception available',
);
<?php
/**
 * stockfoto-nik cms
 * 
 * Application module translate error index template de_DE
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
    'title' . $path                    => 'Ein Fehler ist aufgetreten',
    'meta_description_content' . $path => 'Ein Fehler ist aufgetreten.',
    'meta_keywords_content' . $path    => 'Fehler, aufgetreten, Webanwendung',
    'h1' . $path                       => 'Ein Fehler ist aufgetreten',
    'h2' . $path . '_add_information'  => 'Zusätzliche Information',
    'dt' . $path . '_file'             => 'Datei',
    'dt' . $path . '_message'          => 'Meldung',
    'dt' . $path . '_stack_trace'      => 'Stapelüberwachung',
    'h2' . $path . '_exceptions'       => 'Vorherige Ausnahmen',
    'li' . $path . '_more_exceptions'  => 'Es kann mehr Ausnahmen geben, aber '
        . 'wir haben nicht genügend Speicher, sie zu verarbeiten.',
    'h3' . $path . '_no_exceptions'    => 'Es ist keine Ausnahme verfügbar',
);
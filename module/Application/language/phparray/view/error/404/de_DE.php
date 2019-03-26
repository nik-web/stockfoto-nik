<?php
/**
 * stockfoto-nik cms
 * 
 * Application module error 404 template de_DE
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Application;


//Individual part of the placeholder
$path = '_module_application_view_error_404';

return array(
    'title' . $path                           => '404 Fehler bei %s',
    'meta_description_content' . $path        => '404 Fehler, die Seite wurde nicht gefunden.',
    'meta_keywords_content' . $path           => 'Fehler, nicht gefunden, 404',
    'h1' . $path                              => 'Es trat ein 404 Fehler auf',
    'p' . $path . '_message_unable'           => 'Der angeforderte Controller war nicht in der Lage die Anfrage zu verarbeiten.',
    'p' . $path . '_message_not_mapped'       => 'Der angeforderte Controller konnte keiner Controller Klasse zugeordnet werden.',
    'p' . $path . '_message_not_dispatchable' => 'Der angeforderte Controller ist nicht aufrufbar.',
    'p' . $path . '_message_not_matched'      => 'Für die angeforderte URL konnte keine Übereinstimmung gefunden werden.',
    'p' . $path . '_message_not_determine'    => 'Zu diesem Zeitpunkt ist es uns nicht möglich zu bestimmen, warum ein 404 Fehler aufgetreten ist.',
    'dt' . $path . '_controller'              => 'Controller',
    'dd' . $path . '_resolves'                => 'wird aufgelöst in %s',
    'h2' . $path . '_add_information'         => 'Zusätzliche Information',
    'dt' . $path . '_file'                    => 'Datei',
    'dt' . $path . '_message'                 => 'Meldung',
    'dt' . $path . '_stack_trace'             => 'Stapelüberwachung',
    'h2' . $path . '_exceptions'              => 'Vorherige Ausnahmen',
    'li' . $path . '_more_exceptions'         => 'Es kann mehr Ausnahmen geben, aber wir haben nicht genügend Speicher, sie zu verarbeiten.',
    'h3' . $path . '_no_exceptions'           => 'Es ist keine Ausnahme verfügbar',
);
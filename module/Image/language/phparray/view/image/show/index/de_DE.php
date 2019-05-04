<?php
/**
 * stockfoto-nik cms
 * 
 * Image module translate show index template de_DE
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Image;

//Individual part of the placeholder
$path = '_module_image_view_show_index';

return [
    'title' . $path                        => 'Bildarchiv, alle Bilder dieser Webawendung',
    'meta_description_content' . $path     => 'Bildarchiv, alle Bilder dieser Webawendung auf Seiten verteilt.',
    'meta_keywords_content' . $path        => 'Bilder, Bildarchiv, Dateien, Bilddateien, Webanwendung',
    'main_heading' . $path                 => 'Alle Bilder',
    'header_paragraph' . $path . '_count'  => 'Das Bildarchiv enthält %s Bilder auf %s Seiten.',
    'paragraph' . $path . '_no_files'      => 'Es sind keine Dateien zum Anzeigen vorhanden.',
    'image_alt' . $path . '_image_file'    => 'Bilddatei: %s',
    'link_title' . $path . '_image_file'   => 'Das Bild %s in voller Größe anzeigen.',
    'link' . $path . '_image_file'         => 'Volle Bildgröße',
    'link_title' . $path . '_image_remove' => 'Das Bild %s aus dem Bildarchiv löschen.',
    'link' . $path . '_image_remove'       => 'Bild löschen',
    'link_title' . $path . '_image_start'  => 'Zur Startseite des Bildmoduls',
    'link' . $path . '_image_start'        => 'Bild Start',
    'link_title' . $path . '_image_upload' => 'Weitere Bilder in das Bildarchiv hochladen.',
    'link' . $path . '_image_upload'       => 'Mehr hochladen',
];
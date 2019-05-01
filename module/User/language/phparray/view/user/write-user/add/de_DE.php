<?php
/**
 * stockfoto-nik cms
 * 
 * User module translate write-user add template de_DE
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace User;

//Individual part of the placeholder
$path = '_module_user_view_write-user_add';

return [
    'title' . $path                             => 'Einen neuen Nutzer zur Webanwendung hinzufügen',
    'meta_description_content' . $path          => 'Einen neuen Nutzer zu dieser Webanwendung hinzufügen',
    'meta_keywords_content' . $path             => 'Nutzer, hinzugügen, Webanwendug',
    'main_heading' . $path                      => 'Nutzer-Konto anlegen',
    'form_fieldset_legend' . $path              => 'Nutzer-Daten',
    'form_alias_description' . $path            => 'Der Nutzername muss min. drei und max. 128 Zeichen lang sein!',
    'form_email_description' . $path            => 'Die E-Mail Adresse im Basisformat "local-part@hostname" eingeben!',
    'form_password_description' . $path         => 'Das Passwort muss min. 6 und max. 64 Zeichen lang sein!',
    'form_confirm_password_description' . $path => 'Die Eingabe des Passworts wiederholen!',
];
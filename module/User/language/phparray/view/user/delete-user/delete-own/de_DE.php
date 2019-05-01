<?php
/**
 * stockfoto-nik cms
 * 
 * User module translate delete-user delete-own template de_DE
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace User;

//Individual part of the placeholder
$path = '_module_user_view_delete-user_delete-own';

return [
    'title' . $path                             => 'Mein Konto bei dieser Webanwendung löschen',
    'meta_description_content' . $path          => 'Mein Konto und alle meine weiteren Daten bei dieser Webanwendung löschen.',
    'meta_keywords_content' . $path             => 'Nutzer, Daten, Konto',
    'main_heading' . $path                      => 'Mein Konto bei %s löschen',
    'heading_account-data' . $path              => 'Konto-Daten',
    'label_alias' . $path                       => 'Nutzername:',
    'label_email' . $path                       => 'E-Mail Adresse:',
    'label_password' . $path                    => 'Password:',
    'legend' . $path . '_account_delete'        => 'Konto löschen',
    'form_current_password_description' . $path => 'Das Passwort muss min. 6 und max. 64 Zeichen lang sein!',
];
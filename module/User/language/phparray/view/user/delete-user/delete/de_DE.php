<?php
/**
 * stockfoto-nik cms
 * 
 * User module translate delete-user delete template de_DE
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace User;

//Individual part of the placeholder
$path = '_module_user_view_delete-user_delete';

return [
    'title' . $path                      => 'Dieses Konto bei dieser Webanwendung löschen',
    'meta_description_content' . $path   => 'Dieser Konto und alle zugehörigen Daten bei dieser Webanwendung löschen.',
    'meta_keywords_content' . $path      => 'Nutzer, Daten, Konto',
    'main_heading' . $path               => 'Nutzerkonto löschen',
    'heading_account-data' . $path       => 'Konto-Daten',
    'label_alias' . $path                => 'Nutzername:',
    'label_email' . $path                => 'E-Mail Adresse:',
    'label_password' . $path             => 'Password:',
    'label_status' . $path               => 'Status:',
    'value_status' . $path . '_active'   => 'aktiv',
    'value_status' . $path . '_blocked'  => 'gesperrt',
    'label_created-on' . $path           => 'Agemeldet am:',
    'label_updated-on' . $path           => 'Bearbeitet am:',
    'label_roles' . $path                => 'Rolen:',
    'legend' . $path . '_account_delete' => 'Konto löschen',
];
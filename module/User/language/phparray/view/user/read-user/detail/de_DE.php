<?php
/**
 * stockfoto-nik cms
 * 
 * User module translate read-user detail template de_DE
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace User;

//Individual part of the placeholder
$path = '_module_user_view_read-user_detail';

return [
    'title' . $path                          => 'Konto eines Nutzers',
    'meta_description_content' . $path       => 'Konto eies Nutzers dieser Webanwendung',
    'meta_keywords_content' . $path          => 'Konto, Nutzer, Benutzer, Webanwendug',
    'main_heading' . $path                   => 'Nutzerkonto',
    'heading_account-data' . $path           => 'Konto-Daten',
    'label_alias' . $path                    => 'Nutzername:',
    'label_email' . $path                    => 'E-Mail Adresse:',
    'label_password' . $path                 => 'Password:',
    'label_status' . $path                   => 'Status:',
    'value_status' . $path . '_active'       => 'aktiv',
    'value_status' . $path . '_blocked'      => 'gesperrt',
    'label_created-on' . $path               => 'Agemeldet am:',
    'label_updated-on' . $path               => 'Bearbeitet am:',
    'label_roles' . $path                    => 'Rolen:',
    'link_title' . $path . '_cancel'         => 'Zurück zu den Nutzerkonten.',
    'link' . $path . '_cancel'               => 'Abbrechen',
    'heading_account-activities' . $path     => 'Aktivitäten',
    'link_title' . $path . '_update_account' => 'Dieses Nutzerkonto durch den Admin bearbeiten!',
    'link' . $path . '_update_account'       => 'Dieses Nutzerkonto bearbeiten',
    'link_title' . $path . '_delete_account' => 'Dieses Nutzerkonto durch den Admin löschen!',
    'link' . $path . '_delete_account'       => 'Dieses Nutzerkonto löschen',
];
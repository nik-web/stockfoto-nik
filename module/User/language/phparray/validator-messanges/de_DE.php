<?php
/**
 * stockfoto-nik cms
 * 
 * User module translate form validator messanges de_DE
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace User;

return [
    'user_alias_NotEmpty::IS_EMPTY'                   => 'Ein Nutzername ist erforderlich, dieser darf nicht leer sein!',
    'user_alias_StringLength::TOO_SHORT'              => 'Der Nutzername muss mindextens drei Zeichen lang sein!',
    'user_alias_StringLength::TOO_LONG'               => 'Der Nutzername darf maximal 128 Zeichen lang sein!',
    'user_alias_Db_AbstractDb::ERROR_RECORD_FOUND'    => 'Eine Anmeldung mit diesem Benutzernamen ist bereits vornaden!',
    'user_email_NotEmpty::IS_EMPTY'                   => 'Eine E-Mail Adresse ist erforderlich!',
    'user_email_StringLength::TOO_SHORT'              => 'Die E-Mail Adresse muss mindextens 5 Zeichen lang sein!',
    'user_email_StringLength::TOO_LONG'               => 'Die E-Mail Adresse darf maximal 128 Zeichen lang sein!',
    'user_email_EmailAddress::INVALID_FORMAT'         => 'Die Eingabe ist keine gültige E-Mail Adresse! Verwenden Sie das Basisformat local-part@hostname.',
    'user_email_Db_AbstractDb::ERROR_RECORD_FOUND'    => 'Eine Anmeldung mit dieser E-Mail Adresse ist bereits vornaden!',
    'user_email_Db_AbstractDb::ERROR_NO_RECORD_FOUND' => 'Diese E-Mail Adresse wurde nicht gefunden!',
    'user_password_NotEmpty::IS_EMPTY'                => 'Eine Eingabe des Passworts ist erforderlich!',
    'user_password_StringLength::TOO_SHORT'           => 'Das Passwort muss mindextens 6 Zeichen lang sein!',
    'user_password_StringLength::TOO_LONG'            => 'Das Passwort darf maximal 64 Zeichen lang sein!',
    'user_confirm_password_NotEmpty::IS_EMPTY'        => 'Eine Bestätigung des Passworts ist erforderlich!',
    'user_confirm_password_Identical::NOT_SAME'       => 'Die Bestätigung des Passworts ist nicht korrekt!',
    'user_status_InArray::NOT_IN_ARRAY'               => 'Diese Statuseingabe ist nicht möglich!',
];
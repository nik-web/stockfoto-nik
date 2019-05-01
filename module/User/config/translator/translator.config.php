<?php
/**
 * stockfoto-nik cms
 * 
 * User module translator configuration
 * 
 * The default locale if none is provided.
 * Translation file patterns, which include: the translation source type
 * (e.g., gettext, phparray, ini)
 * The base directory in which they are stored.
 * File pattern for identifying the files to use.
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace User;

use Application\ValueObject\Data;

return [
    'locale' => Data::MY_FALLBACK_LOCALE,
    'translation_file_patterns' => [
        [
            'type'     => 'phparray',
            'base_dir' => USER_MODULE_ROOT . '/language/phparray',
            'pattern'  => '%s.php',
        ],
    ],
];
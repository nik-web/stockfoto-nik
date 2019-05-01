<?php
/**
 * stockfoto-nik cms
 * 
 * Application module template map configuration
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Application;

use Zend\Stdlib\ArrayUtils;

$viewPathLayot = APPLICATION_MODULE_ROOT . '/view/layout/';
$viewPathError = APPLICATION_MODULE_ROOT . '/view/error/';
$viewPathIndex = APPLICATION_MODULE_ROOT . '/view/application/index/';
$viewPathPartials = APPLICATION_MODULE_ROOT . '/view/partials/';
$viewPathCompoents = APPLICATION_MODULE_ROOT . '/view/components/';

$layoutSegments = include APPLICATION_MODULE_ROOT
    . '/config/view_manager/layout_segments.config.php';

$templateMap = [
    'layout/layout'                           => $viewPathLayot . 'layout.phtml',
    'error/404'                               => $viewPathError . '404.phtml',
    'error/index'                             => $viewPathError . 'index.phtml',
    'application/index/index'                 => $viewPathIndex . 'index.phtml',
    'application/index/imprint'               => $viewPathIndex . 'imprint.phtml',
    'application/index/privacy-policy'        => $viewPathIndex . 'privacy-policy.phtml',
    'partials/nav-bars/brand_default.phtml'   => $viewPathPartials . 'nav-bars/brand_default.phtml',
    'partials/nav-bars/main_default.phtml'    => $viewPathPartials . 'nav-bars/main_default.phtml',
    'partials/nav-bars/meta_default.phtml'    => $viewPathPartials . 'nav-bars/meta_default.phtml',
    'partials/nav-bars/pagination_control_default.phtml' => $viewPathPartials . 'nav-bars/pagination_control_default.phtml',
    'components/application_owner_data.phtml' => $viewPathCompoents . 'application_owner_data.phtml',
    'components/locate_nav.phtml'             => $viewPathCompoents . 'locate_nav.phtml',
];
// Merge two arrays and return
return ArrayUtils::merge($templateMap, $layoutSegments);
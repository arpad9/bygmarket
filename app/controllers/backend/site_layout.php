<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
/* FIXME: Obsolete code. Must be removed after theme editor is completely integrated */
    $suffix = '';

    if ($mode == 'update_customization_mode') {

        if (!empty($_REQUEST['customization_modes'])) {
            fn_update_customization_mode($_REQUEST['customization_modes']);
        }

        $suffix = '.design_mode';
    }

    return array(CONTROLLER_STATUS_OK, "site_layout" . $suffix);
/* /FIXME: Obsolete code. Must be removed after theme editor is completely integrated */
}

if ($mode == 'design_mode') {

    Registry::get('view')->assign('customization_modes', fn_get_customization_modes());

} elseif ($mode == 'enable_theme_editor_mode' || $mode == 'enable_design_mode') {
    if (fn_allowed_for('ULTIMATE') && Registry::ifGet('runtime.company_id', 0) == 0) {
        fn_set_notification('W', __('warning'), __('text_select_vendor'));

        $return_url = !empty($_REQUEST['return_url']) ? $_REQUEST['return_url'] : '';

        return array(CONTROLLER_STATUS_REDIRECT, fn_url($return_url));
    } else {
        if ($mode == 'enable_theme_editor_mode') {
            fn_update_customization_mode(array(
                'theme_editor' => 'enable',
                'design' => 'disable'
            ));
        } else {
            fn_update_customization_mode(array(
                'design' => 'enable',
                'theme_editor' => 'disable'
            ));
        }

        if (fn_allowed_for('ULTIMATE') && Registry::get('runtime.company_id') && !Registry::get('runtime.simple_ultimate')) {
            $extra_url = '&switch_company_id=' . Registry::get('runtime.company_id');
        } else {
            $extra_url = '';
        }

        $url = 'profiles.act_as_user?user_id=' . $auth['user_id'] . '&area=C' . $extra_url;

        return array(CONTROLLER_STATUS_REDIRECT, fn_url($url));
    }

}

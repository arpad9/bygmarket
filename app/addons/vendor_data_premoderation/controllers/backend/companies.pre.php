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
    if (($mode == 'add' || $mode == 'update') && !empty($_REQUEST['company_data'])) {
        if (Registry::get('runtime.company_id')) {
            unset($_REQUEST['company_data']['pre_moderation'], $_POST['company_data']['pre_moderation']);
            unset($_REQUEST['company_data']['pre_moderation_edit'], $_POST['company_data']['pre_moderation_edit']);
            unset($_REQUEST['company_data']['pre_moderation_edit_vendors'], $_POST['company_data']['pre_moderation_edit_vendors']);
        }
    }
}

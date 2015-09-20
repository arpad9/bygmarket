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

$schema = array (
    array (
        'option_id' => 1,
        'name' => 'date_of_birth',
        'description' => __('date_of_birth'),
        'value' => '',
        'option_type' =>  'D',
        'position' => 10,
    ),
    array (
        'option_id' => 2,
        'name' => 'last4ssn',
        'description' => __('last4ssn'),
        'value' => '',
        'option_type' =>  'I',
        'position' => 20,
    ),
    array (
        'option_id' => 3,
        'name' => 'phone',
        'description' => __('phone'),
        'value' => '',
        'option_type' =>  'I',
        'position' => 30,
    ),
    array (
        'option_id' => 4,
        'name' => 'passport_number',
        'description' => __('passport_number'),
        'value' => '',
        'option_type' =>  'I',
        'position' => 40,
    ),
    array (
        'option_id' => 5,
        'name' => 'drlicense_number',
        'description' => __('drlicense_number'),
        'value' => '',
        'option_type' =>  'I',
        'position' => 50,
    ),
    array (
        'option_id' => 6,
        'name' => 'routing_code',
        'description' => __('routing_code'),
        'value' => '',
        'option_type' =>  'I',
        'position' => 60,
    ),
    array (
        'option_id' => 7,
        'name' => 'account_number',
        'description' => __('account_number'),
        'value' => '',
        'option_type' =>  'I',
        'position' => 70,
    ),
    array (
        'option_id' => 8,
        'name' => 'check_number',
        'description' => __('check_number'),
        'value' => '',
        'option_type' =>  'I',
        'position' => 80,
    ),
);
return $schema;

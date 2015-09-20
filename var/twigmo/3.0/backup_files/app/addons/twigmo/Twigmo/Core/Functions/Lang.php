<?php

namespace Twigmo\Core\Functions;

class Lang
{
    private static $needed_lang_vars = array(
        'account_name',
        'add_to_cart',
        'address',
        'address_2',
        'apply_for_vendor_account',
        
        'back',
        'billing_address',
        'billing_shipping_address',
        
        'cannot_proccess_checkout_without_payment_methods',
        'card_name',
        'card_number',
        'cardholder_name',
        'cart',
        'cart_contents',
        'cart_is_empty',
        'catalog',
        'checkout',
        'checkout_as_guest',
        'checkout_terms_n_conditions',
        'checkout_terms_n_conditions_alert',
        'city',
        'company',
        'confirm_password',
        'contact_info',
        'contact_information',
        'contact_us_for_price',
        'continue',
        'country',
        'coupon',
        'credit_card',
        
        'date',
        'date_of_birth',
        'description',
        'details',
        'discount',
        
        'email',
        'enter_your_price',
        'error_passwords_dont_match',
        'error_validator_message',
        
        'fax',
        'features',
        'files',
        'first_name',
        'free',
        'free_shipping',
        
        'gift_certificate',
        
        'home',
        
        'in_stock',
        'included',
        'including_discount',
        'is_logged_in',
        
        'language',
        'last_name',
        'loading',
        
        'no',
        'notes',
        
        'options',
        'or_use',
        'order',
        'order_discount',
        'order_id',
        'order_info',
        'orders',
        
        'password',
        'payment_information',
        'payment_method',
        'payment_options',
        'payment_surcharge',
        'phone',
        'place_order',
        'price',
        'product',
        'product_added_to_cart',
        'product_coming_soon',
        'product_coming_soon_add',
        'products',
        'profile',
        'promo_code',
        'promo_code_or_certificate',
        
        'quantity',
        
        'register',
        'review_and_place_order',
        
        'search',
        'select_country',
        'select_state',
        'shipping',
        'shipping_address',
        'shipping_cost',
        'shipping_method',
        'shipping_methods',
        'sign_in',
        'sign_out',
        'sku',
        'state',
        'status',
        'submit',
        'subtotal',
        'summary',
        
        'tax',
        'tax_exempt',
        'taxes',
        'text_cart_min_qty',
        'text_email_sent',
        'text_fill_the_mandatory_fields',
        'text_login_to_add_to_cart',
        'text_min_order_amount_required',
        'text_min_products_amount_required',
        'text_no_matching_results_found',
        'text_no_orders',
        'text_no_shipping_methods',
        'text_order_backordered',
        'text_out_of_stock',
        'text_profile_is_created',
        'text_qty_discounts',
        'title',
        'total',
        
        'update_profile',
        'update_profile_notification',
        'url',
        'user_account_info',
        'username',
        
        'vendor',
        'view_cart',
        
        'yes',
        
        'zip_postal_code'
    );

    public static function getCustomerLangVars($lang_code = CART_LANGUAGE)
    {
        return array_diff(self::getAllLangVars($lang_code), self::getAdminLangVars($lang_code));
    }

    public static function getAllLangVars($lang_code = CART_LANGUAGE)
    {
        return fn_get_lang_vars_by_prefix('twg', $lang_code);
    }

    public static function getNeededLangvars()
    {
        return self::$needed_lang_vars;
    }

    /**
    * Returns only active languages list (as lang_code => array(name, lang_code, status)
    *
    * @param bool $include_hidden if true get hiddenlanguages too
    * @return array Languages list
    */
    public static function getLanguages($include_hidden = false)
    {
        $language_condition =
            $include_hidden ?
                "WHERE status <> 'D'" :
                "WHERE status = 'A'";

        return db_get_hash_array(
            "SELECT lang_code, name FROM ?:languages ?p",
            'lang_code',
            $language_condition
        );
    }

    private static function getAdminLangVars($lang_code = CART_LANGUAGE)
    {
        return fn_get_lang_vars_by_prefix('twgadmin', $lang_code);
    }
}

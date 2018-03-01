<?php
/**
 * Edit WCFM vendor manage page - Update profile section
 * @author Shaikhah
 */
add_filter('wcfm_profile_field_vendor_manage', 'view_vendor_fields_wcfm', 10, 2);

function view_vendor_fields_wcfm($vendor_fields, $vendor_id)
{
	$vendor_user = get_userdata($vendor_id);
	$commercial_number = get_user_meta($vendor_id, '_vendor_commercial_ID_input', true);
	$responsile_fname = get_user_meta($vendor_id, '_vendor_resp_fname', true);
	$responsile_lname = get_user_meta($vendor_id, '_vendor_resp_lname', true);
	$responsile_phone = get_user_meta($vendor_id, '_vendor_resp_phone', true);
	$responsile_email = get_user_meta($vendor_id, '_vendor_resp_email', true);
	$commission_percentage = get_user_meta($vendor_id, '_vendor_commission_percentage', true);
	$commission_fixed_per_unit = get_user_meta($vendor_id, '_vendor_commission_fixed_with_percentage_qty', true);
	$relationship_manager_id = get_user_meta($vendor_id, 'relationship_manager_ID', true);
	$relationship_manager_name = get_user_meta($vendor_id, 'relationship_manager_name', true);
	$relationship_manager_email = get_user_meta($vendor_id, 'relationship_manager_email', true);
	$relationship_manager_phone = get_user_meta($vendor_id, 'relationship_manager_phone', true);
	$vendor = new WCMp_Vendor($vendor_id);
	$vendor_fields = array(
		"first_name" => array(
			'label' => __('First Name', 'wc-frontend-manager') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => $vendor_user->first_name
		) ,
		"last_name" => array(
			'label' => __('Last Name', 'wc-frontend-manager') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => $vendor_user->last_name
		) ,
		"user_email" => array(
			'label' => __('Email', 'woocommerce') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => $vendor_user->user_email
		) ,
		"vendor_phone" => array(
			'label' => __('Phone Number', 'woocommerce') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => get_user_meta($vendor_id , '_vendor_phone' , true)
		) ,
		"vendor_company" => array(
			'label' => __('Company Name', 'woocommerce') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => get_user_meta($vendor_id , '_vendor_company' , true)
		) ,
		"vendor_bank_name" => array(
			'label' => __('Bank Name', 'woocommerce') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => $vendor->bank_name
		) ,
		"vendor_bank_account_number" => array(
			'label' => __('Bank Account Name', 'woocommerce') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => $vendor->bank_account_number
		) ,
		"vendor_iban" => array(
			'label' => __('IBAN', 'woocommerce') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => $vendor->iban
		) ,
		"vendor_commercial_ID_input" => array(
			'label' => __('Commercial Registration Number', 'woocommerce') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => $commercial_number
		) ,
		"vendor_resp_fname" => array(
			'label' => __('Responsible First Name', 'wc-frontend-manager') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => $responsile_fname
		) ,
		"vendor_resp_lname" => array(
			'label' => __('Responsible Last Name', 'wc-frontend-manager') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => $responsile_lname
		) ,
		"vendor_resp_phone" => array(
			'label' => __('Responsible Phone Number', 'wc-frontend-manager') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => $responsile_phone
		) ,
		"vendor_resp_email" => array(
			'label' => __('Responsible Email', 'wc-frontend-manager') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => $responsile_email
		) ,
		"vendor_country" => array(
			'label' => __('Shipping Country', 'wc-frontend-manager') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => get_user_meta($vendor_id , '_vendor_country' , true)
		) ,
		"vendor_city" => array(
			'label' => __('Shipping City', 'wc-frontend-manager') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => get_user_meta($vendor_id , '_vendor_city' , true)
		) ,
		"vendor_address_1" => array(
			'label' => __('Shipping Address 1', 'wc-frontend-manager') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => get_user_meta($vendor_id , '_vendor_address_1' , true)
		) ,
		"vendor_page_title" => array(
			'label' => __('Vendor Page Title', 'wc-frontend-manager') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => get_user_meta($vendor_id , '_vendor_page_title' , true)
		) ,
		"vendor_page_slug" => array(
			'label' => __('Vendor Page Slug', 'wc-frontend-manager') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => get_user_meta($vendor_id , '_vendor_page_slug' , true)
		) ,
		"vendor_csd_return_country" => array(
			'label' => __('Return Country', 'wc-frontend-manager') ,
			'type' => 'text',
			'value' => get_user_meta($vendor_id , '_vendor_csd_return_country' , true),
			'custom_attributes' => array(
				'required' => true
			) ,
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
		) ,
		"vendor_csd_return_city" => array(
			'label' => __('Return City', 'wc-frontend-manager') ,
			'type' => 'text',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => get_user_meta($vendor_id , '_vendor_csd_return_city' , true),
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
		) ,
		"vendor_csd_return_address1" => array(
			'label' => __('Return address', 'wc-frontend-manager') ,
			'type' => 'text',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => get_user_meta($vendor_id , '_vendor_csd_return_address1' , true),
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
		) ,
		"vendor_customer_phone" => array(
			'label' => __('Return Phone', 'wc-frontend-manager') ,
			'type' => 'text',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => get_user_meta($vendor_id , '_vendor_customer_phone' , true),
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
		) ,
		"vendor_customer_email" => array(
			'label' => __('Return Email', 'wc-frontend-manager') ,
			'type' => 'text',
			'custom_attributes' => array(
				'required' => true
			) ,
			'value' => get_user_meta($vendor_id , '_vendor_customer_email' , true),
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
		) ,
		"commission_percentage" => array(
			'label' => __('Commission Percentage', 'wc-frontend-manager') ,
			'type' => 'text',
			'value' => $commission_percentage,
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
		) ,
		"commission_fixed_per_unit" => array(
			'label' => __('Commission Fixed Per Unit', 'wc-frontend-manager') ,
			'type' => 'text',
			'value' => $commission_fixed_per_unit,
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
		) ,

    "relationship_manager_ID" => array(
			'label' => __('Relationship Manager ID', 'wc-frontend-manager') ,
			'type' => 'text',
			'value' => $relationship_manager_id,
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
		) ,

    "relationship_manager_name" => array(
			'label' => __('Relationship Manager Name', 'wc-frontend-manager') ,
			'type' => 'text',
			'value' => $relationship_manager_name,
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
		) ,

    "relationship_manager_email" => array(
			'label' => __('Relationship Manager Email', 'wc-frontend-manager') ,
			'type' => 'text',
			'value' => $relationship_manager_email,
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
		) ,

    "relationship_manager_phone" => array(
			'label' => __('Relationship Manager Phone', 'wc-frontend-manager') ,
			'type' => 'text',
			'value' => $relationship_manager_phone,
			'class' => 'wcfm-text wcfm_ele ',
			'label_class' => 'wcfm_ele wcfm_title',
		) ,
		"vendor_id" => array(
			'type' => 'hidden',
			'value' => $vendor_id
		) ,
	);
	return $vendor_fields;
}

add_action( 'wcfm_vendor_manage_profile_update', 'wcfm_save_vendor_email', 10, 2);
function wcfm_save_vendor_email($vendor_id, $wcfm_vendor_manage_profile_form_data) {
	wp_update_user( 
		array( 'ID' => $vendor_id, 
		'user_email' => $wcfm_vendor_manage_profile_form_data['user_email']
		) 
	);
}


add_filter('wcfm_vendor_manage_profile_fields', 'wcfm_save_vendor_manage_profile_fields');
function wcfm_save_vendor_manage_profile_fields($vendor_fields_names)
{
	return $vendor_fields_names = array_merge($vendor_fields_names, array(
		'_vendor_bank_name' => 'vendor_bank_name',
		'_vendor_bank_account_number' => 'vendor_bank_account_number',
		'_vendor_iban' => 'vendor_iban',
		'_vendor_company' => 'vendor_company',
		'_vendor_phone_key' => 'vendor_phone_key',
		'_vendor_phone'  => 'vendor_phone',
		'_vendor_page_title' => 'vendor_page_title',
		'_vendor_page_slug' => 'vendor_page_slug',
		'_vendor_commission_percentage' => 'commission_percentage',
		'_vendor_commission_fixed_with_percentage_qty' => 'commission_fixed_per_unit',
		'_id-crn' => 'id-crn',
		'_vendor_commercial_ID_input' => 'vendor_commercial_ID_input',
		'_vendor_country' => 'vendor_country',
		'_vendor_city' => 'vendor_city',
		'_vendor_address_1' => 'vendor_address_1',
		'_vendor_resp_fname' => 'vendor_resp_fname',
		'_vendor_resp_lname' => 'vendor_resp_lname',
		'_vendor_resp_email' => 'vendor_resp_email',
		'_vendor_resp_phone_key' => 'vendor_resp_phone_key',
		'_vendor_resp_phone' => 'vendor_resp_phone',
		'_vendor_customer_email' => 'vendor_customer_email',
		'_vendor_customer_phone_key' => 'vendor_customer_phone_key',
		'_vendor_customer_phone' => 'vendor_customer_phone',
		'_vendor_csd_return_country' => 'vendor_csd_return_country',
		'_vendor_csd_return_city' => 'vendor_csd_return_city',
		'_vendor_csd_return_address1' => 'vendor_csd_return_address1',
		'relationship_manager_ID' => 'relationship_manager_ID',
		'relationship_manager_name' => 'relationship_manager_name',
		'relationship_manager_email' => 'relationship_manager_email',
		'relationship_manager_phone' => 'relationship_manager_phone',
	));
}

/**
 * Customize menu view for each role in frontend dashboard
 * @author: Shaikhah
 */
add_filter('wcfm_menus', 'wcfm_roles_restriction', 600);

function wcfm_roles_restriction($menus)
{
	if (current_user_can('data_entry')) {
		unset($menus['wcfm-coupons']);
		unset($menus['wcfm-orders']);
		unset($menus['wcfm-settings']);
		unset($menus['wcfm-reports']);
		unset($menus['wcfm-vendors']);
		hide_home_item();
	}
	elseif (current_user_can('sales_monitor')) {
		unset($menus['wcfm-coupons']);
		unset($menus['wcfm-settings']);
		unset($menus['wcfm-products']);
	}
	elseif (current_user_can('storekeeper')) {
		unset($menus['wcfm-coupons']);
		unset($menus['wcfm-products']);
		unset($menus['wcfm-reports']);
		unset($menus['wcfm-settings']);
		unset($menus['wcfm-vendors']);
		hide_home_item();
	}
	elseif (current_user_can('shipping_monitor')) {
		unset($menus['wcfm-coupons']);
		unset($menus['wcfm-products']);
		unset($menus['wcfm-settings']);
		unset($menus['wcfm-reports']);
		unset($menus['wcfm-vendors']);
		hide_home_item();
	}
	return $menus;
}

add_filter( 'woocommerce_enable_order_notes_field', 'vendors_enable_order_notes', 10);
function vendors_hide_order_notes($choice) {
	if ( current_user_can('dc_vendor') ) {
		$choice = false;
	}
	return $choice;
}

add_filter( 'wcfm_is_allow_social_profile', 'disable_social' );
function disable_social($choice) {
	$choice = false;
	return $choice;
}

//define the woocommerce_checkout_order_processed callback 
function action_woocommerce_checkout_order_processed( $order_id ) { 
	$email_admin = WC()->mailer()->emails['WC_Email_Vendor_New_Order'];
    $email_admin->trigger($order_id);
} 
         
// add the action 
add_action( 'woocommerce_checkout_order_processed', 'action_woocommerce_checkout_order_processed', 10, 1 ); 

/**
 * Hide wordpress admin bar for non-admins
 */

if (!current_user_can('administrator')) {
	add_filter('show_admin_bar', '__return_false');
}

add_action('init', 'blockusers_init');

function blockusers_init()
{
	if (is_admin() && !current_user_can('administrator') && !(defined('DOING_AJAX') && DOING_AJAX)) {
		wp_redirect(home_url());
		exit;
	}
}

/**
 * Hide home from front dashboard
 * @author Shaikhah
 */
function hide_home_item()
{
	echo "<script>
        $(document).ready(function(){
            $('.wcfm_menu_home').css('display', 'none');
        });
    </script>";
}

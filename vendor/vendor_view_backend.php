<?php


// ############################################################################################
// edit feilds in vendor profile page in backend
function vendor_fields_profile($fields)
	{
 ////////////////////////////////////////////////////////////////////////////////////
	global $WCMp;
	$vendor_id = $_GET["user_id"];
	$commercial_number = get_user_meta($vendor_id, '_vendor_commercial_ID_input', true);

	// ####################################################

	$resp_fname = get_user_meta($vendor_id, '_vendor_resp_fname', true);
	$resp_lname = get_user_meta($vendor_id, '_vendor_resp_lname', true);
	$resp_phone = get_user_meta($vendor_id, '_vendor_resp_phone', true);
	$resp_email = get_user_meta($vendor_id, '_vendor_resp_email', true);
	$is_ID_commercial = get_user_meta($vendor_id, '_id-crn', true);
	$bank_account_name = get_user_meta($vendor_id, '_vendor_bank_account_number', true);
	$relationship_manager_id = get_user_meta($vendor_id, 'relationship_manager_ID', true);
	$relationship_manager_name = get_user_meta($vendor_id, 'relationship_manager_name', true);
	$relationship_manager_email = get_user_meta($vendor_id, 'relationship_manager_email', true);
	$relationship_manager_phone = get_user_meta($vendor_id, 'relationship_manager_phone', true);
	// ####################################################

	$vendor = new WCMp_Vendor($vendor_id);
	$fields = array(
		"vendor_resp_fname" => array(
			'label' => __('Responsible Fisrt Name', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $resp_fname,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_resp_lname" => array(
			'label' => __('Responsible Last Name', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $resp_lname,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_resp_phone" => array(
			'label' => __('Responsible Phone', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $resp_phone,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_resp_email" => array(
			'label' => __('Responsible E-mail', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $resp_email,
			'class' => "user-profile-fields regular-text"
		) , // Text
		// ####################################################
		"vendor_company" => array(
			'label' => __('Company Name', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $vendor->company,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_bank_name" => array(
			'label' => __('Bank Name', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $vendor->bank_name,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_bank_account_number" => array(
			'label' => __('Bank Account Name', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $bank_account_name,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_iban" => array(
			'label' => __('IBAN', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $vendor->iban,
			'class' => "user-profile-fields regular-text"
		) , // Text
		// ####################################################
		"vendor_phone" => array(
			'label' => __('Phone', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $vendor->phone,
			'class' => "user-profile-fields regular-text"
		) ,
		"vendor_commercial_ID_input" => array(
			'label' => __('Commercial Registration Number', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $commercial_number,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_country" => array(
			'label' => __('Shipping Country', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $vendor->country,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_city" => array(
			'label' => __('Shipping City', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $vendor->city,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_address_1" => array(
			'label' => __('Shipping Address 1', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $vendor->address_1,
			'class' => "user-profile-fields regular-text"
		) , // Text
		// ####################################################
		"vendor_page_title" => array(
			'label' => __('Vendor Page Title', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $vendor->page_title,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_page_slug" => array(
			'label' => __('Vendor Page Slug', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $vendor->page_slug,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_external_store_url" => array(
			'label' => __('External store URL', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $vendor->external_store_url,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_external_store_label" => array(
			'label' => __('External store URL label', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $vendor->external_store_label,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_image" => array(
			'label' => __('Logo', 'dc-woocommerce-multi-vendor') ,
			'type' => 'upload',
			'prwidth' => 125,
			'value' => $vendor->image ? $vendor->image : $WCMp->plugin_url . 'assets/images/logo_placeholder.jpg',
			'class' => "user-profile-fields"
		) , // Upload
		"vendor_banner" => array(
			'label' => __('Banner', 'dc-woocommerce-multi-vendor') ,
			'type' => 'upload',
			'prwidth' => 600,
			'value' => $vendor->banner ? $vendor->banner : $WCMp->plugin_url . 'assets/images/banner_placeholder.jpg',
			'class' => "user-profile-fields"
		) , // Upload
		"vendor_csd_return_country" => array(
			'label' => __('Return Country', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $vendor->csd_return_country,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_csd_return_city" => array(
			'label' => __('Return City', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $vendor->csd_return_city,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_csd_return_address1" => array(
			'label' => __('Return address1', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $vendor->csd_return_address1,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_customer_phone" => array(
			'label' => __('Return Phone', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $vendor->customer_phone,
			'class' => "user-profile-fields regular-text"
		) , // Text
		"vendor_customer_email" => array(
			'label' => __('Customer Email', 'dc-woocommerce-multi-vendor') ,
			'type' => 'text',
			'value' => $vendor->customer_email,
			'class' => "user-profile-fields regular-text"
		),"relationship_manager_ID" => array(
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
	);
	return $fields;
	}

add_filter('wcmp_vendor_fields', 'vendor_fields_profile', 50);

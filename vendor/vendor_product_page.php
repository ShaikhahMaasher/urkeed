<?php
// ############################################################################################
function vendor_payment_modes($payment_mode){
	$payment_mode[''] = __('-- Select Payment Mode --' , 'dc-multi-vendor');
	return $payment_mode;
}
add_filter('wcmp_vendor_payment_mode','vendor_payment_modes',500);



// ############################################################################################
// Adding variation field data

function wcfm_product_data_variations_mrp($variations, $variation_id, $variation_id_key)
	{
	global $WCFM, $WCFMu;
	if ($variation_id)
	{
		$variations[$variation_id_key]['_vendor_barcode_var'] = get_post_meta($variation_id, '_vendor_barcode_var', true);
	}

	return $variations;
	}
add_filter('wcfm_variation_edit_data', 'wcfm_product_data_variations_mrp', 100, 3);

// ############################################################################################
// ############################################################################################

add_action( 'after_wcfm_product_variation_meta_save', 'save_extra_field_vendor_variation', 10, 4);
function save_extra_field_vendor_variation($new_product_id, $variation_id, $variations, $wcfm_products_manage_form_data)
{
	update_post_meta($variation_id, '_vendor_barcode_var', $variations['_vendor_barcode_var']);
}
// ############################################################################################
// ############################################################################################

function save_extra_field_vendor_add_product($new_product_id, $wcfm_products_manage_form_data)
	{
	update_post_meta($new_product_id, 'title_en', $wcfm_products_manage_form_data['title_en']);
	update_post_meta($new_product_id, 'short_description_en', $wcfm_products_manage_form_data['short_description_en']);
	update_post_meta($new_product_id, 'description_en', $wcfm_products_manage_form_data['description_en']);
	update_post_meta($new_product_id, '_vendor_barcode', $wcfm_products_manage_form_data['_vendor_barcode'] );
	}
add_action('after_wcfm_products_manage_meta_save', 'save_extra_field_vendor_add_product', 10, 2);

// ############################################################################################
// ############################################################################################
// make SKU to required

function make_sku_required($stock_fields, $product_id, $product_type)
	{
	unset($stock_fields['sku']);
	unset($stock_fields['sold_individually']);
	unset($stock_fields['backorders']);
	unset($stock_fields['manage_stock']);
	$stock_fields['stock_qty']['custom_attributes'] = array(
		'required' => 1
	);
	return $stock_fields;
	}

add_filter('wcfm_product_fields_stock', 'make_sku_required', 50, 3);

// ############################################################################################
// ############################################################################################
// make weight to required

function make_weight_required($shipping_fields, $product_id)
	{
	$shipping_fields['weight']['custom_attributes'] = array(
		'required' => 1
	);

	unset($shipping_fields['shipping_class']);
	return $shipping_fields;
	}

add_filter('wcfm_product_manage_fields_shipping', 'make_weight_required', 50, 2);



function add_pricing_fields_vendor_add_product($pricing_fields, $product_id, $product_type)
	{
	$pricing_fields['regular_price']['custom_attributes'] = array('required' => 1);
	return $pricing_fields;
	}

add_filter('wcfm_product_manage_fields_pricing', 'add_pricing_fields_vendor_add_product', 50, 3);

// ############################################################################################
// ############################################################################################
// add vendor regular and sale prices fileds to the variable product

function add_pricing_to_variation($variations, $variation_shipping_option_array, $variation_tax_classes_options, $products_array)
{
	return array(
		"id" => array(
			'type' => 'hidden',
			'class' => 'variation_id'
		) ,
		"image" => array(
			'label' => __('Image', 'wc-frontend-manager') ,
			'type' => 'upload',
			'class' => 'wcfm-text wcfm_ele variable variable-subscription',
			'label_class' => 'wcfm_title wcfm_half_ele_upload_title'
		) ,
		"regular_price" => array(
			'label' => __('Price', 'wc-frontend-manager') . '(' . get_woocommerce_currency_symbol() . ')',
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele wcfm_half_ele variable',
			'label_class' => 'wcfm_title wcfm_ele wcfm_half_ele_title variable',
			'custom_attributes' => array(
				'required' => 1
			),
		) ,
		"sale_price" => array(
			'label' => __('Sale Price', 'wc-frontend-manager') . '(' . get_woocommerce_currency_symbol() . ')',
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele wcfm_half_ele variable variable-subscription',
			'label_class' => 'wcfm_title wcfm_ele wcfm_half_ele_title variable variable-subscription'
		) ,
		"stock_qty" => array(
			'label' => __('Stock Qty', 'wc-frontend-manager') ,
			'type' => 'number',
			'class' => 'wcfm-text wcfm_ele wcfm_half_ele variable variable-subscription variation_non_manage_stock_ele',
			'label_class' => 'wcfm_title wcfm_half_ele_title variation_non_manage_stock_ele',
			'custom_attributes'=> array(
				'required' => 1
			),
		) ,
		"_vendor_barcode_var" => array(
			'label' => __('Product Barcode', 'wc-frontend-manager') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele wcfm_half_ele variable variable-subscription',
			'label_class' => 'wcfm_title wcfm_half_ele_title'
		) ,
		"stock_status" => array(
			'label' => __('Stock status', 'wc-frontend-manager') ,
			'type' => 'select',
			'options' => array(
				'instock' => __('In stock', 'wc-frontend-manager') ,
				'outofstock' => __('Out of stock', 'wc-frontend-manager')
			) ,
			'class' => 'wcfm-select wcfm_ele wcfm_half_ele variable variable-subscription',
			'label_class' => 'wcfm_title wcfm_half_ele_title'
		) ,
		"attributes" => array(
			'type' => 'hidden'
		)
	);
	}

add_filter('wcfm_product_manage_fields_variations', 'add_pricing_to_variation', 50, 4);

// ############################################################################################

add_filter('product_simple_fields_attributes' , 'automatically_add_the_attribute_to_variation');
function automatically_add_the_attribute_to_variation($attributes_fields){
	$attributes_fields['is_visible'] = 'enable';
	$attributes_fields['is_variation']['value'] = 'enable';
	return $attributes_fields;
}


add_filter('wcfm_product_manage_fields_gallery' , 'featured_image');
function featured_image($img){
	$img['featured_img']['label'] = __('Featured Image' , 'wc-frontend-manager');
	$img['featured_img']['custom_attributes'] = array('required' => 1);
	?>
	<style>
	#featured_img {
	    width: unset !important;
	}
	#wcfm_products_manage_form_variations_empty_expander h2 {
    display: none;
	}
	</style>
	<?php
	return $img;
}

function product_simple_fields_custom_attributes_manipulate( $select_attributes ) {
	if( isset( $select_attributes['select_attributes'] ) && isset( $select_attributes['select_attributes']['value'] ) ) {
	  $attribute_values = $select_attributes['select_attributes']['value'];
	  $attribute_custom_values = array();
	  if( !empty( $attribute_values ) ) {
	  	foreach( $attribute_values as $key => $attribute_value ) {
					$attribute_value['is_visible'] = 'enable';
		  		$attribute_value['is_variation'] = 'enable';
		  		$attribute_custom_values[$key] = $attribute_value;
	  	}
	  }
	   $select_attributes['select_attributes']['value'] = $attribute_custom_values;
	}
	return $select_attributes;
}
add_filter( 'product_simple_fields_custom_attributes', 'product_simple_fields_custom_attributes_manipulate' );

add_filter( 'wcfm_is_allow_tags', 'disallow_tags' );
function disallow_tags($state){
	if(current_user_can('dc_vendor')){
		$state = false ;
	}
	return $state;
}
// ############################################################################################
// add vendor regular and sale prices fileds to the simple product
function print_commission($product_id){
	global $WCMp;
	$commission_percentage_per_poduct = get_post_meta( $product_id, '_commission_percentage_per_product', true);
	$commission_fixed_with_percentage_qty = get_post_meta( $product_id, '_commission_fixed_with_percentage_qty', true);

	$vendor_commission_percentage = get_user_meta(get_current_user_id(), '_vendor_commission_percentage', true);
	$vendor_commission_fixed_with_percentage = get_user_meta(get_current_user_id(), '_vendor_commission_fixed_with_percentage_qty', true);

	$general_commission_percentage = $WCMp->vendor_caps->payment_cap['default_percentage'];
	$general_commission_fixed = $WCMp->vendor_caps->payment_cap['fixed_with_percentage_qty'];


	if ($WCMp->vendor_caps->payment_cap['commission_type'] == 'fixed_with_percentage_qty') {
			$fixed = 0 ;
			$percentage = 0;
			// if there are commission of this product
			if($commission_percentage_per_poduct > 0 || $commission_fixed_with_percentage_qty > 0){
				// echo '1';
				$commission_percentage_per_poduct = !empty($commission_percentage_per_poduct)? $commission_percentage_per_poduct : 0 ;
				$commission_fixed_with_percentage_qty = !empty($commission_fixed_with_percentage_qty)? $commission_fixed_with_percentage_qty : 0 ;
				$fixed = $commission_fixed_with_percentage_qty ;
				$percentage = $commission_percentage_per_poduct;
			}
			// if there are commission for this vendor
			else if($vendor_commission_percentage > 0 || $vendor_commission_fixed_with_percentage > 0){
				$vendor_commission_percentage = !empty($vendor_commission_percentage)? $vendor_commission_percentage : 0 ;
				$vendor_commission_fixed_with_percentage = !empty($vendor_commission_fixed_with_percentage)? $vendor_commission_fixed_with_percentage : 0 ;
				$fixed = $vendor_commission_percentage ;
				$percentage = $vendor_commission_fixed_with_percentage;
			}
			// then use the general commission
			else{
				$general_commission_percentage = !empty($general_commission_percentage)? $general_commission_percentage : 0 ;
				$general_commission_fixed = !empty($general_commission_fixed)? $general_commission_fixed : 0 ;
				$fixed = $general_commission_percentage ;
				$percentage = $general_commission_fixed;
			}
			$currency = get_woocommerce_currency();

			echo '<script>';
			// echo "$('#product_type').change(function(){
			// 	var val = $( this ).val();";
			// echo "if( val === 'simple'){";
			echo "$('#regular_price').after('<span class=\"commission_span\" id =\"comm_reg\"></span><br>');";
			echo "$('#sale_price').after('<span class=\"commission_span\" id =\"comm_s\"></span><br>');";
			echo generate_script_of_print_commission($fixed,$percentage,"regular_price","comm_reg",$currency);
			echo generate_script_of_print_commission($fixed,$percentage,"sale_price","comm_s",$currency);
			// echo "} "; // variations_regular_price_0
			// echo "if( val === 'variable'){ ";
			// echo "$('#regular_price').after('<span class=\"commission_span\" id =\"comm_reg\"></span><br>');";
			// echo "$('#sale_price').after('<span class=\"commission_span\" id =\"comm_s\"></span><br>');";
			// echo generate_script_of_print_commission($fixed,$percentage,"regular_price","comm_reg",$currency);
			// echo generate_script_of_print_commission($fixed,$percentage,"sale_price","comm_s",$currency);
			// echo "}";
			echo '</script>';
	}
}

add_action( 'end_wcfm_products_manage','print_commission' , 10,1 );
function generate_script_of_print_commission($fixed,$percentage,$price,$span,$currency){
	$commission_text = __('Commission - ','woocommerce');
	return "$('#".$price."').change(function(){
		var vendor_price = Number($(this).val());
		var percentage = ".$percentage." ;
		var fixed = ".$fixed.";
		var text = '".$commission_text."' ;
		var comm =0 ;
		if(percentage > 0 ){
			comm += vendor_price * percentage / 100 ;
		}
		if(fixed > 0 ){
			comm += fixed ;
		}
		text += comm + ' '+'$currency';
		$('#".$span."').text(text);
		});";
}

// ############################################################################################
// ############################################################################################
// remove short description and description fields from the bottom
function remove_content_add_product($content_fields, $product_id, $product_type)
	{
	unset($content_fields['excerpt']);
	unset($content_fields['description']);
	return $content_fields;
	}
add_filter('wcfm_product_manage_fields_content', 'remove_content_add_product', 50, 3);
// ############################################################################################
// ############################################################################################
// ############################################################################################
// disable rich editor from vendor add product
function disallow_rich_editor($rich_editor)
	{
	return '';
	}
add_filter('wcfm_is_allow_rich_editor', 'disallow_rich_editor', 700);
// ############################################################################################
// add general fields ( title , short description and description ) in 3 languages
function add_general_fields_vendor_add_product($general_fields, $product_id, $product_type)
	{
	$sku = '';
	$title  = '';
	$excerpt  = '';
	$description  = '';
	$title_en = '';
	$short_description_en = '';
	$description_en = '';
	if ($product_id)
		{
		global $woocommerce;
		$product = wc_get_product($product_id);
		$title = $product->get_title();
		$sku = $product->get_sku();
		$excerpt = $product->get_short_description();
		$description = $product->get_description();

		// get english data from database

		$title_en = get_post_meta($product_id, 'title_en', true);
		$description_en = get_post_meta($product_id, 'description_en', true);
		$short_description_en = get_post_meta($product_id, 'short_description_en', true);

		}

	$rich_editor = apply_filters( 'wcfm_is_allow_rich_editor', 'rich_editor' );
	$general_additional_fields = array(
		"title" => array(
			'label' => __('Arabic Product Title', 'wc-frontend-manager') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele wcfm_product_title wcfm_full_ele simple variable external grouped booking',
			'label_class' => 'wcfm_title wcfm_full_ele',
			'placeholder' => __('The main title that will appear to the customer.', 'wc-frontend-manager'),
			'value' => $title
		) ,
		"excerpt" => array(
			'label' => __('Arabic Short Description', 'wc-frontend-manager') ,
			'type' => 'textarea',
			'class' => 'wcfm-textarea wcfm_ele wcfm_full_ele simple variable external grouped booking ' . $rich_editor,
			'label_class' => 'wcfm_title wcfm_full_ele',
			'placeholder' => __('Short description will appear below the product price.', 'wc-frontend-manager'),
			'value' => $excerpt
		) ,
		"description" => array(
			'label' => __('Arabic Description', 'wc-frontend-manager') ,
			'type' => 'textarea',
			'class' => 'wcfm-textarea wcfm_ele wcfm_full_ele simple variable external grouped booking ' . $rich_editor,
			'label_class' => 'wcfm_title wcfm_full_ele',
			'placeholder' => __('Product full description will appear in description tab below the product pictures.', 'wc-frontend-manager'),
			'value' => $description
		) ,

		// --------------------------------------------------------------------------------------------------------------------------------------------------------

		"title_en" => array(
			'label' => __('English Product Title', 'wc-frontend-manager') ,
			'type' => 'text',
			'class' => 'wcfm-text wcfm_ele wcfm_product_title wcfm_full_ele simple variable external grouped booking',
			'label_class' => 'wcfm_title wcfm_full_ele',
			'placeholder' => __('The main title that will appear to the customer when switching language to English.', 'wc-frontend-manager'),
			// 'custom_attributes' => array(
			// 	'required' => 1
			// ) ,
			'value' => $title_en
		) ,
		"short_description_en" => array(
			'label' => __('English Short Description', 'wc-frontend-manager') ,
			'type' => 'textarea',
			'class' => 'wcfm-textarea wcfm_ele wcfm_full_ele simple variable external grouped booking ' . $rich_editor,
			'label_class' => 'wcfm_title wcfm_full_ele',
			'placeholder' => __('Short description will appear below the product price when switching language to English.', 'wc-frontend-manager'),
			// 'custom_attributes' => array(
			// 	'required' => 1
			// ) ,
			'value' => $short_description_en
		) ,
		"description_en" => array(
			'label' => __('English Description', 'wc-frontend-manager') ,
			'type' => 'textarea',
			'class' => 'wcfm-textarea wcfm_ele wcfm_full_ele simple variable external grouped booking ' . $rich_editor,
			'label_class' => 'wcfm_title wcfm_full_ele',
			'placeholder' => __('Product full description will appear in description tab below the product pictures when switching language to English.', 'wc-frontend-manager'),
			// 'custom_attributes' => array(
			// 	'required' => 1
			// ) ,
			'value' => $description_en
		) ,
	);

	?>
		<style>
		.title_en,#title_en , .short_description_en , #short_description_en, .description_en ,#description_en {
		    text-align: left;
		}
		</style>
	<?php
	$general_fields = array_merge($general_fields, $general_additional_fields);
	return $general_fields;
	}
add_filter('wcfm_product_manage_fields_general', 'add_general_fields_vendor_add_product', 50, 3);


// Add vendor barcode to wcfm
add_filter('wcfm_product_fields_stock', 'wcfm_add_vendor_barcode', 50, 3);
function wcfm_add_vendor_barcode($stock_fields, $product_id, $product_type) {
	$vendor_barcode = get_post_meta($product_id, '_vendor_barcode', true) ? get_post_meta($product_id, '_vendor_barcode', true) : array();
	$vendor_barcode = array(
		"_vendor_barcode" => array(
			'label' => __('Product Barcode', 'wc-frontend-manager') ,
			'type' => 'text', 'class' => 'wcfm-text',
			'custom_attributes' => array('required' => 1),
			'label_class' => 'wcfm_title',
			'value' => $vendor_barcode,
			'hints' => __( 'Product barcode is a unique number for each item, and it should be filled from the vendor side.', 'wc-frontend-manager' )
	));

	$stock_fields = array_merge($vendor_barcode, $stock_fields);
	return $stock_fields;
}

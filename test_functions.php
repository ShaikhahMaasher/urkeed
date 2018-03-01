<?php
// Add Variation Settings
add_action( 'woocommerce_variation_options', 'variation_settings_fields', 10, 3 ); 

// Save Variation Settings
add_action( 'woocommerce_save_product_variation', 'save_variation_settings_fields', 10, 2 );
/**
 * Create new fields for variations
 *
*/
function variation_settings_fields( $loop, $variation_data, $variation ) {
	// Text Field
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_vendor_barcode_var[' . $variation->ID . ']', 
			'label'       => __( 'Product Barcode', 'woocommerce' ), 
			'placeholder' => __( 'Product barcode from vendor', 'woocommerce' ),
			'desc_tip'    => 'true',
			'description' => __( 'Enter the product barcode from vendor side here.', 'woocommerce' ),
			'value'       => get_post_meta( $variation->ID, '_vendor_barcode_var', true )
		)
	);
}
/**
 * Save new fields for variations
 *
*/
function save_variation_settings_fields( $post_id ) {
	// Save the product barcode of vendor
	$vendor_barcode_var = $_POST['_vendor_barcode_var'][ $post_id ];
	if( ! empty( $vendor_barcode_var ) ) {
		update_post_meta( $post_id, '_vendor_barcode_var', esc_attr( $vendor_barcode_var ) );
	}
}

add_action( 'woocommerce_product_options_sku', 'add_vendor_barcode_product', 50 );
function add_vendor_barcode_product () {
	if ( wc_product_sku_enabled() ) {
		woocommerce_wp_text_input( 
			array( 
				'id'          => '_vendor_barcode', 
				'label'       => __( 'Product Barcode', 'woocommerce' ), 
				'desc_tip'    => 'true',
				'description' => __( 'Enter the product barcode from vendor side here.', 'woocommerce' ),
			)
	 	);
	}
}

// Save the new field
add_action( 'woocommerce_process_product_meta', 'save_custom_vendor_barcode_product' );
function save_custom_vendor_barcode_product( $post_id ) {
	// Save the product barcode of vendor
	$vendor_barcode = $_POST['_vendor_barcode'];
	if (!empty($vendor_barcode)) {
		update_post_meta($post_id, '_vendor_barcode', esc_attr($vendor_barcode));
	}
}


// Add vendor barcode to the quick edit
// add_action( 'woocommerce_product_quick_edit_start', 'add_vendor_barcode_product_quick_edit', 10); 
function add_vendor_barcode_product_quick_edit () {
	if ( wc_product_sku_enabled() ) {
		?>
		<!-- <label>
			<span class="title">
			<?php //_e( 'Vendor Barcode', 'woocommerce' );
			 ?>
			</span>
			<span class="input-text-wrap">
				<input type="text" id="_vendor_barcode" name="_vendor_barcode" class="text sku" value="">
			</span>
		</label>
		<br class="clear" />
		!-->
		
		<div class="inline-edit-group">
			<label class="alignleft">
				<span class="title"><?php _e('Product barcode', 'woocommerce'); ?></span>
				<span class="input-text-wrap">
					<input type="text" id="_vendor_barcode" name="_vendor_barcode" value="">				
				</span>
			</label>
		</div>
	<?php
	}	
}

// Save the custom fields data when submitted for product bulk edit
// add_action('woocommerce_product_bulk_edit_save', 'save_custom_field_product_bulk_edit', 10, 1);
// function save_custom_field_product_bulk_edit( $product ){
// 	$product_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;
// 	if ( isset( $_REQUEST['_vendor_barcode'] ) )
// 		update_post_meta( $product_id, '_vendor_barcode', sanitize_text_field( $_REQUEST['_vendor_barcode'] ) );
// }

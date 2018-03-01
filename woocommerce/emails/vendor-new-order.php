<?php
/**
 * The template for displaying demo plugin content.
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/emails/vendor-new-order.php
 *
 * @author 		WC Marketplace
 * @package 	dc-product-vendor/Templates
 * @version   0.0.1
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly 
global $WCMp;
do_action('woocommerce_email_header', $email_heading);
?>

<p><?php printf(__('A new order was received and marked as processing from %s. Their order is as follows:', 'dc-woocommerce-multi-vendor'), $order->get_billing_first_name() . ' ' . $order->get_billing_last_name()); ?></p>
<h2><?php printf( __( 'Order #%s', 'woocommerce' ), $order->get_order_number() ); ?> (<?php printf( '<time datetime="%s">%s</time>', $order->get_date_created()->format( 'c' ), wc_format_datetime( $order->get_date_created() ) ); ?>)</h2>

<?php do_action('woocommerce_email_before_order_table', $order, true, false); ?>
<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
    <thead>
        <tr>
            <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e('Product', 'dc-woocommerce-multi-vendor'); ?></th>
            <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e('Quantity', 'dc-woocommerce-multi-vendor'); ?></th>
            <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e('Barcode', 'dc-woocommerce-multi-vendor'); ?></th>            
            <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e('SKU', 'dc-woocommerce-multi-vendor'); ?></th>            
            <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e('Commission', 'dc-woocommerce-multi-vendor'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $vendor = new WCMp_Vendor(absint($vendor_id));
        $vendor_items_dtl = vendor_order_item_table_mod($order, absint($vendor_id));
        echo $vendor_items_dtl;
        ?>
    </tbody>
</table>
<?php

$show_cust_add_field = apply_filters('show_cust_add_field', true);
$show_customer_detail = $WCMp->vendor_caps->vendor_capabilities_settings('show_cust_add');
if ($show_customer_detail && $show_cust_add_field) {
    ?>
    <h2><?php _e('Customer Details', 'dc-woocommerce-multi-vendor'); ?></h2>
    <?php if ($order->get_billing_email()) { ?>
        <p><strong><?php _e('Customer Name:', 'dc-woocommerce-multi-vendor'); ?></strong> <?php echo $order->get_billing_first_name() . ' ' . $order->get_billing_last_name(); ?></p>
        <p><strong><?php _e('Email:', 'dc-woocommerce-multi-vendor'); ?></strong> <?php echo $order->get_billing_email(); ?></p>
    <?php } ?>
    <?php if ($order->get_billing_phone()) { ?>
        <p><strong><?php _e('Telephone:', 'dc-woocommerce-multi-vendor'); ?></strong> <?php echo $order->get_billing_phone(); ?></p>
    <?php
    }
}
$show_cust_billing_add_field = apply_filters('show_cust_billing_add_field', true);
$show_cust_shipping_add_field = apply_filters('show_cust_shipping_add_field', true);
$show_cust_billing_add = $WCMp->vendor_caps->vendor_capabilities_settings('show_cust_billing_add');
$show_cust_shipping_add = $WCMp->vendor_caps->vendor_capabilities_settings('show_cust_shipping_add');
if ($show_cust_billing_add && $show_cust_billing_add_field) {
    ?>
    <table cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top;" border="0">
        <tr>
            <td valign="top" width="50%">
                <h3><?php _e('Billing Address', 'dc-woocommerce-multi-vendor'); ?></h3>
                <p><?php echo $order->get_formatted_billing_address(); ?></p>
            </td>
        </tr>
    </table>
    <?php }
?>

<?php if ($show_cust_shipping_add && $show_cust_shipping_add_field) { ?> 
    <?php if (( $shipping = $order->get_formatted_shipping_address())) { ?>
        <table cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top;" border="0">
            <tr>
                <td valign="top" width="50%">
                    <h3><?php _e('Shipping Address', 'dc-woocommerce-multi-vendor'); ?></h3>
                    <p><?php echo $shipping; ?></p>
                </td>
            </tr>
        </table>
    <?php
    }
}


function vendor_order_item_table_mod($order, $vendor_id, $is_ship = false) {
    $commission_obj = new WCMp_Calculate_Commission();
    $vendor = new WCMp_Vendor(absint($vendor_id));    
    $vendor_items = $vendor->get_vendor_items_from_order($order->get_id(), $vendor_id);
    foreach ($vendor_items as $item_id => $item) {
        $_product = apply_filters('wcmp_woocommerce_order_item_product', $order->get_product_from_item($item), $item);
        ?>
        <tr class="">
            <td scope="col" style="text-align:left; border: 1px solid #eee;" class="product-name">
                <?php
                if ($_product && !$_product->is_visible()) {
                    echo apply_filters('wcmp_woocommerce_order_item_name', $item['name'], $item);
                } else {
                    echo apply_filters('woocommerce_order_item_name', sprintf('<a href="%s">%s</a>', get_permalink($item['product_id']), $item['name']), $item);
                }
                wc_display_item_meta($item);
                ?>
            </td>
            <td scope="col" style="text-align:left; border: 1px solid #eee;">	
                <?php
                echo $item['qty'];
                ?>
            </td>
            <td scope="col" style="text-align:left; border: 1px solid #eee;">	
                <?php
                $has_barcode = get_post_meta( $item['product_id'], '_vendor_barcode', true );  
                if (!empty($has_barcode)) {
                    $barcode = $has_barcode; 
                    if (isset($item['variation_id']) && !empty($item['variation_id'])) {
                        $has_var_barcode = get_post_meta( $item['variation_id'], '_vendor_barcode_var', true );
                        if (!empty($has_var_barcode))
                            $barcode = $has_var_barcode;
                    }                  
                }
                else 
                    $barcode = _e('No barcode set', 'dc-woocommerce-multi-vendor');                
                echo $barcode;
                ?>
            </td>
            <td scope="col" style="text-align:left; border: 1px solid #eee;">	
                <?php
                if (isset($item['variation_id']) && !empty($item['variation_id'])) {
                    echo get_post_meta( $item['variation_id'], '_sku', true );
                }                  
                else 
                    echo get_post_meta( $item['product_id'], '_sku', true );
                ?>
            </td>
            <td scope="col" style="text-align:left; border: 1px solid #eee;">
                <?php
                // $variation_id = 0;
                // if (isset($item['variation_id']) && !empty($item['variation_id'])) {
                //     $variation_id = $item['variation_id'];
                // }
                $product_id = $item['product_id'];
                // $commission_amount = get_wcmp_vendor_order_amount(array('order_id' => $order->get_id(), 'product_id' => $product_id, 'variation_id' => $variation_id, 'order_item_id' => $item_id));
                // if ($is_ship) {
                //     echo $order->get_formatted_line_subtotal($item);
                // } else {
                //     echo wc_price($commission_amount['commission_amount']);
                // }
                print_vendor_commission($product_id);
                ?>
            </td>
        </tr>
        <?php
    }
}

function print_vendor_commission($product_id) {
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
            $product_price = get_post_meta($product_id, '_price', true);
            $product_price = !empty($product_price)? $product_price : 0;
            
            $sale_price = 0;
            $commission = 0;
            if ($percentage > 0) {
                $commission+= $product_price * $percentage/100;
            }
            if ($fixed > 0) {
                $commission+= $fixed;
            }
            echo $commission; 
   }            
}

?>



<?php do_action('wcmp_email_footer'); ?>

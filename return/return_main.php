<?php

remove_action( 'wp_ajax_ced_rnx_cancel_customer_order' , array( $this , 'ced_rnx_cancel_customer_order' ),10 );
remove_action( 'wp_ajax_nopriv_ced_rnx_cancel_customer_order' , array( $this , 'ced_rnx_cancel_customer_order' ),10 );	

add_action( 'wp_ajax_ced_rnx_cancel_customer_order' , array( $this , 'ced_rnx_cancel_customer_order_new' ),15 );
add_action( 'wp_ajax_nopriv_ced_rnx_cancel_customer_order' , array( $this , 'ced_rnx_cancel_customer_order_new' ),15 );	

/**
 * Cancel order and manage stock of cancelled product.
 * @name ced_rnx_cancel_customer_order_new
 * @author Shaikhah 
 */
function ced_rnx_cancel_customer_order_new()
{
    $check_ajax = check_ajax_referer( 'ced-rnx-ajax-seurity-string', 'security_check' );
    if ( $check_ajax ) 
    {
        $order_id = $_POST['order_id'];
        $the_order = wc_get_order($order_id);
        $payment_method = get_post_meta($order_id, '_payment_method', true);
        if( $payment_method == 'cod') {
            $items = $the_order->get_items();
            foreach ( $items as $item ) {
                $product_name = $item['name'];
                if( WC()->version < '3.0.0' )
                {
                    $product_quantity = $item['qty'];
                }
                else
                {
                    $product_quantity = $item['quantity'];
                }
                $product_id = $item['product_id'];
                $product_variation_id = $item['variation_id'];
                $product = apply_filters( 'woocommerce_order_item_product', $the_order->get_product_from_item( $item ), $item );
                if($product -> managing_stock())
                {
                    if( WC()->version < '3.0.0' )
                    {
                        $product->set_stock( $product_quantity, 'add' );

                    }
                    else
                    {	if($product_id >0){
                            if($product_variation_id > 0)
                            {
                                $total_stock = get_post_meta($product_variation_id,'_stock',true);
                                $total_stock = $total_stock + $product_quantity;
                                wc_update_product_stock( $product_variation_id,$total_stock, 'set' );
                            }
                            else
                            {
                                $total_stock = get_post_meta($product_id,'_stock',true);
                                $total_stock = $total_stock + $product_quantity;
                                wc_update_product_stock( $product_id,$total_stock, 'set' );
                            }
                        }
                    }
                }
            }
            $the_order->cancel_order(__('Order cancelled by customer.', 'woocommerce' ));

            $endpoints = get_option( 'woocommerce_myaccount_orders_endpoint', 'orders' );

            $url = get_permalink(get_option('woocommerce_myaccount_page_id'));
            $url .= "$endpoints";
            $success 	= __ ( 'Your order is cancelled', 'woocommerce-refund-and-exchange' );
            $notice 	= wc_add_notice ( $success );
            echo $url;
            wp_die();
        }
    }
}

add_filter( 'woocommerce_my_account_my_orders_actions', 'remove_cancel_button_conditionally', 10, 2 );
function remove_cancel_button_conditionally ($actions, $order) {
    global $wpdb;
    $query = $wpdb->get_results("SELECT vendor_order_status FROM {$wpdb->prefix}wcmp_vendor_orders WHERE order_id = $order->id ");
    foreach ($query as $item_status) {
        if ( $item_status->vendor_order_status == 'wh') {
            unset($actions['ced_rnx_cancel_order']); 
            break;  
        }
    }
    return $actions; 
}

<?php


include('admin_frontend_order.php');
/*
shipping_status :
0 -> not shipped
1 -> shpped via Aramex
2 -> delivered via Urkeed ( for customers in Jeddah )
*/


function send_email_to_storekeeper($vendor_id,$wc_order){
	$recipients = array(
	  get_option('storekeeper_email'),
	  get_user_meta($vendor_id , 'relationship_manager_email' , true)
	);
	$to = implode(',', $recipients);
	$subject = __('Vendor is ready','delivering');
	$message = get_items_as_html($vendor_id, $wc_order);
	$headers = "From: ".__('Urkeed Delivering System' , 'delivering')." <" . get_option('woocommerce_email_from_address') . "> \r\n";
	$headers.= "MIME-Version: 1.0\r\n";
  $headers.= "Content-Type: text/html;charset=utf-8 \r\n";
	$ch = mail($to, $subject, $message, $headers);
}
// **********************************************************


/*
 * @Author : Elham
 * Tracking shipments details in view order page
*/
function aramex_track_shipments($order) {
  if (!is_checkout()) {
        $tracking_no = get_post_meta($order->id, 'tracking_no', true);
				if(!$tracking_no)
					return ;

        $soapClient = new SoapClient(get_stylesheet_directory_uri() . '/aramex/shipments-tracking-api-wsdl.wsdl');
        $params = array('ClientInfo' => array('AccountCountryCode' => AramexVar::$acc_country,
				 'AccountEntity' => AramexVar::$acc_entity, 'AccountNumber' => AramexVar::$acc_num, 'AccountPin' => AramexVar::$acc_pin,
				  'UserName' => AramexVar::$acc_user, 'Password' => AramexVar::$acc_pass, 'Version' => AramexVar::$acc_v),
					'Transaction' => array('Reference1' => ''), 'Shipments' => array($tracking_no));
        // calling the method and printing results
        try {
            $auth_call = $soapClient->TrackShipments($params);
						if(!$auth_call || empty($auth_call->TrackingResults) || empty($auth_call->TrackingResults->KeyValueOfstringArrayOfTrackingResultmFAkxlpY) ){
							echo '<h4 class="woocommerce-order-details__title"> '.__('Shipment has been deleted from Aramex upon developer request','aramex').' </h4>';
							return;
						}
            $trackingResult = $auth_call->TrackingResults->KeyValueOfstringArrayOfTrackingResultmFAkxlpY->Value->TrackingResult; ?>
      <section class="woocommerce-order-details">
        <h4 class="woocommerce-order-details__title">
          <?php
            echo __('Tracking Number', 'woocommerce') . ' : '; ?>
          <!-- <a href="#!" style="color: #be3938;text-decoration: underline;" id="track-minimizer" > -->
            <?php
            echo $tracking_no; ?>
          <!-- </a> -->
        </h4>
      </section>

      <!-- <div id="track-toggle"> -->
      <table class="woocommerce-table woocommerce-table--order-details shop_table order_details" style="display: table!important;">
          <thead>
            <tr>
              <th class="woocommerce-table "><?php
            echo __('Date', 'aramex'); ?></th>
              <th class="woocommerce-table "><?php
            echo __('Location', 'aramex'); ?></th>
              <th class="woocommerce-table "><?php
            echo __('Status', 'aramex'); ?></th>
            </tr>
          </thead>

          <tbody>
            <?php
            // if the result is array then print via for loop
            if (is_array($trackingResult)) {
                foreach ($trackingResult as $value1) {
                    $removeT = str_replace('T', ' ', $value1->UpdateDateTime);
                    echo '<tr class="woocommerce-table__line-item ">';
                    echo '<td class="woocommerce-table ">' . $removeT . '</td>';
                    echo '<td class="woocommerce-table ">' . __($value1->UpdateLocation, 'aramex') . '</td>';
                    echo '<td class="woocommerce-table ">' . __($value1->UpdateDescription, 'aramex') . '</td>';
                    echo '</tr>';
                }
            } else { // if it is just object then print it
                $removeT = str_replace('T', ' ', $trackingResult->UpdateDateTime);
                echo '<tr class="woocommerce-table__line-item ">';
                echo '<td class="woocommerce-table ">' . $removeT . '</td>';
								echo '<td class="woocommerce-table ">' . __($trackingResult->UpdateLocation, 'aramex') . '</td>';
								echo '<td class="woocommerce-table ">' . __($trackingResult->UpdateDescription, 'aramex') . '</td>';
                echo '</tr>';
            } ?>
          </tbody>
      </table>
    <!-- </div> -->
    <?php
		  echo '<div class="wcfm-clearfix"></div><br/>';
        }
        catch(SoapFault $fault) {
            die('Error : ' . $fault->faultstring);
        }
    }
}
add_action('woocommerce_order_details_after_order_table', 'aramex_track_shipments');
// ********************************************************************************************************
function get_wcfm_order_id($wp) {
    if (isset($wp->query_vars['wcfm-orders-details']) && !empty($wp->query_vars['wcfm-orders-details'])) {
        return $wp->query_vars['wcfm-orders-details'];
    } else {
        return '';
    }
}
// ********************************************************************************************************
add_action('begin_wcfm_orders_details', 'vendor_send_shipment_to_warehouse');
function vendor_send_shipment_to_warehouse() {
    if (get_user_role() == 'dc_vendor') {
        global $wp, $WCMp, $wpdb;
        $vendor = new WCMp_Vendor(get_current_user_id());
        $order_id = get_wcfm_order_id($wp);
        $wc_order = new WC_Order($order_id);
        // echo get_items_as_html($vendor, $wc_order);
        // check location
        $order_vendor_obj = get_wcmp_vendor_orders(array('vendor_id' => $vendor->id, 'order_id' => $order_id));
        $vendor_order_status = $order_vendor_obj[0]->vendor_order_status;
        if (isset($_POST['update_vendor_order_status']) && $_POST['randcheck'] == $_SESSION['rand']) {
            $vendor_order_status = $_POST['state'];
            if (isset($vendor_order_status)) {
                $query = "UPDATE {$wpdb->prefix}wcmp_vendor_orders SET vendor_order_status = '$vendor_order_status' WHERE order_id = $order_id and vendor_id = $vendor->id";
                $wpdb->query($query);
            }
            if ($vendor_order_status == 'ready') {
							send_email_to_storekeeper($vendor->id , $wc_order);
            }
            unset($_SESSION['once']);
        } ?>
		<div class="wcfm-container wcfm-top-element-container" style="display: flex;"><?php
        if ($vendor_order_status == 'not_ready') { ?>
			<form method="post" action="">
				  <?php $rand = rand();
            $_SESSION['rand'] = $rand; ?>
  <input type="hidden" value="ready" name="state" />
    <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
    <h3><?php _e('Are you ready to Send the order ?', 'woocomerce'); ?></h3>
     <input type ="submit" class="wcfm_btn" id="update_vendor_order_status"  name="update_vendor_order_status" value = "Yes" >
   </form>
   <?php
        }
        if ($vendor_order_status == 'ready') {
?>
<form method="post" action=""><?php $rand = rand();
            $_SESSION['rand'] = $rand; ?>
  <input type="hidden" value="sent" name="state" />
  <h3><?php _e('Have you delivered it ?', 'woocomerce'); ?></h3>
   <input type ="submit" class="wcfm_btn" id="update_vendor_order_status"  name="update_vendor_order_status" value = "Yes" >
    <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
   </form>
         <?php
        }
        if ($vendor_order_status == 'sent') { ?>
				<h2><?php
            _e('Thank you, your order status is set to delivered.', 'woocomerce'); ?></h2>
				<?php
        }
        if ($vendor_order_status == 'wh') { ?>
				<h2><?php
            _e('Thank you, your order status is located in the warehouse.', 'woocomerce'); ?></h2>
				<?php
        }
        echo "</div>";
        echo '<div class="wcfm-clearfix"></div><br/>';
    }
}



// ********************************************************************************************************


function get_items_as_html($vendor_id, $order) {

    global $WCMp, $WCFM;
    $order_id = $order->id;

    $line_items = $order->get_items(apply_filters('woocommerce_admin_order_item_types', 'line_item'));
		add_filter('wcfm_current_vendor_id', function($id){
			return $vendor_id;
		});
    $line_items = apply_filters('wcfm_valid_line_items', $line_items, $order->get_id());

    $msg = '<head> <meta charset="UTF-8"/> </head><body>';
    $msg.= '<p>' . 'Vendor ' . get_user_meta($vendor_id, '_first_name', true) . ' ' . get_user_meta($vendor_id, '_last_name', true) .
		 ' is ready to submit his items of Order #' . $order_id . '</p>';
    $msg.= "<p>" . __('The pickup address and contacts details :', 'dc-woocommerce-multi-vendor') . "</p>";
    $msg.= "<p>" . __('Contact Person', 'dc-woocommerce-multi-vendor') . ' : '
		. get_user_meta($vendor_id, '_vendor_resp_fname', true) . ' ' .
		get_user_meta($vendor_id, '_vendor_resp_lname', true) . "</p>";
    $msg.= "<p>" . __('Country', 'dc-woocommerce-multi-vendor') . ' : ' .
		 get_user_meta($vendor_id, '_vendor_country', true) . "</p>";
    $msg.= "<p>" . __('City', 'dc-woocommerce-multi-vendor') . ' : ' .
		 get_user_meta($vendor_id, '_vendor_city', true) . "</p>";
    $msg.= "<p>" . __('Address', 'dc-woocommerce-multi-vendor') . ' 1 : ' .
		 get_user_meta($vendor_id, '_vendor_address_1', true) . "</p>";
    $msg.= "<p>" . __('Address', 'dc-woocommerce-multi-vendor') . ' 2 : ' .
		 get_user_meta($vendor_id, '_vendor_address_2', true) . "</p>";
    $msg.= "<p>" . __('Phone number', 'dc-woocommerce-multi-vendor') . ' : ' .
		 get_user_meta($vendor_id, '_vendor_resp_phone_key', true) . get_user_meta($vendor_id, '_vendor_resp_phone', true) . "</p>";
    $msg.= '<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">';
    $bar_title = __('Barcode', 'dc-woocommerce-multi-vendor');
    $sku_title = __('SKU', 'dc-woocommerce-multi-vendor');
    $product_title = __('Product', 'dc-woocommerce-multi-vendor');
    $qty_title = __('Quantity', 'dc-woocommerce-multi-vendor');
    $msg.= '<thead><tr>
	          <th scope="col" style="text-align:left; border: 1px solid #eee;">' . $bar_title . '</th>
	          <th scope="col" style="text-align:left; border: 1px solid #eee;">' . $sku_title . '</th>
	          <th scope="col" style="text-align:left; border: 1px solid #eee;">' . $product_title . '</th>
	          <th scope="col" style="text-align:left; border: 1px solid #eee;">' . $qty_title . '</th>
	        </tr>
	    </thead>';
    $msg.= '<tbody>';
    $count_items = 0;

    foreach ($line_items as $item_id => $item) {
        $count_items += 1;
        $variation_id = 0;
        if (isset($item['variation_id']) && !empty($item['variation_id'])) {
            $variation_id = $item['variation_id'];
        }

        $barcode = 0;
        if ($variation_id) {
					$barcode = get_post_meta($variation_id, '_vendor_barcode_var', true);
					if(!isset($barcode) || empty($barcode) || $barcode === '' ){
						 $barcode = get_post_meta($item['product_id'], '_vendor_barcode', true);
					}
				}
        else {
            // code...
            $barcode = get_post_meta($item['product_id'], '_vendor_barcode', true);
        }

        $msg.= '<tr class="">
         <!-- barcode -->
         <td scope="col" style="text-align:left; border: 1px solid #eee;" class="product-name">' . $barcode . '</td>';
				 $sku = '';
         if ($variation_id) {
					 $sku = get_post_meta($variation_id, '_sku', true);
					 if(!isset($sku) || empty($sku) || $sku === '' ){
						  $sku = get_post_meta($item['product_id'], '_sku', true);
					 }
         } else {
					 $sku = get_post_meta($item['product_id'], '_sku', true);
         }

        $msg.= '<!-- sku -->
         <td scope="col" style="text-align:left; border: 1px solid #eee;" class="product-name">' . $sku . '</td>';
        $name = '';
        if ($_product && !$_product->is_visible()) {
            $name = apply_filters('wcmp_woocommerce_order_item_name', $item['name'], $item);
        } else {
            $name = apply_filters('woocommerce_order_item_name', sprintf('<a href="%s">%s</a>', get_permalink($item['product_id']), $item['name']), $item);
        }

        // wc_display_item_meta($item);
        $msg.= '<td scope="col" style="text-align:left; border: 1px solid #eee;" class="product-name"> ' . $name . '</td>';
        $msg.= '<td scope="col" style="text-align:left; border: 1px solid #eee;">' . $item['qty'] . '</td></tr>';
    }

    $msg.= '</tbody></table>';
    $msg.= "<p>" . __('Number of items', 'dc-woocommerce-multi-vendor') . ' : ' . $count_items . "</p>";
		$msg.= "<p>" . __('Vendor Signature', 'dc-woocommerce-multi-vendor') . " : </p>";
    $msg.= "<p>" . __('Representative Signature', 'dc-woocommerce-multi-vendor') . " : </p>";
    $msg.= "<p>" . __('Date', 'dc-woocommerce-multi-vendor') . " : </p>";
    $msg.= '</body>';

    return $msg;
}

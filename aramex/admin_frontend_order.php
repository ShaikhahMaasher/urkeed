<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

function insert_attachment( $file_handler, $post_id, $settpdf='false' ) {
	//
  // // check to make sure its a successful upload
  // if ( $_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK ) __return_false();

	echo 'url : '.$file_handler.', o id : '.$post_id;

  require_once( ABSPATH . 'wp-admin' . '/includes/image.php' );
  require_once( ABSPATH . 'wp-admin' . '/includes/file.php' );
  require_once( ABSPATH . 'wp-admin' . '/includes/media.php' );

  $attach_id = media_handle_upload( $file_handler, $post_id );
	pre($attach_id);


  if ( $settpdf ) update_post_meta( $post_id,'_pdf_id', $attach_id );

  return $attach_id;
}



class AramexVar{
	// test JED
	// $acc_country = 'SA'; $acc_entity = 'JED'; $acc_num= '115051'; $acc_pin= '246151';
	// $acc_user= 'testingapi@aramex.com';	$acc_pass= 'R123456789$r'; $acc_v= 'v1.0';
	// $acc_user= 'e.alshehri@urkeed.com';
	// $acc_pass= '1088903560L@e'; $acc_v= 'v1.0';
	// test AMM
	// $acc_country = 'JO'; $acc_entity = 'AMM'; $acc_num= '20016'; $acc_pin= '331421'; $acc_user= 'testingapi@aramex.com';
	// $acc_pass= 'R123456789$r'; $acc_v= 'v1.0';
	// real
	public static $acc_country = 'SA';
	public static $acc_entity = 'JED';
	public static $acc_num = '139391';
	public static $acc_pin = '321421';
	public static $acc_user = 'e.alshehri@urkeed.com';
	public static $acc_pass = '1088903560L@e';
	public static $acc_v = 'v1.0';
}

function cc1()
{

	if (get_user_secondary_role()=='shop_manager') {

		  $rand = rand();
		  $_SESSION['rand'] = $rand;
		  ?>
		<input type="hidden" value="ready" name="state" />
		<input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
		  <input type ="submit" class="wcfm_btn" id="update_vendor_order_status"
		  name="update_vendor_order_status" value = "<?php _e('Update');?>" >
		  </form>
     <?php
	}
}
add_action('end_wcfm_orders_details', 'cc1');


function print_invoice($order_id){
	global $wcdn;
	?>
	<div class="wcfm-container wcfm-top-element-container">
		<div class="print-actions">
			<?php foreach( WooCommerce_Delivery_Notes_Print::$template_registrations as $template_registration ) : ?>
				<?php if( get_option( 'wcdn_template_type_' . $template_registration['type'] ) == 'yes' && $template_registration['type'] !== 'order' ) : ?>

					<a href="<?php echo wcdn_get_print_link( $order_id, $template_registration['type'] ); ?>"
						 class="button print-preview-button <?php echo $template_registration['type']; ?>" target="_blank"
						 alt="<?php esc_attr_e( __( $template_registration['labels']['print'], 'woocommerce-delivery-notes' ) ); ?>"><?php _e( $template_registration['labels']['print'], 'woocommerce-delivery-notes' ); ?></a>

				<?php endif; ?>
			<?php endforeach; ?>
			<span class="print-preview-loading spinner"></span>
		</div>
	</div>
	<div class="wcfm-clearfix"></div>
	<br>
	<?php
}


add_action('begin_wcfm_orders_details', 'send_shipping_order_to_aramex');
function send_shipping_order_to_aramex()
{

	// if (get_user_secondary_role()=='shop_manager') {
		global $wp, $WCMp, $wpdb;
		// shipment
		$shipment = '';
		// get order id from query
		$order_id = get_wcfm_order_id($wp);

		print_invoice($order_id);
		$wc_order = new WC_Order($order_id);

		// get items to calculate weight
		$line_items = $wc_order->get_items();
		$order_wieght = calc_weight($line_items);

		$order_total_amount_SAR = $wc_order->get_total();
    if(isset($_POST['update_vendor_order_status']) && $_POST['randcheck'] == $_SESSION['rand']){
			foreach ($line_items as $loop_item_id => $loop_item_value) {
				$vendor_order_status = $_POST[$loop_item_id.'_vendor_order_status'];
				if (isset($vendor_order_status)) {
						$vendor_id = $_POST[$loop_item_id.'_vendor_id'];
						$query = "UPDATE {$wpdb->prefix}wcmp_vendor_orders SET vendor_order_status = '$vendor_order_status'
						WHERE order_id = $order_id and vendor_id = $vendor_id";
						$wpdb->query($query);
				}
				if ($vendor_order_status == 'ready') {
							send_email_to_storekeeper($vendor_id , $wc_order);
				}
			}
    }

		if (isset($_POST['send_via_urkeed']) && get_post_meta($order_id, 'shipping_status', true) == 0) {
			unset($_POST['send_via_urkeed']);
			// set the shipping status which mean that sent via Urkeed
      update_post_meta($order_id, 'shipping_status', 2);
      $wc_order->update_status('completed', 'Send to customer Via Urkeed delivering system');
		}
		// if the admin clicked on ship via Aramex and the shipments no shipped yet
		if (isset($_POST['ship_order_btn']) && get_post_meta($order_id, 'shipping_status', true) == 0) {
			unset($_POST['ship_order_btn']);
			// get payment method of this order
			$payment_method = get_post_meta($order_id, '_payment_method', true);
			// customer details
			$customer_id = get_post_meta($order_id, '_customer_id', true);
			$customer_fname = get_post_meta($order_id, '_shipping_first_name', true) . ' ' . get_post_meta($order_id, '_shipping_last_name', true);
			$customer_country = get_post_meta($order_id, '_shipping_country', true);
			$customer_city = get_post_meta($order_id, '_shipping_city', true);
			$customer_address = get_post_meta($order_id, '_shipping_address_1', true) . ' , ' . get_post_meta($order_id, '_shipping_address_2', true);
			$customer_phone = get_post_meta($order_id, '_billing_phone', true);
			$customer_email = get_post_meta($order_id, '_billing_email', true);
			// if the customer choose to pay COD
			$services = '';
			$amount_COD = 0;
			if ($payment_method == 'cod') {
				$services = 'CODS';
				$amount_COD = round($order_total_amount_SAR);
			}
			// Simple Object Access Protocol
			$path = get_stylesheet_directory_uri() . '/aramex/shipping-services-api-wsdl.wsdl';
			// $path = 'https://ws.dev.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc?singleWsdl';
			$soapClient = new SoapClient($path);
			$params = array(
				'Shipments' => array(
					'Shipment' => array(
						'Shipper' => array(
							'Reference1' => '',
							'Reference2' => 'Order number : ' . $order_id,
							'AccountNumber' => AramexVar::$acc_num,
							'PartyAddress' => array(
								'Line1' => get_option('woocommerce_store_address') ,
								'Line2' => get_option('woocommerce_store_address_2') ,
								'Line3' => '',
								'City' => get_option('woocommerce_store_city') ,
								'StateOrProvinceCode' => '',
								'PostCode' => '',
								'CountryCode' => get_option('woocommerce_default_country')
							) ,
							'Contact' => array(
								'Department' => '',
								'PersonName' => get_option('storekeeper_name') ,
								'Title' => '',
								'CompanyName' => get_option('blogname') ,
								'PhoneNumber1' => get_option('urkeed_phone') ,
								'PhoneNumber1Ext' => '',
								'PhoneNumber2' => '',
								'PhoneNumber2Ext' => '',
								'FaxNumber' => '',
								'CellPhone' => get_option('storekeeper_cellphone') ,
								'EmailAddress' => get_option('storekeeper_email') ,
								'Type' => ''
							) ,
						) ,
						'Consignee' => array(
							'Reference1' => 'Order no. ' . $order_id,
							'Reference2' => '',
							'AccountNumber' => AramexVar::$acc_num,
							'PartyAddress' => array(
								'Line1' => $customer_address,
								'Line2' => '',
								'Line3' => '',
								'City' => $customer_city,
								'StateOrProvinceCode' => '',
								'PostCode' => '',
								'CountryCode' => $customer_country
							) ,
							'Contact' => array(
								'Department' => '',
								'PersonName' => $customer_fname,
								'Title' => '',
								'CompanyName' => get_option('blogname') ,
								'PhoneNumber1' => get_option('urkeed_phone') ,
								'PhoneNumber1Ext' => '',
								'PhoneNumber2' => '',
								'PhoneNumber2Ext' => '',
								'FaxNumber' => '',
								'CellPhone' => $customer_phone,
								'EmailAddress' => $customer_email,
								'Type' => ''
							) ,
						) ,
						'ThirdParty' => array(
							'Reference1' => '',
							'Reference2' => '',
							'AccountNumber' => AramexVar::$acc_num,
							'PartyAddress' => array(
								'Line1' => '',
								'Line2' => '',
								'Line3' => '',
								'City' => '',
								'StateOrProvinceCode' => '',
								'PostCode' => '',
								'CountryCode' => '',
							) ,
							'Contact' => array(
								'Department' => '',
								'PersonName' => '',
								'Title' => '',
								'CompanyName' => '',
								'PhoneNumber1' => '',
								'PhoneNumber1Ext' => '',
								'PhoneNumber2' => '',
								'PhoneNumber2Ext' => '',
								'FaxNumber' => '',
								'CellPhone' => '',
								'EmailAddress' => '',
								'Type' => ''
							) ,
						) ,
						'Reference1' => 'Total : ' . $order_total_amount_SAR,
						'Reference2' => '',
						'Reference3' => '',
						'ForeignHAWB' => '',
						'TransportType' => 0,
						'ShippingDateTime' => time() ,
						'DueDate' => time() ,
						'PickupLocation' => '',
						'PickupGUID' => '',
						'Comments' => '',
						'AccountingInstrcutions' => '',
						'OperationsInstructions' => '',
						'Details' => array(
							'Dimensions' => array( // optional
								'Length' => 0,
								'Width' => 0,
								'Height' => 0,
								'Unit' => 'CM',
							) ,
							'ActualWeight' => array( /****** REQUIRED *****/
								'Value' => $order_wieght,
								'Unit' => 'Kg'
							) ,
							'ProductGroup' => 'DOM', /****** REQUIRED *****/
							'ProductType' => 'OND', /****** REQUIRED *****/
							'PaymentType' => 'P', /****** REQUIRED *****/
							'PaymentOptions' => 'ACCT',
							'Services' => $services,
							'NumberOfPieces' => 1, /****** REQUIRED *****/
							'DescriptionOfGoods' => 'Clothes', /****** REQUIRED *****/
							'GoodsOriginCountry' => 'SA', /****** REQUIRED *****/
							'CashOnDeliveryAmount' => array(
								'Value' => $amount_COD,
								'CurrencyCode' => 'SAR'
							) ,
							'InsuranceAmount' => array(
								'Value' => 0,
								'CurrencyCode' => ''
							) ,
							'CollectAmount' => array( /*X -> payment type : C */
								'Value' => 0,
								'CurrencyCode' => ''
							) ,
							'CashAdditionalAmount' => array(
								'Value' => 0,
								'CurrencyCode' => ''
							) ,
							'CashAdditionalAmountDescription' => '', /* PaymentType "3" */
							'CustomsValueAmount' => array(
								'Value' => 0,
								'CurrencyCode' => ''
							) ,
							'Items' => array()
						) ,
					) ,
				) ,
				'ClientInfo' => array(
					'AccountCountryCode' => AramexVar::$acc_country,
					'AccountEntity' => AramexVar::$acc_entity,
					'AccountNumber' => AramexVar::$acc_num,
					'AccountPin' => AramexVar::$acc_pin,
					'UserName' => AramexVar::$acc_user,
					'Password' => AramexVar::$acc_pass,
					'Version' => AramexVar::$acc_v
				) ,
				'Transaction' => array(
					'Reference1' => 'Order id : ' . $order_id,
					'Reference2' => '',
					'Reference3' => '',
					'Reference4' => '',
					'Reference5' => '',
				) ,
				'LabelInfo' => array(
					'ReportID' => 9201,
					'ReportType' => 'URL',
				) ,
			);
			try {
				$auth_call = $soapClient->CreateShipments($params);
				$shipment = $auth_call->Shipments;
				if($shipment){
					if ($shipment->ProcessedShipment->HasErrors) {
						echo 'Error code -> ' . $shipment->ProcessedShipment->Notifications->Notification->Code . '<br />';
						echo 'Error details -> ' . $shipment->ProcessedShipment->Notifications->Notification->Message . '<br />';
						echo 'Please contact the IT support with this code';
					}
					else {
						$tracking_no = $shipment->ProcessedShipment->ID;
						$tracking_url = $shipment->ProcessedShipment->ShipmentLabel->LabelURL;

						$attach_id = insert_attachment_from_url($tracking_no,$tracking_url, $order_id);

						// set status to shipped via aramex
						update_post_meta($order_id, 'shipping_status', 1);
						update_post_meta($order_id, 'tracking_no', $tracking_no);
						update_post_meta($order_id, 'tracking_url', wp_get_attachment_url( $attach_id ));
						$wpdb->query("UPDATE {$wpdb->prefix}wcmp_vendor_orders SET shipping_status = '1' WHERE order_id = $order_id");
					}
				}
				else{
					pre($params);
					pre($auth_call);
					pre($shipment);
				}
			}
			catch(SoapFault $fault) {
				echo '<h1> FAILED </h1>';
				die('Error : ' . $fault->faultstring);
			}
		}
		// customer in jeddah & order not delivered => send via urkeed
		if (get_post_meta($order_id, '_shipping_city', true) == 'Jeddah' &&
    get_post_meta($order_id, 'shipping_status', true) == 0) {
?>
  			<div class="wcfm-container wcfm-top-element-container">
          <form method="post" action="">
  			 			 <input type ="submit" class="wcfm_btn" id="send_via_urkeed"  name="send_via_urkeed"
  			 			 value = "<?php _e('Click here only to confirm the delivering', 'woocommerce'); ?>" >
  			 		 </form>
  			</div>
  			<div class="wcfm-clearfix"></div><br/>
  			<?php
		}
		// customer in jeddah & order has delivered => print details
		elseif (get_post_meta($order_id, '_shipping_city', true) == 'Jeddah' && get_post_meta($order_id, 'shipping_status', true) == 2) {
?>
  					<div class="wcfm-container wcfm-top-element-container">
  							<h2><?php
			_e('Thank you', 'woocomerce'); ?></h2>
  					</div>
  					<div class="wcfm-clearfix"></div><br />
  				<?php
		}
		// customer not in jeddah & order not delivered => ship via aramex
		elseif (get_post_meta($order_id, '_shipping_city', true) != 'Jeddah' && get_post_meta($order_id, 'shipping_status', true) == 0) {
?>
  				<div class="wcfm-container wcfm-top-element-container">
  					<h2><?php
			_e('Are you ready to ship the order ?', 'woocomerce'); ?></h2>
  					<form  method="post" action="">
  						<input type ="submit" class="wcfm_btn" id="ship_order_btn"  name="ship_order_btn" value = "<?php
			_e('Ship Order', 'woocommerce'); ?>" >
  					</form>
  				</div>
  				<div class="wcfm-clearfix"></div><br />

  				<?php
		}
		// customer not in jeddah & order has delivered => print details
		elseif (get_post_meta($order_id, '_shipping_city', true) != 'Jeddah' && get_post_meta($order_id, 'shipping_status', true) == 1) {
			$tracking_no = get_post_meta($order_id, 'tracking_no', true);
			$report_url = get_post_meta($order_id, 'tracking_url', true);
?>
  				<div class="wcfm-container wcfm-top-element-container">
  					<h2><?php
			_e('Order Shipped with tracking No. ', 'woocomerce');
			echo $tracking_no; ?></h2>
  					<a target="_blank" href="<?php
			echo $report_url; ?>" class="wcfm_btn" id="report_aramex_url" data-orderid="<?php
			echo $order_id; ?>">
  						<?php
			_e('Click here to download and print Aramex report.', 'woocommerce'); ?></a>
  				</div>
  				<div class="wcfm-clearfix"></div><br />

  				<?php
		// }
?> <form method="post" action="" > <?php

	}
}
// ********************************************************************************************************
function calc_weight($line_items)
{
	$order_wieght = 0;
	foreach($line_items as $item_id => $item) {
		$_product = $item->get_product();
		$order_wieght+= ($_product->get_weight() * $item->get_quantity());
	}
	$order_wieght = ($order_wieght === 0) ? 1 : $order_wieght;
	return $order_wieght;
}


/**
 * Insert an attachment from an URL address.
 *
 * @param  String $url
 * @param  Int    $post_id
 * @param  Array  $meta_data
 * @return Int    Attachment ID
 */
function insert_attachment_from_url($tracking_no , $url, $post_id = null) {

	if( !class_exists( 'WP_Http' ) )
		include_once( ABSPATH . WPINC . '/class-http.php' );

	$http = new WP_Http();
	$response = $http->request( $url );
	if( $response['response']['code'] != 200 ) {
		return false;
	}

	$upload = wp_upload_bits( basename($url), null, $response['body'] );
	if( !empty( $upload['error'] ) ) {
		return false;
	}

	$file_path = $upload['file'];
	$file_name = basename( $file_path );
	$file_type = wp_check_filetype( $file_name, null );
	$attachment_title = sanitize_file_name( pathinfo( $file_name, PATHINFO_FILENAME ) );
	$wp_upload_dir = wp_upload_dir();

	$post_info = array(
		'guid'				=> $wp_upload_dir['url']. $file_name,
		'post_mime_type'	=> $file_type['type'],
		'post_title'		=> 'AWB : '.$tracking_no,
		'post_content'		=> '',
		'post_status'		=> 'inherit',
	);

	// Create the attachment
	$attach_id = wp_insert_attachment( $post_info, $file_path, $post_id );

	// Include image.php
	require_once( ABSPATH . 'wp-admin/includes/image.php' );

	// Define attachment metadata
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file_path );

	// Assign metadata to attachment
	wp_update_attachment_metadata( $attach_id,  $attach_data );

	return $attach_id;

}

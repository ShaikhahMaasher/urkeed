<?php
/**
 * The template for displaying vendor dashboard
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/cutomer_support_details_to_buyer.php
 *
 * @author 		WC Marketplace
 * @package 	WCMp/Templates
 * @version   2.3.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $WCMp ;

if(current_user_can('dc_vendor')){
	return;
}
?>


<div class="customer_support_details" style="display: inline-block;">
	<div id="minimize-content">
		<h2 class="woocommerce-order-details__title">
			<a href="#!" style="text-decoration: none;" > <span id="minimizer"> + </span></a>
			<?php echo __('Customer Support Details', 'dc-woocommerce-multi-vendor'); ?>
		</h2>
	</div>


	<div id="details-toggle">
	<table class="cust_support_table" style="display: flex!important;">
		<tbody>
			<?php $cc = 0;
			if( isset( $capability_settings['can_vendor_add_customer_support_details'] ) ) {
				foreach ( $vendor_array as $vendor_id => $products) {
					$vendor_meta = get_user_meta( $vendor_id );

					if( (
							isset($vendor_meta['_vendor_customer_phone'][0]) &&
							isset($vendor_meta['_vendor_customer_email'][0]) &&
							isset($vendor_meta['_vendor_csd_return_address1'][0]) &&
							isset($vendor_meta['_vendor_csd_return_city'][0]) &&
							isset($vendor_meta['_vendor_csd_return_state'][0]) &&
							isset($vendor_meta['_vendor_csd_return_zip'][0])
							)
					) {
					?>
					<?php if($cc == 0) { ?>
						<tr>
						<th style="padding:10px 10px; background:none; border-right: 1px solid #e4e4e4; border-bottom: 1px solid #e4e4e4;	 width:100%;" align="left" valign="top"><?php echo __('Vendor Details', 'dc-woocommerce-multi-vendor'); ?></th>

						</tr>
					<?php } ?>
					<tr>
						<td style="padding:10px 10px; background:none; border-right: 1px solid #e4e4e4; border-bottom: 1px solid #e4e4e4; width:100%;" align="left" valign="top">
							<p><strong><?php echo __('Vendor Name', 'dc-woocommerce-multi-vendor');?> </strong><br>
							<?php echo $vendor_meta['nickname'][0] ?> </p>
							<p><strong><?php echo __('Product Name', 'dc-woocommerce-multi-vendor');?> </strong> <br>
								 <?php echo $products; ?>
							</p>
							<p style="border-bottom:1px solid #eeeeee; padding-bottom:10px"> <strong><?php echo __('Customer Support Details', 'dc-woocommerce-multi-vendor');?></strong></p>
							<?php if(isset($vendor_meta['_vendor_customer_email'][0])) { ?>
							<p><strong><?php echo __('Email : ','dc-woocommerce-multi-vendor');?></strong><br>
							<a style="color:#505050;font-weight:normal;text-decoration:underline" href="mailto:<?php echo $vendor_meta['_vendor_customer_email'][0]; ?>" target="_blank"><?php echo $vendor_meta['_vendor_customer_email'][0]; ?></a>
							</p>
							<?php }?>
							<?php if(isset($vendor_meta['_vendor_customer_phone'][0])) { ?>
							<p><strong><?php echo __('Phone : ','dc-woocommerce-multi-vendor'); ?></strong> <br>
							<?php echo $vendor_meta['_vendor_customer_phone'][0]; ?></p>
							<?php }?>
							<p><strong><?php echo __('Return Address ', 'dc-woocommerce-multi-vendor');?></strong></p>
							<p>
								<?php if(isset($vendor_meta['_vendor_csd_return_address1'][0])) {  echo $vendor_meta['_vendor_csd_return_address1'][0]; ?><br> <?php }?>
								<?php if(isset($vendor_meta['_vendor_csd_return_address2'][0])) { echo $vendor_meta['_vendor_csd_return_address2'][0]; ?><br> <?php }?>
								<?php if(isset($vendor_meta['_vendor_csd_return_city'][0])) { echo $vendor_meta['_vendor_csd_return_city'][0]; ?><br> <?php }?>
								<?php if(isset($vendor_meta['_vendor_csd_return_state'][0])) { echo $vendor_meta['_vendor_csd_return_state'][0]; ?><br> <?php }?>
								<?php if(isset($vendor_meta['_vendor_csd_return_country'][0])) { echo $vendor_meta['_vendor_csd_return_country'][0]; ?><br> <?php }?>
								<?php if(isset($vendor_meta['_vendor_csd_return_zip'][0])) { echo $vendor_meta['_vendor_csd_return_zip'][0]; } ?>
							</p>


							</td>

					</tr>
					<?php $cc++;
					}
				}
			}
			else {
				?>
						<tr>
						<td style="padding:10px 10px; background:none; border-right: 1px solid #e4e4e4; border-bottom: 1px solid #e4e4e4; width:100%;" align="left" valign="top">


						<?php if($customer_support_details_settings['csd_email']) { ?>
							<p><strong><?php echo __('Email','woocommerce').' : ';?></strong>
							<a style="color:#505050;font-weight:normal;text-decoration:underline"
							href="mailto:<?php echo $customer_support_details_settings['csd_email']; ?>"
							 target="_blank"><?php echo $customer_support_details_settings['csd_email']; ?></a>
							</p>
							<?php }?>
							<?php if($customer_support_details_settings['csd_phone']){ ?>
								<p><strong><?php echo __('Phone','woocommerce').' : '; ?></strong>
								<?php echo $customer_support_details_settings['csd_phone'];?></p>
							<?php }
							if($customer_support_details_settings['csd_return_address_1']||
									$customer_support_details_settings['csd_return_address_2'] ||
									$customer_support_details_settings['csd_return_city'] ||
									$customer_support_details_settings['csd_return_state']||
									$customer_support_details_settings['csd_return_country'] ||
									$customer_support_details_settings['csd_return_country'] ||
									$customer_support_details_settings['csd_return_zipcode']) {
							?>
							<p><strong><?php echo __('Return Address', 'woocommerce').' : ';?></strong></p>

							<p>
								<?php if($customer_support_details_settings['csd_return_address_1']) { ?>
									<p><strong><?php echo __('Address','woocommerce').' 1 : '; ?></strong>
										<?php _e($customer_support_details_settings['csd_return_address_1'],'woocommerce');?></p>
								<?php }?>
								<?php if($customer_support_details_settings['csd_return_address_2']) { ?>
									<p><strong><?php echo __('Address','woocommerce').' 2 : '; ?></strong>
										<?php _e($customer_support_details_settings['csd_return_address_2'],'woocommerce');?></p>
								<?php }?>
								<?php if($customer_support_details_settings['csd_return_city']) { ?>
									<p><strong><?php echo __('City','woocommerce').' : '; ?></strong>
										<?php _e($customer_support_details_settings['csd_return_city'],'woocommerce');?></p>
								<?php }?>
								<?php if($customer_support_details_settings['csd_return_state']) { ?>
									<p><strong><?php echo __('State','woocommerce').' : '; ?></strong>
									<?php _e($customer_support_details_settings['csd_return_state'],'woocommerce');?></p>

								<?php }?>
								<?php if($customer_support_details_settings['csd_return_country']) { ?>
									<p><strong><?php echo __('Country','woocommerce').' : '; ?></strong>
									<?php _e($customer_support_details_settings['csd_return_country'],'woocommerce');?></p>

								<?php }?>
								<?php if($customer_support_details_settings['csd_return_zipcode']) { ?>
									<p><strong><?php echo __('Postcode','woocommerce').' : '; ?></strong>
									<?php _e($customer_support_details_settings['csd_return_zipcode'],'woocommerce');?></p>
								<?php }?>
							</p>


						</tr>
				<?php
			}
			}?>
		</tbody>
	</table>
	</div>
	<script>$('#details-toggle').slideToggle();</script>

</div>

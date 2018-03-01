<?php
/**
 * The template for displaying demo plugin content.
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/emails/admin-new-vendor-account.php
 *
 * @author 		WC Marketplace
 * @package 	dc-product-vendor/Templates
 * @version   0.0.1
 */

global $WCMp;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$user = $user = get_user_by( 'email', $user_email );
$user_id = $user->ID; // Get the user ID
?>
<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><?php printf( __( "A new user has applied to be a vendor on %s.",
 'dc-woocommerce-multi-vendor' ), esc_html( $blogname )); ?></p>

 <h4> <?php echo __('General Vendor Information', 'wcmp'); ?> </h4>
 <table class="form-table">
    <tbody>
      <!-- commercial number -->
       <tr>
          <th>
             <p>
             <?php
                _e('Commercial Registration Number', 'woocommerce'); ?>
             </p>
          </th>
          <td>
             <p> <?php echo esc_html(get_user_meta($user_id, '_vendor_commercial_number', true)); ?>
             </p>
          </td>
       </tr>
       <!-- company name -->
       <tr>
          <th>
             <p>
             <?php
                _e('Company Name', 'woocommerce'); ?>
             </p>
          </th>
          <td>
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_company', true)); ?></p>
          </td>
       </tr>
       <!-- phone number  -->
       <tr>
          <th>
             <p>
             <?php
                _e('Phone Number', 'woocommerce'); ?>
             </p>
          </th>
          <td>
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_phone', true)); ?></p>
          </td>
       </tr>
       <!-- responsible first name -->
       <tr>
          <th>
             <p>
             <?php
                _e('Responsible first name', 'woocommerce'); ?>
             </p>
          </th>
          <td>
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_resp_fname', true)); ?></p>
          </td>
       </tr>
       <!-- responsible last name -->
       <tr>
          <th>
             <p>
             <?php
                _e('Responsible last name', 'woocommerce'); ?>
             </p>
          </th>
          <td>
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_resp_lname', true)); ?></p>
          </td>
       </tr>
       <!-- responsible phone number -->
       <tr>
          <th>
             <p>
             <?php
                _e('Responsible phone number', 'woocommerce'); ?>
             </p>
          </th>
          <td>
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_resp_phone', true)); ?></p>
          </td>
       </tr>
       <!-- responsible email -->
       <tr>
          <th>
             <p>
             <?php
                _e('Responsible email', 'woocommerce'); ?>
             </p>
          </th>
          <td>
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_resp_email', true)); ?></p>
          </td>
       </tr>
    </tbody>
 </table>

 <h4> <?php echo __('Shipping Address', 'wcmp'); ?> </h4>
 <table class="form-table">
    <tbody>
       <tr>
          <th>
             <!-- country -->
             <p>
             <?php
                _e('Country', 'woocommerce'); ?>
             </p>
             </td>
          <td>
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_country', true)); ?></p>
          </td>
       </tr>
       <tr>
          <th>
             <p>
             <?php
                _e('State', 'woocommerce'); ?>
             </p>
          </th>
          <td>
             <!-- state -->
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_state', true)); ?></p>
          </td>
       </tr>
       <tr>
          <th>
             <!-- city -->
             <p>
             <?php
                _e('City', 'woocommerce'); ?>
             </p>
          </th>
          <td>
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_city', true)); ?></p>
          </td>
       </tr>
       <tr>
          <th>
             <!-- address -->
             <p>
             <?php
                _e('Address', 'woocommerce'); ?> 1
             </p>
          </th>
          <td>
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_address_1', true)); ?></p>
          </td>
       </tr>
       <tr>
          <th>
             <!-- address -->
             <p>
             <?php
                _e('Address', 'woocommerce'); ?> 1
             </p>
          </th>
          <td>
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_address_2', true)); ?></p>
          </td>
       </tr>
       <tr>
          <th>
             <!-- postcode -->
             <p>
             <?php
                _e('Postcode', 'woocommerce'); ?>
             </p>
          </th>
          <td>
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_postcode', true)); ?></p>
          </td>
       </tr>
    </tbody>
 </table>

 <h4> <?php echo __('Returning Address', 'wcmp'); ?> </h4>
 <table class="form-table">
    <tbody>
      <tr>
         <th>
            <!-- email -->
            <p>
            <?php
               _e('Email', 'woocommerce'); ?>
            </p>
            </td>
         <td>
            <p><?php
               echo esc_html(get_user_meta($user_id, '_vendor_customer_email', true)); ?></p>
         </td>
      </tr>
      <tr>
        <th>
           <!-- phone -->
           <p>
           <?php
              _e('Phone number', 'woocommerce'); ?>
           </p>
           </td>
        <td>
           <p><?php
              echo esc_html(get_user_meta($user_id, '_vendor_customer_phone', true)); ?></p>
        </td>
     </tr>
       <tr>
          <th>
             <!-- country -->
             <p>
             <?php
                _e('Country', 'woocommerce'); ?>
             </p>
             </td>
          <td>
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_csd_return_country', true)); ?></p>
          </td>
       </tr>
       <tr>
          <th>
             <p>
             <?php
                _e('State', 'woocommerce'); ?>
             </p>
          </th>
          <td>
             <!-- state -->
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_csd_return_state', true)); ?></p>
          </td>
       </tr>
       <tr>
          <th>
             <!-- city -->
             <p>
             <?php
                _e('City', 'woocommerce'); ?>
             </p>
          </th>
          <td>
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_csd_return_city', true)); ?></p>
          </td>
       </tr>
       <tr>
          <th>
             <!-- address -->
             <p>
             <?php
                _e('Address', 'woocommerce'); ?> 1
             </p>
          </th>
          <td>
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_csd_return_address1', true)); ?></p>
          </td>
       </tr>
       <tr>
          <th>
             <!-- address -->
             <p>
             <?php
                _e('Address', 'woocommerce'); ?> 1
             </p>
          </th>
          <td>
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_csd_return_address2', true)); ?></p>
          </td>
       </tr>
       <tr>
          <th>
             <!-- postcode -->
             <p>
             <?php
                _e('Postcode', 'woocommerce'); ?>
             </p>
          </th>
          <td>
             <p><?php
                echo esc_html(get_user_meta($user_id, '_vendor_csd_return_zip', true)); ?></p>
          </td>
       </tr>
    </tbody>
 </table>
<?php do_action( 'wcmp_email_footer' ); ?>

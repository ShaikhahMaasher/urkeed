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
$vendor = new WCMp_Vendor(absint($vendor_id));
$vendor_items_dtl = $vendor->vendor_order_item_table($order, $vendor_id);
do_action('woocommerce_email_header', $email_heading);
?>

<p><?php printf(__('Vendor %s is ready to submit his items of Order #%s', 'dc-woocommerce-multi-vendor'),
                $vendor->first_name . ' ' . $vendor->last_name , $order_id.' '); ?></p>

<p><?php echo __('The pickup address and contacts details :', 'dc-woocommerce-multi-vendor'); ?></p>
<p><?php echo __('Contact Person', 'dc-woocommerce-multi-vendor').' : '.  get_user_meta($vendor , '_vendor_resp_fname' , true)
. ' '. get_user_meta($vendor , '_vendor_resp_lname' , true); ?></p>
<p><?php echo __('Country', 'dc-woocommerce-multi-vendor').' : '. get_user_meta($vendor , '_vendor_country' , true); ?></p>
<p><?php echo __('City', 'dc-woocommerce-multi-vendor').' : '.  get_user_meta($vendor , '_vendor_city' , true); ?></p>
<p><?php echo __('Address', 'dc-woocommerce-multi-vendor').' 1 : '.  get_user_meta($vendor , '_vendor_address_1' , true); ?></p>
<p><?php echo __('Address', 'dc-woocommerce-multi-vendor').' 2 : '.  get_user_meta($vendor , '_vendor_address_2' , true); ?></p>
<p><?php echo __('Phone number', 'dc-woocommerce-multi-vendor').' : '.  get_user_meta($vendor , '_vendor_resp_phone_key' , true).
                            get_user_meta($vendor , '_vendor_resp_phone' , true); ?></p>


<?php do_action('woocommerce_email_before_order_table', $order, true, false); ?>
<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
    <thead>
        <tr>
          <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e('Barcode', 'dc-woocommerce-multi-vendor'); ?></th>
          <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e('SKU', 'dc-woocommerce-multi-vendor'); ?></th>
            <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e('Product', 'dc-woocommerce-multi-vendor'); ?></th>
            <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e('Quantity', 'dc-woocommerce-multi-vendor'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $vendor_items = $vendor->get_vendor_items_from_order($order->get_id(), $vendor->id);
        foreach ($vendor_items as $item_id => $item) {
          $_product = apply_filters('wcmp_woocommerce_order_item_product', $order->get_product_from_item($item), $item);

          $variation_id = 0;
          if (isset($item['variation_id']) && !empty($item['variation_id'])) {
              $variation_id = $item['variation_id'];
          }

          $p = '';
          if ($variation_id) {
            $p = new WC_Product($variation_id);
          } else {
            $p = new WC_Product($item['product_id']);
          }

            ?>
            <tr class="">
              <!-- barcode -->
              <td scope="col" style="text-align:left; border: 1px solid #eee;" class="product-name">
                  <?php
                  if($variation_id)
                    echo get_post_meta($variation_id , '_vendor_barcode_var' , true);
                  else {
                    # code...
                    echo get_post_meta($item['product_id'] , '_vendor_barcode_var' , true);
                  }
                  ?>
              </td>

              <!-- sku -->
              <td scope="col" style="text-align:left; border: 1px solid #eee;" class="product-name">
                  <?php
                    echo $p->get_sku();
                  ?>
              </td>

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

            </tr>
            <?php
        }

        ?>
    </tbody>
</table>
<?php do_action('wcmp_email_footer'); ?>

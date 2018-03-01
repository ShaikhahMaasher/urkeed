<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js
if ( !function_exists( 'chld_thm_cfg_parent_css' ) ){
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css',
         array( 'genericons','animate','tooltipster','magnific-popup','ispririt-fx','nx-slider','sidr' ) );
    }
}
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// --------- Ecnqueue Scripts -----------------

function load_theme_scripts() {
  global $wp_scripts;
  $wp_scripts->registered[ 'wc-add-to-cart-variation' ]->src =
  get_stylesheet_directory_uri(). '/js/add-to-cart-variation.js';

  $wp_scripts->registered[ 'tinvwl' ]->src =
  get_stylesheet_directory_uri(). '/js/public.min.js';


    wp_enqueue_style( 'intlTelInput_child_css',
    get_stylesheet_directory_uri() . '/intlTelInput.css');

  ?>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js?ver=1.0.0"></script>
  <script src="<?php echo get_stylesheet_directory_uri(). '/js/intlTelInput.min.js' ;?>"></script>
  <?php

  wp_enqueue_script( 'chld_thm_js_file',
  get_stylesheet_directory_uri(). '/js/scripts.js',  array('jquery'));
}
add_action( 'wp_enqueue_scripts', 'load_theme_scripts' );

// --------- Use font awsome -----------------
function enqueue_load_fa() {
  wp_enqueue_style( 'load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );

}
add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );



// --------- Include MarketPlace Functions -----------------
if (is_plugin_active('dc-woocommerce-multi-vendor/dc_product_vendor.php') &&
      is_plugin_active('wc-frontend-manager/wc_frontend_manager.php')) {
include_once('vendor/vendor_functions.php' );

}


// -------------- include return -----------------
include('return/return_main.php');

// --------- Include Aramex APIs -----------------
include('aramex/aramex_shipping.php');

// --------- Include Test File -----------------

include('test_functions.php');


// -------------------- Customize Woo Top Bar -------------------------//
if (!function_exists('nx_woo_bar')) {
  function nx_woo_bar() {
    global $WCMp;
    global $woocommerce;
    global $ispirit_data;

    $enable_compare = $ispirit_data['enable-compare'];

    $current_user = wp_get_current_user();
    $current_user_name = isset($current_user->first_name)? $current_user->first_name : $current_user->display_name;
    $current_login_name = $current_user->user_login;

    $login_url = wp_login_url();
    $logout_url = wp_logout_url( home_url() );
    $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );

    if ( $myaccount_page_id ) {
      $logout_url = wp_logout_url( get_permalink( $myaccount_page_id ) );
        $login_url = get_permalink( $myaccount_page_id );
        if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
          $logout_url = str_replace( 'http:', 'https:', $logout_url );
        $login_url = str_replace( 'http:', 'https:', $login_url );
      }
    }

    $woo_bar_output = '';

    //$woo_bar_output .= '<div class="woocombar">' . "\n";
    $woo_bar_output .= '<ul class="woocom">' . "\n";

    if ( is_user_logged_in() ) {
      if($current_user_name){
            $woo_bar_output .= '<li class="top-login user-submenu"><a href="' .
             get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) .
              '"><i class="fa fa-caret-down" aria-hidden="true"></i> ' .$current_user_name.' </a>';
      }
      else{

        $woo_bar_output .= '<li class="top-login user-submenu"><a href="' .
         get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) .
          '">' .$current_login_name.'</a>';
      }
      $woo_bar_output .= '<ul>';
      $woo_bar_output .= '<li><a href="' .
       get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) .
        '" class="admin-link">' . esc_attr__('My Account', 'ispirit') . '</a></li>';
      $woo_bar_output .= '<li><a href="' . wc_get_checkout_url() .
       '" class="check-header">' . esc_attr__('Checkout', 'ispirit') . '</a></li>';
      if ( $myaccount_page_id ) {
              $woo_bar_output .= '<li><a href="' . wp_logout_url(home_url()) . '">' .
               esc_attr__('Sign Out', 'ispirit') . '</a></li>' . "\n";
      } else {
                $woo_bar_output .= '<li><a href="' . get_admin_url() .
                '" class="admin-link">' . esc_attr__('My Account', 'ispirit') . '</a></li>' . "\n";
      }


      $woo_bar_output .= '</ul>';

      $woo_bar_output .= '</li>' . "\n";


      if ( is_plugin_active('wc-frontend-manager/wc_frontend_manager.php')) {
        if(get_user_role() == 'administrator' || get_user_role() == 'dc_vendor' || get_user_secondary_role()=='shop_manager'){
          $woo_bar_output .= '<li><a href="'.get_wcfm_url().'" class="admin-link">'
          . esc_attr__('Dashboard', 'dc-woocommerce-multi-vendor') . '</a></li>' . "\n";
        }
      }
    } else {
      $woo_bar_output .= nx_top_login_form();
    }

    // TI Wishlist
    if (defined( 'TINVWL_LOAD_FREE' ) || defined( 'TINVWL_LOAD_PREMIUM' )) {
      $TI_wishlist = (string) (do_shortcode('[ti_wishlist_products_counter]'));
      $woo_bar_output .= '<li><a href="' . tinv_url_wishlist() .'" >'
        .'<span class="fa fa-heart" aria-hidden="true" style="font-size:15px"></span><span>'
        .$TI_wishlist .'</span></a></li>' . "\n";
    }

    // Yith Wishlist
    // if(get_option( 'yith_wcwl_enabled' ) == "yes")
    // {
    //   global $yith_wcwl;
    //   if(isset($yith_wcwl)){
    //
    //     $wishlist_count = $yith_wcwl->count_products();
    //     $woo_bar_output .= '<li><a href="' .  $yith_wcwl->get_wishlist_url() .'" >'
    //     . '<span class="fa fa-heart" aria-hidden="true" style="font-size:15px"></span>
    //     <span class="wishlist-counts">' . ($wishlist_count) . '</span></a></li>' . "\n";
    //   }
    // }

    // Compare
    if ( function_exists( 'yith_woocompare_constructor' ) && $enable_compare == 1 ) {
        $woo_bar_output .= '<li><a href="#" class="yith-woocompare-open" >' . esc_attr__('Compare', 'ispirit') . '</a></li>' . "\n";
    }

    $woo_bar_output .= '<li class="topcart"><a href="'. wc_get_cart_url() .'" >'
    . '<span class="fa fa-shopping-bag" aria-hidden="true" style="font-size:15px"></span><span class="cart-counts">' .
    sprintf($woocommerce->cart->cart_contents_count) . '</span></a>'.nx_top_cart().'</li>' . "\n";

    $woo_bar_output .= '</ul>' . "\n";

    if (! is_wc_endpoint_url( 'order-received' )) {
      $woo_bar_output .=  '<ul class="woocom lang-switcher"><li class="woo-bar-lang-switcher">'
      .do_shortcode('[wpml_language_switcher type="footer" flags=1 link_current=
       0 translated = 0 native = 1][/wpml_language_switcher]').
      '</li>'. "\n";
    }


    // if (is_plugin_active('woocommerce-product-price-based-on-countries/woocommerce-product-price-based-on-countries.php')) {
    // $woo_bar_output .=  '<li>'
    // . do_shortcode('[wcpbc_currency_switcher currency_display_style="{code}"]') .
    // '</li>';
    // }
    $woo_bar_output .= '</ul>'. "\n";
    return $woo_bar_output;
  }
}

// -------------------- End of Customize Woo Top Bar -------------------------//

//------------ Customize User Registration Form -------------------
    /**
     * Add (first/last name, phone, confirm password) to WooCommerce default registration form.
     * Author: Shaikhah
     */
    function wc_extra_register_fields() {
      $current_page= basename(get_permalink());
      $vendor_form = 'vendor_registration' ;
      if(strcmp($vendor_form, $current_page) != 0){
        ?>
        <p class="form-row form-row-first">
        <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?></label>
        <input type="text" class="input-text" name="billing_user_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_user_first_name'] ) ) esc_attr_e( $_POST['billing_user_first_name'] ); ?>" />
        </p>

        <p class="form-row form-row-last">
        <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?></label>
        <input type="text" class="input-text" name="billing_user_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_user_last_name'] ) ) esc_attr_e( $_POST['billing_user_last_name'] ); ?>" />
        </p>
        <div class="clear"></div>
        <p class="form-row form-row-wide" id="billing_phone_field" >
        <label for="reg_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?></label>

        <!-- Add country key
        Author : Elham
        -->
        <input type="tel" class="input-text" name="billing_phone" id="billing_phone"
        value="<?php if ( ! empty($_POST['full_number1'] ) ) esc_attr_e( $_POST['full_number1'] ); ?>" />
        </p>
        <?php
      }
    }
    add_action( 'woocommerce_register_form_start', 'wc_extra_register_fields' );

    // Add password confirmation
    function woocommerce_register_form_password_repeat() {
      ?>
      <p class="form-row form-row-wide">
        <label for="reg_password2"><?php _e( 'Confirm password', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="password" class="input-text" name="password_conf" id="reg_password2"/>
      </p>
      <?php
    }
    add_action( 'woocommerce_register_form', 'woocommerce_register_form_password_repeat' );

    // Passwords Validation
    function woocommerce_registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {

        global $woocommerce;
        extract( $_POST );
      if (isset($password_conf)) {
        if ( strcmp( $password, $password_conf ) !== 0 ) {
          return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
        }
      }
      return $reg_errors;
    }
    add_filter('woocommerce_registration_errors', 'woocommerce_registration_errors_validation', 10, 3);

    // Save extra registration fields to database
    function wc_save_extra_register_fields( $customer_id ) {

        if ( isset( $_POST['billing_user_first_name'] ) ) {
            // WordPress default first name field.
            update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_user_first_name'] ) );
            // WooCommerce billing first name.
            update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_user_first_name'] ) );
        }
        if ( isset( $_POST['billing_user_last_name'] ) ) {
            // WordPress default last name field.
            update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_user_last_name'] ) );
            // WooCommerce billing last name.
            update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_user_last_name'] ) );
        }
        if(isset($_POST['full_number1'])){
          // WooCommerce billing phone
          update_user_meta( $customer_id, 'billing_phone', sanitize_text_field($_POST['full_number1']));
        }
    }
    add_action( 'woocommerce_created_customer', 'wc_save_extra_register_fields' );
//------------ End of Customize User Registration Form -------------------

//------------ Start of Integration between currency plugin & payment extra fee -------------
function pbc_cod_pay4pay_charges( $value, $option ) {
  if ( $option == 'woocommerce_cod_settings' && ! empty( $value['pay4pay_charges_fixed'] && is_plugin_active('woocommerce-product-price-based-on-countries/woocommerce-product-price-based-on-countries.php')) ) {
    $value['pay4pay_charges_fixed'] = $value['pay4pay_charges_fixed'] * WCPBC()->customer->exchange_rate;
  }
  return $value;
}
function pbc_init_pay4pay_charges() {
  add_filter( 'option_woocommerce_cod_settings' , 'pbc_cod_pay4pay_charges', 10, 2 );
}
add_action( 'wc_price_based_country_frontend_princing_init', 'pbc_init_pay4pay_charges' );
//------------ End of Integration between currency plugin & payment extra fee -------------------

//------------ Start of Conditionally disabled COD gateway when exceeded 3750 SAR -------------------
add_filter('woocommerce_available_payment_gateways', 'unsetting_payment_gateway', 10, 1);
function unsetting_payment_gateway( $available_gateways ) {
  global $woocommerce;
  $shipping_cost = WC()->cart->get_cart_shipping_total();
  $amount = $woocommerce->cart->cart_contents_total + $woocommerce->cart->tax_total + $shipping_cost;
  global $max_cod_amount;
  if (is_plugin_active('woocommerce-product-price-based-on-countries/woocommerce-product-price-based-on-countries.php')) {
    $max_cod_amount = 3750 * WCPBC()->customer->exchange_rate;
    if( $amount >= $max_cod_amount && isset( $available_gateways['cod'] ) ){
      unset( $available_gateways['cod']);
      add_action( 'woocommerce_review_order_before_payment', 'COD_exceed_amount_before_paying_notice');
    }

    $min_installments_amount = 1000 * WCPBC()->customer->exchange_rate;
    if ( $amount <= $min_installments_amount && isset( $available_gateways['payfort_fort_installments'] ) ) {
      unset( $available_gateways['payfort_fort_installments']);
    }
  }
  return $available_gateways;
}
function COD_exceed_amount_before_paying_notice() {
    global $max_cod_amount;
    $_currency = WCPBC()->customer->currency;
    wc_print_notice( __( 'Due to the order has exceeded ' . round($max_cod_amount, 2).' '. $_currency .
    ', Cash On Delivery is not allowed. Please choose another payment gateway. Thank you!', 'woocommerce' ), 'notice' );
    }
//------------ End of Conditionally disabled COD gateway when exceeded 3750 SAR -------------------

//------------ Remove Dashboard Tab -------------------
function remove_myaccount_dashboard_tab($items){
  unset($items['dashboard']);
  return $items;
}
add_filter( 'woocommerce_account_menu_items', 'remove_myaccount_dashboard_tab' );

//------------ Remove Shipping Label -------------------
function remove_shipping_label($label, $method) {
  $new_label = preg_replace( '/^.+:/', '', $label );
  return $new_label;
}
add_filter( 'woocommerce_cart_shipping_method_full_label', 'remove_shipping_label', 10, 2 );

//------------ Remove Shiped Via Label from Thank You Page-------------------
function remove_shipped_via_label_in_thank_you_page(){
  return '';
}
add_filter('woocommerce_order_shipping_to_display_shipped_via','remove_shipped_via_label_in_thank_you_page');

//------------ Disable calculating of shipping on the cart -------------------
function disable_shipping_calc_on_cart( $show_shipping ) {
    if( is_cart() ) {
        return false;
    }
    return $show_shipping;
}
add_filter( 'woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99 );

//------------ Unset gateway category -------------------
function  unset_gateway_by_category( $available_gateways ) {
    global $woocommerce;
    $unset = false;
    $category_ids = array( 8, 37 );
    foreach ( $woocommerce->cart->cart_contents as $key => $values ) {
        $terms = get_the_terms( $values['product_id'], 'product_cat' );
        foreach ( $terms as $term ) {
            if ( in_array( $term->term_id, $category_ids ) ) {
                $unset = true;
                break;
            }
        }
    }
    if ( $unset == true ) unset( $available_gateways['cheque'] );
    return $available_gateways;
}
// add_filter( 'woocommerce_available_payment_gateways', 'unset_gateway_by_category' );



//------------ Change view of variable product price to (From) -------------------
function variable_price_format( $price, $product ) {

    $prefix = sprintf('%s: ', __('From', 'iconic'));

    $min_price_regular = $product->get_variation_regular_price( 'min', true );
    $min_price_sale    = $product->get_variation_sale_price( 'min', true );
    $max_price = $product->get_variation_price( 'max', true );
    $min_price = $product->get_variation_price( 'min', true );

    $price = ( $min_price_sale == $min_price_regular ) ?
        wc_price( $min_price_regular ) :
        '<del>' . wc_price( $min_price_regular ) . '</del>' . '<ins>' . wc_price( $min_price_sale ) . '</ins>';

    return ( $min_price == $max_price ) ?
        $price :
        sprintf('%s%s', $prefix, $price);

}
add_filter( 'woocommerce_variable_sale_price_html', 'variable_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'variable_price_format', 10, 2 );

function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}
add_action('woocommerce_before_add_to_cart_button', 'add_size_chart_imgs', 10);
function add_size_chart_imgs() {

  global  $post;
    $product = get_product( $post->ID );
    $size_chart = get_stylesheet_directory_uri() . '/img/size_charts/';
    if( $product->is_type( 'variable' ) && has_term( 'dresses-women', 'product_cat', $post->ID ) ){
      echo  '<div id ="variable_size_chart" >'.
      '<p id ="p-variable_size_chart" ><a href="'. $size_chart .'women.jpg" target="_blank">'.__('See size chart','woocommerce').'</a></p>'.
      '</div>';
    }
}

// change the alert appears when user click on add to cart for variable product
function print_msg_no_select_variation() {
    global  $post;
    //get_product id
    $product = get_product( $post->ID );
    //if Product is variable add a message
    if( $product->is_type( 'variable' ) ){
      echo  '<div id ="choose_variation_msg" class="hide-error-msg coloredtext" >';
      echo '<p id ="p-choose_variation_msg" >'.__('Please choose an option !','woocommerce').'</p>';
      echo '</div>';
    }
}
//Hook product message after Add To cart Button
add_action('woocommerce_before_add_to_cart_button', 'print_msg_no_select_variation');

/**
 * Display exchange rate and total price in USD in WooCommerce Admin Order page
 * @param: post id of the commission, boolean is updated, general commission value for vendors
 * @return: void - update the commission amount to be in USD only
 * @Author: Shaikhah
*/
add_action( 'woocommerce_after_order_notes', 'add_exchange_rate_in_checkout_form' );
// Output the exchange rate in checkout page
function add_exchange_rate_in_checkout_form($checkout) {
  $exchange_rate = WCPBC()->customer->exchange_rate;
  echo '<div id="user_link_hidden_checkout_field">
          <input type="hidden" class="input-hidden" name="exchange_rate" id="exchange_rate" value="' . $exchange_rate . '">
  </div>';
}

// Saving the exchange rate in the order metadata
function save_exchange_rate_in_order_meta($order_id) {
  if ( ! empty( $_POST['exchange_rate'] ) ) {
    update_post_meta( $order_id, '_exchange_rate', sanitize_text_field( $_POST['exchange_rate'] ) );
  }
}
add_action( 'woocommerce_checkout_update_order_meta', 'save_exchange_rate_in_order_meta' );


// Adds 'Total (USD)' column to 'Orders' page immediately after 'Total' column.
function total_USD_order_list_column_header($columns) {
  $new_columns = array();
  foreach ( $columns as $column_name => $column_info ) {
    $new_columns[ $column_name ] = $column_info;
    if ( 'order_total' === $column_name ) {
      $new_columns['order_exchange_rate'] = __( 'Exchange Rate', 'woocommerce' );
      $new_columns['order_total_usd'] = __( 'Total (USD)', 'woocommerce' );
    }
  }
  return $new_columns;
}
add_filter( 'manage_edit-shop_order_columns', 'total_USD_order_list_column_header', 20 );


// Adds 'Total (USD)' column content
function total_USD_order_list_column_content($column) {
  global $post;
  $order    = wc_get_order( $post->ID );
  $exchange_rate = get_post_meta( $order->id, '_exchange_rate', true );
  if ('order_exchange_rate' === $column) {
    echo $exchange_rate;
  }

  if ( 'order_total_usd' === $column ) {
    $total  = (float) $order->get_total();
    $total_usd=0;
    if ( $exchange_rate != 0 && $exchange_rate !== '' && !empty($exchange_rate) ) {
      $total_usd = (float) $total / $exchange_rate;
    }
    echo wc_price($total_usd);
  }
}
add_action( 'manage_shop_order_posts_custom_column', 'total_USD_order_list_column_content' );



function cod_customize_thank_you_msg( $text, $order ) {
  if ($order->get_payment_method() == 'cod') {
    $text = __( 'Thank you. Your order has been received.', 'woocommerce' );
  }
  else {
    $text = __( 'Thank you. Your payment has been successfully received.', 'woocommerce' );
  }
  return $text;
}
add_filter('woocommerce_thankyou_order_received_text', 'cod_customize_thank_you_msg', 10, 2 );
// ********************************************************************************************************
// remove settings, status and extension menus from user
function remove_menu_pages() {
  global $current_user;

  $user_roles = $current_user->roles;
  $user_role = array_shift($user_roles);
  if($user_role == "owner") {
    remove_submenu_page('woocommerce', 'wc-settings');
    remove_submenu_page('woocommerce', 'wc-status');
    remove_submenu_page('woocommerce', 'wc-addons'); // https://www.urkeed.com/wp-admin/admin.php?page=wc-addons
    remove_submenu_page('site-migration-import');
    echo 'done';
    remove_submenu_page('site-migration-export');
    remove_submenu_page('site-migration-backups');
  }

  if($user_role == "author") {
    $remove_submenu = remove_submenu_page('wpml', 'wpml-translation-management');
  }
}
add_action( 'admin_menu', 'remove_menu_pages', 999);
// ********************************************************************************************************

/*
* @Author : Elham
* Add scripts to the footer
*/
add_action( 'wp_footer', 'footer_scripts' );
function footer_scripts() {
    ?>
      <script>
      // Billing phone on checkout
      {
        /*
        * Author : Elham
        * Append 2 hidden spans to show the result of the phone number , Valid / Invalid
        * 1. Billing phone
        */
        var wrapper_billing_phone = $('#billing_phone_field');
        wrapper_billing_phone.append('<span id="valid-msg1" class="hide">✓</span><span id="error-msg1" class="hide">X</span>');

        var telInput = $("#billing_phone"),
        errorMsg = $("#error-msg1"),
        validMsg = $("#valid-msg1"),
        validate = false;

        // initialise plugin
        telInput.intlTelInput({
          initialCountry: "auto",
           formatOnDisplay: true,
           autoHideDialCode: true,
           nationalMode: true ,
           geoIpLookup: function(callback) {
             $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
               var countryCode = (resp && resp.country) ? resp.country : '';
               callback(countryCode);
             });
           },
           preferredCountries: ['sa', 'bh' ,'kw' ,'om' , 'qa' , 'ae'],
           utilsScript: "<?php echo get_stylesheet_directory_uri(). '/js/utils.js' ;?>"
        });

        if (telInput.intlTelInput("isValidNumber")) {
          validMsg.removeClass("hide");
          validate = true;
        } else {
          telInput.addClass("error");
          errorMsg.removeClass("hide");
          validate = false;
        }
        $('#valid_phone1').remove();
        $('#full_number1').remove();
        var fullNumber = telInput.intlTelInput("getNumber");
        wrapper_billing_phone.append('<input type="hidden" id="full_number1" name="full_number1" value="'+fullNumber+'" >');
        wrapper_billing_phone.append('<input type="hidden" id="valid_phone1" name="valid_phone1" value="'+validate+'" >');

        // $('#billing_country').change(function() {
        //   alert( 'test : '+this.value );
        // });

        var reset = function() {
          telInput.removeClass("error");
          errorMsg.addClass("hide");
          validMsg.addClass("hide");
          validate = false;
        };

        // on blur: validate
          telInput.blur(function() {
          reset();
          if ($.trim(telInput.val())) {
            if (telInput.intlTelInput("isValidNumber")) {
              validMsg.removeClass("hide");
              validate = true;
            } else {
              telInput.addClass("error");
              errorMsg.removeClass("hide");
              validate = false;
            }
            $('#valid_phone1').remove();
            $('#full_number1').remove();
            var fullNumber = telInput.intlTelInput("getNumber");
            wrapper_billing_phone.append('<input type="hidden" id="full_number1" name="full_number1" value="'+fullNumber+'" >');
            wrapper_billing_phone.append('<input type="hidden" id="valid_phone1" name="valid_phone1" value="'+validate+'" >');

          }
        });


        // on keyup / change flag: reset
        telInput.on("keyup change", reset);
        /*
        * Author : Elham
        * make all input with type : tel accept only numbers and validate it
        */
        $("#billing_phone").keydown(function (e) {
          // Allow: backspace, delete, tab, escape, enter and .
          if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
               // Allow: Ctrl+A, Command+A
              (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
               // Allow: home, end, left, right, down, up
              (e.keyCode >= 35 && e.keyCode <= 40)) {
                   // let it happen, don't do anything
                   return;
          }
          // Ensure that it is a number and stop the keypress
          if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
              e.preventDefault();
          }
        });
      }
      </script>

      <?php if(is_checkout()){``?>
      <script>

      // Add placeholder to payfort - credit card
      setTimeout(showpanel, 2500);
      function showpanel() {
        $("#payfort_fort_expiry_month").attr("placeholder", "MM");
        $("#payfort_fort_expiry_year").attr("placeholder", "YY");
        $("#payfort_fort_card_security_code").attr("placeholder", "CVC");
      }
      </script>
    <?php
    }
}
// ********************************************************************************************************
/*
* @Author : Elham
* Adjust checkout fileds:
* 1. change phone type to ( tel )
* 2. remove state fileds.
* 3. remove company fields.
* 4. remove order comments.
* 5. Change city, postcode, address1 and address2 to row-half
*/
add_filter( 'woocommerce_billing_fields', 'setup_billing_address_fields', 500, 1 );
function setup_billing_address_fields( $address_fields ) {

  $address_fields['billing_phone']['type'] = 'tel';
  // **************************
  $address_fields['billing_city']['class'][0] = 'form-row-first';

  $address_fields['billing_address_1']['class'][0] = 'form-row-first';
  $address_fields['billing_address_2']['class'][0] = 'form-row-last';
  $address_fields['billing_email']['class'][0] = 'form-row-last';
  $address_fields['billing_phone']['class'][0] = 'form-row-first';


  $address_fields['billing_address_2']['label'] = ' ';
  $address_fields['billing_address_2']['custom_attributes'] = array(
            'style' => 'margin-top: 27px;'
  );
  // **************************
  unset($address_fields['billing_state']);
  // **************************
  unset($address_fields['billing_company']);
  // **************************
	return $address_fields;
}

add_filter( 'woocommerce_shipping_fields', 'setup_shipping_address_fields', 10, 1 );
function setup_shipping_address_fields( $address_fields ) {
  $address_fields['shipping_city']['class'][0] = 'form-row-first';
  $address_fields['shipping_address_1']['class'][0] = 'form-row-first';
  $address_fields['shipping_address_2']['class'][0] = 'form-row-last';
  $address_fields['shipping_address_2']['label'] = ' ';
  $address_fields['shipping_address_2']['custom_attributes'] = array(
            'style' => 'margin-top: 27px;'
  );
  // **************************
  unset($address_fields['shipping_state']);
  // **************************
  unset($address_fields['shipping_company']);
  // **************************
	return $address_fields;
}
//------------ Remove order comments from checkout -------------------
function setup_checkout_fields( $fields ) {
    unset($fields['order']['order_comments']);
    return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'setup_checkout_fields',50,1 );
//------------ Set postcode to not required -------------------
function setup_checkout_postcode( $address_fields ) {
  $address_fields['postcode']['required'] = false;
  $address_fields['postcode']['class'][0] = 'form-row-last';

  return $address_fields;
}
add_filter( 'woocommerce_default_address_fields' , 'setup_checkout_postcode' );
// ********************************************************************************************************

/*
* @Author : Elham
* Fill checkout select city with cities based on the choosen country
*/
function fill_checkout_cities( $cities ) {
  // Load only the city files the shop owner wants/needs.
  $allowed = array_merge( WC()->countries->get_allowed_countries(), WC()->countries->get_shipping_countries() );

  // connect with aramex API
  $location_wsdl_file = get_stylesheet_directory_uri() . '/aramex/Location-API -WSDL.wsdl';
  $cities_soap = new SoapClient($location_wsdl_file);

  // if no country choosen
  $cities[''] = array();
  if ( $allowed ) {

    foreach ( $allowed as $code => $country ) {
      if ( ! isset( $cities[ $code ] )) {
        $fetch_cities_array = array(
          'ClientInfo'=> array(
          							'AccountCountryCode'		=> 'JO',
          							'AccountEntity'		 	=> 'AMM',
          							'AccountNumber'		 	=> '20016',
          							'AccountPin'		 	=> '331421',
          							'UserName'			=> 'testingapi@aramex.com',
          							'Password'		 	=> 'R123456789$r',
          							'Version'		 	=> 'v1.0',
          							'Source' 			=> NULL
          						),
          'Transaction'=> array(
          							'Reference1'			=> '',
          							'Reference2'			=> '',
          							'Reference3'			=> '',
          							'Reference4'			=> '',
          							'Reference5'			=> ''),
          'CountryCode'			=> $code,
          'State'				=> NULL
        );
        $fetch_cities = $cities_soap->FetchCities($fetch_cities_array);
        // $cities[$code] = $fetch_cities->Cities->string;
        $array = $fetch_cities->Cities->string;
        foreach ($array as &$value) {
           $newValue = __($value , 'city');
           $value = $newValue;
        }
        $cities[$code] = $array ;
      }
    }
  }

  return $cities;
}
add_filter( 'wc_city_select_cities', 'fill_checkout_cities' );

// ********************************************************************************************************
/*
* @Author : Elham
* when the user click on place order in checkout page this function will triggred
* 1. validate phone number
*/
function validate_checkout_form_fields() {
	// if the phone number not valid
	if ( isset($_POST["valid_phone1"]) && $_POST["valid_phone1"] == 'false' ){
		wc_add_notice( '<strong>Billing Phone Number</strong> is invalid.', 'error' );
  }
}
add_action('woocommerce_checkout_process', 'validate_checkout_form_fields');
// ********************************************************************************************************
/*
* @Author : Elham
* Saving full phone number number ( including the country code )
*/
function save_customer_full_number_after_checkout( $customer_id, $post ) {
  if(isset($_POST['full_number1']) && !empty($_POST['full_number1'])){
    update_user_meta( get_current_user_id(), 'billing_phone',  sanitize_text_field($_POST['full_number1']));
  }
}
add_action( 'woocommerce_checkout_update_user_meta', 'save_customer_full_number_after_checkout', 10, 2 );
add_action( 'woocommerce_created_customer', 'save_customer_full_number_after_checkout', 10, 2 );

function save_customer_full_number_order( $order_id ) {
  if(isset($_POST['full_number1']) && !empty($_POST['full_number1'])){
    update_post_meta( $order_id, 'billing_phone', sanitize_text_field($_POST['full_number1']));
  }
}

add_action( 'woocommerce_checkout_update_order_meta', 'save_customer_full_number_order');
function update_customer_full_number($user_id, $load_address) {
  if(isset($_POST['full_number1']) && !empty($_POST['full_number1']) && $load_address === 'billing'){
    update_user_meta($user_id , 'billing_phone', $_POST['full_number1']);
  }
}
add_action( 'woocommerce_customer_save_address', 'update_customer_full_number', 30 ,2);
// ********************************************************************************************************

add_action( 'woocommerce_after_save_address_validation','validate_update_my_account_billing_address',50,3  );
function validate_update_my_account_billing_address($user_id, $load_address, $address){
if ( isset($_POST["valid_phone1"]) && $_POST["valid_phone1"] === 'false' ){
		wc_add_notice( sprintf( __( '%s is not a valid phone number.', 'woocommerce' ), '<strong>' .
      $_POST["billing_phone"] . '</strong>' ), 'error' );
	}
}

/**
 * Changing credit card title on checkout page
 * @author: Shaikhah
 */
// add_filter('woocommerce_available_payment_gateways', 'change_payfort_credit_card_title', 15, 1);
// function change_payfort_credit_card_title($available_gateways) {
//   $available_gateways['payfort']->title = __('Credit Card', 'payfort');
//   return $available_gateways;
// }

/**
 * Changing credit card title using woocommerce gettext
 * @author: Shaikhah
 */
add_filter( 'gettext', 'change_payfort_credit_card_title', 20, 3 );
function change_payfort_credit_card_title( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'Credit / Debit Card' :
			$translated_text = __( 'Credit Card', 'payfort_fort' );
			break;
	}
	return $translated_text;
}

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
/**
 * WooCommerce Loop Product Thumbs
 **/
if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
	function woocommerce_template_loop_product_thumbnail() {
    $NX_pif = new NX_pif();

    // echo do_shortcode('[ti_wishlists_addtowishlist]');
    echo
     '<div id="container" class="child-thumbnail-container">';
		echo woocommerce_get_product_thumbnail();
    // $NX_pif->nx_template_loop_second_product_thumbnail();
    echo '</div>';
	}
 }


add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );
function woocommerce_category_image() {
        global $wp_query;
        $cat = $wp_query->get_queried_object();
        $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id );
        if ( $image ) {
            echo '<img src="' . $image . '" alt="" />';
        }
}
// add_action( 'wp_enqueue_scripts','nx_pif_scripts' );
function nx_pif_scripts() {
 wp_enqueue_style( 'pif-styles', get_template_directory_uri() . '/inc/nx-product-image-flipper/assets/css/style.css', array(), '1.0.1' );
}

 class NX_pif {
   public function __construct() {
     // add_action( 'wp_enqueue_scripts', array( $this, 'nx_pif_scripts' ) );														// Enqueue the styles
     // add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'nx_template_loop_second_product_thumbnail' ), 11 );
     add_filter( 'post_class', array( $this, 'nx_product_has_gallery' ) );
   }

    /*-----------------------------------------------------------------------------------*/
   /* Class Functions */
   /*-----------------------------------------------------------------------------------*/

   // Setup styles
   function nx_pif_scripts() {
     wp_enqueue_style( 'pif-styles', get_parent_theme_file_path() . '/inc/nx-product-image-flipper/assets/css/style.css', array(), '1.0.1' );
     wp_enqueue_script( 'pif-script', get_parent_theme_file_path() . '/inc/nx-product-image-flipper/assets/js/script.js', array(), '1.0.1' );
   }

   // Add pif-has-gallery class to products that have a gallery
   function nx_product_has_gallery( $classes ) {
     global $product;

     $post_type = get_post_type( get_the_ID() );

     if ( ! is_admin() ) {

       if ( $post_type == 'product' ) {

         $attachment_ids = $product->get_gallery_image_ids();

         if ( $attachment_ids ) {
           $classes[] = 'pif-has-gallery';
         }
       }

     }

     return $classes;
   }


   /*-----------------------------------------------------------------------------------*/
   /* Frontend Functions */
   /*-----------------------------------------------------------------------------------*/

   // Display the second thumbnails
   function nx_template_loop_second_product_thumbnail() {
     global $product, $woocommerce;

     $attachment_ids = $product->get_gallery_image_ids();

     if ( $attachment_ids ) {
       $secondary_image_id = $attachment_ids['0'];
       echo wp_get_attachment_image( $secondary_image_id, 'shop_catalog', '', $attr = array( 'class' => 'secondary-image attachment-shop-catalog' ) );
     }
   }

 }

add_filter( 'woocommerce_get_price_html', 'wpa83367_price_html', 100, 2 );
function wpa83367_price_html( $price, $product ){
   $new_html = '<div id="price_div">';

   if (strpos($price, '<ins>') == false) {
     $price .= '<br><ins><span class="woocommerce-Price-amount amount" style ="visibility : hidden;">0 SAR</span></ins>';
   } else{
     $price =  str_replace('<ins>' , '<br><ins>' , $price);
   }

   $new_html .= ($price);
   $new_html.= '</div>';
    return $new_html;
 }

add_filter('woocommerce_loop_add_to_cart_link' , 'replace_add_to_cart' ,50,2);
function replace_add_to_cart($html , $product) {
    $print = sprintf( '<a rel="nofollow"
    href="%s"
    data-quantity="%s"
    data-product_id="%s"
    data-product_sku="%s"
    class="%s add-to-cart-btn"><img id ="add-to-cart-img" src="%s"/><button><span id="add-to-cart-title">%s</span></button></a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $product->get_id() ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $class ) ? $class : '' ),
		esc_url( get_add_to_cart_icon() ),
		esc_html( $product->add_to_cart_text() ));
    return  $print;
}


function get_add_to_cart_icon(){
    return get_stylesheet_directory_uri().'/img/add-to-cart-icon.png';
}



add_action('woocommerce_admin_order_item_headers' ,'add_item_status_to_orders_table',10,1);
function add_item_status_to_orders_table($order){
  ?><th class="item_quantity sortable" colspan="1" data-sort="string-ins"><?php _e( 'Status', 'woocommerce' ); ?></th><?php
    if( !current_user_can( 'dc_vendor') ){
    ?><th class="item_quantity sortable" colspan="1" data-sort="string-ins"><?php _e( 'Vendor', 'woocommerce' ); ?></th><?php
    }
}


function get_vendor_order_status($val = ''){
  $statuses = array(
            'not_ready'=>__('Not Ready' ,'status'),
            'ready'=>__('Ready to pickup' ,'status'),
            'sent'=>__('Picked up' ,'status'),
            'wh'=>__('In Warehouse' ,'status'));

  if(!empty($val))
    return $statuses[$val];

  $user_can = (current_user_can('owner') || current_user_can('storekeeper') || current_user_can('administrator'));

	if( !$user_can ){
		unset($statuses['wh']);
  }

  return $statuses;
}

add_action('woocommerce_admin_order_item_values','vendor_order_status_vendor_view',10,3);
function vendor_order_status_vendor_view($product, $item, $item_id){
  if(current_user_can( 'dc_vendor') ){
    global $WCMp;
    $order_id = $item->get_order_id();
    if($item instanceof WC_Order_Item_Product){
      $order_id = $item->get_order_id();
      $vendor_id =get_current_user_id();
        ?>
        <td class="quantity" width="2%"><div class="view"><small class="times">
        <?php
        $order_vendor_obj = get_wcmp_vendor_orders(array('vendor_id' => $vendor_id, 'order_id' =>$order_id));
        $vendor_order_status = $order_vendor_obj[0]->vendor_order_status;
        echo get_vendor_order_status($vendor_order_status);
        ?>
        </small></div></td>
        <?php
      }
  }
}

add_action('woocommerce_admin_order_item_values','vendor_order_status_admin_view',10,3);
function vendor_order_status_admin_view($product, $item, $item_id){

  if( current_user_can('dc_vendor'))
    return;

  global $WCMp;
  $order_id = $item->get_order_id();
  if($item instanceof WC_Order_Item_Product){
    $order_id = $item->get_order_id();
    $vendor = get_wcmp_product_vendors($product->get_id());
    if($vendor){
      ?>
      <td class="quantity" width="2%"><div class="view"><small class="times">
        <?php
        $order_vendor_obj = get_wcmp_vendor_orders(array('vendor_id' => $vendor->id, 'order_id' =>$order_id));
        $vendor_order_status = $order_vendor_obj[0]->vendor_order_status;
        $statuses = get_vendor_order_status();
          ?>
          <input type="hidden" name="<?php echo $item_id;?>_vendor_id" value="<?php echo $vendor->id;?>">
          <select id="vendor_order_status" name="<?php echo $item_id;?>_vendor_order_status" class="wc-enhanced-select">
          <?php
          foreach ( $statuses as $status => $status_name ) {
            if($status == $vendor_order_status)
               echo "<option selected='selected' value='".esc_attr( $status )."'>".esc_html( $status_name )."</option>";
            else
              echo "<option value='".esc_attr( $status )."'>".esc_html( $status_name )."</option>";
          }
          ?>
          </select>
        </small></div></td>
          <td class="quantity" width="2%"><div class="view"><small class="times">
            <?php
              echo $vendor->user_data->display_name."\r\n".get_user_meta($vendor->id, '_vendor_city', true) ;
            ?>
            </small></div></td>
        <?php
      }
      else {
        ?>
        <td class="quantity" width="2%"><div class="view"><small class="times"></small></div></td>
        <td class="quantity" width="2%"><div class="view"><small class="times"></small></div></td>
        <?php
    }
  }
}


/*
* @Author : Elham
* set the status for order item of vendor to ( not shipped )
*/
function set_initial_value_to_new_order( $order_id ) {

  if ( ! $order_id )
        return;
  // globals
  global $WCMp, $wpdb;

  // set the shipping status to not shipped
  update_post_meta($order_id , 'shipping_status', 0);

  // get the vendors of this order
  $order_vendor_objs = get_wcmp_vendor_orders(array('order_id' =>$order_id));
  // set initial state of the location to not in the warhouse.
  // UPDATE wp_wcmp_vendor_orders SET vendor_order_status = 'not_ready' WHERE order_id =
  $wpdb->query("UPDATE {$wpdb->prefix}wcmp_vendor_orders SET vendor_order_status = 'not_ready'
    WHERE order_id = $order_id");

}
add_action( 'woocommerce_thankyou', 'set_initial_value_to_new_order');
// ********************************************************************************************************

// After registration, logout the user and redirect to home page
function custom_registration_redirect() {
    return home_url('/');
}
add_action('woocommerce_registration_redirect', 'custom_registration_redirect', 2);

function get_user_role( $user = null ) {
	$user = $user ? new WP_User( $user ) : wp_get_current_user();
	return $user->roles ? $user->roles[0] : false;
}

function get_user_secondary_role( $user = null ) {
	$user = $user ? new WP_User( $user ) : wp_get_current_user();
  if(!$user->roles) return false;
	return count($user->roles) > 1 ? $user->roles[1] : $user->roles[0];
}

// disable order notes
function disable_order_notes($option){
  return false;
}
add_filter('woocommerce_enable_order_notes_field' , 'disable_order_notes' , 50 );



function add_contact_store_info($fields){
  $new_field = array(
    array(
      'title'    => __( 'Store Contact', 'woocommerce' ),
      'type'     => 'title',
      'id'       => 'store_contact',
    ),
    array(
      'title'    => __( 'Urkeed phone numebr.', 'woocommerce' ),
      'desc'     => __( 'The phone number', 'woocommerce' ),
      'id'       => 'urkeed_phone',
      'default'  => '',
      'type'     => 'text',
      'desc_tip' => true,
    ),

    array(
      'title'    => __( 'Store keeper Name.', 'woocommerce' ),
      'id'       => 'storekeeper_name',
      'default'  => '',
      'type'     => 'text',
    ),
    array(
      'title'    => __( 'Store keeper cell phone.', 'woocommerce' ),
      'id'       => 'storekeeper_cellphone',
      'default'  => '',
      'type'     => 'text',
    ),
    array(
      'title'    => __( 'Store keeper email.', 'woocommerce' ),
      'id'       => 'storekeeper_email',
      'default'  => '',
      'type'     => 'text',
    ),
    array( 'type' => 'sectionend', 'id' => 'store_contact' )
    );
  $fields = array_merge($fields , $new_field);
  return $fields;
}

add_filter('woocommerce_general_settings' , 'add_contact_store_info',50,1);


function pre($print){
  echo '<pre>';
  print_r($print);
  echo '</pre>';
}


/**
 * Customize products limit appeared in shop per page
 * @author Shaikhah
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 300);
function new_loop_shop_per_page( $cols ) {
  return $cols = 25;
}

add_filter ( 'woocommerce_product_thumbnails_columns', 'bbloomer_change_gallery_columns' );
function bbloomer_change_gallery_columns() {
  return 1;
}

add_action('woocommerce_product_thumbnails', 'woocommerce_before_product_gallery_thumbnails', 12);
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 10 );
add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 15 );

if ( ! function_exists( 'woocommerce_show_product_thumbnails' ) ) {
	function woocommerce_show_product_thumbnails() {
    wc_get_template( 'single-product/product-thumbnails.php' );
  }
  add_action('woocommerce_product_thumbnails', 'woocommerce_after_product_gallery_thumbnails', 16);
}
function woocommerce_before_product_gallery_thumbnails() {
  echo '<div class="product-gallery-thumbs-wrapper">';
}

function woocommerce_after_product_gallery_thumbnails() {
  echo '</div>';
}

remove_action('woocommerce_order_status_completed', 'wcmp_process_commissions');
add_action('woocommerce_order_status_completed', 'wcmp_process_commissions_new');

if (!function_exists('wcmp_process_commissions_new')) {
function wcmp_process_commissions_new ($order_id) {
  global $wpdb;
  $cal_comm = new WCMp_Calculate_Commission();
  // Only process commissions once
  $order = new WC_Order($order_id);
  $processed = get_post_meta($order_id, '_commissions_processed', true);
  $order_processed = get_post_meta($order_id, '_wcmp_order_processed', true);
  if(!$order_processed){
      wcmp_process_order($order_id, $order);
  }
  $commission_ids = get_post_meta($order_id, '_commission_ids', true) ? get_post_meta($order_id, '_commission_ids', true) : array();
  if (!$processed) {
      $vendor_array = array();
      $items = $order->get_items('line_item');
      foreach ($items as $item_id => $item) {
          $vendor_id = wc_get_order_item_meta($item_id, '_vendor_id', true);
          if (!$vendor_id) {
              $is_vendor_product = get_wcmp_product_vendors($item['product_id']);
              if (!$is_vendor_product) {
                  continue;
              }
          }
          $product_id = $item['product_id'];
          $variation_id = isset($item['variation_id']) && !empty($item['variation_id']) ? $item['variation_id'] : 0;
          if ($vendor_id) {
              $vendor_obj = get_wcmp_vendor($vendor_id);
          } else {
              $vendor_obj = get_wcmp_product_vendors($product_id);
          }
          if (in_array($vendor_obj->term_id, $vendor_array)) {
              if ($variation_id) {
                  $query_id = $variation_id;
              } else {
                  $query_id = $product_id;
              }
              $commission = $vendor_obj->get_vendor_commissions_by_product($order_id, $query_id);
              $previous_ids = get_post_meta($commission[0], '_commission_product', true);
              if (is_array($previous_ids)) {
                  array_push($previous_ids, $query_id);
              }
              update_post_meta($commission[0], '_commission_product', $previous_ids);

              $item_commission = $cal_comm->get_item_commission($product_id, $variation_id, $item, $order_id, $item_id);

              $wpdb->query("UPDATE `{$wpdb->prefix}wcmp_vendor_orders` SET commission_id = " . $commission[0] . ", commission_amount = '" . $item_commission . "' WHERE order_id =" . $order_id . " AND order_item_id = " . $item_id . " AND product_id = " . $product_id);
          } else {
              $vendor_id = wc_get_order_item_meta($item_id, '_vendor_id', true);
              if ($product_id) {
                  $commission_id = $cal_comm->record_commission($product_id, $order_id, $variation_id, $order, $vendor_obj, $item_id, $item);
                  if ($commission_id) {
                      $commission_ids[] = $commission_id;
                      update_post_meta($order_id, '_commission_ids', $commission_ids);
                  }
                  $vendor_array[] = $vendor_obj->term_id;
              }
          }
      }
      // $email_admin = WC()->mailer()->emails['WC_Email_Vendor_New_Order'];
      // $email_admin->trigger($order_id);
  }
  // Mark commissions as processed
  update_post_meta($order_id, '_commissions_processed', 'yes');
  if (!empty($commission_ids) && is_array($commission_ids)) {
      foreach ($commission_ids as $commission_id) {
          $commission_amount = get_wcmp_vendor_order_amount(array('commission_id' => $commission_id, 'order_id' => $order_id));
          update_post_meta($commission_id, '_commission_amount', (float) $commission_amount['commission_amount']);
      }
  }
}
}


/**
 * Calcualte Shipping cost based on weight
 * @author Shaikhah
 */
// add_filter( 'woocommerce_package_rates', 'shipping_cost_based_weight', 10, 2 );
function shipping_cost_based_weight( $rates, $package ) {
  $weight_limit = 5;
  $current_weight = WC()->cart->cart_contents_weight();
  if ( $current_weight > $weight_limit ) {
    if ( isset( $rates['flat_rate:1'] ) ) {
      $diff = round($current_weight - $weight_limit);
      $rates['flat_rate:1']->cost+= $diff;
    }
  }
  return $rates;
}

/**
 * Remove product gallery thumbnails
 * @author Shaikhah
 */

//remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
// add_action( 'woocommerce_single_product_summary', 'bbloomer_product_thumbnails_wrapper_start', 49 );
// add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_thumbnails', 50 );
// add_action( 'woocommerce_single_product_summary', 'bbloomer_product_thumbnails_wrapper_end', 51 );

function bbloomer_product_thumbnails_wrapper_start() {
echo '<div class="bbloomer-thumbs">';
}
function bbloomer_product_thumbnails_wrapper_end() {
echo '</div>';
}

// remove Q & A tabs from product pages
add_filter('woocommerce_product_tabs' , 'remove_q_a_tab' , 20);
function remove_q_a_tab($tabs){
  unset($tabs['wcmp_customer_qna']);
  unset($tabs['vendor']);
  return $tabs;
}


// Triggers for this email
// add_action( 'woocommerce_order_status_processing_to_cancelled_notification','send_email_customer_cancel_order', 10, 2 );
// add_action( 'woocommerce_order_status_on-hold_to_cancelled_notification','send_email_customer_cancel_order', 10, 2 );
//
// function send_email_customer_cancel_order($order_id, $order){
//   $email = WC()->mailer()->emails['WC_Email_Customer_Cancel_Order'];
//   $email->trigger($order_id, $order);
// }


add_filter('woocommerce_email_classes', 'urkeed_email_classes');
function urkeed_email_classes($emails) {
    include( 'classes/class-urkeed-customer-cancel-email.php' );
    $emails['WC_Email_Customer_Cancel_Order'] = new WC_Email_Customer_Cancel_Order(get_stylesheet_directory_uri());
    return $emails;
}
add_action( 'wcdn_head' ,'enqueue_styles_to_order_invoice' , 9);
function ff(){
  remove_action( 'wcdn_head', 'wcdn_template_stylesheet' );
  if(ICL_LANGUAGE_CODE == 'ar'){
    ?> <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/woocommerce/print-invoice/rtl.css"
    type="text/css" media="screen,print" /> <?php
  }
  else {
    ?>  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/woocommerce/print-invoice/style.css"
    type="text/css" media="screen,print" /><?php
  }
}


// ************************************************************************
// hide vendor message from customer orders details
add_filter('can_vendor_add_message_on_email_and_thankyou_page','hide_vendor_details_from_customer');
function hide_vendor_details_from_customer($value){
  if(current_user_can('customer')){
    $value = false;
  }
  return $value;
}

// ************************************************************************
// hide customer details from vendor CSV export
function hide_cust_details_in_CSV($value){
  if(current_user_can('dc_vendor')){
    $value = false;
  }
  return $value;
}

add_filter('show_customer_details_in_export_orders' ,'hide_cust_details_in_CSV');
add_filter('show_customer_billing_address_in_export_orders' ,'hide_cust_details_in_CSV');
add_filter('show_customer_shipping_address_in_export_orders' ,'hide_cust_details_in_CSV');
// ************************************************************************
// hide customer details from vendor email
function hide_cust_detaisl_from_vendor_email($value , $id){
  return false;
}
add_filter('show_cust_shipping_address_field' ,'hide_cust_detaisl_from_vendor_email');
add_filter('show_cust_address_field' ,'hide_cust_detaisl_from_vendor_email');
add_filter('show_cust_billing_address_field' ,'hide_cust_detaisl_from_vendor_email');


// ************************************************************************
// prevent vendor from overwriting coupon
function coupon_form_validation( $wcfm_coupon_manager_form_data, $form_type ) {

	if( $form_type == 'coupon_manage' ) {
		// Add your validation code here and set this
		$wcfm_coupon_manager_form_data['has_error'] = true;
		$wcfm_coupon_manager_form_data['message'] = __('This coupon code is exist before, please choose another code !');
	}

	return $wcfm_coupon_manager_form_data;
}
add_filter( 'wcfm_form_custom_validation', 'coupon_form_validation', 10, 2 );


add_action( 'before_wcfm_dashboard' , 'make_mobile_menu_slide_left');
function make_mobile_menu_slide_left(){
    ?>
    <script>
    jQuery(document).ready(function(){

    if (!$("body").hasClass("rtl")) {
      // teeeeeeeeeeeeeeest
      $( '#responsive-menu-container' ).removeClass('slide-right');
      $( '#responsive-menu-container' ).addClass('slide-left');


      $( 'this' ).removeClass('responsive-menu-slide-right');
      $( 'this' ).addClass('responsive-menu-slide-left');


      $( '#responsive-menu-button').css('right','1%!important;');
      $( '#responsive-menu-button').css('left','unset!important;');
    }
    });
    </script>
    <?php
}

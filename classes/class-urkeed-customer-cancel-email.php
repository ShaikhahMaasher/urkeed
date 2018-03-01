<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Email_Customer_Cancel_Order', false ) ) :

/**
 * Customer Invoice.
 *
 * An email sent to the customer via admin.
 *
 * @class       WC_Email_Customer_Invoice
 * @version     2.3.0
 * @package     WooCommerce/Classes/Emails
 * @author      WooThemes
 * @extends     WC_Email
 */
class WC_Email_Customer_Cancel_Order extends WC_Email {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->placeholders   = array(
			'{site_title}'   => get_option('blogname'),
			'{order_date}'   => '',
			'{order_number}' => '',
		);

		$this->id             = 'customer_cancel_order';
		$this->customer_email = true;
		$this->title          = __( 'Order Cancellation', 'woocommerce' );
		$this->subject 			= __( 'Order Cancellation in ', 'woocommerce') . get_option('blogname');
		$this->heading      	= __( 'Your order has been cancelled', 'dc-woocommerce-multi-vendor');

		$this->description    = __( 'Sent to customer when they cancel their orders.', 'woocommerce' );
		$this->template_html 	= 'emails/customer-cancel-order.php';
		$this->template_plain = 'emails/plain/customer-cancel-order.php';



		// Triggers for this email
		add_action( 'woocommerce_order_status_processing_to_cancelled_notification', array( $this, 'trigger' ), 10, 2 );
		add_action( 'woocommerce_order_status_on-hold_to_cancelled_notification', array( $this, 'trigger' ), 10, 2 );


		// Call parent constructor
		parent::__construct();

		// $this->manual         = true;
	}

	/**
	 * Get email subject.
	 *
	 * @access public
	 * @return string
	 */
	public function get_subject() {
		return apply_filters( $action, $this->format_string( $subject ), $this->object );
	}

	/**
	 * Get email heading.
	 *
	 * @access public
	 * @return string
	 */
	public function get_heading() {
		return apply_filters( $action, $this->format_string( $heading ), $this->object );
	}

	/**
	 * Trigger the sending of this email.
	 *
	 * @param int $order_id The order ID.
	 * @param WC_Order $order Order object.
	 */
	public function trigger( $order_id, $order = false ) {
		$this->setup_locale();

		if ( $order_id && ! is_a( $order, 'WC_Order' ) ) {
			$order = new WC_Order( $order_id );
		}

		if ( is_a( $order, 'WC_Order' ) ) {
			$this->object                         = $order;
			$this->recipient                      = $this->object->get_billing_email();
		}

		if ( $this->get_recipient() ) {
			$this->send( $this->get_recipient(), $this->subject, $this->get_content(), $this->heading, $this->get_attachments() );
		}

		$this->restore_locale();
	}

	/**
	 * Get content html.
	 *
	 * @access public
	 * @return string
	 */
	public function get_content_html() {
		return wc_get_template_html( $this->template_html, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => false,
			'plain_text'    => false,
			'email'			=> $this,
		) );
	}

	/**
	 * Get content plain.
	 *
	 * @access public
	 * @return string
	 */
	public function get_content_plain() {
		return wc_get_template_html( $this->template_plain, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => false,
			'plain_text'    => true,
			'email'			=> $this,
		) );
	}
}

endif;

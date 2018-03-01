<?php
// when the admin create or update new product, save ( title , short description and description ) in 2 languages
function save_product_language_fields($post_id)
	{
	$title_en = $_POST['title_en'];
	if (!empty($title_en))
		{
		update_post_meta($post_id, 'title_en', esc_attr($title_en));
		}

	$title_tur = $_POST['title_tur'];
	if (!empty($title_tur))
		{
		update_post_meta($post_id, 'title_tur', esc_attr($title_tur));
		}

	$short_description_en = $_POST['short_description_en'];
	if (!empty($short_description_en))
		{
		update_post_meta($post_id, 'short_description_en', esc_attr($short_description_en));
		}

	$short_description_tur = $_POST['short_description_tur'];
	if (!empty($short_description_tur))
		{
		update_post_meta($post_id, 'short_description_tur', esc_attr($short_description_tur));
		}

	$description_en = $_POST['description_en'];
	if (!empty($description_en))
		{
		update_post_meta($post_id, 'description_en', esc_html($description_en));
		}

	$description_tur = $_POST['description_tur'];
	if (!empty($description_tur))
		{
		update_post_meta($post_id, 'description_tur', esc_html($description_tur));
		}
	}
add_action('woocommerce_process_product_meta', 'save_product_language_fields');

// ############################################################################################
// ############################################################################################
// create new fields in product page  for ( title , short description and description ) in 2 languages in admin page
function add_custom_general_fields_admin()
	{
	global $woocommerce, $post;
	echo '<div class="options_group">';
	woocommerce_wp_text_input(array(
		'id' => 'title_en',
		'label' => __('English Title', 'woocommerce')
	));
	woocommerce_wp_text_input(array(
		'id' => 'short_description_en',
		'label' => __('English Short Description', 'woocommerce')
	));
	woocommerce_wp_textarea_input(array(
		'id' => 'description_en',
		'label' => __('English Description', 'woocommerce')
	));
	woocommerce_wp_text_input(array(
		'id' => 'title_tur',
		'label' => __('Turkish Title', 'woocommerce')
	));
	woocommerce_wp_text_input(array(
		'id' => 'short_description_tur',
		'label' => __('Turkish Short Description', 'woocommerce')
	));
	woocommerce_wp_textarea_input(array(
		'id' => 'description_tur',
		'label' => __('Turkish Description', 'woocommerce')
	));
	echo '</div>';
	}
add_action('woocommerce_product_options_general_product_data', 'add_custom_general_fields_admin');

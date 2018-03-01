<?php
// ############################################################################################
add_filter('wcfm_wcmarketplace_settings_fields_general' , 'change_settings_vendor_dashboard' , 50);
function change_settings_vendor_dashboard($fields){
	unset($fields['shop_slug']);
	return $fields;
}


// change setting fileds in general tab in vendor dashboard
// ############################################################################################
// add vendor info to settings
add_action('end_wcfm_wcmarketplace_settings' , 'add_info_vendor_settings_dashboard' , 10);
function add_info_vendor_settings_dashboard($vendor_id){
		?>
		<!-- collapsible - Owner -->
		<div class="page_collapsible " id="wcfm_settings_form_general_head">
			<label class="fa fa-id-card-o"></label>
			<?php _e('Owner', 'wc-frontend-manager'); ?><span></span>
		</div>
		<div class="wcfm-container">
			<div id="wcfm_settings_form_general_expander" class="wcfm-content">
				 <!-- owner first name -->
				 <p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('First Name', 'wc-frontend-manager')  ?></strong></p>
				 <label class="screen-reader-text" for="first_name"><?php _e('First Name', 'wc-frontend-manager')  ?></label>
				 <input type="text" id="first_name" name="first_name"
						class="wcfm-text wcfm_ele" value="<?php echo esc_attr(get_user_meta($vendor_id, 'first_name', true)); ?>"
						placeholder=""/>


				 <!-- owner last name -->
				 <p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('Last Name', 'wc-frontend-manager')  ?></strong></p>
				 <label class="screen-reader-text" for="last_name"><?php _e('Last Name', 'wc-frontend-manager')  ?></label>
				 <input type="text" id="last_name" name="last_name"
						class="wcfm-text wcfm_ele" value="<?php echo esc_attr(get_user_meta($vendor_id, 'last_name', true)); ?>"
						placeholder=""/>

				 <!-- owner Phone number  -->
						<p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('Phone Number', 'wc-frontend-manager')  ?></strong></p>
						<label class="screen-reader-text" for="vendor_phone"><?php _e('Phone Number', 'wc-frontend-manager')  ?></label>
						<div class="phone_div_vendor_dashboard">
						<div  class="phone_div ">
						<?php echo phone_key_selector("vendor_phone_key" , "wcfm-select wcfm_ele" , get_user_meta($vendor_id, '_vendor_phone_key', true)); ?>
						<input type="text" id="vendor_phone" name="vendor_phone"
							 class="wcfm-text wcfm_ele" value="<?php echo esc_attr(get_user_meta($vendor_id, '_vendor_phone', true)); ?>"
							 placeholder=""/>
						 </div>
				 </div>
			</div>
		</div>
		<div class="wcfm_clearfix"></div>


		<!-- collapsible - Company -->
		<div class="page_collapsible " id="wcfm_settings_form_company_head">
			<label class="fa fa-id-card-o"></label>
			<?php _e('Company', 'wc-frontend-manager'); ?><span></span>
		</div>
		<div class="wcfm-container">
			<div id="wcfm_settings_form_company_expander" class="wcfm-content">
				 <!-- company name -->
				 <p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('Company Name', 'wc-frontend-manager')  ?></strong></p>
				 <label class="screen-reader-text" for="vendor_company"><?php _e('Company Name', 'wc-frontend-manager')  ?></label>
				 <input type="text" id="vendor_company" name="vendor_company"
						class="wcfm-text wcfm_ele" value="<?php echo esc_attr(get_user_meta($vendor_id, '_vendor_company', true)); ?>"
						placeholder=""/>

				 <!-- commercial number -->
				 <p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('Commercial Registration Number', 'wc-frontend-manager')  ?></strong></p>
				 <label class="screen-reader-text" for="vendor_commercial_number"><?php _e('Commercial Registration Number', 'wc-frontend-manager')  ?></label>
				 <input type="text" id="vendor_commercial_number" name="vendor_commercial_number"
						class="wcfm-text wcfm_ele" value="<?php echo esc_attr(get_user_meta($vendor_id, '_vendor_commercial_number', true)); ?>"
						placeholder=""/>
			</div>
		</div>
		<div class="wcfm_clearfix"></div>

		<!-- collapsible - Responsible -->
		<div class="page_collapsible " id="wcfm_settings_form_responsible_head">
			<label class="fa fa-key"></label>
			<?php _e('Responsible', 'wc-frontend-manager'); ?><span></span>
		</div>
		<div class="wcfm-container">
			<div id="wcfm_settings_form_responsible_expander" class="wcfm-content">
				 <!-- Responsible first name -->
				 <p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('First Name', 'wc-frontend-manager')  ?></strong></p>
				 <label class="screen-reader-text" for="vendor_resp_fname"><?php _e('First Name', 'wc-frontend-manager')  ?></label>
				 <input type="text" id="vendor_resp_fname" name="vendor_resp_fname"
						class="wcfm-text wcfm_ele" value="<?php echo esc_attr(get_user_meta($vendor_id, '_vendor_resp_fname', true)); ?>"
						placeholder=""/>
				 <!-- Responsible last name -->
				 <p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('Last Name', 'wc-frontend-manager')  ?></strong></p>
				 <label class="screen-reader-text" for="vendor_resp_lname"><?php _e('Last Name', 'wc-frontend-manager')  ?></label>
				 <input type="text" id="vendor_resp_lname" name="vendor_resp_lname"
						class="wcfm-text wcfm_ele" value="<?php echo esc_attr(get_user_meta($vendor_id, '_vendor_resp_lname', true)); ?>"
						placeholder=""/>
				 <!-- Responsible Phone number  -->
						<p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('Phone Number', 'wc-frontend-manager')  ?></strong></p>
						<label class="screen-reader-text" for="vendor_resp_phone"><?php _e('Phone Number', 'wc-frontend-manager')  ?></label>
						<div class="phone_div_vendor_dashboard">
							<div  class="phone_div ">
							<?php echo phone_key_selector("vendor_resp_phone_key" , "wcfm-select wcfm_ele" ,get_user_meta($vendor_id, '_vendor_resp_phone_key', true) ); ?>
							<input type="text" id="vendor_resp_phone" name="vendor_resp_phone"
								 class="wcfm-text wcfm_ele" value="<?php echo esc_attr(get_user_meta($vendor_id, '_vendor_resp_phone', true)); ?>"
								 placeholder=""/>
							 </div>
				 	 </div>
				 <!-- Responsible email -->
					<p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('E-mail address', 'wc-frontend-manager')  ?></strong></p>
					<label class="screen-reader-text" for="vendor_resp_email"><?php _e('E-mail address', 'wc-frontend-manager')  ?></label>
					<input type="text" id="vendor_resp_email" name="vendor_resp_email"
						 class="wcfm-text wcfm_ele" value="<?php echo esc_attr(get_user_meta($vendor_id, '_vendor_resp_email', true)); ?>"
						 placeholder=""/>
			</div>
		</div>
		<div class="wcfm_clearfix"></div>


		<!-- collapsible - Shipping address -->
		<div class="page_collapsible " id="wcfm_settings_form_shipping_head">
			<label class="fa fa-ship"></label>
			<?php _e('Shipping', 'wc-frontend-manager'); ?><span></span>
		</div>
		<div class="wcfm-container">
			<div id="wcfm_settings_form_shipping_expander" class="wcfm-content">
				 <!-- shipping  country -->
				 <p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('Country', 'wc-frontend-manager')  ?></strong></p>
				 <label class="screen-reader-text" for="vendor_country"><?php _e('Country', 'wc-frontend-manager')  ?></label>
				 <?php echo countries_names_selector('vendor_country' , 'wcfm-select wcfm_ele', get_user_meta($vendor_id, '_vendor_country', true)); ?>

				 <!--  shipping city -->
				<p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('City', 'wc-frontend-manager')  ?></strong></p>
				<label class="screen-reader-text" for="vendor_city"><?php _e('City', 'wc-frontend-manager')  ?></label>
				<input type="text" id="vendor_city" name="vendor_city"
					 class="wcfm-text wcfm_ele" value="<?php echo esc_attr(get_user_meta($vendor_id, '_vendor_city', true)); ?>"
							 placeholder=""/>

				 <!-- shipping addr1 -->
					<p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('Address 1', 'wc-frontend-manager')  ?></strong></p>
					<label class="screen-reader-text" for="vendor_address_1"><?php _e('Address 1', 'wc-frontend-manager')  ?></label>
					<input type="text" id="vendor_address_1" name="vendor_address_1"
						 class="wcfm-text wcfm_ele" value="<?php echo esc_attr(get_user_meta($vendor_id, '_vendor_address_1', true)); ?>"
						 placeholder=""/>
			</div>
		</div>
		<div class="wcfm_clearfix"></div>

		<!-- collapsible - Returning address -->
		<div class="page_collapsible " id="wcfm_settings_form_returning_head">
			<label class="fa fa-thumb-tack"></label>
			<?php _e('Returning', 'wc-frontend-manager'); ?><span></span>
		</div>
		<div class="wcfm-container">
			<div id="wcfm_settings_form_returning_expander" class="wcfm-content">

				<!-- returning Phone number  -->
				 <p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('Phone Number', 'wc-frontend-manager')  ?></strong></p>
				 <label class="screen-reader-text" for="ret_phone"><?php _e('Phone Number', 'wc-frontend-manager')  ?></label>
				 <div class="phone_div_vendor_dashboard">
					 <div  class="phone_div ">
						 <?php echo phone_key_selector("vendor_customer_phone_key" , "wcfm-select wcfm_ele" , get_user_meta($vendor_id, '_vendor_customer_phone_key', true)); ?>
						 <input type="text" id="vendor_customer_phone" name="vendor_customer_phone"
								class="wcfm-text wcfm_ele" value="<?php echo esc_attr(get_user_meta($vendor_id, '_vendor_customer_phone', true)); ?>"
								placeholder=""/>
						</div>
					</div>

				<!-- return email -->
				 <p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('E-mail address', 'wc-frontend-manager')  ?></strong></p>
				 <label class="screen-reader-text" for="vendor_customer_email"><?php _e('E-mail address', 'wc-frontend-manager')  ?></label>
				 <input type="text" id="vendor_customer_email" name="vendor_customer_email"
						class="wcfm-text wcfm_ele" value="<?php echo esc_attr(get_user_meta($vendor_id, '_vendor_customer_email', true)); ?>"
						placeholder=""/>

				 <!-- return country -->
				 <p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('Country', 'wc-frontend-manager')  ?></strong></p>
				 <label class="screen-reader-text" for="vendor_csd_return_country"><?php _e('Country', 'wc-frontend-manager')  ?></label>
				 <?php echo countries_names_selector('vendor_csd_return_country' , 'wcfm-select wcfm_ele', get_user_meta($vendor_id, '_vendor_csd_return_country', true)); ?>

				 <!-- return city  -->
				 <div  class="phone_div ">
						<p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('City', 'wc-frontend-manager')  ?></strong></p>
						<label class="screen-reader-text" for="vendor_csd_return_city"><?php _e('City', 'wc-frontend-manager')  ?></label>
						<input type="text" id="vendor_csd_return_city" name="vendor_csd_return_city"
							 class="wcfm-text wcfm_ele" value="<?php echo esc_attr(get_user_meta($vendor_id, '_vendor_csd_return_city', true)); ?>"
							 placeholder=""/>
				 </div>

				 <!-- return addr1 -->
					<p class="shop_name wcfm_title wcfm_ele"><strong><?php _e('Address 1', 'wc-frontend-manager')  ?></strong></p>
					<label class="screen-reader-text" for="vendor_csd_return_address1"><?php _e('Address 1', 'wc-frontend-manager')  ?></label>
					<input type="text" id="vendor_csd_return_address1" name="vendor_csd_return_address1"
						 class="wcfm-text wcfm_ele" value="<?php echo esc_attr(get_user_meta($vendor_id, '_vendor_csd_return_address1', true)); ?>"
						 placeholder=""/>
			</div>
		</div>
		<div class="wcfm_clearfix"></div>
		<?php
}

// ############################################################################################
// save info when click save
add_action('wcfm_wcmarketplace_settings_update' , 'save_vendor_settings',50 ,2);
function save_vendor_settings($user_id, $wcfm_settings_form ){
	save_vendor_data($user_id,$wcfm_settings_form ,0);
}

// ############################################################################################
// ############################################################################################

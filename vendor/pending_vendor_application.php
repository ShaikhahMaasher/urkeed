<?php
//
// --------------------------- Start vendor form registration processing data -------------------------------
// 1.	Print form
add_action('wcmp_vendor_register_form' , 'vendor_registration_form' , 10);
function vendor_registration_form(){
	?>
	<!-- confirm password -->
	<div class="half_div">
	   <label for="conf_reg_password"><?php _e('Confirm password', 'woocommerce'); ?>
	   <span class="required">*</span></label>
	   <input type="password" required="required" name="conf_reg_password" id="conf_reg_password" />
	</div>
	<!-- ############################### End of account information ################################### -->
	<!-- ############################### Start of Owner information ################################### -->
	<h3 class="reg_header2 wcmp-vend_header">
	   <?php echo  __('Owner Information', 'dc-woocommerce-multi-vendor'); ?>
	</h3>
	<!-- first name -->
	<div class="half_div">
	   <label for="first_name"><?php _e('First Name', 'woocommerce'); ?>
	   <span class="required">*</span></label>
	   <input type="text" required="required" name="first_name" id="first_name"
	      value="<?php if (!empty($_POST['first_name'])) echo esc_attr($_POST['first_name']); ?>"/>
	</div>
	<!-- last name -->
	<div class="half_div">
	   <label for="last_name"><?php _e('Last Name', 'woocommerce'); ?>
	   <span class="required">*</span></label>
	   <input type="text" required="required" name="last_name" id="last_name"
	      value="<?php if (!empty($_POST['last_name'])) echo esc_attr($_POST['last_name']); ?>" />
	</div>
	<!-- phone number -->
	<div class="wcmp-regi-12">
	   <label for="vendor_phone"><?php _e('Phone Number', 'woocommerce'); ?> <span class="required">*</span></label>
	   <br/>
		 <div class="phone_div half-ele">
	   <?php  echo phone_key_selector("vendor_phone_key" ,"wcfm-select wcfm_ele", $_POST['vendor_phone_key']); ?>
	   <input type="text" required="required" name="vendor_phone" id="vendor_phone"
		 class="phone_key"
	      value="<?php if (!empty($_POST['vendor_phone'])) echo esc_attr($_POST['vendor_phone']); ?>" />
				<script>
		    //   $("#vendor_phone").intlTelInput({
		    //     initialCountry: "auto",
		    //     // formatOnDisplay: true,
		    //     geoIpLookup: function(callback) {
		    //       $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
		    //         var countryCode = (resp && resp.country) ? resp.country : '';
		    //         callback(countryCode);
		    //       });
		    //     },
		    //   preferredCountries: ['sa', 'bh' ,'kw' ,'om' , 'qa' , 'ae'],
		    //   utilsScript: "<?php echo get_stylesheet_directory_uri(). '/js/utils.js' ;?>"
		    // });
		    </script>

			</div>
	</div>
	<!-- company name -->
	<div class="half_div">
	   <label for="vendor_company"><?php _e('Company', 'woocommerce'); ?> <span class="required">*</span></label>
	   <input type="text" required="required" name="vendor_company" id="vendor_company"
	      value="<?php if (!empty($_POST['vendor_company'])) echo esc_attr($_POST['vendor_company']); ?>"/>
	</div>
	<!-- commercial registration number  -->
	<div class="half_div">
		<input type="radio" name="id-crn" required value="vendor_ID" id="vendor_ID"> <?php _e('ID','woocommerce');?>
		<input type="radio" name="id-crn" value="vendor_commercial_number" id="vendor_commercial_number"> <?php _e('Commercial Registration Number', 'woocommerce');?><br>

		<input type="text" required="required" name="vendor_commercial_ID_input" id="vendor_commercial_ID_input"
	      value="<?php if (!empty($_POST['vendor_commercial_ID_input'])) echo esc_attr($_POST['vendor_commercial_ID_input']); ?>"/>
	</div>
	<!-- Bank Account -->
	<div class="triple_ele">
	   <label for="vendor_bank_name"><?php _e('Bank Name', 'woocommerce'); ?> <span class="required">*</span></label>
	   <input type="text" required="required" name="vendor_bank_name" id="vendor_bank_name"
	      value="<?php if (!empty($_POST['vendor_bank_name'])) echo esc_attr($_POST['vendor_bank_name']); ?>"/>
	</div>
	<div class="triple_ele">
	   <label for="vendor_bank_account_number"><?php _e('Bank Account Name', 'woocommerce'); ?> <span class="required">*</span></label>
	   <input type="text" required="required" name="vendor_bank_account_number" id="vendor_bank_account_number"
	      value="<?php if (!empty($_POST['vendor_bank_account_number'])) echo esc_attr($_POST['vendor_bank_account_number']); ?>"/>
	</div>
	<div class="triple_ele">
	   <label for="vendor_iban"><?php _e('IBAN', 'woocommerce'); ?> <span class="required">*</span></label>
	   <input type="text" required="required" name="vendor_iban" id="vendor_iban"
	      value="<?php if (!empty($_POST['vendor_iban'])) echo esc_attr($_POST['vendor_iban']); ?>"/>
	</div>
	<br/>
	<!-- ############################### End of Owner information ################################### -->
	<!-- ############################### Start of Responsible information ################################### -->
	<!-- Responisible Information -->

	<h3 class="reg_header2 wcmp-vend_header">
	   <?php echo apply_filters('woocommerce_section_label',
	      __('Responsible Information', 'dc-woocommerce-multi-vendor')); ?>
	</h3>
	<!-- first name -->
	<div class="half_div">
	   <label for="vendor_resp_fname"><?php _e('First Name', 'woocommerce'); ?>
	   <span class="required">*</span></label>
	   <input type="text" required="required" name="vendor_resp_fname" id="vendor_resp_fname"
	      value="<?php if (!empty($_POST['vendor_resp_fname'])) echo esc_attr($_POST['vendor_resp_fname']); ?>"/>
	</div>
	<!-- last name -->
	<div class="half_div">
	   <label for="vendor_resp_lname"><?php _e('Last Name', 'woocommerce'); ?>
	   <span class="required">*</span></label>
	   <input type="text" required="required" name="vendor_resp_lname" id="vendor_resp_lname"
	      value="<?php if (!empty($_POST['vendor_resp_lname'])) echo esc_attr($_POST['vendor_resp_lname']); ?>" />
	</div>
	<!-- phone number -->
	<div class="half_div">
	   <label for="vendor_resp_phone"><?php _e('Phone Number', 'woocommerce'); ?> <span class="required">*</span></label>
	   <br/>
		 <div class="phone_div">
	   <?php echo phone_key_selector("vendor_resp_phone_key" ,"wcfm-select wcfm_ele", $_POST['vendor_resp_phone_key']); ?>
	   <input type="text" required="required" name="vendor_resp_phone" id="vendor_resp_phone" class="phone_key"
	      value="<?php if (!empty($_POST['vendor_resp_phone'])) echo esc_attr($_POST['vendor_resp_phone']); ?>" />
			</div>
	</div>
	<div class="half_div">
	   <label for="vendor_resp_email"><?php _e('E-mail Address', 'woocommerce'); ?> <span class="required">*</span></label>
	   <input type="email" required="required"  name="vendor_resp_email" id="vendor_resp_email"
	      value="<?php if (!empty($_POST['vendor_resp_email'])) echo esc_attr($_POST['vendor_resp_email']); ?>" />
	</div>
	<br/>
	<!-- ############################### End of Responsible information ################################### -->
	<!-- ############################### Start of Shipping address  ################################### -->
	<!-- Shipping address details -->
	<h3 class="reg_header2 wcmp-vend_header">
	   <?php echo apply_filters('woocommerce_section_label',
	      __('Shipping Address Details', 'dc-woocommerce-multi-vendor')); ?>
	</h3>
	<!-- country -->
	<div class="triple_ele">
	   <label for="vendor_country"><?php _e('Country', 'woocommerce'); ?> <span class="required">*</span></label>
	   <br/>
	   <?php  echo countries_names_selector("vendor_country" , "wcfm-select" , $_POST['vendor_country'] ); ?>
	</div>
	<!-- city -->
	<div class="triple_ele">
	   <label for="vendor_city"><?php _e('City', 'woocommerce'); ?> <span class="required">*</span></label>
	   <br/>
	   <?php  echo fill_vendor_cities("vendor_city" , "wcfm-select" , $_POST['vendor_city'] ); ?>
	   <!-- <input type="text" required="required" name="vendor_city" id="vendor_city"
	      value="
		  <?php //if (!empty($_POST['vendor_city'])) echo esc_attr($_POST['vendor_city']);
		  ?>
		  " /> -->
	</div>
	<!-- address 1 -->
	<div class="triple_ele">
	   <label for="vendor_address_1"><?php _e('Address', 'woocommerce'); ?> <span class="required">*</span></label>
	   <input type="text" required="required" name="vendor_address_1" id="vendor_address_1"
	      value="<?php if (!empty($_POST['vendor_address_1'])) echo esc_attr($_POST['vendor_address_1']); ?>"/>
	</div>
	<!-- ############################### End of Shipping address ################################### -->
	<!-- ############################### Start of return address ################################### -->
	<h3 class="reg_header2 wcmp-vend_header">
	   <?php echo __('Return Address Details', 'dc-woocommerce-multi-vendor'); ?>
	</h3>
	<!-- email -->
	<div class="half_div">
	   <label for="vendor_customer_email"><?php _e('E-mail Address', 'woocommerce'); ?> <span class="required">*</span></label>
	   <input type="email" required="required"  name="vendor_customer_email" id="vendor_customer_email"
	      value="<?php if (!empty($_POST['vendor_customer_email'])) echo esc_attr($_POST['vendor_customer_email']); ?>" />
	</div>
	<!-- phone -->
	<div class="half_div">
	   <label for="vendor_customer_phone"><?php _e('Phone Number', 'woocommerce'); ?> <span class="required">*</span></label>
	   <br/>
		 <div class="phone_div">
	   <?php //echo phone_key_selector("vendor_customer_phone_key" ,"wcfm-select wcfm_ele",$_POST['vendor_customer_phone_key']); ?>
	   <input type="text" required="required" name="vendor_customer_phone" id="vendor_customer_phone" class="phone_key"
	      value="<?php if (!empty($_POST['vendor_customer_phone'])) echo esc_attr($_POST['vendor_customer_phone']); ?>" />
		 </div>
	</div>
	<!-- country -->
	<div class="triple_ele">
	   <label for="vendor_csd_return_country"><?php _e('Country', 'woocommerce'); ?> <span class="required">*</span></label>
	   <br/>
	   <?php echo countries_names_selector("vendor_csd_return_country","wcfm-select" , $_POST['vendor_csd_return_country']); ?>
	</div>
	<!-- city -->
	<div class="triple_ele">
	   <label for="vendor_csd_return_city"><?php _e('City', 'woocommerce'); ?> <span class="required">*</span></label>
	   <?php  echo fill_vendor_cities("vendor_csd_return_city" , "wcfm-select" , $_POST['vendor_csd_return_city'] ); ?>
	   <!-- <input type="text" required="required" name="vendor_csd_return_city" id="vendor_csd_return_city"
		  value="<?php
		  //if (!empty($_POST['vendor_csd_return_city'])) echo esc_attr($_POST['vendor_csd_return_city']);
		   ?>" /> -->
	</div>
	<!-- address 1 -->
	<div class="triple_ele">
	   <label for="vendor_csd_return_address1"><?php _e('Address', 'woocommerce'); ?> <span class="required">*</span></label>
	   <input type="text" required="required" name="vendor_csd_return_address1" id="vendor_csd_return_address1"
	      value="<?php if (!empty($_POST['vendor_csd_return_address1'])) echo esc_attr($_POST['vendor_csd_return_address1']); ?>"/>
	</div>
	<br/>
	<!-- ############################### End of return address ################################### -->
	<?php
}
// ************************************************************
// 2.	clean data
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// ************************************************************
// 3.	validate fields when the vendor register
function validate_vendor_fields($username, $email, $validation_errors)
	{
		if(isset($_POST['pending_vendor'])){

    //
			if (isset($_POST['first_name']) && empty($_POST['first_name']))
				{
				$validation_errors->add('first_name_error', __(' First name is required!', 'woocommerce'));
				}
			 if (isset($_POST['last_name']) && empty($_POST['last_name']))
				{
				$validation_errors->add('last_name_error', __(' Last name is required!.', 'woocommerce'));
				}
			 if (isset($_POST['password']) && empty($_POST['password']))
				{
				$validation_errors->add('reg_password_error', __(' Password is required!', 'woocommerce'));
				}
			 if (isset($_POST['conf_reg_password']) && empty($_POST['conf_reg_password']))
				{
				$validation_errors->add('conf_password_error', __(' Password confirmation is required!', 'woocommerce'));
				}
			 if (strcmp( $_POST['password'], $_POST['conf_reg_password']) !== 0)
				{
				$validation_errors->add('match_password_error', __(' Passwords does not match!', 'woocommerce'));
				}
			 if (isset($_POST['vendor_commercial_ID_input']) && empty($_POST['vendor_commercial_ID_input']))
				{
				$validation_errors->add('_commercial_number_error', __(' Commercial number is required!.', 'woocommerce'));
				}
			 if (isset($_POST['vendor_company']) && empty($_POST['vendor_company']))
				{
				$validation_errors->add('vendor_company_error', __(' Company is required!.', 'woocommerce'));
				}
				if (isset($_POST['vendor_bank_account_number']) && empty($_POST['vendor_bank_account_number']))
				{
				$validation_errors->add('vendor_bank_account_name_error', __(' Bank account name is required!.', 'woocommerce'));
				}
				if (isset($_POST['vendor_bank_name']) && empty($_POST['vendor_bank_name']))
				{
				$validation_errors->add('vendor_bank_name_error', __(' Bank name is required!.', 'woocommerce'));
				}
				if (isset($_POST['vendor_iban']) && empty($_POST['vendor_iban']))
				{
				$validation_errors->add('vendor_iban_error', __(' IBAN is required!.', 'woocommerce'));
				}
			 if (isset($_POST['vendor_phone']) && empty($_POST['vendor_phone']))
				{
				$validation_errors->add('vendor_phone_error', __(' Phone is required!.', 'woocommerce'));
				}
			// ********************************** Shipping ***********************************
			 if (isset($_POST['vendor_country']) && empty($_POST['vendor_country']))
				{
				$validation_errors->add('vendor_country_error', __(' Shipping Country is required!.', 'woocommerce'));
				}
			 if (isset($_POST['vendor_city']) && empty($_POST['vendor_city']))
				{
				$validation_errors->add('vendor_city_error', __(' Shipping City is required!.', 'woocommerce'));
				}
			 if (isset($_POST['vendor_address_1']) && empty($_POST['vendor_address_1']))
				{
				$validation_errors->add('vendor_address_1_error', __(' Shipping Address is required!.', 'woocommerce'));
				}
			// *********************************** Responsible ***********************************
			 if (isset($_POST['vendor_resp_fname']) && empty($_POST['vendor_resp_fname']))
				{
				$validation_errors->add('vendor_resp_fname_error', __(' Responsibl first name is required!.', 'woocommerce'));
				}
			 if (isset($_POST['vendor_resp_lname']) && empty($_POST['vendor_resp_lname']))
				{
				$validation_errors->add('vendor_resp_lname_error', __(' Responsibl last name is required!.', 'woocommerce'));
				}
			 if (isset($_POST['vendor_resp_phone']) && empty($_POST['vendor_resp_phone']))
				{
				$validation_errors->add('vendor_resp_phone_error', __(' Responsibl phone is required!.', 'woocommerce'));
				}
			 if (isset($_POST['vendor_resp_email']) && empty($_POST['vendor_resp_email']))
				{
				$validation_errors->add('vendor_resp_email_error', __(' Responsibl e-mail is required!.', 'woocommerce'));
				}
			// *********************************** Returning ***********************************
			 if (isset($_POST['vendor_customer_email']) && empty($_POST['vendor_customer_email']))
				{
				$validation_errors->add('vendor_customer_email_error', __(' Returning e-mail is required!.', 'woocommerce'));
				}
			 if (isset($_POST['vendor_csd_return_country']) && empty($_POST['vendor_csd_return_country']))
				{
				$validation_errors->add('vendor_csd_return_country_error', __(' Returning country is required!.', 'woocommerce'));
				}
			 if (isset($_POST['vendor_csd_return_city']) && empty($_POST['vendor_csd_return_city']))
				{
				$validation_errors->add('vendor_csd_return_city_error', __(' Returning city is required!.', 'woocommerce'));
				}
			 if (isset($_POST['vendor_csd_return_address1']) && empty($_POST['vendor_csd_return_address1']))
				{
				$validation_errors->add('vendor_csd_return_address1_error', __(' Returning address is required!.', 'woocommerce'));
				}
			 if (isset($_POST['vendor_customer_phone']) && empty($_POST['vendor_customer_phone']))
				{
				$validation_errors->add('vendor_customer_phone_error', __(' Returning phone is required!.', 'woocommerce'));
				}
}
}
add_action('woocommerce_register_post', 'validate_vendor_fields', 10,3);
// ************************************************************
// 4.	if the data is valid then save it in the database
function save_pending_vendor_fields($user_id)
	{
		save_vendor_data($user_id,$_POST , 1);
  }
add_action('woocommerce_created_customer', 'save_pending_vendor_fields', 10);
// ************************************************************
// 5. if the saving completed -> redirect to success page
add_filter('woocommerce_registration_redirect', 'redirect_vendor_to_successful_registration',10);
function redirect_vendor_to_successful_registration( $redirect_to ) {
	global $WCMp;
	$current_user_is_vendor = is_user_wcmp_pending_vendor(get_current_user_id());
	if ($current_user_is_vendor)
		{
			if(ICL_LANGUAGE_CODE == 'ar'){
				$redirect_to = get_site_url().'/success';
			}
			if(ICL_LANGUAGE_CODE == 'en'){
				$redirect_to = get_site_url().'en/success';
			}

		}
  return $redirect_to;
}
// ************************************************************
// 6.	show pending vendor fields to the admin in user page
function show_pending_vendor_informations($user)
	{
	global $WCMp;
	$current_user_is_vendor = is_user_wcmp_pending_vendor($user->ID);
	if ($current_user_is_vendor)
		{
			$vendor_identity_option = get_user_meta($user->ID, '_id-crn', true);
			?>
		<h1> <?php echo __('Pending Vendor Information', 'wcmp'); ?> </h1>
		<h2> <?php echo __('General Vendor Information', 'wcmp'); ?> </h2>
		<table class="form-table">
		   <tbody>
		    <!-- vendor identity option -->
			<tr>
		         <th>
		            <label for="_id-crn">
		            <?php
		               _e('Vendor Identity Option', 'woocommerce'); ?>
		            </label>
		         </th>
		         <td>
					<div class="half_div">
						<input type="radio" name="_id-crn" required <?php echo ($vendor_identity_option=='vendor_ID')? 'checked': ""; ?> value="vendor_ID"><?php _e('ID','woocommerce');?>
						<input type="radio" name="_id-crn" <?php echo $vendor_identity_option=='vendor_commercial_number'? 'checked': ""; ?> value="vendor_commercial_number"><?php _e('Commercial Registration Number', 'woocommerce');?><br>
					</div>
		         </td>
		      </tr>
				 <!-- commercial number -->
		      <tr>
		         <th>
		            <label for="vendor_commercial_ID_input">
		            <?php
						if($vendor_identity_option=='vendor_ID'){
							_e('Vendor ID', 'woocommerce');
						} elseif($vendor_identity_option=='vendor_commercial_number'){
							_e('Commercial Registration Number', 'woocommerce');
						}
		               ?>
		            </label>
		         </th>
		         <td>
		            <input value="<?php
		               echo esc_attr(get_user_meta($user->ID, '_vendor_commercial_ID_input', true)); ?>"
		               class="regular-text" type="text"  name="_vendor_commercial_ID_input" id="_vendor_commercial_ID_input" />
		         </td>
		      </tr>
					<!-- company name -->
		      <tr>
		         <th>
		            <label for="vendor_company">
		            <?php
		               _e('Company Name', 'woocommerce'); ?>
		            </label>
		         </th>
		         <td>
		            <input value="<?php
		               echo esc_attr(get_user_meta($user->ID, '_vendor_company', true)); ?>"
		               class="regular-text" type="text"  name="vendor_company" id="vendor_company" />
		         </td>
		      </tr>
			  <!-- bank name -->
		      <tr>
		         <th>
		            <label for="vendor_bank_name">
		            <?php
		               _e('Bank Name', 'woocommerce'); ?>
		            </label>
		         </th>
		         <td>
		            <input value="<?php
		               echo esc_attr(get_user_meta($user->ID, '_vendor_bank_name', true)); ?>"
		               class="regular-text" type="text"  name="vendor_bank_name" id="vendor_bank_name" />
		         </td>
		      </tr>
			  <!-- bank account name -->
		      <tr>
		         <th>
		            <label for="vendor_bank_account_number">
		            <?php
		               _e('Bank Account Name', 'woocommerce'); ?>
		            </label>
		         </th>
		         <td>
		            <input value="<?php
		               echo esc_attr(get_user_meta($user->ID, '_vendor_bank_account_number', true)); ?>"
		               class="regular-text" type="text"  name="vendor_bank_account_number" id="vendor_bank_account_number" />
		         </td>
		      </tr>
			  <!-- bank account name -->
		      <tr>
		         <th>
		            <label for="vendor_iban">
		            <?php
		               _e('IBAN', 'woocommerce'); ?>
		            </label>
		         </th>
		         <td>
		            <input value="<?php
		               echo esc_attr(get_user_meta($user->ID, '_vendor_iban', true)); ?>"
		               class="regular-text" type="text"  name="vendor_iban" id="vendor_iban" />
		         </td>
		      </tr>
					<!-- phone number  -->
		      <tr>
		         <th>
		            <label for="_vendor_phone">
		            <?php
		               _e('Phone Number', 'woocommerce'); ?>
		            </label>
		         </th>
		         <td>
		            <input value="<?php
								$ph_key = get_user_meta($user->ID, '_vendor_phone_key', true);
								$ph = get_user_meta($user->ID, '_vendor_phone', true);
								$output = esc_attr($ph_key . $ph);
								echo $output; ?>"
		               class="regular-text" type="text"  name="_vendor_phone" id="_vendor_phone" />
		         </td>
		      </tr>
					<!-- responsible first name -->
					<tr>
		         <th>
		            <label for="resp_fname">
		            <?php
		               _e('Responsible first name', 'woocommerce'); ?>
		            </label>
		         </th>
		         <td>
		            <input value="<?php
		               echo esc_attr(get_user_meta($user->ID, '_vendor_resp_fname', true)); ?>"
		               class="regular-text" type="text"  name="resp_fname" id="resp_fname" />
		         </td>
		      </tr>
					<!-- responsible last name -->
					<tr>
		         <th>
		            <label for="resp_lname">
		            <?php
		               _e('Responsible last name', 'woocommerce'); ?>
		            </label>
		         </th>
		         <td>
		            <input value="<?php
		               echo esc_attr(get_user_meta($user->ID, '_vendor_resp_lname', true)); ?>"
		               class="regular-text" type="text"  name="resp_lname" id="resp_lname" />
		         </td>
		      </tr>
					<!-- responsible phone number -->
					<tr>
		         <th>
		            <label for="resp_phone">
		            <?php
		               _e('Responsible phone number', 'woocommerce'); ?>
		            </label>
		         </th>
		         <td>
		            <input value="<?php
								$ph_key = get_user_meta($user->ID, '_vendor_resp_phone_key', true);
								$ph = get_user_meta($user->ID, '_vendor_resp_phone', true);
								$output = esc_attr($ph_key . $ph);
								echo $output;?>"
		               class="regular-text" type="text"  name="resp_phone" id="resp_phone" />
		         </td>
		      </tr>
					<!-- responsible email -->
					<tr>
		         <th>
		            <label for="resp_email">
		            <?php
		               _e('Responsible email', 'woocommerce'); ?>
		            </label>
		         </th>
		         <td>
		            <input value="<?php
		               echo esc_attr(get_user_meta($user->ID, '_vendor_resp_email', true)); ?>"
		               class="regular-text" type="text"  name="resp_email" id="resp_email" />
		         </td>
		      </tr>
		   </tbody>
		</table>

		<h2> <?php echo __('Relationship Manager', 'wcmp'); ?> </h2>
		<table class="form-table">
		   <tbody>
				 <tr>
						<th>
							 <!-- ID -->
							 <label for="relationship_manager_ID">
							 <?php
									_e('ID', 'woocommerce'); ?>
							 </label>
							 </td>
						<td>
							 <input value="<?php
									echo esc_attr(get_user_meta($user->ID, 'relationship_manager_ID', true)); ?>"
									class="regular-text" type="text"  name="relationship_manager_ID" id="relationship_manager_ID" />
						</td>
				 </tr>
				 <tr>
					 <th>
							<!-- Name -->
							<label for="relationship_manager_name">
							<?php
								 _e('Name', 'woocommerce'); ?>
							</label>
							</td>
					 <td>
							<input value="<?php
								 echo esc_attr(get_user_meta($user->ID, 'relationship_manager_name', true)); ?>"
								 class="regular-text" type="text"  name="relationship_manager_name" id="relationship_manager_name" />
					 </td>
				</tr>
				 <tr>
						<th>
							 <!-- email -->
							 <label for="relationship_manager_email">
							 <?php
									_e('Email', 'woocommerce'); ?>
							 </label>
							 </td>
						<td>
							 <input value="<?php
									echo esc_attr(get_user_meta($user->ID, 'relationship_manager_email', true)); ?>"
									class="regular-text" type="email"  name="relationship_manager_email" id="relationship_manager_email" />
						</td>
				 </tr>
				 <tr>
					 <th>
							<!-- phone -->
							<label for="relationship_manager_phone">
							<?php
								 _e('Phone number', 'woocommerce'); ?>
							</label>
							</td>
					 <td>
							<input value="<?php
								 echo esc_attr(get_user_meta($user->ID, 'relationship_manager_phone', true)); ?>"
								 class="regular-text" type="text"  name="relationship_manager_phone" id="relationship_manager_phone" />
					 </td>
				</tr>
		   </tbody>
		</table>

		<h2> <?php echo __('Shipping Address', 'wcmp'); ?> </h2>
		<table class="form-table">
		   <tbody>
		      <tr>
		         <th>
		            <!-- country -->
		            <label for="ship_country">
		            <?php
		               _e('Country', 'woocommerce'); ?>
		            </label>
		            </td>
		         <td>
		            <input value="<?php
		               echo esc_attr(get_country_by_code(get_user_meta($user->ID, '_vendor_country', true))); ?>"
		               class="regular-text" type="text"  name="ship_country" id="ship_country" />
		         </td>
		      <tr>
		         <th>
		            <!-- city -->
		            <label for="ship_city">
		            <?php
		               _e('City', 'woocommerce'); ?>
		            </label>
		         </th>
		         <td>
		            <input value="<?php
		               echo esc_attr(get_user_meta($user->ID, '_vendor_city', true)); ?>"
		               class="regular-text" type="text"  name="ship_city" id="ship_city" />
		         </td>
		      </tr>
		      <tr>
		         <th>
		            <!-- address -->
		            <label for="ship_address_1">
		            <?php
		               _e('Address', 'woocommerce'); ?> 1
		            </label>
		         </th>
		         <td>
		            <input value="<?php
		               echo esc_attr(get_user_meta($user->ID, '_vendor_address_1', true)); ?>"
		               class="regular-text" type="text"  name="ship_address_1" id="ship_address_1" />
		         </td>
		      </tr>
		   </tbody>
		</table>

		<h2> <?php echo __('Returning Address', 'wcmp'); ?> </h2>
		<table class="form-table">
		   <tbody>
				 <tr>
						<th>
							 <!-- email -->
							 <label for="return_email">
							 <?php
									_e('Email', 'woocommerce'); ?>
							 </label>
							 </td>
						<td>
							 <input value="<?php
									echo esc_attr(get_user_meta($user->ID, '_vendor_customer_email', true)); ?>"
									class="regular-text" type="email"  name="return_email" id="return_email" />
						</td>
				 </tr>
				 <tr>
					 <th>
							<!-- phone -->
							<label for="return_phone">
							<?php
								 _e('Phone number', 'woocommerce'); ?>
							</label>
							</td>
					 <td>
							<input value="<?php
							$ph_key = get_user_meta($user->ID, '_vendor_customer_phone_key', true);
							$ph = get_user_meta($user->ID, '_vendor_customer_phone', true);
							$output = esc_attr($ph_key . $ph);
							echo $output ?>"
								 class="regular-text" type="text"  name="return_phone" id="return_phone" />
					 </td>
				</tr>
		      <tr>
		         <th>
		            <!-- country -->
		            <label for="return_country">
		            <?php
		               _e('Country', 'woocommerce'); ?>
		            </label>
		            </td>
		         <td>
		            <input value="<?php
		               echo esc_attr(get_country_by_code(get_user_meta($user->ID, '_vendor_csd_return_country', true))); ?>"
		               class="regular-text" type="text"  name="return_country" id="return_country" />
		         </td>
		      </tr>
		      <tr>
		         <th>
		            <!-- city -->
		            <label for="return_city">
		            <?php
		               _e('City', 'woocommerce'); ?>
		            </label>
		         </th>
		         <td>
		            <input value="<?php
		               echo esc_attr(get_user_meta($user->ID, '_vendor_csd_return_city', true)); ?>"
		               class="regular-text" type="text"  name="return_city" id="return_city" />
		         </td>
		      </tr>
		      <tr>
		         <th>
		            <!-- address -->
		            <label for="return_address_1">
		            <?php
		               _e('Address', 'woocommerce'); ?> 1
		            </label>
		         </th>
		         <td>
		            <input value="<?php
		               echo esc_attr(get_user_meta($user->ID, '_vendor_csd_return_address1', true)); ?>"
		               class="regular-text" type="text"  name="return_address_1" id="return_address_1" />
		         </td>
		      </tr>
		   </tbody>
		</table>
		<?php
		}
	}
add_action('show_user_profile', 'show_pending_vendor_informations');
add_action('edit_user_profile', 'show_pending_vendor_informations');

add_action('wcmp_vendor_register_form', 'vendor_registration_terms', 500);
function vendor_registration_terms() {
	?>
		<div class="vendor_terms">
			<?php wc_get_template( 'checkout/terms.php' ); ?>
		</div>

<?php
}
// --------------------------- End vendor form registration processing data -------------------------------

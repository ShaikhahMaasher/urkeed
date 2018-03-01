
jQuery(document).ready( function( $ ) {
  /*
  * author : Elham
  * all phone numbers field will show the country flag and validated
  */
  // $("#vendor_resp_phone, #vendor_resp_phone ,#vendor_customer_phone , #reg_billing_phone ,#billing_phone").intlTelInput({
  // initialCountry: "auto",
  // // formatOnDisplay: true,
  // geoIpLookup: function(callback) {
  //   $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
  //     var countryCode = (resp && resp.country) ? resp.country : '';
  //     callback(countryCode);
  //   });
  // },
  // preferredCountries: ['sa', 'bh' ,'kw' ,'om' , 'qa' , 'ae'],
  // utilsScript: "<?php echo get_stylesheet_directory_uri(). '/js/utils.js' ;?>"
  // });

  /*
  * author : Elham
  * make all input with type : tel accept only numbers
  */
  $("#vendor_resp_phone, #vendor_resp_phone ,#vendor_customer_phone , #billing_user_phone ,#billing_phone").keypress(function(){
    return $(this).val().charCode >= 48 && $(this).val().charCode <= 57;
  });

  // $("#payfort_fort_expiry_month").attr("placeholder", "MM");
  // $("#payfort_fort_expiry_year").attr("placeholder", "YY");
  // $("#payfort_fort_card_security_code").attr("placeholder", "CVC");
});

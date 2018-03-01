jQuery(document).ready( function( $ ) {
	if (!$("body").hasClass("rtl")) {
		$('.wpml-ls-flag').attr('src', 'https://www.urkeed.com/wp-content/themes/ispirit-child/img/ar_ksa.png');
	}

  // author : Elham
  // toggle the customer detaisl to miinimize it in thank you page


  // author : Elham
  // disable arabic fields
  // $('#title').prop('readonly',true);
  // $('#description').prop('readonly',true);
  // $('#excerpt').prop('readonly',true);

  // disable Calculated prices fileds
  // $('input[name*=\'regular_price\']').prop('readonly',true);
  // $('input[name*=\'sale_price\']').prop('readonly',true);

  // author : Elham
  // if the vendor enter a price it will be multiplied by 2 and save it in the regular price
  // $('input[name*=\'vendor_reg_price\']').change(function(){
  //       var price = Number($(this).val());
  //       var total = (price ) * 2;
  //       $('input[name*=\'regular_price\']').val(total);
  //   });
  //
  //   $('input[name*=\'vendor_s_price\']').change(function(){
  //         var price = Number($(this).val());
  //         var total = (price ) * 2;
  //         $('input[name*=\'sale_price\']').val(total);
  //   });

    // author : Elham
    // when the user click on customer details on thank you page-> toggle
    $('#minimize-content').click(function(){
        if($('#minimizer').html() === '-'){
            $('#minimizer').html('+');
        }
        else{
            $('#minimizer').html('-');
        }
        $('#details-toggle').slideToggle();
    });

    // author : Elham
    // when the user click on customer details on thank you page-> toggle
    $('#track-minimizer').click(function(){
        $('#track-toggle').slideToggle();
    });

  /* Add spinner loader for product catalog and homepage categories section
   * Author: Shaikhah
   */
  $('.adstext').click(function(){
    $(this).find('#preloader_img').show();
    $.ajax({
     success:function(result){
         $('#preloader_img').hide();
     }
    });
  });

  $('body').on('click', '.woocommerce-LoopProduct-link', function() {
    $(this).find('#preloader_img').show();
    $.ajax({
     success:function(result){
         $('#preloader_img').hide();
     }
    });
  });

  $('.product_type_variable').click(function(){
    $(this).find('#preloader_variable_img').show();
    $.ajax({
     success:function(result){
         $('#preloader_variable_img').hide();
     }
    });
  });

  $('.adstext').append('<img id="preloader_img" src="https://urkeed.com/images/load_spinner.gif" style="top:50%;"/>');
  $('.woocommerce-LoopProduct-link').append('<img id="preloader_img" src="https://urkeed.com/images/load_spinner.gif" style="top:35%;"/>');
  $('.product_type_variable').append('<img id="preloader_variable_img" src="https://urkeed.com/images/load_spinner.gif"/>');
  // End of spinner loading

  // "use strict";

	$( '.child-thumbnail-container' ).each(function() {
		if ( $( this ).children('img').length > 1 )
		{
			$( this ).addClass( 'nx-flipit' );
		}

	});

  $(window).on('resize', function(){
      var win = $(this); //this = window
      if (win.height() < 900) {
        $('add-to-cart-txt').hide();
        $('#add-to-cart-btn').addClass('fa fa-shopping-cart');
      /* ... */ }
      if (win.width() >= 900) {
        $('add-to-cart-txt').show();
        $('#add-to-cart-btn').removeClass('fa fa-shopping-cart');
      /* ... */ }
    });

	

// $("#window").width();
  // var width = $(this).width();
  // if(width < 900){
  //   $('#add-to-cart-btn').addClass('fa fa-shopping-cart');
  // }
});

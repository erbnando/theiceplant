(function($){
    $('.single .woocommerce-message .button.wc-forward').appendTo('.single .woocommerce-message');

	$('body').bind('added_to_cart', function(event, fragments, cart_hash) {
		if ($('.menu-cart:contains("(")').length) {
			cartcount = $('.menu-cart span').text();
			cartcount = parseInt(cartcount);
			cartcount = cartcount + 1;
			$('.menu-cart span').text(cartcount);
			$.ajax({
				url: "/wp-content/themes/theiceplant/assets/test.php",
				cache: false,
				success: function(data){
			    	console.log(data);
			  }
			});

		} else {
			$('.menu-cart').html("CART (<span>1</span>)");			
		}
	});
})(jQuery);
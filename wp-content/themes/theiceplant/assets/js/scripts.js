(function($){
    $('.single .woocommerce-message .button.wc-forward').appendTo('.single .woocommerce-message');
	$(document).ready(function(){
		$('.slider').slick({
			fade: true,
			speed: 50,
			autoplay: true,
			autoplaySpeed: 1500,
			pauseOnHover: false,
			arrows: false,
			draggable: false
		});
	});
})(jQuery);
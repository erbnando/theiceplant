<?php

function wpdocs_theme_name_scripts() {
    wp_enqueue_style( 'app-styles', get_template_directory_uri() . '/assets/scss/app.css');
    wp_enqueue_style( 'legacy-styles', get_template_directory_uri() . '/assets/scss/legacy.css');

    wp_enqueue_script( 'app-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );

add_action('after_setup_theme', 'remove_admin_bar');

show_admin_bar(false);

if (  ! function_exists( 'woocommerce_template_loop_product_title' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H3.
	 */
	function woocommerce_template_loop_product_title() {
		echo '<span class="textBookTitle">' . get_the_title() . '</span>';
		if(get_field('subtitle')) { 
			echo '<span class="textBookTitle">: <span class="subtitle">' . get_field('subtitle') . '</span></span>'; 
		}
		echo '<br><span class="textNormal">' . get_field('author') . '</span>';
		echo '<br><span class="textNormalSmall">' . get_field('details') . '</span>';
	}
}

add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'USD': $currency_symbol = ' USD'; break;
     }
     return $currency_symbol;
}

// Disable product review (tab)
function woo_remove_product_tabs($tabs) {
	unset($tabs['reviews']);
	return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

?>
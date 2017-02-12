<?php

function wpdocs_theme_name_scripts() {
    wp_enqueue_style( 'app-styles', get_template_directory_uri() . '/assets/css/app.css');
    wp_enqueue_style( 'legacy-styles', get_template_directory_uri() . '/assets/css/legacy.css');

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

add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );
function custom_pre_get_posts_query( $q ) {
	if ( ! $q->is_main_query() ) return;
	if ( ! $q->is_post_type_archive() ) return;
	if ( ! is_admin() && is_shop() ) {
		$q->set( 'tax_query', array(array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => array( 'books' ), // Don't display products in the knives category on the shop page
			'operator' => 'IN'
		)));
	}
	remove_action( 'pre_get_posts', 'custom_pre_get_posts_query' );
}

function my_theme_add_editor_styles() {
    add_editor_style( 'assets/css/editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );

// Menu
register_nav_menus( array(
	'main_menu' => 'Main Menu'
) );


?>
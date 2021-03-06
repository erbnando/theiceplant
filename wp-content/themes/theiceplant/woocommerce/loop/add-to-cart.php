<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     100
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( !$product->is_in_stock() ) {
	if ($product->get_price()) {
	    echo '<br><span class="textNormalSmall out-of-stock">OUT OF STOCK</span>';
	} else {
	    echo '<br><span class="textNormalSmall out-of-stock">OUT OF PRINT</span>';
	}
} else {
	if ($product->get_price()) {
		echo apply_filters( 'woocommerce_loop_add_to_cart_link',
			sprintf( '<br><a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product->id ),
				esc_attr( $product->get_sku() ),
				esc_attr( isset( $class ) ? $class : 'button' ),
				esc_html( $product->add_to_cart_text() )
			),
		$product );
	} else {
		echo '<span class="textNormalSmall notavail">NOT YET PUBLISHED</span>';
	}
}

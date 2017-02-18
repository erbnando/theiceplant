<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

the_title( '<span class="textBookTitle">', '</span>' );
if(get_field('small_subtitle')) { 
	echo '<span class="textBookTitle">:<span class="subtitle"> ' . get_field('small_subtitle') . '</span></span>';
}
if(get_field('subtitle')) {
	echo '<br><span class="textBookTitle">' . get_field('subtitle') . '</span>';
}
if(get_field('author')) {
	echo '<br><span class="textNormal">' . get_field('author') . '</span>';
}
if(get_field('details')) {
	echo '<br><span class="textNormalSmall">' . get_field('details') . '</span>';
}
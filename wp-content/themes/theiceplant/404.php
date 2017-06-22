<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="main">
	<p class="textNormal">Page not found. Check out our <a href="<?php echo get_permalink( woocommerce_get_page_id('shop')); ?>">catalog</a>.</p>
</div>

<?php get_footer();
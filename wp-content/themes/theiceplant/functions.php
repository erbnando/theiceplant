<?php

function wpdocs_theme_name_scripts() {
    wp_enqueue_style( 'app-styles', get_template_directory_uri() . '/assets/css/app.css');
    wp_enqueue_style( 'legacy-styles', get_template_directory_uri() . '/assets/css/legacy.css');

    wp_enqueue_script( 'app-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), '1.0.0', true );
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.min.js', array(), '1.6.0', true );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );

//add_action('after_setup_theme', 'remove_admin_bar');

show_admin_bar(false);

if (  ! function_exists( 'woocommerce_template_loop_product_title' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H3.
	 */
	function woocommerce_template_loop_product_title() {
		echo '<span class="textBookTitle">' . get_the_title() . '</span>';
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
			echo '<br><span class="textNormalSmall bookdeets">' . get_field('details') . '</span>';
		}
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

// Menu
register_nav_menus( array(
	'main_menu' => 'Main Menu'
) );

remove_action( 'woocommerce_before_single_product', 'wc_print_notices' );
add_action( 'woocommerce_single_product_summary', 'wc_print_notices', 60 );

function next_post_link_product($format='%link &raquo;', $link='%title', $in_same_cat = false, $excluded_categories = '') {
    adjacent_post_link_product($format, $link, $in_same_cat, $excluded_categories, false);
}

function previous_post_link_product($format='&laquo; %link', $link='%title', $in_same_cat = false, $excluded_categories = '') {
    adjacent_post_link_product($format, $link, $in_same_cat, $excluded_categories, true);
}

function adjacent_post_link_product( $format, $link, $in_same_cat = false, $excluded_categories = '', $previous = true ) {
    if ( $previous && is_attachment() )
        $post = get_post( get_post()->post_parent );
    else
        $post = get_adjacent_post_product( $in_same_cat, $excluded_categories, $previous );

    if ( ! $post ) {
        $output = '';
    } else {
        $title = $post->post_title;

        if ( empty( $post->post_title ) )
            $title = $previous ? __( 'Previous Post' ) : __( 'Next Post' );

        $title = apply_filters( 'the_title', $title, $post->ID );
        $date = mysql2date( get_option( 'date_format' ), $post->post_date );
        $rel = $previous ? 'prev' : 'next';

        $string = '<a href="' . get_permalink( $post ) . '" rel="'.$rel.'">';
        $inlink = str_replace( '%title', $title, $link );
        $inlink = str_replace( '%date', $date, $inlink );
        $inlink = $string . $inlink . '</a>';

        $output = str_replace( '%link', $inlink, $format );
    }

    $adjacent = $previous ? 'previous' : 'next';

    echo apply_filters( "{$adjacent}_post_link", $output, $format, $link, $post );
}

function get_adjacent_post_product( $in_same_cat = false, $excluded_categories = '', $previous = true ) {
    global $wpdb;

    if ( ! $post = get_post() )
        return null;

    $current_post_date = $post->post_date;

    $join = '';
    $posts_in_ex_cats_sql = '';
    if ( $in_same_cat || ! empty( $excluded_categories ) ) {
        $join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";

        if ( $in_same_cat ) {
            if ( ! is_object_in_taxonomy( $post->post_type, 'product_cat' ) )
                return '';
            $cat_array = wp_get_object_terms($post->ID, 'product_cat', array('fields' => 'ids'));
            if ( ! $cat_array || is_wp_error( $cat_array ) )
                return '';
            $join .= " AND tt.taxonomy = 'product_cat' AND tt.term_id IN (" . implode(',', $cat_array) . ")";
        }

        $posts_in_ex_cats_sql = "AND tt.taxonomy = 'product_cat'";
        if ( ! empty( $excluded_categories ) ) {
            if ( ! is_array( $excluded_categories ) ) {
                // back-compat, $excluded_categories used to be IDs separated by " and "
                if ( strpos( $excluded_categories, ' and ' ) !== false ) {
                    _deprecated_argument( __FUNCTION__, '3.3', sprintf( __( 'Use commas instead of %s to separate excluded categories.' ), "'and'" ) );
                    $excluded_categories = explode( ' and ', $excluded_categories );
                } else {
                    $excluded_categories = explode( ',', $excluded_categories );
                }
            }

            $excluded_categories = array_map( 'intval', $excluded_categories );

            if ( ! empty( $cat_array ) ) {
                $excluded_categories = array_diff($excluded_categories, $cat_array);
                $posts_in_ex_cats_sql = '';
            }

            if ( !empty($excluded_categories) ) {
                $posts_in_ex_cats_sql = " AND tt.taxonomy = 'product_cat' AND tt.term_id NOT IN (" . implode($excluded_categories, ',') . ')';
            }
        }
    }

    $adjacent = $previous ? 'previous' : 'next';
    $op = $previous ? '<' : '>';
    $order = $previous ? 'DESC' : 'ASC';

    $join  = apply_filters( "get_{$adjacent}_post_join", $join, $in_same_cat, $excluded_categories );
    $where = apply_filters( "get_{$adjacent}_post_where", $wpdb->prepare("WHERE p.post_date $op %s AND p.post_type = %s AND p.post_status = 'publish' $posts_in_ex_cats_sql", $current_post_date, $post->post_type), $in_same_cat, $excluded_categories );
    $sort  = apply_filters( "get_{$adjacent}_post_sort", "ORDER BY p.post_date $order LIMIT 1" );

    $query = "SELECT p.id FROM $wpdb->posts AS p $join $where $sort";
    $query_key = 'adjacent_post_' . md5($query);
    $result = wp_cache_get($query_key, 'counts');
    if ( false !== $result ) {
        if ( $result )
            $result = get_post( $result );
        return $result;
    }

    $result = $wpdb->get_var( $query );
    if ( null === $result )
        $result = '';

    wp_cache_set($query_key, $result, 'counts');

    if ( $result )
        $result = get_post( $result );

    return $result;
}

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_company']);
    unset($fields['shipping']['shipping_company']);
    return $fields;
}

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return -1;' ), 20 );

if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {

    /**
     * Get the product thumbnail, or the placeholder if not set.
     *
     * @subpackage  Loop
     * @param string $size (default: 'shop_catalog')
     * @param int $deprecated1 Deprecated since WooCommerce 2.0 (default: 0)
     * @param int $deprecated2 Deprecated since WooCommerce 2.0 (default: 0)
     * @return string
     */
    function woocommerce_get_product_thumbnail( $size = 'book-cover', $deprecated1 = 0, $deprecated2 = 0 ) {
        global $post;
        $image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );

        if ( has_post_thumbnail() ) {
            $props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
            return get_the_post_thumbnail( $post->ID, $image_size, array(
                'title'  => $props['title'],
                'alt'    => $props['alt'],
            ) );
        } elseif ( wc_placeholder_img_src() ) {
            return wc_placeholder_img( $image_size );
        }
    }
}

function isa_add_img_title( $attr, $attachment = null ) {

    $img_title = trim( strip_tags( $attachment->post_title ) );

    $attr['title'] = $img_title;
    $attr['alt'] = $img_title;

    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes','isa_add_img_title', 10, 2 );

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}

function remove_editor_menu() {
  remove_action('admin_menu', '_add_themes_utility_last', 101);
}
add_action('_admin_menu', 'remove_editor_menu', 1);

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
    ob_start();
    if (WC()->cart->get_cart_contents_count() === 0){
    ?>
        <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>">CART</a>
    <?php
    } else {
    ?>
        <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>">CART (<?php echo WC()->cart->get_cart_contents_count(); ?>)</a>
    <?php
    }
    $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments;
}

add_image_size( 'book-cover', 350, 386 );

/**
 * Disable responsive image support (test!)
 */

// Clean the up the image from wp_get_attachment_image()
add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['sizes'] ) )
        unset( $attr['sizes'] );

    if( isset( $attr['srcset'] ) )
        unset( $attr['srcset'] );

    return $attr;

 }, PHP_INT_MAX );

// Override the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_false',  PHP_INT_MAX );

// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );

// Remove the reponsive stuff from the content
remove_filter( 'the_content', 'wp_make_content_images_responsive' );

?>
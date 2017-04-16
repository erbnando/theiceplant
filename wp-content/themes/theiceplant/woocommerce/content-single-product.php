<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div>
		<?php
			/**
			 * woocommerce_before_single_product_summary hook.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
		?>

		<div class="summary entry-summary <?php if (get_field('right_floated_image')) { ?>padding-right<?php } ?>">

			<?php
				/**
				 * woocommerce_single_product_summary hook.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 */
				do_action( 'woocommerce_single_product_summary' );
			?>
			<?php
			$right_floated_image = get_field('right_floated_image');
			if( !empty($right_floated_image) ):
				$right_floated_image_url = $right_floated_image['url'];
				$right_floated_image_title = $right_floated_image['title'];
				$right_floated_image_alt = $right_floated_image['alt'];
				$right_floated_image_caption = $right_floated_image['caption'];
				?>
				<a <?php if (get_field('right_floated_image_url_new_tab')) { ?>target="_blank"<?php } ?> href="<?php the_field('right_floated_image_url'); ?>" title="<?php echo $right_floated_image_alt; ?>">
					<img class="right-floated" src="<?php echo $right_floated_image_url; ?>" alt="<?php echo $right_floated_image_alt; ?>" />

				</a>
			<?php endif; ?>
		</div><!-- .summary -->

        <?php global $product; ?>

        <?php if ($product->is_visible() && has_term( 'books', 'product_cat' )) { ?>

    		<div class="books-nav">
    			<?php
    				if (get_adjacent_post_product(true,'',false)) {
    					echo '<a class="book-prev" href="' . get_permalink(get_adjacent_post_product(true,'',false)) . '"><<</a>';
    				} else {
    					$args = array(
    						'numberposts' => 1,
    						'post_type' => 'product',
                            'product_cat' => 'books',
                            'orderby' => 'ASC',
                            'order' => 'DESC',
    					);
    					$desc_posts = get_posts($args);
                        $first = $desc_posts[0]->ID;
    					echo '<a class="book-prev" href="' . get_permalink($first) . '"><<</a>';
    				}
    			?>
    			<?php
    				if (get_adjacent_post_product(true,'',true)) {
    					echo '<a class="book-next" href="' . get_permalink(get_adjacent_post_product(true,'',true)) . '">>></a>';
    				} else {
    					$args = array(
    						'numberposts' => 1,
    						'post_type' => 'product',
                            'product_cat' => 'books',
                            'orderby' => 'ASC',
                            'order' => 'ASC',
    					);
    					$asc_posts = get_posts($args);
    					$latest = $asc_posts[0]->ID;
    					echo '<a class="book-next" href="' . get_permalink($latest) . '">>></a>';
    				}
    			?>
    		</div>

        <?php } ?>
	</div>

	<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		// do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

	<hr class="above-desc">

	<div class="book-content">

		<?php 
		echo '<div class="book-description textNormal">';
		echo the_content();
		echo '</div>';

		if (get_field('about_author')) {
            if(get_the_content()) {
                echo '<hr>';
            }
			echo '<div class="about-author textNormalSmall">';
			echo get_field('about_author');
			echo '</div>';
		}

        ?>
        
        <?php
        if (get_field('video')) {
            if (get_field('about_author')) {
                echo '<hr>';
            }
            ?>
            <video autoplay>
              <source src="<?php echo get_field('video') ?>" type="video/mp4">
            </video>
            <?php
        }

		$attachment_ids = $product->get_gallery_attachment_ids();

		if (!empty($attachment_ids)) {
            if (!get_field('video')) {
                echo '<hr>';
            }
			echo '<div class="image-gallery">';
			foreach($attachment_ids as $item) {
                $image = get_post($item);
                $image_link = wp_get_attachment_url($item);
                if ($image->post_excerpt) {
                    echo '<span class="textNormalSmall">' . $image->post_excerpt . '</span>';
                }
				echo '<img src="' . $image_link . '" alt="' . wp_prepare_attachment_for_js($item)['alt'] . '" title="' . wp_prepare_attachment_for_js($item)['alt'] . '" />';
			}
			echo '</div>';
		}
		?>

	</div>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>

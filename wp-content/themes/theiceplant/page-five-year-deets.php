<?php 
/*
 Template Name: Five Year Diary Details
*/

get_header(); ?>

<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); ?>

			<?php
			$image = get_field('image');
			if( !empty($image) ):
				$image_url = $image['url'];
				$image_alt = $image['alt'];
				?>
				<div class="main">
					<img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>" title="<?php echo $image_alt; ?>" />
					<a href="<?php echo get_permalink( $post->post_parent ); ?>"><<<<</a>
				</div>
			<?php endif; ?>
		<?php
	}
}
?>

<?php get_footer(); ?>
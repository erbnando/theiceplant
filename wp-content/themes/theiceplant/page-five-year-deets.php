<?php 
/*
 Template Name: Five Year Diary Details
*/

get_header(); ?>

<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); ?>

		<div class="main">
			<img src="<?php the_field('image'); ?>"></a>
			<a href="<?php echo get_permalink( $post->post_parent ); ?>"><<<<</a>
		</div>

		<?php
	}
}
?>

<?php get_footer(); ?>
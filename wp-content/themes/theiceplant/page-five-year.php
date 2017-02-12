<?php 
/*
 Template Name: Five Year Diary
*/

get_header(); ?>

<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); ?>

		<div class="main">
			<?php 
			$look_inside_id = get_field('look_inside_url')->ID;
			$look_inside_url = get_permalink($look_inside_id);			
			?>
			<a href="<?php echo $look_inside_url; ?>"><img class="look-inside" src="<?php the_field('look_inside_image'); ?>"></a>
			<div>
				<a href="<?php the_field('diary_1_url'); ?>" target="_blank"><img class="diary" src="<?php the_field('diary_1_image'); ?>"></a>
				<a href="<?php the_field('diary_2_url'); ?>" target="_blank"><img class="diary" src="<?php the_field('diary_2_image'); ?>"></a>
				<a href="<?php the_field('diary_3_url'); ?>" target="_blank"><img class="diary" src="<?php the_field('diary_3_image'); ?>"></a>
				<a href="<?php the_field('diary_4_url'); ?>" target="_blank"><img class="diary" src="<?php the_field('diary_4_image'); ?>"></a>
			</div>
			<p class="title"><?php the_title(); ?></p>
			<?php the_content(); ?>
		</div>

		<?php
	}
}
?>

<?php get_footer(); ?>
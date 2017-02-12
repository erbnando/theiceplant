<?php 
/*
 Template Name: Front Page
*/

get_header(); ?>

<div class="main">
	<div class="top-left-img">
		<div>
			<a href="<?php the_field('top_left_image_link_url') ?>"><img src="<?php the_field('top_left_image') ?>" /></a>
		</div>
	</div>
	<div class="right-img">
		<div>
			<a href="<?php the_field('right_image_link_url') ?>"><img src="<?php the_field('right_image') ?>" /></a>
		</div>
	</div>
	<div class="bottom-left-img">
		<div>
			<a href="<?php the_field('bottom_left_image_link_url') ?>"><img src="<?php the_field('bottom_left_image') ?>" /></a>
		</div>
	</div>
</div>

<?php get_footer(); ?>
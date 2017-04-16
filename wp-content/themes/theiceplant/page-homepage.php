<?php 
/*
 Template Name: Front Page
*/

get_header(); ?>

<div class="main">
	<div class="top-left-img">
		<div>
			<?php
			$top_left = get_field('top_left_image');
			if( !empty($top_left) ):
				$top_left_url = $top_left['url'];
				$top_left_title = $top_left['title'];
				$top_left_alt = $top_left['alt'];
				$top_left_caption = $top_left['caption'];
				?>
				<a href="<?php the_field('top_left_image_link_url') ?>" title="<?php echo $top_left_alt; ?>">
					<img src="<?php echo $top_left_url; ?>" alt="<?php echo $top_left_alt; ?>" />
				</a>
			<?php endif; ?>
		</div>
	</div>
	<div class="right-img">
		<div>
			<?php
			$right_image = get_field('right_image');
			if( !empty($right_image) ):
				$right_image_url = $right_image['url'];
				$right_image_title = $right_image['title'];
				$right_image_alt = $right_image['alt'];
				$right_image_caption = $right_image['caption'];
				?>
				<a href="<?php the_field('right_image_link_url') ?>" title="<?php echo $right_image_alt; ?>">
					<img src="<?php echo $right_image_url; ?>" alt="<?php echo $right_image_alt; ?>" />
				</a>
			<?php endif; ?>
		</div>
	</div>
	<div class="bottom-left-img">
		<div>
			<?php
			$bottom_left_image = get_field('bottom_left_image');
			if( !empty($bottom_left_image) ):
				$bottom_left_image_url = $bottom_left_image['url'];
				$bottom_left_image_title = $bottom_left_image['title'];
				$bottom_left_image_alt = $bottom_left_image['alt'];
				$bottom_left_image_caption = $bottom_left_image['caption'];
				?>
				<a href="<?php the_field('bottom_left_image_link_url') ?>" title="<?php echo $bottom_left_image_alt; ?>">
					<img src="<?php echo $bottom_left_image_url; ?>" alt="<?php echo $bottom_left_image_alt; ?>" />
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
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
			<?php
			$look_inside_image = get_field('look_inside_image');
			if( !empty($look_inside_image) ):
				$look_inside_image_url = $look_inside_image['url'];
				$look_inside_image_alt = $look_inside_image['alt'];
				?>
				<a href="<?php echo $look_inside_url; ?>" class="look-inside" title="<?php echo $look_inside_image_alt; ?>">
					<img class="look-inside" src="<?php echo $look_inside_image_url; ?>" alt="<?php echo $look_inside_image_alt; ?>" />
				</a>
			<?php endif; ?>
			<div>
				<?php
				$diary_1_image = get_field('diary_1_image');
				if( !empty($diary_1_image) ):
					$diary_1_image_url = $diary_1_image['url'];
					$diary_1_image_alt = $diary_1_image['alt'];
					?>
					<a href="<?php the_field('diary_1_url'); ?>" target="_blank" title="<?php echo $diary_1_image_alt; ?>">
						<img class="diary" src="<?php echo $diary_1_image_url; ?>" alt="<?php echo $diary_1_image_alt; ?>" />
					</a>
				<?php endif; ?>
				<?php
				$diary_2_image = get_field('diary_2_image');
				if( !empty($diary_2_image) ):
					$diary_2_image_url = $diary_2_image['url'];
					$diary_2_image_alt = $diary_2_image['alt'];
					?>
					<a href="<?php the_field('diary_2_url'); ?>" target="_blank" title="<?php echo $diary_2_image_alt; ?>">
						<img class="diary" src="<?php echo $diary_2_image_url; ?>" alt="<?php echo $diary_2_image_alt; ?>" />
					</a>
				<?php endif; ?>
				<?php
				$diary_3_image = get_field('diary_3_image');
				if( !empty($diary_3_image) ):
					$diary_3_image_url = $diary_3_image['url'];
					$diary_3_image_alt = $diary_3_image['alt'];
					?>
					<a href="<?php the_field('diary_3_url'); ?>" target="_blank" title="<?php echo $diary_3_image_alt; ?>">
						<img class="diary" src="<?php echo $diary_3_image_url; ?>" alt="<?php echo $diary_3_image_alt; ?>" />
					</a>
				<?php endif; ?>
				<?php
				$diary_4_image = get_field('diary_4_image');
				if( !empty($diary_4_image) ):
					$diary_4_image_url = $diary_4_image['url'];
					$diary_4_image_alt = $diary_4_image['alt'];
					?>
					<a href="<?php the_field('diary_4_url'); ?>" target="_blank" title="<?php echo $diary_4_image_alt; ?>">
						<img class="diary" src="<?php echo $diary_4_image_url; ?>" alt="<?php echo $diary_4_image_alt; ?>" />
					</a>
				<?php endif; ?>
			</div>
			<p class="title"><?php the_title(); ?></p>
			<?php the_content(); ?>
		</div>

		<?php
	}
}
?>

<?php get_footer(); ?>
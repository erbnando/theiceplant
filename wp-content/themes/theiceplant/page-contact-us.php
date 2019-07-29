<?php 
/*
 Template Name: Contact Us
*/

get_header(); ?>

<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); ?>
		<div class="main">
			<p class="title"><?php the_title(); ?></p>
			<script type="text/javascript" src="https://signup.ymlp.com/signup.js?id=gjyjqysgmgj"></script>
			<hr class="block">
			<?php the_content(); ?>
		</div>
		<?php
	}
}
?>

<?php get_footer();

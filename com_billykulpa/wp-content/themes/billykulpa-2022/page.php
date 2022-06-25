<?php
/*
The template for displaying all single posts
*/

// page vars
$hide_header = get_field('hide_header');
$hide_footer = get_field('hide_footer');

get_header(); ?>

<?php /* Start the Loop */
while(have_posts()) : the_post(); ?>
	<div id="content-wrapper">
		<?php the_content(); ?>
	</div><!-- #content-wrapper -->
<?php endwhile;

get_footer();
<?php
/**
 * The template for displaying author pages *
 */
get_header(); ?>
<div id="content-wrapper">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-8">
				<section class="the-posts" id="the-author">
					<?php
					// Show the selected front page content.
					if(have_posts()) : while (have_posts()) : the_post();
						get_template_part('template-parts/parts/content-post', null, array( 
							'class' => '',
							'preview_mode'  => true,
						));
					endwhile;
						the_posts_pagination(array('screen_reader_text' => ' '));
					else :
						get_template_part('404');
					endif;
					?>
				</section><!-- .the-author -->
			</div><!-- .col-lg-8 -->
			<div class="col-xl-3 col-lg-4">
				<section>
					<?php echo do_shortcode('[posts_sidebar post_type="post"]'); ?>
				</section>
			</div><!-- .col-xl-3.col-lg-4 -->
		</div><!-- .row.justify-content-between -->
	</div><!-- .container -->
</div><!-- #content-wrapper -->
<?php get_footer();
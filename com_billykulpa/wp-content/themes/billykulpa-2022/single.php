<?php
/**
 * The template for displaying all single posts and attachments *
 */

get_header();

// vars
$post_type = get_post_type();
$post_type_object = get_post_type_object($post_type);
$post_type_name = $post_type_object->name;
$post_type_label = $post_type_object->labels->singular_name;
if($post_type_name == 'post') :
	$is_blog = true;
endif;
$cats = get_the_category();
$tags = get_the_tags();
$publish_date = get_the_date();
$page_permalink = get_the_permalink();
$about_billy = get_field('about_billy','option');

while (have_posts()) : the_post(); ?>
	<section class="post-<?php echo $post_type_name; ?>">
		<div class="container">
			<?php if(!empty($is_blog)) : ?>
				<div class="row justify-content-between">
					<div class="col-lg-8">
						<?php get_template_part('template-parts/parts/content-post', null, array( 
							'class' => '',
							'preview_mode'  => false,
						)); ?>
					</div><!-- .col-lg-8 -->
					<div class="col-xl-3 col-lg-4">
						<?php echo do_shortcode('[posts_sidebar post_type="post"]'); ?>
					</div><!-- .col-xl-3.col-lg-4 -->
				</div><!-- .row.justify-content-between -->
			<?php else : ?>
				<article>
					<h1><?php echo get_the_title(); ?></h1>
					<?php if(is_singular('portfolio-item')) : get_template_part('template-parts/parts/portfolio-meta'); endif;
					the_content(); ?>
				</article>
			<?php endif; ?>
		</div><!-- .container -->
	</section>
	<?php if(is_singular('portfolio-item')) : ?>
		<section class="about-billy bg-color-light">
			<div class="container">
				<h2 class="h3">About Billy</h2>
				<?php echo $about_billy; ?>
				<a role="button" class="btn btn-md btn-color-dark" href="/contact" target="_self" title="Contact Billy Kulpa">Say Hello</a>
			</div><!-- .container -->
		</section>
	<?php endif;
endwhile;

get_footer();
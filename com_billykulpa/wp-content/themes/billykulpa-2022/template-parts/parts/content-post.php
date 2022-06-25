<?php
	// vars
	$id = get_the_ID();
	$title = get_the_title();
	$cats = get_the_category();
	$tags = get_the_tags();
	$publish_date = get_the_date();
	$page_permalink = get_the_permalink();
	$post_type = get_post_type();
	$post_type_object = get_post_type_object($post_type);
	$post_type_label = $post_type_object->labels->singular_name;
	if(has_post_thumbnail()) :
		// vars
		$thumbnail_id = get_post_thumbnail_id(get_the_ID());
		$thumbnail_alt = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
		$thumbnail_image = wp_get_attachment_image_url($thumbnail_id,'defaultSize');
		$thumbnail_meta = wp_get_attachment_metadata($thumbnail_id);
		$thumbnail_width = $thumbnail_meta['width'];
		$thumbnail_height = $thumbnail_meta['height'];
		$rendered_width = '823.33';
		$rendered_height = $thumbnail_height * $rendered_width / $thumbnail_width;
		$rendered_height = round($rendered_height);
		// storing height and width
		$thumbnail_filename = $thumbnail_meta['file'];
		$thumbnail_file_type_array = pathinfo($thumbnail_filename);
		$thumbnail_file_type = $thumbnail_file_type_array['extension'];
		$image_sizes = [];
		//gets image sizes and all the image paths for jpg and webp images
		foreach(wp_get_registered_image_subsizes() as $size=>$data) {
			$image_sizes[$size] = get_the_post_thumbnail_url(get_the_ID(),$size);
		}
		$thumbnail_image_sizes = imageSizes(($image_sizes));
	endif;
	// preview variables
	if(!empty($args['preview_mode'])) :
		$post_class = 'is-preview';
	else :
		$post_class = 'is-full-article';
	endif;
?>
<article <?php post_class($post_class); ?> id="post-<?php echo $id; ?>">
	<div class="meta-group meta-header">
		<div class="published">
			<div class="icon">
				<img alt="An icon for a calendar" height="20" loading="lazy" src="/wp-content/uploads/icon-calendar.svg" width="20" />
			</div><!-- .icon -->
			<p>Published <?php echo $publish_date; ?></p>
		</div><!-- .published -->
		<?php if(is_category() || is_tag() || is_author()) : ?>
			<div class="post-type">
				<div class="icon">
					<img alt="An icon for a post type" height="20" loading="lazy" src="/wp-content/uploads/icon-page.svg" width="20" />
				</div><!-- .icon -->
				<p><?php echo $post_type_label; ?></p>
			</div><!-- .post-type -->
		<?php endif; ?>
	</div><!-- .meta-group.meta-header -->

	<div class="headline">
		<h2><?php if(!empty($args['preview_mode'])) : ?><a href="<?php if(!empty($source_url)) : echo $source_url; else : echo $page_permalink; endif; ?>" target="<?php if(!empty($source_url)) : ?>_blank<?php else : ?>_self<?php endif; ?>" title="Read this post"><?php endif; echo $title; if(!empty($args['preview_mode'])) : ?></a><?php endif; ?></h2>
	</div><!-- .headline -->

	<?php if(!empty($args['preview_mode']) && has_post_thumbnail()) : ?>
		<div class="preview-mode">
			<div class="content-wrapper">
	<?php endif; ?>

	<div class="byline">
		<?php billykulpa2022_byline(); ?>
	</div><!-- .byline -->

	<?php if(empty($args['preview_mode']) && has_post_thumbnail()) : // not preview mode ?>
		<div class="image">
			<picture>
				<source srcset="<?php echo $thumbnail_image_sizes['size_1000']['webp']; ?>" media="(min-width: 1400px)" type="image/webp">
				<source srcset="<?php echo $thumbnail_image_sizes['size_900']['webp']; ?>" media="(min-width: 1200px)" type="image/webp">
				<source srcset="<?php echo $thumbnail_image_sizes['size_800']['webp']; ?>" media="(min-width: 768px)" type="image/webp">
				<source srcset="<?php echo $thumbnail_image_sizes['size_700']['webp']; ?>" media="(min-width: 545px)" type="image/webp">
				<source srcset="<?php echo $thumbnail_image_sizes['size_600']['webp']; ?>" media="(max-width: 544px)" type="image/webp">
				<source srcset="<?php echo $thumbnail_image_sizes['size_1000']['original']; ?>" media="(min-width: 1400px)" type="image/<?php echo $thumbnail_file_type; ?>">
				<source srcset="<?php echo $thumbnail_image_sizes['size_900']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $thumbnail_file_type; ?>">
				<source srcset="<?php echo $thumbnail_image_sizes['size_800']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $thumbnail_file_type; ?>">
				<source srcset="<?php echo $thumbnail_image_sizes['size_700']['original']; ?>" media="(min-width: 545px)" type="image/<?php echo $thumbnail_file_type; ?>">
				<source srcset="<?php echo $thumbnail_image_sizes['size_600']['original']; ?>" media="(max-width: 544px)" type="image/<?php echo $thumbnail_file_type; ?>">
				<img loading="lazy" alt="<?php if($thumbnail_alt) : echo $thumbnail_alt; else : echo $title; endif; ?>" height="<?php echo $rendered_height; ?>" src="<?php echo $thumbnail_image; ?>" width="<?php echo $rendered_width; ?>">
			</picture>
		</div><!-- .image -->
	<?php endif; ?>

	<div class="body">
		<?php if(!empty($args['preview_mode'])) : echo bac_manual_auto_excerpt(get_the_content($id),30); else : the_content(); endif; ?>
	</div><!-- .body -->

	<?php if(!empty($args['preview_mode'])) : ?>
		<div class="btn-group">
			<a role="button" class="btn btn-minimal btn-color-dark" href="<?php if(!empty($source_url)) : echo $source_url; else : echo $page_permalink; endif; ?>" target="<?php if(!empty($source_url)) : ?>_blank<?php else : ?>_self<?php endif; ?>" title="Read this post">Read Post</a>
		</div><!-- .btn-group -->
	<?php endif;

	if(!empty($tags) && !is_tag() && !is_category() || !empty($cats) && !is_tag() && !is_category()) : ?>
		<div class="meta-group meta-footer">
			<?php if(!empty($cats)) : ?>
				<div class="categories">
					<div class="icon">
						<img alt="An icon for categories" height="20" loading="lazy" src="/wp-content/uploads/icon-category.svg" width="20" />
					</div><!-- .icon -->
					<ul>
						<?php
							$cats_counter = 0;
							$total_cats_count = count($cats); ?>
							<?php foreach($cats as $cat) : ?>
								<li><a href="<?php echo esc_url(get_tag_link($cat->term_id)); ?>" title="<?php echo esc_attr($cat->name); ?>">
										<?php echo esc_html($cat->name); ?></a><?php if($cats_counter != $total_cats_count - 1) : echo ', '; endif; ?></li>
								<?php $cats_counter++;
							endforeach;
						?>
					</ul>
				</div><!-- .categories -->
			<?php endif;
			if(!empty($tags)) : ?>
				<div class="tags">
					<div class="icon">
						<img alt="An icon for tags" height="20" loading="lazy" src="/wp-content/uploads/icon-tag.svg" width="20" />
					</div><!-- .icon -->
					<ul>
						<?php
							$tags_counter = 0;
							$total_tags_count = count($tags);
							foreach($tags as $tag) : ?>
								<li><a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" title="<?php echo esc_attr($tag->name); ?>">
										<?php echo esc_html($tag->name); ?></a><?php if($tags_counter != $total_tags_count - 1) : echo ', '; endif; ?></li>
								<?php $tags_counter++;
							endforeach;
						?>
					</ul>
				</div><!-- .tags -->
			<?php endif; ?>
		</div><!-- .meta-group.meta-footer -->
	<?php endif;

	if(!empty($args['preview_mode']) && has_post_thumbnail()) : ?>
			</div><!-- .content-wrapper -->
			<div class="image-wrapper">
				<div class="image">
					<picture>
						<source srcset="<?php echo $thumbnail_image_sizes['size_600']['webp']; ?>" media="(min-width: 1200px)" type="image/webp">
						<source srcset="<?php echo $thumbnail_image_sizes['size_500']['webp']; ?>" media="(min-width: 992px)" type="image/webp">
						<source srcset="<?php echo $thumbnail_image_sizes['size_800']['webp']; ?>" media="(min-width: 768px)" type="image/webp">
						<source srcset="<?php echo $thumbnail_image_sizes['size_700']['webp']; ?>" media="(min-width: 545px)" type="image/webp">
						<source srcset="<?php echo $thumbnail_image_sizes['size_600']['webp']; ?>" media="(max-width: 544px)" type="image/webp">
						<source srcset="<?php echo $thumbnail_image_sizes['size_600']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $thumbnail_file_type; ?>">
						<source srcset="<?php echo $thumbnail_image_sizes['size_500']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $thumbnail_file_type; ?>">
						<source srcset="<?php echo $thumbnail_image_sizes['size_800']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $thumbnail_file_type; ?>">
						<source srcset="<?php echo $thumbnail_image_sizes['size_700']['original']; ?>" media="(min-width: 545px)" type="image/<?php echo $thumbnail_file_type; ?>">
						<source srcset="<?php echo $thumbnail_image_sizes['size_600']['original']; ?>" media="(max-width: 544px)" type="image/<?php echo $thumbnail_file_type; ?>">
						<img loading="lazy" alt="<?php if($thumbnail_alt) : echo $thumbnail_alt; else : echo $title; endif; ?>" height="<?php echo $rendered_height; ?>" src="<?php echo $thumbnail_image; ?>" width="<?php echo $rendered_width; ?>">
					</picture>
				</div><!-- .image -->
			</div><!-- .image-wrapper -->
		</div><!-- .preview-mode -->
	<?php endif; ?>
</article>
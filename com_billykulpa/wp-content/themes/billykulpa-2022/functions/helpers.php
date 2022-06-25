<?php

// Fix empty Ps added by Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');

if (!function_exists('billykulpa2022_byline')) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */

	function billykulpa2022_byline() {
		$post_id = get_the_id();
		$user_id = get_the_author_meta('ID');
		$user_photo = get_field('user_photo', 'user_' . $user_id);

		if($user_photo) {
			$user_photo_alt = $user_photo['alt'];
			$user_photo_name = $user_photo['name'];
			$user_photo_url = $user_photo['url'];

			//gets all the possible image sizes and webp versions
			$user_photo_sizes = imageSizes($user_photo['sizes']);

			$user_photo_filename = $user_photo['filename'];
			if(strpos($user_photo_filename, '-scaled.') !== false) {
				$user_photo_scaled_check = true;
				$user_photo_filename = str_replace('-scaled', '', $user_photo_filename);
			}
			$file_type_array = pathinfo($user_photo_filename);
				$user_photo_file_type = $user_photo_file_type_array['extension'];
			// check if speaker_image is an SVG
			$user_photo_is_svg = false;
			if($user_photo_file_type == 'svg') :
				$user_photo_is_svg = true;
			endif;
		}
		// get rid of the author byline as a URL link if on author page
		if(!is_author()) :
			$byline = sprintf(
			/* translators: %s: post author. */
				esc_html_x('By %s', 'post author', 'billykulpa2022_'),
				'<span class="author"><a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author_meta('display_name')) . '</a></span>'
			);
		else :
			$byline = sprintf(
			/* translators: %s: post author. */
				esc_html_x('By %s', 'post author', 'billykulpa2022_'),
				'<span class="author">' . esc_html(get_the_author_meta('display_name')) . '</span>'
			);
		endif;
		$posted_on = sprintf(/* translators: %s: post date. */esc_html_x('%s', 'post date', 'billykulpa2022_'),''); ?>
		<div class="entry-meta">
			<span class="posted-on">
				<div class="user-image">
					<?php if($user_photo) : ?>
						<picture>
							<source srcset="<?php echo $user_photo_sizes['size_100_square']['webp']; ?>" type="image/webp">
							<source srcset="<?php echo $user_photo_sizes['size_100_square']['original']; ?>" type="image/<?php echo $user_photo_file_type; ?>">
							<img alt="<?php echo esc_html(get_the_author_meta('display_name')); ?>" height="45" loading="lazy" src="<?php echo $user_photo_url; ?>" width="45">
						</picture>
					<?php endif; ?>
				</div><!-- .user-image -->
				<span class="byline"><?php echo $byline; ?></span>
			</span>
		</div><!-- .entry-meta -->
	<?php }
endif;

if (! function_exists('billykulpa2022_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function billykulpa2022_entry_footer() {
		// Footer variables
		$original_post_url = get_field('original_post_url');

		// Hide category and tag text for pages.
		if ('post' === get_post_type()) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(esc_html__(', ', 'billykulpa2022_'));
			if ($categories_list) {
				/* translators: 1: list of categories. */
				printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'billykulpa2022_') . '</span>', $categories_list); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'billykulpa2022_'));
			if ($tags_list) {
				/* translators: 1: list of tags. */
				printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'billykulpa2022_') . '</span>', $tags_list); // WPCS: XSS OK.
			}
		}

		if (! is_single() && ! post_password_required() && (comments_open() || get_comments_number())) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'billykulpa2022_'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Edit <span class="screen-reader-text">%s</span>', 'billykulpa2022_'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;
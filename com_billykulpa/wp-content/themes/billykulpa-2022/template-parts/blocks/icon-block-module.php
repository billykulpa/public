<?php

/**
 * Icon Block Module Template.
 */

// vars
$icon_block = get_field('icon_block');
	if(have_rows('icon_block')) : while(have_rows('icon_block')) : the_row();
	// 'icon_block' vars
	$block_id = $icon_block['block_id'];
	$block_classes = $icon_block['block_classes'];
	$section_padding = $icon_block['section_padding'];
	$text_align_mobile = $icon_block['text_align_mobile'];
	$text_align_desktop = $icon_block['text_align_desktop'];
	$background_color = $icon_block['background_color'];
	$icon_size = $icon_block['icon_size'];
	$text_color = $icon_block['text_color'];
	$links_color = $icon_block['links_color'];
	$text_weight = $icon_block['text_weight'];
	$headline_weight = $icon_block['headline_weight'];
	$kicker = $icon_block['kicker'];
	$kicker_color = $icon_block['kicker_color'];
	$headline = $icon_block['headline'];
	$section_headline_underline = $icon_block['section_headline_underline'];
	if($section_headline_underline) :
		$section_headline_underline_style = $icon_block['section_headline_underline_style'];
	endif;
	$headline_hierarchy = $icon_block['headline_hierarchy'];
	$headline_hierarchy_appearance = $icon_block['headline_hierarchy_appearance'];
	$body = $icon_block['body'];
	$section_has_cta =  $icon_block['section_has_cta'];
	$section_ctas_justification = $icon_block['section_ctas_justification'];
	$section_ctas =  $icon_block['section_ctas'];
	$column_horizontal_justification = $icon_block['column_horizontal_justification'];
	$column_vertical_justification = $icon_block['column_vertical_justification'];
	$columns = $icon_block['columns'];
	$brand_pattern = $icon_block['brand_pattern'];
	$brand_pattern_shape_1 = $brand_pattern['brand_pattern_shape_1'];
	if($brand_pattern_shape_1) :
		$brand_pattern_shape_1_style = $brand_pattern['brand_pattern_shape_1_style'];
		$brand_pattern_shape_1_color = $brand_pattern['brand_pattern_shape_1_color'];
		$brand_pattern_shape_1_opacity = $brand_pattern['brand_pattern_shape_1_opacity'];
	endif;
	$brand_pattern_shape_2 = $brand_pattern['brand_pattern_shape_2'];
	if($brand_pattern_shape_2) :
		$brand_pattern_shape_2_style = $brand_pattern['brand_pattern_shape_2_style'];
		$brand_pattern_shape_2_color = $brand_pattern['brand_pattern_shape_2_color'];
		$brand_pattern_shape_2_opacity = $brand_pattern['brand_pattern_shape_2_opacity'];
	endif;
	$stripe_pattern_side = $icon_block['stripe_pattern_side'];
	// loop through the repeater ('columns') ?>
	<section class="icon-block-module <?php echo $text_align_mobile . ' ' . $text_align_desktop; if(!empty($columns)) : ?> has-icons<?php endif; if($background_color != 'bg-color-none') : echo ' ' . $background_color; endif; echo ' ' . $text_color . ' ' . $links_color; if($section_padding != 'default') : echo ' ' . $section_padding; endif; if($block_classes) : echo ' ' . $block_classes; endif; ?>"<?php if($block_id) : ?> id="<?php echo $block_id; ?>"<?php endif; ?>>
		<div class="content">
			<div class="container">
				<?php if($kicker || $headline || $body) : ?>
				<div class="section-content-container">
					<?php endif;
					if($kicker) : ?>
					<div class="kicker-container">
						<div class="kicker <?php echo $kicker_color; ?>"><?php echo $kicker; ?></div>
					</div><!-- .kicker-container -->
					<?php endif;
					if($headline) : ?>
						<div class="headline">
						<<?php echo $headline_hierarchy; ?> class="<?php echo $headline_hierarchy_appearance; if($section_headline_underline) : ?> has-underline<?php endif; ?>"><?php echo $headline; ?></<?php echo $headline_hierarchy; ?>>
						</div><!-- .headline -->
					<?php endif;
					if($body) : echo $body; endif;
					if($section_has_cta && !empty($section_ctas)) : ?>
					<div class="cta <?php echo $text_align_desktop . ' ' . $text_align_mobile . ' ' . $section_ctas_justification; ?>">
						<div class="btn-group">
						<?php foreach($section_ctas as $section_cta) :
							// vars
							$section_cta_disabled = $section_cta['section_cta_disabled'];
							$section_cta_text = $section_cta['section_cta_text'];
							$section_cta_color = $section_cta['section_cta_color'];
							$section_cta_size = $section_cta['section_cta_size'];
							$section_cta_title = $section_cta['section_cta_title'];
							$section_cta_target = $section_cta['section_cta_target'];
							$section_cta_url = $section_cta['section_cta_url']; ?>
							<a class="btn <?php echo $section_cta_size . ' ' . $section_cta_color; if($section_cta_disabled) : echo ' btn-disabled'; endif; ?>" <?php if(!$section_cta_disabled) : ?>href="<?php echo $section_cta_url; ?>" role="button" target="<?php if($section_cta_target) : echo $section_cta_target; else : echo '_self'; endif; ?>" title="<?php if($section_cta_title) : echo $section_cta_title; else : echo $section_cta_text; endif; ?>"<?php endif; ?>><?php echo $section_cta_text; ?></a>
						<?php endforeach; ?>
						</div><!-- .btn-group -->
					</div><!-- .cta -->
					<?php endif;
					if($kicker || $headline || $body) : ?>
				</div><!-- .section-content-container-->
			<?php endif;
			if(have_rows('columns')) : ?>
			<div class="icons-container">
				<div class="row <?php echo $column_horizontal_justification; ?>">
				<?php while(have_rows('columns')) : the_row();       
				// vars
				$content_type = get_sub_field('content_type');
				// width vars
				$responsive_column_widths = get_sub_field('responsive_column_widths');
				if($responsive_column_widths) :
					$column_width_xl = get_sub_field('column_width_xl');
					$column_width_lg = get_sub_field('column_width_lg');
					$column_width_md = get_sub_field('column_width_md');
					$column_width_sm = get_sub_field('column_width_sm');
					$column_width_xs = get_sub_field('column_width_xs');
					$column_widths = 'col ' . $column_width_xs . ' ' . $column_width_sm . ' ' . $column_width_md . ' ' . $column_width_lg . ' ' . $column_width_xl;
				else :
					$column_width_default = get_sub_field('column_width_default');
					$column_widths = 'col-12 ' . $column_width_default;
				endif;
				// position vars
				$column_order_position = get_sub_field('column_order_position');
				$column_order_trigger = get_sub_field('column_order_trigger');
				if($column_order_position == 'first') :
					$column_order_position_formatted = ' order-' . $column_order_trigger . '-first';
				elseif($column_order_position == 'last') :
					$column_order_position_formatted = ' order-' . $column_order_trigger . '-last';
				else :
					$column_order_position_formatted = '';
				endif;
				// content vars
				$column_text_align = get_sub_field('column_text_align');
				$column_text_align_mobile = get_sub_field('column_text_align_mobile');
				$column_kicker = get_sub_field('column_kicker');
				$column_kicker_color = get_sub_field('column_kicker_color');
				$column_headline = get_sub_field('column_headline');
				$column_headline_url = get_sub_field('column_headline_url');
				$column_headline_url_target = get_sub_field('column_headline_url_target');
				$column_headline_hierarchy = get_sub_field('column_headline_hierarchy');
				$column_headline_hierarchy_appearance = get_sub_field('column_headline_hierarchy_appearance');
				$column_body = get_sub_field('column_body');
				if(!empty($column_body)) :
					$replace_h1 = '<h1>';
					$replace_h2 = '<h2>';
					$replace_h3 = '<h3>';
					$replace_h4 = '<h4>';
					$replace_h5 = '<h5>';
					$replace_h6 = '<h6>';
					$replace_p = '<p>';
					$replace_li = '<li>';
					$column_body = str_replace('<h1>', $replace_h1, $column_body);
					$column_body = str_replace('<h2>', $replace_h2, $column_body);
					$column_body = str_replace('<h3>', $replace_h3, $column_body);
					$column_body = str_replace('<h4>', $replace_h4, $column_body);
					$column_body = str_replace('<h5>', $replace_h5, $column_body);
					$column_body = str_replace('<h6>', $replace_h6, $column_body);
					$column_body = str_replace('<p>', $replace_p, $column_body);
					$column_body = str_replace('<li>', $replace_li, $column_body);
				endif;
				$column_has_cta = get_sub_field('column_has_cta');
				$column_ctas = get_sub_field('column_ctas');
				$column_ctas_justification = get_sub_field('column_ctas_justification');
				$column_icon = get_sub_field('column_icon');
				if (!empty($column_icon)) {
					$column_icon_alt = $column_icon['alt'];
					$column_icon_name = $column_icon['name'];
					$column_icon_url = $column_icon['url'];
					$column_icon_sizes = $column_icon['sizes'];
					$column_icon_filename = $column_icon['filename'];
				}
				?>
				<div class="<?php echo $column_widths . $column_order_position_formatted; ?>">
					<div class="content-container <?php echo $column_vertical_justification . ' ' . $column_text_align . ' ' . $column_text_align_mobile; if($column_has_cta) : ?> has-cta<?php endif; ?>">
						<div class="content <?php echo $column_text_align . ' ' . $column_text_align_mobile . ' ' . $text_weight; ?>">
							<?php if($column_icon) : ?>
							<div class="icon <?php echo $icon_size; ?>">
								<?php echo file_get_contents(wp_get_upload_dir()['path'] . '/' . $column_icon_filename); ?>
							</div><!-- .icon -->
							<?php endif; ?>
							<?php if($column_kicker) : ?>
							<span class="kicker <?php echo $column_kicker_color; ?>"><?php echo $column_kicker; ?></span>
							<?php endif;
							if($column_headline) : ?>
							<<?php echo $column_headline_hierarchy; ?> class="<?php echo $column_headline_hierarchy_appearance . ' ' . $headline_weight; ?>"><?php if($column_headline_url) : ?><a href="<?php echo $column_headline_url; ?>" target="<?php echo $column_headline_url_target; ?>" title="<?php echo $column_headline; ?>"><?php endif; echo $column_headline; if($column_headline_url) : ?></a><?php endif; ?></<?php echo $column_headline_hierarchy; ?>>
							<?php endif;
							if($column_body) : echo $column_body; endif; ?>
						</div><!-- .content -->
						<?php if($column_has_cta && !empty($column_ctas)) : ?>
						<div class="cta <?php echo $column_text_align . ' ' . $column_text_align_mobile . ' ' . $column_ctas_justification; ?>">
							<div class="btn-group">
							<?php foreach($column_ctas as $column_cta) :
								// vars
								$column_cta_disabled = $column_cta['column_cta_disabled'];
								$column_cta_text = $column_cta['column_cta_text'];
								$column_cta_color = $column_cta['column_cta_color'];
								$column_cta_size = $column_cta['column_cta_size'];
								$column_cta_title = $column_cta['column_cta_title'];
								$column_cta_target = $column_cta['column_cta_target'];
								$column_cta_url = $column_cta['column_cta_url']; ?>
								<a class="btn <?php echo $column_cta_size . ' ' . $column_cta_color; if($column_cta_disabled) : echo ' btn-disabled'; endif; ?>" <?php if(!$column_cta_disabled) : ?>href="<?php echo $column_cta_url; ?>" role="button" target="<?php if($column_cta_target) : echo $column_cta_target; else : echo '_self'; endif; ?>" title="<?php if($column_cta_title) : echo $column_cta_title; else : echo $column_cta_text; endif; ?>"<?php endif; ?>><?php echo $column_cta_text; ?></a>
							<?php endforeach; ?>
							</div><!-- .btn-group -->
						</div><!-- .cta -->
						<?php endif; ?>
					</div><!-- .content-container -->
				</div><!-- .column-size -->
				<?php endwhile; ?>
				</div><!-- .row.justify-content-between -->
			</div><!-- .icons-container -->
		<?php endif; ?>
		</div><!-- .container -->
	</div><!-- .content -->
	<?php if($brand_pattern_shape_1 || $brand_pattern_shape_2) : ?>
	<div class="background-pattern">
		<?php if($brand_pattern_shape_1) : ?>
			<div class="background-pattern-shape-1 <?php echo $brand_pattern_shape_1_style; ?> opacity-<?php echo $brand_pattern_shape_1_opacity; ?>">
				<?php if($brand_pattern_shape_1_style == 'style-1') : ?>
					<svg class="style-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 484.53 400" preserveAspectRatio="xMaxYMax slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_1_color; ?>" points="0 400 484.53 400 253.59 0 0 0 0 400"/>	
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_1_style == 'style-2') : ?>
					<svg class="style-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 470 1080" preserveAspectRatio="xMinYMid slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_1_color; ?>" points="190.33 0 0 1079.41 470 1080 470 0 190.33 0"/>
						</g>
					</svg> 
				<?php endif;
				if($brand_pattern_shape_1_style == 'style-3') : ?>
					<svg class="style-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 476.7 400" preserveAspectRatio="xMinYMid slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_1_color; ?>" points="476.7 400 476.7 0 0 0 476.7 400"/>
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_1_style == 'style-4') : ?>
					<svg class="style-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 400" preserveAspectRatio="xMinYMin slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_1_color; ?>" points="230.94 0 230.94 0 0 400 230.94 400 461.88 400 600 400 600 0 230.94 0"/>
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_1_style == 'style-5') : ?>
					<svg class="style-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 850 400" preserveAspectRatio="xMidYMax slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_1_color; ?>" points="850 350.91 0 170.24 0 400 850 400 850 350.91"/>
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_1_style == 'style-6') : ?>
					<svg class="style-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 850 266.2" preserveAspectRatio="xMidYMax slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_1_color; ?>" points="0 141.53 0 266.2 580.49 266.2 0 141.53"/>
						</g>
					</svg>
				<?php endif; ?>
			</div><!-- .background-pattern-shape-1 -->
		<?php endif;
		if($brand_pattern_shape_2) : ?>
			<div class="background-pattern-shape-2 <?php echo $brand_pattern_shape_2_style; ?> opacity-<?php echo $brand_pattern_shape_2_opacity; ?>">
				<?php if($brand_pattern_shape_2_style == 'style-1') : ?>
					<svg class="style-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 484.53 400" preserveAspectRatio="xMaxYMax slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_2_color; ?>" points="0 0 0 400 383.56 400 253.59 0 0 0"/>
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_2_style == 'style-2') : ?>
					<svg class="style-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 970 1080" preserveAspectRatio="xMinYMid slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_2_color; ?>" points="970 0 0 1080 970 1080 970 0"/>
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_2_style == 'style-3') : ?>
					<svg class="style-3"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 476.7 400" preserveAspectRatio="xMinYMid slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_2_color; ?>" points="245.76 0 476.7 400 476.7 0 245.76 0"/>
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_2_style == 'style-4') : ?>
					<svg class="style-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 400" preserveAspectRatio="xMinYMin slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_2_color; ?>" points="230.94 0 0 400 461.88 400 230.94 0"/>
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_2_style == 'style-5') : ?>
					<svg class="style-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 850 400" preserveAspectRatio="xMidYMax slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_2_color; ?>" points="619.06 400 850 400 850 0 619.06 400"/>
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_2_style == 'style-6') : ?>
					<svg class="style-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 850 266.2" preserveAspectRatio="xMidYMax slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_2_color; ?>" points="850 0 118.61 266.2 850 266.2 850 0"/>
						</g>
					</svg>
				<?php endif; ?>
			</div><!-- .background-pattern-shape-2 -->
		<?php endif; ?>
	</div><!-- .background-pattern -->
	<?php endif;
	if($stripe_pattern_side != 'stripe-side-none') : ?>
		<div class="stripe-pattern <?php echo $stripe_pattern_side; ?>"></div><!-- .stripe-pattern -->
	<?php endif; ?>
</section><!-- .content-block-module -->
<?php endwhile; endif; ?>
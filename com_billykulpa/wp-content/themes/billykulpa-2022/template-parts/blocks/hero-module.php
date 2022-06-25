<?php
// general vars
$uploads_path = '/wp-content/uploads/';
$uploads_path_webp = '/wp-content/webp-express/webp-images/uploads/';
// acf vars
$hero = get_field('hero');
$hero_style = $hero['hero_style'];
$background_color = $hero['background_color'];
$headline = $hero['headline'];
$headline_hierarchy = $hero['headline_hierarchy'];
// hero major, hero video
if($hero_style == 'hero-video' || $hero_style == 'hero-major') :
	$hero_kicker = $hero['kicker'];
	$hero_kicker_color = $hero['kicker_color'];
	$hero_kicker_icon = $hero['kicker_icon']; // file type limited to SVG
	if(!empty($hero_kicker_icon)) :
		$hero_kicker_icon_alt = $hero_kicker_icon['alt'];
		$hero_kicker_icon_filename = $hero_kicker_icon['filename'];
		$hero_kicker_icon_url = $hero_kicker_icon['url'];
		$hero_kicker_icon_height = $hero_kicker_icon['height'];
		$hero_kicker_icon_width = $hero_kicker_icon['width'];
	endif;
endif;
if($hero_style == 'hero-video' || $hero_style == 'hero-major' || $hero_style == 'hero-interior-large') :
	$body = $hero['body'];
	if(!empty($body)) :
		$replace = '<p>';
		$body = str_replace('<p>', $replace, $body);
	endif;
	$ctas =  $hero['ctas'];
	$subheadline = $hero['subheadline'];
	$subheadline_hierarchy = $hero['subheadline_hierarchy'];
endif;
// hero video
if($hero_style == 'hero-video') :
	$vimeo_id = $hero['vimeo_id'];
endif;
// hero major, hero interior large, hero interior small
if($hero_style == 'hero-major' || $hero_style == 'hero-interior-large' || $hero_style == 'hero-interior-small') :
	$background_image = $hero['background_image'];
	if(!empty($background_image)) : 
		// image vars
		$image_alt = $background_image['alt'];
		$image_name = $background_image['name'];
		$image_url = $background_image['url'];
		$image_height = $background_image['height'];
		$image_width = $background_image['width'];
		$image_filename = $background_image['filename'];
		$image_sizes = imageSizes($background_image['sizes']);
		if(strpos($image_filename, '-scaled.') !== false) {
			$image_scaled_check = true;
			$image_filename = str_replace('-scaled', '', $image_filename);
		}
		$image_file_type_array = pathinfo($image_filename);
			$image_file_type = $image_file_type_array['extension'];
		// check if image is an SVG
		$image_is_svg = false;
		if($image_file_type == 'svg') :
			$image_is_svg = true;
		endif;
	endif;
endif;
?>
<section class="hero <?php echo $hero_style; ?> <?php echo $background_color; ?>" id="">
	<div class="container">
		<?php
		// hero major, hero interior large, hero interior small
		if($hero_style == 'hero-major' || $hero_style == 'hero-interior-large' || $hero_style == 'hero-interior-small') : ?>
			<div class="background-image">
				<picture>
					<source srcset="<?php echo $image_sizes['size_1300']['webp']; ?>" media="(min-width: 1600px)" type="image/webp">
					<source srcset="<?php echo $image_sizes['size_1200']['webp']; ?>" media="(min-width: 1400px)" type="image/webp">
					<source srcset="<?php echo $image_sizes['size_900']['webp']; ?>" media="(min-width: 1200px)" type="image/webp">
					<source srcset="<?php echo $image_sizes['size_800']['webp']; ?>" media="(min-width: 992px)" type="image/webp">
					<source srcset="<?php echo $image_sizes['size_700']['webp']; ?>" media="(min-width: 768px)" type="image/webp">
					<source srcset="<?php echo $image_sizes['size_600']['webp']; ?>" media="(max-width: 767px)" type="image/webp">
					<source srcset="<?php echo $image_sizes['size_1300']['original']; ?>" media="(min-width: 1600px)" type="image/<?php echo $image_file_type; ?>">
					<source srcset="<?php echo $image_sizes['size_1200']['original']; ?>" media="(min-width: 1400px)" type="image/<?php echo $image_file_type; ?>">
					<source srcset="<?php echo $image_sizes['size_900']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
					<source srcset="<?php echo $image_sizes['size_800']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
					<source srcset="<?php echo $image_sizes['size_700']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $image_file_type; ?>">
					<source srcset="<?php echo $image_sizes['size_600']['original']; ?>" media="(max-width: 767px)" type="image/<?php echo $image_file_type; ?>">
                    <?php switch ($hero_style) :
                        case 'hero-major' :
                            $rendered_width = '952';
                            $rendered_height = '496';
                        break;
                        case 'hero-interior-large' :
                            $rendered_width = '1131';
                            $rendered_height = '328';
                        break;
                        case 'hero-interior-small' :
                            $rendered_width = '1131';
                            $rendered_height = '216';
                        break;
                    endswitch; ?>
					<img alt="<?php if($image_alt) : echo $image_alt; else : echo get_the_title(); endif; ?>" height="<?php echo $rendered_height; ?>" src="<?php echo $image_url; ?>" width="<?php echo $rendered_width; ?>" />
				</picture>
			</div><!-- .background-image -->
		<?php endif;
		// hero video
		if($hero_style == 'hero-video' && !empty($vimeo_id)) : ?>
			<div class="hero-video-container">
		<?php endif;
		// all heros ?>
		<div class="content-container">
			<div class="content">
				<?php if(is_singular('connector') && has_post_thumbnail()) : ?>
					<div class="connector-logo">
						<?php if(!$thumbnail_is_svg) : ?>
						<picture>
							<source srcset="<?php echo $thumbnail_image_sizes['size_300']['webp']; ?>" type="image/webp">
							<source srcset="<?php echo $thumbnail_image_sizes['size_300']['original']; ?>" type="image/<?php echo $thumbnail_file_type; ?>">
							<img loading="lazy" alt="<?php if($thumbnail_alt) : echo $thumbnail_alt; else : echo $title; endif; ?>" height="300" src="<?php echo $thumbnail_image; ?>" width="300">
						</picture>
						<?php else : ?>
							<img loading="lazy" alt="<?php if($thumbnail_alt) : echo $thumbnail_alt; else : echo $title; endif; ?>" height="300" src="<?php echo $thumbnail_image; ?>" width="300">
						<?php endif; ?>
					</div><!-- .connector-logo -->
				<?php endif; ?>
				<?php if(!empty($hero_kicker)) : ?>
					<div class="kicker-container<?php if(!empty($hero_kicker_icon)) : ?> has-icon<?php endif; ?>">
						<?php if(!empty($hero_kicker_icon)) : ?>
							<div class="kicker-icon">
								<img alt="<?php if(!empty($hero_kicker_icon_alt)) : echo $hero_kicker_icon_alt; else : echo 'An icon for ' . $hero_kicker; endif; ?>" height="64" src="<?php echo $hero_kicker_icon_url; ?>" width="64" />
							</div><!-- .kicker-icon -->
						<?php endif; ?>
						<div class="kicker <?php echo $hero_kicker_color; ?>">
							<?php echo $hero_kicker; ?>
						</div><!-- .kicker -->
					</div><!-- .kicker-container -->
				<?php endif; ?>
				<div class="headline"><<?php echo $headline_hierarchy; ?>><?php if(!empty($headline)) : echo $headline; else : echo get_the_title(); endif; ?></<?php echo $headline_hierarchy; ?>></div><!-- .headline -->
				<?php if(!empty($subheadline)) : ?>
					<div class="subheadline"><<?php echo $subheadline_hierarchy; ?>><?php echo $subheadline; ?></<?php echo $subheadline_hierarchy; ?>></div><!-- .subheadline -->
				<?php endif;
				if(!empty($body)) : ?>
					<div class="body"><?php echo $body; ?></div>
				<?php endif;
				if(!empty($ctas)) : ?>
					<div class="ctas">
						<div class="btn-group">
						<?php foreach($ctas as $cta) :
							// vars
							$cta_disabled = $cta['cta_disabled'];
							$cta_text = $cta['cta_text'];
							$cta_color = $cta['cta_color'];
							$cta_size = $cta['cta_size'];
							$cta_title = $cta['cta_title'];
							$cta_target = $cta['cta_target'];
							$cta_url = $cta['cta_url']; ?>
							<a class="btn <?php echo $cta_size . ' ' . $cta_color; if($cta_disabled) : echo ' btn-disabled'; endif; ?>" <?php if(!$cta_disabled) : ?>href="<?php echo $cta_url; ?>" role="button" target="<?php if($cta_target) : echo $cta_target; else : echo '_self'; endif; ?>" title="<?php if($cta_title) : echo $cta_title; else : echo $cta_text; endif; ?>"<?php endif; ?>><?php echo $cta_text; ?></a>
						<?php endforeach; ?>
						</div><!-- .btn-group -->
					</div><!-- .cta -->
				<?php endif; ?>
			</div><!-- .content -->
			<?php if($hero_style == 'hero-industry' && !empty($industry_icon)) : ?>
				<div class="industry-icon-container shadow-soft">
					<div class="industry-icon">
						<img alt="<?php if(!empty($industry_icon_alt)) : echo $industry_icon_alt; else : echo 'An icon for ' . get_the_title(); endif; ?>" height="88" src="<?php echo $industry_icon_url; ?>" width="88" />
					</div><!-- .kicker-icon -->
					<div class="industry-text">
						<h3><?php if(!empty($industry_label)) : echo $industry_label; else : echo get_the_title(); endif; ?></h3>
					</div>
				</div><!-- .industry-icon-container -->
			<?php endif; ?>
		</div><!-- .content-container -->
		<?php if($hero_style == 'hero-video' && !empty($vimeo_id)) : ?>
			<div class="video-wrapper-outer">
				<div class="video-wrapper">
					<iframe allow="autoplay; fullscreen; picture-in-picture" allowfullscreen frameborder="0" src="https://player.vimeo.com/video/<?php echo $vimeo_id; ?>?h=00941bf856&title=0&byline=0&portrait=0"></iframe>
				</div><!-- .video-wrapper -->
			</div><!-- .video-wrapper-outer -->
			<script src="https://player.vimeo.com/api/player.js"></script>
		</div><!-- .hero-video-container -->
		<?php endif; ?>
	</div><!-- .container -->
	<?php if($hero_style == 'hero-major' || $hero_style == 'hero-interior-large' || $hero_style == 'hero-industry') : ?>
		<div class="stripe-pattern"></div><!-- .stripe-pattern -->
	<?php endif; ?>
</section>
<?php
// general vars
$uploads_path = '/wp-content/uploads/';
$uploads_path_webp = '/wp-content/webp-express/webp-images/uploads/';
// acf vars
$hero_home = get_field('hero_home');
$headline = $hero_home['headline'];
$subheadline = $hero_home['subheadline'];
$headline_hierarchy = $hero_home['headline_hierarchy'];
$subheadline_hierarchy = $hero_home['subheadline_hierarchy'];
$ctas =  $hero_home['ctas'];
$background_image = $hero_home['background_image'];
if(!empty($background_image)) : 
	// image vars
	$image_alt = $background_image['alt'];
	$image_name = $background_image['name'];
	$image_url = $background_image['url'];
	$image_height = $background_image['height'];
	$image_width = $background_image['width'];
	$image_filename = $background_image['filename'];
	$image_sizes = $background_image['sizes'];
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
	// 1920
	if($image_sizes['size_1920']) :
		$image_size_1920 = $image_sizes['size_1920'];
		$image_size_1920_height = $image_sizes['size_1920-height'];
		$image_size_1920_width = $image_sizes['size_1920-width'];
		// webp
		$image_size_1920_webp = $uploads_path_webp . pathinfo($image_size_1920, PATHINFO_FILENAME) . '.' . $image_file_type . '.webp';
	endif;
	// 1600
	if($image_sizes['size_1600']) :
		$image_size_1600 = $image_sizes['size_1600'];
		$image_size_1600_height = $image_sizes['size_1600-height'];
		$image_size_1600_width = $image_sizes['size_1600-width'];
		// webp
		$image_size_1600_webp = $uploads_path_webp . pathinfo($image_size_1600, PATHINFO_FILENAME) . '.' . $image_file_type . '.webp';
	endif;
	// 1500
	if($image_sizes['size_1500']) :
		$image_size_1500 = $image_sizes['size_1500'];
		$image_size_1500_height = $image_sizes['size_1500-height'];
		$image_size_1500_width = $image_sizes['size_1500-width'];
		// webp
		$image_size_1500_webp = $uploads_path_webp . pathinfo($image_size_1500, PATHINFO_FILENAME) . '.' . $image_file_type . '.webp';
	endif;
	// 1400
	if($image_sizes['size_1400']) :
		$image_size_1400 = $image_sizes['size_1400'];
		$image_size_1400_height = $image_sizes['size_1400-height'];
		$image_size_1400_width = $image_sizes['size_1400-width'];
		// webp
		$image_size_1400_webp = $uploads_path_webp . pathinfo($image_size_1400, PATHINFO_FILENAME) . '.' . $image_file_type . '.webp';
	endif;
	// 1300
	if($image_sizes['size_1300']) :
		$image_size_1300 = $image_sizes['size_1300'];
		$image_size_1300_height = $image_sizes['size_1300-height'];
		$image_size_1300_width = $image_sizes['size_1300-width'];
		// webp
		$image_size_1300_webp = $uploads_path_webp . pathinfo($image_size_1300, PATHINFO_FILENAME) . '.' . $image_file_type . '.webp';
	endif;
	// 1200
	if($image_sizes['size_1200']) :
		$image_size_1200 = $image_sizes['size_1200'];
		$image_size_1200_height = $image_sizes['size_1200-height'];
		$image_size_1200_width = $image_sizes['size_1200-width'];
		// webp
		$image_size_1200_webp = $uploads_path_webp . pathinfo($image_size_1200, PATHINFO_FILENAME) . '.' . $image_file_type . '.webp';
	endif;
	// 1100
	if($image_sizes['size_1100']) :
		$image_size_1100 = $image_sizes['size_1100'];
		$image_size_1100_height = $image_sizes['size_1100-height'];
		$image_size_1100_width = $image_sizes['size_1100-width'];
		// webp
		$image_size_1100_webp = $uploads_path_webp . pathinfo($image_size_1100, PATHINFO_FILENAME) . '.' . $image_file_type . '.webp';
	endif;
	// 1000
	if($image_sizes['size_1000']) :
		$image_size_1000 = $image_sizes['size_1000'];
		$image_size_1000_height = $image_sizes['size_1000-height'];
		$image_size_1000_width = $image_sizes['size_1000-width'];
		// webp
		$image_size_1000_webp = $uploads_path_webp . pathinfo($image_size_1000, PATHINFO_FILENAME) . '.' . $image_file_type . '.webp';
	endif;
	// 900
	if($image_sizes['size_900']) :
		$image_size_900 = $image_sizes['size_900'];
		$image_size_900_height = $image_sizes['size_900-height'];
		$image_size_900_width = $image_sizes['size_900-width'];
		// webp
		$image_size_900_webp = $uploads_path_webp . pathinfo($image_size_900, PATHINFO_FILENAME) . '.' . $image_file_type . '.webp';
	endif;
	// 800
	if($image_sizes['size_800']) :
		$image_size_800 = $image_sizes['size_800'];
		$image_size_800_height = $image_sizes['size_800-height'];
		$image_size_800_width = $image_sizes['size_800-width'];
		// webp
		$image_size_800_webp = $uploads_path_webp . pathinfo($image_size_800, PATHINFO_FILENAME) . '.' . $image_file_type . '.webp';
	endif;
	// 700
	if($image_sizes['size_700']) :
		$image_size_700 = $image_sizes['size_700'];
		$image_size_700_height = $image_sizes['size_700-height'];
		$image_size_700_width = $image_sizes['size_700-width'];
		// webp
		$image_size_700_webp = $uploads_path_webp . pathinfo($image_size_700, PATHINFO_FILENAME) . '.' . $image_file_type . '.webp';
	endif;
	// 600
	if($image_sizes['size_600']) :
		$image_size_600 = $image_sizes['size_600'];
		$image_size_600_height = $image_sizes['size_600-height'];
		$image_size_600_width = $image_sizes['size_600-width'];
		// webp
		$image_size_600_webp = $uploads_path_webp . pathinfo($image_size_600, PATHINFO_FILENAME) . '.' . $image_file_type . '.webp';
	endif;
	// 500
	if($image_sizes['size_500']) :
		$image_size_500 = $image_sizes['size_500'];
		$image_size_500_height = $image_sizes['size_500-height'];
		$image_size_500_width = $image_sizes['size_500-width'];
		// webp
		$image_size_500_webp = $uploads_path_webp . pathinfo($image_size_500, PATHINFO_FILENAME) . '.' . $image_file_type . '.webp';
	endif;
	// 400
	if($image_sizes['size_400']) :
		$image_size_400 = $image_sizes['size_400'];
		$image_size_400_height = $image_sizes['size_400-height'];
		$image_size_400_width = $image_sizes['size_400-width'];
		// webp
		$image_size_400_webp = $uploads_path_webp . pathinfo($image_size_400, PATHINFO_FILENAME) . '.' . $image_file_type . '.webp';
	endif;
	// 300
	if($image_sizes['size_300']) :
		$image_size_300 = $image_sizes['size_300'];
		$image_size_300_height = $image_sizes['size_300-height'];
		$image_size_300_width = $image_sizes['size_300-width'];
		// webp
		$image_size_300_webp = $uploads_path_webp . pathinfo($image_size_300, PATHINFO_FILENAME) . '.' . $image_file_type . '.webp';
	endif;
	// 200
	if($image_sizes['size_200']) :
		$image_size_200 = $image_sizes['size_200'];
		$image_size_200_height = $image_sizes['size_200-height'];
		$image_size_200_width = $image_sizes['size_200-width'];
		// webp
		$image_size_200_webp = $uploads_path_webp . pathinfo($image_size_200, PATHINFO_FILENAME) . '.' . $image_file_type . '.webp';
	endif;
endif;

?>
<section class="hero-home" id="">
	<div class="content-container">
		<div class="container">
			<?php if(!empty($headline) || !empty($subheadline) || !empty($ctas)) : ?>
				<div class="content">
					<?php if(!empty($headline)) : ?>
					   	<<?php echo $headline_hierarchy; ?> class="headline"><?php echo $headline; ?></<?php echo $headline_hierarchy; ?>>
					<?php endif;
					if(!empty($subheadline)) : ?>
						<<?php echo $subheadline_hierarchy; ?> class="subheadline"><?php echo $subheadline; ?></<?php echo $subheadline_hierarchy; ?>>
					<?php endif;
					if(!empty($ctas)) : ?>
					<div class="cta">
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
			<?php endif; ?>
		</div><!-- .container -->
	</div><!-- .content-container -->
	<div class="hero-image-container">
		<div class="container">
			<div class="hero-image">
				<picture>
					<?php if($image_size_1920_webp) : ?>
						<source srcset="<?php echo $image_size_1920_webp; ?>" media="(min-width: 1400px)" type="image/webp">
					<?php endif;
					if($image_size_1600_webp) : ?>
						<source srcset="<?php echo $image_size_1400_webp; ?>" media="(min-width: 1300px)" type="image/webp">
					<?php endif;
					if($image_size_1400_webp) : ?>
						<source srcset="<?php echo $image_size_1300_webp; ?>" media="(min-width: 1200px)" type="image/webp">
					<?php endif;
					if($image_size_1300_webp) : ?>
						<source srcset="<?php echo $image_size_1200_webp; ?>" media="(min-width: 992px)" type="image/webp">
					<?php endif;
					if($image_size_1200_webp) : ?>
						<source srcset="<?php echo $image_size_800_webp; ?>" media="(min-width: 768px)" type="image/webp">
					<?php endif;
					if($image_size_800_webp) : ?>
						<source srcset="<?php echo $image_size_600_webp; ?>" media="(min-width: 576px)" type="image/webp">
					<?php endif;
					if($image_size_700_webp) : ?>
						<source srcset="<?php echo $image_size_500_webp; ?>" media="(max-width: 575px)" type="image/webp">
					<?php endif; ?>
					<source srcset="<?php echo $image_size_1920; ?>" media="(min-width: 1400px)" type="image/<?php echo $image_file_type; ?>">
					<source srcset="<?php echo $image_size_1400; ?>" media="(min-width: 1300px)" type="image/<?php echo $image_file_type; ?>">
					<source srcset="<?php echo $image_size_1300; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
					<source srcset="<?php echo $image_size_1200; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
					<source srcset="<?php echo $image_size_800; ?>" media="(min-width: 768px)" type="image/<?php echo $image_file_type; ?>">
					<source srcset="<?php echo $image_size_600; ?>" media="(min-width: 576px)" type="image/<?php echo $image_file_type; ?>">
					<source srcset="<?php echo $image_size_500; ?>" media="(max-width: 575px)" type="image/<?php echo $image_file_type; ?>">
					<img<?php if($image_alt) : ?> alt="<?php echo $image_alt; ?>"<?php endif; ?> height="100%" src="<?php echo $image_url; ?>" width="100%">
				</picture>
				<div class="content-tint"></div><!-- .content-tint -->
				<div class="background-tint"></div><!-- .background-tint -->
				<div class="background-patterns">
					<img alt="A background pattern for Adeptia" class="pattern pattern-1 blend-overlay" src="/wp-content/uploads/hero-home-bg-pattern-1.svg" />
					<img alt="A background pattern for Adeptia" class="pattern pattern-2 blend-overlay" src="/wp-content/uploads/hero-home-bg-pattern-2.svg" />
					<img alt="A background pattern for Adeptia" class="pattern pattern-3" src="/wp-content/uploads/hero-home-bg-pattern-3.svg" />
					<img alt="A background pattern for Adeptia" class="pattern pattern-4 blend-overlay" src="/wp-content/uploads/hero-home-bg-pattern-4.svg" />
				</div><!-- .background-patterns -->
			</div><!-- .container -->
		</div><!-- .hero-image -->
	</div><!-- .hero-image-container -->
</section>
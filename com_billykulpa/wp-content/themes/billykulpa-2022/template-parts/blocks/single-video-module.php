<?php
// general vars
$uploads_path = '/wp-content/uploads/';
$uploads_path_webp = '/wp-content/webp-express/webp-images/uploads/';
// acf vars
$video_block = get_field('video_block');
	$block_classes = $video_block['block_classes'];
	$block_id = $video_block['block_id'];
	$padding_top = $video_block['padding_top'];
	$padding_bottom = $video_block['padding_bottom'];
	$background_color = $video_block['background_color'];
	$text_align_mobile = $video_block['text_align_mobile'];
	$text_align_desktop = $video_block['text_align_desktop'];
	$headline = $video_block['headline'];
	$body = $video_block['body'];
	$has_cta = $video_block['has_cta'];
	if(!empty($has_cta)) :
		$ctas = $video_block['ctas'];
	endif;
	$vimeo_video_id = $video_block['vimeo_video_id'];
	$aspect_ratio = $video_block['aspect_ratio'];
?>

<section class="single-video-section<?php if($padding_bottom != 'default') : echo ' ' . $padding_bottom; endif; if($padding_top != 'default') : echo ' ' . $padding_top; endif; echo ' ' . $background_color . ' ' . $text_align_mobile . ' ' . $text_align_desktop; if(!empty($block_classes)) : echo ' ' . $block_classes; endif; ?>"<?php if(!empty($block_id)) : ?> id="<?php echo $block_id; ?>"<?php endif; ?>>
	<div class="container">
		<div class="content<?php if(empty($headline) && empty($body) && empty($ctas)) : ?> video-only<?php endif; ?>">
			<?php if(!empty($headline)) : ?>
				<div class="headline">
					<h3><?php echo $headline; ?></h3>
				</div><!-- .headline -->
			<?php endif;
			if(!empty($body)) : ?>
				<div class="body">
					<?php echo $body; ?>
				</div><!-- .body -->
			<?php endif;
			if(!empty($has_cta) && !empty($ctas)) : ?>
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
			<?php endif; 
			if(!empty($vimeo_video_id)) : ?>
				<div class="video-wrapper-outer">
					<div class="video-wrapper<?php if($aspect_ratio == 'standard') : ?> standard<?php endif; ?>">
						<iframe allow="autoplay; fullscreen; picture-in-picture" allowfullscreen frameborder="0" src="https://player.vimeo.com/video/<?php echo $vimeo_video_id; ?>?h=00941bf856&title=0&byline=0&portrait=0"></iframe>
					</div><!-- .video-wrapper -->
				</div><!-- .video-wrapper-outer -->
				<script src="https://player.vimeo.com/api/player.js"></script>
			<?php endif; ?>
		</div><!-- .content -->
	</div><!-- .container -->
	<?php if($stripe_pattern_side != 'stripe-side-none') : ?>
		<div class="stripe-pattern <?php echo $stripe_pattern_side; ?>"></div><!-- .stripe-pattern -->
	<?php endif; ?>
</section>
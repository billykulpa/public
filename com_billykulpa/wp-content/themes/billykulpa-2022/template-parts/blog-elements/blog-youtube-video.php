<?php
// general vars
$uploads_path = '/wp-content/uploads/';
$uploads_path_webp = '/wp-content/webp-express/webp-images/uploads/';
// acf vars
$youtube_video = get_field('youtube_video');
$youtube_video_id = $youtube_video['vimeo_video_id'];
$aspect_ratio = $youtube_video['aspect_ratio'];
?>
<?php if(!empty($youtube_video_id)) : ?>
<div class="youtube-video">
	<div class="video-wrapper-outer">
		<div class="video-wrapper<?php if($aspect_ratio == 'standard') : ?> standard<?php elseif($aspect_ratio == 'classic-adeptia') : ?> classic-adeptia<?php endif; ?>">
				<iframe width="" height="" src="https://www.youtube.com/embed/<?php echo $youtube_video_id; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div><!-- .video-wrapper -->
	</div><!-- .video-wrapper-outer -->
</div><!-- .content -->
<?php endif; ?>
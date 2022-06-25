<?php
// acf vars
$contact_section = get_field('contact_section');
if(have_rows('contact_section')) : while(have_rows('contact_section')) : the_row();
	$section_id = $contact_section['section_id'];
	$section_classes = $contact_section['section_classes'];
	$section_padding = $contact_section['section_padding'];
	$section_background_color = $contact_section['section_background_color'];
	$section_headline = $contact_section['section_headline'];
	$section_headline_hierarchy = $contact_section['section_headline_hierarchy'];
	$section_headline_hierarchy_appearance = $contact_section['section_headline_hierarchy_appearance'];
	$section_content = $contact_section['section_content'];
	$columns = $contact_section['columns'];
?>

<section class="contact-section<?php if(!empty($section_classes)) : echo ' ' . $section_classes; endif; if($section_padding != 'default') : echo ' ' . $section_padding; endif; if($section_background_color != 'bg-color-none') : echo ' ' . $section_background_color;  endif;?>"<?php if(!empty($section_id)) : ?> id="<?php echo $section_id; ?>"<?php endif; ?>>
	<div class="container">
		<div class="content-wrapper">
			<?php if($section_headline || $section_content) : ?>
			<div class="section-content">
				<?php if($section_headline) : ?><<?php echo $section_headline_hierarchy; ?> class="<?php echo $section_headline_hierarchy_appearance; ?> headline-underline mb-4"><?php echo $section_headline; ?></<?php echo $section_headline_hierarchy; ?>><?php endif; ?>
				<?php if($section_content) : echo $section_content; endif; ?>
			</div><!-- .section-content -->
			<?php endif;
			if(have_rows('columns')) : ?>
			<div class="row justify-content-start">
				<?php while(have_rows('columns')) : the_row();
				// vars
				$headline_or_logo = get_sub_field('headline_or_logo');
				$headline = get_sub_field('headline');
				$logo = get_sub_field('logo');
				$body = get_sub_field('body'); ?>
				<div class="col-lg">
					<div class="content">
						<?php if($headline_or_logo == 'headline' && !empty($headline)) : ?><h3 class="kicker"><?php echo $headline; ?></h3><?php elseif($headline_or_logo == 'logo') : ?><div class="logo" id="logo-<?php echo $logo; ?>"><?php if($logo == 'fma') : get_template_part('template-parts/parts/partner-logos/logo-fma'); elseif($logo == 'ccai') : get_template_part('template-parts/parts/partner-logos/logo-ccai'); elseif($logo == 'sme') : get_template_part('template-parts/parts/partner-logos/logo-sme'); elseif($logo == 'aws') : get_template_part('template-parts/parts/partner-logos/logo-aws'); elseif($logo == 'pma') : get_template_part('template-parts/parts/partner-logos/logo-pma');endif; ?></div><!-- .logo --><?php endif;
						if($body) : echo $body; endif; ?>
					</div><!-- .content -->
				</div><!-- .col -->
				<?php endwhile; ?>
			</div><!-- .row.justify-content-start -->
			<?php endif; ?>
		</div><!-- .content-wrapper -->
	</div><!-- .container -->
	<?php get_template_part('template-parts/blocks/background-pattern'); ?>
</section>
<?php endwhile; endif; ?>
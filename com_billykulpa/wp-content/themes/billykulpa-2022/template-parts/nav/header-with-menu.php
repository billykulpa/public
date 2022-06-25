<?php
// page vars
$page = get_field('page');
$minimal_header = $page['minimal_header'];
//$hide_footer = get_field('hide_footer');
?>
<header class="the-header">
	<div class="container">
		<div class="content-wrapper">
			<div class="nav-left-wrapper">
				<div class="logo-wrapper">
					<a class="nav-logo" href="<?php echo home_url(); ?>" target="_self" title="Back to home"><img alt="The logo of billykulpa.com" height="29.98" src="/wp-content/uploads/logo-billy-kulpa.svg" width="176" /></a>
				</div><!-- .logo-wrapper -->
			</div><!-- .nav-left-wrapper -->
			<?php if(empty($minimal_header)) : ?>
				<div class="nav-right-wrapper">
					<div class="navigation-wrapper">
						<div class="menu-wrapper">
							<?php if(has_nav_menu('primary')) : get_template_part('template-parts/nav/menu-primary-nav'); endif; ?>
						</div><!-- .menu-wrapper -->
						<?php // get_template_part('template-parts/nav/nav-ctas'); ?>
						<?php if(!is_search()) : ?>
							<div class="nav-search-wrapper">
								<img alt="A search icon" height="24" src="/wp-content/uploads/icon_nav-search.svg" width="24" />
							</div><!-- .nav-search-wrapper -->
						<?php endif; ?>
						<div id="nav-hamburger">
							<div id="hamburger">
								<div class="bar-1"></div>
								<div class="bar-2"></div>
								<div class="bar-3"></div>
							</div><!-- #hamburger -->
						</div><!-- #nav-hamburger -->
					</div><!-- .navigation-wrapper -->
				</div><!-- .nav-right-wrapper -->
			<?php endif; ?>
		</div><!-- .content-wrapper -->
	</div><!-- .container -->
	<?php if(empty($minimal_header)) : get_template_part('template-parts/nav/searchform-nav'); endif; ?>
	<div id="slideout-menu-overlay"></div>
</header>
<?php if(!is_front_page()) : get_template_part('template-parts/parts/breadcrumbs'); endif; ?>
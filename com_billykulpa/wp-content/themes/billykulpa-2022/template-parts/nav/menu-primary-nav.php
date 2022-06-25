<?php
	// page vars
	$hide_header = get_field('hide_header');
	$hide_footer = get_field('hide_footer');
	$menu_items = get_primary_menu_items();
?>
<nav id="slideout-menu">
	<div class="mobile-logo">
		<a href="<?php echo home_url(); ?>" target="_self" title="Back to home"><img alt="The logo of billykulpa.com" height="29.98" src="/wp-content/uploads/logo-billy-kulpa.svg" width="176" /></a>
	</div><!-- .mobile-logo -->
	<?php if(has_nav_menu('primary')) :
		wp_nav_menu( array(
			// after'				=>	'</div>',
			// 'before'			=>	'<div class="nav-item">',
			'container'			=>	false,
			'depth'				=>	3,
			// 'items_wrap'		=>	'<ul id="%1$s" class="%2$s" aria-expanded="false">%3$s</ul>',
			// 'link_after'		=>	'</span>',
			// link_before'		=>	'<span>',
			'menu_class'		=>	'navigation-list',
			// 'menu_id'			=>	'',
			'theme_location'	=>	'primary'
		) );
	endif; ?>
	<div class="mobile-social">
		<div class="social-icon twitter">
			<a href="https://twitter.com/billykulpa" target="_blank" title="Find Billy Kulpa on Twitter">
				<img alt="An icon for Twitter" height="28" src="/wp-content/uploads/icon-twitter-light.svg" width="28" />
			</a>
		</div><!-- .social-icon.twitter -->
		<div class="social-icon linkedin">
			<a href="https://www.linkedin.com/in/billykulpa" target="_blank" title="Find Billy Kulpa on LinkedIn">
				<img alt="An icon for LinkedIn" height="28" src="/wp-content/uploads/icon-linkedin-light.svg" width="28" />
			</a>
		</div><!-- .social-icon.linkedin -->
		<div class="social-icon youtube">
			<a href="https://www.youtube.com/c/BillyKulpa-Rockford" target="_blank" title="Find Billy Kulpa on YouTube">
				<img alt="An icon for YouTube" height="28" src="/wp-content/uploads/icon-youtube-light.svg" width="28" />
			</a>
		</div><!-- .social-icon.youtube -->
	</div><!-- .mobile-social -->
</nav><!-- #side-menu -->
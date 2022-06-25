<?php
/**
 * The theme header
 */

// page vars
$page = get_field('page');
$minimize_header = $page['minimal_header'];
$minimize_footer = $page['minimize_footer'];
if(is_singular('news')) :
	$news = get_field('news');
	$source_url = $news['source_url'];
endif;

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
	<?php if(!empty($source_url)) : ?>
		<meta name="robots" content="noindex, nofollow" />
	<?php endif; ?>
	<link rel="apple-touch-icon" sizes="180x180" href="/wp-content/uploads/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/wp-content/uploads/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/wp-content/uploads/favicon/favicon-16x16.png">
	<link rel="manifest" href="/wp-content/uploads/favicon/site.webmanifest">
	<link rel="mask-icon" href="/wp-content/uploads/favicon/safari-pinned-tab.svg" color="#333333">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="theme-color" content="#ffffff">
	<?php wp_head(); ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-43033866-13"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-43033866-13');
	</script>
</head>

<body <?php if($minimize_header) : body_class('minimize-header'); else : body_class(); endif; ?>>
	<?php wp_body_open(); ?>
	<div id="site-wrapper">
		<?php if(is_user_logged_in()) : ?>
			<div class="admin-options-wrapper">
				<?php echo edit_post_link( __( '<img alt="An edit icon" src="/wp-content/uploads/icon-edit-dark.svg" />', 'billykulpa2022' ), '', '', null, 'admin-link shadow-soft edit' ); ?>
				<a class="admin-link shadow-soft dashboard" href="/wp-admin/" target="_self" title="Go to the <?php echo get_bloginfo('name'); ?> administrative dashboard">
					<img alt="The WordPress icon" src="/wp-content/uploads/icon-wordpress-dark.svg" />
				</a>
				<a class="admin-link shadow-soft logout" href="/wp-login.php?action=logout" target="_self" title="Logout of <?php echo get_bloginfo('name'); ?> user account">
					<img alt="A logout icon" src="/wp-content/uploads/icon-logout-dark.svg" />
				</a>
			</div><!-- .admin-options-wrapper -->
		<?php endif; ?>
		<?php get_template_part('template-parts/nav/header-with-menu'); ?>
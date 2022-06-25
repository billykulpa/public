<?php
/**
 * Template part for displaying search
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package billykulpa2022
 */

?>
<div id="search-fields-nav">
	<form role="search" method="get" class="search-form" action="<?php bloginfo('url'); ?>" >
		<fieldset class="container">
			<input class="search-input" type="text" name="s" value="<?php if ( is_search() ) : ?><?php the_search_query(); ?><?php endif; ?>" placeholder="Search Term(s)" maxlength="" />
			<div class="search-right">
				<button class="btn btn-md btn-color-dark search-button" type="submit">Search</button>
				<div class="search-close">
					<img alt="An icon for closing search" height="16" src="/wp-content/uploads/icon_nav-search-close.svg" width="16" />
				</div>
				<input type="hidden" name="" value="">
				<!--<input type="hidden" name="post_type" value="">-->
			</div><!-- .search-right -->
		</fieldset>
	</form><!-- .container -->
</div><!-- #search-fields-nav -->
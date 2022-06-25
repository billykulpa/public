<?php

/**
 * REGISTER constants
 */
require_once( get_template_directory().'/functions/conf.php');

/**
 * REGISTER Added general functions
 */
require_once( get_template_directory().'/functions/helpers.php');

/**
 * REGISTER ACF functions
 */
require_once( get_template_directory().'/functions/acf.php');

/**
 * REGISTER shortcodes
 */
require_once( get_template_directory().'/functions/shortcodes.php');

/**
 * REGISTER theme functions
 */
require_once( get_template_directory().'/functions/theme.php');

/**
 * REGISTER theme hooks
 */
require_once( get_template_directory().'/functions/hooks.php');

/**
 * REGISTER new custom post type
 */
require_once( get_template_directory().'/functions/cpt.php');

/**
 * REGISTER functions for customizing admin screens
 */
require_once( get_template_directory().'/functions/admin.php');
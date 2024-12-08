<?php
/*
 * Plugin Name: Lifestyle Plugin
 * Description: This is my plugin that works with the Lifestyle Blog theme.
 * Author: Trayana Boykova
 */

if ( ! defined( 'LIFESTYLE_PLUGIN_VERSION' ) ) {
	define( 'LIFESTYLE_PLUGIN_VERSION', '0.1' );
}

if ( ! defined( 'LIFESTYLE_PLUGIN_ASSETS_URL' ) ) {
	define( 'LIFESTYLE_PLUGIN_ASSETS_URL',  plugin_dir_url( __FILE__ ) . 'assets' );
}

require 'includes/post-types.php';
require 'includes/taxonomies.php';
require 'includes/meta-boxes.php';
require 'includes/options-page.php';
require 'includes/acf-field.php';
require 'includes/filter.php';

<?php
/*
Plugin Name: Shortcake Bakery
Version: 0.1-alpha
Description: PLUGIN DESCRIPTION HERE
Author: YOUR NAME HERE
Author URI: YOUR SITE HERE
Plugin URI: PLUGIN SITE HERE
Text Domain: shortcake-bakery
Domain Path: /languages
*/

require_once dirname( __FILE__ ) . '/inc/class-shortcake-bakery.php';

/**
 * Load the Shortcake Bakery
 */
// @codingStandardsIgnoreStart
function Shortcake_Bakery() {
	return Shortcake_Bakery::get_instance();
}
// @codingStandardsIgnoreEnd
add_action( 'after_setup_theme', 'Shortcake_Bakery' );
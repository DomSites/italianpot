<?php
/*
 * Plugin Name: Smart Custom 404 Error Page
 * Description: Custom 404 the easy way! Set any page as a custom 404 error page -- no coding needed. <a href="https://www.nerdpress.net/announcing-404-page/">Now managed by NerdPress!</a>
 * Version: 11.4.8
 * Requires at least: 4.0
 * Requires PHP: 5.4 
 * Author: NerdPress
 * Author URI: https://www.nerdpress.net
 * Text Domain: 404page
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Loader
 */
require_once( plugin_dir_path( __FILE__ ) . '/loader.php' );

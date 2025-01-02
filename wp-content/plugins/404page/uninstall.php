<?php 
  
/**
 * The 404page Plugin Uninstall
 */
  
  
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// If this is somehow accessed withou plugin uninstall is requested, abort
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) || ! WP_UNINSTALL_PLUGIN ||	dirname( WP_UNINSTALL_PLUGIN ) != dirname( plugin_basename( __FILE__ ) ) ) {
  die;
}

/**
 * Loader
 */
require_once( plugin_dir_path( __FILE__ ) . '/loader.php' );


/**
 * Run Uninstaller
 */
pp_404page()->uninstall();
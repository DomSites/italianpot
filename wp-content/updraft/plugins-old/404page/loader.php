<?php

/**
 * The 404page Plugin Loader
 *
 * @since 7
 *
 **/
 
// If this file is called directly, abort
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Load files
 */
require_once( plugin_dir_path( __FILE__ ) . '/inc/class-404page.php' );
require_once( plugin_dir_path( __FILE__ ) . '/inc/class-404page-settings.php' );

/**
 * Run plugin
 */
$pp_404page = new PP_404Page( array(
  'file'    => dirname( __FILE__ ) . '/404page.php',
  'slug'    => pathinfo( dirname( __FILE__ ) . '/404page.php', PATHINFO_FILENAME ),
  'name'    => '404page - your smart custom 404 error page',
  'version' => '7'
  )  
);

?>
<?php

/**
 * The 404page admin plugin class
 *
 * @since  10
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * The admin plugin class
 */
if ( !class_exists( 'PP_404Page_Admin' ) ) {
  
  class PP_404Page_Admin extends PPF09_Admin {

    
    /**
	   * Do Init
     *
     * @since 10
     * @access public
     */
    public function init() {

      $this->add_actions( array( 
        'admin_init',
        'admin_menu',
        'admin_head' 
      ) );
      
      add_action( 'admin_enqueue_scripts', array( $this, 'admin_js' ) );
      add_action( 'admin_enqueue_scripts', array( $this, 'admin_css' ) );
    
    }
    
    
    /**
     * init admin 
     * moved to PP_404Page_Admin in v 10
     */
    function action_admin_init() {
      
      $this->settings()->set_method();
      
      // @since 11.0.0
      $this->add_setting_sections(
      
        array(
      
          array(
        
            'section' => 'general',
            'order'   => 10,
            'title'   => esc_html__( 'General', '404page' ),
            'icon'    => 'general',
            'fields' => array(
              array(
                'key'      => 'page_id',
                'callback' => 'admin_404page'
              )
            )
        
          ),
          
          array(
        
            'section' => 'advanced',
            'order'   => 20,
            'title'   => esc_html__( 'Advanced', '404page' ),
            'icon'    => 'advanced',
            'fields' => array(
              array(
                'key'      => 'hide',
                'callback' => 'admin_hide'
              ),
              array(
                'key'      => 'fire_error',
                'callback' => 'admin_fire404'
              ),
              array(
                'key'      => 'force_error',
                'callback' => 'admin_force404'
              ),
              array(
                'key'      => 'no_url_guessing',
                'callback' => 'admin_noguess'
              ),
              array(
                'key'      => 'http410_if_trashed',
                'callback' => 'admin_http410'
              ),
			  array(
                'key'      => 'http410_always',
                'callback' => 'admin_http410_always'
              ),
              array(
                'key'      => 'method',
                'callback' => 'admin_method'
              )
            
            )
        
          )
          
        )
        
      );
      
      do_action( '404page_addtional_setting_sections' );
      
    }
    
    
    /**
     * sanitize settings
     * was handle_method() in previous versions
     * as of version 11.0.0 the method is part of the settings array
     *
     * @since  11.0.0
     * @param  array $settings array of settings to save
     * @access public
     */
    public function sanitize_settings( $settings ) {
         
      if ( ! array_key_exists( 'method', $settings ) || ( $settings['method'] != 'STD' && $settings['method'] != 'CMP' ) ) {
      
        $settings['method'] = 'STD';
        
      }
      
      return $settings;
      
    }
    
    
    /**
     * handle the settings field page id
     * moved to PP_404Page_Admin in v 10
     */
    function admin_404page() {
      
      echo esc_html__( 'Page to be displayed as 404 page', '404page' );
      
      if ( $this->settings()->get( 'page_id' ) < 0 ) {
        
        echo '<div class="error form-invalid" style="line-height: 3em">' . esc_html__( 'The page you have selected as 404 page does not exist anymore. Please choose another page.', '404page' ) . '</div>';
      }
      
      wp_dropdown_pages( array( 'name' => $this->settings()->get_option_name() . '[page_id]', 'id' => 'select404page', 'echo' => 1, 'show_option_none' => esc_html__( '&mdash; NONE (WP default 404 page) &mdash;', '404page'), 'option_none_value' => '0', 'selected' => $this->settings()->get( 'page_id' ) ) );
        
      echo '<div id="404page_edit_link" style="display: none">' . get_edit_post_link( $this->settings()->get( 'page_id' ) )  . '</div>';
      echo '<div id="404page_test_link" style="display: none">' . get_site_url() . '/404page-test-' . md5( rand() ) . '</div>';
      echo '<div id="404page_current_value" style="display: none">' . $this->settings()->get( 'page_id' ) . '</div>';
      echo '<p class="submit"><input type="button" name="edit_404_page" id="edit_404_page" class="button secondary" value="' . esc_html__( 'Edit Page', '404page' ) . '" />&nbsp;<input type="button" name="test_404_page" id="test_404_page" class="button secondary" value="' . esc_html__( 'Test 404 error', '404page' ) . '" /></p>';
      
      if ( defined( 'WPSEO_VERSION' ) && method_exists( 'WPSEO_Options', 'get' ) && WPSEO_Options::get( 'enable_xml_sitemap' ) ) {

        // as of version 11.1.1 we not only check inf Yoast SEO is active but also if Yoast SEO sitemap feature is activated
        
        echo '<p class="pp-404page-info">';
        
        if ( $this->settings()->get( 'fire_error' ) ) {

          echo esc_html__( 'Yoast SEO sitemap detected. Your 404 page is automatically excluded from the XML sitemap created by Yoast.', '404page' );
          
        } else {
          
          echo esc_html__( 'Yoast SEO sitemap detected. Your 404 page is NOT automatically excluded from the XML sitemap created by Yoast, because you disabled the option "Send an 404 error if the page is accessed directly by its URL" on the "Advanced" tab.', '404page' );
          
        }
        
        echo '</p><br />';
        
      }
      
      if ( defined( 'JETPACK__VERSION' ) && method_exists( 'Jetpack', 'is_module_active' ) && Jetpack::is_module_active( 'sitemaps' ) ) {
        
        // Jetpack since version 11.1.2
        
        echo '<p class="pp-404page-info">';
        
        if ( $this->settings()->get( 'fire_error' ) ) {

          echo esc_html__( 'Jetpack sitemap detected. Your 404 page is automatically excluded from the XML sitemap created by Jetpack.', '404page' );
          
        } else {
          
          echo esc_html__( 'Jetpack sitemap detected. Your 404 page is NOT automatically excluded from the XML sitemap created by Jetpack, because you disabled the option "Send an 404 error if the page is accessed directly by its URL" on the "Advanced" tab.', '404page' );
          
        }
        
        echo '</p><br />';
        
      }
      
      
      // WP Super Cache
      // since 11.2.0
      if ( defined('WPCACHEHOME') ) {
        
        global $cache_enabled;
        
        // is caching active?
        if ( $cache_enabled ) {
        
          echo '<p class="pp-404page-info">';
          echo esc_html__( 'WP Super Cache detected. All 404 errors are automatically excluded from caching.', '404page' );
          echo '</p><br />';
          
        }
        
      }
      
      
      // W3 Total Cache
      // since 11.2.1
      if ( defined( 'W3TC' ) ) {
      
        if ( class_exists( 'W3TC\Dispatcher' ) ) {
          
          // is caching active?
          if ( W3TC\Dispatcher::config()->get_boolean( 'pgcache.enabled' ) ) {
            
            echo '<p class="pp-404page-info">';
            echo esc_html__( 'W3 Total Cache detected. All 404 errors are automatically excluded from caching.', '404page' );
            echo '</p><br />';
            
          }
          
        }
        
      }
      
    }
    
    
    /**
     * handle the settings field hide
     * moved to PP_404Page_Admin in v 10
     */
    function admin_hide() {
      
      $this->print_slider_check( 
        'hide', 
        esc_html__( 'Hide the selected page from the Pages list', '404page' ), 
        false,
        false,
        '<span class="dashicons dashicons-info"></span>&nbsp;' . esc_html__( 'For Administrators the page is always visible.', '404page' )
      );
      
    }
    
    
    /**
     * handle the settings field fire 404 error
     * moved to PP_404Page_Admin in v 10
     */
    function admin_fire404() {
      
      $this->print_slider_check( 
        'fire_error', 
        esc_html__( 'Send an 404 error if the page is accessed directly by its URL', '404page' ), 
        false,
        false,
        '<span class="dashicons dashicons-info"></span>&nbsp;' . esc_html__( 'Uncheck this if you want the selected page to be accessible.', '404page' )
      );
      
    }
    
    
    /**
     * handle the settings field to force an 404 error
     * moved to PP_404Page_Admin in v 10
     */
    function admin_force404() {
      
       $this->print_slider_check( 
        'force_error', 
        esc_html__( 'Force 404 error after loading page', '404page' ), 
        false,
        '09OOCbFLfnI',
        '<span class="dashicons dashicons-warning"></span>&nbsp;' . esc_html__( 'Generally this is not needed. It is not recommended to activate this option, unless it is necessary. Please note that this may cause problems with your theme.', '404page' )
      );
      
    }
    
    
    /**
     * handle the settings field to stop URL guessing
     * moved to PP_404Page_Admin in v 10
     */
    function admin_noguess() {
      
      $this->print_slider_check( 
        'no_url_guessing', 
        esc_html__( 'Disable URL autocorrection guessing', '404page' ), 
        false,
        'H0EdtFcAGl4',
        '<span class="dashicons dashicons-warning"></span>&nbsp;' . esc_html__( 'This stops WordPress from URL autocorrection guessing. Only activate, if you are sure about the consequences.', '404page' )
      );
    
    }
    
    
    /**
     * handle the settings field to send an http 410 error in case the object is trashed
     * @since 3.2
     * moved to PP_404Page_Admin in v 10
     */
    function admin_http410() {
      
      $this->print_slider_check( 
        'http410_if_trashed', 
        esc_html__( 'Send an HTTP 410 error instead of HTTP 404 in case the requested object is in trash', '404page' ), 
        false,
        'O5xPM0BMZxM',
        '<span class="dashicons dashicons-info"></span>&nbsp;' . esc_html__( 'Check this if you want to inform search engines that the resource requested is no longer available and will not be available again so it can be removed from the search index immediately.', '404page' ),
		$this->settings()->get( 'http410_always' )
      );
    
    }
	
	
	/**
     * handle the settings field to always send an http 410 error
     * @since 11.3.0
     */
    function admin_http410_always() {
      
      $this->print_slider_check( 
        'http410_always', 
        esc_html__( 'Always send an HTTP 410 error instead of HTTP 404', '404page' ), 
       false,
        false,
        '<span class="dashicons dashicons-info"></span>&nbsp;' . esc_html__( 'Check this if you always want to send an HTTP 410 error instead of an HTTP 404 error.', '404page' )
      );
    
    }	
    
    
    /**
     * handle the settings field method
     * moved to PP_404Page_Admin in v 10
     */
    function admin_method() {

      // unfortunately we can't use print_slider_check() here
      
      if ( $this->core()->is_native() || defined( 'CUSTOMIZR_VER' ) || defined( 'ICL_SITEPRESS_VERSION' ) ) {
        
        $dis = ' disabled="disabled"';
        
      } else {
        
        $dis = '';
      }
      
      echo '<p class="toggle"><span class="slider"><input type="checkbox" id="404page-method" name="404page_settings[method]" value="CMP"' . checked( 'CMP', $this->settings()->get( 'method' ), false ) . $dis . '/>';
      echo '<label for="404page-method" class="check"></label></span><span class="caption">' . esc_html__( 'Activate Compatibility Mode', '404page' ) . '<br />';
      echo '<span class="dashicons dashicons-info"></span>&nbsp;';
      
      if ( $this->core()->is_native() ) {
        
        esc_html_e( 'This setting is not available because the Theme you are using natively supports the 404page plugin.', '404page' );
      
      } elseif ( defined( 'CUSTOMIZR_VER' ) ) {
      
        esc_html_e( 'This setting is not availbe because the 404page Plugin works in Customizr Compatibility Mode.', '404page' );
      
      } elseif ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
      
        esc_html_e( 'This setting is not availbe because the 404page Plugin works in WPML Mode.', '404page' );
        
      } else {
                
        esc_html_e( 'If you are using a theme or plugin that modifies the WordPress Template System, the 404page plugin may not work properly. Compatibility Mode maybe can fix the problem. Activate Compatibility Mode only if you have any problems.', '404page' );
     
      }
      
      echo '</span></p>';

    }
    
    
    /**
     * create the menu entry
     * moved to PP_404Page_Admin in v 10
     */
    function action_admin_menu() {
      $screen_id = add_theme_page ( esc_html__( '404 Error Page', "404page" ), esc_html__( '404 Error Page', '404page' ), 'manage_options', '404pagesettings', array( $this, 'show_admin' ) );
      $this->set_screen_id( $screen_id );
    }
    
    
    /**
     * add admin css to header
     * moved to PP_404Page_Admin in v 10
     */
    function action_admin_head() {
      
      if ( $this->settings()->get( 'page_id' ) > 0 ) {
        
        echo '<style type="text/css">';
        
        foreach ( $this->core()->get_all_page_ids() as $pid ) {
          
          echo '#the-list #post-' . $pid . ' .column-title .row-title:before { content: "404"; background-color: #333; color: #FFF; display: inline-block; padding: 0 5px; margin-right: 10px; }';
          
        }
        
        echo '</style>';
        
      }
      
    }
    
    
    /**
     * add admin css file
     * moved to PP_404Page_Admin in v 10
     */
    function admin_css() {
      
      if ( get_current_screen()->id == $this->get_screen_id() ) {
        
        wp_enqueue_style( '404pagelity', $this->core()->get_asset_url( 'css', 'lity.min.css' ) );
        wp_enqueue_style( '404pagecss', $this->core()->get_asset_url( 'css', '404page-ui.css' ) );
        
        do_action( '404page_enqueue_css' );
        
      }
      
    }
    
    
    /**
     * add admin js files
     * moved to PP_404Page_Admin in v 10
     */
    function admin_js() {
      
      if ( get_current_screen()->id == $this->get_screen_id() ) {
        
        wp_enqueue_script( '404page-ui', $this->core()->get_asset_url( 'js', '404page-ui.js' ), 'jquery', $this->core()->get_plugin_version(), true );
        wp_enqueue_script( '404page-lity', $this->core()->get_asset_url( 'js', 'lity.min.js' ), 'jquery', $this->core()->get_plugin_version(), true );
        
        do_action( '404page_enqueue_js' );
      
      }
      
    }
   
   
    /**
     * show admin page
     * moved to PP_404Page_Admin in v 10
     */
    function show_admin() {
      
      $this->show( 'manage_options' );
      
    }
    
    
    /**
     * create nonce
     *
     * @since  10.4
     * @access private
     * @return string Nonce
     */
    private function get_nonce() {
      
      return wp_create_nonce( 'pp_404page_dismiss_admin_notice' );
      
    }
    
    
    /**
     * check nonce
     *
     * @since  10.4
     * @access private
     * @return boolean
     */
    private function check_nonce() {
      
      return check_ajax_referer( 'pp_404page_dismiss_admin_notice', 'securekey', false );
      
    }

  }
  
}
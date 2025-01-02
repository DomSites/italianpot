<?php
/**
 * Kale functions and definitions
 *
 * @package kale
 */
?>
<?php


/*------------------------------
 Customizer
 ------------------------------*/
 
if ( ! class_exists( 'Kirki' ) ) {
    include_once( dirname( __FILE__ ) . '/inc/kirki/kirki.php' );
}
require get_template_directory() . '/customize/theme-defaults.php';
require get_template_directory() . '/customize/kirki-config.php';
require get_template_directory() . '/customize/customizer.php';

function kale_customize_register( $wp_customize ) {
    $wp_customize->remove_control('header_textcolor');
    $wp_customize->get_section('colors')->title = __( 'Custom Colors', 'kale' );
    $wp_customize->get_section('colors')->priority = 75;
}
add_action( 'customize_register', 'kale_customize_register' );

if(is_admin())  add_action( 'customize_controls_enqueue_scripts', 'kale_custom_customize_enqueue' );
function kale_custom_customize_enqueue() {
    wp_enqueue_style( 'kale-customizer', get_template_directory_uri() . '/customize/style.css' );
}


/*------------------------------
 Setup
 ------------------------------*/

if ( ! function_exists( 'kale_setup' ) ) :
function kale_setup() {
    global $kale_defaults;
    load_theme_textdomain( 'kale', get_template_directory() . '/languages' ); 
    
    register_nav_menus( array('header' => __( 'Main Menu', 'kale' )) );
    
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo', array('height' => 150, 'width' => 300,'flex-height' => true,'flex-width'  => true ) );
    add_theme_support( 'custom-background');
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    
    $args = array(
        'flex-width'    => true,
        'width'         => 1200,
        'flex-height'    => true,
        'height'        => 550,
        'default-image' => $kale_defaults['kale_custom_header'],
    );
    add_theme_support( 'custom-header', $args );

    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 760, 400, true );
    add_image_size( 'kale-slider', 1200, 550, true );
    add_image_size( 'kale-thumbnail', 760, 400, true );
    add_image_size( 'kale-index', 550, 350, true );
    add_image_size( 'kale-vertical', 400, 680, true );

    add_post_type_support('page', 'excerpt');
    
    add_theme_support( 'post-formats', array( 'video' ) );
    
    #https://make.wordpress.org/core/2016/11/26/extending-the-custom-css-editor/
    if ( function_exists( 'wp_update_custom_css_post' ) ) {
        $css = kale_get_option('kale_advanced_css');
        if ( $css ) {
            $core_css = wp_get_custom_css(); 
            $return = wp_update_custom_css_post( $core_css . $css );
            if ( ! is_wp_error( $return ) ) {
                remove_theme_mod( 'kale_advanced_css' );
            }
        }
    }
}
endif;
add_action( 'after_setup_theme', 'kale_setup' );


/*------------------------------
 Styles and Scripts
 ------------------------------*/

if ( ! function_exists( 'kale_scripts' ) ) :
function kale_scripts() {
    
    /* Styles */
    
    wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
    wp_register_style('bootstrap-select', get_template_directory_uri() . '/assets/css/bootstrap-select.min.css' );
    wp_register_style('font-awesome', get_template_directory_uri().'/assets/css/font-awesome.min.css' );
    wp_register_style('owl-carousel', get_template_directory_uri().'/assets/css/owl.carousel.css' );

    $kale_custom_colors = kale_get_option('kale_custom_colors');
    $kale_custom_typography = kale_get_option('kale_custom_typography');
    
    if($kale_custom_typography == 0) {
        //fonts
        wp_enqueue_style('kale-googlefont1', '//fonts.googleapis.com/css?family=Montserrat:400,700'); #headings
        wp_enqueue_style('kale-googlefont2', '//fonts.googleapis.com/css?family=Lato:400,700,300,300italic,400italic,700italic'); #body
        wp_enqueue_style('kale-googlefont3', '//fonts.googleapis.com/css?family=Raleway:200'); #logo
        wp_enqueue_style('kale-googlefont4', '//fonts.googleapis.com/css?family=Caveat'); #tagline
    } 
    //default stylesheet
    $deps = array('bootstrap', 'bootstrap-select', 'font-awesome', 'owl-carousel');
    wp_enqueue_style('kale-style', get_stylesheet_uri(), $deps );
    wp_style_add_data( 'kale-style', 'rtl', 'replace' );
	
    /* Scripts */
    
    // Load html5shiv.js
	wp_enqueue_script( 'kale-html5', get_template_directory_uri() . '/assets/js/html5shiv.js', array('kale-style'), '3.7.0' );
	wp_script_add_data( 'kale-html5', 'conditional', 'lt IE 9' );
    // Load respond.min.js
	wp_enqueue_script( 'kale-respond', get_template_directory_uri() . '/assets/js/respond.min.js', array('kale-style'), '1.3.0' );
	wp_script_add_data( 'kale-respond', 'conditional', 'lt IE 9' );
    
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery'), '', true );
    wp_enqueue_script('bootstrap-select', get_template_directory_uri() . '/assets/js/bootstrap-select.min.js', array('jquery','bootstrap'), '', true );
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '', true );
    
    if(kale_get_option('kale_enable_fancy_scrollbar') == 1){
        wp_enqueue_script('nice-scroll', get_template_directory_uri() . '/assets/js/nicescroll.min.js', array('jquery'), '', true );
        wp_enqueue_script('kale-js', get_template_directory_uri() . '/assets/js/kale.js', array('jquery', 'nice-scroll'), '', true );
    } else {
        wp_enqueue_script('kale-js', get_template_directory_uri() . '/assets/js/kale.js', array('jquery'), '', true );
    }
    
    //comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
endif;
add_action( 'wp_enqueue_scripts', 'kale_scripts' );


/*------------------------------
 Custom CSS
 ------------------------------*/

 require get_template_directory() . '/custom/custom_css.php';
if ( ! function_exists( 'kale_custom_fonts' ) ) :
function kale_custom_fonts(){
    $kale_custom_typography = kale_get_option('kale_custom_typography');
    if($kale_custom_typography == 0) return;
    
    $kale_custom_typography_body_font = kale_get_option('kale_custom_typography_body_font');
    $kale_custom_typography_logo_font = kale_get_option('kale_custom_typography_logo_font');
    $kale_custom_typography_tagline_font = kale_get_option('kale_custom_typography_tagline_font');
    $kale_custom_typography_heading_font = kale_get_option('kale_custom_typography_heading_font');
    $kale_custom_typography_h1_font = kale_get_option('kale_custom_typography_h1_font');
    $kale_custom_typography_h2_font = kale_get_option('kale_custom_typography_h2_font');
    $kale_custom_typography_h3_font = kale_get_option('kale_custom_typography_h3_font');
    $kale_custom_typography_h4_font = kale_get_option('kale_custom_typography_h4_font');
    $kale_custom_typography_h5_font = kale_get_option('kale_custom_typography_h5_font');
    $kale_custom_typography_h6_font = kale_get_option('kale_custom_typography_h6_font');
    
    #body
    $arr['font_body_name'] = $kale_custom_typography_body_font['font-family'];
    $arr['font_body_size'] = $kale_custom_typography_body_font['font-size'];
    $arr['font_body_transform'] = $kale_custom_typography_body_font['text-transform'];
    $arr['font_body_variant'] = $kale_custom_typography_body_font['variant'];
    #logo
    $arr['font_logo_name'] = $kale_custom_typography_logo_font['font-family'];
    $arr['font_logo_size'] = $kale_custom_typography_logo_font['font-size'];
    $arr['font_logo_transform'] = $kale_custom_typography_logo_font['text-transform'];
    $arr['font_logo_variant'] = $kale_custom_typography_logo_font['variant'];
    #tagline
    $arr['font_tagline_name'] = $kale_custom_typography_tagline_font['font-family'];
    $arr['font_tagline_size'] = $kale_custom_typography_tagline_font['font-size'];
    $arr['font_tagline_transform'] = $kale_custom_typography_tagline_font['text-transform'];
    $arr['font_tagline_variant'] = $kale_custom_typography_tagline_font['variant'];
    #headings
    $arr['font_heading_name'] = $kale_custom_typography_heading_font['font-family'];
    $arr['font_heading_transform'] = $kale_custom_typography_heading_font['text-transform'];
    $arr['font_heading_variant'] = $kale_custom_typography_heading_font['variant'];
    $arr['font_h1_size'] = $kale_custom_typography_h1_font['font-size'];
    $arr['font_h2_size'] = $kale_custom_typography_h2_font['font-size'];
    $arr['font_h3_size'] = $kale_custom_typography_h3_font['font-size'];
    $arr['font_h4_size'] = $kale_custom_typography_h4_font['font-size'];
    $arr['font_h5_size'] = $kale_custom_typography_h5_font['font-size'];
    $arr['font_h6_size'] = $kale_custom_typography_h6_font['font-size'];
    global $custom_css_template; $custom_css = $custom_css_template['fonts'];
    foreach($arr as $k=>$v) 
        $custom_css = str_replace("~$k~", $v, $custom_css);
    echo "<style>$custom_css</style>";
}
endif;
add_action( 'wp_head', 'kale_custom_fonts', 97);

if ( ! function_exists( 'kale_custom_colors' ) ) :
function kale_custom_colors(){
    $kale_custom_colors = kale_get_option('kale_custom_colors');
    if($kale_custom_colors == 0) return;
    
    $kale_custom_colors_body = kale_get_option('kale_custom_colors_body');
    $kale_custom_colors_accent = kale_get_option('kale_custom_colors_accent');
    
    $arr['color_body'] = $kale_custom_colors_body;
    $arr['color_accent'] = $kale_custom_colors_accent;
    
    global $custom_css_template; $custom_css = $custom_css_template['colors'];
    foreach($arr as $k=>$v) 
        $custom_css = str_replace("~$k~", $v, $custom_css);
    echo "<style>$custom_css</style>";
}
endif;
add_action( 'wp_head', 'kale_custom_colors', 98);

if ( ! function_exists( 'kale_custom_css' ) ) :
function kale_custom_css() {
    $kale_advanced_css = kale_get_option('kale_advanced_css');
    if($kale_advanced_css != '') {    
        echo '<!-- Custom CSS -->';
        $output="<style>" . stripslashes($kale_advanced_css) . "</style>";
        echo $output;
        echo '<!-- /Custom CSS -->';
    }
}
endif;
add_action('wp_head','kale_custom_css', 99);

if ( ! function_exists( 'kale_custom_js' ) ) :
function kale_custom_js() {
    $kale_advanced_analytics = kale_get_option('kale_advanced_analytics'); 
    if($kale_advanced_analytics != '') {
        echo '<!-- Google Analytics -->';
        echo $kale_advanced_analytics;
        echo '<!-- /Google Analytics -->';
    }
}
endif;
add_action('wp_head','kale_custom_js', 100);


/*------------------------------
 Widgets
 ------------------------------*/
 require_once get_template_directory() . '/widgets/class.aboutme.widget.php';
require_once get_template_directory() . '/widgets/widgets.php';


/*------------------------------
 Shortcodes
 ------------------------------*/
require_once get_template_directory() . '/shortcodes/shortcodes.php';

add_action('admin_enqueue_scripts', 'kale_lt_recipe_button_css');
function kale_lt_recipe_button_css() {
    if(is_admin()) 
        wp_enqueue_style('kale-shortcodes', get_template_directory_uri() . '/shortcodes/shortcodes.css');
}

add_action('admin_head', 'kale_lt_recipe_button');
function kale_lt_recipe_button() {
    global $typenow;
    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) return;
    if ( ! in_array( $typenow, array( 'post', 'page' ) ) ) return;
    if ( get_user_option('rich_editing') == 'true') {
        add_filter("mce_external_plugins", "kale_add_lt_recipe_plugin");
        add_filter('mce_buttons', 'kale_register_lt_recipe_button');
    }
}
function kale_add_lt_recipe_plugin($plugin_array) {
    $plugin_array['kale_lt_recipe_button'] = get_template_directory_uri() . '/shortcodes/shortcodes.js' ; 
    return $plugin_array;
}
function kale_register_lt_recipe_button($buttons) {
   array_push($buttons, "kale_lt_recipe_button");
   return $buttons;
}

/*------------------------------
 Meta Boxes
 ------------------------------*/
require_once get_template_directory() . '/meta_boxes/meta_boxes.php';


/*------------------------------
 Content Width 
 ------------------------------*/
if ( ! isset( $content_width ) ) {
    $content_width = 1200;
}


/*------------------------------
 Theme Updates
 ------------------------------*/
 
$theme = get_template();
require_once 'theme-updates/theme-update-checker.php';
$checker = new ThemeUpdateChecker( $theme, 'https://www.lyrathemes.com/versions/kale-pro.json');
//$checker->checkForUpdates();

#Disable requests to wp.org repository for this theme
# http://wptheming.com/2014/06/disable-theme-update-checks/
function kale_disable_wporg_request( $r, $url ) {
	if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) ) { return $r; }
    $themes = json_decode( $r['body']['themes'] );
    $parent = get_option( 'template' );
    $child = get_option( 'stylesheet' );
    unset( $themes->themes->$parent );
    unset( $themes->themes->$child );
    $r['body']['themes'] = json_encode( $themes );
    return $r;
}
add_filter( 'http_request_args', 'kale_disable_wporg_request', 5, 2 );


/*------------------------------
 wp_bootstrap_navwalker
 ------------------------------*/
require_once get_template_directory() . '/inc/wp_bootstrap_navwalker.php';


/*------------------------------
 TGM_Plugin_Activation
 ------------------------------*/

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'kale_register_required_plugins' );
function kale_register_required_plugins() {
	$plugins = array(
        array(
			'name'      => 'One Click Demo Import',
			'slug'      => 'one-click-demo-import',
			'required'  => false,
		),
        array(
			'name'      => 'Recent Posts Widget With Thumbnails',
			'slug'      => 'recent-posts-widget-with-thumbnails',
			'required'  => false,
		),
        array(
            'name'      => 'WP Instagram Widget',
            'slug'      => 'wp-instagram-widget',
            'required'  => false
        )
	);
	$config = array(
		'id'           => 'kale',                  // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);
	tgmpa( $plugins, $config );
}


/*------------------------------
 Jetpack
 ------------------------------*/
 
#https://jetpack.com/2013/06/10/moving-sharing-icons/
function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
} 
add_action( 'init', 'jptweak_remove_share');
add_action( 'loop_start', 'jptweak_remove_share' );


/*------------------------------
 Filters
 ------------------------------*/

#disable comments on media attachments
function kale_filter_media_comment_status( $open, $post_id ) {
	$post = get_post( $post_id );
	if( $post->post_type == 'attachment' ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'kale_filter_media_comment_status', 10 , 2 );

#move comment field to the bottom of the comments form
function kale_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'kale_move_comment_field_to_bottom' );

#excerpt length
function kale_excerpt_length( $length ) {
	return 45;
}
add_filter( 'excerpt_length', 'kale_excerpt_length', 999 );

#add class to page nav
function kale_wp_page_menu_class( $class ) {
  return preg_replace( '/<ul>/', '<ul class="nav navbar-nav">', $class, 1 );
}
add_filter( 'wp_page_menu', 'kale_wp_page_menu_class' );

//http://wordpress.stackexchange.com/questions/50779/how-to-wrap-oembed-embedded-video-in-div-tags-inside-the-content
add_filter('embed_oembed_html', 'kale_embed_oembed_html', 99, 4);
function kale_embed_oembed_html($html, $url, $attr, $post_id) {
  return '<div class="iframe-video">' . $html . '</div>';
}

function kale_archive_title( $title ) {
    if( is_home() && get_option('page_for_posts') ) {
        $title = get_page( get_option('page_for_posts') )->post_title;
    }
    else if( is_home() ) {
        $title = kale_get_option('kale_blog_feed_label');
        $title = esc_html($title);
    }  
    return $title;
}
add_filter( 'get_the_archive_title', 'kale_archive_title' );

/*------------------------------
 Top Navigation
 ------------------------------*/

#add search form to nav
function kale_nav_items_wrap() {
    // default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'
    // open the <ul>, set 'menu_class' and 'menu_id' values
    $wrap  = '<ul id="%1$s" class="%2$s">';
    // get nav items as configured in /wp-admin/
    $wrap .= '%3$s';
    // the static link 
    $wrap .= kale_get_nav_search_item();
    // close the <ul>
    $wrap .= '</ul>';
    // return the result
    return $wrap;
}

function kale_get_nav_search_item(){
    return '<li class="search">
        <a href="javascript:;" id="toggle-main_search" data-toggle="dropdown"><i class="fa fa-search"></i></a>
        <div class="dropdown-menu main_search">
            <form name="main_search" method="get" action="'.esc_url(home_url( '/' )).'">
                <input type="text" name="s" class="form-control" placeholder="'.__('Type here','kale').'" />
            </form>
        </div>
    </li>';
}

function kale_default_nav(){
    echo '<div class="navbar-collapse collapse">';
    echo '<ul class="nav navbar-nav">';
    $pages = get_pages();  
    $n = count($pages); 
    $i=0;
    foreach ( $pages as $page ) {
        $menu_name = esc_html($page->post_title);
        $menu_link = get_page_link( $page->ID );
        if(get_the_ID() == $page->ID) $current_class = "current_page_item current-menu-item";
        else { $current_class = ''; }
        $menu_class = "page-item-" . $page->ID;
        echo "<li class='page_item $menu_class $current_class'><a href='$menu_link'>$menu_name</a></li>";
        $i++;
        if($n == $i){
            echo kale_get_nav_search_item();
        }
    } 
    echo '</ul>';
    echo '</div>';
}


/*------------------------------
 Helper
 ------------------------------*/

if ( ! function_exists( 'kale_get_option' ) ) :
function kale_get_option($key){
    global $kale_defaults;
    if (array_key_exists($key, $kale_defaults)) 
        $value = get_theme_mod($key, $kale_defaults[$key]); 
    else
        $value = get_theme_mod($key);
    return $value;
}
endif;


if ( ! function_exists( 'kale_get_bootstrap_class' ) ) :
function kale_get_bootstrap_class($columns){
    switch($columns){
        case 1: return 'col-md-12'; break;
        case 2: return 'col-lg-6 col-md-6 col-sm-6 col-xs-6'; break;
        case 3: return 'col-lg-4 col-md-4 col-sm-4 col-xs-12'; break;
        case 4: return 'col-lg-3 col-md-3 col-sm-6 col-xs-12'; break;
        case 5: return 'col-md-20'; break;
        case 6: return 'col-lg-2 col-md-2 col-sm-2 col-xs-6'; break;
    }
}
endif;

if ( ! function_exists( 'kale_get_sample' ) ) :
function kale_get_sample($what){
    global $kale_defaults;
    switch($what){
        case 'slide':           $images = $kale_defaults['kale_slide_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);
        case 'kale-thumbnail':  $images = $kale_defaults['kale_thumbnail_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);
        case 'full':            $images = $kale_defaults['kale_full_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);
        case 'kale-vertical':   $images = $kale_defaults['kale_vertical_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);    
        case 'kale-index':      $images = $kale_defaults['kale_index_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);    
    }
}
endif;

if ( ! function_exists( 'kale_get_related_posts' ) ) :
function kale_get_related_posts($post_id, $n){
    $temp = array();
    $tag_ids = wp_get_post_tags( $post_id, array( 'fields' => 'ids' ) );
    if($tag_ids) { 
        $the_query = new WP_Query( array( 
            'tag__in' => $tag_ids, 
            'ignore_sticky_posts'=>true,
            'posts_per_page' => $n, 
            'post__not_in' => array($post_id), 
            'orderby'=>'comment_count modified', 
            'order'=>'DESC' ) );
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $temp[] = get_the_ID();
            }
        }
        wp_reset_postdata();
        if(count($temp)==$n)    return $temp;
    }
    return array();
}
endif;

if ( ! function_exists( 'kale_show_custom_css_field' ) ) :
function kale_show_custom_css_field(){
    if(get_bloginfo('version') >= 4.7){
        $kale_advanced_css = kale_get_option('kale_advanced_css');
        if($kale_advanced_css == '') return false;
        else return true;
    } 
    return true;
}
endif;


/*------------------------------
 Fancy Scrollbar
 ------------------------------*/

if ( ! function_exists( 'kale_nice_scroll' ) ) :
function kale_nice_scroll(){
    if(kale_get_option('kale_enable_fancy_scrollbar') != 1) return;
    global $kale_defaults;
    $kale_custom_colors = kale_get_option('kale_custom_colors');
    if($kale_custom_colors == 0) $color = $kale_defaults['kale_custom_colors_accent'];
    else $color = kale_get_option('kale_custom_colors_accent');
    $script = 'jQuery("html").niceScroll({ cursorcolor:"' . $color . '",
                                cursorborder:"' . $color . '",
                                cursoropacitymin:0.5,
                                cursorwidth:10,
                                zindex:10,
                                scrollspeed:60,
                                mousescrollstep:40});';
    wp_add_inline_script( 'kale-js', $script );
}
endif;
add_action( 'wp_enqueue_scripts', 'kale_nice_scroll');


/*------------------------------
 One Click Demo Import
 ------------------------------*/

if ( ! function_exists( 'kale_one_click_demo_import' ) ) :
function kale_one_click_demo_import() {
    return array(
        array(
            'import_file_name'             => __('Kale Demo Import', 'kale'),
            'categories'                   => array( 'Main' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'one-click-demo-import/kale-pro-demo-content.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'one-click-demo-import/kale-pro-widgets.wie',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'one-click-demo-import/kale-pro-options.dat',
            //'import_preview_image_url'     => 'http://www.your_domain.com/ocdi/preview_import_image1.jpg',
            'import_notice'                => __( 'Make sure all the recommended plugins are installed before importing the demo. After the import, please set up the slider (Posts Slider or Custom Slider) under Appearance > Customize > Front Page > Banner/Slider. You will also need to assign the Main menu to "Main Menu" location. If the social media icons are not showing up on the top left and in the sidebars, make sure that the Custom Menu widget assigned to the "Header - Left" and sidebar locations is set to the "Social" menu.', 'kale' ),
            ),
    );
}
endif;
add_filter( 'pt-ocdi/import_files', 'kale_one_click_demo_import' );
?>
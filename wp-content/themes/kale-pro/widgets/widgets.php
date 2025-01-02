<?php
/**
 * Widgets
 *
 * @package kale
 */
?>
<?php

function kale_widgets_init() {
    
    /* Sidebar Widgets */
    
    register_sidebar( array(
		'name'          => __( 'Sidebar - Default', 'kale' ),
		'id'            => 'sidebar-default',
		'before_widget' => '<div id="%1$s" class="default-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Sidebar - Default - Bordered', 'kale' ),
		'id'            => 'sidebar-default-bordered',
		'before_widget' => '<div id="%1$s" class="default-widget widget widget-bordered %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
    
    
    register_sidebar( array(
		'name'          => __( 'Sidebar - Front Page - Bordered', 'kale' ),
		'id'            => 'sidebar-frontpage-bordered',
		'before_widget' => '<div id="%1$s" class="frontpage-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
    
    /*
    register_sidebar( array(
		'name'          => __( 'Sidebar - Front Page - Bordered Sticky', 'kale' ),
		'id'            => 'sidebar-frontpage-bordered-sticky',
		'before_widget' => '<div id="%1$s" class="default-widget widget widget-bordered %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
    */
    
    register_sidebar( array(
		'name'          => __( 'Sidebar - Front Page', 'kale' ),
		'id'            => 'sidebar-frontpage',
		'before_widget' => '<div id="%1$s" class="frontpage-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Sidebar - Post - Bordered', 'kale' ),
		'id'            => 'sidebar-single-bordered',
		'before_widget' => '<div id="%1$s" class="single-widget widget widget-bordered %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
    register_sidebar( array(
		'name'          => __( 'Sidebar - Post', 'kale' ),
		'id'            => 'sidebar-single',
		'before_widget' => '<div id="%1$s" class="single-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Sidebar - Page - Bordered', 'kale' ),
		'id'            => 'sidebar-page-bordered',
		'before_widget' => '<div id="%1$s" class="page-widget widget widget-bordered %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
    register_sidebar( array(
		'name'          => __( 'Sidebar - Page', 'kale' ),
		'id'            => 'sidebar-page',
		'before_widget' => '<div id="%1$s" class="page-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
    
    
    /* Header Widgets */
    
	register_sidebar( array(
		'name'          => __( 'Header - Left', 'kale' ),
		'id'            => 'header-row-1-left',
		'description'   => __( 'Add widgets here to appear in the top left area.', 'kale' ),
		'before_widget' => '<div id="%1$s" class="header-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="header-widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => __( 'Header - Right', 'kale' ),
		'id'            => 'header-row-1-right',
		'description'   => __( 'Add widgets here to appear in the top right area.', 'kale' ),
		'before_widget' => '<div id="%1$s" class="header-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="header-widget-title">',
		'after_title'   => '</h3>',
	) );
    
    /* Footer Widgets */
    
    register_sidebar( array(
		'name'          => __( 'Footer - Full Width', 'kale' ),
		'id'            => 'footer-row-1-full',
		'before_widget' => '<div id="%1$s" class="footer-row-1-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Footer Secondary - Col 1', 'kale' ),
		'id'            => 'footer-row-2-col-1',
		'before_widget' => '<div id="%1$s" class="footer-row-2-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer Secondary - Col 2', 'kale' ),
		'id'            => 'footer-row-2-col-2',
		'before_widget' => '<div id="%1$s" class="footer-row-2-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer Secondary - Col 3', 'kale' ),
		'id'            => 'footer-row-2-col-3',
		'before_widget' => '<div id="%1$s" class="footer-row-2-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer Secondary - Col 4', 'kale' ),
		'id'            => 'footer-row-2-col-4',
		'before_widget' => '<div id="%1$s" class="footer-row-2-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer Secondary - Col 5', 'kale' ),
		'id'            => 'footer-row-2-col-5',
		'before_widget' => '<div id="%1$s" class="footer-row-2-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Footer - Last', 'kale' ),
		'id'            => 'footer-row-3-center',
		'before_widget' => '<div id="%1$s" class="footer-row-3-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    /* Ad Widgets */
    
    register_sidebar( array(
		'name'          => __( 'Page Ad', 'kale' ),
		'id'            => 'page-ad',
		'before_widget' => '<div id="%1$s" class="ad-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="ad-widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => __( 'Post Ad', 'kale' ),
		'id'            => 'post-ad1',
		'before_widget' => '<div id="%1$s" class="ad-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="ad-widget-title">',
		'after_title'   => '</h3>',
	) );
    
    /* Recipe Index Widgets */
    
    register_sidebar( array(
		'name'          => __( 'Recipe Index - 1', 'kale' ),
		'id'            => 'recipe-index-1',
		'before_widget' => '<div id="%1$s" class="recipe-index-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="recipe-index-widget-title">',
		'after_title'   => '</h4>',
	) );
    register_sidebar( array(
		'name'          => __( 'Recipe Index - 2', 'kale' ),
		'id'            => 'recipe-index-2',
		'before_widget' => '<div id="%1$s" class="recipe-index-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="recipe-index-widget-title">',
		'after_title'   => '</h4>',
	) );
    register_sidebar( array(
		'name'          => __( 'Recipe Index - 3', 'kale' ),
		'id'            => 'recipe-index-3',
		'before_widget' => '<div id="%1$s" class="recipe-index-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="recipe-index-widget-title">',
		'after_title'   => '</h4>',
	) );
    register_sidebar( array(
		'name'          => __( 'Recipe Index - 4', 'kale' ),
		'id'            => 'recipe-index-4',
		'before_widget' => '<div id="%1$s" class="recipe-index-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="recipe-index-widget-title">',
		'after_title'   => '</h4>',
	) );
    
    register_widget( 'Kale_AboutMe_Widget' );
}

add_action( 'widgets_init', 'kale_widgets_init' );

?>
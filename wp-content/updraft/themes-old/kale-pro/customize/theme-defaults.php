<?php
/**
 * Kale theme defaults
 *
 * @package kale
 */
?>
<?php 
$kale_defaults['kale_custom_header']                    = esc_url( get_template_directory_uri() ) . '/sample/images/header.jpg';

$kale_defaults['kale_footer_copyright']                 = 'Copyright &copy; '.date("Y").' <a href="https://www.lyrathemes.com/kale-pro/">Kale Pro</a>';
$kale_defaults['kale_nav_search_icon']                  = 1;
$kale_defaults['kale_enable_fancy_scrollbar']           = 1;
$kale_defaults['kale_example_content']					= 1;

$kale_defaults['kale_image_logo_show']                  = 0;
$kale_defaults['kale_text_logo']                        = 'KALE';

$kale_defaults['kale_custom_colors']                    = 0;
$kale_defaults['kale_custom_colors_body']               = '#545454';
$kale_defaults['kale_custom_colors_accent']             = '#000000';

$kale_defaults['kale_custom_typography']                = 0;
$kale_defaults['kale_custom_typography_body_font']      = array( 'font-family'   => 'Lato',
                                                            'variant'       => 'regular',
                                                            'font-size'     => '13px',
                                                            'text-transform'=> 'none' );
$kale_defaults['kale_custom_typography_post_font']      = array( 'font-family'   => 'PlayfairDisplay',
                                                            'variant'       => 'regular',
                                                            'font-size'     => '18px',
                                                            'line-height'     => '30px',
                                                            'text-transform'=> 'none' );
$kale_defaults['kale_custom_typography_logo_font']      = array( 'font-family'   => 'Raleway',
                                                            'variant'       => '200',
                                                            'font-size'     => '60px',
                                                            'text-transform'=> 'uppercase' );
$kale_defaults['kale_custom_typography_tagline_font']   = array( 'font-family'   => 'Caveat',
                                                            'variant'       => 'regular',
                                                            'font-size'     => '20px',
                                                            'text-transform'=> 'none' );
$kale_defaults['kale_custom_typography_heading_font']   = array( 'font-family'   => 'Montserrat',
                                                            'variant'       => '400',
                                                            'text-transform'=> 'uppercase' );
$kale_defaults['kale_custom_typography_h1_font']        = array( 'font-size'     => '18px' );
$kale_defaults['kale_custom_typography_h2_font']        = array( 'font-size'     => '16px' );
$kale_defaults['kale_custom_typography_h3_font']        = array( 'font-size'     => '13px' );
$kale_defaults['kale_custom_typography_h4_font']        = array( 'font-size'     => '12px' );
$kale_defaults['kale_custom_typography_h5_font']        = array( 'font-size'     => '12px' );
$kale_defaults['kale_custom_typography_h6_font']        = array( 'font-size'     => '12px' );

$kale_defaults['kale_enable_ads']                       = 0;

$kale_defaults['kale_banner_heading']                   = get_bloginfo('name');
$kale_defaults['kale_banner_description']               = get_bloginfo('description');
$kale_defaults['kale_banner_url']                       = '#';

$kale_defaults['kale_frontpage_banner']                 = 'Posts';

$kale_defaults['kale_frontpage_posts_slider_category']  = 1;
$kale_defaults['kale_frontpage_posts_slider_number']    = '3';

$kale_defaults['kale_frontpage_featured_posts_show']    = 1;
$kale_defaults['kale_frontpage_featured_posts_heading'] = __('Featured Posts', 'kale');
$kale_defaults['kale_frontpage_featured_posts_post_1']  = 1;
$kale_defaults['kale_frontpage_featured_posts_post_2']  = 1;
$kale_defaults['kale_frontpage_featured_posts_post_3']  = 1;

//$kale_defaults['kale_frontpage_feed_post_format']       = 'Mixed';
//$kale_defaults['kale_frontpage_feed_share_show']        = 1;

$kale_defaults['kale_frontpage_large_post_show']        = 1;
$kale_defaults['kale_frontpage_large_post_heading']     = __('My Diary', 'kale');
$kale_defaults['kale_frontpage_large_post']             = 1;
$kale_defaults['kale_frontpage_large_post_share_show']  = 1;

$kale_defaults['kale_frontpage_vertical_show']          = 1;
$kale_defaults['kale_frontpage_vertical_heading']       = __('All Time Favorites', 'kale');
$kale_defaults['kale_frontpage_vertical_category']      = 1;

$kale_defaults['kale_blog_feed_meta_show']              = 1;
$kale_defaults['kale_blog_feed_date_show']              = 1;
$kale_defaults['kale_blog_feed_category_show']          = 1;
$kale_defaults['kale_blog_feed_author_show']            = 1;
$kale_defaults['kale_blog_feed_comments_show']          = 1;
$kale_defaults['kale_blog_feed_label']                  = __('Recent Posts', 'kale');
$kale_defaults['kale_blog_feed_post_format']            = 'Mixed';
$kale_defaults['kale_blog_feed_share_show']             = 1;
$kale_defaults['kale_blog_feed_category_sidebar_show']  = 0;

$kale_defaults['kale_posts_meta_show']                  = 1;
$kale_defaults['kale_posts_date_show']                  = 1;    
$kale_defaults['kale_posts_category_show']              = 1;
$kale_defaults['kale_posts_author_show']                = 1;
$kale_defaults['kale_posts_tags_show']                  = 1;
$kale_defaults['kale_posts_sidebar']                    = '1';
$kale_defaults['kale_posts_featured_image_show']        = 1;
$kale_defaults['kale_posts_share_top_show']             = 1;
$kale_defaults['kale_posts_share_bottom_show']          = 1;
$kale_defaults['kale_posts_related_show']               = 1;

$kale_defaults['kale_pages_sidebar']                    = '1';
$kale_defaults['kale_pages_featured_image_show']        = 1;

/* sample images */

$kale_defaults['kale_slide_sample'][]                   = esc_url( get_template_directory_uri() ) . '/sample/images/slide1.jpg';
$kale_defaults['kale_slide_sample'][]                   = esc_url( get_template_directory_uri() ) . '/sample/images/slide2.jpg';
$kale_defaults['kale_slide_sample'][]                   = esc_url( get_template_directory_uri() ) . '/sample/images/slide3.jpg';
$kale_defaults['kale_slide_sample'][]                   = esc_url( get_template_directory_uri() ) . '/sample/images/slide4.jpg';
$kale_defaults['kale_slide_sample'][]                   = esc_url( get_template_directory_uri() ) . '/sample/images/slide5.jpg';
$kale_defaults['kale_slide_sample'][]                   = esc_url( get_template_directory_uri() ) . '/sample/images/slide6.jpg';

$kale_defaults['kale_thumbnail_sample'][]               = esc_url( get_template_directory_uri() ) . '/sample/images/thumb1.jpg';
$kale_defaults['kale_thumbnail_sample'][]               = esc_url( get_template_directory_uri() ) . '/sample/images/thumb2.jpg';
$kale_defaults['kale_thumbnail_sample'][]               = esc_url( get_template_directory_uri() ) . '/sample/images/thumb3.jpg';
$kale_defaults['kale_thumbnail_sample'][]               = esc_url( get_template_directory_uri() ) . '/sample/images/thumb4.jpg';
$kale_defaults['kale_thumbnail_sample'][]               = esc_url( get_template_directory_uri() ) . '/sample/images/thumb5.jpg';
$kale_defaults['kale_thumbnail_sample'][]               = esc_url( get_template_directory_uri() ) . '/sample/images/thumb6.jpg';

$kale_defaults['kale_full_sample'][]                    = esc_url( get_template_directory_uri() ) . '/sample/images/full1.jpg';
$kale_defaults['kale_full_sample'][]                    = esc_url( get_template_directory_uri() ) . '/sample/images/full2.jpg';
$kale_defaults['kale_full_sample'][]                    = esc_url( get_template_directory_uri() ) . '/sample/images/full3.jpg';

$kale_defaults['kale_vertical_sample'][]                = esc_url( get_template_directory_uri() ) . '/sample/images/vertical1.jpg';
$kale_defaults['kale_vertical_sample'][]                = esc_url( get_template_directory_uri() ) . '/sample/images/vertical2.jpg';
$kale_defaults['kale_vertical_sample'][]                = esc_url( get_template_directory_uri() ) . '/sample/images/vertical3.jpg';
$kale_defaults['kale_vertical_sample'][]                = esc_url( get_template_directory_uri() ) . '/sample/images/vertical4.jpg';
$kale_defaults['kale_vertical_sample'][]                = esc_url( get_template_directory_uri() ) . '/sample/images/vertical5.jpg';
$kale_defaults['kale_vertical_sample'][]                = esc_url( get_template_directory_uri() ) . '/sample/images/vertical6.jpg';

$kale_defaults['kale_index_sample'][]                   = esc_url( get_template_directory_uri() ) . '/sample/images/index1.jpg';
$kale_defaults['kale_index_sample'][]                   = esc_url( get_template_directory_uri() ) . '/sample/images/index2.jpg';
$kale_defaults['kale_index_sample'][]                   = esc_url( get_template_directory_uri() ) . '/sample/images/index3.jpg';
$kale_defaults['kale_index_sample'][]                   = esc_url( get_template_directory_uri() ) . '/sample/images/index4.jpg';
$kale_defaults['kale_index_sample'][]                   = esc_url( get_template_directory_uri() ) . '/sample/images/index5.jpg';
$kale_defaults['kale_index_sample'][]                   = esc_url( get_template_directory_uri() ) . '/sample/images/index6.jpg';

?>
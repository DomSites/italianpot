<?php
/**
* The category template file.
* 
* @package kale
*/
?>
<?php get_header(); ?>

<?php 
$kale_blog_feed_category_sidebar_show = kale_get_option('kale_blog_feed_category_sidebar_show');

if($kale_blog_feed_category_sidebar_show == 0) { ?>

<!-- Full Width Category -->
<div class="full-width-category">
    <h1 class="block-title"><span><?php single_cat_title(); ?></span></h1>
    
    <!-- Blog Feed -->
    <div class="blog-feed">
        <?php $kale_i = 0; $kale_ad = 0;
        if ( have_posts() ) { 
            while ( have_posts() ) : the_post(); ?>
            <?php if($kale_i%3 == 0) { ?><div class="row" data-fluid=".entry-title"><?php } ?>
            <div class="col-md-4"><?php $kale_entry = 'small'; include(locate_template('parts/entry.php')); $kale_i++; ?></div>
            <?php if($kale_i%3 == 0) { ?></div><?php } ?>
            <?php 
            endwhile; 
        }?>
        
    </div>
    <!-- /Blog Feed -->
    <?php if(get_next_posts_link() || get_previous_posts_link()) { ?>
    <hr />
    <div class="pagination-blog-feed">
        <?php if( get_next_posts_link() ) { ?><div class="previous_posts"><?php next_posts_link( __('Previous Posts', 'kale') ); ?></div><?php } ?>
        <?php if( get_previous_posts_link() ) { ?><div class="next_posts"><?php previous_posts_link( __('Next Posts', 'kale') ); ?></div><?php } ?>
    </div>
    <?php } ?>
</div>
<!-- /Full Width Category -->
<hr />

<?php } else { ?>


<!-- Category With Sidebar -->
<div class="category-with-sidebar">
    <div class="row two-columns">
        <?php get_template_part('parts/feed'); ?>
        <?php get_sidebar(); ?>
    </div>
</div>
<!-- /Category With Sidebar -->
<hr />

<?php } ?>

<?php get_footer(); ?>
<?php
/**
 * Frontpage - Vertical Posts
 *
 * @package kale
 */
?>
<?php 
$kale_frontpage_vertical_show = kale_get_option('kale_frontpage_vertical_show');
if($kale_frontpage_vertical_show == 1) { 
    $kale_frontpage_vertical_heading = kale_get_option('kale_frontpage_vertical_heading');
    $kale_frontpage_vertical_category = kale_get_option('kale_frontpage_vertical_category');
    $args = array( 'posts_per_page' => 5, 'category' => $kale_frontpage_vertical_category );
    $vertical_posts = get_posts( $args );
    $kale_entry = 'vertical'; 
    if($vertical_posts) { ?>
    <!-- Frontpage Vertical Posts -->
    <div class="frontpage-vertical-posts">
        <h2 class="block-title"><span><?php echo esc_html($kale_frontpage_vertical_heading); ?></span></h2>
        <div class="row" data-fluid=".entry-title">
            <?php foreach ( $vertical_posts as $post ) { 
                setup_postdata( $post );  ?>
                <div class="col-sm-4 col-md-20">
                <?php include(locate_template('parts/entry.php')); ?>
                </div>
            <?php } wp_reset_postdata(); ?>
        </div>
        <hr />
    </div>
    <!-- /Frontpage Vertical Posts -->
    <?php }
} ?>
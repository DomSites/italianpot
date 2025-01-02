<?php
/**
 * Template Name: Recipe Index
 *
 * The template for displaying a recipe index page
 *
 * @package kale
 */
?>
<?php get_header(); ?>

<?php $kale_example_content = kale_get_option('kale_example_content'); ?>

<?php while ( have_posts() ) : the_post(); ?>

<!-- Full Width Recipe Index -->
<div class="full-width-recipe-index">
        
    <?php get_sidebar('recipe-index'); ?>
    
    <?php $kale_page_meta = get_post_meta(get_the_ID(),'_recipe_index_meta',TRUE);
    if($kale_page_meta) {
        $kale_categories = explode(',', $kale_page_meta['categories']);
        $kale_n = $kale_page_meta['number_of_posts'];
    } else {
        $kale_categories = get_categories( array( 'orderby' => 'name', 'order'   => 'ASC' ) );
        foreach( $kale_categories as $category ) {   $temp[] = $category->term_id; }
        $kale_categories = $temp;
        $kale_n = 3;
    }
    ?>
    <!-- Recipe Index Feed -->
    <div class="recipe-index-feed">
        
        <div class="recipe-index-content"><?php the_content(); ?></div>
    
        <?php foreach($kale_categories as $category_id) { ?>
        <div class="row">
            <div class="col-md-3 category">
                <h3 class="category-title"><?php echo esc_html(get_cat_name($category_id)) ?></h3>
                <p class="category-description"><?php echo category_description($category_id); ?></p>
                <p class="category-more"><a href="<?php echo get_category_link( $category_id ) ?>"><?php _e('All ', 'kale'); echo esc_html(get_cat_name($category_id)); ?> </a></p>
            </div>
            <div class="col-md-9">
                <?php $kale_i = 0; $args = array( 'posts_per_page' => $kale_n, 'category' => $category_id );
                $kale_category_posts = get_posts( $args );
                foreach ( $kale_category_posts as $post ) { 
                    setup_postdata( $post ); ?>
                    <?php if($kale_i%3 == 0) { ?><div class="row"><?php } ?>
                    <div class="col-md-4 entry">
                        <div class="entry-thumb">
                            <?php if(has_post_thumbnail()) { ?>
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'kale-index', array( 'alt' => get_the_title(), 'class'=>'img-responsive' ) ); ?></a>
                            <?php } else if($kale_example_content == 1) { ?>
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url(kale_get_sample('kale-index')) ?>" alt="<?php the_title_attribute() ?>" class="img-responsive" /></a>
                            <?php } ?>
                        </div>
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                    </div>
                    <?php $kale_i++; if($kale_i%3 == 0) { ?></div><?php } ?>
                <?php } 
                wp_reset_postdata(); 
                if($kale_i % 3 != 0) { ?></div><?php } ?>    
            </div>
        </div>
        <hr />
        <?php } ?>
        
    </div>
    <!-- /Recipe Index Feed -->
    
</div>
<!-- /Full Width Recipe Index -->

<?php endwhile; ?>

<?php get_footer(); ?>
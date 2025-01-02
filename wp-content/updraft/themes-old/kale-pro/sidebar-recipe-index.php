<?php
/**
 * Special sidebar for housing widgets shown on the Recipe Index template
 *
 * @package vega
 */
?>
<?php if ( is_active_sidebar( 'recipe-index-1' ) 
        || is_active_sidebar( 'recipe-index-2' ) 
        || is_active_sidebar( 'recipe-index-3' ) 
        || is_active_sidebar( 'recipe-index-4' ) ) { ?>

<!-- Recipe Index - Search Filters -->
<div class="recipe-index-sidebar hidden-sm">
<div class="row">
    
    <?php if(is_active_sidebar( 'recipe-index-1' )) { ?><div class="col-md-3"><?php dynamic_sidebar('recipe-index-1'); ?></div><?php } ?>
    <?php if(is_active_sidebar( 'recipe-index-2' )) { ?><div class="col-md-3"><?php dynamic_sidebar('recipe-index-2'); ?></div><?php } ?>
    <?php if(is_active_sidebar( 'recipe-index-3' )) { ?><div class="col-md-3"><?php dynamic_sidebar('recipe-index-3'); ?></div><?php } ?>
    <?php if(is_active_sidebar( 'recipe-index-4' )) { ?><div class="col-md-3"><?php dynamic_sidebar('recipe-index-4'); ?></div><?php } ?>

</div>
<hr />
</div>
<!-- /Search Filters -->
<?php } ?>
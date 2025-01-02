<?php
/**
 * Sidebar
 *
 * @package kale
 */
?>
<!-- Sidebar -->
<div class="sidebar sidebar-column col-md-4"> 
    <?php 
    if(is_front_page()) { 
        if(is_active_sidebar('sidebar-frontpage-bordered')) { ?><div class="sidebar-frontpage-borders sidebar-block sidebar-borders"><?php dynamic_sidebar('sidebar-frontpage-bordered'); ?></div><?php } 
        if(is_active_sidebar('sidebar-frontpage')) { ?><div class="sidebar-frontpage sidebar-block sidebar-no-borders"><?php dynamic_sidebar('sidebar-frontpage'); ?></div><?php } 
    }
    
    if(is_single()) {
        if(is_active_sidebar('sidebar-single-bordered')) { ?><div class="sidebar-single-borders sidebar-block sidebar-borders"><?php dynamic_sidebar('sidebar-single-bordered'); ?></div><?php } 
        if(is_active_sidebar('sidebar-single')) { ?><div class="sidebar-single sidebar-block sidebar-no-borders"><?php dynamic_sidebar('sidebar-single'); ?></div><?php } 
    }
    
    if(is_page()) {
        if(is_active_sidebar('sidebar-page-bordered')) { ?><div class="sidebar-page-borders sidebar-block sidebar-borders"><?php dynamic_sidebar('sidebar-page-bordered'); ?></div><?php } 
        if(is_active_sidebar('sidebar-page')) { ?><div class="sidebar-page sidebar-block sidebar-no-borders"><?php dynamic_sidebar('sidebar-page'); ?></div><?php } 
    }
    
    if(is_active_sidebar('sidebar-default-bordered')) { ?><div class="sidebar-default-borders sidebar-block sidebar-borders"><?php dynamic_sidebar('sidebar-default-bordered'); ?></div><?php } 
    
    if(is_active_sidebar('sidebar-default')) { ?><div class="sidebar-default sidebar-block sidebar-no-borders"><?php dynamic_sidebar('sidebar-default'); ?></div><?php } ?>
    
    <?php /*
    if(is_front_page()) { 
        if(is_active_sidebar('sidebar-frontpage-bordered-sticky')) { ?><div class="sidebar-frontpage-borders sidebar-block sidebar-borders sidebar-sticky"><?php dynamic_sidebar('sidebar-frontpage-bordered-sticky'); ?></div><?php } 
    } */ 
    ?>
    
     
            
</div>
<!-- /Sidebar -->
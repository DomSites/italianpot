<?php
/**
* The main template file.
* 
* @package kale
*/
?>
<?php get_header(); ?>

<!-- Two Columns -->
<div class="row two-columns">
    <?php get_template_part('parts/feed'); ?>
    <?php get_sidebar(); ?>
</div>
<!-- /Two Columns -->
<hr />

 
<?php get_footer(); ?>
<?php
/**
 * Recipe Index Meta Box Form
 *
 * @package kale
 */
?>
<div class="meta_control">

<label><?php _e('Categories to Include', 'kale'); ?></label>
<p><input name="_recipe_index_meta[categories]" type="hidden" value="<?php if(!empty($meta['categories'])) echo $meta['categories']; ?>" size="40" /></p>
<?php 
$kale_selected_cats = array();
if(!empty($meta['categories'])) $kale_selected_cats = explode(',', $meta['categories']); 
?>
<p><?php wp_category_checklist(0,0,$kale_selected_cats); ?></p>

<label><?php _e('Posts Per Category', 'kale'); ?></label>
<p><input name="_recipe_index_meta[number_of_posts]" type="text" value="<?php if(!empty($meta['number_of_posts'])) echo $meta['number_of_posts']; ?>" size="40" /></p>


</div>
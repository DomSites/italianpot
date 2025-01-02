<?php
/**
 * Shortcodes
 *
 * @package kale
 */
?>
<?php 
function lt_recipe_function( $atts, $content=null ) {
    $a = shortcode_atts( array(
        'name'          => '',
        'date'          => get_the_date(),
        'servings'      => '',
        'prep_time'     => '',
        'cook_time'     => '',
        'total_time'    => '',
        'difficulty'    => '',
        'print'         => 'no',
        'summary'       => '',
        'author'        => get_the_author(),
        'image'         => '',
        'ingredients'   => '',
        'instructions'  => ''
    ), $atts ); 
    extract($a);
    $content = html_entity_decode($content);
    $instructions = html_entity_decode($instructions);
    $ingredients = html_entity_decode($ingredients);
    
    $allowed_tags = array(
        'a' => array(
            'href' => array(),
            'title' => array()
        ),
        'em' => array(),
        'strong' => array(),
    );
    
    if($name != ''){ 
    ob_start();?>

    
<div class="lt-recipe" id="lt-recipe" itemscope itemtype="http://schema.org/Recipe">
    <h4 itemprop="name"><?php echo $name ?></h4>
    <?php if($date != '' || ($prep_time != '' && $cook_time != '') || $total_time != '' || $difficulty != '') { ?>
    <div class="recipe-info">
        <?php if($date != '') { ?>
            <div class="publish-date"><i class="fa fa-calendar"></i> <meta itemprop="datePublished" content="<?php echo esc_attr($date) ?>"><?php echo esc_html($date) ?></div> 
        <?php } ?>
        <?php if($servings != '') { ?>
            <div class="servings"><i class="fa fa-user"></i> <label><?php _e('Servings', 'kale'); ?></label>: <?php echo esc_html($servings) ?></div>
        <?php } ?>
        <?php if($prep_time != '' && lt_valid_pt($prep_time)) { ?>
            <div class="prep-time"><i class="fa fa-clock-o"></i> <label><meta itemprop="prepTime" content="PT<?php echo strtoupper($prep_time) ?>"><?php _e('Prep', 'kale'); ?></label>: <?php lt_pt_words($prep_time); ?></div>
        <?php } ?>
        <?php if($cook_time != '' && lt_valid_pt($cook_time)) { ?>
            <div class="cook-time"><i class="fa fa-clock-o"></i> <label><meta itemprop="cookTime" content="PT<?php echo strtoupper($cook_time) ?>"><?php _e('Cook', 'kale'); ?></label>: <?php lt_pt_words($cook_time); ?></div>
        <?php } ?>
        <?php if($total_time != '' && lt_valid_pt($total_time)) { ?>
            <div class="total-time"><i class="fa fa-clock-o"></i> <label><meta itemprop="totalTime" content="PT<?php echo strtoupper($total_time) ?>"><?php _e('Total', 'kale'); ?></label>: <?php lt_pt_words($total_time); ?></div>
        <?php } ?>
        <?php if($difficulty != '') { ?>
        <div class="difficulty"><i class="fa fa-tachometer"></i> <label><?php _e('Difficulty', 'kale'); ?></label>: <?php echo esc_html($difficulty); ?></div>
        <?php } ?>
    </div>
    <?php } ?>
    <?php if($print == 'yes') { ?>
    <div class="recipe-print">
        <a href="javascript:kale_print_recipe('lt-recipe');"><i class="fa fa-print"></i> Print This</a>
    </div>
    <?php } ?>
    <?php if($summary != '') { ?>
    <p class="recipe-summary" itemprop="description"><?php echo esc_html($summary) ?></p>
    <?php } ?>
    <p class="recipe-author"><?php _e('By: ', 'kale'); ?><span itemprop="author"><?php echo esc_html($author); ?></span></p>
    <?php if($image != '') { ?>
    <div class="recipe-image"><img itemprop="image" src="<?php echo esc_url($image); ?>" class="img-responsive" /></div>
    <?php } ?>
    <div class="row">
    <?php if($ingredients != '') { 
    $ingredients_array = explode(';', $ingredients);
    if($ingredients_array) { 
    ?>
    <div class="col-md-5"><div class="recipe-ingredients">
        <h5><?php _e('Ingredients', 'kale'); ?></h5>
        <ul>
            <?php foreach($ingredients_array as $i) { ?>
            <li itemprop="recipeIngredient"><?php echo wp_kses($i, $allowed_tags); ?></li>
            <?php } ?>
        </ul>
    </div></div>
    <?php }
    } ?>
    <?php if($instructions != '' || $content != '') {
    $str = $instructions == '' ? $content : $instructions;
    $instructions_array = explode(';', $str);
    if($instructions_array) { $n=1;
    ?>
    <div class="col-md-7"><div class="recipe-directions">
        <h5><?php _e('Directions', 'kale'); ?></h5>
        <ul itemprop="recipeInstructions">
            <?php foreach($instructions_array as $i) { trim($i); if($i) { ?>
            <li><span class="step"><?php _e('Step', 'kale'); ?> <?php echo $n ?></span> <?php echo wp_kses($i, $allowed_tags); ?></li>
            <?php $n++; } } ?>
        </ul>
    </div></div>
    <?php }
    } ?>
    </div>
</div>
<iframe id="lt-recipe-print-frame" name="lt-recipe-print-frame" src="about:blank" style="display:none;"></iframe>    
    <?php return ob_get_clean(); }
}

add_shortcode( 'lt_recipe', 'lt_recipe_function' );


function lt_valid_pt($value){
    if (preg_match('/(^[0-9]{1,}h[0-9]{1,}m$)|(^[0-9]{1,}h$)|(^[0-9]{1,}m$)/i', $value)) {
        return true;
    } else {
        return false;
    }
}
function lt_pt_words($value){
    $str1 = ''; $str2 = '';
    if (class_exists('DateInterval')) {
        $interval = new DateInterval('PT'.$value); 
        if($interval->h)  $str1 = $interval->h . ' hr';
        if($interval->i)  $str2 = $interval->i . ' min';
        if($str1 != '') echo $str1 . ' ' . $str2;
        else echo $str2;
    } else echo ''; //todo code replacement
}
?>
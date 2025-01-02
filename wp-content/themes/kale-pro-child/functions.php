<?php
add_action( 'wp_enqueue_scripts', 'kale_child_enqueue_styles' );
function kale_child_enqueue_styles() {
    
    $parent_style = 'kale-style';
    $deps = array('bootstrap', 'bootstrap-select', 'font-awesome', 'owl-carousel');
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' , $deps);
    
    wp_enqueue_style( 'kale-style-child', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), wp_get_theme()->get('Version') );
}

function kale_get_option($key){
    global $kale_defaults;
    
    $parent_theme = get_template_directory();
    $parent_theme_slug = basename($parent_theme);
    $parent_theme_mods = get_option( "theme_mods_{$parent_theme_slug}");
    
    $value = '';
    $child_value = get_theme_mod($key);
    if(!empty($child_value)){
        $value = $child_value;
    }
    else if (!empty($parent_theme_mods) && isset($parent_theme_mods[$key])) {
        $value = $parent_theme_mods[$key];
    } else if (array_key_exists($key, $kale_defaults)) 
        $value = get_theme_mod($key, $kale_defaults[$key]); 
    return $value;
}
?>
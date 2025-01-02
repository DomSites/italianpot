<?php
/**
 * Meta Boxes
 *
 * @package kale
 */
?>
<?php

define('THEME_PATH', get_template_directory());
add_action('admin_init', 'kale_meta_init');
add_action( 'load-post.php', 'kale_meta_init' );
add_action( 'load-post-new.php', 'kale_meta_init' );

add_action('admin_print_scripts', 'kale_meta_js', 1000 );
 
function kale_meta_init(){
    if(is_admin()) 
        wp_enqueue_style('kale-meta-boxes', get_stylesheet_directory_uri() . '/meta_boxes/style.css');
    if(array_key_exists('post_ID', $_POST)) $post_id = $_POST['post_ID'] ;
    else if (array_key_exists('post', $_GET)) $post_id = $_GET['post'];
    else $post_id = '';
    $template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
	if ($template_file == 'page-recipe-index.php' || $template_file == 'template-recipe-index.php')	{
		add_action('add_meta_boxes', 'kale_meta_box_recipe_index' );
		add_action('save_post','kale_meta_save_recipe_index');
	} 
    
    add_action('add_meta_boxes', 'kale_meta_box_video_post' );
    add_action('save_post','kale_meta_save_video_post');
}

/*** Recipe Index ***/

function kale_meta_box_recipe_index() {
    add_meta_box(  'kale_meta_box_recipe_index', __( 'Kale - Recipe Index Options', 'kale' ), 'kale_meta_setup_recipe_index', 'page', 'side', 'high'  );
}
function kale_meta_setup_recipe_index( $post ) {
	global $post;
    $meta = get_post_meta($post->ID,'_recipe_index_meta',TRUE);
    include(THEME_PATH . '/meta_boxes/meta_box_recipe_index.php');
    echo '<input type="hidden" name="recipe_index_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}
function kale_meta_save_recipe_index($post_id) 
{
    if (!wp_verify_nonce($_POST['recipe_index_meta_noncename'],__FILE__)) return $post_id;
    if ($_POST['post_type'] == 'page') {
        if (!current_user_can('edit_page', $post_id)) return $post_id;
    }
    $current_data = get_post_meta($post_id, '_recipe_index_meta', TRUE);  
    $post_categories = $_POST['post_category'];
    
    $new_data = $_POST['_recipe_index_meta'];
    if(is_array($post_categories)) $new_data['categories'] = implode(',', $post_categories);
    kale_meta_clean($new_data);
     
    if ($current_data){
        if (is_null($new_data)) delete_post_meta($post_id,'_recipe_index_meta');
        else update_post_meta($post_id,'_recipe_index_meta',$new_data);
    } elseif (!is_null($new_data)) {
        add_post_meta($post_id,'_recipe_index_meta',$new_data,TRUE);
    }
 
    return $post_id;
}


/*** Video Posts ***/

function kale_meta_box_video_post() {
    add_meta_box( 'kale_meta_box_video_post', __( 'Kale - Video Options', 'kale' ), 'kale_meta_setup_video_post', 'post', 'side', 'high'  );
}
function kale_meta_setup_video_post( $post, $box  ) {
    $meta = get_post_meta($post->ID,'_video_post_meta',TRUE);
    include(get_template_directory() . '/meta_boxes/meta_box_video_post.php');
    wp_nonce_field( basename( __FILE__ ), 'video_post_meta_noncename' ); 
}
function kale_meta_save_video_post($post_id) 
{
    if ( !isset( $_POST['video_post_meta_noncename'] ) || !wp_verify_nonce( $_POST['video_post_meta_noncename'], basename( __FILE__ ) ) )
        return $post_id;

    if ($_POST['post_type'] == 'page') {
        if (!current_user_can('edit_page', $post_id)) return $post_id;
    }else{
        if (!current_user_can('edit_post', $post_id)) return $post_id;
    }
    
    $current_data = get_post_meta($post_id, '_video_post_meta', TRUE);  
    $new_data = $_POST['_video_post_meta'];
    foreach($new_data as $k=>$v){
        switch($k){
            case 'youtube_link'  : $final_data[$k] = esc_url($v); break;
        }
    }
    kale_meta_clean($final_data);
     
    if ($current_data){
        if (is_null($final_data)) delete_post_meta($post_id,'_video_post_meta');
        else update_post_meta($post_id,'_video_post_meta',$final_data);
    } elseif (!is_null($final_data)) {
        add_post_meta($post_id,'_video_post_meta',$final_data,TRUE);
    }
 
    return $post_id;
}

/*** Helper ***/

function kale_meta_clean(&$arr){
    if (is_array($arr)){
        foreach ($arr as $i => $v){
            if (is_array($arr[$i])) {
                kale_meta_clean($arr[$i]);
                if (!count($arr[$i])) 
                    unset($arr[$i]);
            }
            else{
                if (trim($arr[$i]) == '') 
                    unset($arr[$i]);
            }
        }
        if (!count($arr)) 
			$arr = NULL;
    }
}

function kale_meta_js(){
    if ( get_post_type() == "post" ) {
    ?>
    <script type="text/javascript">// <![CDATA[
        $ = jQuery;
        
        $(function() {
            display_meta_box();
            $("input[name='post_format']").change(function() {
                display_meta_box();
            });
        });
        
        function display_meta_box(){
            var selected_post_format = $("input[name='post_format']:checked").attr("id");
            if(selected_post_format == 'post-format-video') $("#kale_meta_box_video_post").show();
            else $("#kale_meta_box_video_post").hide();
        }
    </script>
    <?php } 
}
?>
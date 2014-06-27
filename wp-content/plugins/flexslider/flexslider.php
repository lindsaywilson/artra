<?php
 
/*
Plugin Name: FlexSlider
Plugin URI:
Description: Integrates FlexSlider with WordPress using custom post types.
Author: Lindsay Wilson
Version: 1.0
*/


define('FLEX_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('FLEX_NAME', "FlexSlider");
define ("FLEX_VERSION", "1.0");

wp_enqueue_script('flexslider', FLEX_PATH.'jquery.flexslider-min.js', array('jquery'));
wp_enqueue_style('flexslider_css', FLEX_PATH.'flexslider.css');

function flex_script(){
 
print '<script type="text/javascript" charset="utf-8">
  jQuery(window).load(function() {
    jQuery(\'.flexslider\').flexslider();
  });
</script>';
 
}
 
add_action('wp_head', 'flex_script');


function flex_get_slider(){
 
	$slider= '<div class="flexslider">
      <ul class="slides">';
 
    $flex_query= "post_type=homeslider-image";
    query_posts($flex_query);
     
     
    if (have_posts()) : while (have_posts()) : the_post();
        
		$img_id = get_post_thumbnail_id();
		$img_url_array = wp_get_attachment_image_src($img_id, 'thumbnail-size', true);
		$img_url = $img_url_array[0];
         
        $slider.='<li style="background-image:url('.$img_url.')"><div class="width"><span class="caption">'.get_the_title().'</span></div></li>';
             
    endwhile; endif; wp_reset_query();
 
 
    $slider.= '</ul>
    </div>';
     
    return $slider;
 
}

 
/**add the shortcode for the slider- for use in editor**/
 
function flex_insert_slider($atts, $content=null){
 
	$slider= flex_get_slider();
	 
	return $slider;
 
}
 
add_shortcode('flexslider', 'flex_insert_slider');
 
 
/**add template tag- for use in themes**/
 
function flex_slider(){
 
    print flex_get_slider();
}
 
?>
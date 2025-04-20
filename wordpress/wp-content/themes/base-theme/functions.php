<?php 

function load_assets(){
  // Enqueue Google Fonts
  wp_enqueue_style("font","//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i",array(),"1.0","all");
  
  // Enqueue Font Awesome
  wp_enqueue_style("fontawesome","//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css",array(),"1.1","all");
  
  // Enqueue main JavaScript
  wp_enqueue_script("mainjs", get_theme_file_uri('/build/index.js'), array('jquery'), "1.0.2", true);

}

add_action("wp_enqueue_scripts", "load_assets");


require_once get_template_directory() . '/inc/assets.php';
// require_once get_template_directory() . '/inc/custom-posts.php';
require_once get_template_directory() . '/inc/helpers.php';
// require_once get_template_directory() . '/inc/hooks.php';
// require_once get_template_directory() . '/inc/setup.php';
// require_once get_template_directory() . '/inc/shortcodes.php';
?>
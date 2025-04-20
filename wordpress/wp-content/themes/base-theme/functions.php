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


// config tailwind css
function theme_enqueue_styles() {
  wp_enqueue_style('theme-styles', get_template_directory_uri() . '/dist/css/app.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

// For editor styles
function theme_add_editor_styles() {
  add_editor_style('dist/css/editor-style.css');
}
add_action('admin_init', 'theme_add_editor_styles');


?>
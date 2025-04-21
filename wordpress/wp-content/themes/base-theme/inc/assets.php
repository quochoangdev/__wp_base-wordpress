<?php
// ---------- config tailwind css ----------
function theme_enqueue_styles()
{
  wp_enqueue_style('theme-styles', get_template_directory_uri() . '/dist/css/app.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

// ---------- For editor styles ----------
function theme_add_editor_styles()
{
  add_editor_style('dist/css/editor-style.css');
}
add_action('admin_init', 'theme_add_editor_styles');

?>
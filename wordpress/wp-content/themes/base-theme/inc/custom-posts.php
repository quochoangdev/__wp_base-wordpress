<?php
// Tạo Custom Post Type: Dự án
function my_register_du_an_post_type()
{
  register_post_type('du_an', array(
    'labels' => array(
      'name' => 'Dự án',
      'singular_name' => 'Dự án',
      'add_new' => 'Thêm mới',
      'add_new_item' => 'Thêm dự án mới',
      'edit_item' => 'Sửa dự án',
      'new_item' => 'Dự án mới',
      'view_item' => 'Xem dự án',
      'search_items' => 'Tìm dự án',
      'not_found' => 'Không tìm thấy',
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'du-an'),
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'show_in_rest' => true,
    'menu_icon' => 'dashicons-portfolio'
  ));
}
add_action('init', 'my_register_du_an_post_type');

// Tạo taxonomy: Lĩnh vực
function my_register_linh_vuc_taxonomy()
{
  register_taxonomy('linh_vuc', 'du_an', array(
    'labels' => array(
      'name' => 'Lĩnh vực',
      'singular_name' => 'Lĩnh vực',
      'search_items' => 'Tìm lĩnh vực',
      'all_items' => 'Tất cả lĩnh vực',
      'edit_item' => 'Sửa lĩnh vực',
      'update_item' => 'Cập nhật',
      'add_new_item' => 'Thêm lĩnh vực',
      'new_item_name' => 'Tên lĩnh vực mới',
    ),
    'hierarchical' => true, // true = giống category, false = tag
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'linh-vuc'),
  ));
}
add_action('init', 'my_register_linh_vuc_taxonomy');

?>
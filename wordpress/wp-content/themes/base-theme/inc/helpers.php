<?php
// ---------- log value ----------
if (!function_exists('log_')) {
  function log_($value)
  {
    echo '<pre>';
    print_r($value);
    echo '</pre>';
  }
}

// ---------- get custom excerpt ----------
function get_custom_excerpt($length = 40)
{
  // Tạo function ẩn danh (closure)
  $custom_callback = function () use ($length) {
    return $length;
  };

  add_filter('excerpt_length', $custom_callback, 999);

  $excerpt = get_the_excerpt(); // Hoặc the_excerpt() nếu bạn muốn in ra luôn

  remove_filter('excerpt_length', $custom_callback, 999);

  return $excerpt;
}
?>
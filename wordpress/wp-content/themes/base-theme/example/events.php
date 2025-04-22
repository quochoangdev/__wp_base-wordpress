<?php
// ---------- query meta key ----------
// SCF -> Event -> event_date
$today = date('Ymd');
$homepageEvents = new WP_Query(array(
  'post_type' => 'event',
  'posts_per_page' => 3,
  'meta_key' => 'event_date',
  'orderby' => 'meta_value_num',
  'order' => 'ASC',
  'meta_query' => array(
    array(
      'key' => 'event_date',
      'compare' => '>=',
      'value' => $today,
      'type' => 'numeric'
    )
  )
));

// ---------- tao mới một cái main query ----------
function func_create_query($query)
{
  // áp dụng custom query cho archive programmes
  if (!is_admin() and is_post_type_archive('programmes') and $query->is_main_query()) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }

  // áp dụng custom query cho archive events
  if (!is_admin() and is_post_type_archive('event') and $query->is_main_query()) {
    // $query->set('posts_per_page', 1);
    $today = date('Ymd');
    $query->set('post_type', 'event');
    $query->set('post_per_page', 2);
    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
      )
    ));
  }
}
add_action('pre_get_posts', 'func_create_query');
// echo paginate_links()

// ---------- tạo mới một custom query ----------
$today = date('Ymd');
$pastEvent = new WP_Query(array(
  // 'paged' => get_query_var('paged', 1),
  'post_type' => 'event',
  'posts_per_page' => 3,
  'meta_key' => 'event_date',
  'orderby' => 'meta_value_num',
  'order' => 'ASC',
  'meta_query' => array(
    array(
      'key' => 'event_date',
      'compare' => '<',
      'value' => $today,
      'type' => 'numeric'
    )
  )
));
// echo paginate_links(array(
//   'total' => $pastEvent->max_num_pages,
// ))

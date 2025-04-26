<?php
get_header();
// $term = get_queried_object();
// if ($term->term_id == 3) {
//     get_template_part('template-parts/archive', 'service');
// } else if ($term->term_id == 4) {
//     get_template_part('template-parts/archive', 'project');
// } else if ($term->term_id == 5 || $term->term_id == 6 || $term->term_id == 7 || $term->term_id == 8 || $term->term_id == 9) {
//     get_template_part('template-parts/archive', 'project-children');
// } else {
//     get_template_part('template-parts/archive', 'post');
// }
?>
<!-- search -->
<section class="">
  <?php echo do_shortcode('[custom_search_input id_render_ajax="search-id-render-ajax-1" id_input_search="search-id-input-search-1" id_button_search="search-id-button-search-1"]'); ?>
  
  <div id="search-id-render-ajax-1" class="flex flex-wrap w-full">
    <?php
    if (have_posts()) {
      while (have_posts()) {
        the_post();
    ?>
        <div class='flex flex-col gap-4 w-full md:w-1/2 lg:w-1/3'>
          <div class="text-2xl font-bold"><?php the_title(); ?></div>
          <div class=""><?php the_excerpt(); ?></div>
          <div class=""><?php the_permalink(); ?></div>
        </div>
    <?php
      }
      wp_reset_postdata();
    } else {
      echo '<h1>No posts found</h1>';
    }
    ?>
  </div>
</section>
<?php
get_footer();

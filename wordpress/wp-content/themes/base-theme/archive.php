<?php
get_header();
$term = get_queried_object();
if ($term->term_id == 3) {
    get_template_part('template-parts/archive', 'service');
} else if ($term->term_id == 4) {
    get_template_part('template-parts/archive', 'project');
} else if ($term->term_id == 5 || $term->term_id == 6 || $term->term_id == 7 || $term->term_id == 8 || $term->term_id == 9) {
    get_template_part('template-parts/archive', 'project-children');
} else {
    get_template_part('template-parts/archive', 'post');
}
get_footer();
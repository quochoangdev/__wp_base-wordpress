<?php

/**
 * @param array $args
 * @param int $args['levels']
 */

// $args = array(
//   'levels' => 1 | 2,
// );
// get_template_part('woocommerce/common/sidebar-product-category', null, $args);
?>

<?php $levels = isset($args['levels']) ? $args['levels'] : 1; ?>

<div class="bg-light-gray rounded-xl shadow">
    <h3 class="bg-primary text-white px-4 py-2 rounded-t-xl font-medium">DANH MỤC SẢN PHẨM</h3>
    <div class="p-4">
        <?php
        $terms = get_terms([
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'parent' => 0,
        ]);

        foreach ($terms as $term) {
            $term_link = get_term_link($term->term_id, 'product_cat');
            echo '<a href="' . esc_url($term_link) . '" class="block py-1 hover:text-primary hover:underline transition-all duration-300">
                    <span>' . esc_html($term->name) . '</span>
                  </a>';

            if ($levels == 2) {
                $child_terms = get_terms([
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                    'parent' => $term->term_id,
                ]);

                foreach ($child_terms as $child_term) {
                    $child_term_link = get_term_link($child_term->term_id, 'product_cat');
                    echo '<a href="' . esc_url($child_term_link) . '" class="block py-1 ml-4 hover:text-primary hover:underline transition-all duration-300">
                            <span>• ' . esc_html($child_term->name) . '</span>
                          </a>';
                }
            }
        }
        ?>
    </div>
</div>
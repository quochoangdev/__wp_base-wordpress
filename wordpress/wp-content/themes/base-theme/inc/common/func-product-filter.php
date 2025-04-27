<?php

// Using pre_get_posts to filter the products
add_action('pre_get_posts', function ($query) use ($product_filter) {
    $product_filter = array();

    if (isset($_GET['cs-product_cat'])) {
        $product_filter['product_cat'] = $_GET['cs-product_cat'];
    }

    if (isset($_GET['cs-brand'])) {
        $product_filter['brand'] = $_GET['cs-brand'];
    }

    if (isset($_GET['cs-search'])) {
        $product_filter['search'] = $_GET['cs-search'];
    }

    if (isset($_GET['min_price'])) {
        $product_filter['min_price'] = $_GET['min_price'];
    }

    if (isset($_GET['max_price'])) {
        $product_filter['max_price'] = $_GET['max_price'];
    }

    if (!is_admin() && $query->is_main_query()) {
        $tax_query = array('relation' => 'AND');
        $meta_query = array('relation' => 'AND');

        // Set the search filter
        if (isset($product_filter['search'])) {
            $query->set('s', $product_filter['search']);
        }

        // Set the product_cat filter
        if (isset($product_filter['product_cat'])) {
            $tax_query[] = array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $product_filter['product_cat'],
                'operator' => 'IN',
            );
        }

        // Set the brand filter
        if (isset($product_filter['brand'])) {
            $tax_query[] = array(
                'taxonomy' => 'product_brand',
                'field' => 'term_id',
                'terms' => $product_filter['brand'],
            );
        }

        // Apply tax query if we have any taxonomy filters
        if (count($tax_query) > 1) { // More than just the 'relation' element
            $query->set('tax_query', $tax_query);
        }

        // Set the min_price filter
        if (isset($product_filter['min_price'])) {
            $meta_query[] = array(
                'key' => '_price',
                'value' => $product_filter['min_price'],
                'compare' => '>=',
                'type' => 'NUMERIC',
            );
        }

        // Set the max_price filter
        if (isset($product_filter['max_price'])) {
            $meta_query[] = array(
                'key' => '_price',
                'value' => $product_filter['max_price'],
                'compare' => '<=',
                'type' => 'NUMERIC',
            );
        }

        // Apply meta query if we have any meta filters
        if (count($meta_query) > 1) { // More than just the 'relation' element
            $query->set('meta_query', $meta_query);
        }

        // Sort products
        if (!empty($_GET['orderby'])) {
            switch ($_GET['orderby']) {
                case 'price-asc':
                    $query->set('orderby', 'meta_value_num');
                    $query->set('meta_key', '_price');
                    $query->set('order', 'ASC');
                    break;

                case 'price-desc':
                    $query->set('orderby', 'meta_value_num');
                    $query->set('meta_key', '_price');
                    $query->set('order', 'DESC');
                    break;

                case 'newest':
                    $query->set('orderby', 'date');
                    $query->set('order', 'DESC');
                    break;

                case 'oldest':
                    $query->set('orderby', 'date');
                    $query->set('order', 'ASC');
                    break;

                case 'name-asc':
                    $query->set('orderby', 'title');
                    $query->set('order', 'ASC');
                    break;

                case 'name-desc':
                    $query->set('orderby', 'title');
                    $query->set('order', 'DESC');
                    break;

                case 'rating':
                    $query->set('orderby', 'rating');
                    break;
            }
        }
    }
});

// Search by title
if (!function_exists('haru_search_by_title')) {
    function haru_search_by_title($search, $wp_query)
    {
        if (!empty($search) && !empty($wp_query->query_vars['search_terms'])) {
            global $wpdb;
            $q = $wp_query->query_vars;
            $n = !empty($q['exact']) ? '' : '%';
            $search = array();
            foreach ((array)$q['search_terms'] as $term)
                $search[] = $wpdb->prepare("$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like($term) . $n);
            if (!is_user_logged_in())
                $search[] = "$wpdb->posts.post_password = ''";
            $search = ' AND ' . implode(' AND ', $search);
        }
        return $search;
    }
    add_filter('posts_search', 'haru_search_by_title', 10, 2);
}
?>
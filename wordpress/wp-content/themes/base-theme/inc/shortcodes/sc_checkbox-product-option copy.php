<?php
// id_render_ajax: id của div chứa danh sách kết quả tìm kiếm
// id_select_product_cat: id của select danh mục sản phẩm
// taxonomy: tên taxonomy
// cs-query-param: tên query param
// Ví dụ:
// [custom_checkbox_product_option id_render_ajax="..." id_select_product_cat="..." taxonomy="product_brand" cs-query-param="cs-brand"]
?>
<?php
function custom_checkbox_product_option_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'id_render_ajax' => $atts['id_render_ajax'] ?? '',
        'id_checkbox_product_option' => $atts['id_checkbox_product_option'] ?? '',
        // taxonomy: tên taxonomy
        'taxonomy' => $atts['taxonomy'] ?? '',
        'cs-query-param' => $atts['cs-query-param'] ?? '',
    ), $atts, 'custom_checkbox_product_option');
    ob_start();
?>
    <form id="<?= esc_attr($atts['id_checkbox_product_option']) ?>" class="p-2 lg:p-4 space-x-1 lg:space-y-2">
        <?php
        $terms = get_terms([
            'taxonomy' => $atts['taxonomy'],
            'hide_empty' => false,
            'parent' => 0,
        ]);
        foreach ($terms as $term) {
            $selected_categories = isset($_GET[$atts['cs-query-param']]) ? explode(',', $_GET[$atts['cs-query-param']]) : [];
            $checked = in_array($term->term_id, $selected_categories) ? 'checked' : '';
            echo '<label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="product_cat[]" value="' . esc_attr($term->term_id) . '" ' . $checked . '>
                    <span class="text-sm lg:text=base">' . esc_html($term->name) . '</span>
                </label>';
        }
        ?>
    </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryFormMobile = document.querySelector('#<?= esc_attr($atts['id_checkbox_product_option']) ?>');
            categoryFormMobile.addEventListener('change', handleCategoryFilterMobile);
            categoryFormMobile.addEventListener('click', function(e) {
                if (e.target.type === 'checkbox') {
                    handleCategoryFilterMobile();
                }
            });

            function handleCategoryFilterMobile() {
                const selectedCategories = [];
                const checkboxes = document.querySelectorAll('#<?= esc_attr($atts['id_checkbox_product_option']) ?> input[name="product_cat[]"]');

                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        selectedCategories.push(checkbox.value);
                    }
                });
                const url = new URL(window.location.href);
                if (selectedCategories.length > 0) {
                    url.searchParams.set('<?= esc_attr($atts['cs-query-param']) ?>', selectedCategories.join(','));
                } else {
                    url.searchParams.delete('<?= esc_attr($atts['cs-query-param']) ?>');
                }
                window.history.replaceState({}, '', url);

                const productList = document.querySelector('#<?= esc_attr($atts['id_render_ajax']) ?>');
                productList.innerHTML = '<div class="flex items-center justify-center h-full"><div class="w-10 h-10 border-t-2 border-b-2 border-primary rounded-full animate-spin"></div></div>';
                fetch(url)
                    .then(response => response.text())
                    .then(data => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');
                        const newProductList = doc.getElementById('<?= esc_attr($atts['id_render_ajax']) ?>').innerHTML;

                        productList.innerHTML = newProductList;
                    });
            }
        });
        // document.addEventListener('DOMContentLoaded', function() {
        //     const allCheckboxes = document.querySelectorAll('.bg-light-gray input[type="checkbox"]');
        //     allCheckboxes.forEach(function(checkbox) {
        //         checkbox.addEventListener('touchend', function(e) {
        //             e.preventDefault();
        //             this.checked = !this.checked;
        //             const changeEvent = new Event('change', {
        //                 bubbles: true
        //             });
        //             this.dispatchEvent(changeEvent);
        //         });
        //     });

        //     const sidebarFilter = document.querySelector('#sidebar-filter-mobile');
        //     const overlaySidebarFilter = document.querySelector('#overlay-sidebar-filter-mobile');
        //     const closeSidebarFilter = document.querySelector('#close-sidebar-filter-mobile');
        //     const showSidebarFilter = document.querySelector('#show-sidebar-filter-mobile');
        //     const sidebarContent = sidebarFilter.querySelector('.space-y-3');

        //     document.addEventListener('click', function(e) {
        //         const isOverlay = e.target.closest('#overlay-sidebar-filter-mobile');
        //         const isCloseButton = e.target.closest('#close-sidebar-filter-mobile');

        //         if (isOverlay || isCloseButton) {
        //             e.preventDefault();
        //             const sidebarFilter = document.querySelector('#sidebar-filter-mobile');
        //             const sidebarContent = sidebarFilter.querySelector('.space-y-3');
        //             document.body.style.overflow = 'auto';
        //             sidebarFilter.style.display = 'none';
        //             sidebarContent.classList.add('-translate-x-full');
        //         }
        //     });
        //     document.addEventListener('click', function(e) {
        //         const filterButton = e.target.closest('#show-sidebar-filter-mobile');

        //         if (filterButton) {
        //             e.preventDefault();
        //             const sidebarFilter = document.querySelector('#sidebar-filter-mobile');
        //             const sidebarContent = sidebarFilter.querySelector('.space-y-3');
        //             sidebarFilter.style.display = 'block';
        //             document.body.style.overflow = 'hidden';
        //             setTimeout(() => {
        //                 sidebarContent.classList.remove('-translate-x-full');
        //             }, 10);
        //         }
        //     });
        // });
    </script>
<?php
    return ob_get_clean();
}
add_shortcode('custom_checkbox_product_option', 'custom_checkbox_product_option_shortcode');

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
    }
});
?>




<?php
// [custom_product_sort_dropdown id_render_ajax="..." id_select_product_sort="..."]
// id_render_ajax: id của div chứa danh sách kết quả tìm kiếm
// id_select_product_sort: id của select danh mục sản phẩm

// <?php echo do_shortcode('[custom_product_sort_dropdown id_render_ajax="search-id-render-ajax-1" id_select_product_sort="search-id-select-product-sort-1"]'); 
?>
<?php
function custom_product_sort_dropdown_shortcode($atts)
{
  $atts = shortcode_atts(array(
    'id_render_ajax' => $atts['id_render_ajax'] ?? '',
    'id_select_product_sort' => $atts['id_select_product_sort'] ?? '',
  ), $atts, 'custom_product_sort_dropdown');

  ob_start();
?>
  <form method="GET" class="w-full">
    <div class="relative">
      <select id="<?= esc_attr($atts['id_select_product_sort']) ?>" name="orderby" class="appearance-none border border-[#B6B6B6] rounded-[35px] py-2 md:py-[10px] pl-6 pr-10 w-full outline-none">
        <option value="">Thứ tự mặc định</option>
        <option value="newest" <?= selected($_GET['orderby'] ?? '', 'newest', false) ?>>Mới nhất</option>
        <option value="oldest" <?= selected($_GET['orderby'] ?? '', 'oldest', false) ?>>Cũ nhất</option>
        <option value="price-asc" <?= selected($_GET['orderby'] ?? '', 'price-asc', false) ?>>Giá tăng dần</option>
        <option value="price-desc" <?= selected($_GET['orderby'] ?? '', 'price-desc', false) ?>>Giá giảm dần</option>
        <option value="name-asc" <?= selected($_GET['orderby'] ?? '', 'name-asc', false) ?>>Tên A → Z</option>
        <option value="name-desc" <?= selected($_GET['orderby'] ?? '', 'name-desc', false) ?>>Tên Z → A</option>
        <!-- <option value="rating" <?= selected($_GET['orderby'] ?? '', 'rating', false) ?>>Đánh giá cao nhất</option> -->
      </select>
      <div class="pointer-events-none absolute inset-y-0 right-6 flex items-center">
        <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M7.22954 7.22183C6.83446 7.64324 6.16554 7.64324 5.77046 7.22183L0.578695 1.68394C-0.0200542 1.04528 0.432791 -2.32409e-07 1.30823 -1.55875e-07L11.6918 7.51882e-07C12.5672 8.28416e-07 13.0201 1.04528 12.4213 1.68394L7.22954 7.22183Z" fill="#555555" />
        </svg>
      </div>
    </div>
  </form>

  <script>
    document.body.addEventListener('change', function(e) {
      if (e.target && e.target.id === '<?= esc_js($atts['id_select_product_sort']) ?>') {
        const selectedOrderby = e.target.value;
        const url = new URL(window.location.href);

        if (selectedOrderby) {
          url.searchParams.set('orderby', selectedOrderby);
        } else {
          url.searchParams.delete('orderby');
        }
        window.history.replaceState({}, '', url);

        const productList = document.querySelector('#<?= esc_js($atts['id_render_ajax']) ?>');
        if (productList) {
          productList.innerHTML = '<div class="flex items-center justify-center h-full"><div class="w-10 h-10 border-t-2 border-b-2 border-primary rounded-full animate-spin"></div></div>';
          fetch(url)
            .then(response => response.text())
            .then(data => {
              const parser = new DOMParser();
              const doc = parser.parseFromString(data, 'text/html');
              const newProductList = doc.getElementById('<?= esc_js($atts['id_render_ajax']) ?>')?.innerHTML;

              if (newProductList) {
                productList.innerHTML = newProductList;
              }
            });
        }
      }
    });
  </script>
<?php
  return ob_get_clean();
}
add_shortcode('custom_product_sort_dropdown', 'custom_product_sort_dropdown_shortcode');

?>
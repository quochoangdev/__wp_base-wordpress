<?php

/**
 * @param array $args
 * @param array $args['ids_data']
 * @param string $args['ids_data']['id_render_ajax']
 * @param string $args['ids_data']['id_select_product_cat']
 */

// $args = array(
//   'ids_data' => array(
//     'id_render_ajax' => 'product-list-no-sidebar',
//     'id_select_product_cat' => 'select-product-cat_1',
//   ),
// );
// get_template_part('woocommerce/common/select-category', null, $args);
?>

<?php $ids_data = isset($args['ids_data']) ? $args['ids_data'] : ''; ?>

<form method="GET" class="w-full">
  <div class="relative">
    <select name="product_cat" id="<?= $ids_data['id_select_product_cat'] ?>" class="appearance-none border border-[#B6B6B6] rounded-[35px] py-2 md:py-[10px] pl-6 pr-10 w-full outline-none">
      <!-- Add default option for "Danh mục sản phẩm" -->
      <option value=""><?php echo esc_html('Danh mục sản phẩm'); ?></option>

      <?php
      $terms = get_terms([
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'parent' => 0,
      ]);

      $selected_category = isset($_GET['cs-product_cat']) ? $_GET['cs-product_cat'] : '';

      foreach ($terms as $term) {
        echo '<option value="' . $term->term_id . '" ' . selected($selected_category, $term->term_id, false) . '>' . esc_html($term->name) . '</option>';
      }
      ?>
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
    if (e.target && e.target.id === '<?= $ids_data['id_select_product_cat'] ?>') {
      const selectedOrderby = e.target.value;

      const url = new URL(window.location.href);
      if (selectedOrderby) {
        url.searchParams.set('cs-product_cat', selectedOrderby);
      } else {
        url.searchParams.delete('cs-product_cat');
      }
      window.history.replaceState({}, '', url);

      const productList = document.querySelector('#<?= $ids_data['id_render_ajax'] ?>');
      productList.innerHTML = '<div class="flex items-center justify-center h-full"><div class="w-10 h-10 border-t-2 border-b-2 border-primary rounded-full animate-spin"></div></div>';
      fetch(url)
        .then(response => response.text())
        .then(data => {
          const parser = new DOMParser();
          const doc = parser.parseFromString(data, 'text/html');
          const newProductList = doc.getElementById('<?= $ids_data['id_render_ajax'] ?>').innerHTML;

          productList.innerHTML = newProductList;
        });
    }
  });
</script>
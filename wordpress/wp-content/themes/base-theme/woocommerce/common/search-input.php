<?php
/**
 * @param array $args
 * @param array $args['ids_data']
 * @param string $args['ids_data']['id_render_ajax']
 * @param string $args['ids_data']['id_input_search']
 * @param string $args['ids_data']['id_button_search']
 */

// $args = array(
//   'ids_data' => array(
//     'id_render_ajax' => 'product-list-no-sidebar',
//     'id_input_search' => 'search-input_1',
//     'id_button_search' => 'search-button_1',
//   ),
// );
// get_template_part('woocommerce/common/search-input', null, $args);
?>

<?php $ids_data = isset($args['ids_data']) ? $args['ids_data'] : ''; ?>

<form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="get" class="relative">
  <input id="<?= $ids_data['id_input_search'] ?>" name="cs-search" type="text" class="w-full border border-primary rounded-[46px] bg-primary/15 py-[10px] pl-12 pr-10 placeholder:text-[#777777] placeholder:font-regular placeholder:text-sm" placeholder="Tìm kiếm: Thời trang nam, Thời trang nữ, Balo, túi xách...">
  <button id="<?= $ids_data['id_button_search'] ?>" type="submit" class="absolute left-3 top-1/2 -translate-y-1/2 bg-primary text-white rounded-full p-1 hover:bg-primary/80 transition-all duration-300 cursor-pointer">
    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
    </svg>
  </button>
</form>

<script>
  const searchInput = document.getElementById('<?= $ids_data['id_input_search'] ?>');
  const searchButton = document.getElementById('<?= $ids_data['id_button_search'] ?>');

  function handleSearch() {
    const searchTerm = searchInput.value.trim();
    const url = new URL(window.location.href);

    if (searchTerm.length > 0) {
      url.searchParams.set('cs-search', searchTerm);
    } else {
      url.searchParams.delete('cs-search');
    }

    window.history.replaceState({}, '', url);

    const productList = document.querySelector('#<?= $ids_data['id_render_ajax'] ?>');
    if (productList) {
      productList.innerHTML = '<div class="flex items-center justify-center h-full"><div class="w-10 h-10 border-t-2 border-b-2 border-primary rounded-full animate-spin"></div></div>';

      fetch(url)
        .then(response => response.text())
        .then(data => {
          const parser = new DOMParser();
          const doc = parser.parseFromString(data, 'text/html');
          const newProductList = doc.getElementById('<?= $ids_data['id_render_ajax'] ?>');

          if (newProductList) {
            productList.innerHTML = newProductList.innerHTML;
          }
        })
        .catch(error => {
          console.error('Search error:', error);
          productList.innerHTML = '<div class="text-center py-4">Có lỗi xảy ra khi tìm kiếm. Vui lòng thử lại.</div>';
        });
    }
  }

  searchButton.addEventListener('click', function(e) {
    e.preventDefault();
    handleSearch();
  });
  searchInput.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
      e.preventDefault();
      handleSearch();
    }
  });
</script>
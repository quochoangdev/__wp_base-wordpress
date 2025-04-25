<!-- Sidebar filter -->
<div id="sidebar-filter-mobile" class="hidden fixed top-0 bottom-0 left-0 right-0 z-[999] lg:block lg:static bg-black/60">
    <div class="flex flex-row h-full">
        <div class="space-y-3 h-full w-3/4 bg-light-gray lg:w-full transform -translate-x-full transition-transform duration-300 ease-in-out lg:transform-none">
            <!-- Danh mục sản phẩm -->
            <div class="bg-light-gray">
                <h3 class="bg-primary text-white text-sm lg:text-base px-4 py-2 lg:rounded-t-xl font-medium">DANH MỤC SẢN PHẨM MOBILE</h3>
                <form id="category-filter-mobile" class="p-2 lg:p-4 space-y-2">
                    <?php
                    $terms = get_terms([
                        'taxonomy' => 'product_cat',
                        'hide_empty' => false,
                        'parent' => 0,
                    ]);

                    foreach ($terms as $term) {
                        $selected_categories = isset($_GET['cs-product_cat']) ? explode(',', $_GET['cs-product_cat']) : [];
                        $checked = in_array($term->term_id, $selected_categories) ? 'checked' : '';
                        echo '<label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="product_cat[]" value="' . $term->term_id . '" ' . $checked . '>
                        <span class="text-sm lg:text=base">' . esc_html($term->name) . '</span>
                    </label>';
                    }
                    ?>
                </form>
            </div>

            <!-- Thương hiệu -->
            <div class="bg-light-gray">
                <h3 class="bg-primary text-white text-sm lg:text-base px-4 py-2 lg:rounded-t-xl font-medium">THƯƠNG HIỆU</h3>
                <form id="brand-filter-mobile" class="p-2 lg:p-4 space-y-2">
                    <?php
                    $brands = get_terms([
                        'taxonomy' => 'product_brand',
                        'hide_empty' => false,
                        'parent' => 0,
                    ]);

                    foreach ($brands as $brand) {
                        $selected_brands = isset($_GET['cs-brand']) ? explode(',', $_GET['cs-brand']) : [];
                        $checked = in_array($brand->term_id, array_map('intval', $selected_brands)) ? 'checked' : '';
                        echo '<label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="brand[]" value="' . $brand->term_id . '" ' . $checked . '>
                        <span class="text-sm lg:text=base">' . esc_html($brand->name) . '</span>
                    </label>';
                    }
                    ?>
                </form>
            </div>

            <!-- Giá -->
            <div class="bg-light-gray">
                <h3 class="bg-primary text-white text-sm lg:text-base px-4 py-2 lg:rounded-t-xl font-medium">GIÁ</h3>
                <form id="price-filter-mobile" class="p-2 lg:p-4 space-y-1 lg:space-y-2">
                    <?php
                    $price_ranges = [
                        [
                            'min' => 0,
                            'max' => 500000,
                            'label' => '0đ - 500.000đ'
                        ],
                        [
                            'min' => 500000,
                            'max' => 1000000,
                            'label' => '500.000đ - 1.000.000đ'
                        ],
                        [
                            'min' => 1000000,
                            'max' => 1500000,
                            'label' => '1.000.000đ - 1.500.000đ'
                        ],
                        [
                            'min' => 1500000,
                            'max' => 2000000,
                            'label' => '1.500.000đ - 2.000.000đ'
                        ],
                    ];

                    // Get all selected price ranges from URL
                    $selected_price_ranges = [];
                    if (isset($_GET['min_price']) && isset($_GET['max_price'])) {
                        $min_price = intval($_GET['min_price']);
                        $max_price = intval($_GET['max_price']);

                        // Check each price range to see if it falls within the selected min/max
                        foreach ($price_ranges as $range) {
                            if ($range['min'] >= $min_price && $range['max'] <= $max_price) {
                                $selected_price_ranges[] = $range['min'] . '-' . $range['max'];
                            }
                        }
                    }

                    foreach ($price_ranges as $range) {
                        $min = $range['min'];
                        $max = $range['max'];
                        $label = $range['label'];
                        $range_value = $min . '-' . $max;
                        $checked = in_array($range_value, $selected_price_ranges) ? 'checked' : '';

                        echo '<label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="price_range" value="' . $range_value . '" ' . $checked . ' data-min="' . $min . '" data-max="' . $max . '">
                        <span class="text-sm lg:text=base">' . $label . '</span>
                    </label>';
                    }
                    ?>
                </form>
            </div>
        </div>
        <!-- overlay sidebar filter -->
        <div id="overlay-sidebar-filter-mobile" class="w-1/4 h-auto lg:hidden"></div>
        <!-- close sidebar filter -->
        <button id="close-sidebar-filter-mobile" class="absolute top-4 right-4 text-white text-3xl hover:text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

<!-- Script to handle the price filter -->
<script>
    const priceFormMobile = document.querySelector('#price-filter-mobile');

    // Use both change and click events to ensure mobile compatibility
    priceFormMobile.addEventListener('change', handlePriceFilterMobile);
    priceFormMobile.addEventListener('click', function(e) {
        if (e.target.type === 'checkbox') {
            handlePriceFilterMobile();
        }
    });

    function handlePriceFilterMobile() {
        const selectedPriceRanges = [];
        const checkboxes = document.querySelectorAll('#price-filter-mobile input[name="price_range"]');

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                const [min, max] = checkbox.value.split('-').map(Number);
                selectedPriceRanges.push({
                    min,
                    max
                });
            }
        });

        const url = new URL(window.location.href);
        if (selectedPriceRanges.length > 0) {
            url.searchParams.set('min_price', selectedPriceRanges[0].min);
            url.searchParams.set('max_price', selectedPriceRanges[selectedPriceRanges.length - 1].max);
        } else {
            url.searchParams.delete('min_price');
            url.searchParams.delete('max_price');
        }
        window.history.replaceState({}, '', url);

        const productList = document.querySelector('#product-list');
        productList.innerHTML = '<div class="flex items-center justify-center h-full"><div class="w-10 h-10 border-t-2 border-b-2 border-primary rounded-full animate-spin"></div></div>';
        fetch(url)
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(data, 'text/html');
                const newProductList = doc.getElementById('product-list').innerHTML;

                productList.innerHTML = newProductList;
            });
    }
</script>

<!-- Script to handle the category filter -->
<script>
    const categoryFormMobile = document.querySelector('#category-filter-mobile');

    // Use both change and click events to ensure mobile compatibility
    categoryFormMobile.addEventListener('change', handleCategoryFilterMobile);
    categoryFormMobile.addEventListener('click', function(e) {
        if (e.target.type === 'checkbox') {
            handleCategoryFilterMobile();
        }
    });

    function handleCategoryFilterMobile() {
        const selectedCategories = [];
        const checkboxes = document.querySelectorAll('#category-filter-mobile input[name="product_cat[]"]');

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                selectedCategories.push(checkbox.value);
            }
        });

        const url = new URL(window.location.href);
        if (selectedCategories.length > 0) {
            url.searchParams.set('cs-product_cat', selectedCategories.join(','));
        } else {
            url.searchParams.delete('cs-product_cat');
        }
        window.history.replaceState({}, '', url);

        const productList = document.querySelector('#product-list');
        productList.innerHTML = '<div class="flex items-center justify-center h-full"><div class="w-10 h-10 border-t-2 border-b-2 border-primary rounded-full animate-spin"></div></div>';
        fetch(url)
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(data, 'text/html');
                const newProductList = doc.getElementById('product-list').innerHTML;

                productList.innerHTML = newProductList;
            });
    }
</script>

<!-- Script to handle the brand filter -->
<script>
    const brandFormMobile = document.querySelector('#brand-filter-mobile');

    // Use both change and click events to ensure mobile compatibility
    brandFormMobile.addEventListener('change', handleBrandFilterMobile);
    brandFormMobile.addEventListener('click', function(e) {
        if (e.target.type === 'checkbox') {
            handleBrandFilterMobile();
        }
    });

    function handleBrandFilterMobile() {
        const selectedBrands = [];
        const checkboxes = document.querySelectorAll('#brand-filter-mobile input[name="brand[]"]');

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                selectedBrands.push(checkbox.value);
            }
        });

        const url = new URL(window.location.href);
        if (selectedBrands.length > 0) {
            url.searchParams.set('cs-brand', selectedBrands.join(','));
        } else {
            url.searchParams.delete('cs-brand');
        }
        window.history.replaceState({}, '', url);

        const productList = document.querySelector('#product-list');
        productList.innerHTML = '<div class="flex items-center justify-center h-full"><div class="w-10 h-10 border-t-2 border-b-2 border-primary rounded-full animate-spin"></div></div>';
        fetch(url)
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(data, 'text/html');
                const newProductList = doc.getElementById('product-list').innerHTML;

                productList.innerHTML = newProductList;
            });
    }
</script>

<!-- Add touch compatibility script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add touch event handlers for all checkboxes in the sidebar
        const allCheckboxes = document.querySelectorAll('.bg-light-gray input[type="checkbox"]');
        allCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('touchend', function(e) {
                // Prevent double-triggering with click events
                e.preventDefault();
                // Toggle the checkbox state
                this.checked = !this.checked;
                // Trigger the change event manually
                const changeEvent = new Event('change', {
                    bubbles: true
                });
                this.dispatchEvent(changeEvent);
            });
        });
    });
</script>

<!-- Script to query id sidebar-filter -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarFilter = document.querySelector('#sidebar-filter-mobile');
        const overlaySidebarFilter = document.querySelector('#overlay-sidebar-filter-mobile');
        const closeSidebarFilter = document.querySelector('#close-sidebar-filter-mobile');
        const showSidebarFilter = document.querySelector('#show-sidebar-filter-mobile');
        const sidebarContent = sidebarFilter.querySelector('.space-y-3');

        // Use event delegation for closing the sidebar
        document.addEventListener('click', function(e) {
            // Check if the click was on the overlay or close button
            const isOverlay = e.target.closest('#overlay-sidebar-filter-mobile');
            const isCloseButton = e.target.closest('#close-sidebar-filter-mobile');
            
            if (isOverlay || isCloseButton) {
                e.preventDefault();
                // Get the sidebar elements each time to ensure we have the latest DOM references
                const sidebarFilter = document.querySelector('#sidebar-filter-mobile');
                const sidebarContent = sidebarFilter.querySelector('.space-y-3');
                
                document.body.style.overflow = 'auto';
                sidebarFilter.style.display = 'none';
                sidebarContent.classList.add('-translate-x-full');
            }
        });

        // Use event delegation on document to handle clicks on the filter button
        document.addEventListener('click', function(e) {
            // Find the closest button with the ID or the button itself
            const filterButton = e.target.closest('#show-sidebar-filter-mobile');
            
            if (filterButton) {
                e.preventDefault();
                // Get the sidebar elements each time to ensure we have the latest DOM references
                const sidebarFilter = document.querySelector('#sidebar-filter-mobile');
                const sidebarContent = sidebarFilter.querySelector('.space-y-3');
                
                sidebarFilter.style.display = 'block';
                document.body.style.overflow = 'hidden';
                
                // Trigger animation after a small delay to ensure display:block has taken effect
                setTimeout(() => {
                    sidebarContent.classList.remove('-translate-x-full');
                }, 10);
            }
        });
    });
</script>
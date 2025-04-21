<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined('ABSPATH') || exit();

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if (!is_a($product, WC_Product::class) || !$product->is_visible()) {
  return;
}
?>

<li <?php wc_product_class(
  'custom-product-item col-span-12 lg:col-span-3 group transition-all duration-300 relative flex flex-col bg-white'
); ?>>
    <!-- Hover Add to Cart Icon -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
        <button class="bg-white/80 border border-[#D9D9D9] w-12 h-12 rounded-full flex items-center justify-center">
            <?php woocommerce_template_loop_add_to_cart(); ?>
        </button>
    </div>
    <?php
    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10
     */
    do_action('woocommerce_before_shop_loop_item');

    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked woocommerce_show_product_loop_sale_flash - 10
     * @hooked woocommerce_template_loop_product_thumbnail - 10
     */
    do_action('woocommerce_before_shop_loop_item_title');
    ?>

    <!-- display sale percent -->
    <?php if ($product->is_on_sale()): ?>
        <div class="absolute top-2 right-2 bg-[#DB1907] text-white text-xs font-regular border border-none rounded-tl-full rounded-bl-full rounded-br-full w-9 h-9 flex items-center justify-center">
            <?php
            $regular_price = $product->get_regular_price();
            $sale_price = $product->get_sale_price();
            $sale_percent = round((($regular_price - $sale_price) / $regular_price) * 100);
            echo '-' . $sale_percent . '%';
            ?>
        </div>
    <?php endif; ?>

    <div class="px-4 py-3 flex flex-col gap-3 flex-grow">
        <?php
        /**
         * Hook: woocommerce_shop_loop_item_title.
         *
         * @hooked woocommerce_template_loop_product_title - 10
         */
        do_action('woocommerce_shop_loop_item_title');

        /**
         * Hook: woocommerce_after_shop_loop_item_title.
         *
         * @hooked woocommerce_template_loop_rating - 5
         * @hooked woocommerce_template_loop_price - 10
         */
        do_action('woocommerce_after_shop_loop_item_title');
        ?>
    </div>

     /**
 * Hook: woocommerce_after_shop_loop_item.
 *
 * @hooked woocommerce_template_loop_product_link_close - 5
 * @hooked woocommerce_template_loop_add_to_cart - 10
 */<?php do_action('woocommerce_after_shop_loop_item'); ?>
</li>


<style>
    /* Title Product */
    h1.woocommerce-products-header__title.page-title {
        width: fit-content;
        font-size: 32px;
        font-weight: bold;
        color: #1176A8;
        position: relative;
        flex-grow: 1;
    }

    h1.woocommerce-products-header__title.page-title::before {
        position: absolute;
        content: '';
        display: block;
        width: 62px;
        height: 4px;
        background-color: #3AA7DD;
        top: 50%;
        transform: translateY(-50%);
        left: calc(100% + 10px);
    }
</style>


<style>
    /* Product item */
    .custom-product-item {
        display: flex;
        width: 100%;
        height: 100%;
        border: 1px solid #DCDCDC;
        border-radius: 10px;
        box-shadow: 2px 2px 16px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    a.woocommerce-LoopProduct-link.woocommerce-loop-product__link {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    /* Product title */
    .woocommerce-loop-product__title {
        font-size: 16px;
        font-weight: 500;
        color: #333333;
        flex-grow: 1;
    }

    .woocommerce-loop-product__title:hover {
        text-decoration: underline;
    }

    /* Product price */
    .price {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        background-color: rgba(17, 118, 168, 0.1);
        padding: 12px;
        border-radius: 5px;
    }

    .price ins {
        text-decoration: none;
        order: 1;
    }

    .price del {
        order: 2;
    }

    .price bdi {
        color: #DB1907;
        font-size: 17px;
        font-weight: 600;
    }

    .price ins bdi {
        color: #DB1907;
        font-size: 17px;
        font-weight: 600;
        text-decoration: none;
    }

    .price del bdi {
        color: #575757;
        font-size: 14px;
        text-decoration: none;
    }


    /* Custom add to cart button */
    a.added_to_cart.wc-forward {
        display: none;
    }

    a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart {
        background-color: transparent;
        border: none;
    }

    a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart.added {
        background-color: transparent;
        border: none;
    }

    a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart.added:after {
        margin: 0;
    }

    a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart.added svg {
        display: none;
    }

    a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart.loading {
        background-color: transparent;
        border: none;
    }

    a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart.loading svg {
        display: none;
    }

    a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart.loading:after {
        top: 10%;
        right: 37%;
    }

    img.attachment-woocommerce_thumbnail.size-woocommerce_thumbnail {
        width: 100%;
        object-fit: cover;
    }
</style>
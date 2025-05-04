<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header('shop');
?>

<section class="">
	<?php echo do_shortcode('[custom_search_input id_render_ajax="search-id-render-ajax-1" id_input_search="search-id-input-search-1" id_button_search="search-id-button-search-1"]'); ?>
	<?php echo do_shortcode('[custom_select_category id_render_ajax="search-id-render-ajax-1" id_select_product_cat="category-id-select-product-cat-1"]'); ?>
	<?php echo do_shortcode('[custom_select_product_sort id_render_ajax="search-id-render-ajax-1" id_select_product_sort="sort-id-select-product-sort-1"]'); ?>

	<?php echo do_shortcode('[custom_checkbox_product_option id_render_ajax="search-id-render-ajax-1" id_checkbox_product_option="category-id-select-product-option-2" taxonomy="product_cat" cs-query-param="cs-product-cat"]'); ?>
	<?php echo do_shortcode('[custom_checkbox_product_option id_render_ajax="search-id-render-ajax-1" id_checkbox_product_option="category-id-select-product-option-1" taxonomy="product_brand" cs-query-param="cs-brand"]'); ?>

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
get_footer('shop');
?>
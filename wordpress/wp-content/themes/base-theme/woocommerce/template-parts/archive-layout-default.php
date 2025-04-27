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
<div class="bg-light-gray">
	<div class="container mx-auto px-4">
		<?php
		/**
		 * Hook: woocommerce_before_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 * @hooked WC_Structured_Data::generate_website_data() - 30
		 */
		do_action('woocommerce_before_main_content');
		?>
		<div class="lg:px-5 lg:py-7 lg:bg-white rounded-xl shadow-standard">
			<div class="grid grid-cols-12 gap-7">
				<!-- Sidebar -->
				<aside class="hidden lg:block col-span-12 lg:col-span-3">
					<?php wc_get_template_part('common/sidebar-product-filter-desktop'); ?>
				</aside>
				<aside class="absolute lg:hidden col-span-12 lg:col-span-3">
					<?php wc_get_template_part('common/sidebar-product-filter-mobile'); ?>
				</aside>

				<!-- Product content -->
				<div id="product-list-default" class="col-span-12 lg:col-span-9">
					<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-5">
						<div>
							<?php
							/**
							 * Hook: woocommerce_shop_loop_header.
							 *
							 * @since 8.6.0
							 *
							 * @hooked woocommerce_product_taxonomy_archive_header - 10
							 */
							do_action('woocommerce_shop_loop_header');
							?>
						</div>
						<div class="flex flex-row items-center justify-between lg:block">
							<!-- Button to show sidebar filter -->
							<button id="show-sidebar-filter-mobile" class="lg:hidden flex flex-row items-center gap-2">
								<svg width="20" height="20" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1.15513 6.53422H18.7424C19.2724 8.94692 21.427 10.7582 23.9966 10.7582C26.5662 10.7582 28.7208 8.94699 29.2509 6.53422H35.8091C36.447 6.53422 36.9642 6.01701 36.9642 5.37908C36.9642 4.74116 36.447 4.22395 35.8091 4.22395H29.2503C28.7192 1.81247 26.5617 0 23.9966 0C21.4302 0 19.2736 1.81218 18.7428 4.22395H1.15513C0.51721 4.22395 0 4.74116 0 5.37908C0 6.01701 0.51721 6.53422 1.15513 6.53422ZM20.9279 5.38212L20.9279 5.3697C20.933 3.6827 22.3095 2.31033 23.9966 2.31033C25.6813 2.31033 27.0579 3.68082 27.0652 5.36703L27.0654 5.38399C27.0628 7.07388 25.6872 8.44805 23.9966 8.44805C22.3068 8.44805 20.9316 7.07525 20.9278 5.38638L20.9279 5.38212ZM35.8091 30.4657H29.2503C28.7192 28.0543 26.5617 26.2418 23.9966 26.2418C21.4302 26.2418 19.2736 28.054 18.7428 30.4657H1.15513C0.51721 30.4657 0 30.9828 0 31.6208C0 32.2588 0.51721 32.776 1.15513 32.776H18.7424C19.2724 35.1887 21.427 37 23.9966 37C26.5662 37 28.7208 35.1887 29.2509 32.776H35.8091C36.447 32.776 36.9642 32.2588 36.9642 31.6208C36.9642 30.9828 36.447 30.4657 35.8091 30.4657ZM23.9966 34.6897C22.3068 34.6897 20.9316 33.3169 20.9278 31.6281L20.9279 31.6239L20.9279 31.6115C20.933 29.9245 22.3095 28.552 23.9966 28.552C25.6813 28.552 27.0579 29.9225 27.0652 31.6086L27.0654 31.6256C27.063 33.3157 25.6873 34.6897 23.9966 34.6897ZM35.8091 17.3449H18.2218C17.6918 14.9322 15.5372 13.1209 12.9676 13.1209C10.398 13.1209 8.24338 14.9322 7.71331 17.3449H1.15513C0.51721 17.3449 0 17.8621 0 18.5C0 19.138 0.51721 19.6551 1.15513 19.6551H7.71389C8.24504 22.0665 10.4025 23.8791 12.9676 23.8791C15.534 23.8791 17.6905 22.0668 18.2214 19.6551H35.8091C36.447 19.6551 36.9642 19.138 36.9642 18.5C36.9642 17.8621 36.447 17.3449 35.8091 17.3449ZM16.0363 18.497L16.0362 18.5094C16.0312 20.1964 14.6546 21.5688 12.9676 21.5688C11.2829 21.5688 9.90626 20.1983 9.89897 18.5121L9.89875 18.4952C9.90128 16.8051 11.277 15.4312 12.9676 15.4312C14.6574 15.4312 16.0326 16.8039 16.0364 18.4929L16.0363 18.497Z" fill="#666666"></path>
								</svg>
								<strong class="uppercase md:text-lg">Lọc</strong>
							</button>
							<div class="w-fit lg:w-[270px]">
								<?php
								$args = array(
									'ids_data' => array(
										'id_render_ajax' => 'product-list-default',
										'id_select_product_sort' => 'select-product-sort_1',
									),
								);
								get_template_part('woocommerce/common/sidebar-product-sort', null, $args);
								?>
							</div>
						</div>
					</div>

					<?php
					if (woocommerce_product_loop()) {

						woocommerce_product_loop_start();

						if (wc_get_loop_prop('total')) {
							while (have_posts()) {
								the_post();

								/**
								 * Hook: woocommerce_shop_loop.
								 */
								do_action('woocommerce_shop_loop');

								wc_get_template_part('content', 'product');
							}
						}

						woocommerce_product_loop_end();

						/**
						 * Hook: woocommerce_after_shop_loop.
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action('woocommerce_after_shop_loop');
					} else {
						/**
						 * Hook: woocommerce_no_products_found.
						 *
						 * @hooked wc_no_products_found - 10
						 */
						do_action('woocommerce_no_products_found');
					}

					/**
					 * Hook: woocommerce_after_main_content.
					 *
					 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
					 */
					do_action('woocommerce_after_main_content');
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer('shop');
?>
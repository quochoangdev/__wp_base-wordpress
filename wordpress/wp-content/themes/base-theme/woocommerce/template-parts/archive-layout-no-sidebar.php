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

$term = get_queried_object();

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
		<div class="md:px-5 md:py-7 md:bg-white rounded-xl shadow-standard">

			<div class="flex flex-col lg:flex-row gap-2 lg:gap-20 mb-5 lg:mb-12">
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
				<div class="flex flex-col gap-1 lg:gap-4">
					<?php $description_below = get_field('description_below', $term); ?>
					<?php $description_above = get_field('description_above', $term); ?>
					<p class="md:text-2xl font-semibold"><?php echo $description_above; ?></p>
					<p class="md:text-lg font-regular"><?php echo $description_below; ?></p>
				</div>
			</div>

			<div id="product-list-no-sidebar" class="w-full">
				<div class="grid grid-cols-12 gap-3 mb-5 lg:mb-7">
					<!-- search input -->
					<div class="col-span-12 lg:col-span-6">
						<?php
						$args = array(
							'ids_data' => array(
								'id_render_ajax' => 'product-list-no-sidebar',
								'id_input_search' => 'search-input_1',
								'id_button_search' => 'search-button_1',
							),
						);
						get_template_part('woocommerce/common/search-input', null, $args);
						?>
					</div>
					<!-- filter -->
					<div class="col-span-6 lg:col-span-3 flex justify-center">
						<?php
						$args = array(
							'ids_data' => array(
								'id_render_ajax' => 'product-list-no-sidebar',
								'id_select_product_cat' => 'select-product-cat_1',
							),
						);
						get_template_part('woocommerce/common/select-category', null, $args);
						?>
					</div>
					<div class="col-span-6 lg:col-span-3 flex justify-center">
						<?php
						$args = array(
							'ids_data' => array(
								'id_render_ajax' => 'product-list-no-sidebar',
								'id_select_product_sort' => 'select-product-sort_2',
							),
						);
						get_template_part('woocommerce/common/sidebar-product-sort', null, $args);
						?>
					</div>
				</div>

				<!-- product list -->
				<?php get_template_part('woocommerce/common/table-product-list'); ?>

			</div>
		</div>
	</div>
</div>

<?php
echo paginate_links(array(
	'total' => $products->max_num_pages,
));
?>
<?php
get_footer('shop');
?>

<style>
	h1.woocommerce-products-header__title.page-title {
		width: fit-content;
		font-size: 32px;
		font-weight: bold;
		color: #1176A8;
		position: relative;
		flex-grow: 1;
		margin-right: 72px;
		margin-bottom: 0 !important;

		&::before {
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
	}

	@media screen and (max-width: 640px) {
		h1.woocommerce-products-header__title.page-title {
			font-size: 26px;
			font-weight: bold;
			margin-bottom: 10px !important;
		}
	}
</style>
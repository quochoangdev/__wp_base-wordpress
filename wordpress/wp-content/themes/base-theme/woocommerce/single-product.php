<?php

/**
 * The Template for displaying all single products
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header('shop'); ?>

<div class="container mx-auto px-4">
	<?php
	/**
	 * woocommerce_before_main_content hook.
	 */
	do_action('woocommerce_before_main_content');
	?>
	<div class="container mx-auto">
		<div class="grid grid-cols-12 gap-4">
			<!-- Sidebar -->
			<aside class="hidden lg:block col-span-12 lg:col-span-3">
				<?php
				$args = array('levels' => 1);
				get_template_part('woocommerce/common/sidebar-product-link-category', null, $args);
				?>
			</aside>

			<!-- Main product content -->
			<div class="col-span-12 lg:col-span-9">
				<?php while (have_posts()) : ?>
					<?php the_post(); ?>

					<?php wc_get_template_part('content', 'single-product'); ?>

				<?php endwhile; // end of the loop. 
				?>
			</div>
		</div>
	</div>

	<?php
	/**
	 * woocommerce_after_main_content hook.
	 * The related products will be displayed here via our custom function
	 */
	do_action('woocommerce_after_main_content');
	?>
</div>

<?php
get_footer('shop');
?>

<!-- single-product.php -->
<style>
	.summary.entry-summary {
		@media screen and (max-width: 1024px) {
			margin-bottom: 20px !important;
		}

		.cart {
			margin-bottom: 18px !important;
		}
	}

	.woocommerce-tabs.wc-tabs-wrapper {
		margin-bottom: 66px !important;

		@media screen and (max-width: 1024px) {
			margin-bottom: 30px !important;
		}
	}

	button.single_add_to_cart_button.button.alt {
		@media screen and (max-width: 1024px) {
			font-size: 14px !important;
			height: 44px !important;
		}
	}
</style>

<!-- content-single-product.php -->
<style>
	h1.product_title.entry-title {
		font-size: 24px;
		font-weight: 600;
		color: #333;
		margin-bottom: 10px;
		text-transform: uppercase;
	}

	h2.woocommerce-loop-product__title {
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
	}

	/* SKU and rating */
	.product-sku-rating-wrapper {
		display: flex;
		align-items: center;

		.product-sku {
			display: flex;
			align-items: center;
			margin-right: 20px;
			position: relative;
		}

		.product-sku::before {
			position: absolute;
			content: '';
			display: inline-block;
			width: 1px;
			height: 17px;
			background-color: #C9C9C9;
			right: -10px;
			top: 50%;
			transform: translateY(-50%);
		}

		.woocommerce-product-rating {
			margin-bottom: 0 !important;
			display: flex;
			align-items: center;

			.star-rating {
				margin-top: 0 !important;
				margin: 0 !important;

				span::before {
					color: #FBCA2B !important;
					width: fit-content !important;
					height: fit-content !important;
				}
			}
		}
	}

	.woocommerce-review-link {
		display: none;
	}

	p.price {
		display: none;

	}

	.price-container {

		.price {
			position: relative;
			display: flex;
			flex-direction: row;
			align-items: center;
			justify-content: start;
			background-color: rgba(17, 118, 168, 0.1);
			padding: 20px 30px;
			border-radius: 10px;
			margin-bottom: 30px;

			@media screen and (max-width: 768px) {
				padding: 16px 30px;
				margin-bottom: 16px;
			}

			ins {
				text-decoration: none;
				margin-right: 56px;
				order: 1;
			}

			bdi {
				color: #DB1907;
				font-size: 22px;
				font-weight: 700;
			}

			del {
				order: 2;
			}

			ins bdi {
				color: #DB1907;
				font-size: 22px;
				font-weight: 700;
				text-decoration: none;
			}

			del bdi {
				color: #575757 !important;
				font-size: 18px;
				font-weight: 400;
				text-decoration: none;
			}
		}
	}

	.woocommerce div.product p.price ins,
	.woocommerce div.product span.price ins {
		background-color: transparent;
	}

	.woocommerce:where(body:not(.woocommerce-uses-block-theme)) div.product p.price,
	.woocommerce:where(body:not(.woocommerce-uses-block-theme)) div.product span.price {
		color: #575757 !important;
	}

	/* Hide WooCommerce notices */
	.woocommerce-notices-wrapper {
		display: none;
	}

	/* Add to cart button */
	.single_add_to_cart_button {
		background-color: #1176A8 !important;
		color: white !important;
		margin-bottom: 10px !important;
		width: 100% !important;
		border-radius: 999px !important;
		font-size: 16px !important;
		font-weight: 500 !important;
		text-transform: uppercase !important;
		padding: 12px 0 !important;
		height: 48px !important;
		display: flex;
		align-items: center;
		justify-content: center;

		&:hover {
			opacity: 0.8 !important;
		}
	}

	/* Tabs */
	.woocommerce-tabs.wc-tabs-wrapper {
		box-shadow: 2px 2px 16px rgba(0, 0, 0, 0.1);
		border-radius: 10px;
		padding: 40px 60px;
		margin-bottom: 94px;

		@media screen and (max-width: 1024px) {
			padding: 20px 10px;
		}

		ul.tabs.wc-tabs {
			border: none;

			@media screen and (max-width: 1024px) {
				display: flex;
				margin: 0 !important;
				padding: 0 !important;
				gap: 10px;
				margin-bottom: 10px !important;
				justify-content: space-between;
			}

			&::before {
				border-bottom: none !important;

				@media screen and (max-width: 1024px) {
					content: none !important;
				}
			}

			&::after {
				content: none !important;

				@media screen and (max-width: 1024px) {
					content: none !important;
				}
			}

			li#tab-title-description,
			li#tab-title-reviews {
				border: none;
				background-color: transparent;

				@media screen and (max-width: 1024px) {
					flex-grow: 1;
					padding: 0;
					margin: 0;
				}

				a {
					width: 230px;
					height: 46px;
					display: flex;
					align-items: center;
					justify-content: center;
					border: 1px solid #1176A8;
					color: #1176A8;
					font-weight: 500;
					text-transform: uppercase;
					border-radius: 999px;
					font-size: 16px;

					@media screen and (max-width: 1024px) {
						width: 100% !important;
						display: flex;
						align-items: center;
						justify-content: center;
						font-size: 14px;
					}
				}

				&::before {
					content: none;
				}

				&::after {
					content: none;
				}
			}

			li#tab-title-description.active>a {
				background-color: #1176A8 !important;
				color: white !important;
			}

			li#tab-title-reviews.active>a {
				background-color: #1176A8 !important;
				color: white !important;
			}
		}
	}
</style>

<!-- Add to cart script -->
<script>
	document.addEventListener("DOMContentLoaded", function() {
		const form = document.querySelector("form.cart");

		if (form) {
			form.addEventListener("submit", async function(event) {
				event.preventDefault();
				const submitBtn = form.querySelector('button[name="add-to-cart"]');
				const productId = submitBtn?.value;
				const nonce = "<?php echo wp_create_nonce('add_to_cart'); ?>";

				const ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";
				if (productId) {
					try {
						const formData = new FormData();
						formData.append('action', 'add_to_cart');
						formData.append('product_id', productId);
						formData.append('quantity', 1);
						formData.append('nonce', nonce);

						const response = await fetch(ajax_url, {
							method: "POST",
							body: formData
						});

						const result = await response.json();
						if (result.success) {
							alert("Product added to cart successfully");
						} else {
							alert("Failed to add product to cart:", result.data);
						}
					} catch (error) {
						console.error("Error adding to cart:", error);
					}
				}
			});
		}
	});
</script>
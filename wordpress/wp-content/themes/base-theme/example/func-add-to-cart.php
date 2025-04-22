<?php 

// ajax handler for add to cart action
add_action('wp_ajax_add_to_cart', 'add_to_cart');
add_action('wp_ajax_nopriv_add_to_cart', 'add_to_cart');

function add_to_cart() {
	$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    $nonce = isset($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';

    // Verify nonce
    if (!wp_verify_nonce($nonce, 'add_to_cart')) {
        wp_send_json_error('Invalid security token');
    }

    if ($product_id <= 0) {
        wp_send_json_error('Invalid product ID');
    }

    $cart = WC()->cart;

    if (!$cart) {
        wp_send_json_error('Cart not found');
    }

    $cart->add_to_cart($product_id, $quantity);

    wp_send_json_success('Product added to cart successfully');
}


?>

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
<!-- add custom post types ui -->

- Delete with user : True
- Has Archive : True

<!-- remove and action hook -->
add_action( 'current_hook_name', 'callback_function', priority );
remove_action( 'new_hook_name', 'callback_function', priority );

<!-- CÔNG THỨC THÊM TEXT / HTML / BUTTON -->
function ten_function_cua_ban() {
	ob_start();
	?>
	<div class="container">
		<h1>Hello World</h1>
	</div>
	<?php
	return ob_get_clean();
}
add_action( 'hook_name', 'ten_function_cua_ban', priority );


 <!-- GỢI Ý NÂNG CAO: Tạo array cấu hình hook -->
 $hook_blocks = [
    [
        'hook'     => 'woocommerce_before_shop_loop',
        'content'  => '<div class="banner">🔥 Sale 50%</div>',
        'priority' => 5,
    ],
    [
        'hook'     => 'woocommerce_after_main_content',
        'content'  => '<p style="text-align:center;">Cảm ơn bạn đã ghé shop!</p>',
        'priority' => 15,
    ],
];

foreach ( $hook_blocks as $block ) {
    them_html_vao_hook( $block['hook'], $block['content'], $block['priority'] );
}


<!-- add html into hook -->
them_html_vao_hook( 'woocommerce_before_shop_loop', function() {
    ?>
    <div class="banner">
        <h2>🔥 Ưu đãi cực sốc!</h2>
        <p>Giảm đến 70%</p>
    </div>
    <?php
}, 5 );
function them_html_vao_hook( $hook_name, $content, $priority = 10 ) {
    // Nếu content là callable (hàm), thì gọi hàm đó
    if ( is_callable( $content ) ) {
        add_action( $hook_name, function() use ( $content ) {
            ob_start();
            call_user_func( $content );
            echo ob_get_clean();
        }, $priority );
    } else {
        // Ngược lại, giả sử là chuỗi HTML
        add_action( $hook_name, function() use ( $content ) {
            echo $content;
        }, $priority );
    }
}
<!-- call -->
$html = <<<HTML
<div class="promo">
    <h3>🎁 Mua 2 tặng 1</h3>
    <p>Áp dụng đến hết tuần này!</p>
</div>
HTML;

them_html_vao_hook( 'woocommerce_before_main_content', $html, 3 );
<!-- template call -->
them_html_vao_hook( 'woocommerce_before_main_content', function() {
    include get_stylesheet_directory() . '/template/banner-sale.php';
}, 5 );

sub-menu : z-index: 999
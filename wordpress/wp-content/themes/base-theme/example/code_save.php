<div class="swiper w-[600px] h-[300px] bg-red-500">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    <div class="swiper-slide bg-blue-500">Slide 1</div>
    <div class="swiper-slide bg-blue-500">Slide 2</div>
    <div class="swiper-slide bg-blue-500">Slide 3</div>
    <div class="swiper-slide bg-blue-500">Slide 4</div>
    <div class="swiper-slide bg-blue-500">Slide 5</div>
    <div class="swiper-slide bg-blue-500">Slide 6</div>
    <div class="swiper-slide bg-blue-500">Slide 7</div>
    <div class="swiper-slide bg-blue-500">Slide 8</div>
    <div class="swiper-slide bg-blue-500">Slide 9</div>
    <div class="swiper-slide bg-blue-500">Slide 10</div>
  </div>
  <!-- If we need pagination -->
  <div class="swiper-pagination bg-red-500"></div>

  <!-- If we need navigation buttons -->
  <div class="swiper-button-prev bg-red-500"></div>
  <div class="swiper-button-next bg-red-500"></div>

  <!-- If we need scrollbar -->
  <div class="swiper-scrollbar bg-red-500"></div>
</div>
<script>
  const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    slidesPerView: 5,
    spaceBetween: 20,
    slidesPerGroup: 1,

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
      el: '.swiper-scrollbar',
    },
  });
</script>

<?php 
// ---------- Class quản lý tùy chỉnh ô nhập số lượng sản phẩm WooCommerce ----------
class WC_Custom_Quantity_Input
{

  /**
   * Constructor - đăng ký tất cả các hook
   */
  public function __construct()
  {
    // Tùy chỉnh ô input số lượng 
    add_action('woocommerce_before_quantity_input_field', array($this, 'add_quantity_minus_button'));
    add_action('woocommerce_after_quantity_input_field', array($this, 'add_quantity_plus_button'));
    add_filter('woocommerce_quantity_input_field', array($this, 'custom_tailwind_quantity_input'), 10, 2);

    // Thêm label và wrapper
    add_action('woocommerce_before_add_to_cart_quantity', array($this, 'add_quantity_label'));
    add_action('woocommerce_after_add_to_cart_quantity', array($this, 'close_quantity_div'));

    // Thêm CSS và JS
    add_action('wp_head', array($this, 'custom_quantity_input_css'));
    add_action('wp_footer', array($this, 'custom_quantity_js'));
  }

  /**
   * Thêm nút giảm (-) trước ô input số lượng
   */
  public function add_quantity_minus_button()
  {
    echo '<button type="button" class="minus inline-flex items-center justify-center w-8 h-8 focus:outline-none">−</button>';
  }

  /**
   * Thêm nút tăng (+) sau ô input số lượng
   */
  public function add_quantity_plus_button()
  {
    echo '<button type="button" class="plus inline-flex items-center justify-center w-8 h-8 focus:outline-none">+</button>';
  }

  /**
   * Tùy chỉnh HTML của input số lượng
   */
  public function custom_tailwind_quantity_input($html, $args)
  {
    // Trích xuất các thuộc tính từ HTML gốc
    $input_id = $args['input_id'] ?? '';
    $input_name = $args['input_name'] ?? '';
    $input_value = $args['input_value'] ?? 0;
    $min_value = $args['min_value'] ?? 0;
    $max_value = $args['max_value'] ?? '';
    $step = $args['step'] ?? 1;

    // Tạo HTML mới sử dụng Tailwind
    $output = '<div class="flex border border-gray-300 rounded w-36">';
    $output .= '<button type="button" class="plus w-10 flex items-center justify-center text-gray-500 hover:bg-gray-100 focus:outline-none">+</button>';
    $output .= '<input 
                  type="number" 
                  id="' . esc_attr($input_id) . '" 
                  class="qty w-16 border-0 text-center focus:ring-0 focus:outline-none" 
                  name="' . esc_attr($input_name) . '" 
                  value="' . esc_attr($input_value) . '" 
                  title="' . esc_attr__('Số lượng', 'woocommerce') . '" 
                  min="' . esc_attr($min_value) . '" 
                  max="' . esc_attr($max_value) . '" 
                  step="' . esc_attr($step) . '"
                  inputmode="numeric" />';
    $output .= '<button type="button" class="minus w-10 flex items-center justify-center text-gray-500 hover:bg-gray-100 focus:outline-none">−</button>';
    $output .= '</div>';

    return $output;
  }

  /**
   * Thêm nhãn "Số lượng" trước input
   */
  public function add_quantity_label()
  {
    echo '<div class="flex items-center gap-7 mb-7">';
    echo '<label class="text-sm font-normal text-dark-gray">Số lượng</label>';
  }

  /**
   * Đóng thẻ div
   */
  public function close_quantity_div()
  {
    echo '</div>';
  }

  /**
   * CSS để ẩn nút tăng/giảm mặc định của trình duyệt
   */
  public function custom_quantity_input_css()
  {
?>
    <style>
      /* Ẩn nút tăng/giảm mặc định của trình duyệt */
      .quantity input[type=number]::-webkit-inner-spin-button,
      .quantity input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }

      .quantity {
        border: solid 1px #C9C9C9 !important;
        border-radius: 5px !important;
        margin-right: 0px !important;
        height: 44px !important;
      }

      .quantity input[type=number] {
        -moz-appearance: textfield;
        width: 40px !important;
      }

      .quantity button[type=button] {
        padding: 21px 21px !important;
      }

      .quantity button[type=button]:hover {
        background-color: #1176A8 !important;
        color: white !important;
      }
    </style>
  <?php
  }

  /**
   * JavaScript để xử lý sự kiện nút tăng/giảm
   */
  public function custom_quantity_js()
  {
    if (!is_product() && !is_cart()) return;
  ?>
    <script>
      jQuery(document).ready(function($) {
        // Xử lý sự kiện khi nhấn nút tăng (+)
        $(document).on('click', '.plus', function() {
          var $input = $(this).siblings('.qty');
          var val = parseInt($input.val());
          var max = $input.attr('max');

          if (max && val >= parseInt(max)) {
            $input.val(max);
          } else {
            $input.val(val + 1);
          }

          $input.trigger('change');
        });

        // Xử lý sự kiện khi nhấn nút giảm (-)
        $(document).on('click', '.minus', function() {
          var $input = $(this).siblings('.qty');
          var val = parseInt($input.val());
          var min = $input.attr('min');
          min = min ? parseInt(min) : 0;

          if (val > min) {
            $input.val(val - 1);
          }

          $input.trigger('change');
        });
      });
    </script>
  <?php
  }
}
// Khởi tạo class
new WC_Custom_Quantity_Input();
?>
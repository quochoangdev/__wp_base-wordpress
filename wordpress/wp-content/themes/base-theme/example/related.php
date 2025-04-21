<?php

/**
 * Related Products
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.6.0
 */

if (!defined('ABSPATH')) {
  exit();
}

if ($related_products): ?>

  <section class="related products mb-20">
    <?php
    $heading = apply_filters(
      'woocommerce_product_related_products_heading',
      __('Related products', 'woocommerce')
    );

    if ($heading): ?>
      <h2><?php echo esc_html($heading); ?></h2>
    <?php endif;
    ?>

    <div class="swiper related-products-swiper">
      <div class="swiper-wrapper">
        <?php foreach ($related_products as $related_product): ?>
          <div class="swiper-slide">
            <?php
            $post_object = get_post($related_product->get_id());
            setup_postdata($GLOBALS['post'] = $post_object);

            // Đây là nơi chúng ta gọi template tuỳ chỉnh của bạn
            wc_get_template_part('content', 'product');
            ?>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Navigation arrows -->
      <div class="swiper-button-prev">
        <svg viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0.763157 9.225C0.348156 8.83075 0.348156 8.16925 0.763157 7.775L8.31125 0.604311C8.94823 -0.000822458 10 0.450714 10 1.32931L10 15.6707C10 16.5493 8.94823 17.0008 8.31125 16.3957L0.763157 9.225Z" fill="#1176A8" />
        </svg>
      </div>
      <div class="swiper-button-next">
        <svg viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M9.23684 9.225C9.65184 8.83075 9.65184 8.16925 9.23684 7.775L1.68875 0.604311C1.05177 -0.000822458 -1.86571e-07 0.450714 -2.24975e-07 1.32931L-8.51857e-07 15.6707C-8.90262e-07 16.5493 1.05177 17.0008 1.68875 16.3957L9.23684 9.225Z" fill="#1176A8" />
        </svg>
      </div>
    </div>
  </section>
<?php endif;

wp_reset_postdata();
?>

<style>
  /* Related products */
  section.related.products {
    >h2 {
      position: relative;
      font-size: 32px;
      font-weight: bold;
      color: #1176A8;
      margin-bottom: 30px;
      text-transform: uppercase;
      width: fit-content;

      &::before {
        position: absolute;
        content: '';
        display: block;
        width: 64px;
        height: 4px;
        background-color: #3AA7DD;
        top: 50%;
        transform: translateY(-50%);
        right: -84px;
      }
    }

    .swiper-button-next,
    .swiper-button-prev {
      width: 46px;
      height: 46px;
      border: 1px solid #DCDCDC;
      border-radius: 50%;
      background-color: #fff;

      &::after {
        content: none;
      }

      svg {
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
    }

    .swiper-button-next {
      right: 0;
    }

    .swiper-button-prev {
      left: 0;
    }

    .swiper-slide {
      height: auto;
    }
  }
</style>

<script>
  // Đảm bảo DOM đã sẵn sàng
  document.addEventListener('DOMContentLoaded', function() {
    // Khởi tạo Swiper sau khi DOM đã tải
    const swiper = new Swiper('.related-products-swiper', {
      direction: 'horizontal',
      loop: true,
      slidesPerView: 5,
      spaceBetween: 20,
      slidesPerGroup: 1,

      // Responsive breakpoints
      breakpoints: {
        // khi cửa sổ >= 320px
        320: {
          slidesPerView: 1,
          spaceBetween: 10
        },
        // khi cửa sổ >= 480px
        480: {
          slidesPerView: 2,
          spaceBetween: 15
        },
        // khi cửa sổ >= 768px
        768: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        // khi cửa sổ >= 992px
        992: {
          slidesPerView: 4,
          spaceBetween: 20
        },
        // khi cửa sổ >= 1200px
        1200: {
          slidesPerView: 5,
          spaceBetween: 20
        }
      },

      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },

      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      }
    });
  });
</script>
<div class="hidden lg:block rounded-2xl overflow-hidden border border-[#C9C9C9]">
  <table class="w-full">
    <thead class="bg-primary text-white text-[17px]">
      <tr>
        <th class="font-semibold border-r border-[#C9C9C9] h-16">Hình ảnh</th>
        <th class="font-semibold border-r border-[#C9C9C9] h-16">Tên sản phẩm</th>
        <th class="font-normal border-r border-[#C9C9C9] h-16">
          <div>Giá sỉ thùng/<br>NPP</div>
        </th>
        <th class="font-normal border-r border-[#C9C9C9] h-16">
          <div>Giá đại lý/<br>siêu thị</div>
        </th>
        <th class="font-normal border-r border-[#C9C9C9] h-16">
          <div>Giá sỉ nhỏ/<br>cửa hàng</div>
        </th>
        <th class="font-semibold border-r border-[#C9C9C9] h-16">
          Số lượng
        </th>
        <th class="font-semibold h-16">
          Đặt hàng
        </th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (have_posts()) :
        $index = 0;
        while (have_posts()) : the_post();
          $product = wc_get_product(get_the_ID());
          $image_id = $product->get_image_id();
          $image_url = wp_get_attachment_image_url($image_id, 'full');
          $product_name = $product->get_name();
          $product_link = get_the_permalink($product->ID);
          $gia_si_thung = get_field('gia_si_thung', $product->ID);
          $gia_dai_ly = get_field('gia_dai_ly', $product->ID);
          $gia_si_nho = get_field('gia_si_nho', $product->ID);
      ?>
          <tr class="border-[#C9C9C9] <?php echo $index % 2 != 0 ? 'bg-light-gray' : 'bg-white'; ?>">
            <td class="p-2 border-r border-[#C9C9C9]">
              <div class="flex justify-center items-center">
                <img src="<?php echo $image_url; ?>" alt="<?php echo $product_name; ?>" class="!w-[154px] !h-[84px] object-cover">
              </div>
            </td>
            <td class="pl-5 border-r border-[#C9C9C9]">
              <div class="flex flex-col gap-2">
                <?php echo $product_name; ?>
                <a class="flex flex-row items-center gap-2 text-primary text-[15px] hover:underline" href="<?php echo $product_link; ?>">
                  Xem chi tiết
                  <svg class="mb-[2px]" width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.22183 5.77046C7.64324 6.16554 7.64324 6.83446 7.22183 7.22954L1.68394 12.4213C1.04528 13.0201 1.11546e-06 12.5672 1.10502e-06 11.6918L9.812e-07 1.30823C9.7076e-07 0.432793 1.04528 -0.0200541 1.68394 0.578695L7.22183 5.77046Z" fill="#B0DAEE" />
                  </svg>
                </a>
              </div>
            </td>
            <td class="pl-5 border-r border-[#C9C9C9]"><?php echo wc_price($gia_si_thung['price']); ?></td>
            <td class="pl-5 border-r border-[#C9C9C9]"><?php echo wc_price($gia_dai_ly['price']); ?></td>
            <td class="pl-5 border-r border-[#C9C9C9]"><?php echo wc_price($gia_si_nho['price']); ?></td>
            <td class="border-r border-[#C9C9C9]">
              <!-- input quantity has increase and decrease -->
              <div class="flex justify-center items-center">
                <div class="flex flex-row items-center border border-[#C9C9C9] bg-white rounded-[4px] h-10">
                  <button class="decrease-quantity w-10 h-full hover:bg-primary hover:text-white transition-all duration-300" onclick="decreaseQuantity(this)">-</button>
                  <input class="w-7 text-center bg-white product-quantity flex justify-center items-center outline-none" value="1" min="1" onchange="validateQuantity(this)">
                  <button class="increase-quantity w-10 h-full hover:bg-primary hover:text-white transition-all duration-300" onclick="increaseQuantity(this)">+</button>
                </div>
              </div>
              <script>
                function decreaseQuantity(button) {
                  const input = button.parentNode.querySelector('.product-quantity');
                  const currentValue = parseInt(input.value);
                  if (currentValue > 1) {
                    input.value = currentValue - 1;
                  }
                }

                function increaseQuantity(button) {
                  const input = button.parentNode.querySelector('.product-quantity');
                  input.value = parseInt(input.value) + 1;
                }

                function validateQuantity(input) {
                  if (input.value < 1 || isNaN(input.value)) {
                    input.value = 1;
                  }
                }
              </script>
            </td>
            <td>
              <div class="flex justify-center items-center">
                <button class="text-[#DB1907] uppercase hover:underline flex flex-row items-center gap-2">
                  Mua Ngay
                  <svg class="mb-[2px]" width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.22183 5.77046C7.64324 6.16554 7.64324 6.83446 7.22183 7.22954L1.68394 12.4213C1.04528 13.0201 1.11546e-06 12.5672 1.10502e-06 11.6918L9.812e-07 1.30823C9.7076e-07 0.432793 1.04528 -0.0200541 1.68394 0.578695L7.22183 5.77046Z" fill="#FDCBC6" />
                  </svg>
                </button>
              </div>
            </td>
          </tr>
          <?php $index++; ?>
      <?php
        endwhile;
      endif;
      ?>
    </tbody>
  </table>
</div>

<div class="lg:hidden rounded-2xl overflow-hidden pb-5 border border-[#C9C9C9]">
  <table class="w-full">
    <thead class="bg-primary text-white text-[17px]">
      <tr>
        <th class="font-semibold border-r border-[#C9C9C9] h-16">Sản phẩm</th>
        <th class="font-semibold h-16">Đặt hàng</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (have_posts()) :
        $index = 0;
        while (have_posts()) : the_post();
          $product = wc_get_product(get_the_ID());
          $image_id = $product->get_image_id();
          $image_url = wp_get_attachment_image_url($image_id, 'full');
          $product_name = $product->get_name();
          $product_link = get_the_permalink($product->ID);
          $gia_si_thung = get_field('gia_si_thung', $product->ID);
          $gia_dai_ly = get_field('gia_dai_ly', $product->ID);
          $gia_si_nho = get_field('gia_si_nho', $product->ID);
      ?>
          <tr class="border-[#C9C9C9] <?php echo $index % 2 != 0 ? 'bg-light-gray' : 'bg-white'; ?>">
            <td class="p-2 border-r border-[#C9C9C9]">
              <div class="flex flex-col gap-2">
                <div class="flex flex-row items-start gap-2">
                  <div class="flex justify-center items-center">
                    <img src="<?php echo $image_url; ?>" alt="<?php echo $product_name; ?>" class="!h-[84px] aspect-square object-cover">
                  </div>
                  <div class="flex flex-col gap-1 justify-start">
                    <?php echo $product_name; ?>
                    <a class="flex flex-row items-center gap-1 text-primary !md:text-[15px] hover:underline" href="<?php echo $product_link; ?>">
                      Xem chi tiết
                      <svg class="mb-[2px]" width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.22183 5.77046C7.64324 6.16554 7.64324 6.83446 7.22183 7.22954L1.68394 12.4213C1.04528 13.0201 1.11546e-06 12.5672 1.10502e-06 11.6918L9.812e-07 1.30823C9.7076e-07 0.432793 1.04528 -0.0200541 1.68394 0.578695L7.22183 5.77046Z" fill="#B0DAEE" />
                      </svg>
                    </a>
                  </div>
                </div>
                <div class="flex flex-col gap-2">
                  <div class="flex flex-row items-center justify-start text-sm md:text-base"><span class="font-semibold">Giá sỉ:</span>&nbsp;<?php echo wc_price($gia_si_thung['price']); ?></div>
                  <div class="flex flex-row items-center justify-start text-sm md:text-base"><span class="font-semibold">Giá đại lý:</span>&nbsp;<?php echo wc_price($gia_dai_ly['price']); ?></div>
                  <div class="flex flex-row items-center justify-start text-sm md:text-base"><span class="font-semibold">Giá sỉ nhỏ:</span>&nbsp;<?php echo wc_price($gia_si_nho['price']); ?></div>
                </div>
              </div>
            </td>
            <td class="border-r border-[#C9C9C9]">
              <!-- input quantity has increase and decrease -->
              <div class="flex flex-col gap-2">
                <div class="flex justify-center items-center p-1">
                  <div class="flex flex-row items-center border border-[#C9C9C9] bg-white rounded-[4px] h-7">
                    <button class="decrease-quantity w-7 h-full hover:bg-primary hover:text-white transition-all duration-300" onclick="decreaseQuantity(this)">-</button>
                    <input class="w-7 text-center bg-white text-dark-gray text-sm md:text-base product-quantity flex justify-center items-center outline-none" value="1" min="1" onchange="validateQuantity(this)">
                    <button class="increase-quantity w-7 h-full hover:bg-primary hover:text-white transition-all duration-300" onclick="increaseQuantity(this)">+</button>
                  </div>
                </div>
                <script>
                  function decreaseQuantity(button) {
                    const input = button.parentNode.querySelector('.product-quantity');
                    const currentValue = parseInt(input.value);
                    if (currentValue > 1) {
                      input.value = currentValue - 1;
                    }
                  }

                  function increaseQuantity(button) {
                    const input = button.parentNode.querySelector('.product-quantity');
                    input.value = parseInt(input.value) + 1;
                  }

                  function validateQuantity(input) {
                    if (input.value < 1 || isNaN(input.value)) {
                      input.value = 1;
                    }
                  }
                </script>
                <div class="flex justify-center items-center p-1">
                  <button class="text-[#DB1907] uppercase hover:underline text-sm md:text-base flex flex-row items-center gap-2">
                    Mua Ngay
                    <svg class="mb-[2px]" width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M7.22183 5.77046C7.64324 6.16554 7.64324 6.83446 7.22183 7.22954L1.68394 12.4213C1.04528 13.0201 1.11546e-06 12.5672 1.10502e-06 11.6918L9.812e-07 1.30823C9.7076e-07 0.432793 1.04528 -0.0200541 1.68394 0.578695L7.22183 5.77046Z" fill="#FDCBC6" />
                    </svg>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <?php $index++; ?>
      <?php
        endwhile;
      endif;
      ?>
    </tbody>
  </table>
</div>
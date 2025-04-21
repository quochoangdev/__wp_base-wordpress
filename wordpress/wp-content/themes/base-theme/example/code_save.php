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
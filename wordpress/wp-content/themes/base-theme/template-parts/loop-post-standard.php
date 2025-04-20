<div class="flex flex-col col-span-12 md:col-span-6 lg:col-span-3 overflow-hidden h-full group">
    <a class="aspect-[400/280] w-full h-auto block overflow-hidden relative" href="<?php echo get_the_permalink() ?>">
        <img alt="<?php the_title() ?>"
            class="aspect-[400/280] object-cover group-hover:scale-110 ease-in-out duration-300 w-full"
            src="<?php echo get_the_post_thumbnail_url() ?>">
        <span class="flex flex-col justify-center items-center absolute top-0 right-0
			 bg-secondary text-sm text-white px-3 py-1.5 w-auto h-auto rounded-bl-md text-center">
            <?php 
                $categories = get_the_category(); // Lấy danh mục của bài viết hiện tại
                if (!empty($categories)) {
                    echo esc_html($categories[0]->name); // Hiển thị tên danh mục đầu tiên
                }
            ?>
        </span>
    </a>
    <div class="pt-4 flex-grow flex flex-col gap-3">
        <a href="<?php echo get_the_permalink() ?>">
            <h2 class="font-bold line-clamp-2 text-base text-[#606a70]">
                <?php echo get_the_title() ?>
            </h2>
        </a>
        <a href="<?php echo get_the_permalink() ?>">
            <span class="text-[#b30537] text-sm flex font-bold uppercase">Xem thêm <svg
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="ml-2 w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg></span>
        </a>
    </div>
</div>
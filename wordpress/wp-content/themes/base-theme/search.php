<?php
get_header();
?>
<?php $section_1 = get_field('banner', $term); ?>
<section class="py-2 lg:py-3 bg-light-gray">
    <div class="container px-4 lg:px-0 mx-auto">
        <div class="flex items-center">
            <?php if (function_exists('yoast_breadcrumb')) {
	yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
} ?>
        </div>
    </div>
</section>
<section class="py-8 lg:py-16">
    <div class="container px-4 lg:px-0 mx-auto">
        <h1 class="text-xl lg:text-3xl font-bold text-center uppercase pb-4 lg:pb-8">
            Kết quả tìm kiếm cho: <span class="text-secondary"><?php echo get_search_query() ?></span>
        </h1>
        <div class="grid grid-cols-12 gap-4 lg:gap-6 xl:gap-8">
            <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/loop', 'post-standard-heading'); ?>
            <?php endwhile; ?>
            <?php else : ?>
            <?php echo '<p class="col-span-12">Không có bài viết nào trong danh mục này</p>'; ?>
            <?php endif; ?>
        </div>
        <div class="flex items-center justify-center mt-10">
            <?php echo paginate_links([
            	'mid_size' => 5,
            	'prev_text' => '<div class="uppercase text-base"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" /></svg></div>',
            	'next_text' => '<div class="uppercase text-base"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" /></svg></div>'
            ]); ?>
        </div>
</section>
<?php get_footer(); ?>
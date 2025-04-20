<?php get_header(); 
echo '<!-- DEBUG: Đây là index.php -->';
?>

<main class="container mx-auto px-4 py-8">
  <h1 class="text-center font-bold text-blue-500">Hello World</h1>
    <!-- <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>
            <article class="prose max-w-none">
                <h1 class="text-4xl font-bold mb-4"><?php the_title(); ?></h1>
                <div class="content">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
    else :
        ?>
        <p class="text-xl">No posts found.</p>
        <?php
    endif;
    ?> -->
</main>

<?php get_footer(); ?>

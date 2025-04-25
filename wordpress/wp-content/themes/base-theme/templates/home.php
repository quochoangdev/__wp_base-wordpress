<?php

/**
 * Template Name: Home
 *
 * @author ryan
 */

get_header();
?>

<h1 class="text-center font-bold text-blue-500 bg-gray-500">home</h1>

<?php echo paginate_links(); ?>
<?php get_footer(); ?>
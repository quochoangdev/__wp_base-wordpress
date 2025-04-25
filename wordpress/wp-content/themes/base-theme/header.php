<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Base Theme</title>
  <?php wp_head(); ?>
</head>

<body>
  <header>
    <h1 class="text-center font-bold">

      <?php get_template_part('template-custom/wp_nav_menu'); ?>

    </h1>
  </header>
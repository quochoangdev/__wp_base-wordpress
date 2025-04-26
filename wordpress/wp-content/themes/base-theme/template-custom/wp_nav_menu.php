<?php echo wp_nav_menu(
  array(
    'theme_location' => 'primary',
    'container' => 'nav',
    'container_class' => 'cs-nav-menu-container',
    'menu_class' => 'cs-nav-menu-ul',
  )
);
?>
<style>
  :root {
    --bg-primary: #23282d;
    --bg-hover: #1c2024;
    --text-size: 16px;
    --text-color: #fff;

    --width-sub-menu: 200px;
    --bg-sub-primary: #23282d;
    --bg-sub-hover: #1c2024;
    --sub-text-size: 14px;
    --sub-text-color: #fff;
  }

  .cs-nav-menu-container {
    height: 100%;

    .cs-nav-menu-ul {
      height: 100%;
      display: flex;
      justify-content: start;
      align-items: center;
    }

    .cs-nav-menu-ul>li {
      height: 100%;
      position: relative;

      &:hover {
        background-color: var(--bg-hover);

        .sub-menu {
          display: block;
        }
      }

      >a {
        padding: 0 16px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-color);
        font-size: var(--text-size);
      }
    }
  }

  .cs-nav-menu-container {
    .sub-menu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      width: var(--width-sub-menu);

      >li {
        width: 100%;
        background-color: var(--bg-sub-primary);

        >a {
          display: flex;
          align-items: center;
          justify-content: start;
          width: 100%;
          padding: 10px 16px;
          color: var(--sub-text-color);
          font-size: var(--sub-text-size);

          &:hover {
            text-decoration: underline;
          }
        }
      }
    }
  }
</style>
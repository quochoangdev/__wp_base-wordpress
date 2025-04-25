<?php 
  // nav menu
  $nav_menu_class = '';
  $ul_menu_class = '';
  $li_item_class = '';
  // sub menu
  $sub_ul_menu_class = '';
  $sub_li_item_class = '';

  // a item
  $a_item_class = 'text-red-500';
?>

<?php echo wp_nav_menu(
  array(
    'theme_location' => 'primary',
    'container' => 'nav',
    'container_class' => 'h-16' . ' ' . $nav_menu_class,
    'menu_class' => 'cs-ul-menu container px-4 mx-auto flex justify-between items-center h-full' . ' ' . $ul_menu_class,
    'walker' => new WPDocs_Walker_Nav_Menu(array(
      'menu_ul_class' => 'hidden absolute opacity-0 transition-all duration-300 ease-in-out transform scale-95 ' . $sub_ul_menu_class,
      'menu_li_class' => '' . $sub_li_item_class,
      'menu_a_class'  => 'text-base font-normal' . ' ' . $a_item_class
    )),
  )
);
?>
<!-- ----------  Custom Walker Class  ---------- -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const showDelay = 5;
    const hideDelay = 200;

    const cs_li_menu = document.querySelectorAll('.cs-ul-menu > li');

    cs_li_menu.forEach(menu => {
      menu.classList.add('relative');
      let timeout;
      
      // Sử dụng mouseenter thay vì mouseover
      menu.addEventListener('mouseenter', function() {
        clearTimeout(timeout); // Hủy timeout nếu có
        const ul = menu.querySelector('ul');
        if (ul) {
          ul.classList.remove('hidden');
          setTimeout(() => {
            ul.classList.remove('opacity-0', 'scale-95');
            ul.classList.add('opacity-100', 'scale-100');
          }, showDelay);
        }
      });

      // Sử dụng mouseleave thay vì mouseout
      menu.addEventListener('mouseleave', function() {
        const ul = menu.querySelector('ul');
        if (ul) {
          timeout = setTimeout(() => {
            ul.classList.remove('opacity-100', 'scale-100');
            ul.classList.add('opacity-0', 'scale-95');
            
            setTimeout(() => {
              ul.classList.add('hidden');
            }, hideDelay);
          }, hideDelay);
        }
      });
    });
  });
</script>

<?php
class WPDocs_Walker_Nav_Menu extends Walker_Nav_Menu
{
  protected $ul_class = '';
  protected $li_class = 'text-red-500';
  protected $a_class = '';

  public function __construct($args = array())
  {
    if (is_array($args)) {
      $this->ul_class = $args['menu_ul_class'] ?? '';
      $this->li_class = $args['menu_li_class'] ?? '';
      $this->a_class  = $args['menu_a_class'] ?? '';
    }
  }

  function start_lvl(&$output, $depth = 0, $args = array())
  {
    $indent = ($depth > 0  ? str_repeat("\t", $depth) : '');
    $display_depth = ($depth + 1);
    $classes = array(
      $this->ul_class,
      ($display_depth % 2  ? 'menu-odd' : 'menu-even'),
      ($display_depth >= 2 ? 'sub-sub-menu' : ''),
      'menu-depth-' . $display_depth
    );
    $class_names = implode(' ', $classes);

    $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
  {
    global $wp_query;
    $indent = ($depth > 0 ? str_repeat("\t", $depth) : '');

    $depth_classes = array(
      ($depth == 0 ? 'main-menu-item' : 'sub-menu-item'),
      ($depth >= 2 ? 'sub-sub-menu-item' : ''),
      ($depth % 2 ? 'menu-item-odd' : 'menu-item-even'),
      'menu-item-depth-' . $depth,
      $this->li_class,
    );
    $depth_class_names = esc_attr(implode(' ', $depth_classes));

    $classes = empty($item->classes) ? array() : (array) $item->classes;
    $class_names = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item)));

    $output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

    $attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
    $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) . '"' : '';
    $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url) . '"' : '';
    $attributes .= ' class="menu-link ' . ($depth > 0 ? 'sub-menu-link' : 'main-menu-link') . ' ' . $this->a_class . '"';

    $item_output = sprintf(
      '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
      $args->before,
      $attributes,
      $args->link_before,
      apply_filters('the_title', $item->title, $item->ID),
      $args->link_after,
      $args->after
    );
    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}
?>

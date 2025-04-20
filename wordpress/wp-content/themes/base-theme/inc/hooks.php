<?php 
add_action('wp_footer', 'show_footer_message');

function show_footer_message() {
  echo '<p style="text-align:center;">🦊 Code by QuocHoang</p>';
}

?>
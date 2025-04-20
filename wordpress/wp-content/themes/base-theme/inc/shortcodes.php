<?php
// Shortcode: [custom_contact_form]
function my_custom_contact_form_shortcode() {
  ob_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['custom_form_submitted'])) {
    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    if ($name && $email && $message) {
      $to = get_option('admin_email');
      $subject = "New message from $name";
      $body = "Name: $name\nEmail: $email\nMessage:\n$message";
      $headers = ['Content-Type: text/plain; charset=UTF-8'];

      $sent = wp_mail($to, $subject, $body, $headers);

      if ($sent) {
        echo '<div class="success">✅ Cảm ơn bạn đã gửi thông tin!</div>';
      } else {
        echo '<div class="error">❌ Đã có lỗi khi gửi email. Vui lòng thử lại sau.</div>';
      }
    } else {
      echo '<div class="error">⚠️ Vui lòng điền đầy đủ thông tin.</div>';
    }
  }

  ?>
  <form method="post" class="custom-contact-form">
    <p><input type="text" name="name" placeholder="Họ tên" required></p>
    <p><input type="email" name="email" placeholder="Email" required></p>
    <p><textarea name="message" placeholder="Nội dung" required></textarea></p>
    <p>
      <input type="hidden" name="custom_form_submitted" value="1">
      <button type="submit">Gửi</button>
    </p>
  </form>
  <?php

  return ob_get_clean();
}

add_shortcode('custom_contact_form', 'my_custom_contact_form_shortcode');

?>
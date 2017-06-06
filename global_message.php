<?php
  /*
  Plugin Name: Global Message
  Plugin URI: https://github.com/BenRoss92/global_message
  Description: A plugin to write and save a short message to every front-end page.
  Author: Ben Ross
  Author URI: https://github.com/BenRoss92
  */

  add_action('wp_dashboard_setup', 'add_widget_to_dashboard');
  add_action('admin_post_global_message_form', 'update_message');
  add_filter('the_content', 'add_mesage_to_content');

  function display_editor() {
    $sanitized_message = get_database_message('global_message');
    $editor_id = 'global-message-editor';
    $editor_settings = array(
      'media_buttons' => FALSE,
      'textarea_name' => 'editor_text',
      'textarea_rows' => 5
    );
    ?>
      <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
        <?php wp_editor($sanitized_message, $editor_id, $editor_settings); ?>
        <input type="hidden" name="action" value="global_message_form">
        <?php submit_button('Update Message'); ?>
      </form>
    <?php
  }

  function add_widget_to_dashboard() {
    wp_add_dashboard_widget('global-message-widget',
    'Global Message', 'display_editor');
  }

  function update_message() {
    $unsanitized_message = $_POST['editor_text'];
    add_message_to_database('global_message', $unsanitized_message);
    wp_safe_redirect('http://localhost/~Ben/wordpress/wp-admin/');
    exit;
  }

  function add_mesage_to_content($content) {
    $sanitized_message = get_database_message('global_message');
    return display_message_with_content($sanitized_message, $content);
  }

  function add_message_to_database($database_option, $unsanitized_message) {
    update_option($database_option, $unsanitized_message);
  }

  function sanitize_message($unsanitized_message) {
    return stripslashes($unsanitized_message);
  }

  function get_database_message($database_option) {
    return sanitize_message(get_option($database_option));
  }

  function display_message_with_content($sanitized_message, $content) {
    return "{$sanitized_message} {$content}";
  }

?>

<?php
  /*
  Plugin Name: Global Message
  Plugin URI: https://github.com/BenRoss92/global_message
  Description: A plugin to write and save a short message to every front-end page.
  Author: Ben Ross
  Author URI: https://github.com/BenRoss92
  */

  function add_widget_editor() {
    $default_content = get_option('global_message');
    $editor_id = 'global-message-editor';
    $editor_settings = array(
      'media_buttons' => FALSE,
      'textarea_name' => 'editor_text',
      'textarea_rows' => 5
    );
    ?>
      <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
        <?php wp_editor($default_content, $editor_id, $editor_settings); ?>
        <input type="hidden" name="action" value="global_message_form">
        <?php submit_button('Update Message'); ?>
      </form>
    <?php
  }

  add_action('wp_dashboard_setup', 'add_widget_to_dashboard');

  function add_widget_to_dashboard() {
    wp_add_dashboard_widget('global-message-widget',
    'Global Message', 'add_widget_editor');
  }

  add_action('admin_post_global_message_form', 'add_message_to_database');

  function add_message_to_database() {
    $message_to_add = $_POST['editor_text'];
    update_option('global_message', $message_to_add);

    wp_safe_redirect('http://localhost/~Ben/wordpress/wp-admin/');
    exit;
  }

  add_filter('the_content', 'add_mesage_to_content');

  function add_mesage_to_content($content) {
    $message_to_add = get_option('global_message');
    return $message_to_add . $content;
  }

?>

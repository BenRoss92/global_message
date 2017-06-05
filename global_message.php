<?php
  /*
  Plugin Name: Global Message
  Plugin URI: https://github.com/BenRoss92/global_message
  Description: A plugin to write and save a short message to every front-end page.
  Author: Ben Ross
  Author URI: https://github.com/BenRoss92
  */

  function add_widget_form() {
    ?>
    <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
     <h3>Message:</h3>
     <div class="textarea-wrap">
        <textarea name="global-message-text"
        placeholder="e.g. Half-price sale now on!"
        rows="3" cols="15"><?php echo get_option('global_message'); ?></textarea>
     </div>
     <input type="hidden" name="action" value="global_message_form">
     <?php submit_button('Update Message'); ?>
    </form>
    <?php
  }

 add_action('wp_dashboard_setup', 'add_widget_to_dashboard');

 function add_widget_to_dashboard() {
   wp_add_dashboard_widget('global-message-widget',
   'Global Message', 'add_widget_form');
 }

 add_action('admin_post_global_message_form', 'add_message_to_database');

 function add_message_to_database() {
   $message_to_add = $_POST['global-message-text'];
   add_option('global_message', $message_to_add);

   wp_safe_redirect('http://localhost/~Ben/wordpress/wp-admin/');
   exit;
 }

?>

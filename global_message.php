<?php
  /*
  Plugin Name: Global Message
  Plugin URI: https://github.com/BenRoss92/global_message
  Description: A plugin to write and save a short message to every front-end page.
  Author: Ben Ross
  Author URI: https://github.com/BenRoss92
  */

 function add_widget_editor() {
  $default_content = '';
  $editor_id = 'global-message-editor';
  $editor_settings = array(
    'media_buttons' => FALSE,
    'textarea_name' => 'editor_text',
    'textarea_rows' => 5
  );
  wp_editor($default_content, $editor_id, $editor_settings);
 }

 function add_widget_to_dashboard() {
   wp_add_dashboard_widget('global-message-widget',
   'Global Message', 'add_widget_editor');
 }

 add_action('wp_dashboard_setup', 'add_widget_to_dashboard');

?>

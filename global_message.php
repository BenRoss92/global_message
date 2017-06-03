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
   <form>
     <h3>Message:</h3>
     <div class="textarea-wrap">
        <textarea name="global-message-text" rows="3" cols="15"></textarea>
     </div>
     <?php submit_button('Update Message'); ?>
   </form>
   <?php
 }

 function add_widget_to_dashboard() {
   wp_add_dashboard_widget('global-message-widget',
   'Global Message', 'add_widget_form');
 }

 add_action('wp_dashboard_setup', 'add_widget_to_dashboard');

?>

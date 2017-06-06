<?php
/**
 * Class Global_Message_Tests
 *
 * @package Global_message
 */

 class Global_Message_Tests extends WP_UnitTestCase {

	 public function test_sanitize_message() {
	 	$unsanitized_message = "I'\M A GLOBAL MESSAGE!";
		$this->assertEquals(
			"I'M A GLOBAL MESSAGE!", sanitize_message($unsanitized_message));
	 }

	 public function test_display_message_with_content() {
		$sanitized_message = "I'M A GLOBAL MESSAGE!";
		$content = "Lorem ipsum dolor sit amet, eu dicant reformidans usu, ne.";
		$this->assertEquals(
			"I'M A GLOBAL MESSAGE! Lorem ipsum dolor sit amet, eu dicant reformidans usu, ne.",
			 display_message_with_content($sanitized_message, $content)
		);
	 }

	 public function test_get_database_message() {
		 $database_option = 'global_message';
		 $sanitized_message = "I'M A GLOBAL MESSAGE!";
		 update_option($database_option, $sanitized_message);
		 $this->assertEquals(
			 $sanitized_message, get_database_message($database_option));
	 }

	 public function test_add_message_to_database() {
		 $database_option = 'global_message';
		 $unsanitized_message = "I'\M A GLOBAL MESSAGE!";
		 add_message_to_database($database_option, $unsanitized_message);
		 $message_in_database = get_option($database_option);
		 $this->assertEquals($unsanitized_message, $message_in_database);
	 }

 }

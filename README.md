# Global Message

## The Brief

Build a custom WordPress plugin called “Global Message”. It should allow the WordPress admin to write and save a short message in a text-area field within the dashboard. This message should then be displayed on every page.

## Technologies

- WordPress (version 4.7.5)
- Apache (version 2.4.18, Unix)
- MySQL (version 5.7.18)
- PHP (version 7.0.18)
- PHPUnit (version 6.1.3)
- WP-CLI (version 1.2.0)

## My Approach

As I had not used the WordPress Plugin API before, I decided to start by spiking (i.e. to not test at first), using a procedural programming approach to advance quickly and keep the complexity to a minimum (please see the [spiking](https://github.com/BenRoss92/global_message/tree/spiking) GitHub branch for this early version). My thinking was that once I had achieved the functionality of the brief, I would then be able to focus purely on testing and redesigning using object-oriented programming. Due to time constraints, with the spiking stage taking longer than expected, I decided to instead forgo using object-oriented programming and instead rewrote the procedural functions into smaller, tested units with single responsibilities.

## What I would have improved with more time

- Would have used object-oriented design rather than procedural programming
  - Less repetition, more readable, more extendable/reusable
  - Encapsulation - also wouldn't have any naming conflicts with built-in WordPress functions.
- Would have used TDD
  - I added tests after instead of before building functions
  - It became harder to split existing functions into smaller units by doing so.
- Remove repetition in tests by making the variables in each test case available in all test cases.
- Add separation of concerns - perhaps separate the functions into different files to reflect an sudo MVC style.
  - E.g. move the form generation function into a `View` class - separating the generation of the view from the business logic.
- Remove hardcoded variables in `display_editor()`, `update_message()` and `add_mesage_to_content($content)` functions
  - To do this, when adding WordPress actions, could pass arguments into custom functions by using e.g. `do_action` or wrap them in separate functions.

## Challenges faced

- The WordPress Plugin API was new to me
- As Ruby is my main language, I have used PHP in one project before so am still getting used to the differences in syntax and uses.  
- Setting up Codeception for feature (a.k.a acceptance) testing
  - At the time of building the project, the current build was failing. I could not install it as it was resulting in the following known error - https://github.com/lucatume/wp-browser/issues/79.
- Setting up WP-CLI
  - Configuration resulted in an SVN error “Error validating server certificate…”
  - Found a solution here: https://github.com/wp-cli/wp-cli/issues/1938
- Connecting local Wordpress installation to the MySQL database
  - Resulted in a database connection error.
  - Solution: Renamed `wp-config-sample.php` file as `wp-config.php` and changed MySQL database hostname in file `wp-config.php` from `localhost` to `127.0.0.1`.

## Running locally

### Installation and configuration

1. Install Apache, MySQL and PHP ([MAMP](https://www.mamp.info/en/downloads/) is one option for installing these on a unix or linux machine. WordPress also has [instructions](https://codex.wordpress.org/Installing_WordPress_Locally_on_Your_Mac_With_MAMP) for installing MAMP and WordPress)
2. Download the latest version of [WordPress](https://wordpress.org/download/) and unzip the folder
3. Name the WordPress download folder as `wordpress` and move it into your `/Users/<YOURUSERNAME>/Sites/` directory (or create this directory if needed). The working directory should be `/Users/<YOURUSERNAME>/Sites/wordpress`
4. Log into MySQL and Create a development database named `wordpress`
and a test database named `wordpress_test`
5. Make sure MySQL is running in your system preferences.
6. Clone this repo - `$ git clone git@github.com:BenRoss92/global_message.git` - and add the resulting `global_message` folder to the plugins directory in your local WordPress download folder - `/Users/<YOURUSERNAME>/Sites/wordpress/wp-content/plugins/`
7. Visit `http://localhost/~<YOURUSERNAME>/wordpress/` in a browser to configure your local version of WordPress with your development database and other required information.
8. Install [WP-CLI](http://wp-cli.org/#installing)

### Using the plugin

1. Activate the 'Global Message' plugin in the WordPress admin dashboard (`http://localhost/~<YOURUSERNAME>/wordpress/wp-admin`)
2. Run the unit tests - `$ phpunit`
3. Add a global message in the Global Message widget inside the WordPress admin dashboard and click 'Update Message'
4. View the global message on all pages (e.g. to view the landing page, visit `http://localhost/~<YOURUSERNAME>/wordpress/`)

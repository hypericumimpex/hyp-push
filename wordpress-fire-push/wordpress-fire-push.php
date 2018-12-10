<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              https://welaunch.io/plugins/fire-push/
 * @since             1.0.0
 * @package           WordPress_Fire_Push
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Fire Push
 * Plugin URI:        https://welaunch.io/plugins/fire-push/
 * Description:       The All in One WordPress Web Push Notification Solution
 * Version:           1.1.1
 * Author:            weLaunch
 * Author URI:        https://welaunch.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordpress-fire-push
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wordpress-fire-push-activator.php
 */
function activate_WordPress_Fire_Push() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-fire-push-activator.php';
	$activator = new WordPress_Fire_Push_Activator();
	$activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wordpress-fire-push-deactivator.php
 */
function deactivate_WordPress_Fire_Push() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-fire-push-deactivator.php';
	WordPress_Fire_Push_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_WordPress_Fire_Push' );
register_deactivation_hook( __FILE__, 'deactivate_WordPress_Fire_Push' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-fire-push.php';

/**
 * Run the Plugin
 * @author Daniel Barenkamp
 * @version 1.0.0
 * @since   1.0.0
 * @link    http://plugins.db-dzine.com
 */
function run_WordPress_Fire_Push() {

	$plugin_data = get_plugin_data( __FILE__ );
	$version = $plugin_data['Version'];

	$plugin = new WordPress_Fire_Push($version);
	$plugin->run();

}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active('redux-framework/redux-framework.php') || is_plugin_active('redux-dev/redux-framework.php')){
	run_WordPress_Fire_Push();
} else {
	add_action( 'admin_notices', 'run_WordPress_Fire_Push_Not_Installed' );
}

function run_WordPress_Fire_Push_Not_Installed()
{
	?>
    <div class="error">
      <p><?php _e( 'WordPress Fire_Push requires the Redux Framework Please install or activate it before!', 'wordpress-fire-push'); ?></p>
    </div>
    <?php
}
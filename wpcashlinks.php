<?php
/**
 * The plugin bootstrap file
 *
 * @link              http://wpcashlinks.com
 * @since             1.0.0
 * @package           wpcashlinks
 *
 * @wordpress-plugin
 * Plugin Name:       WPCashLinks LITE
 * Plugin URI:        http://wpcashlinks.com
 * Description:       Convert your keywords to cash generating links and easily create a silo type link structure.
 * Version:           1.0.3
 * Author:            WPCashLinks
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpcashlinks
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpcashlinks-activator.php
 */
function activate_wpcashlinks() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpcashlinks-activator.php';
	WPCashLinks_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpcashlinks-deactivator.php
 */
function deactivate_wpcashlinks() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpcashlinks-deactivator.php';
	WPCashLinks_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wpcashlinks' );
register_deactivation_hook( __FILE__, 'deactivate_wpcashlinks' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpcashlinks.php';

/**
 * Begins execution of the plugin.
 *
 *
 * @since    1.0.0
 */
function run_wpcashlinks() {

	$plugin = new WPCashLinks();
	$plugin->run();

}
run_wpcashlinks();

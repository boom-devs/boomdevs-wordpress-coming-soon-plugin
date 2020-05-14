<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://taspristudio.com
 * @since             1.0.0
 * @package           Cst
 *
 * @wordpress-plugin
 * Plugin Name:       Coming Soon By TaspriStudio
 * Plugin URI:        https://taspristudio.com/product/coming-soon-wordpress
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            TaspriStudio
 * Author URI:        https://taspristudio.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cst
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
global $cst_taspristudio;
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CST_VERSION', '1.0.0' );

/**
 * Define constant
 */
define("CST_TEXT_DOMAIN", "cs_taspristudio" );
define('CST_FILE', __FILE__);
define('CST_PATH', __DIR__);
define('CST_URL', plugins_url( '', CST_FILE ));
define('CST_ASSETS', CST_URL.'/public');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cst-activator.php
 */
function activate_cst() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cst-activator.php';
	Cst_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cst-deactivator.php
 */
function deactivate_cst() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cst-deactivator.php';
	Cst_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cst' );
register_deactivation_hook( __FILE__, 'deactivate_cst' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cst.php';

/**
 * Get Ready Plugin Translation
 */
function cst_language() {
	load_plugin_textdomain( CST_TEXT_DOMAIN, FALSE, dirname( plugin_basename(__FILE__)).'/language/' );
}
add_action('plugins_loaded', 'cst_language');


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cst() {
	$plugin = new Cst();
	$plugin->run();
}
run_cst();

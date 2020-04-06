<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @since             1.0.0
 * @package           DeMDev-GroundYourself-Features
 *
 * @wordpress-plugin
 * Plugin Name:       Groundyourself features and customizations
 * Plugin URI:        https://github.com/demeesterdev/demdev-groundyourself-features
 * Description:       Features and customizations for groundyourself.nl and its learndash environment
 * Version:           1.0.0
 * Author:            demeester.dev
 * Author URI:        https://demeester.dev/
 * License:           GPLv3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       demdev-groundyourself-features
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DEMDEV_GROUNDYOURSELF_FEATURES_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-demdev-groundyourself-features-activator.php
 */
function activate_demdev_groundyourself_features() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-demdev-groundyourself-features-activator.php';
	DeMDev_GroundYourself_Features_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-demdev-groundyourself-features-deactivator.php
 */
function deactivate_demdev_groundyourself_features() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-demdev-groundyourself-features-deactivator.php';
	DeMDev_GroundYourself_Features_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_demdev_groundyourself_features' );
register_deactivation_hook( __FILE__, 'deactivate_demdev_groundyourself_features' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-demdev-groundyourself-features.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_demdev_groundyourself_features() {

	$plugin = new DeMDev_GroundYourself_Features();
	$plugin->run();

}
run_demdev_groundyourself_features();

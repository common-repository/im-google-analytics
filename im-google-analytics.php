<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://inmomentum.io/
 * @since             1.0.0
 * @package           Im_Google_Analytics
 *
 * @wordpress-plugin
 * Plugin Name:       IM Google Analytics
 * Plugin URI:        http://inmomentum.io/wordpress/plugins/im-google-analytics
 * Description:       Tremendously easy-to-use Google Analytics plugin for WordPress. Enter your Google Analytics tracking ID and you're good to go!
 * Version:           1.1.1
 * Author:            InMomentum
 * Author URI:        http://inmomentum.io/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       im-google-analytics
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-im-google-analytics-activator.php
 */
function activate_im_google_analytics() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-im-google-analytics-activator.php';
	Im_Google_Analytics_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-im-google-analytics-deactivator.php
 */
function deactivate_im_google_analytics() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-im-google-analytics-deactivator.php';
	Im_Google_Analytics_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_im_google_analytics' );
register_deactivation_hook( __FILE__, 'deactivate_im_google_analytics' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-im-google-analytics.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_im_google_analytics() {
	$plugin = new Im_Google_Analytics();
	$plugin->run();
}

run_im_google_analytics();
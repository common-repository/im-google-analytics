<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://inmomentum.io/
 * @since      1.0.0
 *
 * @package    Im_Google_Analytics
 * @subpackage Im_Google_Analytics/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Im_Google_Analytics
 * @subpackage Im_Google_Analytics/public
 * @author     InMomentum <hello@inmomentum.io>
 */
class Im_Google_Analytics_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Render the Google Analytics tracking code.
	 *
	 * @since    1.0.0
	 */
	public function render_tracking_code() {

 		if( get_option( 'im_google_analytics_options' )['settings_status'] ) {
			include_once 'partials/im-google-analytics-public-tracking-code.php';
		}

	}

}

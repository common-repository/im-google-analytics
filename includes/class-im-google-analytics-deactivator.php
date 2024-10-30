<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://inmomentum.io/
 * @since      1.0.0
 *
 * @package    Im_Google_Analytics
 * @subpackage Im_Google_Analytics/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Im_Google_Analytics
 * @subpackage Im_Google_Analytics/includes
 * @author     InMomentum <hello@inmomentum.io>
 */
class Im_Google_Analytics_Deactivator {

	/**
	 * Runs during deactivation of plugin.
	 *
	 * Runs when deactivating plugin. It will clean up the registered settings.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

		unregister_setting( 'im-google-analytics-settings', 'im-google-analytics-options' );
		delete_option( 'im-google-analytics-options' );

	}

}

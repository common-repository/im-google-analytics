<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://inmomentum.io/
 * @since      1.0.0
 *
 * @package    Im_Google_Analytics
 * @subpackage Im_Google_Analytics/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Im_Google_Analytics
 * @subpackage Im_Google_Analytics/admin
 * @author     InMomentum <hello@inmomentum.io>
 */
class Im_Google_Analytics_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * All options available in the plugin.
	 *
	 * @since    1.1.0
	 * @access   private
	 * @var      string    $plugin_name    All options available.
	 */
	private $plugin_options;

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
	 * @since      1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		//assign options and their default values
		$this->plugin_options = array(
			'tracking_id' 	  => 'UA-000000-01',
			'settings_status' => 1,
		);

	}

	/**
	 * Create admin menu.
	 *
	 * @since    1.0.0
	 */
	public function create_admin_menu() {
		add_submenu_page( 'options-general.php', 'IM Google Analytics', 'IM Google Analytics', 'manage_options', 'im-google-analytics', array( $this, 'render_admin_page' ), 100 );
	}

	/**
	 * Render admin page.
	 *
	 * @since    1.0.0
	 */
	public function render_admin_page() {
		include_once 'partials/im-google-analytics-admin-settings.php';
	}

	/**
	 * Register settings.
	 *
	 * @since    1.0.0
	 */
	public function register_settings() {

		register_setting( 'im_google_analytics_settings', 'im_google_analytics_options', array( $this, 'sanitize_options' ) );
		
		$this->convert_legacy_settings();
		$this->set_default_settings();

	}

	/**
	 * Set default values to all settings.
	 *
	 * @since    1.1.0
	 */
	private function set_default_settings() {

		if( is_array( get_option( 'im_google_analytics_options' ) ) ) {

			$current_options = get_option( 'im_google_analytics_options' );
			$plugins_options = $this->plugin_options;

			foreach ($this->plugin_options as $option => $value) {
				
				if(!isset($current_options[$option])) {

					$current_options[$option] = $value;

				}

			}

			update_option( 'im_google_analytics_options', $current_options);

		} else {

			add_option( 'im_google_analytics_options', $this->plugin_options);

		}

	}

	/**
	 * Convert legacy settings into the new settings structure.
	 *
	 * @since    1.0.1
	 */
	private function convert_legacy_settings() {

		// 1.0.0 to 1.0.1
		if( get_option( 'tracking-id' ) ) {
		
			update_option( 'im-google-analytics-options', array( 'tracking-id' => get_option( 'tracking-id' ) ) );
			delete_option( 'tracking-id' );
		
		}

		// 1.0.1+ to 1.1.0
		if( get_option( 'im-google-analytics-options' )['tracking-id'] ) {
		
			update_option( 'im_google_analytics_options', array( 'tracking_id' => get_option( 'im-google-analytics-options' )['tracking-id'] ) );
			delete_option( 'im-google-analytics-options' );
		
		}

	}

	/**
	 * Method for sanitizing options.
	 *
	 * @since    1.0.1
	 */
	public function sanitize_options( $options ) {

		foreach ($options as $option => $value) {

			switch ($option) {

				case 'tracking_id':
					$options['tracking_id'] = $this->sanitize_tracking_id($value);
					break;

				case 'settings_status':
					$options['settings_status'] = $this->sanitize_settings_status($value);
					break;

			}

		}

		return $options;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.1
	 */
	public function enqueue_styles() {

		$screen = get_current_screen();

		if($screen->base == 'settings_page_im-google-analytics') {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/im-google-analytics-admin.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.1.0
	 */
	public function enqueue_scripts() {

		$screen = get_current_screen();

		if($screen->base == 'settings_page_im-google-analytics') {
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/im-google-analytics-css-admin.js', array( 'jquery' ), $this->version, true );
		}
	}

	/**
	 * Sanitize of tracking-id.
	 *
	 * @since    1.0.0
	 */
	private function sanitize_tracking_id( $input ) {

		$input = preg_replace('/^\p{L}{2}-\p{N}{1,}-\p{N}{1,}\K.*$/u', '', $input);

		if ( preg_match( '/^\p{L}{2}-\p{N}{1,}-\p{N}{1,}\K.*$/u', $input )) {

			$input = $input;

		} else {

			add_settings_error( 'tracking_id', 'tracking_id', __( "There seem to have been some kind of problem with your tracking ID!", 'im-google-analytics' ), 'error' );
			$input = '';

		}

		return $input;

	}

	/**
	 * Sanitize of settings-status.
	 *
	 * @since    1.1.0
	 */
	private function sanitize_settings_status( $input ) {

		if( $input == 0 || $input == 1 ) {

			return $input;

		}else {

			add_settings_error( 'settings_status', 'settings_status', __( "There seem to have been some problems saving your 'status' on the settings tab. Please try again.", 'im-google-analytics' ), 'error' );
			$input = 0;

		}

	}

}

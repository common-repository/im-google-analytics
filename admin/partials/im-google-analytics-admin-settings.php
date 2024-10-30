<?php

/**
 * @link       http://inmomentum.io/
 * @since      1.0.0
 *
 * @package    Im_Google_Analytics
 * @subpackage Im_Google_Analytics/admin/partials
 */
?>

<div class="wrap">

	<h1>IM Google Analytics<br>	
		<small class="inmomentum-plugin-author">
			<?php esc_html_e( 'by', 'im-google-analytics' ); ?>
			<a href="http://inmomentum.io/">
				InMomentum
			</a>
		</small>
	</h1>

	<p>
		<?php wp_kses( _e( 'Google Analytics is a free web analytics service offered by Google. It is the most widely used web analytics service on the Internet.<br>Start collecting data from your website by <a href="https://www.google.com/analytics/" target="_blank">signing up</a> for a Google Analytics account. If you already have one, enter you tracking id below and enjoy the power of Google Analytics.', 'im-google-analytics' ), array('a' => array('href' => array(), 'target' => array()), 'br' => array())); ?>
	</p>

	<h2 class="nav-tab-wrapper">
		<a href="#" class="nav-tab nav-tab-active" inmomentum-nav-tab-for="general"><?php esc_html_e( 'General', 'im-google-analytics' ); ?></a>
		<a href="#" class="nav-tab" inmomentum-nav-tab-for="settings"><?php esc_html_e( 'Settings', 'im-google-analytics' ); ?></a>
	</h2>

	<form method="post" action="options.php">

		<?php settings_fields( 'im_google_analytics_settings' ); ?>

		<div class="inmomentum-nav-tab-content" inmomentum-nav-tab-content="general">
			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						<?php esc_html_e( "Tracking ID", 'im-google-analytics' ); ?>
					</th>
					<td>
						<input type="text" name="im_google_analytics_options[tracking_id]" placeholder="UA-000000-01" value="<?php echo esc_attr( get_option('im_google_analytics_options')['tracking_id'] ); ?>" />						
						<p class="description">							
							<?php wp_kses( _e( 'Troubles with finding your tracking ID? Read <a href="https://support.google.com/analytics/answer/1032385" target="_blank">here</a>', 'im-google-analytics' ), array('a' => array('href' => array(), 'target' => array()))); ?>				
						</p> 
					</td>
				</tr>
			</table>
		</div>

		<div class="inmomentum-nav-tab-content" inmomentum-nav-tab-content="settings">
			<table class="form-table">
				<tr>
					<th scope="row"><?php esc_html_e( 'Status', 'im-google-analytics' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text"><span><?php esc_html_e( 'Status', 'im-google-analytics' ); ?></span></legend>
							<p>
								<label><input name="im_google_analytics_options[settings_status]" type="radio" value="1" <?php if(get_option('im_google_analytics_options')['settings_status'] == true){ echo 'checked="checked"'; } ?>><?php esc_html_e( 'Enabled', 'im-google-analytics' ); ?></label><br>
								<label><input name="im_google_analytics_options[settings_status]" type="radio" value="0" <?php if(get_option('im_google_analytics_options')['settings_status'] == false){ echo 'checked="checked"'; } ?>><?php esc_html_e( 'Disabled', 'im-google-analytics' ); ?></label>
							</p>
							<p class="description">
								<?php esc_html_e( 'Turns on / off the Google Analytics script on the frontend.', 'im-google-analytics' ); ?>
							</p>
						</fieldset>
					</td>
				</tr>
			</table>
		</div>

		<?php submit_button(); ?>

	</form>
</div>

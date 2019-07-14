<?php
add_action('admin_menu', 'welcomebar_wpnb_add_admin_menu');
add_action('admin_init', 'welcomebar_wpnb_settings_init');


function welcomebar_wpnb_add_admin_menu()
{

	add_submenu_page('edit.php?post_type=rcbwb_ntf_bar', 'WelcomeBar Options', 'WelcomeBar Options', 'manage_options', 'welcomebar_options_page', 'welcomebar_wpnb_options_page');
}


function welcomebar_wpnb_settings_init()
{

	register_setting('options_group', 'welcomebar_wpnbp_opt');

	add_settings_section(
		'welcomebar_wpnbp_options_group_section',
		'',
		null,
		'options_group'
	);

	add_settings_field(
		'dont_show_bar_after_close',
		__('Don\'t Show Notification After Close <span class="pro">(Pro)</span>', 'welcomebar'),
		'welcomebar_wpnb_checkbox_render',
		'options_group',
		'welcomebar_wpnbp_options_group_section'
	);

	add_settings_field(
		'mobile_device_breakpoint',
		__('Mobile device breakpoint (px) <span class="pro">(Pro)</span>', 'welcomebar'),
		'welcomebar_wpnb_text_render',
		'options_group',
		'welcomebar_wpnbp_options_group_section'
	);
}


function welcomebar_wpnb_checkbox_render()
{

	$options = get_option('welcomebar_wpnbp_opt');
	$checkbox_val = isset($options['dont_show_bar_after_close']) ? $options['dont_show_bar_after_close'] : '';
	?>
	<input class="pro" type='checkbox' name='welcomebar_wpnbp_opt[dont_show_bar_after_close]' <?php checked($checkbox_val, 1) ?> value='1'>
	<p class="description">If check this option. The notification will not apprear again in a page, after closing the notification.</p>
<?php

}

function welcomebar_wpnb_text_render()
{

	$options = get_option('welcomebar_wpnbp_opt');
	$text_val = isset($options['mobile_device_breakpoint']) ? $options['mobile_device_breakpoint'] : '';
	?>
	<input class="pro" type='text' name='welcomebar_wpnbp_opt[mobile_device_breakpoint]' value="<?php echo esc_attr($text_val); ?>">
	<p class="description">Sets the breakpoint between mobile and desktop devices. Below this breakpoint mobile layout will appear (Default: 767).</p>
<?php

}


function welcomebar_wpnb_options_page()
{

	?>
	<div class="wrap about-wrap">
		<div class="wrap">

			<div id="icon-options-general" class="icon32"></div>
			<h1><?php esc_attr_e('WelcomeBar Pro Global Options', 'welcomebar'); ?></h1>
			<div class="about-text">
				<?php printf(__("Thank You for Installing WelcomeBar – WordPress Notification Bar from RoundCodeBox.com.", 'welcomebar'), WPW_VERSION); ?>
				<hr>
			</div>
			<div id="poststuff">

				<div id="post-body" class="metabox-holder columns-2">

					<!-- main content -->
					<div id="post-body-content">

						<div class="meta-box-sortables ui-sortable">

							<div class="postbox">

								<div class="inside">
									<form id="welcomebar" action='options.php' method='post'>

										<?php
										settings_fields('options_group');
										do_settings_sections('options_group');
										submit_button();
										?>
									</form>
								</div>
								<!-- .inside -->

							</div>
							<!-- .postbox -->

						</div>
						<!-- .meta-box-sortables .ui-sortable -->

					</div>
					<!-- post-body-content -->

					<!-- sidebar -->
					<div id="postbox-container-1" class="postbox-container">
						<div class="meta-box-sortables">
							<div class="postbox">
								<div class="inside">
									<a href="http://www.roundcodebox.com/welcomebar-wp-notification-bar-pro/"><img src="<?php echo plugin_dir_url(__FILE__) . '/img/get-welcomebar-pro.png'; ?>"></a>
								</div>
								<!-- .inside -->
							</div>
							<!-- .postbox -->

						</div>
						<!-- .meta-box-sortables -->

					</div>
					<!-- #postbox-container-1 .postbox-container -->

				</div>
				<!-- #post-body .metabox-holder .columns-2 -->

				<br class="clear">
			</div>
			<!-- #poststuff -->

		</div> <!-- .wrap -->
	</div> <!-- .wrap -->
<?php

}

//-----------------------------------------------
// Add new tabs in the help menu
//-----------------------------------------------

add_action('admin_head', 'rcbwb_ntf_bar_add_help_tabs');
function rcbwb_ntf_bar_add_help_tabs()
{
	if ($screen = get_current_screen()) {

		//show only on book listing page
		if ($screen->post_type == 'rcbwb_ntf_bar') {

			// Save the current help tabs
			$help_tabs = $screen->get_help_tabs();

			// Remove the current help tabs from the screen
			$screen->add_help_tab(array(
				'id'      => 'rcbwb_ntf_bar_new_help_tab',
				'title'   => 'Overview',
				'callback' => 'rcbwb_ntf_bar_admin_first_callback'
			));
			$screen->add_help_tab(array(
				'id'      => 'rcbwb_ntf_bar_new_help_tab1',
				'title'   => 'Found a bug?',
				'callback' => 'rcbwb_ntf_bar_admin_second_callback'
			));
			//add the help sidebar (outputs a simple list)
			$screen->set_help_sidebar(
				'<ul><li><a href="http://www.roundcodebox.com/welcomebar-wp-notification-bar/">Features</a></li><li><a href="http://www.roundcodebox.com/support/">Get Support</a></li><li><a href="http://www.roundcodebox.com/documentation-for-welcomebar-wp-notification-bar/">Online Documentation</a></li><li><a href="http://www.roundcodebox.com/welcomebar-wp-notification-bar-pro/">WelcomeBar Pro Version</a></li></ul>'
			);
			if (count($help_tabs)) {
				// If we had help tabs before, add them back to the screen
				foreach ($help_tabs as $help_tab) {
					$screen->add_help_tab($help_tab);
				}
			}
		}
	}
}

//callback function
function rcbwb_ntf_bar_admin_first_callback()
{
	echo '<h2>';
	_e('Notification Bars Overview');
	echo '</h2>';

	echo '<p>';
	_e('WelcomeBar is a WordPress Notification Bar plugin which lets you create unlimited notification bars to notify your customers. This plugin has option to show email subscription form, Offer text and buttons about your promotions. This plugin has the options to add unlimited background colors and images to make your notification bar more professional.');
	echo '</p>';
}
//callback function
function rcbwb_ntf_bar_admin_second_callback()
{
	echo '<h2>';
	_e('Found a bug?');
	echo '</h2>';

	echo '<p>';
	_e('If you find a bug within WelcomeBar - WordPress Notification Bar you can create a ticket via Github issues. Ensure you read the contribution guide prior to submitting your report. To help us solve your issue, please be as descriptive as possible and include your system status report.');
	echo '</p>';
}

?>
<?php

add_action('cmb2_meta_boxes', 'welcomebar_wpnb_meta_boxes');
if (!function_exists('welcomebar_wpnb_meta_boxes')) {

	function welcomebar_wpnb_meta_boxes()
	{
		$prefix = '_rcbwb_';

		/**
		 * Initiate the metabox
		 */
		$meta_box = new_cmb2_box(array(
			'id'            => 'test_metabox',
			'title'         => __('WelcomeBar Visibility Settings', 'welcomebar'),
			'object_types'  => array('rcbwb_ntf_bar',), // Post type
			'context'       => 'side',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
			// 'cmb_styles' => false, // false to disable the CMB stylesheet
			// 'closed'     => true, // Keep the metabox closed by default
		));

		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_where_to_show',
			'name'        		 => esc_html__('Choose option where to show', 'welcomebar'),
			'type'        		 => 'radio',
			'options'     		 => array(
				'everywhere'    => __('Everywhere', 'welcomebar'),
				'custom'       	=> __('Custom', 'welcomebar'),
				'post'       	=> __('Individual Posts <span class="pro">(Pro)</span>', 'welcomebar'),
				'page'       	=> __('Individual Pages <span class="pro">(Pro)</span>', 'welcomebar'),
				'none'       	=> __('Don\'t show', 'welcomebar'),
			),
			'default'     		 => 'everywhere',
		));

		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_where_to_show_custom',
			'name'        		 => esc_html__('Custom options where to show', 'welcomebar'),
			'type'        		 => 'multicheck',
			'options'     		 => array(
				'posts'    => esc_html__('Posts', 'welcomebar'),
				'page'       	=> esc_html__('Pages', 'welcomebar'),
				'home'       	=> esc_html__('Home', 'welcomebar'),
			),
		));

		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_on_desktop',
			'name'        		 => esc_html__('Enable / Disable On Desktop Device', 'welcomebar'),
			'type'        		 => 'radio_inline',
			'options'     		 => array(
				'on'    		=> esc_html__('Enable', 'welcomebar'),
				'off'       	=> esc_html__('Disable', 'welcomebar'),
			),
			'default'     		 => 'on',
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_on_mobile',
			'name'        		 => esc_html__('Enable / Disable On Mobile Device', 'welcomebar'),
			'type'        		 => 'radio_inline',
			'options'     		 => array(
				'on'    		=> esc_html__('Enable', 'welcomebar'),
				'off'       	=> esc_html__('Disable', 'welcomebar'),
			),
			'default'     		 => 'on',
		));

		$meta_box = new_cmb2_box(array(
			'id'           		 => $prefix . 'notification_options',
			'title'        		 => esc_html__('WelcomeBar Settings', 'welcomebar'),
			'object_types' 		 => array('rcbwb_ntf_bar'),
			'context'      		 => 'normal',
			'priority'     		 => 'high',
			'show_names'         => true,
		));

		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_width',
			'name'        		 => esc_html__('Width', 'welcomebar'),
			'type'        		 => 'text',
			'description'		 => esc_html__('Input width of notification bar, ex: 300px')
		));

		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_position',
			'name'        		 => esc_html__('Positioning', 'welcomebar'),
			'type'        		 => 'radio_inline',
			'options'     		 => array(
				'rcbwb-n-left'    		=> esc_html__('Left', 'welcomebar'),
				'rcbwb-n-top'       	=> esc_html__('Top', 'welcomebar'),
				'rcbwb-n-right'       	=> esc_html__('Right', 'welcomebar'),
				'rcbwb-n-bottom'       	=> esc_html__('Bottom', 'welcomebar'),
			),
			'default'     		 => 'rcbwb-n-top',
			'desc' 				 => wp_kses(__('Left means the notification bar is always fixed at the left <br> Top means the notificatin bar is always fixed at the top of the page. <br> Right means the notification bar is always fixed at the right<br> Bottom means the notificatin bar is always visible at the bottom of the page', 'welcomebar'), array('br' => array())),
		));

		$meta_box->add_field(array(
			'id'                 => $prefix . 'themes_header_type',
			'name'        		 => __('Theme\'s Header Type <span>(Pro)</span>', 'welcomebar'),
			'type'        		 => 'select',
			'options'        	 => array(
				'none'			=> 	__('Default', 'welcomebar'),
				'transparent'	=> 	__('Transparent or sticky', 'welcomebar'),
			),
			'description'		 => __('What kind of header you are using in your theme?<br> Select the header type.<br> If your header transparent or sticky, <br>then you must need input  height of the notification bar and css selector of your header.'),
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_transparent_selector',
			'name'        		 => __('Header Class/ID <span>(Pro)</span>', 'welcomebar'),
			'type'        		 => 'text',
			'description'		 => esc_html__('Input the Header Class / ID of your transparent / sticky header. Ex: #header/.header')
		));

		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_display',
			'name'        		 => esc_html__('Display', 'welcomebar'),
			'type'        		 => 'radio_inline',
			'options'     		 => array(
				'rcbwb-n-open'    		=> esc_html__('Open', 'welcomebar'),
				'rcbwb-n-close'       	=> esc_html__('Close', 'welcomebar'),
			),
			'desc' 				 => wp_kses(__('Select open to keep the notification bar open on the page load<br>Select close to keep the notification bar closed on the page load. <br>', 'welcomebar'), array('br' => array())),
			'default'     		 => 'rcbwb-n-open',
		));

		// pro
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_schedule',
			'name'        		 => __('Enable / Disable Schedule Pause Time <span class="">(Pro)</span>', 'welcomebar'),
			'type'        		 => 'radio_inline',
			'options'     		 => array(
				'on'    		=> esc_html__('Enable', 'welcomebar'),
				'off'       	=> esc_html__('Disable', 'welcomebar'),
			),
			'desc'        		 => 'This option useful, if you need to pause this notification at a specific date/time. </br> If you enable shceduling, the scheduled time must be greater than current time, otherwise this notifcation will be saved as draft. </br>Your current time is: ' . current_time(get_option('date_format')) . ' ' . current_time('h : i A') . ' If you see it is not correct, set the correct timezone of your location from Settings > General > Timezone or  <a target="_blank" href="' . admin_url('options-general.php') . '">click here</a>',
			'default'     		 => 'off',
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_schedule_datetime',
			'name'        		 => __('Notification Paused Date/Time <span class="">(Pro)</span>', 'welcomebar'),
			'type'        		 => 'text_datetime_timestamp',
			'desc'        		 => 'Set the date and time when this notification will be paused.',
		));

		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_content_width',
			'name'        		 => esc_html__('Content Width', 'welcomebar'),
			'type'        		 => 'radio_inline',
			'options'     		 => array(
				'default-width'    	=> esc_html__('Default', 'welcomebar'),
				'rcbwb-n-full-width'       	=> esc_html__('Full Width', 'welcomebar'),
			),
			'default'     		 => 'default-width',
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_how_many_times_to_show',
			'name'        		 => esc_html__('How many time to show notification', 'welcomebar'),
			'type'        		 => 'text',
			'desc'		 	     => esc_html__('Input the number, how many time will apprear this notification. Number consider by each page load where the notification appear', 'welcomebar'),
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_content_bg_color',
			'name'        		 => esc_html__('Content Background color', 'welcomebar'),
			'type'        		 => 'colorpicker',
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_content_bg_image',
			'name'        		 => esc_html__('Content Background Image', 'welcomebar'),
			'type'        		 => 'file',
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_content_text_color',
			'name'        		 => esc_html__('Content Text Color', 'welcomebar'),
			'type'        		 => 'colorpicker',
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_content_bg_opcacity',
			'name'        		 => esc_html__('Opacity', 'welcomebar'),
			'type'        		 => 'text',
		));
		/**
		 * Initiate the metabox
		 */
		$meta_box = new_cmb2_box(array(
			'id'            => 'close_button_metabox',
			'title'         => __('WelcomeBar Close Button Settings', 'welcomebar'),
			'object_types'  => array('rcbwb_ntf_bar',), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
			// 'cmb_styles' => false, // false to disable the CMB stylesheet
			// 'closed'     => true, // Keep the metabox closed by default
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_close_button',
			'name'        		 => esc_html__('Enable / Disable Close Button', 'welcomebar'),
			'type'        		 => 'radio_inline',
			'options'     		 => array(
				'on'    	=> esc_html__('Enable', 'welcomebar'),
				'off'   	=> esc_html__('Disable', 'welcomebar'),
			),
			'default'     		 => 'on',
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_close_button_text',
			'name'        		 => esc_html__('Close Button Text', 'welcomebar'),
			'type'        		 => 'text',
			'before_display'        	 => '<h3 style="border-bottom: 1px solid #e9e9e9;padding-bottom: 1em;">Close Button Options</h3>',
			'desc'		 	     => esc_html__('Only works with left and right position', 'welcomebar'),
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_open_button_text',
			'name'        		 => esc_html__('Open Button Text', 'welcomebar'),
			'type'        		 => 'text',
			'desc'				 => esc_html__('Leave it empty if you don\'t want text instead of arrow icon', 'welcomebar'),
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_close_button_bg_color',
			'name'        		 => esc_html__('Close Button BG Color', 'welcomebar'),
			'type'        		 => 'colorpicker',
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_close_button_color',
			'name'        		 => esc_html__('Close Button Color', 'welcomebar'),
			'type'        		 => 'colorpicker',
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_close_button_hover_color',
			'name'        		 => esc_html__('Close Button Hover Color', 'welcomebar'),
			'type'        		 => 'colorpicker',
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_close_button_hover_bg_color',
			'name'        		 => esc_html__('Close Button Hover BG Color', 'welcomebar'),
			'type'        		 => 'colorpicker',
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_arrow_bg_color',
			'name'        		 => esc_html__('Arrow Bg Color', 'welcomebar'),
			'type'        		 => 'colorpicker',
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_arrow_color',
			'name'        		 => esc_html__('Arrow Color', 'welcomebar'),
			'type'        		 => 'colorpicker',
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_arrow_hover_color',
			'name'        		 => esc_html__('Arrow Hover Color', 'welcomebar'),
			'type'        		 => 'colorpicker',
		));
		$meta_box->add_field(array(
			'id'                 => $prefix . 'notification_arrow_hover_bg_color',
			'name'        		 => esc_html__('Arrow Hover Bg Color', 'welcomebar'),
			'type'        		 => 'colorpicker',
		));
	}
}


add_action('admin_footer', 'welcomebar_wpnb_cmb2_js');
if (!function_exists('welcomebar_wpnb_cmb2_js')) {
	function welcomebar_wpnb_cmb2_js()
	{
		?>

		<script>
			(function($) {
				//conditional where to show field
				var $current_where_to_show = jQuery('.cmb2-id--rcbwb-notification-where-to-show li input[checked="checked"]').attr('value');
				var $relation_with = jQuery('.cmb2-id--rcbwb-notification-where-to-show-custom');

				if ($current_where_to_show !== 'custom') {
					$relation_with.slideUp();
				}

				jQuery('.cmb2-id--rcbwb-notification-where-to-show li input').on('click', function() {
					if (this.getAttribute('value') == 'custom') {
						$relation_with.slideDown();
					} else {
						$relation_with.slideUp();
					}
				});

				//conditional content width
				var $current_position = jQuery('.cmb2-id--rcbwb-notification-position li input[checked="checked"]').attr('value');
				var $relation_with_1 = jQuery('.cmb2-id--rcbwb-notification-content-width');
				if ($current_position == 'rcbwb-n-left' || $current_position == 'rcbwb-n-right') {
					$relation_with_1.slideUp();
				}

				jQuery('.cmb2-id--rcbwb-notification-position li input').on('click', function() {
					if (this.getAttribute('value') == 'rcbwb-n-top' || this.getAttribute('value') == 'rcbwb-n-bottom') {
						$relation_with_1.slideDown();
					} else {
						$relation_with_1.slideUp();
					}
				});
			})(jQuery);
		</script>

	<?php
	}
}

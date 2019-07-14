<?php
/**
 * Plugin Name: WelcomeBar - Wp Notification Bar
 * Plugin URI: http://www.roundcodebox.com/welcomebar-wp-notification-bar/
 * Description: Notification Bar plugin for WordPress. WelcomeBar - Wp Notification Bar lets you create unlimited notification bars without a hassle. 
 * Version: 1.0.0
 * Author: RoundCodeBox Team
 * Author URI:  https://roundcodebox.com/
 * Text Domain: welcomebar
 * License:  GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


// define path
define('WELCOMEBAR_WPNB_URI', plugins_url('', __FILE__));
define('WELCOMEBAR_WPNB_DIR', dirname(__FILE__));

// include all files
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
include_once(WELCOMEBAR_WPNB_DIR . '/inc/custom-posts.php');
include_once(WELCOMEBAR_WPNB_DIR . '/admin/cmb2/init.php');

if (!is_plugin_active('welcomebar-pro/init.php')) {
    include_once(WELCOMEBAR_WPNB_DIR . '/inc/shortcode.php');
    include_once(WELCOMEBAR_WPNB_DIR . '/admin/plugin-options.php');
    add_action('cmb2_admin_init', 'welcomebar_wpnb_add_metabox');
    add_action('admin_enqueue_scripts', 'welcomebar_wpnb_admin_enqueue_scripts');
}


function welcomebar_wpnb_add_metabox()
{
    include_once(WELCOMEBAR_WPNB_DIR . '/inc/metabox.php');
}

// define text domain path
function welcomebar_wpnb_textdomain()
{
    load_plugin_textdomain('welcomebar', false, basename(WELCOMEBAR_WPNB_URI) . '/languages/');
}
add_action('init', 'welcomebar_wpnb_textdomain');

// enqueue scripts
add_action('wp_enqueue_scripts', 'welcomebar_wpnb_enqueue_scripts');
function  welcomebar_wpnb_enqueue_scripts()
{
    // enqueue styles
    wp_enqueue_style('material-design-iconic-font', WELCOMEBAR_WPNB_URI . '/css/material-design-iconic-font.min.css');
    wp_enqueue_style('welcomebar-notification-bar', WELCOMEBAR_WPNB_URI . '/css/notification-bar.css');

    // enqueue js
    wp_enqueue_script('welcomebar-main-js', WELCOMEBAR_WPNB_URI . '/js/main.js', array('jquery'), '', false);
}

// admin enqueue scripts
function  welcomebar_wpnb_admin_enqueue_scripts()
{
    // enqueue styles
    wp_enqueue_style('welcomebar-admin', WELCOMEBAR_WPNB_URI . '/admin/css/admin.css');
    wp_enqueue_style('wp-jquery-ui-dialog');

    // enqueue js
    wp_enqueue_script('jquery-ui-dialog');
    wp_enqueue_script('welcomebar-admin', WELCOMEBAR_WPNB_URI . '/admin/js/admin.js', array('jquery', 'jquery-ui-dialog'), '', false);
}

add_action('admin_footer', 'welcomebar_wpnb_upgrade_popup');
function welcomebar_wpnb_upgrade_popup()
{
    ?>
    <div id="rcbwb_dialog" title="<?php echo esc_attr__('Go Premium!', 'welcomebar'); ?>" class="rcbwb_dialog" style="display: none;">
        <div class="dashicons-before dashicons-dismiss"></div>
        <h3>This feature is only available in our premium version. Purchase our <a target="_blank" href="https://1.envato.market/jjQE6">Premium</a> version to unlock this feature!</h3>
    </div>
<?php
}

add_action('wp_footer', 'welcomebar_wpnb_load_notification_to_footer');
function welcomebar_wpnb_load_notification_to_footer()
{
    $args = array('post_type' => 'rcbwb_ntf_bar');

    $ntf_query = new WP_Query($args);

    while ($ntf_query->have_posts()) {
        $ntf_query->the_post();

        $post_id = get_the_id();

        $where_to_show = get_post_meta($post_id, '_rcbwb_notification_where_to_show', true);

        if ($where_to_show  == 'custom') {
            $where_to_show_custom =  get_post_meta($post_id, '_rcbwb_notification_where_to_show_custom', true);

            if (!empty($where_to_show_custom)) {
                foreach ($where_to_show_custom as $item) {
                    if (is_front_page() && $item == 'home') {
                        welcomebar_wpnb_output($post_id);
                    }

                    if (is_single() && $item == 'posts') {
                        welcomebar_wpnb_output($post_id);
                    }

                    if (is_page() && $item == 'page') {
                        welcomebar_wpnb_output($post_id);
                    }
                }
            }
        } elseif ($where_to_show  == 'everywhere') {
            welcomebar_wpnb_output($post_id);
        }
    }
}

//notification bar output
function welcomebar_wpnb_output($post_id)
{

    $positon = get_post_meta($post_id, '_rcbwb_notification_position', true);
    $positon = !empty($positon) ? $positon : 'rcbwb-n-top';

    // width
    $width = get_post_meta($post_id, '_rcbwb_notification_width', true);

    $on_desktop = get_post_meta($post_id, '_rcbwb_notification_on_desktop', true);
    $on_mobile = get_post_meta($post_id, '_rcbwb_notification_on_mobile', true);
    $display = get_post_meta($post_id, '_rcbwb_notification_display', true);
    $display = !empty($display) ? $display : 'rcbwb-n-open';

    $content_width = get_post_meta($post_id, '_rcbwb_notification_content_width', true);

    $content_color = get_post_meta($post_id, '_rcbwb_notification_content_text_color', true);
    $content_bg_color = get_post_meta($post_id, '_rcbwb_notification_content_bg_color', true);
    $content_bg_image = get_post_meta($post_id, '_rcbwb_notification_content_bg_image', true);
    $content_bg_opacity = get_post_meta($post_id, '_rcbwb_notification_content_bg_opcacity', true);

    //button options
    $close_button = get_post_meta($post_id, '_rcbwb_notification_close_button', true);
    $button_text = get_post_meta($post_id, '_rcbwb_notification_close_button_text', true);
    $button_text = !empty($button_text) ? $button_text : esc_html__('Close', 'welcomebar');

    $open_button_text = get_post_meta($post_id, '_rcbwb_notification_open_button_text', true);

    $close_button_bg_color = get_post_meta($post_id, '_rcbwb_notification_close_button_bg_color', true);
    $close_button_color = get_post_meta($post_id, '_rcbwb_notification_close_button_color', true);
    $close_button_hover_color = get_post_meta($post_id, '_rcbwb_notification_close_button_hover_color', true);
    $close_button_hover_bg_color = get_post_meta($post_id, '_rcbwb_notification_close_button_hover_bg_color', true);

    $arrow_color = get_post_meta($post_id, '_rcbwb_notification_arrow_color', true);
    $arrow_bg_color = get_post_meta($post_id, '_rcbwb_notification_arrow_bg_color', true);
    $arrow_hover_color = get_post_meta($post_id, '_rcbwb_notification_arrow_hover_color', true);
    $arrow_hover_bg_color = get_post_meta($post_id, '_rcbwb_notification_arrow_hover_bg_color', true);

    $css_style = '';
    if (!empty($content_color)) {
        $css_style .= "#notification-$post_id .rcbwb-notification-text,#notification-$post_id .rcbwb-notification-text p{color:$content_color}";
    }

    if (!empty($content_bg_color)) {
        $css_style .= "#notification-$post_id::before{background-color:$content_bg_color}";
    }

    if (!empty($content_bg_image)) {
        $css_style .= "#notification-$post_id::before{background-image:url($content_bg_image)}";
    }

    if (!empty($content_bg_opacity)) {
        $css_style .= "#notification-$post_id::before{opacity:$content_bg_opacity}";
    }

    $css_style .= "#notification-$post_id{width:$width}";
    $css_style .= "#notification-$post_id .rcbwb-n-close-toggle{background-color:$close_button_bg_color}";
    $css_style .= "#notification-$post_id .rcbwb-n-close-toggle,#notification-$post_id .rcbwb-n-close-toggle i{color:$close_button_color}";
    $css_style .= "#notification-$post_id .rcbwb-n-close-toggle:hover{background-color:$close_button_hover_bg_color}";
    $css_style .= "#notification-$post_id .rcbwb-n-close-toggle:hover{color:$close_button_hover_color}";
    $css_style .= "#notification-$post_id .rcbwb-n-close-toggle:hover i{color:$close_button_hover_color}";

    $css_style .= "#notification-$post_id .rcbwb-n-open-toggle{background-color:$arrow_bg_color}";
    $css_style .= "#notification-$post_id .rcbwb-n-open-toggle{color:$arrow_color}";

    $css_style .= "#notification-$post_id .rcbwb-n-open-toggle:hover i{color:$arrow_hover_color}";
    $css_style .= "#notification-$post_id .rcbwb-n-open-toggle:hover{background-color:$arrow_hover_bg_color}";

    // mobile device breakpoint
    $welcomebar_wpnbp_opt = get_option('welcomebar_wpnbp_opt');
    $mobile_device_width = isset($welcomebar_wpnbp_opt['mobile_device_breakpoint']) ? $welcomebar_wpnbp_opt['mobile_device_breakpoint'] : '';
    $mobile_device_width = empty($mobile_device_width) ? 768 : $mobile_device_width;
    $desktop_device_width = $mobile_device_width + 1;

    $responsive_style = '';
    if ($on_mobile == 'off') {
        $responsive_style = "@media (max-width: 767px){#notification-$post_id{display:none}}";
    }
    if ($on_desktop == 'off') {
        $responsive_style = "@media (min-width: " . $desktop_device_width . "px){#notification-$post_id{display:none}}";
    }

    // change arrow icon with position
    switch ($positon) {
        case 'rcbwb-n-left':
            $arrow_class = 'zmdi zmdi-long-arrow-right';
            break;

        case 'rcbwb-n-right':
            $arrow_class = 'zmdi zmdi-long-arrow-left';
            break;

        case 'rcbwb-n-bottom':
            $arrow_class = 'zmdi zmdi-long-arrow-up';
            break;

        default:
            $arrow_class = 'zmdi zmdi-long-arrow-down';
            break;
    }


    // get the number input of how many time this notifcation will show
    // make a unique meta key for this item
    // add post meta for this unique item
    // get view count of this item
    $count_input = get_post_meta($post_id, '_rcbwb_notification_how_many_times_to_show', true);
    $count_key = 'post_' . $post_id . '_views_count';
    $post_view_count = get_post_meta($post_id, $count_key, true);

    // if user iput is any value which is less than 1
    // then delete post meta
    // otherwise update the post meta increment by 1
    if ($count_input < 1) {
        delete_post_meta($post_id, $count_key);
    } else {
        $post_view_count = $post_view_count + 1;
        update_post_meta($post_id, $count_key, $post_view_count);
    }

    // dont load the notification when view count over than user input
    if ($count_input == '' || $count_input >= $post_view_count) :

        ?>

        <!--Notification Section-->
        <div id="notification-<?php echo esc_attr($post_id); ?>" class="rcbwb-notification-section <?php echo esc_attr($content_width); ?> <?php echo esc_attr($positon); ?> <?php echo esc_attr($display); ?>">

            <!--Notification Open Buttons-->
            <?php if (empty($open_button_text)) : ?>
                <span class="rcbwb-n-open-toggle"><i class="<?php echo esc_attr($arrow_class); ?>"></i></span>
            <?php else : ?>
                <span class="rcbwb-n-open-toggle has_text"><span><?php echo esc_html($open_button_text); ?></span></span>
            <?php endif; ?>

            <div class="rcbwb-notification-wrap">
                <div class="<?php echo $content_width == 'rcbwb-n-full-width' ? esc_attr('rcbwb-n-container_full_width') : esc_attr('rcbwb-n-container'); ?>">

                    <?php if ($close_button != 'off') : ?>
                        <!--Notification Buttons-->
                        <div class="rcbwb-notification-buttons">
                            <button class="rcbwb-n-close-toggle" data-text="<?php echo esc_html($button_text); ?>"><i class="zmdi zmdi-close"></i></button>
                        </div>
                    <?php endif; ?>

                    <!--Notification Text-->
                    <div class="rcbwb-notification-text">
                        <?php the_content(); ?>
                    </div>


                </div>
            </div>

        </div>


        <style type="text/css">
            <?php echo esc_html($css_style . $responsive_style);
            ?>
        </style>

    <?php

    endif;
}


// page builder king composer and visual composer
add_action('init', 'welcomebar_wpnb_page_builder_support');
function welcomebar_wpnb_page_builder_support()
{
    //king composer support
    global $kc;

    if ($kc) {
        $kc->add_content_type('rcbwb_ntf_bar');
    }

    //vc support
    if (class_exists('VC_Manager')) {
        $default_post_types = vc_default_editor_post_types();

        if (!in_array('rcbwb_ntf_bar', $default_post_types)) {
            $default_post_types[] = 'rcbwb_ntf_bar';
        }

        vc_set_default_editor_post_types($default_post_types);
    }
}



// set post view to 0 when update notification
// define the updated_post_meta callback
add_action('save_post', 'welcomebar_wpnp_update_meta', 10, 3);
function welcomebar_wpnp_update_meta($post_id, $post, $update)
{
    if ($post->post_type == 'rcbwb_ntf_bar') {
        $count_key = 'post_' . $post_id . '_views_count';
        update_post_meta($post_id, $count_key, 0);
    }
};


add_filter('plugin_action_links', 'welcomebar_add_plugin_page_settings_link', 10, 5);
function welcomebar_add_plugin_page_settings_link($actions, $plugin_file)
{
    static $plugin;

    if (!isset($plugin))
        $plugin = plugin_basename(__FILE__);
    if ($plugin == $plugin_file) {

        $settings = array('settings' => '<a href="edit.php?post_type=rcbwb_ntf_bar&page=welcomebar_options_page">' . __('Settings') . '</a>');
        $site_link = array('support' => '<a href="http://www.roundcodebox.com/support" target="_blank">Support</a>');
        $documentation_link = array('Documentation' => '<a href="http://www.roundcodebox.com/documentation-for-welcomebar-wp-notification-bar/" target="_blank">Documentation</a>');
        $pro_version_link = array('Get WelcomeBar Pro' => '<a href="http://www.roundcodebox.com/welcomebar-wp-notification-bar-pro/" target="_blank">Get WelcomeBar Pro</a>');

        $actions = array_merge($settings, $actions);
        $actions = array_merge($site_link, $actions);
        $actions = array_merge($documentation_link, $actions);
        $actions = array_merge($pro_version_link, $actions);
    }

    return $actions;
}

/**
 *  Adding the plugin welcome page
 * 
 */

if (!defined('WPINC')) {
    die;
}

// Plugin version.
if (!defined('WPW_VERSION')) {
    define('WPW_VERSION', '1.0.0');
}

// Plugin folder name.
if (!defined('WPW_NAME')) {
    define('WPW_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));
}

// Plugin directory, including the folder.
if (!defined('WPW_DIR')) {
    define('WPW_DIR', WP_PLUGIN_DIR . '/' . WPW_NAME);
}

// Plugin url, including the folder.
if (!defined('WPW_URL')) {
    define('WPW_URL', WP_PLUGIN_URL . '/' . WPW_NAME);
}

// Plugin root file.
if (!defined('WPW_PLUGIN_FILE')) {
    define('WPW_PLUGIN_FILE', __FILE__);
}

if (file_exists(WPW_DIR . '/admin/welcome/welcome-init.php')) {
    require_once(WPW_DIR . '/admin/welcome/welcome-init.php');
}

if (file_exists(WPW_DIR . '/admin/welcome/welcome-logic.php')) {
    require_once(WPW_DIR . '/admin/welcome/welcome-logic.php');
}

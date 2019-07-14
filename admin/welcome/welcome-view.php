<?php

/**
 * Welcome Page View
 *
 * @since 1.0.0
 * @package WPW
 */

if (!defined('WPINC')) {

    die;
}

?>

<div class="wrap about-wrap">

    <h1><?php printf(__('About WelcomeBar Pro Notifications Bar   %s', 'welcomebar'), WPW_VERSION); ?></h1>

    <div class="about-text">
        <?php printf(__("Thank You for Installing WelcomeBar – WordPress Notification Bar from RoundCodeBox.com.", 'welcomebar'), WPW_VERSION); ?>
        <hr>
    </div>


    <div class="wrap">

        <div id="icon-options-general" class="icon32"></div>
        <div id="poststuff">

            <div id="post-body" class="metabox-holder columns-2">

                <!-- main content -->
                <div id="post-body-content">

                    <div class="meta-box-sortables ui-sortable">

                        <div class="postbox">

                            <h2><span><?php // esc_attr_e('Main Content Header', 'welcomebar'); 
                                        ?></span></h2>

                            <div class="inside">
                                <h3><?php _e('Description', 'welcomebar'); ?></h3>

                                <?php echo '<p>';
                                _e('WelcomeBar is a FREE Notification Bar Plugin for WordPress. With WelcomeBar you can display an attractive and effective notification bar at different position in your WordPress website. Notification Bars is the best way to attract your visitor’s attention instantly. You can add great looking notification bars on your website visitors about your new releases, offers, messages, news etc in the most effective way. You can place HTML code in the notification bar. The notification bars are completely custimizable. Plugin is fully responsive and feature rich which is built up to simplify the your needs.', 'welcomebar');
                                echo '</p>'; ?>
                                <?php echo '<p>';
                                _e('A WordPress plugin for adding great looking notification bars to your site. With WelcomeBar wp Notification Bar plugin you can create unlimited notification bars without a hassle. This plugin has the options to add background colors and background images to create professional notification bars. This plugin has option to show email subscription form, Offer text and buttons about your promotions. The WelcomeBar - Wp Notification Bar plugin is highly compatible and works with any “well coded” WordPress themes (Free or Premium). It is responsive, Search Engine Optimized (SEO) and secure!', 'welcomebar');
                                echo '</p>'; ?>
                                <?php echo '<p>';
                                _e('The WelcomeBar - Wp Notification Bar plugin is highly compatible and works with any “well coded” WordPress themes (Free or Premium). It is responsive, Search Engine Optimized (SEO) and secure!', 'welcomebar');
                                echo '</p>'; ?>
                                <?php
                                echo '<p>';
                                _e('You can see the plugin demo here : <a href="http://www.roundcodebox.com/welcomebar-wp-notification-bar-demo/welcomebar-wp-notification-bar-demo/">Check it out now!</a>', 'welcomebar');
                                echo '<p>';
                                _e('Pro version is also available : <a href="http://www.roundcodebox.com/welcomebar-wp-notification-bar-pro/">Check it out now!</a>', 'welcomebar');
                                echo '</p>'; ?>
                                <hr>
                                <h3>
                                    <?php _e('Features:', 'welcomebar'); ?>
                                </h3>
                                <?php
                                echo '<p>';
                                _e('Option to show or hide (All page / Only pages / Only posts / Only home page )');
                                echo '</p>';
                                echo '<p>';
                                _e('Positioning (Left / Top / Right / Bottom))');
                                echo '</p>';
                                echo '<p>';
                                _e('Default Display (Open / Close))');
                                echo '</p>';
                                echo '<p>';
                                _e('Enable / Disable On Mobile Device');
                                echo '</p>';
                                echo '<p>';
                                _e('Content Background color');
                                echo '</p>';
                                echo '<p>';
                                _e('Content Background Image');
                                echo '</p>';
                                echo '<p>';
                                _e('Content Text Color');
                                echo '</p>';
                                echo '<p>';
                                _e('Background Opacity');
                                echo '</p>';
                                echo '<p>';
                                _e('Enable / Disable Close Button');
                                echo '</p>';
                                echo '<p>';
                                _e('Close Button Text');
                                echo '</p>';
                                echo '<p>';
                                _e('Open Button Text');
                                echo '</p>';
                                echo '<p>';
                                _e('Close Button Background Color');
                                echo '</p>';
                                echo '<p>';
                                _e('Close Button Color');
                                echo '</p>';
                                echo '<p>';
                                _e('Close Button Hover Color');
                                echo '</p>';
                                echo '<p>';
                                _e('Close Button Hover Background Color');
                                echo '</p>';
                                echo '<p>';
                                _e('Arrow Background Color');
                                echo '</p>';
                                echo '<p>';
                                _e('Arrow Color');
                                echo '</p>';
                                echo '<p>';
                                _e('Arrow Hover Color');
                                echo '</p>';
                                echo '<p>';
                                _e('Arrow Hover Background Color');
                                echo '</p>';
                                echo '<p>';
                                _e('Compatible with Visual Composer, King Composer and Elementor page builder');
                                echo '</p>';
                                echo '<p>';
                                _e('Create Unlimited notification bars');
                                echo '</p>';
                                ?>
                                <hr>
                                <h3><?php _e('WelcomeBar Pro version Features:', 'welcomebar'); ?></h3>
                                <?php echo '<p>';
                                _e('Wanna see the pro version? <a href = "http://www.roundcodebox.com/welcomebar-wp-notification-bar-pro/">Check it out now!</a>');
                                echo '</p>'; ?>
                                <?php

                                echo '<p>';
                                _e('Schedule notification. The notification will be automatically disappear after your chosen time.');
                                echo '</p>';
                                echo '<p>';
                                _e('Option to set any notification to specifc page/post/product.');
                                echo '</p>';
                                echo '<p>';
                                _e('Support for Sticky/Transparent header.');
                                echo '</p>';
                                echo '<p>';
                                _e('Do not show notification after close.');
                                echo '</p>';
                                echo '<p>';
                                _e('Mobile device breakpoint.');
                                echo '</p>';
                                ?>
                                <hr>
                                <h3><?php _e('NEED HELP?', 'welcomebar'); ?></h3>
                                <?php
                                echo '<p>';
                                _e('Is there any feature that you want to get in this plugin?');
                                echo '</p>';
                                echo '<p>';
                                _e('Needs assistance to use this plugin?');
                                echo '</p>';
                                echo '<p>';
                                _e('Feel free to <a href = "http://www.roundcodebox.com/welcomebar-wp-notification-bar-pro/">Contact us</a>');
                                echo '</p>';
                                ?>
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
                                <a href="http://www.roundcodebox.com/welcomebar-wp-notification-bar-pro/"><img src="<?php echo plugin_dir_url(__FILE__) . '../img/get-welcomebar-pro.png'; ?>">
                                </a>
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

</div>
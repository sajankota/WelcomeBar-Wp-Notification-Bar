<?php

/**
 * Welcome Logic
 *
 * @since 1.0.0
 * @package WPW
 */

if (!defined('WPINC')) {

  die;
}

/**
 * Welcome page redirect.
 *
 * Only happens once and if the site is not a network or multisite.
 *
 * @since 1.0.0
 */
function wpw_safe_welcome_redirect()
{

  // Bail if no activation redirect transient is present.
  if (!get_transient('_welcome_redirect_wpw')) {

    return;
  }

  // Delete the redirect transient.
  delete_transient('_welcome_redirect_wpw');

  // Bail if activating from network or bulk sites.
  if (is_network_admin() || isset($_GET['activate-multi'])) {

    return;
  }

  // Redirect to Welcome Page.
  // Redirects to `your-domain.com/wp-admin/plugin.php?page=rcbwb_welcome_page`.
  wp_safe_redirect(add_query_arg(array('page' => 'edit.php?post_type=rcbwb_ntf_bar&page=rcbwb_welcome_page'), admin_url('edit.php?post_type=rcbwb_ntf_bar&page=rcbwb_welcome_page')));
}

add_action('admin_init', 'wpw_safe_welcome_redirect');

/**
 * Adds welcome page sub menu.
 *
 * @since 1.0.0
 */
function rcbwb_welcome_page()
{

  global $wpw_sub_menu;

  $wpw_sub_menu = add_submenu_page(
    'edit.php?post_type=rcbwb_ntf_bar', // The slug name for the parent menu (or the file name of a standard WordPress admin page).
    __('Get WelcomeBar Pro', 'welcomebar'), // The text to be displayed in the title tags of the page when the menu is selected.
    __('Get WelcomeBar Pro', 'welcomebar'), // The text to be used for the menu.
    'read', // The capability required for this menu to be displayed to the user.
    'rcbwb_welcome_page', // The slug name to refer to this menu by (should be unique for this menu).
    'rcbwb_welcome_page_content' // The function to be called to output the content for this page.
  );
}

add_action('admin_menu', 'rcbwb_welcome_page');

/**
 * Welcome page content.
 *
 * @since 1.0.0
 */
function rcbwb_welcome_page_content()
{

  if (file_exists(WPW_DIR . '/admin/welcome/welcome-view.php')) {

    require_once(WPW_DIR . '/admin/welcome/welcome-view.php');
  }
}

/**
 * Enqueue Styles.
 *
 * @since 1.0.0
 */
function wpw_styles($hook)
{

  global $wpw_sub_menu;

  // Add style to the welcome page only.
  if ($hook != $wpw_sub_menu) {

    return;
  }

  // Welcome page styles.
  wp_enqueue_style(
    'wpw_style',
    WPW_URL . '/admin/welcome/css/style.css',
    array(),
    WPW_VERSION,
    'all'
  );
}

// Enqueue the styles.
add_action('admin_enqueue_scripts', 'wpw_styles');

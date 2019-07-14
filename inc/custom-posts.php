<?php

/*=======================================================
*    Register Post type
* =======================================================*/
function welcomebar_wpnb_custom_posts() {
	// Notification bars
	$labels = array(
		'name'                  => _x( 'Notification bars', 'Post Type General Name', 'welcomebar' ),
		'singular_name'         => _x( 'Notification bar', 'Post Type Singular Name', 'welcomebar' ),
		'menu_name'             => __( 'WelcomeBars Lite', 'welcomebar' ),
		'name_admin_bar'        => __( 'welcomebar', 'welcomebar' ),
		'archives'              => __( 'Notification Archives', 'welcomebar' ),
		'parent_item_colon'     => __( 'Parent Notification:', 'welcomebar' ),
		'all_items'             => __( 'All Notifications Bars', 'welcomebar' ),
		'add_new_item'          => __( 'Add New', 'welcomebar' ),
		'add_new'               => __( 'Add New', 'welcomebar' ),
		'new_item'              => __( 'New Notification', 'welcomebar' ),
		'edit_item'             => __( 'Edit Notification', 'welcomebar' ),
		'update_item'           => __( 'Update Notification', 'welcomebar' ),
		'view_item'             => __( 'View Notification', 'welcomebar' ),
		'search_items'          => __( 'Search Notification', 'welcomebar' ),
		'not_found'             => __( 'Not found', 'welcomebar' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'welcomebar' ),
		'featured_image'        => __( 'Featured Image', 'welcomebar' ),
		'set_featured_image'    => __( 'Set featured image', 'welcomebar' ),
		'remove_featured_image' => __( 'Remove featured image', 'welcomebar' ),
		'use_featured_image'    => __( 'Use as featured image', 'welcomebar' ),
		'insert_into_item'      => __( 'Insert into item', 'welcomebar' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'welcomebar' ),
		'items_list'            => __( 'Notifications list', 'welcomebar' ),
		'items_list_navigation' => __( 'Notifications list navigation', 'welcomebar' ),
		'filter_items_list'     => __( 'Filter items list', 'welcomebar' ),
	);
	$args = array(
		'label'                 => __( 'Notification bar', 'welcomebar' ),
		'labels'                => $labels,
		'supports'              => array('title','editor','custom-fields' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 10,
		'menu_icon'             => 'dashicons-schedule',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'rcbwb_ntf_bar', $args );
	
}
add_action( 'init', 'welcomebar_wpnb_custom_posts');
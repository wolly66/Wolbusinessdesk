<?php

/*
 * Document Custom Post Type definition
 *
 * @package     Wolbusinessdesk
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
*/



$wol_cpt_labels = array(
		'name'                => _x( 'CRM', 'Post Type General Name', 'wolbusinessdesk' ),
		'singular_name'       => _x( 'CRM', 'Post Type Singular Name', 'wolbusinessdesk' ),
		'menu_name'           => __( 'CRM', 'wolbusinessdesk' ),
		'name_admin_bar'      => __( 'CRM', 'wolbusinessdesk' ),
		'parent_item_colon'   => __( 'Parent CRM:', 'wolbusinessdesk' ),
		'all_items'           => __( 'All CRM', 'wolbusinessdesk' ),
		'add_new_item'        => __( 'Add New CRM', 'wolbusinessdesk' ),
		'add_new'             => __( 'Add CRM', 'wolbusinessdesk' ),
		'new_item'            => __( 'New CRM', 'wolbusinessdesk' ),
		'edit_item'           => __( 'Edit CRM', 'wolbusinessdesk' ),
		'update_item'         => __( 'Update CRM', 'wolbusinessdesk' ),
		'view_item'           => __( 'View CRM', 'wolbusinessdesk' ),
		'search_items'        => __( 'Search CRM', 'wolbusinessdesk' ),
		'not_found'           => __( 'Not found', 'wolbusinessdesk' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'wolbusinessdesk' ),
	);
$wol_cpt_args = array(
		'label'               => __( 'CRM', 'wolbusinessdesk' ),
		'description'         => __( 'CRM', 'wolbusinessdesk' ),
		'labels'              => $wol_cpt_labels,
		'supports'            => array( 'title', 'editor', 'revisions', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 20,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'show_in_rest'        => false,
		'menu_icon'			 => 'dashicons-book',
	);
// Define Step
$wol_cpt_post_type = array(
	'post_type' => 'wol-crm',
	'args'      => $wol_cpt_args,
);
<?php

/*
 * Clause Custom Post Type definition
 *
 * @package     Wolbusinessdesk
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
*/


$wol_cpt_labels = array(
		'name'                => _x( 'Tickets Reply', 'Post Type General Name', 'wolbusinessdesk' ),
		'singular_name'       => _x( 'Ticket Reply', 'Post Type Singular Name', 'wolbusinessdesk' ),
		'menu_name'           => __( 'Tickets Reply', 'wolbusinessdesk' ),
		'name_admin_bar'      => __( 'Tickets Reply', 'wolbusinessdesk' ),
		'parent_item_colon'   => __( 'Parent Ticket Reply:', 'wolbusinessdesk' ),
		'all_items'           => __( 'All Tickets Reply', 'wolbusinessdesk' ),
		'add_new_item'        => __( 'Add New Ticket Reply', 'wolbusinessdesk' ),
		'add_new'             => __( 'Add New', 'wolbusinessdesk' ),
		'new_item'            => __( 'New Ticket Reply', 'wolbusinessdesk' ),
		'edit_item'           => __( 'Edit Ticket Reply', 'wolbusinessdesk' ),
		'update_item'         => __( 'Update Ticket Reply', 'wolbusinessdesk' ),
		'view_item'           => __( 'View Ticket Reply', 'wolbusinessdesk' ),
		'search_items'        => __( 'Search Ticket Reply', 'wolbusinessdesk' ),
		'not_found'           => __( 'Not found', 'wolbusinessdesk' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'wolbusinessdesk' ),
	);
$wol_cpt_args = array(
		'label'               => __( 'Ticket Reply', 'wolbusinessdesk' ),
		'description'         => __( 'Ticket Reply container', 'wolbusinessdesk' ),
		'labels'              => $wol_cpt_labels,
		'supports'            => array( 'title', 'editor', 'revisions', 'page-attributes' ),
		'hierarchical'        => true,
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
		'menu_icon'			 => 'dashicons-portfolio',
	);

// Define Step
$wol_cpt_post_type = array(
	'post_type' => 'wol-ticket-reply',
	'args'      => $wol_cpt_args,
);

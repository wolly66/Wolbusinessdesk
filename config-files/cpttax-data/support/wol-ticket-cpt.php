<?php

/*
 * Clause Custom Post Type definition
 *
 * @package     Wolbusinessdesk
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
*/


$wol_cpt_labels = array(
		'name'                => _x( 'Tickets', 'Post Type General Name', 'wolbusinessdesk' ),
		'singular_name'       => _x( 'Ticket', 'Post Type Singular Name', 'wolbusinessdesk' ),
		'menu_name'           => __( 'Tickets', 'wolbusinessdesk' ),
		'name_admin_bar'      => __( 'Tickets', 'wolbusinessdesk' ),
		'parent_item_colon'   => __( 'Parent Ticket:', 'wolbusinessdesk' ),
		'all_items'           => __( 'All Tickets', 'wolbusinessdesk' ),
		'add_new_item'        => __( 'Add New Ticket', 'wolbusinessdesk' ),
		'add_new'             => __( 'Add New', 'wolbusinessdesk' ),
		'new_item'            => __( 'New Ticket', 'wolbusinessdesk' ),
		'edit_item'           => __( 'Edit Ticket', 'wolbusinessdesk' ),
		'update_item'         => __( 'Update Ticket', 'wolbusinessdesk' ),
		'view_item'           => __( 'View Ticket', 'wolbusinessdesk' ),
		'search_items'        => __( 'Search Ticket', 'wolbusinessdesk' ),
		'not_found'           => __( 'Not found', 'wolbusinessdesk' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'wolbusinessdesk' ),
	);
$wol_cpt_args = array(
		'label'               => __( 'Ticket', 'wolbusinessdesk' ),
		'description'         => __( 'Ticket container', 'wolbusinessdesk' ),
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
	'post_type' => 'wol-ticket',
	'args'      => $wol_cpt_args,
);


<?php

/*
 * Client document Custom Post Type definition
 *
 * @package     Wolbusinessdesk
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
*/

$wol_cpt_labels = array(
		'name'                => _x( 'Client Documents', 'Post Type General Name', 'wolbusinessdesk' ),
		'singular_name'       => _x( 'Client Document', 'Post Type Singular Name', 'wolbusinessdesk' ),
		'menu_name'           => __( 'Client Documents', 'wolbusinessdesk' ),
		'name_admin_bar'      => __( 'Client Documents', 'wolbusinessdesk' ),
		'parent_item_colon'   => __( 'Parent Client Document:', 'wolbusinessdesk' ),
		'all_items'           => __( 'All Client Document', 'wolbusinessdesk' ),
		'add_new_item'        => __( 'Add New Client Document', 'wolbusinessdesk' ),
		'add_new'             => __( 'Add New', 'wolbusinessdesk' ),
		'new_item'            => __( 'New Client Document', 'wolbusinessdesk' ),
		'edit_item'           => __( 'Edit Client Document', 'wolbusinessdesk' ),
		'update_item'         => __( 'Update Client Document', 'wolbusinessdesk' ),
		'view_item'           => __( 'View Client Document', 'wolbusinessdesk' ),
		'search_items'        => __( 'Search Client Document', 'wolbusinessdesk' ),
		'not_found'           => __( 'Not found', 'wolbusinessdesk' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'wolbusinessdesk' ),
	);
$wol_cpt_args = array(
		'label'               => __( 'Client Documents', 'wolbusinessdesk' ),
		'description'         => __( 'Client Documents', 'wolbusinessdesk' ),
		'labels'              => $wol_cpt_labels,
		'supports'            => array( 'title', 'editor', 'revisions', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => false,
		'menu_position'       => 20,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'show_in_rest'        => false,
		'menu_icon'			 => 'dashicons-book-alt',
	);

// Define Step
$wol_cpt_post_type = array(
	'post_type' => 'wol-client-document',
	'args'      => $wol_cpt_args,
);
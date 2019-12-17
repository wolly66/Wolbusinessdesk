<?php

/*
 * Companies Custom Post Type definition
 *
 * @package     Wolly_BASE
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
*/

$wol_cpt_labels = array(
		'name'                => _x( 'Clients', 'Post Type General Name', 'wollyplugin' ),
		'singular_name'       => _x( 'Client', 'Post Type Singular Name', 'wollyplugin' ),
		'menu_name'           => __( 'Clients', 'wollyplugin' ),
		'parent_item_colon'   => __( 'Parent Client:', 'wollyplugin' ),
		'all_items'           => __( 'All Clients', 'wollyplugin' ),
		'view_item'           => __( 'View Client', 'wollyplugin' ),
		'add_new_item'        => __( 'Add New Client', 'wollyplugin' ),
		'add_new'             => __( 'Add New', 'wollyplugin' ),
		'edit_item'           => __( 'Edit Client', 'wollyplugin' ),
		'update_item'         => __( 'Update Client', 'wollyplugin' ),
		'search_items'        => __( 'Search Client', 'wollyplugin' ),
		'not_found'           => __( 'Not found', 'wollyplugin' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'wollyplugin' ),
	);
	
$wol_cpt_args = array(
		'label'               => __( 'Clients', 'wollyplugin' ),
		'description'         => __( 'Clients description', 'wollyplugin' ),
		'labels'              => $wol_cpt_labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 26,
		'menu_icon'           => 'dashicons-id',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'show_in_rest'		 => false,
	);
	
// Define Companies
$wol_cpt_post_type = array(
		'post_type' => 'wol-client',
		'args'      => $wol_cpt_args,
		);

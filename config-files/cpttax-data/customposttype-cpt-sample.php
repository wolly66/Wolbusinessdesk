<?php

/*
 * Sample file for Custom Post Type definition
 * Refer to https://developer.wordpress.org/reference/functions/register_post_type/
 * for details about all settings of the arrays
 */

// An array of labels for this post type. If not set, post labels are inherited for
// non-hierarchical types and page labels for hierarchical ones.
// See get_post_type_labels()
// (https://developer.wordpress.org/reference/functions/get_post_type_labels/) for
// a full list of supported labels.
$wol_cpt_labels = array(
	'name'                  => _x( 'CPT_plural_name', 'Post Type General Name', 'wolbusinessdesk' ),
	'singular_name'         => _x( 'CPT_singular_name', 'Post Type Singular Name', 'wolbusinessdesk' ),
	'menu_name'             => __( 'CPT', 'wolbusinessdesk' ),
	'name_admin_bar'        => __( 'CPT_adminbar_name', 'wolbusinessdesk' ),
	'archives'              => __( 'CPTs Archives', 'wolbusinessdesk' ),
	'attributes'            => __( 'CPT Attributes', 'wolbusinessdesk' ),
	'parent_item_colon'     => __( 'Parent CPT', 'wolbusinessdesk' ),
	'all_items'             => __( 'All CPTs', 'wolbusinessdesk' ),
	'add_new_item'          => __( 'Add New CPT', 'wolbusinessdesk' ),
	'add_new'               => __( 'Add New CPT', 'wolbusinessdesk' ),
	'new_item'              => __( 'New CPT', 'wolbusinessdesk' ),
	'edit_item'             => __( 'Edit CPT', 'wolbusinessdesk' ),
	'update_item'           => __( 'Update CPT', 'wolbusinessdesk' ),
	'view_item'             => __( 'View CPT', 'wolbusinessdesk' ),
	'view_items'            => __( 'View CPTs', 'wolbusinessdesk' ),
	'search_items'          => __( 'Search CPT', 'wolbusinessdesk' ),
	'not_found'             => __( 'Not found', 'wolbusinessdesk' ),
	'not_found_in_trash'    => __( 'Not found in Trash', 'wolbusinessdesk' ),
	'featured_image'        => __( 'Featured Image', 'wolbusinessdesk' ),
	'set_featured_image'    => __( 'Set featured image', 'wolbusinessdesk' ),
	'remove_featured_image' => __( 'Remove featured image', 'wolbusinessdesk' ),
	'use_featured_image'    => __( 'Use as featured image', 'wolbusinessdesk' ),
	'insert_into_item'      => __( 'INSERT INTO CPT', 'wolbusinessdesk' ),
	'uploaded_to_this_item' => __( 'Uploaded to this CPT', 'wolbusinessdesk' ),
	'items_list'            => __( 'CPTs list', 'wolbusinessdesk' ),
	'items_list_navigation' => __( 'CPTs list navigation', 'wolbusinessdesk' ),
	'filter_items_list'     => __( 'Filter CPTs list', 'wolbusinessdesk' ),
);

//  Array or string of arguments for registering a post type
$wol_cpt_args = array(
	'label'               => __( 'CPT_singular_name', 'wolbusinessdesk' ),
	'description'         => __( 'CPT_Description', 'wolbusinessdesk' ),
	'labels'              => $labels,
	'supports'            => array(
		'title',
		'editor',
		'excerpt',
		'thumbnail',
		'comments',
		'revisions',
		'custom-fields'
	),
	'taxonomies'          => array( 'taxonomies_array' ),
	'hierarchical'        => FALSE,
	'public'              => TRUE,
	'show_ui'             => TRUE,
	'show_in_menu'        => TRUE,
	'menu_position'       => 5,
	'menu_icon'           => 'dashicons-admin-post',
	'show_in_admin_bar'   => TRUE,
	'show_in_nav_menus'   => TRUE,
	'can_export'          => TRUE,
	'has_archive'         => TRUE,
	'exclude_from_search' => FALSE,
	'publicly_queryable'  => TRUE,
	'capability_type'     => 'post',
	'show_in_rest'        => TRUE,
);

// Define this post type
$wol_cpt_post_type = array(
	'post_type' => 'CTP_slug',
	'args'      => $wol_cpt_args,
);
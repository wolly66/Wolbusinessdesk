<?php

/*
 * Products Custom Post Type definition
 *
 * @package     Wolly_BASE
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
*/


$wol_cpt_labels = array(
		'name'                => _x( 'Products', 'Post Type General Name', 'wolly-plugin' ),
		'singular_name'       => _x( 'Product', 'Post Type Singular Name', 'wolly-plugin' ),
		'menu_name'           => __( 'Products', 'wolly-plugin' ),
		'parent_item_colon'   => __( 'Parent Product:', 'wolly-plugin' ),
		'all_items'           => __( 'All Products', 'wolly-plugin' ),
		'view_item'           => __( 'View Poduct', 'wolly-plugin' ),
		'add_new_item'        => __( 'Add New Product', 'wolly-plugin' ),
		'add_new'             => __( 'Add New', 'wolly-plugin' ),
		'edit_item'           => __( 'Edit Product', 'wolly-plugin' ),
		'update_item'         => __( 'Update Product', 'wolly-plugin' ),
		'search_items'        => __( 'Search Product', 'wolly-plugin' ),
		'not_found'           => __( 'Not found', 'wolly-plugin' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'wolly-plugin' ),
		);
	
$wol_cpt_args = array(
		'label'               => __( 'products', 'wolly-plugin' ),
		'description'         => __( 'Products description', 'wolly-plugin' ),
		'labels'              => $wol_cpt_labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => false,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 26,
		'menu_icon'           => 'dashicons-cart',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'show_in_rest'        => false,
		);
	
	
	
	// Define Biography
$wol_cpt_post_type = array(
		'post_type' => 'wol-products',
		'args'      => $wol_cpt_args,
		);
	


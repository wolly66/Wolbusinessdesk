<?php

/*
 * Sample file for Taxonomy definition
 *
 * @package     Wolbusinessdesk
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
*/

// Tool type labels
$wol_tax_labels = array(
	'name'                       => _x( 'Priorities', 'Taxonomy General Name', 'wolbusinessdesk' ),
	'singular_name'              => _x( 'Priority', 'Taxonomy Singular Name', 'wolbusinessdesk' ),
	'menu_name'                  => __( 'Priority', 'wolbusinessdesk' ),
	'all_items'                  => __( 'All Priorities', 'wolbusinessdesk' ),
	'parent_item'                => __( 'Parent Priority', 'wolbusinessdesk' ),
	'parent_item_colon'          => __( 'Parent Priority:', 'wolbusinessdesk' ),
	'new_item_name'              => __( 'New Priority', 'wolbusinessdesk' ),
	'add_new_item'               => __( 'Add New Priority', 'wolbusinessdesk' ),
	'edit_item'                  => __( 'Edit Priority', 'wolbusinessdesk' ),
	'update_item'                => __( 'Update Priority', 'wolbusinessdesk' ),
	'view_item'                  => __( 'View Priority', 'wolbusinessdesk' ),
	'separate_items_with_commas' => __( 'Separate Priorities with commas', 'wolbusinessdesk' ),
	'add_or_remove_items'        => __( 'Add or remove Priorities', 'wolbusinessdesk' ),
	'choose_from_most_used'      => __( 'Choose from the most used', 'wolbusinessdesk' ),
	'popular_items'              => __( 'Popular Priorities', 'wolbusinessdesk' ),
	'search_items'               => __( 'Search Priorities', 'wolbusinessdesk' ),
	'not_found'                  => __( 'Not Found', 'wolbusinessdesk' ),
	'no_terms'                   => __( 'No Priority', 'wolbusinessdesk' ),
	'items_list'                 => __( 'Priorities list', 'wolbusinessdesk' ),
	'items_list_navigation'      => __( 'Priorities list navigation', 'wolbusinessdesk' ),
);

// Tool type args
$wol_tax_args = array(
	'labels'            => $wol_tax_labels,
	'hierarchical'      => TRUE,
	'public'            => TRUE,
	'show_ui'           => TRUE,
	'show_in_menu'      => FALSE,
	'show_admin_column' => TRUE,
	'show_in_nav_menus' => TRUE,
	'show_tagcloud'     => FALSE,
);

// Tool type object type association
$wol_tax_object_type = array(
	'wol-ticket',
);

// Define Tool type
$wol_tax_type = array(
	'taxonomy'    => 'wol-ticket-priority', // Taxonomy name
	'object_type' => $wol_tax_object_type,
	'args'        => $wol_tax_args,
);

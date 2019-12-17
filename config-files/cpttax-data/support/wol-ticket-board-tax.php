<?php

/*
 * Sample file for Taxonomy definition
 *
 * @package    Wolbusinessdesk
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
*/

// Tool type labels
$wol_tax_labels = array(
	'name'                       => _x( 'Tickets Board', 'Taxonomy General Name', 'wolbusinessdesk' ),
	'singular_name'              => _x( 'Ticket Board', 'Taxonomy Singular Name', 'wolbusinessdesk' ),
	'menu_name'                  => __( 'Tickets Board', 'wolbusinessdesk' ),
	'all_items'                  => __( 'All Tickets Board', 'wolbusinessdesk' ),
	'parent_item'                => __( 'Parent Ticket Board', 'wolbusinessdesk' ),
	'parent_item_colon'          => __( 'Parent Ticket Board:', 'wolbusinessdesk' ),
	'new_item_name'              => __( 'New Ticket Board', 'wolbusinessdesk' ),
	'add_new_item'               => __( 'Add New Ticket Board', 'wolbusinessdesk' ),
	'edit_item'                  => __( 'Edit Ticket Board', 'wolbusinessdesk' ),
	'update_item'                => __( 'Update Ticket Board', 'wolbusinessdesk' ),
	'view_item'                  => __( 'View Ticket Board', 'wolbusinessdesk' ),
	'separate_items_with_commas' => __( 'Separate Ticket Board with commas', 'wolbusinessdesk' ),
	'add_or_remove_items'        => __( 'Add or remove Tickets Board', 'wolbusinessdesk' ),
	'choose_from_most_used'      => __( 'Choose from the most used', 'wolbusinessdesk' ),
	'popular_items'              => __( 'Popular Tickets Board', 'wolbusinessdesk' ),
	'search_items'               => __( 'Search Tickets Board', 'wolbusinessdesk' ),
	'not_found'                  => __( 'Not Found', 'wolbusinessdesk' ),
	'no_terms'                   => __( 'No Tickets Board', 'wolbusinessdesk' ),
	'items_list'                 => __( 'Tickets Board list', 'wolbusinessdesk' ),
	'items_list_navigation'      => __( 'Tickets Board list navigation', 'wolbusinessdesk' ),
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
	'taxonomy'    => 'wol-ticket-board', // Taxonomy name
	'object_type' => $wol_tax_object_type,
	'args'        => $wol_tax_args,
);

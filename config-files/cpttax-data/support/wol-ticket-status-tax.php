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
	'name'                       => _x( 'Status', 'Taxonomy General Name', 'wolbusinessdesk' ),
	'singular_name'              => _x( 'Status', 'Taxonomy Singular Name', 'wolbusinessdesk' ),
	'menu_name'                  => __( 'Ticket Status', 'wolbusinessdesk' ),
	'all_items'                  => __( 'All Status', 'wolbusinessdesk' ),
	'parent_item'                => __( 'Parent Status', 'wolbusinessdesk' ),
	'parent_item_colon'          => __( 'Parent Status:', 'wolbusinessdesk' ),
	'new_item_name'              => __( 'New Status', 'wolbusinessdesk' ),
	'add_new_item'               => __( 'Add New Status', 'wolbusinessdesk' ),
	'edit_item'                  => __( 'Edit Status', 'wolbusinessdesk' ),
	'update_item'                => __( 'Update Status', 'wolbusinessdesk' ),
	'view_item'                  => __( 'View Status', 'wolbusinessdesk' ),
	'separate_items_with_commas' => __( 'Separate Status with commas', 'wolbusinessdesk' ),
	'add_or_remove_items'        => __( 'Add or remove Status', 'wolbusinessdesk' ),
	'choose_from_most_used'      => __( 'Choose from the most used', 'wolbusinessdesk' ),
	'popular_items'              => __( 'Popular Status', 'wolbusinessdesk' ),
	'search_items'               => __( 'Search Status', 'wolbusinessdesk' ),
	'not_found'                  => __( 'Not Found', 'wolbusinessdesk' ),
	'no_terms'                   => __( 'No Status', 'wolbusinessdesk' ),
	'items_list'                 => __( 'Status list', 'wolbusinessdesk' ),
	'items_list_navigation'      => __( 'Status list navigation', 'wolbusinessdesk' ),
);

// Tool type args
$wol_tax_args = array(
	'labels'            => $wol_tax_labels,
	'hierarchical'      => TRUE,
	'public'            => TRUE,
	'show_ui'           => TRUE,
	'show_in_menu'      => FALSE,
	'show_admin_column' => TRUE,
	'show_in_nav_menus' => FALSE,
	'show_tagcloud'     => FALSE,
);

// Tool type object type association
$wol_tax_object_type = array(
	'wol-ticket',
);

// Define Tool type
$wol_tax_type = array(
	'taxonomy'    => 'wol-ticket-status', // Taxonomy name
	'object_type' => $wol_tax_object_type,
	'args'        => $wol_tax_args,
);

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
	'menu_name'                  => __( 'Document Status', 'wolbusinessdesk' ),
	'all_items'                  => __( 'All Document Status', 'wolbusinessdesk' ),
	'parent_item'                => __( 'Parent Document Status', 'wolbusinessdesk' ),
	'parent_item_colon'          => __( 'Parent Document Status:', 'wolbusinessdesk' ),
	'new_item_name'              => __( 'New Document Status', 'wolbusinessdesk' ),
	'add_new_item'               => __( 'Add New Document Status', 'wolbusinessdesk' ),
	'edit_item'                  => __( 'Edit Document Status', 'wolbusinessdesk' ),
	'update_item'                => __( 'Update Document Status', 'wolbusinessdesk' ),
	'view_item'                  => __( 'View Document Status', 'wolbusinessdesk' ),
	'separate_items_with_commas' => __( 'Separate Document Status with commas', 'wolbusinessdesk' ),
	'add_or_remove_items'        => __( 'Add or remove Document Status', 'wolbusinessdesk' ),
	'choose_from_most_used'      => __( 'Choose from the most used', 'wolbusinessdesk' ),
	'popular_items'              => __( 'Popular Document Status', 'wolbusinessdesk' ),
	'search_items'               => __( 'Search Document Status', 'wolbusinessdesk' ),
	'not_found'                  => __( 'Not Found', 'wolbusinessdesk' ),
	'no_terms'                   => __( 'No Document Status', 'wolbusinessdesk' ),
	'items_list'                 => __( 'Document Status list', 'wolbusinessdesk' ),
	'items_list_navigation'      => __( 'Document Status list navigation', 'wolbusinessdesk' ),
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
	'wol-client-document',
);

// Define Tool type
$wol_tax_type = array(
	'taxonomy'    => 'wol-document-status', // Taxonomy name
	'object_type' => $wol_tax_object_type,
	'args'        => $wol_tax_args,
);

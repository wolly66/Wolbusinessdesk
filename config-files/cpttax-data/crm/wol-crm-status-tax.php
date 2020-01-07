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
	'name'                       => _x( 'CRM Status', 'Taxonomy General Name', 'wolbusinessdesk' ),
	'singular_name'              => _x( 'CRM Status', 'Taxonomy Singular Name', 'wolbusinessdesk' ),
	'menu_name'                  => __( 'CRM Status', 'wolbusinessdesk' ),
	'all_items'                  => __( 'All CRM Status', 'wolbusinessdesk' ),
	'parent_item'                => __( 'Parent CRM Status', 'wolbusinessdesk' ),
	'parent_item_colon'          => __( 'Parent CRM Status:', 'wolbusinessdesk' ),
	'new_item_name'              => __( 'New CRM CRM', 'wolbusinessdesk' ),
	'add_new_item'               => __( 'Add New Document Status', 'wolbusinessdesk' ),
	'edit_item'                  => __( 'Edit CRM Status', 'wolbusinessdesk' ),
	'update_item'                => __( 'Update CRM Status', 'wolbusinessdesk' ),
	'view_item'                  => __( 'View CRM Status', 'wolbusinessdesk' ),
	'separate_items_with_commas' => __( 'Separate CRM Status with commas', 'wolbusinessdesk' ),
	'add_or_remove_items'        => __( 'Add or remove CRM Status', 'wolbusinessdesk' ),
	'choose_from_most_used'      => __( 'Choose from the most used', 'wolbusinessdesk' ),
	'popular_items'              => __( 'Popular CRM Status', 'wolbusinessdesk' ),
	'search_items'               => __( 'Search CRM Status', 'wolbusinessdesk' ),
	'not_found'                  => __( 'Not Found', 'wolbusinessdesk' ),
	'no_terms'                   => __( 'No Document CRM', 'wolbusinessdesk' ),
	'items_list'                 => __( 'Document CRM list', 'wolbusinessdesk' ),
	'items_list_navigation'      => __( 'Document CRM list navigation', 'wolbusinessdesk' ),
);

// Tool type args
$wol_tax_args = array(
	'labels'            => $wol_tax_labels,
	'hierarchical'      => TRUE,
	'public'            => TRUE,
	'show_ui'           => TRUE,
	'show_in_menu'      => TRUE,
	'show_admin_column' => TRUE,
	'show_in_nav_menus' => FALSE,
	'show_tagcloud'     => FALSE,
);

// Tool type object type association
$wol_tax_object_type = array(
	'wol-crm',
);

// Define Tool type
$wol_tax_type = array(
	'taxonomy'    => 'wol-crm-status', // Taxonomy name
	'object_type' => $wol_tax_object_type,
	'args'        => $wol_tax_args,
);

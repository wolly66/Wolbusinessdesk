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
	'name'                       => _x( 'CRM Type', 'Taxonomy General Name', 'wolbusinessdesk' ),
	'singular_name'              => _x( 'CRM Type', 'Taxonomy Singular Name', 'wolbusinessdesk' ),
	'menu_name'                  => __( 'CRM Type', 'wolbusinessdesk' ),
	'all_items'                  => __( 'All CRM Type', 'wolbusinessdesk' ),
	'parent_item'                => __( 'Parent CRM Type', 'wolbusinessdesk' ),
	'parent_item_colon'          => __( 'Parent CRM Type:', 'wolbusinessdesk' ),
	'new_item_name'              => __( 'New CRM Type', 'wolbusinessdesk' ),
	'add_new_item'               => __( 'Add New CRM Type', 'wolbusinessdesk' ),
	'edit_item'                  => __( 'Edit CRM Type', 'wolbusinessdesk' ),
	'update_item'                => __( 'Update CRM Type', 'wolbusinessdesk' ),
	'view_item'                  => __( 'View CRM Type', 'wolbusinessdesk' ),
	'separate_items_with_commas' => __( 'Separate CRM Type with commas', 'wolbusinessdesk' ),
	'add_or_remove_items'        => __( 'Add or remove CRM Type', 'wolbusinessdesk' ),
	'choose_from_most_used'      => __( 'Choose from the most used', 'wolbusinessdesk' ),
	'popular_items'              => __( 'Popular CRM Type', 'wolbusinessdesk' ),
	'search_items'               => __( 'Search CRM Type', 'wolbusinessdesk' ),
	'not_found'                  => __( 'Not Found', 'wolbusinessdesk' ),
	'no_terms'                   => __( 'No Type CRM', 'wolbusinessdesk' ),
	'items_list'                 => __( 'Type CRM list', 'wolbusinessdesk' ),
	'items_list_navigation'      => __( 'Type CRM list navigation', 'wolbusinessdesk' ),
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
	'taxonomy'    => 'wol-crm-type', // Taxonomy name
	'object_type' => $wol_tax_object_type,
	'args'        => $wol_tax_args,
);

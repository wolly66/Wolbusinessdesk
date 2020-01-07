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
	'name'                       => _x( 'CRM Action', 'Taxonomy General Name', 'wolbusinessdesk' ),
	'singular_name'              => _x( 'CRM Action', 'Taxonomy Singular Name', 'wolbusinessdesk' ),
	'menu_name'                  => __( 'CRM Action', 'wolbusinessdesk' ),
	'all_items'                  => __( 'All CRM Action', 'wolbusinessdesk' ),
	'parent_item'                => __( 'Parent CRM Action', 'wolbusinessdesk' ),
	'parent_item_colon'          => __( 'Parent CRM Action:', 'wolbusinessdesk' ),
	'new_item_name'              => __( 'New CRM Action', 'wolbusinessdesk' ),
	'add_new_item'               => __( 'Add New CRM Action', 'wolbusinessdesk' ),
	'edit_item'                  => __( 'Edit CRM Action', 'wolbusinessdesk' ),
	'update_item'                => __( 'Update CRM Action', 'wolbusinessdesk' ),
	'view_item'                  => __( 'View CRM Action', 'wolbusinessdesk' ),
	'separate_items_with_commas' => __( 'Separate CRM Action with commas', 'wolbusinessdesk' ),
	'add_or_remove_items'        => __( 'Add or remove CRM Action', 'wolbusinessdesk' ),
	'choose_from_most_used'      => __( 'Choose from the most used', 'wolbusinessdesk' ),
	'popular_items'              => __( 'Popular CRM Action', 'wolbusinessdesk' ),
	'search_items'               => __( 'Search CRM Action', 'wolbusinessdesk' ),
	'not_found'                  => __( 'Not Found', 'wolbusinessdesk' ),
	'no_terms'                   => __( 'No Action CRM', 'wolbusinessdesk' ),
	'items_list'                 => __( 'Action CRM list', 'wolbusinessdesk' ),
	'items_list_navigation'      => __( 'Action CRM list navigation', 'wolbusinessdesk' ),
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
	'taxonomy'    => 'wol-crm-action', // Taxonomy name
	'object_type' => $wol_tax_object_type,
	'args'        => $wol_tax_args,
);

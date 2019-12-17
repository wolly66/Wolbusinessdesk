<?php

/*
 * Sample file for Taxonomy definition
 * Refer to https://developer.wordpress.org/reference/functions/register_taxonomy/
 * for details about all settings of the arrays
 */

// An array of labels for this taxonomy. By default, Tag labels are used for
// non-hierarchical taxonomies, and Category labels are used for hierarchical taxonomies.
// See get_taxonomy_labels()
// (https://developer.wordpress.org/reference/functions/get_taxonomy_labels/) for
// a full list of supported labels.
// Register Custom Taxonomy

$wpit_tax_labels = array(
	'name'                       => _x( 'TAXs', 'Taxonomy General Name', 'wpit_tch' ),
	'singular_name'              => _x( 'TAX', 'Taxonomy Singular Name', 'wpit_tch' ),
	'menu_name'                  => __( 'Tax', 'wpit_tch' ),
	'all_items'                  => __( 'All TAXs', 'wpit_tch' ),
	'parent_item'                => __( 'Parent TAX', 'wpit_tch' ),
	'parent_item_colon'          => __( 'Parent TAX:', 'wpit_tch' ),
	'new_item_name'              => __( 'New TAX Name', 'wpit_tch' ),
	'add_new_item'               => __( 'Add New TAX', 'wpit_tch' ),
	'edit_item'                  => __( 'Edit TAX', 'wpit_tch' ),
	'update_item'                => __( 'Update TAX', 'wpit_tch' ),
	'view_item'                  => __( 'View TAX', 'wpit_tch' ),
	'separate_items_with_commas' => __( 'Separate TAXS with commas', 'wpit_tch' ),
	'add_or_remove_items'        => __( 'Add or remove TAXs', 'wpit_tch' ),
	'choose_from_most_used'      => __( 'Choose from the most used', 'wpit_tch' ),
	'popular_items'              => __( 'Popular TAXs', 'wpit_tch' ),
	'search_items'               => __( 'Search TAXs', 'wpit_tch' ),
	'not_found'                  => __( 'Not Found', 'wpit_tch' ),
	'no_terms'                   => __( 'No TAXs', 'wpit_tch' ),
	'items_list'                 => __( 'TAXs list', 'wpit_tch' ),
	'items_list_navigation'      => __( 'TAXs list navigation', 'wpit_tch' ),
);

// Array or query string of arguments for registering a taxonomy .
$wpit_tax_args = array(
	'labels'            => $wpit_tax_labels,
	'hierarchical'      => FALSE,
	'public'            => TRUE,
	'show_ui'           => TRUE,
	'show_admin_column' => TRUE,
	'show_in_nav_menus' => TRUE,
	'show_tagcloud'     => TRUE,
);

// Object type or array of object types with which the taxonomy should be associated.
// (example: post and/or page and/or cpt)
$wpit_tax_object_type = array(
	'',
);

$wpit_tax_type = array(
	'taxonomy'    => 'TAX_slug', // Taxonomy name
	'object_type' => $wpit_tax_object_type,
	'args'        => $wpit_tax_args,
);
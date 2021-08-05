<?php
/**
 * CPT and Taxonomies
 *
 * @package     Wpit The Cooking Hacks
 * @subpackage  Classes/Cpt_and_Tax
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

/**
 * CPT and Taxonomies Class
 *
 * This class handles the CPT and Taxonomies creation.
 *
 * @since 1.0
 */
namespace Wolbusinessdesk\Includes\Abstracts;

class Wol_Cpt_And_Tax {

	///**
	// * Name for the option data where to store a list of created CPTs
	// *
	// * @since  1.0.0
	// * @access private
	// * @var string
	// */
	//public $plugin_cpt_option_name;
	//
	///**
	// * Name for the option data where to store a list of created Taxonomies
	// *
	// * @since  1.0.0
	// * @access private
	// * @var string
	// */
	//public $plugin_tax_option_name;
	//
	///**
	// * An array with the list of created CPTs
	// *
	// * @since  1.0.0
	// * @access private
	// * @var array
	// */
	//public $option_cpt_array;
	//
	///**
	// * An array with the list of created Taxonomies
	// *
	// * @since  1.0.0
	// * @access private
	// * @var string
	// */
	//public $option_tax_array;
	//
	///**
	// * An array with a list of the CPTs created by this plugin
	// *
	// * @since  1.0.0
	// * @access private
	// * @var array
	// */
	public $created_cpt_array;
	//
	///**
	// * * An array with a list of the Taxonomies created by this plugin
	// *
	// * @since  1.0.0
	// * @access private
	// * @var array
	// */
	public $created_tax_array; // array con le tassonomie create dal plugin
	//
	//public $plugin_dir_path;
	//
	//public $theme_dir_path;

	
	/**
	 * __construct function.
	 *
	 * @since 1.0.0
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {

		// Add action to create Custom Post Types if they exist
		//add_action( 'init', array( $this, 'create_cpt' ) );
		// Add action to create Taxonomies if they exist
		//add_action( 'init', array( $this, 'create_tax' ) );

		// Set the option name for the array of the CTP defined
		//$this->plugin_cpt_option_name = 'wpit_cpt_array';

		// Set the option name for the array of the Taxonomies defined
		//$this->plugin_tax_option_name = 'wpit_tax_array';

		// Read the options with a list of the CTP and Taxonomies defined by this plugin
		//$this->option_cpt_array = get_option( $this->plugin_cpt_option_name );
		//$this->option_tax_array = get_option( $this->plugin_tax_option_name );

		// Check for empty options setting them to an empty array
		//$this->option_cpt_array = ( FALSE != $this->option_cpt_array ) ? $this->option_cpt_array : array();
		//$this->option_tax_array = ( FALSE != $this->option_tax_array ) ? $this->option_tax_array : array();
		
		// ! TODO DEBUG DA RIMUOVERE
		//echo '<pre>' . print_r( $this->plugin_dir_path , 1 ) . '</pre>';
		//die();

	}

	/**
	 * Create all the CPT defined in the array fo CPTs definitions
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param
	 *
	 */
	public function create_cpt() {
		
	
		$wol_cpt_post_type = array();

		// Set the pattern to search files for
		$pattern = '-cpt.php';

		// Get the array with all the CPTs definitions files found
		$cpt_files = $this->get_files( $pattern );
				
		// If nothing found return
		if ( ! $cpt_files ) {
			return;
		}

		// Loops all files array
		foreach ( $cpt_files as $cpt_file ) {

			// Include the file only once
			include_once $cpt_file;

			// Register the CPT
			register_post_type( $wol_cpt_post_type['post_type'], $wol_cpt_post_type['args'] );

			// Add it to the list of created CPTs
			$this->created_cpt_array[ $wol_cpt_post_type['post_type'] ] = $wol_cpt_post_type['post_type'];

		}

		// Check for deleted or added CPTs for flushing rerite rules if necessary
		$this->compare_cpt();

	}

	/**
	 * Create all the Taxonomies defined in the array for Taxonomies definitions
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param
	 *
	 */
	public function create_tax() {

		// Set the pattern to search files for
		$pattern = '-tax.php';

		// Get the array with all the Taxonomies definitions files found
		$tax_files = $this->get_files( $pattern );

		// If nothing found return
		if ( ! $tax_files ) {
			return;
		}

		$wol_tax_type = array();

		// Loops all files array
		foreach ( $tax_files as $tax_file ) {

			// Include the file only once
			include_once $tax_file;

			// Register the taxonomy
			register_taxonomy( $wol_tax_type['taxonomy'], $wol_tax_type['object_type'], $wol_tax_type['args'] );

			// Add it to the list of created Taxonomies
			$this->created_tax_array[ $wol_tax_type['taxonomy'] ] = $wol_tax_type['taxonomy'];
		}

		// Check for deleted or added Taxonomies for flushing rerite rules if necessary
		$this->compare_tax();
		

	}

	/**
	 * Compare all the CPT with ones prevoiusly defined, if there is deleted or new then
	 * flush rewrite to updarte rewrite rules eventaully changed
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param
	 *
	 */
	private function compare_cpt() {

		// Calculate the difference between created and saved CPTs
		$count_diff = count( $this->created_cpt_array ) - count( $this->option_cpt_array );
		// Generate the diff array between created and saved CPTs
		$differences = array_diff( $this->created_cpt_array, $this->option_cpt_array );

		// If diff array is greater than 0 or calculate defference are not 0
		if ( 0 < count( $differences ) || ( 0 != $count_diff ) ) {
			//flush rules
			flush_rewrite_rules();
			// Update the option with the new array
			update_option( $this->plugin_cpt_option_name, $this->created_cpt_array );
		}
	}

	/**
	 * Compare all the CPT with ones prevoiusly defined, if there is deleted or new then
	 * flush rewrite to updarte rewrite rules eventaully changed
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param
	 *
	 */
	private function compare_tax() {

		// Calculate the difference between created and saved Taxonomies
		$count_diff = count( $this->created_tax_array ) - count( $this->option_tax_array );
		// Generate the diff array between created and saved Taxonomies
		$differences = array_diff( $this->created_tax_array, $this->option_tax_array );

		// If diff array is greater than 0 or calculate defference are not 0
		if ( 0 < count( $differences ) || ( 0 != $count_diff ) ) {
			//flush rules
			flush_rewrite_rules();
			// Update the option with the new array
			update_option( $this->plugin_tax_option_name, $this->created_tax_array );
		}
	}

	/**
	 * Get all files that defines CPTs or Taxonomies
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @param string $pattern pattern to read files (-cpt.php or -tax.php)
	 *
	 * @return array|boolean $results array of CTPs or Taxonomies definition files or false on error
	 */
	private function get_files( $pattern = NULL ) {

		if ( NULL == $pattern ) {
			return FALSE;
		}

		// Define in what dir looking for cpt and tax configuration files

		$search_path = '';

		// Check if config files directory is in the plugin dir or in the wp-content dir
		if ( is_dir( $this->plugin_dir_path ) ) {
			
			$search_path = $this->plugin_dir_path;
			
		} elseif ( is_dir( $this->theme_dir_path ) ) {
			
			$search_path = $this->theme_dir_path;
			
		}

		if ( $search_path ) {
			$results = glob( $search_path . '*' . $pattern );
		} else {
			$results = array();
		}

		return $results;
	}

}

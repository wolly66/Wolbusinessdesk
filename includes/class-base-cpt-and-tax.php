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
class Wolbusinessdesk_Cpt_And_Tax extends Wol_Cpt_And_Tax{
	
	/**
	 * Name for the option data where to store a list of created CPTs
	 *
	 * @since  1.0.0
	 * @access private
	 * @var string
	 */
	public $plugin_cpt_option_name;

	/**
	 * Name for the option data where to store a list of created Taxonomies
	 *
	 * @since  1.0.0
	 * @access private
	 * @var string
	 */
	public $plugin_tax_option_name;

	/**
	 * An array with the list of created CPTs
	 *
	 * @since  1.0.0
	 * @access private
	 * @var array
	 */
	public $option_cpt_array;

	/**
	 * An array with the list of created Taxonomies
	 *
	 * @since  1.0.0
	 * @access private
	 * @var string
	 */
	public $option_tax_array;

	/**
	 * An array with a list of the CPTs created by this plugin
	 *
	 * @since  1.0.0
	 * @access private
	 * @var array
	 */
	public $created_cpt_array;

	/**
	 * * An array with a list of the Taxonomies created by this plugin
	 *
	 * @since  1.0.0
	 * @access private
	 * @var array
	 */
	public $created_tax_array; // array con le tassonomie create dal plugin
	
	public $plugin_dir_path;
	
	public $theme_dir_path;

	
	/**
	 * A loocked down constructor, therefore the calls cannot be externalli instantiated
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 */
	public function __construct() {

		//// Add action to create Custom Post Types if they exist
		add_action( 'init', array( $this, 'add_cpt' ) );
		
		if ( is_admin() ){
		
			$cpt_array = array( 'wol-client-document', 'wol-document' );
		
			foreach ( $cpt_array as $cpt ){
			
				$add_duplicate = new Wolbusinessdesk_Duplicate_documents( array( $cpt ) );
		
			}
		
		}
		
		//// Add action to create Taxonomies if they exist
		add_action( 'init', array( $this, 'add_tax' ) );

		// Set the option name for the array of the CTP defined
		$this->plugin_cpt_option_name = 'wol-cpt-array';

		// Set the option name for the array of the Taxonomies defined
		$this->plugin_tax_option_name = 'wol-tax-array';

		// Read the options with a list of the CTP and Taxonomies defined by this plugin
		$this->option_cpt_array = get_option( $this->plugin_cpt_option_name );
		$this->option_tax_array = get_option( $this->plugin_tax_option_name );

		// Check for empty options setting them to an empty array
		$this->option_cpt_array = ( FALSE != $this->option_cpt_array ) ? $this->option_cpt_array : array();
		$this->option_tax_array = ( FALSE != $this->option_tax_array ) ? $this->option_tax_array : array();
		
		//$this->plugin_dir_path = WOLBUSINESSDESK_PLUGIN_PATH . 'config-files/cpttax-data/';
				

	}
	
	public function add_cpt(){
		
			
		$this->plugin_dir_path = WOLBUSINESSDESK_PLUGIN_PATH . 'config-files/cpttax-data/support/';
		$this->create_cpt();
				
		$this->plugin_dir_path = WOLBUSINESSDESK_PLUGIN_PATH . 'config-files/cpttax-data/documents/';
		$this->create_cpt();			
				
		$this->plugin_dir_path = WOLBUSINESSDESK_PLUGIN_PATH . 'config-files/cpttax-data/crm/';
		$this->create_cpt();			
			
		$this->plugin_dir_path = WOLBUSINESSDESK_PLUGIN_PATH . 'config-files/cpttax-data/';
		$this->create_cpt();
	}
	
	public function add_tax(){
			
		$this->plugin_dir_path = WOLBUSINESSDESK_PLUGIN_PATH . 'config-files/cpttax-data/support/';
		$this->create_tax();
				
		$this->plugin_dir_path = WOLBUSINESSDESK_PLUGIN_PATH . 'config-files/cpttax-data/documents/';
		$this->create_tax();
		
		$this->plugin_dir_path = WOLBUSINESSDESK_PLUGIN_PATH . 'config-files/cpttax-data/crm/';
		$this->create_tax();
			
		$this->plugin_dir_path = WOLBUSINESSDESK_PLUGIN_PATH . 'config-files/cpttax-data/';
		$this->create_tax();
		
		do_action( 'wol-after-tax-creation' );
	}


	
}

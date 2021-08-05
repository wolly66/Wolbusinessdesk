<?php
/**
 * @package wolbusinessdesk
 * @author Paolo Valenti
 * @version 1.0.1 beta
 */
/*
Plugin Name: wolbusinessdesk
Plugin URI: https://wolbusinessdesk.com
Description: This plugin is for documents, support and CRM
Author: Paolo Valenti aka Wolly
Version: 1.0.1
Author URI: https://paolovalenti.info
License: GPLS2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wolbusinessdesk
*/
/*
	Copyright 2019  Paolo Valenti aka Wolly  (email : wolly66@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

namespace Wolbusinessdesk;
use Wolbusinessdesk\Includes;
use Wolbusinessdesk\Includes\Abstracts;
use Wolbusinessdesk\Includes\Documents;
use Wolbusinessdesk\Includes\Support;

 
// If this file is accessed directory, then abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define ( 'WOLBUSINESSDESK_PLUGIN_ACTIVATED', true );



if ( ! class_exists( 'Wolbusinessdesk' ) ) {
	
	final class Wolbusinessdesk{
		
		/** Singleton *************************************************************/

		/**
		 * wolbusinessdesk instance.
		 *
		 * @access private
		 * @since  1.0
		 * @var    Wolbusinessdesk The one true Wolbusinessdesk where the magic happens
		 */
		private static $instance;

		/**
		 * The version number of wolbusinessdesk.
		 *
		 * @access private
		 * @since  1.0
		 * @var    string
		 */
		private $version = '1.0.1';
		
		
		/**
		 * relationship
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $relationship;
		 		
		/**
		 * cpt_tax
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $cpt_tax;
				
		/**
		 * sendmail
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $sendmail;
		 	  		
		/**
		 * metaboxes
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $metaboxes;
		 			
		/**
		 * endpoints
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $endpoints;
					
		/**
		 * company_info
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $company_info;
		 		
		/**
		 * user_mngt
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $user_mngt;
		 	
		/**
		 * options
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $options;
		 	
		/**
		 * add_pages
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $add_pages;
		 						
		/**
		 * template_loader
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $template_loader;
		 	
		/**
		 * template_wrapper
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $template_wrapper;
		 	
		/**
		 * cockpit
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $cockpit;
		 			
		/**
		 * document_check
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $document_check;
		 		
		/**
		 * document_metaboxes
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $document_metaboxes;
		 			
		/**
		 * client_document
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $client_document;
		 			
		/**
		 * support_check
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $support_check;
		 		
		/**
		 * support_term_meta
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $support_term_meta;
		 	  
		/**
		 * ticket_meta
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $ticket_meta; 
					
		/**
		 * new_support
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $new_support; 
				
		/**
		 * support_reply_loop
		 * 
		 *
		 * @since  1.0
		 * @var mixed
		 * @access public
		 */
		var $support_reply_loop; 	
		
		/**
		 * is
		 * 
		 * @since 1.0
		 * @var mixed
		 * @access public
		 */
		var $is;	
		
		/**
		 * new_task
		 * 
		 * @since 1.0
		 * @var mixed
		 * @access public
		 */
		var $new_task;		
		
		/**
		 * crm_helper_functions
		 * 
		 * @since 1.0
		 * @var mixed
		 * @access public
		 */
		var $crm_helper_functions;
		
		/**
		 * crm_template_wrapper
		 * 
		 * @since 1.0
		 * @var mixed
		 * @access public
		 */
		var $crm_template_wrapper;	
		
		/**
		 * ticket_helper_functions
		 * 
		 * @since 1.0
		 * @var mixed
		 * @access public
		 */
		var $ticket_helper_functions;
		
		/**
		 * crm_meta
		 * 
		 * @since 1.0
		 * @var mixed
		 * @access public
		 */
		var $crm_meta;


	
		/**
		 * Main wolbusinessdesk Instance
		 *
		 * Insures that only one instance of wolbusinessdesk exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @since     1.0
		 * @static
		 * @staticvar array $instance
		 * @uses      Wolbusinessdesk::setup_globals() Setup the globals needed
		 * @uses      Wolbusinessdesk::includes() Include the required files
		 * @uses      Wolbusinessdesk::setup_actions() Setup the hooks and actions
		 * @uses      Wolbusinessdesk::updater() Setup the plugin updater
		 * @return Wolbusinessdesk
		 */
		public static function instance() {
			
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Wolbusinessdesk ) ) {
				self::$instance = new Wolbusinessdesk;

				if ( version_compare( PHP_VERSION, '5.6', '<' ) ) {

					add_action( 'admin_notices', array(
						'wolbusinessdesk',
						'below_php_version_notice'
					) );
					return self::$instance;

				}
								
				self::$instance->setup_constants();
				
				self::$instance->includes();
				
								
				add_action( 'admin_init', array( 
					self::$instance, 
					'add_new_caps'
				) );
				
				add_action( 'pre_get_posts', array( 
					self::$instance, 
					'support_archive_query_vars'
				) );
				
				//add_action( 'plugins_loaded', array(
				//	self::$instance,
				//	'includes'
				//), 10 );
				
				add_action( 'plugins_loaded', array(
					self::$instance,
					'setup_objects'
				), 15 );

				add_action( 'plugins_loaded', array(
					self::$instance,
					'load_textdomain'
				) );

				add_action( 'init', array(
					self::$instance,
					'init_settings'
				) );
				
				add_filter( 'theme_page_templates', array(
					self::$instance,
					'add_template_to_select_for_front_end_admin' 
					), 
					10, 
					4 
				);
					
				add_filter( 'template_include', array(
					self::$instance, 
					'load_plugin_template_for_cockpit' 
				) );
				
				add_filter( 'template_include', array( 
					self::$instance, 
					'custom_template' 
				) );
				
				add_action( 'wp_loaded', array(
				  self::$instance, 
				  'first_install'
				  )
				 );
				 					
			}

			return self::$instance;
		}

		/**
		 * Throw error on object clone
		 *
		 * The whole idea of the singleton design pattern is that there is a single
		 * object therefore, we don't want the object to be cloned.
		 *
		 * @since  1.0
		 * @access protected
		 * @return void
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'wolbusinessdesk' ), '1.0' );
		}

		/**
		 * Disable unserializing of the class
		 *
		 * @since  1.0
		 * @access protected
		 * @return void
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'wolbusinessdesk' ), '1.0' );
		}

		/**
		 * Show a warning to sites running PHP < 5.6
		 *
		 * @static
		 * @access private
		 * @since  1.0
		 * @return void
		 */
		public static function below_php_version_notice() {
			echo '<div class="error"><p>' . __( 'Your version of PHP is below the minimum version of PHP required by Wolbusinessdesk. Please contact your host and request that your version be upgraded to 5.6 or later.', 'wolbusinessdesk' ) . '</p></div>';
		}

		/**
		 * Setup plugin constants
		 *
		 * @access private
		 * @since  1.0
		 * @return void
		 */
		private function setup_constants() {
			// Plugin version
			if ( ! defined( 'WOLBUSINESSDESK_PLUGIN_VERSION' ) ) {
				define( 'WOLBUSINESSDESK_PLUGIN_VERSION', $this->version );
			}
			
			// Plugin version option name
			if ( ! defined( 'WOLBUSINESSDESK_PLUGIN_VERSION_NAME' ) ) {
				define( 'WOLBUSINESSDESK_PLUGIN_VERSION_NAME', 'wolly_base_version' );
			}

			// Plugin Folder Path
			if ( ! defined( 'WOLBUSINESSDESK_PLUGIN_PATH' ) ) {
				define( 'WOLBUSINESSDESK_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'WOLBUSINESSDESK_PLUGIN_DIR' ) ) {
				define( 'WOLBUSINESSDESK_PLUGIN_DIR', plugin_dir_url( __FILE__ ) );
			}

			// Plugin Root File
			if ( ! defined( 'WOLBUSINESSDESK_PLUGIN_FILE' ) ) {
				define( 'WOLBUSINESSDESK_PLUGIN_FILE', __FILE__ );
			}
			
			// Plugin Slug
			if ( ! defined( 'WOLBUSINESSDESK_PLUGIN_SLUG' ) ) {
				define( 'WOLBUSINESSDESK_PLUGIN_SLUG', basename( dirname( __FILE__ ) ) );
			}
			
			// Roles version 
			if ( ! defined( 'WOLBUSINESSDESK_ROLES_VERSION' ) ) {
				define( 'WOLBUSINESSDESK_ROLES_VERSION', '1.0.8' );
			}
			
			// Roles version option name
			if ( ! defined( 'WOLBUSINESSDESK_ROLES_VERSION_OPTION_NAME' ) ) {
				define( 'WOLBUSINESSDESK_ROLES_VERSION_OPTION_NAME', 'wol-roles-version' );
			}
			
			// Base option name
			if ( ! defined( 'WOLBUSINESSDESK_BASE_OPTION_NAME' ) ) {
				define( 'WOLBUSINESSDESK_BASE_OPTION_NAME', 'wol-base-option' );
			}
			// Support option name
			if ( ! defined( 'WOLBUSINESSDESK_SUPPORT_OPTION_NAME' ) ) {
				define( 'WOLBUSINESSDESK_SUPPORT_OPTION_NAME', 'wol-support-option' );
			}
			
			// Document option name
			if ( ! defined( 'WOLBUSINESSDESK_DOCUMENT_OPTION_NAME' ) ) {
				define( 'WOLBUSINESSDESK_DOCUMENT_OPTION_NAME', 'wol-documents-option' );
			}
			
			// Crm option name
			if ( ! defined( 'WOLBUSINESSDESK_CRM_OPTION_NAME' ) ) {
				define( 'WOLBUSINESSDESK_CRM_OPTION_NAME', 'wol-crm-option' );
			}
			
			// Pages option name
			if ( ! defined( 'WOLBUSINESSDESK_PAGES_OPTION_NAME' ) ) {
				define( 'WOLBUSINESSDESK_PAGES_OPTION_NAME', 'wol-pages-option' );
			}
			
			// Company info option name
			if ( ! defined( 'WOLBUSINESSDESK_COMPANY_INFO_OPTION_NAME' ) ) {
				define( 'WOLBUSINESSDESK_COMPANY_INFO_OPTION_NAME', 'wol-company-info-option' );
			}
			
			
			

			// Make sure CAL_GREGORIAN is defined.
			if ( ! defined( 'CAL_GREGORIAN' ) ) {
				define( 'CAL_GREGORIAN', 1 );
			}
										
			self::$instance->support_options = get_option( WOLBUSINESSDESK_SUPPORT_OPTION_NAME );
				
			

		}

		/**
		 * Include required files
		 *
		 * @access public
		 * @since  1.0
		 * @return void
		 */
		public function includes() {

			// Include the autoloader so we can dynamically include the rest of the classes.
			require_once( trailingslashit( dirname( __FILE__ ) ) . 'includes/autoloader.php' );
			
			// Include Functions		
			require_once WOLBUSINESSDESK_PLUGIN_PATH . 'includes/is-template-wrappers.php';							
			require_once WOLBUSINESSDESK_PLUGIN_PATH . 'includes/support/wol-support-template-functions.php';
			require_once WOLBUSINESSDESK_PLUGIN_PATH . 'includes/support/wol-support-helper-functions.php';
			require_once WOLBUSINESSDESK_PLUGIN_PATH . 'includes/support/wol-support-template-functions.php';		
			require_once WOLBUSINESSDESK_PLUGIN_PATH . 'includes/crm/wol-crm-helper-functions.php';
			require_once WOLBUSINESSDESK_PLUGIN_PATH . 'includes/crm/wol-crm-template-functions.php';
							
		}

		/**
		 * Setup all objects
		 *
		 * @access public
		 * @since  1.6.2
		 * @return void
		 */
		public function setup_objects() {

			
			self::$instance->relationship 	= new Includes\Relationship_Db();
			self::$instance->cpt_tax 	  	= new Includes\Base_Cpt_And_Tax();
			self::$instance->sendmail 	  	= new Includes\Sendmail();
			self::$instance->metaboxes 		= new Includes\Metaboxes();
			self::$instance->endpoints 		= new Includes\Register_End_Point();
			self::$instance->company_info 	= new Includes\Company_info();
			self::$instance->is 			= new Includes\Is();
			
			// Instantiate in admin only
			if ( is_admin() ) {
								
				self::$instance->user_mngt 		= new Includes\User_Mngt();
				self::$instance->options 		= new Includes\Backend_Options();
				self::$instance->custom_menus 	= new Includes\Custom_Nav_Menus();
				
				if ( Includes\is_wol_administrator() ){
					
					self::$instance->add_pages 	= new Includes\Add_Pages();
						
				}
								
				
			} else {
				
				self::$instance->template_loader 	= new Includes\Template_Loader();
				self::$instance->template_wrapper 	= new Includes\Template_Wrapper();
				self::$instance->cockpit 			= new Includes\Cockpit();
								

			}
			
			// Instance of documents class
			self::$instance->document_check = new Includes\Documents\Check();
			
			// Admin only used class
			if ( is_admin() ) {
				
				self::$instance->document_metaboxes = new Includes\Documents\Metaboxes();
				
				} else {
					
					self::$instance->client_document = new Includes\Documents\Client_Document();
			}


			// Instance of support class				
			self::$instance->support_check = new Includes\Support\Check();
			
			// Admin only used class
			if ( is_admin() ) {
				
				self::$instance->support_term_meta = new Includes\Support\Term_Meta();
				
			} else {
					
				self::$instance->ticket_meta 			= new Includes\Support\Meta();
				self::$instance->new_support 			= new Includes\Support\New_Ticket();
				self::$instance->support_reply_loop 	= new Includes\Support\Reply_Loop();
			}
			self::$instance->ticket_helper_functions 	= new Includes\Support\Helper_Functions();
			//instance of CRM
			
			
			// Admin only used class
			if ( is_admin() ) {
				
				
				
			} else {
					
				self::$instance->crm_meta 			= new Includes\Crm\Meta();
				self::$instance->new_task 			= new Includes\Crm\New_Task();
				
			}
			
			self::$instance->crm_template_wrapper 	= new Includes\Crm\Template_Wrappers();
			self::$instance->crm_helper_functions 	= new Includes\Crm\Helper_functions();
			
			//self::$instance->updater();
			
			
			// Enqueue general scripts and styles in admin
			add_action( 'admin_enqueue_scripts', array(
				self::$instance,
				'enqueue_admin_script_and_style'
			) );

			// Enqueue general scripts and styles in frontend
			add_action( 'wp_enqueue_scripts', array(
				self::$instance,
				'enqueue_frontend_script_and_style'
			) );
		}
		
			

		/**
		 * Init settings
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function init_settings() {

			wp_cache_add_non_persistent_groups( array ( 'wol-session' ) );
			
		}

		/**
		 * Plugin Updater
		 *
		 * @access private
		 * @since  1.0
		 * @return void
		 */
		private function updater() {

			//TODO: Maybe

		}

		/**
		 * Loads the plugin language files
		 *
		 * @access public
		 * @since  1.0
		 * @return void
		 */
		public function load_textdomain() {

			// Set filter for plugin's languages directory
			$lang_dir = dirname( plugin_basename( WOLBUSINESSDESK_PLUGIN_FILE ) ) . '/languages/';

			
			// Load the default language files
			load_plugin_textdomain( 'wolbusinessdesk', FALSE, $lang_dir );
			
		}
		
		/**
		 * enqueue_admin_script_and_style function.
		 * 
		 * @access public
		 * @param mixed $hook
		 * @return void
		 */
		public function enqueue_admin_script_and_style( $hook ) {
			
			if( null !== ( $screen = get_current_screen() ) && 'wolbusinessdesk_page_wolbusinessdesk-settings' === $screen->id && ( 'wolbusinessdesk_page_wolbusinessdesk-settings' === $screen->id || 'wolly_base' == $_GET['tab'] ||  'wolly_support' == $_GET['tab'] ) ){
			
				wp_register_style( 'lc_switch', plugins_url('/assets/css/lc_switch.css' , __FILE__ ));
				wp_enqueue_style( 'lc_switch' );
	
				wp_enqueue_script( 'ls_switch', plugins_url( '/assets/js/lc_switch.min.js', __FILE__ ), array( 'jquery' ), '', true  );
				wp_enqueue_script( 'ls_switch_checkbox', plugins_url( '/assets/js/lc_switch_checkbox.js', __FILE__ ), array( 'jquery', 'ls_switch' ), '', true  );
			}
			
			// add color picker to term ticket status
			if( null !== ( $screen = get_current_screen() ) && 'edit-wol-ticket-status' === $screen->id ) {
		       
		    	// Colorpicker Scripts
			    wp_enqueue_script( 'wp-color-picker' );
		 
				// Colorpicker Styles
				wp_enqueue_style( 'wp-color-picker' );
			
				// color picker custom jQuery
				wp_enqueue_script( 'ticket_color_picker', plugins_url( 'assets/js/ticket-color-picker.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), '', true  );		
			
			}
			
			wp_enqueue_script( 'wol_autocomplete', plugins_url( 'assets/js/autocomplete.documents.js', __FILE__ ), array( 'jquery' ), '', true  );
			
		
		}
		
		/**
		 * enqueue_frontend_script_and_style function.
		 * 
		 * @access public
		 * @return void
		 */
		public function enqueue_frontend_script_and_style() {
			
			wp_enqueue_script( 'jquery-ui-autocomplete' );
			wp_register_script( 'wol_autocomplete', plugins_url( 'assets/js/autocomplete.documents.js', __FILE__ ), array( 'jquery', 'jquery-ui-autocomplete' ), '', false );
			// Localize the script with new data
			$translation_array = array(
				'ajaxurl' =>  admin_url( 'admin-ajax.php' ),
				
				
				);
			wp_localize_script( 'wol_autocomplete', 'wolbusinessdesk', $translation_array );
			
			wp_enqueue_script( 'wol_autocomplete' );
			
			wp_register_style( 'wolly_support_css_frontend', plugins_url('/assets/css/ticket.css' , __FILE__ ));
			wp_enqueue_style( 'wolly_support_css_frontend' );
			
			wp_enqueue_script( 'toggle-left-sidebar', plugins_url( '/assets/js/toggle.left.admin.sidebar.js', __FILE__ ), array( 'jquery' ), '', true  );
			
			if( ! wp_script_is( 'bootstrap', 'enqueued' ) && ! wp_style_is( 'bootstrap', 'queue' ) && ! wp_style_is( 'bootstrap', 'done' ) ) {
				
				wp_register_style( 'bootstrap', plugins_url('/libs/bootstrap/css/bootstrap.min.css' , __FILE__ ) );
				wp_enqueue_style( 'bootstrap' );
				
				wp_register_style( 'bootstrap-theme', plugins_url('/libs/bootstrap/css/bootstrap-theme.min.css' , __FILE__ ) );
				wp_enqueue_style( 'bootstrap-theme' );

				wp_enqueue_script( 'bootstrap', plugins_url( 'libs/bootstrap/js/bootstrap.min.js' , __FILE__ ), array('jquery'), time(), true );
			}

			wp_enqueue_script( 'jquery-ui-datepicker' );
			
			wp_enqueue_style( 'jquery-ui','//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
		}
		
		/**
		 * add_new_caps function.
		 * 
		 * @access public
		 * @static
		 * @return void
		 */
		public static function add_new_caps(){
			
			 if ( is_admin() ) {
		
			 	if ( version_compare( get_option( WOLBUSINESSDESK_ROLES_VERSION_OPTION_NAME ), WOLBUSINESSDESK_ROLES_VERSION ) != 0  ) {

			 		//add new caps to new roles

			 		// gets the administrator role
			 		$role = get_role( 'administrator' );
			 		$role->add_cap( 'wol_can_wolbusinessdesk_administrator' );
			 		$role->add_cap( 'wol_can_ticket_administrator' );
			 		$role->add_cap( 'wol_can_crm_administrator' );
			 		$role->add_cap( 'wol_can_client_administrator' );
			 		
			 		$role->add_cap( 'wol_can_add_new_ticket' );
			 		$role->add_cap( 'wol_can_assign_owner' );
			 		$role->add_cap( 'wol_can_own_ticket' );
			 		
			 		$role->add_cap( 'wol_manage_new_client_document' );
			 		
			 		$role->add_cap( 'wol_can_add_new_task' );
			 	

			 		// gets the editor role
			 		$role = get_role( 'editor' );
			 		

			 		// gets the author role
			 		$role = get_role( 'author' );
			 		
			 		
			 		update_option( WOLBUSINESSDESK_ROLES_VERSION_OPTION_NAME, WOLBUSINESSDESK_ROLES_VERSION );

			 	}
			 	
			 }
		}

		/**
		 * Add "Custom" template to page attirbute template section.
		*/
		public function add_template_to_select_for_front_end_admin( $post_templates, $wp_theme, $post, $post_type ) {
		
			if ( ! isset( $post_templates['wol-cockpit.php'] ) ){
			
				// Add custom template named template-custom.php to select dropdown 
				$post_templates['wol-cockpit.php'] = __('Wolbusinessdesk Cockpit');
			
			}
		
			return $post_templates;
		}



		/**
		 * Check if current page has our custom template. Try to load
		 * template from theme directory and if not exist load it 
		 * from root plugin directory.
		 */
		public function load_plugin_template_for_cockpit( $template ) {
			
			$theme = get_stylesheet_directory();
			
			// ! TODO CHECK PAGE ID FROM OPTIONS
		    if(  get_page_template_slug() === 'wol-cockpit.php' ) {
			    
			    if (  file_exists(  $theme . '/wolbusinessdesk-templates/wol-cockpit.php' ) ){
			        
		            $template = $theme_file;
		            
		        } else {
			        
		            $template = WOLBUSINESSDESK_PLUGIN_PATH . '/wolbusinessdesk-templates/wol-cockpit.php';
		            
		        }
		    }
		
		    if( $template == '' ) {
		        throw new \Exception('No template found');
		    }
		
		    return $template;
		}
	
		/**
    	 * Use the plugin template file to display the CPT
    	 * http://codex.wordpress.org/Conditional_Tags
    	 *
    	 * https://wordpress.stackexchange.com/questions/32297/use-template-include-with-custom-post-types
    	 *
    	 * @param string $template
    	 * @return string
    	 **/
    	public function custom_template( $template ){
		    
		  	if ( ! is_admin() ){
			    
			   
			    /**
			     * theme
			     * 
			     * (default value: get_stylesheet_directory())
			     * 
			     * @var mixed
			     * @access public
			     * @since 1.0
			     *
			     * @return stylesheet directory
			     */
			    $theme = get_stylesheet_directory();
				
				/**
				 * Support templates
				 *
				 * @since 1.0
				 *
				 */
				
				if ( is_post_type_archive( 'wol-ticket' ) ){
		        
		        	if ( ! file_exists( $theme . '/wolbusinessdesk-templates/support/archive-wol-ticket.php' ) ){
    	    
						return WOLBUSINESSDESK_PLUGIN_PATH . '/wolbusinessdesk-templates/support/archive-wol-ticket.php';
    	        
    	        		} else {
		        
							return $theme . '/wolbusinessdesk-templates/support/archive-wol-ticket.php';
    	        	}
    	        
    	    	}
    	    	
				if ( is_singular(  'wol-ticket' ) ){
		        	
					if ( ! file_exists( $theme . '/wolbusinessdesk-templates/support/single-wol-ticket.php' ) ){
					
						return WOLBUSINESSDESK_PLUGIN_PATH . '/wolbusinessdesk-templates/support/single-wol-ticket.php';
					
    	        		} else {
		        			
		        			return $theme . '/wolbusinessdesk-templates/support/single-wol-ticket.php';
		        		
    	        	}
			
				}
				
				/**
				 * Document templates
				 *
				 * @since 1.0
				 *
				 */
				if ( is_post_type_archive( 'wol-client-document' ) ){
		        
		        	if ( ! file_exists( $theme . '/wolbusinessdesk-templates/document/archive-wol-client-document.php' ) ){
    	    
						return WOLBUSINESSDESK_PLUGIN_PATH . '/wolbusinessdesk-templates/document/archive-wol-client-document.php';
    	        
    	        		} else {
		        
							return $theme . '/wolbusinessdesk-templates/document/archive-wol-client-document.php';
    	        	}
    	        
    	    	}
    	    	
				if ( is_singular(  'wol-client-document' ) ){
		        	
					if ( ! file_exists( $theme . '/wolbusinessdesk-templates/document/single-wol-client-document.php' ) ){
					
						return WOLBUSINESSDESK_PLUGIN_PATH . '/wolbusinessdesk-templates/document/single-wol-client-document.php';
					
    	        		} else {
		        			
		        			return $theme . '/wolbusinessdesk-templates/document/single-wol-client-document.php';
		        		
    	        	}
			
				}
				
				/**
				 * CRM templates
				 *
				 * @since 1.0
				 *
				 */
				
				if ( is_post_type_archive( 'wol-crm' ) ){
		        
		        	if ( ! file_exists( $theme . '/wolbusinessdesk-templates/crm/archive-wol-crm.php' ) ){
    	    
						return WOLBUSINESSDESK_PLUGIN_PATH . '/wolbusinessdesk-templates/crm/archive-wol-crm.php';
    	        
    	        		} else {
		        
							return $theme . '/wolbusinessdesk-templates/crm/archive-wol-crm.php';
    	        	}
    	        
    	    	}
    	    	
				if ( is_singular(  'wol-crm' ) ){
		        	
					if ( ! file_exists( $theme . '/wolbusinessdesk-templates/crm/single-wol-crm.php' ) ){
					
						return WOLBUSINESSDESK_PLUGIN_PATH . '/wolbusinessdesk-templates/crm/single-wol-crm.php';
					
    	        		} else {
		        			
		        			return $theme . '/wolbusinessdesk-templates/crm/single-wol-crm.php';
		        		
    	        	}
			
				}

						
			} // ! is_admin
    	    
			return $template;
    	    
    	}
    
	
    	/**
    	 * support_archive_query_vars function.
    	 * 
    	 * @access public
    	 * @param mixed $query
    	 * @return void
    	 */
    	public function support_archive_query_vars( $query ){
		    
			if ( ! is_admin() ){
				
				if ( is_post_type_archive( 'wol-ticket' ) && $query->is_main_query() ){
					
					$query->set( 'post_type', array( 'wol-ticket' ) );
					
					$query->set( 'posts_per_page', self::$instance->support_options['listing-tickets-per-page'] );
		
					$query->set( 'orderby', 'title' );
		
					$query->set( 'order', 'ASC' );
					
					if ( 0 < self::$instance->support_options['listing-priority'] ) {
								
						$priority_query_args = array (
							'taxonomy' => 'wol-ticket-priority',
							'field' => 'term_id',
							'terms' => array( self::$instance->support_options['listing-priority'] ),
							'operator'=> 'IN'
						);
								
						} else {
									
							$priority_query_args = '';
									
					}
					
							
					if ( 0 < self::$instance->support_options['listing-status'] ) {
							 	
						$status_operator = ( 1 == self::$instance->support_options['listing-status-operator'] ) ? 
							'NOT IN' : 
							'IN';
								
						$status_query_args = array (
							'taxonomy'	=> 'wol-ticket-status',
							'field' 		=> 'term_id',
							'terms' 		=> array ( (int)self::$instance->support_options['listing-status'] ),
							'operator'	=> $status_operator,
						);
								
						} else {
									
							$status_query_args = '';
									
					}
		
					if ( 0 < self::$instance->support_options['listing-type'] ) {
								
						$type_query_args = array (
							'taxonomy'	=> 'wol-ticket-type',
							'field' 		=> 'term_id',
							'terms' 		=> array ( (int)self::$instance->support_options['listing-type'] ),
							'operator'	=> 'IN',
						);
								
						} else {
									
							$type_query_args = '';
									
					}
					
					
					$tax_query = array( 
									
						'relation' => 'AND',
						
						$status_query_args,
					
						$type_query_args,
					
						$priority_query_args,
					
					);
					
					if (  isset( $_POST['archive_ticket_task_nonce_name'] ) &&  wp_verify_nonce( $_POST['archive_ticket_task_nonce_name'], 'archive_ticket_task_nonce_action' ) ) {
						
						$tax_query = array();
						
						if ( isset( $_POST['priority'] ) && is_numeric( $_POST['priority'] ) ){
							
						 	if ( 0 < $_POST['priority'] ) {
								
								$priority_query_args = array (
									'taxonomy'	=> 'wol-ticket-priority',
									'field' 		=> 'term_id',
									'terms' 		=> array ( (int)$_POST['priority'] ),
									'operator'	=> 'IN',
								);
								
								} else {
									
									$priority_query_args = '';
									
							}
								
		
						}
						
						if ( isset( $_POST['type'] ) && is_numeric( $_POST['type'] ) ){
							
						 	if ( 0 < $_POST['type'] ) {
								
								$type_query_args = array (
									'taxonomy'	=> 'wol-ticket-type',
									'field' 		=> 'term_id',
									'terms' 		=> array ( (int)$_POST['type'] ),
									'operator'	=> 'IN',
								);
								
								} else {
									
									$type_query_args = '';
									
							}
								
		
						}
						
						if ( isset( $_POST['status'] ) && is_numeric( $_POST['status'] ) ){
							
						 	if ( 0 < $_POST['status'] ) {
							 	
							 	$status_operator = ( 1 == $_POST['status_operator'] ) ? 
							 		'NOT IN' : 
							 		'IN';
								
								$status_query_args = array (
									'taxonomy'	=> 'wol-ticket-status',
									'field' 		=> 'term_id',
									'terms' 		=> array ( (int)$_POST['status'] ),
									'operator'	=> $status_operator,
								);
								
								} else {
									
									$status_query_args = '';
									
							}
								
		
						}
		
						
						$tax_query = array( 
									
							'relation' => 'AND',
						
							$priority_query_args,
						
							$type_query_args,
						
							$status_query_args,
						
						);
					
					}
					
					$query->set( 'tax_query', $tax_query );
					
					
    			}
			} 
		
			return $query;
		}
		
	
		/**
		 * get_pages_permalink function.
		 *
		 * @access public
		 * @return $pages_permalink
		 */
		public function get_pages_permalink(){
		
			$pages_permalink_transient = get_transient( 'wol-permalinks-transient' );
		
			if ( empty( $page_permalink_transient ) ) {
		
				$option = get_option( WOLBUSINESSDESK_PAGES_OPTION_NAME );
		
				$pages_permalink = array(
		
					'id_new_support_request' 		=> ( ! empty( $option['id_new_support_request'] ) )
					  ? get_permalink( $option['id_new_support_request'] )
					  : '#',
					'id_front_end_admin' 		=> ( ! empty( $option['id_front_end_admin'] ) )
					  ? get_permalink( $option['id_front_end_admin'] )
					  : '#',
				);
		
				//Set transient for 30 days
				set_transient( 'wol-permalinks-transient', $pages_permalink, 30 * DAY_IN_SECONDS );
		
			} else {
		
				$pages_permalink = $pages_permalink_transient;
			}
		
			return $pages_permalink;
		
		}
	
 		/**
 		 * first_install function.
 		 * 
 		 * @access public
 		 * @return void
 		 */
 		public function first_install(){
 		
 		// ! TODO SAVE ENDPOINTS IN PAGES OPTIONS
 		/**
 		 * first_install
 		 * 
 		 * (default value: get_option( 'wol-first-install' ))
 		 * 
 		 * @var string
 		 * @access public
 		 */
 		$first_install = get_option( 'wol-first-install' );
 				
 		if ( empty( $first_install ) || ( ! empty( $first_install) && TRUE != $first_install ) ){
 			
 			
 			/* Ticket settings */
 			/**
 			 * status_new
 			 * 
 			 * (default value: wp_insert_term( __( 'New', 'wolbusinessdesk' ), 'wol-ticket-status' ))
 			 * 
 			 * @var string
 			 * @access public
 			 */
 			$status_new = wp_insert_term( __( 'New', 'wolbusinessdesk' ), 'wol-ticket-status' );
 				
 			update_term_meta( (int)$status_new['term_id'], '_category_color', sanitize_hex_color_no_hash( '#dd3333' ) );
 			
 			/**
 			 * status_close
 			 * 
 			 * (default value: wp_insert_term( __( 'Closed', 'wolbusinessdesk' ), 'wol-ticket-status' ))
 			 * 
 			 * @var string
 			 * @access public
 			 */
 			$status_close = wp_insert_term( __( 'Closed', 'wolbusinessdesk' ), 'wol-ticket-status' );
 			
 			update_term_meta( (int)$status_close['term_id'], '_category_color', sanitize_hex_color_no_hash( '#81d742' ) );
 			
 			/**
 			 * priority
 			 * 
 			 * (default value: wp_insert_term( __( 'Normal', 'wolbusinessdesk' ), 'wol-ticket-priority' ))
 			 * 
 			 * @var string
 			 * @access public
 			 */
 			$priority = wp_insert_term( __( 'Normal', 'wolbusinessdesk' ), 'wol-ticket-priority' );
 			
 			/**
 			 * type
 			 * 
 			 * (default value: wp_insert_term( __( 'Question', 'wolbusinessdesk' ), 'wol-ticket-type' ))
 			 * 
 			 * @var string
 			 * @access public
 			 */
 			$type = wp_insert_term( __( 'Question', 'wolbusinessdesk' ), 'wol-ticket-type' );
 			
 			/**
 			 * board
 			 * 
 			 * (default value: wp_insert_term( __( 'General', 'wolbusinessdesk' ), 'wol-ticket-board' ))
 			 * 
 			 * @var string
 			 * @access public
 			 */
 			$board = wp_insert_term( __( 'General', 'wolbusinessdesk' ), 'wol-ticket-board' );
 			
 			update_term_meta( (int)$board['term_id'], 'wol_is_public_board', true );
 			
 			/**
 			 * args
 			 * 
 			 * @var mixed
 			 * @access public
 			 */
 			$args_support =	array(
 			  	'status' 							=> (int)$status_close['term_id'],
 			  	'opening_status' 					=> (int)$status_new['term_id'],
 			  	'listing-type' 						=> (int)$type,
 			  	'listing-priority'					=> (int)$priority,
 			  	'listing-status-operator' 			=> 1,
 			  	'listing-status' 					=> (int)$status_close['term_id'],
 			  	'listing-tickets-per-page' 			=> 20,
 			  	'listing-ticket-replies-per-page' 	=> 20,
 			  	'sorting' 							=> 'DESC',
 			  	
 			);
 			  	
 			add_option( WOLBUSINESSDESK_SUPPORT_OPTION_NAME, $args_support );
 			 
 			/* Documents settings */
 			
 			/**
 			 * opening_doc
 			 * 
 			 * (default value: wp_insert_term( __( 'Open', 'wolbusinessdesk' ), 'wol-document-status' ))
 			 * 
 			 * @var string
 			 * @access public
 			 */
 			$opening_doc = wp_insert_term( __( 'Open', 'wolbusinessdesk' ), 'wol-document-status' );
 			
 			/**
 			 * approved_doc
 			 * 
 			 * (default value: wp_insert_term( __( 'Approved', 'wolbusinessdesk' ), 'wol-document-status' ))
 			 * 
 			 * @var string
 			 * @access public
 			 */
 			$approved_doc = wp_insert_term( __( 'Approved', 'wolbusinessdesk' ), 'wol-document-status' );
 			
 			/**
 			 * rejected_doc
 			 * 
 			 * (default value: wp_insert_term( __( 'Rejected', 'wolbusinessdesk' ), 'wol-document-status' ))
 			 * 
 			 * @var string
 			 * @access public
 			 */
 			$rejected_doc = wp_insert_term( __( 'Rejected', 'wolbusinessdesk' ), 'wol-document-status' );
 			 
 			/**
 			 * args_doc
 			 * 
 			 * @var mixed
 			 * @access public
 			 */
 			$args_doc =	array(
 			  	'doc_opening_status' 				=> (int)$opening_doc['term_id'],
 			  	'doc_approve_status' 				=> (int)$approved_doc['term_id'],
 			  	'doc_reject_status'					=> (int)$rejected_doc['term_id'],
 			  	
 			  	
 			);
 			
 			add_option( WOLBUSINESSDESK_DOCUMENT_OPTION_NAME, $args_doc );
 			
 			/* Crm settings */
 			
 			/**
 			 * opening_crm
 			 * 
 			 * (default value: wp_insert_term( __( 'Open', 'wolbusinessdesk' ), 'wol-crm-status' ))
 			 * 
 			 * @var string
 			 * @access public
 			 */
 			$opening_crm = wp_insert_term( __( 'Open', 'wolbusinessdesk' ), 'wol-crm-status' );
 			
 			/**
 			 * closing_crm
 			 * 
 			 * (default value: wp_insert_term( __( 'Approved', 'wolbusinessdesk' ), 'wol-crm-status' ))
 			 * 
 			 * @var string
 			 * @access public
 			 */
 			$closing_crm = wp_insert_term( __( 'Approved', 'wolbusinessdesk' ), 'wol-crm-status' );
 			
 			/**
 			 * args_crm
 			 * 
 			 * @var mixed
 			 * @access public
 			 */
 			$args_crm =	array(
 			  	'crm_opening_status' 	=> (int)$opening_crm['term_id'],
 			  	'crm_status' 			=> (int)$closing_crm['term_id'],
 			  	
 			  	
 			);
 			
 			add_option( WOLBUSINESSDESK_CRM_OPTION_NAME, $args_crm );
 			
 			/* Job is done */
 			add_option( 'wol-first-install', TRUE );
 		 
 		}
 	
 		}
 		
 		// ! TODO DA RINUOVERE
 		public function add_menu_and_submenus(){
 			
 			
 			add_menu_page( 'Wolbusinessdesk', 'Wolbusinessdesk', 'manage_options', 'wolbusinessdesk');
 			
 			add_submenu_page( 'wolbusinessdesk', 'Wolbusinessdesk', 'Wolbusinessdesk', 'manage_options', 'wolbusinessdesk');
 		}	
			
		
	
 		public function reset_all(){
 			
 			delete_option( 'wol-aa_plug_relationships-db-ver' );
 			
 			delete_option( 'wol-cpt-array' );
 			
 			delete_option( 'wol-pages-option' );
 			
 			delete_option( 'wol-pages-version' );
 			
 			delete_option( 'wol-roles-version' );
 			
 			delete_option( 'wol-base-option' );
 			
 			delete_option( 'wol-company-info-option' );
 			
 			delete_option( 'wol-documents-option' );
 			
 			delete_option( 'wol-support-option' );
 			
 			delete_option( 'wol-crm-option' );
 			
 			delete_option( 'wol-ticket-status_children' );
 			
 			delete_option( 'wol-ticket-priority_children' );
 			
 			delete_option( 'wol-ticket-type_children' );
 			
 			delete_transient( '_transient_timeout_wol-permalinks-transient' );
 			
 			delete_transient( '_transient_wol-permalinks-transient' );
 			
 				
 			
 			
 			
 		}
	
	} // end class Wolbusinessdesk 	
	
} // end ! class_exists( 'Wolbusinessdesk' )

/**
 * The main function responsible for returning the one true Wolbusinessdesk
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $wolbusinessdesk = wolbusinessdesk(); ?>
 *
 * @since 1.0
 * @return wolbusinessdesk The one true wolbusinessdesk Instance
 */
function wol() {
	
	return Wolbusinessdesk::instance();
}

wol();


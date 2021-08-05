<?php
	namespace Wolbusinessdesk\Includes\Support;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Helper_Functions' ) ){

	class Helper_Functions{
		
		var $allowed_cpt;
		
		public function __construct(){
			
			$this->allowed_cpt = $this->allowed_cpt();
		}
		
		public static function allowed_cpt(){
			
			$cpt = array(
				'wol-ticket' 			=> __( 'Support', 'wolbusinessdesk' ),
				'wol-client-document'	=> __( 'Documents', 'wolbusinessdesk' ),
				'wol-crm'				=> __( 'CRM', 'wolbusinessdesk' ),
			);
			
			return $cpt;
		}
		

		
		/**
		 * get_crm_numerator function.
		 * 
		 *
		 * @since 1.0
		 * @access public
		 * @return $crm_numerator
		 */
		public function get_ticket_numerator(){
			
			// ! TODO add filter to manage different numerator for premium version

			
			/**
			 * crm_numerator
			 * 
			 * (default value: get_option('wol-crm-numerator'))
			 * 
			 * @since 1.0
			 * @var string
			 * @access public
			 */
			$crm_numerator = get_option('wol-ticket-numerator');
			
			if ( ! $crm_numerator ){
			
				$crm_numerator = 0;
			}
			
			return $crm_numerator;

		}
		
		/**
		 * get_new_crm_numerator function.
		 * 
		 * @since 1.0
		 * @access public
		 * @static
		 * @return $new_numerator
		 */
		public function get_new_ticket_numerator(){
			
			$current_numerator = $this->get_ticket_numerator();
			
			$new_numerator = $current_numerator + 1;
			
			update_option('wol-ticket-numerator', $new_numerator );
			
			return $new_numerator;
			
		}
	
	
	}// End class

} // End if class exists
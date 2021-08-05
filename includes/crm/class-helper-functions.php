<?php
	namespace Wolbusinessdesk\Includes\Crm;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Helper_functions' ) ){

	class Helper_functions{
		
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
		
		public function add_external_task_to_crm( $args = '' ){
						
			if ( 
				empty( $args )
				|| ! is_numeric( $args['id'] )
				|| 0 >= $args['id']
				|| ! array_key_exists( $args['cpt'], $this->allowed_cpt )
				|| empty( $args['title'] )
				|| ! is_numeric( $args['status'] )
				|| 0 >= $args['status']
				){
			
				return FALSE;
				
			} else {
			
				$defaults = array(
					'id'    	=> '',
					'title' 	=> '',
					'cpt' 		=> '',
					'status' 	=> '',
					'due_date'	=> '',
					
				);
				
				//Parse the passed argument in an array combining with $defaults values
				$args 				= wp_parse_args( $args, $defaults );
						
				$crm_options 		= get_option( WOLBUSINESSDESK_CRM_OPTION_NAME );			
				$crm_open_status 	= $crm_options['crm_opening_status'];
				
				if ( 'wol-ticket' == $args['cpt'] ){
					
					$ticket_options = get_option( WOLBUSINESSDESK_SUPPORT_OPTION_NAME );
					
					if ( $args['status'] == $ticket_options['opening_status'] ){
						
						$status = $crm_options['crm_opening_status'];
						
					} else {
						
						$status = 0;
					}
					
				}
				/**
				 * tax_input
				 * 
				 * (default value: array())
				 * 
				 * @since 1.0
				 * @var array
				 * @access public
				 */
				$tax_input = array();
				
				$tax_input['wol-crm-status']  =  array( (int)$status );
				
				/**
				 * meta_input
				 * 
				 * (default value: array())
				 * 
				 * 
				 * @since 1.0
				 * @var array
				 * @access public
				 */
				$meta_input = array();
				
				if ( 
					isset( $args['due_date'] )
					&& ! empty( $args['due_date'] )
					){
						
						$meta_input['wol_due_date'] = $args['due_date'];
						
				} 
				
				$meta_input['wol_original_source_id'] 	= $args['id'];
				$meta_input['wol_original_type'] 		= $args['cpt'];
				$meta_input['wol_crm_number'] 			= $this->get_new_crm_numerator();
				
				// Add the content of the form to $post as an array 
				$post = array(
					'post_title' 		=> wp_strip_all_tags( $args['title'] ),
					'post_status' 		=> 'publish',   // Choose: publish, preview, future, etc.
					'post_type' 		=> 'wol-crm',  // Use a custom post type if you want to
					'comment_status' 	=> 'closed',
					'ping_status' 		=> 'closed',
					'tax_input'			=> $tax_input,
					'meta_input'		=> $meta_input,
				);
				
				/**
				 * new_crm_id
				 * 
				 * (default value: wp_insert_post( $post ))
				 * 
				 * @since 1.0
				 * @var mixed
				 * @access public
				 */
				$new_crm_id = wp_insert_post( $post );  // http://codex.wordpress.org/Function_Reference/wp_insert_post
				
				/**
				 *
				 * @since 1.0
				 * Add crm CPT ID as postmeta to original CPT
				 *
				 */
				update_post_meta( $args['id'], 'wol_crm_id', $new_crm_id );
												
			
			}
			
			
		}
		
		/**
		 * get_crm_numerator function.
		 * 
		 *
		 * @since 1.0
		 * @access public
		 * @return $crm_numerator
		 */
		public function get_crm_numerator(){
			
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
			$crm_numerator = get_option('wol-crm-numerator');
			
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
		public function get_new_crm_numerator(){
			
			$current_numerator = $this->get_crm_numerator();
			
			$new_numerator = $current_numerator + 1;
			
			update_option('wol-crm-numerator', $new_numerator );
			
			return $new_numerator;
			
		}
	
	
	}// End class

} // End if class exists
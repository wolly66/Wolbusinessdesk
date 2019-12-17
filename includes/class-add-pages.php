<?php
	
	if ( ! defined( 'ABSPATH' ) ) {
	    exit; // Exit if accessed directly
		}
	
	class Wolbusinessdesk_Add_Pages extends Wol_Add_Pages {
		
		
		public function __construct(){
			
			$this->option_name			= 'wol-pages-version';
			$this->version 				= '1.0.0';
			$this->options 				= get_option( $this->option_name );
			$this->pages 				= $this->pages_array();
						
			$this->update_check();
			
		}
		
		/**
		 * update_UTILITY_check function.
		 *
		 * @access public
		 * @return void
	 	 */
	 	public function update_check() {
	 	
	 		// Do checks only in backend
	 		if ( is_admin() ) {
	 	
	 			if ( empty( $this->options ) || version_compare( $this->options , $this->version ) != 0  ) {
	 			 		
	 				$this->do_update();
	 				
	    			}
	 
	 		} //end if only in the admin
	 	}
	 
	 	 
	 	/**
		 * do_update function.
		 *
		 * @access public
		 *
		*/
		public function do_update(){
		
	    		$this->add_pages();
	 
			//Update option
			update_option( $this->option_name, $this->version );
		}


		
		private function pages_array(){
			
			
			$pages_array = array(
				// Page add new support reaquest
				array(
					'post_title'   	=> __( 'Add New Support Request', 'wolbusinessdesk' ),
					'post_name'    	=> __( 'add-new-support-request', 'wolbusinessdesk' ),
					'post_content' 	=> '[wol-support]',
					'post_type'    	=> 'page',
					'post_status'  	=> 'publish',
					'post_author'  	=> get_current_user_id(  ),
					'key_array'    	=> 'id_new_support_request',
					'_page_template'	=> '',
				),
				
				array(
					'post_title'   	=> __( 'Cockpit', 'wolbusinessdesk' ),
					'post_name'    	=> __( 'cockpit', 'wolbusinessdesk' ),
					'post_content' 	=> '',
					'post_type'    	=> 'page',
					'post_status'  	=> 'publish',
					'post_author'  	=> get_current_user_id(  ),
					'key_array'    	=> 'id_front_end_admin',
					'_page_template'	=> 'wol-cockpit.php',
				),

			
			);
			

			return $pages_array;	
			
		}
	}
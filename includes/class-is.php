<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'Wolbusinessdesk_Is' ) ){
	
	
	/**
	 * Wolly_Plugin_Support_Meta class.
	 */
	class Wolbusinessdesk_Is {
		
		
		/**
		 * is_administrator function.
		 * 
		 * @since 1.0
		 * @access public
		 * @return TRUE if is administrator, FALSE if not
		 */
		public function is_administrator(){
			
			if ( is_user_logged_in() ){
				
				if ( current_user_can( 'manage_options' ) ){
					
					return TRUE;
					
					} else {
					
						return FALSE;
				}
			}
			
			return FALSE;
				
		}
		
		public function is_boards_manager(){
			
			if ( is_user_logged_in() ){
				
				if ( current_user_can( 'wol_can_manage_boards' ) ){
					
					return TRUE;
					
					} else {
					
						return FALSE;
				}
			}
			
			return FALSE;
			
		}
		
		public function is_user_creator(){
			
			if ( is_user_logged_in() ){
				
				if ( current_user_can( 'create_users' ) ){
					
					return TRUE;
					
					} else {
					
						return FALSE;
				}
			}
			
			return FALSE;
			
		}
		
		public function is_agent( $user = '' ){
			
			if ( '' == $user ){
			
				if ( is_user_logged_in() ){
				
					if ( current_user_can( 'wol_can_own_ticket' ) ){
					
						return TRUE;
					
						} else {
					
							return FALSE;
					}
				}
				
				} else {
					
					$is_agent = ( user_can( $user, 'wol_can_own_ticket' ) ) ?
					TRUE :
					FALSE;
					
					return $is_agent;
				}
			
			return FALSE;
			
		}
		
		public function is_super_agent( $user = '' ){
			
			if ( '' == $user ){
			
				if ( is_user_logged_in() ){
				
					if ( current_user_can( 'wol_can_assign_owner' ) ){
					
						return TRUE;
					
						} else {
					
							return FALSE;
					}
				}
				
				} else {
					
					$is_super_agent = ( user_can( $user, 'wol_can_assign_owner' ) ) ?
					TRUE :
					FALSE;
					
					return $is_super_agent;
				}
			
			return FALSE;
			
		}
		
		
		
	}
	
}

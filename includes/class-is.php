<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'Wolbusinessdesk_Is' ) ){
	
	
	/**
	 * Wolbusinessdesk_Is class.
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
		
		/**
		 * is_boards_manager function.
		 * 
		 * @since 1.0
		 * @access public
		 * @return BOOL
		 */
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
		
		/**
		 * is_user_creator function.
		 * 
		 * @since 1.0
		 * @access public
		 * @return BOOL
		 */
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
		
		/**
		 * is_agent function.
		 * 
		 * @since 1.0
		 * @access public
		 * @param string $user (default: '')
		 * @return BOOL
		 */
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
		
		/**
		 * is_super_agent function.
		 * 
		 * @since 1.0
		 * @access public
		 * @param string $user (default: '')
		 * @return BOOL
		 */
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
		
		
		/**
		 * is_ticket_open function.
		 * 
		 * @since 1.0
		 * @access public
		 * @param int $ticket_id (default: 0)
		 * @return BOOL
		 */
		public function is_ticket_open( $ticket_id = 0 ){
			
			if ( 0 == $ticket_id 
				 || ! is_numeric( $ticket_id ) 
				 || 0 >= $ticket_id ) {
				
				return FALSE;
				
				} else {
				
					$ticket_status = ( ! is_wp_error( get_the_terms( $ticket_id, 'wol-ticket-status' ) ) ) ?
						get_the_terms( $ticket_id, 'wol-ticket-status' ) :
						FALSE ;
				
					$support_options = get_option( WOLBUSINESSDESK_SUPPORT_OPTION_NAME );
				
					if ( $ticket_status 
						 && isset( $support_options['status'] ) 
						 && (int)$support_options['status'] == $ticket_status[0]->term_id ){
	
						 return FALSE;
	
						} else {
	
						return TRUE;
	
					}

				
			}
			

			return FALSE;
			
		}
		
		/**
		 * can_reply_to_ticket function.
		 * 
		 * @since 1.0
		 * @access public
		 * @param array $filtered_single_permissions (default: array())
		 * @return BOOL
		 */
		public function can_reply_to_ticket( $filtered_single_permissions = array() ){
			
			if ( ! empty( $filtered_single_permissions ) 
				 && is_array( $filtered_single_permissions )
				 && isset( $filtered_single_permissions['write'] ) ){
					 
				switch ( $filtered_single_permissions['write'] ) {
	
					case TRUE:
						
						return TRUE;
					break;
					case FALSE:
						return FALSE;
					break;	
					default:
						return FALSE; 
				
				 }
			
			}
		
			return FALSE;
			
		}
		
		
		
	} // end class
	
} // end if class exists

<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'Wolbusinessdesk_Support_Check' ) ){

	class Wolbusinessdesk_Support_Check {
	
		var $id_user = '';
		var $ticket_status = '';
		var $id_ticket = '';
		var $options = '';
		var $pubblico = '';
		var $read = '';
		var $write = '';
		var $company_id = '';
		var $view_only_your_tickets = '';
	
		/**
		 * Inex_Check::__construct()
		 *
		 *
		 * @package inex ticket
		 *
		 * @since version 1.0
		 *
		 *
		 * @param array $args various params some overidden by default
		 *
		 * @return
		 */
	
		public function __construct() {
	
			//$this->id_user = absint( $args['user_id'] );
			//$this->ticket_status = absint( $args['status'] );
			//$this->id_ticket = absint( $args['ticket_id'] );
			//$this->pubblico = $args['pubblico'];
			//$this->read = $args['read'];
			//
			//if ( false == $args['write'] || true == $args['write'] ){
			//
			//	$this->write = $args['write'];
			//
			//} else {
			//
			//	$this->write = false;
			//}
			//
			//$this->company_id = $args['company_id'];
			//
			//if ( false == $args['view_only_your_tickets'] || true == $args['view_only_your_tickets'] ){
			//
			//	$this->view_only_your_tickets = $args['view_only_your_tickets'];
			//
			//} else {
			//
			//	$this->view_only_your_tickets = false;
			//}
	
	
			$this->options = get_option( WOLBUSINESSDESK_SUPPORT_OPTION_NAME );
	
		}
		
		/**
		 * can_view_html function.
		 * 
		 * @access public
		 * @return void
		 */
		public function can_view_html(){
			
			( ! $this->can_view() ) ?
				_e( 'Sorry, you do not have permissions to view this request', 'wolbusinessdesk' ) . exit :
				'';
						
		}
		
		/**
		 * can_view function.
		 * 
		 * @access public
		 * @return BOOL
		 */
		public function can_view(){
			
			global $post;
						
			/**
			 * ticket_id
			 * 
			 * (default value: $post->ID)
			 * 
			 * @var mixed
			 * @access public
			 */
			$ticket_id = $post->ID;
			
			/**
			 * board
			 * 
			 * (default value: get_the_terms( $ticket_id, 'wol-ticket-board' ))
			 * 
			 * @var string
			 * @access public
			 */
			$board = get_the_terms( $ticket_id, 'wol-ticket-board' );
			
						
			// ! TODO ADD TERM META TO BOARD GENERAL
			
			
			/**
			 * is_public_board
			 * 
			 * (default value: $this->options['public'])
			 * 
			 * @var string
			 * @access public
			 */
			$is_public_board = ( get_term_meta( $board[0]->term_id, 'wol_is_public_board', TRUE ) ) ?
				TRUE :
				FALSE;
						
			if ( ! $is_public_board ){
				
				if ( is_user_logged_in() ){
					
					/**
					 * user_id
					 * 
					 * (default value: get_current_user_id())
					 * 
					 * @var mixed
					 * @access public
					 */
					$user_id = get_current_user_id();
					
					if ( ! current_user_can( 'manage_options' ) ){
						
						/**
						 * is_super_agent
						 * 
						 * (default value: ( user_can( $user_id, 'wol_can_own_ticket' ) ) ?
						 *	TRUE :
						 *	FALSE;
						 * 
						 * @var string
						 * @access public
						 *
						 * @return bool
						 */
						$is_super_agent = ( user_can( $user_id, 'wol_can_assign_owner' ) ) ?
							TRUE :
							FALSE;
						
											
						if (  ! $is_super_agent ){
							
							/**
							 * author_id
						 	 * 
						 	 * (default value: $post->post_author)
						 	 * 
						 	 * @var mixed
						 	 * @access public
						 	*/
						 	$author_id = $post->post_author;
						
							
							/**
							 * can_view
							 * 
							 * @var mixed
							 * @access public
							 */
							$can_view = ( $user_id != $author_id ) ?
								$can_view = FALSE :
								$can_view = TRUE;
								
							} else {
								
								/**
								 * can_view
								 * 
								 * (default value: TRUE)
								 * 
								 * @var mixed
								 * @access public
								 */
								$can_view = TRUE;
						}
					
						} else {
						
							/**
							 * can_view
							 * 
							 * (default value: TRUE)
							 * 
							 * @var mixed
							 * @access public
							 */
							$can_view = TRUE;
						
						
					}
					
					} else {
						
						/**
						 * can_view
						 * 
						 * (default value: FALSE)
						 * 
						 * @var mixed
						 * @access public
						 */
						$can_view = FALSE;
					
					}
				
				} else {
					
					/**
					 * can_view
					 * 
					 * (default value: TRUE)
					 * 
					 * @var mixed
					 * @access public
					 */
					$can_view = TRUE;
				
			}
			
			/**
			 * can_view
			 * 
			 * (default value: apply_filters( 'wol_can_view_single_ticket', $can_view ))
			 * 
			 * @var string
			 * @access public
			 */
			$can_view = apply_filters( 'wol_can_view_single_ticket', $can_view );
			
			return $can_view;
		}
		
		/**
		 * check_capabilities function.
		 * 
		 * @access public
		 * @param mixed $user_id
		 * @param mixed $status (default: null)
		 * @return void
		 */
		public function check_capabilities( $user_id, $status = null ){
	
	
			$author_id = get_the_author_meta( 'ID' );
	
	
			if ( $user_id != $author_id ){
	
			$company_author 	= get_user_option( 'company_associata', $author_id );
			$company_user 	= get_user_option( 'company_associata', $user_id );
	
	
	
			if ( $company_author == $company_user || current_user_can( 'manage_options' ) ){
	
				//echo 'Ciao Autore: ' . $company_author . ' - User: ' . $company_user;
	
			//wp_die();
			switch ( $status ) {
	
				case 'write_comment':
					if ( user_can( $user_id, 'company_tickets_others_view_post_comment' ) || current_user_can( 'manage_options' ) ){
	
						$write = 'write';
	
					return $write;
	
				} else {
	
					return false;
				}
	
				break;
	
				case 'view_comment':
	
					if ( user_can( $user_id, 'company_tickets_others_view_comments' ) || current_user_can( 'manage_options' ) ){
	
						$read = 'read';
					return $read;
	
				} else {
	
					return false;
				}
				break;
	
				default:
					return false;
				break;
			}
	
			}//end check company
	
			} else {//end if different users
	
				switch ( $status ) {
	
					case 'write_comment':
						$write = 'write';
						return $write;
					break;
					case 'view_comment':
						$read = 'read';
						return $read;
					break;
	
				}
	
			}
	
		}
		/**
		 * check_user_permissions function.
		 *
		 *
		 * @package inex ticket
		 *
		 * @since version 1.0
		 *
		 * @access public
		 * @return void
		 */
		public function check_user_permissions( $args ){
	
			if ( false == $args['write'] ){
	
				$user_can_write = false;
	
			} else {
	
				$user_can_write = true;
			}
	
			return $user_can_write;
		}
	
		/**
		 * check_ticket_status function.
		 *
		 *
		 * @package inex ticket
		 *
		 * @since version 1.0
		 *
		 * @access public
		 * @return void
		 */
		public function check_ticket_status( $ticked_id ){
			
			$ticket_status = ( ! is_wp_error( get_the_terms( $ticked_id, 'wol-ticket-status' ) ) ) ?
				get_the_terms( $ticked_id, 'wol-ticket-status' ) :
				FALSE ;
				
			if ( $ticket_status && (int)$this->options['status'] == $ticket_status[0]->term_id ){
	
				$this->ticked_is_open = false;
	
				} else {
	
					$this->ticked_is_open = true;
	
			}
	
			return $this->ticked_is_open;
	
		}
	
	}// chiudo la classe

}


<?php
	namespace Wolbusinessdesk\Includes\Support;
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'Check' ) ){

	class Check {
		
		/**
		 * id_user
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $id_user = '';
		
		/**
		 * ticket_status
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $ticket_status = '';
		
		/**
		 * id_ticket
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $id_ticket = '';
		
		/**
		 * options
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $options = '';
		
		/**
		 * pubblico
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $pubblico = '';
		
		/**
		 * read
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $read = '';
		
		/**
		 * write
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $write = '';
		
		/**
		 * company_id
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $company_id = '';
		
		/**
		 * view_only_your_tickets
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $view_only_your_tickets = '';
	
		/**
		 * Wolbusinessdesk_Support_Check::__construct()
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
				_e( 'Sorry, you do not have permissions to view this ticket', 'wolbusinessdesk' ) . exit :
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
			 * can_view
			 * 
			 * (default value: FALSE)
			 * 
			 * @var mixed
			 * @access public
			 */
			$can_view = FALSE;			
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
			 * @return BOOL
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
																	
						if ( ! is_wol_super_agent( $user_id) ){
							
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
			
			/**
			 * company_author
			 * 
			 * (default value: get_user_option( 'company_associata', $author_id ))
			 * 
			 * @var string
			 * @access public
			 */
			$company_author = get_user_option( 'company_associata', $author_id );
			
			/**
			 * company_user
			 * 
			 * (default value: get_user_option( 'company_associata', $user_id ))
			 * 
			 * @var string
			 * @access public
			 */
			$company_user 	= get_user_option( 'company_associata', $user_id );
	
	
	
			if ( $company_author == $company_user || current_user_can( 'manage_options' ) ){
	
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
	
	
	}// chiudo la classe

}


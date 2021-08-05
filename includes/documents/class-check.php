<?php
	
	namespace Wolbusinessdesk\Includes\Documents;
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'Check' ) ){

	class Check {
	
		var $id_user = '';
		var $document_id = 0;
		var $id_ticket = '';
		var $options = '';
		
		var $read = '';
		var $write = '';
		var $company_id = '';
		
	
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
			
			$this->document_id 	= get_the_id(  );
			$this->id_user 		= (  is_user_logged_in() ) ?
				get_current_user_id( ) :
				0;
				
			$this->options 		= get_option( WOLBUSINESSDESK_DOCUMENT_OPTION_NAME );
	
		}
		
		/**
		 * can_view_html function.
		 * 
		 * @access public
		 * @return void
		 */
		public function cannot_view(){
			
			
				$html = __( 'Sorry, you do not have permissions to view this document', 'wollyplugin' );
				
				return $html;
						
		}
		
		/**
		 * can_view function.
		 * 
		 * @access public
		 * @return BOOL
		 */
		public function can_view(){
						
			$can_view = FALSE;
						
			/**
			 * $document_id
			 * 
			 * (default value: $post->ID)
			 * 
			 * @var mixed
			 * @access public
			 */
			
			
			if ( ! $this->id_user  ){
				
				//  TODO CHECK CODE
				
				$can_view = FALSE;
				
			} else {
				
				if (  current_user_can( 'wol_manage_new_client_document' ) ){
				
				
				$can_view = TRUE;
				
				} else {
					
					$args_clients = array(
						'from'	=> 'wol-client-document',
						'to'    => 'wol-client',
						'from_id' => $this->document_id,
						
					);

					$client = wol()->relationship->get_related_cpt( $args_clients );
					
					
					// ! TODO DEBUG DA RIMUOVERE
					//echo get_the_title( $client[0]['to_id'] );
					//echo '<pre>' . print_r( $client , 1 ) . '</pre>';
					
					// ! TODO CHECK CLIENT CPT -> USERS ASSOCIATION
					
					$can_view = TRUE;
					
					
					
				}
				
			}
			
			/**
			 * can_view
			 * 
			 * (default value: apply_filters( 'wol_can_view_single_ticket', $can_view ))
			 * 
			 * @var string
			 * @access public
			 */
			$can_view = apply_filters( 'wol_can_view_single_client_document', $can_view );
			
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


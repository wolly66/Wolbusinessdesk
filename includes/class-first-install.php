<?php
	
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	
if ( ! class_exists( 'Wolbusinessdesk_First_Install' ) ) {
		
	class Wolbusinessdesk_First_Install {
		
		public function __construct(){
			
			$this->first_install();
		}
		
		/**
		 * first_install function.
		 *
		 *
		 * @package inex ticket
		 *
		 * @since version 1.0
		 *
		 * @access public
		 * @return void
		 */
		public function first_install(){
			
			$first_install = get_option( 'wol-first-install' );
			
			if ( empty( $first_install ) || ( ! empty( $first_install) && TRUE != $first_install ) ){
				
				// ! TODO ADD ALL STATUS FOR DOCUMENTS AND CRM\
				/**
				 * status_new
				 * 
				 * (default value: wp_insert_term( __( 'New', 'wolbusinessdesk' ), 'wol-ticket-status' ))
				 * 
				 * @var string
				 * @access public
				 */
				$status_new = wp_insert_term( __( 'New', 'wolbusinessdesk' ), 'wol-ticket-status' );
					
					
					// ! TODO DEBUG DA RIMUOVERE
					echo '<pre>' . print_r( $status_new , 1 ) . '</pre>';
				//update_term_meta( (int)$status_new['term_id'], '_category_color', sanitize_hex_color_no_hash( '#dd3333' ) );
				
				/**
				 * status_close
				 * 
				 * (default value: wp_insert_term( __( 'Closed', 'wolbusinessdesk' ), 'wol-ticket-status' ))
				 * 
				 * @var string
				 * @access public
				 */
				$status_close = wp_insert_term( __( 'Closed', 'wolbusinessdesk' ), 'wol-ticket-status' );
				
				//update_term_meta( (int)$status_close['term_id'], '_category_color', sanitize_hex_color_no_hash( '#81d742' ) );
				
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
				
				//update_term_meta( (int)$board['term_id'], 'wol_is_public_board', true );
				
				/**
				 * args
				 * 
				 * @var mixed
				 * @access public
				 */
				$args_support =	array(
				  	'status' 							=> (int)$status_close['term_id'],
				  	'opening_status' 					=> (int)$status_new['term_id'],
				  	'listing-type' 						=> 0,
				  	'listing-priority'					=> 0,
				  	'listing-status-operator' 			=> 1,
				  	'listing-status' 					=> (int)$status_close['term_id'],
				  	'listing-tickets-per-page' 			=> 20,
				  	'listing-ticket-replies-per-page' 	=> 20,
				  	'sorting' 							=> 'DESC',
				  	
				  	);
				 add_option( WOLBUSINESSDESK_SUPPORT_OPTION_NAME, $args_support );
				
				 add_option( 'wol-first-install', TRUE );
			 
			 }
		
		}
		
	}
	
	$wol_first_install = new Wolbusinessdesk_First_Install();
}
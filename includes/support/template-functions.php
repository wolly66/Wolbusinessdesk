<?php
	
	if ( ! defined( 'ABSPATH' ) ) {
	    exit; // Exit if accessed directly
		}
	
	
	if (  ! function_exists( 'wol_support_ticket_meta' ) ){
		
		/**
		 * wol_support_ticket_meta function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_ticket_meta(){
			
			echo wolbusinessdesk()->support_meta->show_ticket_data();
		}
	}
	
	if (  ! function_exists( 'wol_support_priority_meta' ) ){
		
		/**
		 * wol_support_priority_meta function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_priority_meta(){
			
			echo wolbusinessdesk()->support_meta->get_priority();
		}
	}
	
	if (  ! function_exists( 'wol_support_archive_nonce' ) ){
		
		/**
		 * wol_support_archive_nonce function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_archive_nonce(){
			
			echo wolbusinessdesk()->support_meta->archive_support_nonce();
		}
	}
	
	
	if (  ! function_exists( 'wol_support_archive_type_dropdown' ) ){
		
		/**
		 * wol_support_archive_type_dropdown function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_archive_type_dropdown( $all = '' ){
			
			echo wolbusinessdesk()->support_meta->get_type_dropdown( $all );
		}
	}

	
	if (  ! function_exists( 'wol_support_archive_priority_dropdown' ) ){
		
		/**
		 * wol_support_archive_priority_dropdown function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_archive_priority_dropdown( $all = '' ){
			
			echo wolbusinessdesk()->support_meta->get_priority_dropdown( $all );
		}
	}
	
	if (  ! function_exists( 'wol_support_archive_status_dropdown' ) ){
		
		/**
		 * wol_support_archive_status_dropdown function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_archive_status_dropdown(){
			
			echo wolbusinessdesk()->support_meta->get_status_dropdown();
		}
	}
	
	if (  ! function_exists( 'wol_support_archive_status_operator_dropdown' ) ){
		
		/**
		 * wol_support_archive_status_operator_dropdown function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_archive_status_operator_dropdown(){
			
			echo wolbusinessdesk()->support_meta->get_status_operator_dropdown();
		}
	}

		
	
	if (  ! function_exists( 'wol_support_status_name_meta' ) ){
		
		/**
		 * wol_support_status_name_meta function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_status_name_meta(){
			
			echo wolbusinessdesk()->support_meta->get_status_name();
		}
	}
	
	if (  ! function_exists( 'wol_support_status_color_meta' ) ){
		
		/**
		 * wol_support_status_color_meta function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_status_color_meta(){
			
			echo wolbusinessdesk()->support_meta->get_status_color();
		}
	}
	
	
	
	if (  ! function_exists( 'wol_support_type_meta' ) ){
		
		/**
		 * wol_support_type_meta function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_type_meta(){
			
			echo wolbusinessdesk()->support_meta->get_type();
		}
	}
	
	if (  ! function_exists( 'wol_support_owner_list_meta' ) ){
		
		/**
		 * wol_support_owner_list_meta function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_owner_list_meta(){
			
			echo wolbusinessdesk()->support_meta->get_owner_list();
		}
	}
	
	if (  ! function_exists( 'wol_support_ticket_age' ) ){
		
		/**
		 * wol_support_ticket_age function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_ticket_age(){
			
			echo wolbusinessdesk()->support_meta->get_ticket_age();
		}
	}
	
	if (  ! function_exists( 'wol_support_ticket_reply_number' ) ){
		
		/**
		 * wol_support_ticket_reply_number function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_ticket_reply_number(){
			
			echo wolbusinessdesk()->support_meta->get_ticket_reply_number();
		}
	}
	
	if (  ! function_exists( 'wol_support_ticket_last_reply_author' ) ){
		
		/**
		 * wol_support_ticket_last_reply_author function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_ticket_last_reply_author(){
			
			echo wolbusinessdesk()->support_meta->get_ticket_last_reply_author();
		}
	}
	
	if (  ! function_exists( 'wol_support_ticket_last_reply_date' ) ){
		
		/**
		 * wol_support_ticket_last_reply_date function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_ticket_last_reply_date(){
			
			echo wolbusinessdesk()->support_meta->get_ticket_last_reply_date();
		}
	}
	
	if (  ! function_exists( 'wol_support_ticket_number' ) ){
		
		/**
		 * wol_support_ticket_last_reply_date function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_ticket_number(){
			
			echo wolbusinessdesk()->support_meta->get_ticket_number();
		}
	}
	
	if (  ! function_exists( 'wol_support_ticket_reply_loop' ) ){
		
		/**
		 * wol_support_ticket_reply_loop function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_support_ticket_reply_loop(){
			
			echo wolbusinessdesk()->support_reply_loop->reply_loop();;
		}
	}


	if ( ! function_exists( 'wol_archive_navigation' ) ) {
	/**
	 * Documentation for function.
	 */
	 	function wol_archive_navigation() {
			the_posts_pagination(
				array(
					'mid_size'  => 2,
					'prev_text' => __( 'Newer support request', 'twentynineteen' ),
				
					'next_text' => __( 'Older support request', 'twentynineteen' ),
					
				)
			);
		}

	}





	
	
	
	
	
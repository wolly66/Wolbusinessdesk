<?php
	use function Wolbusinessdesk\wol;
	if ( ! defined( 'ABSPATH' ) ) {
	    exit; // Exit if accessed directly
		}
	
	if (  ! function_exists( 'wol_add_new_ticket' ) ){
	
		/**
		 * wol_add_new_ticket function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_add_new_ticket(){
			
			echo wol()->template_wrapper->get_add_new_ticket_url();
		}
	}

	/** 
	 *
	 * New Ticket Form template wrapper 
	 *
	 */
		
	if (  ! function_exists( 'wol_get_new_ticket_open_form' ) ){
		
		/**
		 * wol_get_new_ticket_open_form function.
		 * 
		 * @access public
		 * @return open form
		 */
		function wol_get_new_ticket_open_form(){
			
			return wol()->new_support->open_form();
		}
	}
	
	if (  ! function_exists( 'wol_new_ticket_open_form' ) ){
		
		/**
		 * wol_new_ticket_open_form function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_new_ticket_open_form(){
			
			echo wol_get_new_ticket_open_form();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_ticket_boards' ) ){
		
		/**
		 * wol_get_new_ticket_boards function.
		 * 
		 * @access public
		 * @return boards dropdown
		 */
		function wol_get_new_ticket_boards(){
			
			return wol()->new_support->boards();
		}
	}
	
	if (  ! function_exists( 'wol_new_ticket_boards' ) ){
		
		/**
		 * wol_new_ticket_boards function.
		 * 
		 * @access public
		 * @return echo boards dropdown
		 */
		function wol_new_ticket_boards(){
			
			echo wol_get_new_ticket_boards();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_ticket_type' ) ){
		
		/**
		 * wol_get_new_ticket_type function.
		 * 
		 * @access public
		 * @return type dropdown
		 */
		function wol_get_new_ticket_type(){
			
			return wol()->new_support->type();
		}
	}
	
	if (  ! function_exists( 'wol_new_ticket_type' ) ){
		
		/**
		 * wol_new_ticket_type function.
		 * 
		 * @access public
		 * @return echo type dropdown
		 */
		function wol_new_ticket_type(){
			
			echo wol_get_new_ticket_type();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_ticket_priority' ) ){
		
		/**
		 * wol_get_new_ticket_priority function.
		 * 
		 * @access public
		 * @return priority dropdown
		 */
		function wol_get_new_ticket_priority(){
			
			return wol()->new_support->priority();
		}
	}
	
	if (  ! function_exists( 'wol_new_ticket_priority' ) ){
		
		/**
		 * wol_new_ticket_priority function.
		 * 
		 * @access public
		 * @return echo priority dropdown
		 */
		function wol_new_ticket_priority(){
			
			echo wol_get_new_ticket_priority();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_ticket_status' ) ){
		
		/**
		 * wol_get_new_ticket_status function.
		 * 
		 * @access public
		 * @return status dropdown
		 */
		function wol_get_new_ticket_status(){
			
			return wol()->new_support->status();
		}
	}
	
	if (  ! function_exists( 'wol_new_ticket_status' ) ){
		
		/**
		 * wol_new_ticket_status function.
		 * 
		 * @access public
		 * @return echo status dropdown
		 */
		function wol_new_ticket_status(){
			
			echo wol_get_new_ticket_status();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_ticket_title' ) ){
		
		/**
		 * wol_get_new_ticket_title function.
		 * 
		 * @access public
		 * @return title
		 */
		function wol_get_new_ticket_title(){
			
			return wol()->new_support->title();
		}
	}
	
	if (  ! function_exists( 'wol_new_ticket_title' ) ){
		
		/**
		 * wol_new_ticket_title function.
		 * 
		 * @access public
		 * @return echo title
		 */
		function wol_new_ticket_title(){
			
			echo wol_get_new_ticket_title();
		}
	}
	
	
	if (  ! function_exists( 'wol_get_new_ticket_content' ) ){
		
		/**
		 * wol_get_new_ticket_content function.
		 * 
		 * @access public
		 * @return content
		 */
		function wol_get_new_ticket_content(){
			
			return wol()->new_support->content();
		}
	}
	
	if (  ! function_exists( 'wol_new_ticket_content' ) ){
		
		/**
		 * wol_new_ticket_content function.
		 * 
		 * @access public
		 * @return echo content
		 */
		function wol_new_ticket_content(){
			
			echo wol_get_new_ticket_content();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_ticket_submit' ) ){
		
		/**
		 * wol_get_new_ticket_submit function.
		 * 
		 * @access public
		 * @return submit
		 */
		function wol_get_new_ticket_submit(){
			
			return wol()->new_support->submit();
		}
	}
	
	if (  ! function_exists( 'wol_new_ticket_submit' ) ){
		
		/**
		 * wol_new_ticket_content function.
		 * 
		 * @access public
		 * @return echo submit
		 */
		function wol_new_ticket_submit(){
			
			echo wol_get_new_ticket_submit();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_ticket_hidden' ) ){
		
		/**
		 * wol_get_new_ticket_hidden function.
		 * 
		 * @access public
		 * @return hidden
		 */
		function wol_get_new_ticket_hidden(){
			
			return wol()->new_support->hidden();
		}
	}
	
	if (  ! function_exists( 'wol_new_ticket_hidden' ) ){
		
		/**
		 * wol_new_ticket_hidden function.
		 * 
		 * @access public
		 * @return echo hidden
		 */
		function wol_new_ticket_hidden(){
			
			echo wol_get_new_ticket_hidden();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_ticket_nonce' ) ){
		
		/**
		 * wol_get_new_ticket_nonce function.
		 * 
		 * @access public
		 * @return nonce
		 */
		function wol_get_new_ticket_nonce(){
			
			return wol()->new_support->nonce();
		}
	}
	
	if (  ! function_exists( 'wol_new_ticket_nonce' ) ){
		
		/**
		 * wol_new_ticket_nonce function.
		 * 
		 * @access public
		 * @return echo nonce
		 */
		function wol_new_ticket_nonce(){
			
			echo wol_get_new_ticket_nonce();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_ticket_close_form' ) ){
		
		/**
		 * wol_get_new_ticket_close_form function.
		 * 
		 * @access public
		 * @return close_form
		 */
		function wol_get_new_ticket_close_form(){
			
			return wol()->new_support->close_form();
		}
	}
	
	if (  ! function_exists( 'wol_new_ticket_close_form' ) ){
		
		/**
		 * wol_new_ticket_close_form function.
		 * 
		 * @access public
		 * @return echo close_form
		 */
		function wol_new_ticket_close_form(){
			
			echo wol_get_new_ticket_close_form();
		}
	}

	
	/**
	 // ! TODO CHECK IF THEY ARE USED
	 *
	 */
	
	if (  ! function_exists( 'wol_ticket_ticket_meta' ) ){
		
		/**
		 * wol_ticket_ticket_meta function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_ticket_meta(){
			
			echo wol()->ticket_meta->show_ticket_data();
		}
	}
	
	if (  ! function_exists( 'wol_ticket_priority_meta' ) ){
		
		/**
		 * wol_ticket_priority_meta function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_priority_meta(){
			
			echo wol()->ticket_meta->get_priority();
		}
	}
	
	if (  ! function_exists( 'wol_ticket_archive_nonce' ) ){
		
		/**
		 * wol_ticket_archive_nonce function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_archive_nonce(){
			
			echo wol()->ticket_meta->archive_nonce();
		}
	}
	
	
	if (  ! function_exists( 'wol_ticket_archive_type_dropdown' ) ){
		
		/**
		 * wol_ticket_archive_type_dropdown function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_archive_type_dropdown( $all = '' ){
			
			echo wol()->ticket_meta->get_type_dropdown( $all );
		}
	}

	
	if (  ! function_exists( 'wol_ticket_archive_priority_dropdown' ) ){
		
		/**
		 * wol_ticket_archive_priority_dropdown function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_archive_priority_dropdown( $all = '' ){
			
			echo wol()->ticket_meta->get_priority_dropdown( $all );
		}
	}
	
	if (  ! function_exists( 'wol_ticket_archive_status_dropdown' ) ){
		
		/**
		 * wol_ticket_archive_status_dropdown function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_archive_status_dropdown(){
			
			echo wol()->ticket_meta->get_status_dropdown();
		}
	}
	
	if (  ! function_exists( 'wol_ticket_archive_status_operator_dropdown' ) ){
		
		/**
		 * wol_ticket_archive_status_operator_dropdown function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_archive_status_operator_dropdown(){
			
			echo wol()->ticket_meta->get_status_operator_dropdown();
		}
	}

		
	
	if (  ! function_exists( 'wol_ticket_status_name_meta' ) ){
		
		/**
		 * wol_ticket_status_name_meta function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_status_name_meta(){
			
			echo wol()->ticket_meta->get_status_name();
		}
	}
	
	if (  ! function_exists( 'wol_ticket_status_color_meta' ) ){
		
		/**
		 * wol_ticket_status_color_meta function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_status_color_meta(){
			
			echo wol()->ticket_meta->get_status_color();
		}
	}
	
	
	
	if (  ! function_exists( 'wol_ticket_type_meta' ) ){
		
		/**
		 * wol_ticket_type_meta function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_type_meta(){
			
			echo wol()->ticket_meta->get_type();
		}
	}
	
	if (  ! function_exists( 'wol_ticket_owner_list_meta' ) ){
		
		/**
		 * wol_ticket_owner_list_meta function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_owner_list_meta(){
			
			echo wol()->ticket_meta->get_owner_list();
		}
	}
	
	if (  ! function_exists( 'wol_ticket_ticket_age' ) ){
		
		/**
		 * wol_ticket_ticket_age function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_ticket_age(){
			
			echo wol()->ticket_meta->get_ticket_age();
		}
	}
	
	if (  ! function_exists( 'wol_ticket_ticket_reply_number' ) ){
		
		/**
		 * wol_ticket_ticket_reply_number function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_ticket_reply_number(){
			
			echo wol()->ticket_meta->get_ticket_reply_number();
		}
	}
	
	if (  ! function_exists( 'wol_ticket_ticket_last_reply_author' ) ){
		
		/**
		 * wol_ticket_ticket_last_reply_author function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_ticket_last_reply_author(){
			
			echo wol()->ticket_meta->get_ticket_last_reply_author();
		}
	}
	
	if (  ! function_exists( 'wol_ticket_ticket_last_reply_date' ) ){
		
		/**
		 * wol_ticket_ticket_last_reply_date function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_ticket_last_reply_date(){
			
			echo wol()->ticket_meta->get_ticket_last_reply_date();
		}
	}
	
	if (  ! function_exists( 'wol_ticket_ticket_number' ) ){
		
		/**
		 * wol_ticket_ticket_last_reply_date function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_ticket_number(){
			
			echo wol()->ticket_meta->get_ticket_number();
		}
	}
	
	if (  ! function_exists( 'wol_ticket_ticket_reply_loop' ) ){
		
		/**
		 * wol_ticket_ticket_reply_loop function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_ticket_reply_loop(){
			
			echo wol()->support_reply_loop->reply_loop();;
		}
	}
	
	if (  ! function_exists( 'wol_ticket_archive_open_form' ) ){
		
		/**
		 * wol_ticket_archive_open_form function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticket_archive_open_form(){
			
			echo wol()->ticket_meta->open_form();
		}
	}
	
	if (  ! function_exists( 'wol_ticcket_archive_close_form' ) ){
		
		/**
		 * wol_ticcket_archive_close_form function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_ticcket_archive_close_form(){
			
			echo wol()->ticket_meta->close_archive_form();
		}
	}


	if ( ! function_exists( 'wol_ticket_archive_navigation' ) ) {
	/**
	 * Documentation for function.
	 */
	 	function wol_ticket_archive_navigation() {
			the_posts_pagination(
				array(
					'mid_size'  => 2,
					'prev_text' => __( 'Newer support request', 'twentynineteen' ),
				
					'next_text' => __( 'Older support request', 'twentynineteen' ),
					
				)
			);
		}

	}





	
	
	
	
	
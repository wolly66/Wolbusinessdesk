<?php
	use function Wolbusinessdesk\wol;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

	/** 
	 *
	 * New CRM TASK Form template wrapper 
	 *
	 */
		
	if (  ! function_exists( 'wol_add_new_task' ) ){
	
		/**
		 * wol_add_new_task function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_add_new_task(){
			
			echo wol()->template_wrapper->get_add_new_task_url();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_task_open_form' ) ){
		
		/**
		 * wol_get_new_ticket_open_form function.
		 * 
		 * @access public
		 * @return open form
		 */
		function wol_get_new_task_open_form(){
			
			return wol()->new_task->open_form();
		}
	}
	
	if (  ! function_exists( 'wol_new_new_task_open_form' ) ){
		
		/**
		 * wol_new_new_task_open_form function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_new_new_task_open_form(){
			
			echo wol_get_new_task_open_form();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_task_status' ) ){
		
		/**
		 * wol_get_new_ticket_status function.
		 * 
		 * @access public
		 * @return status dropdown
		 */
		function wol_get_new_task_status(){
			
			return wol()->new_task->status();
		}
	}
	
	if (  ! function_exists( 'wol_new_task_status' ) ){
		
		/**
		 * wol_new_ticket_status function.
		 * 
		 * @access public
		 * @return echo status dropdown
		 */
		function wol_new_task_status(){
			
			echo wol_get_new_task_status();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_task_type' ) ){
		
		/**
		 * wol_get_new_task_type function.
		 * 
		 * @access public
		 * @return status dropdown
		 */
		function wol_get_new_task_type(){
			
			return wol()->new_task->type();
		}
	}
	
	if (  ! function_exists( 'wol_new_task_type' ) ){
		
		/**
		 * wol_new_task_type function.
		 * 
		 * @access public
		 * @return echo status dropdown
		 */
		function wol_new_task_type(){
			
			echo wol_get_new_task_type();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_task_action' ) ){
		
		/**
		 * wol_get_new_task_action function.
		 * 
		 * @access public
		 * @return status dropdown
		 */
		function wol_get_new_task_action(){
			
			return wol()->new_task->action();
		}
	}
	
	if (  ! function_exists( 'wol_new_task_action' ) ){
		
		/**
		 * wol_new_task_action function.
		 * 
		 * @access public
		 * @return echo status dropdown
		 */
		function wol_new_task_action(){
			
			echo wol_get_new_task_action();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_task_title' ) ){
		
		/**
		 * wol_get_new_task_title function.
		 * 
		 * @access public
		 * @return title
		 */
		function wol_get_new_task_title(){
			
			return wol()->new_task->title();
		}
	}
	
	if (  ! function_exists( 'wol_new_task_title' ) ){
		
		/**
		 * wol_new_task_title function.
		 * 
		 * @access public
		 * @return echo title
		 */
		function wol_new_task_title(){
			
			echo wol_get_new_task_title();
		}
	}
	
	
	if (  ! function_exists( 'wol_get_new_task_content' ) ){
		
		/**
		 * wol_get_new_task_content function.
		 * 
		 * @access public
		 * @return content
		 */
		function wol_get_new_task_content(){
			
			return wol()->new_task->content();
		}
	}
	
	if (  ! function_exists( 'wol_new_task_content' ) ){
		
		/**
		 * wol_new_task_content function.
		 * 
		 * @access public
		 * @return echo content
		 */
		function wol_new_task_content(){
			
			echo wol_get_new_task_content();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_task_due_date' ) ){
		
		/**
		 * wol_get_new_task_due_date function.
		 * 
		 * @access public
		 * @return content
		 */
		function wol_get_new_task_due_date(){
			
			return wol()->new_task->due_date();
		}
	}
	
	if (  ! function_exists( 'wol_new_task_due_date' ) ){
		
		/**
		 * wol_new_task_due_date function.
		 * 
		 * @access public
		 * @return echo content
		 */
		function wol_new_task_due_date(){
			
			echo wol_get_new_task_due_date();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_task_due_hour' ) ){
		
		/**
		 * wol_get_new_task_due_hour function.
		 * 
		 * @access public
		 * @return content
		 */
		function wol_get_new_task_due_hour(){
			
			return wol()->new_task->due_hour();
		}
	}
	
	if (  ! function_exists( 'wol_new_task_due_hour' ) ){
		
		/**
		 * wol_new_task_due_hour function.
		 * 
		 * @access public
		 * @return echo content
		 */
		function wol_new_task_due_hour(){
			
			echo wol_get_new_task_due_hour();
		}
	}
	if (  ! function_exists( 'wol_get_new_task_due_minutes' ) ){
		
		/**
		 * wol_get_new_task_due_minutes function.
		 * 
		 * @access public
		 * @return content
		 */
		function wol_get_new_task_due_minutes(){
			
			return wol()->new_task->due_minutes();
		}
	}
	
	if (  ! function_exists( 'wol_new_task_due_minutes' ) ){
		
		/**
		 * wol_new_task_due_minutes function.
		 * 
		 * @access public
		 * @return echo content
		 */
		function wol_new_task_due_minutes(){
			
			echo wol_get_new_task_due_minutes();
		}
	}

	
	if (  ! function_exists( 'wol_get_new_task_submit' ) ){
		
		/**
		 * wol_get_new_task_submit function.
		 * 
		 * @access public
		 * @return submit
		 */
		function wol_get_new_task_submit(){
			
			return wol()->new_task->submit();
		}
	}
	
	if (  ! function_exists( 'wol_new_task_submit' ) ){
		
		/**
		 * wol_new_task_submit function.
		 * 
		 * @access public
		 * @return echo submit
		 */
		function wol_new_task_submit(){
			
			echo wol_get_new_task_submit();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_task_hidden' ) ){
		
		/**
		 * wol_get_new_task_hidden function.
		 * 
		 * @access public
		 * @return hidden
		 */
		function wol_get_new_task_hidden(){
			
			return wol()->new_task->hidden();
		}
	}
	
	if (  ! function_exists( 'wol_new_task_hidden' ) ){
		
		/**
		 * wol_new_task_hidden function.
		 * 
		 * @access public
		 * @return echo hidden
		 */
		function wol_new_task_hidden(){
			
			echo wol_get_new_task_hidden();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_task_nonce' ) ){
		
		/**
		 * wol_get_new_task_nonce function.
		 * 
		 * @access public
		 * @return nonce
		 */
		function wol_get_new_task_nonce(){
			
			return wol()->new_task->nonce();
		}
	}
	
	if (  ! function_exists( 'wol_new_task_nonce' ) ){
		
		/**
		 * wol_new_task_nonce function.
		 * 
		 * @access public
		 * @return echo nonce
		 */
		function wol_new_task_nonce(){
			
			echo wol_get_new_task_nonce();
		}
	}
	
	if (  ! function_exists( 'wol_get_new_task_close_form' ) ){
		
		/**
		 * wol_get_new_task_close_form function.
		 * 
		 * @access public
		 * @return close_form
		 */
		function wol_get_new_task_close_form(){
			
			return wol()->new_task->close_form();
		}
	}
	
	if (  ! function_exists( 'wol_new_task_close_form' ) ){
		
		/**
		 * wol_new_task_close_form function.
		 * 
		 * @access public
		 * @return echo close_form
		 */
		function wol_new_task_close_form(){
			
			echo wol_get_new_task_close_form();
		}
	}
	
	
	if (  ! function_exists( 'wol_crm_archive_type_dropdown' ) ){
		
		/**
		 * wol_crm_archive_type_dropdown function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_archive_type_dropdown( $all = '' ){
			
			echo wol()->crm_meta->get_type_dropdown( $all );
		}
	}

	
	if (  ! function_exists( 'wol_crm_archive_action_dropdown' ) ){
		
		/**
		 * wol_crm_archive_action_dropdown function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_archive_action_dropdown( $all = '' ){
				
			echo wol()->crm_meta->get_action_dropdown( $all );
		}
	}
	
	if (  ! function_exists( 'wol_crm_archive_status_dropdown' ) ){
		
		/**
		 * wol_crm_archive_status_dropdown function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_archive_status_dropdown(){
			
			echo wol()->crm_meta->get_status_dropdown();
		}
	}
	
	if (  ! function_exists( 'wol_crm_archive_status_operator_dropdown' ) ){
		
		/**
		 * wol_crm_archive_status_operator_dropdown function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_archive_status_operator_dropdown(){
			
			echo wol()->crm_meta->get_status_operator_dropdown();
		}
	}
	
	if (  ! function_exists( 'wol_crm_archive_source_checkbox' ) ){
		
		/**
		 * wol_crm_archive_source_checkbox function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_archive_source_checkbox(){
			
			echo wol()->crm_meta->get_source_checkbox();
		}
	}

		
	
	if (  ! function_exists( 'wol_crm_status_name_meta' ) ){
		
		/**
		 * wol_crm_status_name_meta function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_status_name_meta(){
			
			echo wol()->crm_meta->get_status_name();
		}
	}
	
	if (  ! function_exists( 'wol_crm_status_color_meta' ) ){
		
		/**
		 * wol_crm_status_color_meta function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_status_color_meta(){
			
			echo wol()->crm_meta->get_status_color();
		}
	}
	
	
	
	if (  ! function_exists( 'wol_crm_type_meta' ) ){
		
		/**
		 * wol_crm_type_meta function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_type_meta(){
			
			echo wol()->crm_meta->get_type();
		}
	}
	
	if (  ! function_exists( 'wol_crm_owner_list_meta' ) ){
		
		/**
		 * wol_crm_owner_list_meta function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_owner_list_meta(){
			
			echo wol()->crm_meta->get_owner_list();
		}
	}
	
	if (  ! function_exists( 'wol_crm_crm_age' ) ){
		
		/**
		 * wol_crm_crm_age function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_crm_age(){
			
			echo wol()->crm_meta->get_task_age();
		}
	}
	
	if (  ! function_exists( 'wol_crm_crm_reply_number' ) ){
		
		/**
		 * wol_crm_crm_reply_number function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_crm_reply_number(){
			
			echo wol()->crm_meta->get_task_reply_number();
		}
	}
	
	if (  ! function_exists( 'wol_crm_crm_last_reply_author' ) ){
		
		/**
		 * wol_crm_crm_last_reply_author function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_crm_last_reply_author(){
			
			echo wol()->crm_meta->get_task_last_reply_author();
		}
	}
	
	if (  ! function_exists( 'wol_crm_crm_last_reply_date' ) ){
		
		/**
		 * wol_crm_crm_last_reply_date function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_crm_last_reply_date(){
			
			echo wol()->crm_meta->get_task_last_reply_date();
		}
	}
	
	if (  ! function_exists( 'wol_crm_crm_number' ) ){
		
		/**
		 * wol_crm_crm_last_reply_date function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_crm_number(){
			
			echo wol()->crm_meta->get_task_number();
		}
	}
	
	if (  ! function_exists( 'wol_crm_crm_reply_loop' ) ){
		
		/**
		 * wol_crm_crm_reply_loop function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_crm_reply_loop(){
			
			echo wol()->support_reply_loop->reply_loop();;
		}
	}


	if ( ! function_exists( 'wol_crm_archive_navigation' ) ) {
	/**
	 * Documentation for function.
	 */
	 	function wol_crm_archive_navigation() {
			the_posts_pagination(
				array(
					'mid_size'  => 2,
					'prev_text' => __( 'Newer task', 'twentynineteen' ),
				
					'next_text' => __( 'Older task', 'twentynineteen' ),
					
				)
			);
		}

	}
	
	if (  ! function_exists( 'wol_crm_get_original_type' ) ){
		
		/**
		 * wol_crm_get_original_type function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_get_original_type(){
			
			return wol()->crm_template_wrapper->get_original_type();;
		}
	}
	
	if (  ! function_exists( 'wol_crm_original_type' ) ){
		
		/**
		 * wol_crm_get_original_type function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_original_type(){
			
			echo wol()->crm_template_wrapper->get_original_type();;
		}
	}
	
	if (  ! function_exists( 'wol_crm_get_original_source_id' ) ){
		
		/**
		 * wol_crm_get_original_source_id function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_get_original_source_id(){
			
			return wol()->crm_template_wrapper->get_original_source_id();
		}
	}
	
	if (  ! function_exists( 'wol_crm_the_title' ) ){
		
		/**
		 * wol_crm_the_title function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_the_title(){
			
			echo wol()->crm_template_wrapper->the_title();
		}
	}
	if (  ! function_exists( 'wol_crm_get_due_date' ) ){
		
		/**
		 * wol_crm_get_due_date function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_get_due_date(){
			
			return wol()->crm_template_wrapper->get_due_date();
		}
	}

	if (  ! function_exists( 'wol_crm_due_date' ) ){
		
		/**
		 * wol_crm_due_date function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_due_date(){
			
			echo wol_crm_get_due_date();
		}
	}
	
	
	if (  ! function_exists( 'wol_crm_archive_open_form' ) ){
		
		/**
		 * wol_crm_archive_open_form function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_archive_open_form(){
			
			echo wol()->crm_meta->open_form();
		}
	}
	
	if (  ! function_exists( 'wol_crm_archive_nonce' ) ){
		
		/**
		 * wol_crm_archive_nonce function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_archive_nonce(){
			
			echo wol()->crm_meta->archive_nonce();
		}
	}
	
	if (  ! function_exists( 'wol_crm_archive_close_form' ) ){
		
		/**
		 * wol_crm_archive_close_form function.
		 * 
		 * @access public
		 * @return void
		 */
		function wol_crm_archive_close_form(){
			
			echo wol()->crm_meta->close_archive_form();
		}
	}
	
	



	
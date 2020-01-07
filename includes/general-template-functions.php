<?php
	
	if ( ! defined( 'ABSPATH' ) ) {
	    exit; // Exit if accessed directly
		}
	
	
	if (  ! function_exists( 'wol_get_template_part' ) ){
		
		/**
		 * wol_get_template_part function.
		 * 
		 * @access public
		 * @param mixed $name
		 * @param mixed $template_part
		 * @return template part
		 */
		function wol_get_template_part( $name, $template_part ){
			
			wolbusinessdesk()->template_wrapper->get_template_part( $name, $template_part );
		}
	}
	
	if (  ! function_exists( 'wol_get_sidebar_cockpit_menu' ) ){
		
		/**
		 * wol_get_sidebar_cockpit_menu function.
		 * 
		 * @access public
		 * @return menu
		 */
		function wol_get_sidebar_cockpit_menu(){
			
			return wolbusinessdesk()->template_wrapper->get_sidebar_cockpit_menu();
		}
	}
	
	if (  ! function_exists( 'wol_menu_list' ) ){
		
		/**
		 * wol_menu_list function.
		 * 
		 * @access public
		 * @param string $class (default: '')
		 * @return echo menu
		 */
		function wol_menu_list( $class = '' ){
			
			echo wolbusinessdesk()->template_wrapper->get_menu_list( $class );
		}
	}
	
	if (  ! function_exists( 'wol_cockpit_page' ) ){
		
		/**
		 * wol_get_cockpit_page function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_cockpit_page(){
			
			echo wolbusinessdesk()->template_wrapper->get_cockpit_page();
		}
	}
	
	if (  ! function_exists( 'wol_can_view_document' ) ){
		
		/**
		 * wol_doc_can_view function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_doc_can_view(){
			
			return wolbusinessdesk()->document_check->can_view();
		}
	}
	
	if (  ! function_exists( 'wol_cannot_view_document' ) ){
		
		/**
		 * wol_doc_cannot_view function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_doc_cannot_view(){
			
			echo wolbusinessdesk()->document_check->cannot_view();
		}
	}
	
	if (  ! function_exists( 'wol_the_title' ) ){
		
		/**
		 * wol_doc_the_title function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_doc_the_title( $open = '', $close = ''){
			
			wolbusinessdesk()->client_document->the_title( $open, $close );
		}
	}
	
	if (  ! function_exists( 'wol_the_content' ) ){
		
		/**
		 * wol_doc_the_content function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_doc_the_content(){
			
			wolbusinessdesk()->client_document->the_content();
		}
	}
	
	if (  ! function_exists( 'wol_modify_client_document' ) ){
		
		/**
		 * wol_doc_modify_client_document function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_doc_modify_client_document(){
			
			echo wolbusinessdesk()->client_document->modify_client_document();
		}
	}
	
	if (  ! function_exists( 'wol_new_client_nonce' ) ){
		
		/**
		 * wol_new_client_nonce function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_new_client_nonce(){
			
			wp_nonce_field( 'wol-client_nonce_action', 'wol-client_nonce_name' );
		}
	}
	
		
	if (  ! function_exists( 'wol_client_field' ) ){
		
		/**
		 * wol_client_field function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_client_field( $client_id = 0 ){
			
			echo wolbusinessdesk()->template_wrapper->get_company_fields_form( $client_id );
		}
	}
	
	if (  ! function_exists( 'wol_task_field' ) ){
		
		/**
		 * wol_task_field function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_task_field( $task_id = 0 ){
			
			echo wolbusinessdesk()->template_wrapper->get_task_fields_form( $task_id );
		}
	}

	
	if (  ! function_exists( 'wol_add_cpt' ) ){
		
		/**
		 * wol_add_cpt function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_add_cpt( $cpt = '' ){
			
			echo wolbusinessdesk()->template_wrapper->add_cpt( $cpt );
		}
	}
	
	if (  ! function_exists( 'wol_add_new_ticket' ) ){
		
		/**
		 * wol_add_new_ticket function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_add_new_ticket(){
			
			echo wolbusinessdesk()->template_wrapper->get_add_new_ticket_url();
		}
	}
	
	if (  ! function_exists( 'wol_add_new_client' ) ){
		
		/**
		 * wol_add_new_client function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_add_new_client(){
			
			echo wolbusinessdesk()->template_wrapper->get_add_new_client_url();
		}
	}
	
	if (  ! function_exists( 'wol_add_new_task' ) ){
		
		/**
		 * wol_add_new_task function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_add_new_task(){
			
			echo wolbusinessdesk()->template_wrapper->get_add_new_task_url();
		}
	}
	
	if (  ! function_exists( 'wol_add_new_client_document' ) ){
		
		/**
		 * wol_add_new_client_document function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_add_new_client_document(){
			
			echo wolbusinessdesk()->template_wrapper->get_add_new_client_document_url();
		}
	}
	
	if (  ! function_exists( 'wol_get_cockpit_home_query' ) ){
		
		/**
		 * wol_add_new_client_document function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_get_cockpit_home_query(){
			
			return wolbusinessdesk()->cockpit->get_home_query();
		}
	}
	
	if (  ! function_exists( 'wol_get_cockpit_settings_query' ) ){
		
		/**
		 * wol_add_new_client_document function.
		 * 
		 * @access public
		 * @return echo page
		 */
		function wol_get_cockpit_settings_query(){
			
			return wolbusinessdesk()->template_wrapper->get_cockpit_settings_query();
		}
	}
	
	if (  ! function_exists( 'wol_external_task_to_crm' ) ){
		
		/**
		 * external_task_to_crm function.
		 * 
		 * @access public
		 * @return echo close_form
		 */ 
		function external_task_to_crm( $args = '' ){
			
			return wolbusinessdesk()->template_wrapper->add_external_task_to_crm( $args );
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
			
			return wolbusinessdesk()->new_support->open_form();
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
			
			return wolbusinessdesk()->new_support->boards();
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
			
			return wolbusinessdesk()->new_support->type();
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
			
			return wolbusinessdesk()->new_support->priority();
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
			
			return wolbusinessdesk()->new_support->status();
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
			
			return wolbusinessdesk()->new_support->title();
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
			
			return wolbusinessdesk()->new_support->content();
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
			
			return wolbusinessdesk()->new_support->submit();
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
			
			return wolbusinessdesk()->new_support->hidden();
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
			
			return wolbusinessdesk()->new_support->nonce();
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
			
			return wolbusinessdesk()->new_support->close_form();
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
	 *
	 * New CRM TASK Form template wrapper 
	 *
	 */
		
	if (  ! function_exists( 'wol_get_new_task_open_form' ) ){
		
		/**
		 * wol_get_new_ticket_open_form function.
		 * 
		 * @access public
		 * @return open form
		 */
		function wol_get_new_task_open_form(){
			
			return wolbusinessdesk()->new_task->open_form();
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
			
			return wolbusinessdesk()->new_task->status();
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
			
			return wolbusinessdesk()->new_task->type();
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
			
			return wolbusinessdesk()->new_task->action();
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
			
			return wolbusinessdesk()->new_task->title();
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
			
			return wolbusinessdesk()->new_task->content();
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
			
			return wolbusinessdesk()->new_task->due_date();
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
			
			return wolbusinessdesk()->new_task->due_hour();
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
			
			return wolbusinessdesk()->new_task->due_minutes();
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
			
			return wolbusinessdesk()->new_task->submit();
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
			
			return wolbusinessdesk()->new_task->hidden();
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
			
			return wolbusinessdesk()->new_task->nonce();
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
			
			return wolbusinessdesk()->new_task->close_form();
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
	
	









	
	
	
	



	

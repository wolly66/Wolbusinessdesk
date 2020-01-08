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
		
		wol()->template_wrapper->get_template_part( $name, $template_part );
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
		
		return wol()->template_wrapper->get_sidebar_cockpit_menu();
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
		
		echo wol()->template_wrapper->get_menu_list( $class );
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
		
		echo wol()->template_wrapper->get_cockpit_page();
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
		
		return wol()->document_check->can_view();
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
		
		echo wol()->document_check->cannot_view();
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
		
		wol()->client_document->the_title( $open, $close );
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
		
		wol()->client_document->the_content();
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
		
		echo wol()->client_document->modify_client_document();
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
		
		echo wol()->template_wrapper->get_company_fields_form( $client_id );
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
		
		echo wol()->template_wrapper->get_task_fields_form( $task_id );
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
		
		echo wol()->template_wrapper->add_cpt( $cpt );
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
		
		echo wol()->template_wrapper->get_add_new_client_url();
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
		
		echo wol()->template_wrapper->get_add_new_client_document_url();
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
		
		return wol()->cockpit->get_home_query();
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
		
		return wol()->template_wrapper->get_cockpit_settings_query();
	}
}

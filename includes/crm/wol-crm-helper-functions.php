<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


if (  ! function_exists( 'wol_external_task_to_crm' ) ){
		
	/**
	 * wol_external_task_to_crm function.
	 * 
	 * @access public
	 * @return void
	 */ 
	function wol_external_task_to_crm( $args = '' ){
		
		wol()->crm_helper_functions->add_external_task_to_crm( $args );
	}
}

if (  ! function_exists( 'wol_get_crm_new_numerator' ) ){
		
	/**
	 * wol_get_crm_new_numerator function.
	 * 
	 * @access public
	 * @return New crm numerator
	 */ 
	function wol_get_crm_new_numerator(){
		
		return wol()->crm_helper_functions->get_new_crm_numerator();
	}
}

if (  ! function_exists( 'wol_get_crm_allowed_cpt' ) ){
		
	/**
	 * wol_get_crm_allowed_cpt function.
	 * 
	 * @access public
	 * @return New crm numerator
	 */ 
	function wol_get_crm_allowed_cpt(){
		
		return wol()->crm_helper_functions->allowed_cpt();
	}
}



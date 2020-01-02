<?php 

/* 
 * Template wrappers for is check
 *
 * All check must be: is_wol_{check type}
 *
 * @since 1.0
 *
 */

	
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! function_exists( 'is_wol_administrator' ) ){
	
	/**
	 * is_wol_administrator function.
	 * 
	 * @since 1.0
	 * @access public
	 * @return TRUE if is administrator, FALSE if not
	 */
	function is_wol_administrator(){
		
		return wolbusinessdesk()->is->is_administrator();
	}
	
}

if ( ! function_exists( 'is_wol_boards_manager' ) ){
	
	/**
	 * is_wol_boards_manager function.
	 * 
	 * @since 1.0
	 * @access public
	 * @return TRUE if is a board manager, FALSE if not
	 */
	function is_wol_boards_manager(){
		
		return wolbusinessdesk()->is->is_boards_manager();
	}
	
}

if ( ! function_exists( 'is_wol_user_creator' ) ){
	
	/**
	 * is_wol_is_user_creator function.
	 * 
	 * @since 1.0
	 * @access public
	 * @return TRUE if can create users, FALSE if not
	 */
	function is_wol_user_creator(){
		
		return wolbusinessdesk()->is->is_user_creator();
	}
	
}

if ( ! function_exists( 'is_wol_agent' ) ){
	
	/**
	 * is_wol_agent function.
	 * 
	 * @since 1.0
	 * @access public
	 * @param string $user (default: '')
	 * @return TRUE if can own tickets, FALSE if not
	 */
	function is_wol_agent( $user = '' ){
		
		return wolbusinessdesk()->is->is_agent( $user = '' );
	}
	
}

if ( ! function_exists( 'is_wol_super_agent' ) ){
	
	/**
	 * is_wol_super_agent function.
	 * 
	 * @since 1.0
	 * @access public
	 * @param string $user (default: '')
	 * @return TRUE if can assign tickets, FALSE if not
	 */
	function is_wol_super_agent( $user = '' ){
		
		return wolbusinessdesk()->is->is_super_agent( $user = '' );
	}
	
}




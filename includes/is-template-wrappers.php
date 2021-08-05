<?php 

/* 
 * Template wrappers for is check
 *
 * All check must be: is_wol_{check type}
 *
 * @package Wolbusinessdesk\Includes
 * @since 1.0
 *
 */
 //namespace Wolbusinessdesk\Includes;
 use function Wolbusinessdesk\wol;
	
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


if ( ! function_exists( 'is_wol_can_access_cockpit' ) ){
	
	/**
	 * is_wol_can_access_cockpit function.
	 * 
	 * @since 1.0
	 * @access public
	 * @return TRUE if is administrator, FALSE if not
	 */
	function is_wol_can_access_cockpit(){
		
		return wol()->is->can_access_cockpit();
	}
	
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
		
		return wol()->is->is_administrator();
	}
	
}

if ( ! function_exists( 'is_wol_wolbusinessdesk_administrator' ) ){
	
	/**
	 * is_wol_wolbusinessdesk_administrator function.
	 * 
	 * @since 1.0
	 * @access public
	 * @return TRUE if is administrator, FALSE if not
	 */
	function is_wol_wolbusinessdesk_administrator(){
		
		return wol()->is->is_wolbusinessdesk_administrator();
	}
	
}

if ( ! function_exists( 'is_wol_ticket_administrator' ) ){
	
	/**
	 * is_wol_ticket_administrator function.
	 * 
	 * @since 1.0
	 * @access public
	 * @return TRUE if is a ticket administrator, FALSE if not
	 */
	function is_wol_ticket_administrator(){
		
		return wol()->is->is_ticket_administrator();
	}
	
}

if ( ! function_exists( 'is_wol_crm_administrator' ) ){
	
	/**
	 * is_wol_crm_administrator function.
	 * 
	 * @since 1.0
	 * @access public
	 * @return TRUE if is a ticket administrator, FALSE if not
	 */
	function is_wol_crm_administrator(){
		
		return wol()->is->is_crm_administrator();
	}
	
}

if ( ! function_exists( 'is_wol_client_administrator' ) ){
	
	/**
	 * is_wol_client_administrator function.
	 * 
	 * @since 1.0
	 * @access public
	 * @return TRUE if is a ticket administrator, FALSE if not
	 */
	function is_wol_client_administrator(){
		
		return wol()->is->is_client_administrator();
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
		
		return wol()->is->is_user_creator();
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
		
		return wol()->is->is_agent( $user );
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
		
		return wol()->is->is_super_agent( $user );
	}
	
}

if ( ! function_exists( 'is_wol_ticket_open' ) ){
	
	/**
	 * is_wol_ticket_open function.
	 * 
	 * @since 1.0
	 * @access public
	 * @param string $user (default: 0)
	 * @return TRUE if ticket is open, FALSE if not
	 */
	function is_wol_ticket_open( $ticket_id = 0 ){
		
		return wol()->is->is_ticket_open( $ticket_id );
	}
	
}

if ( ! function_exists( 'is_wol_can_open_ticket' ) ){
	
	/**
	 * is_wol_can_open_ticket function.
	 * 
	 * @since 1.0
	 * @access public
	 * @return TRUE if ticket can open, FALSE if not
	 */
	function is_wol_can_open_ticket(){
		
		return wol()->is->can_open_ticket();
	}
	
}

if ( ! function_exists( 'is_wol_can_reply_to_ticket' ) ){
	
	/**
	 * is_wol_ticket_open function.
	 * 
	 * @since 1.0
	 * @access public
	 * @param string $user (default: 0)
	 * @return TRUE if ticket is open, FALSE if not
	 */
	function is_wol_can_reply_to_ticket( $filtered_single_permissions = array() ){
		
		return wol()->is->can_reply_to_ticket( $filtered_single_permissions );
	}
	
}

if ( ! function_exists( 'is_wol_can_open_crm' ) ){
	
	/**
	 * is_wol_can_open_crm function.
	 * 
	 * @since 1.0
	 * @access public
	 * @return TRUE if ticket can open, FALSE if not
	 */
	function is_wol_can_open_crm(){
		
		return wol()->is->can_open_task();
	}
	
}






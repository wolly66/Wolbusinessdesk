<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


if (  ! function_exists( 'wol_get_ticket_new_numerator' ) ){
		
	/**
	 * wol_get_ticket_new_numerator function.
	 * 
	 * @access public
	 * @return New crm numerator
	 */ 
	function wol_get_ticket_new_numerator(){
		
		return wol()->ticket_helper_functions->get_new_ticket_numerator();
	}
}
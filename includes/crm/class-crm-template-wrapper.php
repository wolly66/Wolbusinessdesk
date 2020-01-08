<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Wolbusinessdesk_Crm_Template_Wrappers' ) ){
	
	class Wolbusinessdesk_Crm_Template_Wrappers{
		
		public function get_original_type(){
			
			global $post;
			
			$original_type = get_post_meta( $post->ID, 'wol_original_type', TRUE );
			
			return $original_type;
		}
		
		public function the_title(){
			
			$the_title = __( 'Sorry, an error occured', 'wolbusinessdesk' );
			
			if (  $this->get_original_type() ){
				
				if ( array_key_exists( $this->get_original_type(), wol_get_crm_allowed_cpt() ) ){
										
					$original_source_id = wol_crm_get_original_source_id();
					$permalink 			= get_permalink( $original_source_id );
					$title				= get_the_title( $original_source_id );
					
					$the_title 			= '<a href="' . $permalink . '">' . $title . '</a>';
					
				}
				
			} else {
				
				global $post;
				
				$permalink 	= get_permalink( $post->ID );
				$title		= get_the_title( $post->ID );
					
				$the_title 	= '<a href="' . $permalink . '">' . $title . '</a>';
			}
			
			return $the_title;
			
		}
		
		public function get_original_source_id(){
			
			global $post;
			
			$original_source_id = get_post_meta( $post->ID, 'wol_original_source_id', TRUE );
			
			return $original_source_id;
		}
		
		public function get_due_date(){
			
			global $post;
			
			$due_date = get_post_meta( $post->ID, 'wol_due_date', TRUE );
			
			return $due_date;
		}
		
	} // End Class
	
	
	
	
} // End if class exists
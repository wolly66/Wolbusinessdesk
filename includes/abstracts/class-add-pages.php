<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

abstract class Wol_Add_Pages {

	public $pages;
	public $front_page;
	public $options;
	public $version;
	public $option_name;
	public $pages_options;

			
	/**
	 * add_pages function.
	 *
	 * Create new pages
	 *
	 * Update utility option with all the pages
	 *
	 * @access public
	 *
	 */
	public function add_pages() {

		
		// Do checks only in backend
		if ( is_admin() ) {
			
			$this->pages_options = get_option( WOLBUSINESSDESK_PAGES_OPTION_NAME );

			if ( empty( $GLOBALS['wp_rewrite'] ) ) {
				
				$GLOBALS['wp_rewrite'] = new WP_Rewrite();
			}

			global $wpdb;

			foreach ( $this->pages as $page ) {

				if ( isset( $this->pages_options[$page['key_array']] ) ) {
					
					continue;
				}
				//if page exists $pagina->ID is the id of the page
				$pagina = get_page_by_path( $page['post_name'] );
				
				$old_content_page = ( is_object( $pagina ) ) ? $pagina->post_content : '';

				//Create the array for insert post
				$arg = array(
					'ID'          		=> '',
					'post_title'   		=> $page['post_title'],
					'post_name'    		=> $page['post_name'],
					'post_content' 		=> ( ! empty ( $page['post_content'] ) ? $page['post_content'] : $old_content_page ),
					'post_type'    		=> $page['post_type'],
					'post_status'  		=> $page['post_status'],
					'post_author'  		=> $page['post_author'],
					// Assign page template
					'page_template'  	=> $page['_page_template'],
				);


				//if page doesn't exist I create it
				if ( empty( $pagina ) ) {
				
					$post_id = wp_insert_post( $arg );
					
					$this->pages_options[ $page['key_array'] ] = (int) $post_id;
					
					update_option( WOLBUSINESSDESK_PAGES_OPTION_NAME, $this->pages_options );
					
					$this->pages_options = get_option( WOLBUSINESSDESK_PAGES_OPTION_NAME );
				} 
				
				
			} //end foreach

			

			//delete pages permalink transient
			delete_transient( 'wol-permalinks-transient' );

			// Use a static front page
			if ( isset( $this->front_page ) && ! empty( $this->front_page ) ) {

				$frontpage = get_page_by_path( $this->front_page['page-slug'] );

				if ( ! empty( $frontpage ) ) {

					$page_on_front = update_option( 'page_on_front', (int) $frontpage->ID );
					$show_on_front = update_option( 'show_on_front', 'page' );

				}
			}

		} //end if only in the admin

	}

}// chiudo la classe

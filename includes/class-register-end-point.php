<?php
	
	if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
	}

if ( ! class_exists( 'Wolbusinessdesk_Register_End_Point' ) ){
	
	/**
	 * Wolbusinessdesk_Front_End_Admin class.
	 */
	class Wolbusinessdesk_Register_End_Point{
		
		var $options = '';
		var $slugs = '';
		
		public function __construct(){
			
			
			$this->options = get_option( WOLBUSINESSDESK_PAGES_OPTION_NAME );
			
			$this->slugs = ( ! empty( $this->options ) && isset( $this->options['front_end_admin_end_point'] ) ) ?
				$this->options['front_end_admin_end_point'] :
				array();
				
			add_action( 'init', array( 
				$this,
				'register_end_point' 
			) );
			
			// ! TODO TEST DA RIMUOVERE
			add_filter ( 'wol_endpoints', array( $this, 'prova') );
			add_filter ( 'wol_front_end_admin_menu', array( $this, 'prova_menu') );
			add_action ( 'wol_render_front_end_admin_prova_slug_endpoint', array(
			 $this,
			 'prova_html'
			 ));
			// ! TODO FINE TEST DA RIMUOVERE
				
		}
		
		/**
		 * register_end_point function.
		 * 
		 * @access public
		 * @return void
		 */
		public function register_end_point(){
					
			$endpoints_to_register = $this->return_end_points();
					
			if ( $endpoints_to_register && ! empty( $endpoints_to_register ) && is_array( $endpoints_to_register ) ){				
				
				foreach ( $endpoints_to_register as $ep ){					

					add_rewrite_endpoint( $ep, EP_ROOT | EP_PAGES );

				}
			
			}
		}
		
		/**
		 * return_end_points function.
		 * 
		 * @access public
		 * @return void
		 */
		public function return_end_points(){
			
			$standard_endpoints = $this->standard_endpoint();
			
			$endpoints_array = array();
			
			foreach ( $standard_endpoints as $key => $se ){
				
				$endpoints_array[$key] = $se['endpoint'];
			}
			
			$endpoints_to_register = array_merge( $endpoints_array, $this->slugs );
			
			return $endpoints_to_register;
			
			
		}
		
		/**
		 * standard_endpoint function.
		 * 
		 * @access public
		 * @return void
		 */
		public function standard_endpoint(){
			
			$standard_endpoints = array(
				'boards_slug'				=> array( 
					'endpoint'	=> 'wol-boards',
					'name'		=> __( 'Cockpit boards', 'wollyplugin' ),
				),
				'permissions_slug' 			=> array(
					'endpoint'	=> 'wol-permissions',
					'name'		=> __( 'Cockpit permissions', 'wollyplugin' ),
				),

				'new_client_slug'			=> array( 
					'endpoint'	=> 'wol-new-client',
					'name'		=> __( 'New client page', 'wollyplugin' ),
				),

				'new_task_slug'				=> array(
					'endpoint'	=> 'wol-new-task',
					'name'		=> __( 'New task page', 'wollyplugin' ),
				),
				'new_client_document_slug'	=> array(
					'endpoint'	=> 'wol-new-client-document',
					'name'		=> __( 'New client document page', 'wollyplugin' ),
				),
			);
			
			$standard_endpoints = apply_filters( 'wol_endpoints', $standard_endpoints );
			
			return $standard_endpoints;
		}
		// ! TODO TEST DA RIMUOVERE
		function prova( $standard_endpoints ){
	
			$standard_endpoints['prova_slug'] = array(
				'endpoint'	=> 'prova',
				'name'		=> 'test filtro',
				);
	
			return $standard_endpoints;
	
	
		}
		// ! TODO TEST DA RIMUOVERE
		function prova_menu( $menu ){
	
			
			$menu['prova'] = array(
					'name' => __( 'Prova Home', 'wollyplugin' ),
					'slug'	=> 'prova_slug',
				);
	
			return $menu;
	
	
		}
		// ! TODO TEST DA RIMUOVERE
		function prova_html(){
			
			echo 'GIAO SEI NELLA PAGINA DI PROVA';
		}
		
		

		
	}
	
	



}

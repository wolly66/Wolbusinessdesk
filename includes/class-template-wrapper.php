<?php
	
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Wolbusinessdesk_Template_Wrapper' ) ){
	
	/**
	 * Wolbusinessdesk_Template_Wrapper class.
	 */
	class Wolbusinessdesk_Template_Wrapper{
				
		/**
		 * add_client_document function.
		 * 
		 * @access public
		 * @return button add new document
		 */
		public function add_client_document(){
			
			$front_end = new Wolbusinessdesk_Front_End_Cpt( 'wol-client-document' );
			
			$add = $front_end->add_cpt();
			
			return $add;
			
		}
		
		/**
		 * get_template_part function.
		 * 
		 * @access public
		 * @param mixed $name
		 * @param mixed $template_part
		 * @return $template
		 */
		public function get_template_part( $name, $template_part ){
			
			$template = wolbusinessdesk()->template_loader->get_template_part( $name, $template_part );
			
			return $template;
			
		}
		
		/**
		 * get_sidebar_cockpit_menu function.
		 * 
		 * @access public
		 * @return $menu_items
		 */
		public function get_sidebar_cockpit_menu(){
			
			$menu_items = wolbusinessdesk()->cockpit->get_menus();
			
			return $menu_items;
			
		}
		
		/**
		 * get_menu_list function.
		 * 
		 * @access public
		 * @param string $class (default: '')
		 * @return $menu_list
		 */
		public function get_menu_list( $class = '' ){
			
			$menu_list = '';
			$menu_items = $this->get_sidebar_cockpit_menu();
			
			foreach ( $menu_items as $mi ) {
		      
		  		$menu_list .= '<a href="' . $mi['url'] . '" class="' . $class . '">' . $mi['name'] . '</a>';
        
		   }
		   
		   return $menu_list;
			
			
		}
		/**
		 * get_cockpit_page function.
		 * 
		 * @access public
		 * @return $page
		 */
		public function get_cockpit_page(){
			
			/**
			 * page
			 * 
			 * (default value: wolbusinessdesk()->cockpit->get_page())
			 * 
			 * @var mixed
			 * @access public
			 */
			$page = wolbusinessdesk()->cockpit->get_page();
			
			return $page;
		
		}
		
		/**
		 * get_company_fields_form function.
		 * 
		 * @access public
		 * @param int $client_id (default: 0)
		 * @return void
		 */
		public function get_company_fields_form( $client_id = 0 ){
			
			/**
			 * html
			 * 
			 * (default value: '')
			 * 
			 * @var string
			 * @access public
			 */
			$html = '';
			
			/**
			 * client_fields
			 * 
			 * (default value: wolbusinessdesk()->company_info->client_fields())
			 * 
			 * @var mixed
			 * @access public
			 */
			$client_fields = wolbusinessdesk()->company_info->client_fields();
			
			/**
			 * html
			 * 
			 * @var mixed
			 * @access public
			 */
			$html .= '<ul>';
			
			foreach ( $client_fields as $key => $cf ){
				
				/**
				 * html
				 * 
				 * @var mixed
				 * @access public
				 */
				$html .= '<li><input type=text" name="' . $key . '" value="" > ' . $cf['label'] . '</li>';
			}
			
			/**
			 * html
			 * 
			 * @var mixed
			 * @access public
			 */
			$html .= '</ul>';
			
			return $html;
			
			
		}
		
		public function get_task_fields_form(){
			
			
		}
		
		/**
		 * add_cpt function.
		 * 
		 * @access public
		 * @param string $cpt (default: '')
		 * @return void
		 */
		public function add_cpt( $cpt = '' ){
			
			/**
			 * front_end_cpt
			 * 
			 * (default value: new Wolbusinessdesk_Front_End_Cpt( $cpt ))
			 * 
			 * @var mixed
			 * @access public
			 */
			$front_end_cpt = new Wolbusinessdesk_Front_End_Cpt( $cpt );
			
			/**
			 * add_cpt
			 * 
			 * (default value: $front_end_cpt->add_cpt())
			 * 
			 * @var mixed
			 * @access public
			 */
			$add_cpt = $front_end_cpt->add_cpt();
			
			return $add_cpt;
		}
		
		/**
		 * get_add_new_client_url function.
		 * 
		 * @access public
		 * @return void
		 */
		public function get_add_new_client_url(){
			
			/**
			 * endpoints
			 * 
			 * (default value: get_option( WOLBUSINESSDESK_PAGES_OPTION_NAME ))
			 * 
			 * @var mixed
			 * @access public
			 */
			$endpoints = get_option( WOLBUSINESSDESK_PAGES_OPTION_NAME );
			
			/**
			 * pages_permalink
			 * 
			 * (default value: wolbusinessdesk()->get_pages_permalink())
			 * 
			 * @var mixed
			 * @access public
			 */
			$pages_permalink = wolbusinessdesk()->get_pages_permalink();
			
			/**
			 * add_client_url
			 * 
			 * (default value: '#')
			 * 
			 * @var string
			 * @access public
			 */
			$add_client_url = '#';
			
			if ( isset( $pages_permalink['id_front_end_admin'] ) && isset( $endpoints['front_end_admin_end_point']['new_client_slug'] ) ){
				
				/**
				 * add_client_url
				 * 
				 * (default value: $pages_permalink['id_front_end_admin'] . $endpoints['front_end_admin_end_point']['new_client_slug'] . '/')
				 * 
				 * @var string
				 * @access public
				 */
				$add_client_url = $pages_permalink['id_front_end_admin'] . $endpoints['front_end_admin_end_point']['new_client_slug'] . '/';
								
			}
			
			return $add_client_url;
		}
		
		/**
		 * get_add_new_task_url function.
		 * 
		 * @access public
		 * @return void
		 */
		public function get_add_new_task_url(){
			
			/**
			 * endpoints
			 * 
			 * (default value: get_option( WOLBUSINESSDESK_PAGES_OPTION_NAME ))
			 * 
			 * @var mixed
			 * @access public
			 */
			$endpoints = get_option( WOLBUSINESSDESK_PAGES_OPTION_NAME );
			
			/**
			 * pages_permalink
			 * 
			 * (default value: wolbusinessdesk()->get_pages_permalink())
			 * 
			 * @var mixed
			 * @access public
			 */
			$pages_permalink = wolbusinessdesk()->get_pages_permalink();
			
			/**
			 * add_task_url
			 * 
			 * (default value: '#')
			 * 
			 * @var string
			 * @access public
			 */
			$add_task_url = '#';
			
			if ( isset( $pages_permalink['id_front_end_admin'] ) && isset( $endpoints['front_end_admin_end_point']['new_task_slug'] ) ){
				
				/**
				 * add_task_url
				 * 
				 * (default value: $pages_permalink['id_front_end_admin'] . $endpoints['front_end_admin_end_point']['new_client_slug'] . '/')
				 * 
				 * @var string
				 * @access public
				 */
				$add_task_url = $pages_permalink['id_front_end_admin'] . $endpoints['front_end_admin_end_point']['new_task_slug'] . '/';
								
			}
			
			return $add_task_url;
			
			
		}
		
		/**
		 * get_add_new_client_document_url function.
		 * 
		 * @access public
		 * @return void
		 */
		public function get_add_new_client_document_url(){
			
			/**
			 * endpoints
			 * 
			 * (default value: get_option( WOLBUSINESSDESK_PAGES_OPTION_NAME ))
			 * 
			 * @var mixed
			 * @access public
			 */
			$endpoints = get_option( WOLBUSINESSDESK_PAGES_OPTION_NAME );
			
			/**
			 * pages_permalink
			 * 
			 * (default value: wolbusinessdesk()->get_pages_permalink())
			 * 
			 * @var mixed
			 * @access public
			 */
			$pages_permalink = wolbusinessdesk()->get_pages_permalink();
			
			/**
			 * add_client_document_url
			 * 
			 * (default value: '#')
			 * 
			 * @var string
			 * @access public
			 */
			$add_client_document_url = '#';
			
			if ( isset( $pages_permalink['id_front_end_admin'] ) && isset( $endpoints['front_end_admin_end_point']['new_task_slug'] ) ){
				
				/**
				 * add_client_document_url
				 * 
				 * (default value: $pages_permalink['id_front_end_admin'] . $endpoints['front_end_admin_end_point']['new_client_slug'] . '/')
				 * 
				 * @var string
				 * @access public
				 */
				$add_client_document_url = $pages_permalink['id_front_end_admin'] . $endpoints['front_end_admin_end_point']['new_client_document_slug'] . '/';
								
			}
			
			return $add_client_document_url;
			
			
		}
	}// END CLASS
	
}// END IF CLASS EXISTS
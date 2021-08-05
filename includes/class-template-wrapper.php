<?php
	
namespace Wolbusinessdesk\Includes;
use function Wolbusinessdesk\wol;
 
	// If this file is accessed directory, then abort.
	if ( ! defined( 'WPINC' ) ) {
	    die;
	}

if ( ! class_exists( 'Template_Wrapper' ) ){
	
	/**
	 * Wolbusinessdesk_Template_Wrapper class.
	 */
	class Template_Wrapper{
			
		
		/**
		 * add_client_document function.
		 * 
		 * @access public
		 * @return button add new document
		 */
		public function add_client_document(){
			
			$front_end = new Front_End_Cpt( 'wol-client-document' );
			
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
			
			$template = wol()->template_loader->get_template_part( $name, $template_part );
			
			return $template;
			
		}
		
		/**
		 * get_sidebar_cockpit_menu function.
		 * 
		 * @access public
		 * @return $menu_items
		 */
		public function get_sidebar_cockpit_menu(){
			
			$menu_items = wol()->cockpit->get_menus();
			
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
			 * (default value: wol()->cockpit->get_page())
			 * 
			 * @var mixed
			 * @access public
			 */
			$page = wol()->cockpit->get_page();
			
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
			 * (default value: wol()->company_info->client_fields())
			 * 
			 * @var mixed
			 * @access public
			 */
			$client_fields = wol()->company_info->client_fields();
			
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
		
		/**
		 * get_cockpit_settings_query function.
		 * 
		 * @since 1.0
		 * @access public
		 * @return query $query
		 */
		public function get_cockpit_settings_query(){
			
			/**
			 * query
			 * 
			 * (default value: '')
			 * 
			 * @since 1.0
			 * @var string
			 * @access public
			 */
			$settings_query = array();
			
			global $wp_query;
			
			if ( isset( $wp_query->query_vars['wol-settings-tickets'] ) ){
				
				
				/**
				 * priority
				 * 
				 * 
				 * @since 1.0
				 * @var mixed
				 * @access public
				 */
				$priority = get_terms( array(
					'taxonomy' => 'wol-ticket-priority',
					'hide_empty' => false,
					)
				);
				
				$settings_query['priority'] = ( ! is_wp_error( $priority ) ) ?
					$priority:
					'';
									
				/**
				 * ticket
				 * 
				 * 
				 * @since 1.0
				 * @var mixed
				 * @access public
				 */
				$ticket = get_terms( array(
					'taxonomy' => 'wol-ticket-ticket',
					'hide_empty' => false,
					)
				);
				
				$settings_query['category'] = ( ! is_wp_error( $ticket ) ) ?
					$ticket:
					'';
												
				/**
				 * status
				 * 
				 * 
				 * @since 1.0
				 * @var mixed
				 * @access public
				 */
				$status = get_terms( array(
					'taxonomy' => 'wol-ticket-status',
					'hide_empty' => false,
					)
				);
				
				$settings_query['status'] = ( ! is_wp_error( $status ) ) ?
					$status:
					'';
				/**
				 * type
				 * 
				 * 
				 * @since 1.0
				 * @var mixed
				 * @access public
				 */
				$type = get_terms( array(
					'taxonomy' => 'wol-ticket-type',
					'hide_empty' => false,
					)
				);
				
				$settings_query['type'] = ( ! is_wp_error( $type ) ) ?
					$type:
					'';
				
				
			} // end if wol-settings-tickets
			
			return $settings_query;
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
			$front_end_cpt = new Front_End_Cpt( $cpt );
			
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
		
		public function get_add_new_ticket_url(){
			
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
			 * (default value: wol()->get_pages_permalink())
			 * 
			 * @var mixed
			 * @access public
			 */
			$pages_permalink = wol()->get_pages_permalink();
			
			/**
			 * add_client_url
			 * 
			 * (default value: '#')
			 * 
			 * @var string
			 * @access public
			 */
			$add_ticket_url = '#';
			
			if ( isset( $pages_permalink['id_front_end_admin'] ) && isset( $endpoints['front_end_admin_end_point']['new_support_request_slug'] ) ){
				
				/**
				 * $add_ticket_url
				 * 
				 * (default value: $pages_permalink['id_front_end_admin'] . $endpoints['front_end_admin_end_point']['new_support_request_slug'] . '/')
				 * 
				 * @var string
				 * @access public
				 */
				$add_ticket_url = $pages_permalink['id_front_end_admin'] . $endpoints['front_end_admin_end_point']['new_support_request_slug'] . '/';
								
			}
			
			return $add_ticket_url;
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
			 * (default value: wol()->get_pages_permalink())
			 * 
			 * @var mixed
			 * @access public
			 */
			$pages_permalink = wol()->get_pages_permalink();
			
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
			 * (default value: wol()->get_pages_permalink())
			 * 
			 * @var mixed
			 * @access public
			 */
			$pages_permalink = wol()->get_pages_permalink();
			
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
			 * (default value: wol()->get_pages_permalink())
			 * 
			 * @var mixed
			 * @access public
			 */
			$pages_permalink = wol()->get_pages_permalink();
			
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
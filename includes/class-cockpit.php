<?php
	
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
	}

if ( ! class_exists( 'Wolbusinessdesk_Cockpit' ) ){
	
	/**
	 * wolbusinessdesk_Front_End_Admin class.
	 */
	class Wolbusinessdesk_Cockpit{
		
		/**
		 * options
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $options = '';
		
		/**
		 * slugs
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $slugs = '';
		
		/**
		 * __construct function.
		 * 
		 * @access public
		 * @return void
		 */
		public function __construct(){
			
			add_action( 'wol_render_front_end_admin_home_endpoint', array(
			 $this,
			 'home'
			 ));
			 
			 add_action( 'wol_render_front_end_admin_boards_slug_endpoint', array(
			 $this,
			 'boards'
			 ));
			 
			 add_action( 'wol_render_front_end_admin_permissions_slug_endpoint', array(
			 $this,
			 'permissions'
			 ));
			 
			 add_action( 'wol_render_front_end_admin_settings_slug_endpoint', array(
			 $this,
			 'settings'
			 ));
			 
			 add_action( 'wol_render_front_end_admin_new_support_request_slug_endpoint', array(
			 $this,
			 'new_support_request'
			 ));
			 
			 
			 add_action( 'wol_render_front_end_admin_settings_ticket_taxonomies_slug_endpoint', array(
			 $this,
			 'settings_ticket_taxonomies'
			 ));
			 
			 add_action( 'wol_render_front_end_admin_new_client_slug_endpoint', array(
			 $this,
			 'new_client'
			 ));
			 
			 add_action( 'wol_render_front_end_admin_new_task_slug_endpoint', array(
			 $this,
			 'new_task'
			 ));
			 
			 add_action( 'wol_render_front_end_admin_new_client_document_slug_endpoint', array(
			 $this,
			 'new_client_document'
			 ));

			add_filter ( 'wol_front_end_admin_menu', array( $this, 'settings_menu') );
							
		}
		
		/**
		 * get_page function.
		 * 
		 * @access public
		 * @return void
		 */
		public function get_page(){
					
			if ( is_wol_administrator() ){				
				
				/**
				 * page
				 * 
				 * @var mixed
				 * @access public
				 */
				$page = (  $this->find_sub_page()  ) ?
					sanitize_text_field(  $this->find_sub_page() ) :
					'home';
					
				$template = do_action( 'wol_render_front_end_admin_' . $page . '_endpoint' );
				
				
				
				} else {
					// ! TODO ADD LOGIN AND CHECK IF IS LOGGEND IN
					$template = __( 'Sorry, you have to login to access this page', 'wolbusinessdesk' );
			}
						
			return $template;
		}
		
		/**
		 * find_sub_page function.
		 * 
		 * @access private
		 * @return void
		 */
		private function find_sub_page(){
			
			$endpoints = wolbusinessdesk()->endpoints->return_end_points();
			
			global $wp_query;
			
			$slug = false;
			
			if ( $endpoints && ! empty( $endpoints ) && is_array( $endpoints ) ){
				
				foreach ( $endpoints as $key => $ep ){
					
					if (  ! isset( $wp_query->query_vars[ $ep ] ) ) {
						
						continue;
						
					} else {
						
						return $key;
					}
						
				}
			}
			
			return $slug;
		}
		
		/**
		 * home function.
		 * 
		 * @access public
		 * @return void
		 */
		public function home(){
			
			wol_get_template_part( 'cockpit', 'home' );
			
		}
		/**
		 * home function.
		 * 
		 * @access public
		 * @return void
		 */
		public function get_home_query(){
					
			
			if ( taxonomy_exists( 'wol-ticket-status' ) ){
				
				/**
				 * wolly_support_options
				 * 
				 * (default value: get_option( 'wolbusinessdesk_support_option' ))
				 * 
				 * @var string
				 * @access public
			 	*/
			 	$wolly_support_options		= get_option( 'wolbusinessdesk_support_option' );
				
				/**
				 * support_tax_query
				 * 
				 * @var mixed
				 * @access public
				 */
				$support_tax_query 	= ( $wolly_support_options['status'] ) ?
					array(
						'taxonomy' => 'wol-ticket-status',
						'field' => 'term_id',
						'terms' => array( $wolly_support_options['status'] ),
						'operator' => 'NOT IN'
					) :
					
				'';
				
				} else {
				
					$support_tax_query = '';
			}	
			
			if ( taxonomy_exists( 'wol-document-status' ) ){
				
				/**
				 * wolly_documents_options
				 * 
				 * (default value: get_option( 'wolbusinessdesk_documents_option' ))
				 * 
				 * @var string
				 * @access public
			 	 */
			 	$wolly_documents_options	= get_option( 'wolbusinessdesk_documents_option' );
			 	
			 	if ( $wolly_documents_options['doc_approve_status'] && $wolly_documents_options['doc_reject_status'] ){
				
					/**
					 * document_tax_query
					 * 
					 * @var mixed
					 * @access public
					 */
					$document_tax_query = array(
						'taxonomy' => 'wol-document-status',
						'field' => 'term_id',
						'terms' => array( $wolly_documents_options['doc_approve_status'], $wolly_documents_options['doc_reject_status'] ),
						'operator' => 'NOT IN'
					);
					
					} else {
					
						$document_tax_query = '';
				}	
				
				} else {
					
					$document_tax_query = '';
			}	
			
			if ( taxonomy_exists( 'wol-crm-status' ) ){
				
				/**
				 * wolly_crm_options
				 * 
				 * (default value: get_option( 'wolbusinessdesk_crm_option' ))
				 * 
				 * @var string
				 * @access public
			 	*/
			 	$wolly_crm_options 			= get_option( 'wolbusinessdesk_crm_option' );
								
				/**
				 * crm_tax_query
				 * 
				 * @var mixed
				 * @access public
				 */
				$crm_tax_query 		= ( $wolly_crm_options['crm_status'] ) ?
					array(
						'taxonomy' => 'wol-crm-status',
						'field' => 'term_id',
						'terms' => array( $wolly_crm_options['crm_status'] ),
						'operator' => 'NOT IN'
					) :
					
				'';
				
				} else {
					
					$crm_tax_query = '';
			}
			
			/**
			 * post_types
			 * 
			 * (default value: array())
			 * 
			 * @var array
			 * @access public
			 */
			$post_types = array();
				
				if ( post_type_exists( 'wol-client-document' ) )
					$post_types[] = 'wol-client-document';
				
				if ( post_type_exists( 'wol-ticket' ) )
					$post_types[] = 'wol-ticket';
				
				if ( post_type_exists( 'wol-crm' ) )
					$post_types[] = 'wol-crm';

			/**
			 * args
			 * 
			 * @var mixed
			 * @access public
			 */
			$args = array(
								
				'post_type'	=> $post_types,
				'order'		=> 'ASC',
				'orderby'	=> 'date',
				'post_status'=>'publish',
				'tax_query' => array(
					'relation' => 'AND',
						$support_tax_query,
						$document_tax_query,
						$crm_tax_query,
				),
			);
			
			/**
			 * query
			 * 
			 * (default value: new WP_Query( $args ))
			 * 
			 * @var mixed
			 * @access public
			 */
			$query = new WP_Query( $args );
			
			return $query;
			
		}
		
		/**
		 * boards function.
		 * 
		 * @access public
		 * @return void
		 */
		public function boards(){
			
			if ( is_wol_boards_manager() ){
				/**
				 * boards
				 * 
				 * @var mixed
				 * @access public
				 */
				$boards = get_terms( array(
					'taxonomy' => 'wol-ticket-board',
					'hide_empty' => false,
					) );
				
				/**
				 * board_list
				 * 
				 * (default value: '')
				 * 
				 * @var string
				 * @access public
				 */
				$board_list = '';
				
				/**
				 * board_list
				 * 
				 * (default value: '<ul>')
				 * 
				 * @var string
				 * @access public
				 */
				$board_list .= '<ul>';
				
				foreach ( $boards as $b ){
					
					/**
					 * is_public
					 * 
					 * @var mixed
					 * @access public
					 */
					$is_public = ( get_term_meta( $b->term_id, 'wol_is_public_board', TRUE ) ) ?
						'public' :
						'private';
					
					/**
					 * board_list
					 * 
					 * (default value: '<li>')
					 * 
					 * @var string
					 * @access public
				 	 */
					$board_list .= '<li>' . $b->name . ' ' . $is_public . '</li>';
				}
				
				/**
				 * board_list
				 * 
				 * (default value: '</ul>')
				 * 
				 * @var string
				 * @access public
				 */
				$board_list .= '</ul>';
				
				} else {
					
					/**
					 * board_list
					 * 
					 * (default value: __( 'You do not have permissions to access this page', 'wolbusinessdesk' ))
					 * 
					 * @var string
					 * @access public
					 */
					$board_list = __( 'You do not have permissions to access this page', 'wolbusinessdesk' );
			}
			
			
			echo $board_list;
		}
		
		/**
		 * permissions function.
		 * 
		 * @access public
		 * @return void
		 */
		public function permissions(){
			
			echo 'GIAO SEI IN PERMISSIONS';
		}
		
		
		public function settings(){
			
			wol_get_template_part( 'cockpit', 'settings' );
			
		}
		
		public function new_support_request(){
			
			wol_get_template_part( 'cockpit', 'newsupport' );
		}
		public function settings_ticket_taxonomies(){
			
			wol_get_template_part( 'cockpit', 'settings' );
		}
		/**
		 * new_client function.
		 * 
		 * @access public
		 * @return void
		 */
		public function new_client(){
			
			wol_get_template_part( 'cockpit', 'newclient' );
			
		}
		
		/**
		 * new_task function.
		 * 
		 * @access public
		 * @return void
		 */
		public function new_task(){
			
			wol_get_template_part( 'cockpit', 'newtask' );
			
		}
		
		public function new_client_document(){
			
			wol_get_template_part( 'cockpit', 'newclientdocument' );
			
		}
		
		/**
		 * get_menus function.
		 *
		 * @since 1.0
		 * @access public
		 * @return $menu
		 */
		public function get_menus(){
			
			$menu = $this->menu_items();
									
			return $menu;
			
		}
		
		/**
		 * menu_items function.
		 * 
		 * @access private
		 * @return $menu_items
		 */
		private function menu_items(){
			
			$permalinks = wolbusinessdesk()->get_pages_permalink();
			
			$endpoints = wolbusinessdesk()->endpoints->return_end_points();
			
			
			if ( ! empty( $permalinks['id_front_end_admin'] ) ){
			
				$front_end_admin_url = esc_url_raw( $permalinks['id_front_end_admin'] );
				$menus = $this->register_menu();		
							
				foreach ( $menus as $key => $m ){
				
					if ( $key == 'home' ){
					
						$menu_items[$key] = array(
					 
							'url' 	=> $front_end_admin_url,
							'name' 	=> $m['name'],					
					
						);
				
					
						} else {
							$menu_items[$key] = array(
					 
								'url' 	=> $front_end_admin_url . $endpoints[$m['slug']] . '/',
								'name' 	=> $m['name'],
					
							);
				
					}
				
				}
			
			}
			
			
			return $menu_items;
		}
		
		
		
		/**
		 * register_menu function.
		 * 
		 * @access private
		 * @return $menu
		 */
		private function register_menu(){
			
			/**
			 * menu
			 * 
			 * @var mixed
			 * @access public
			 */
			$menu = array(
				
				'home' => array(
					'name' => __( 'Cockpit', 'wolbusinessdesk' ),
					'slug'	=> 'home',
				),
				'boards' => array(
					'name'	=> __( 'Boards', 'wolbusinessdesk' ),
					'slug'	=> 'boards_slug',
				),
				'permissions' => array( 
					'name' 	=> __( 'Permissions', 'wolbusinessdesk' ),
					'slug'	=> 'permissions_slug',
				),
				'settings' => array( 
					'name' 	=> __( 'Settings', 'wolbusinessdesk' ),
					'slug'	=> 'settings_slug',
				),
				
			);
						
			$menu = apply_filters( 'wol_front_end_admin_menu', $menu );
						
			return $menu;
		}
		
		/**
		 * settings_menu function.
		 * 
		 * @since 1.0
		 * @access public
		 * @param mixed $menu
		 * @return $menu for settings
		 */
		public function settings_menu( $menu ){
			
			global $wp_query;
						
			if ( isset( $wp_query->query_vars['wol-settings'] ) 
				|| isset( $wp_query->query_vars['wol-settings-tickets'] ) ){
				
				$menu = array(
				
					'home' => array(
						'name' => __( 'Cockpit', 'wolbusinessdesk' ),
						'slug'	=> 'home',
					),
					'settings' => array( 
						'name' 	=> __( 'Settings', 'wolbusinessdesk' ),
						'slug'	=> 'settings_slug',
					),
					'settings_tickets' => array( 
						'name' 	=> __( 'Settings Tickets', 'wolbusinessdesk' ),
						'slug'	=> 'settings_ticket_taxonomies_slug',
					),
				
				);
			
			}
			
			return $menu;
			
		}
		
		
		
	}// end class
	
}// end if class exists
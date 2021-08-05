<?php
	
	namespace Wolbusinessdesk\Includes;
	use function Wolbusinessdesk\wol;
	// If this file is accessed directory, then abort.
	if ( ! defined( 'WPINC' ) ) {
	    die;
	}
	
	
		
	Class Backend_Options{
		
		/**
		 * wol_base_options
		 * 
		 * @var mixed
		 * @access private
		 */
		private $wol_base_options;	
			
		/**
		 * company_info_options
		 * 
		 * @var mixed
		 * @access private
		 */
		private $wol_company_info_options;
		
		/**
		 * wol-document-options
		 * 
		 * @var mixed
		 * @access private
		 */
		private $wol_document_options;
		
		/**
		 * wol_support_options
		 * 
		 * @var mixed
		 * @access private
		 */
		private $wol_support_options;
		
		/**
		 * wol_crm_options
		 * 
		 * @var mixed
		 * @access private
		 */
		private $wol_crm_options;
		
		/**
		 * endpoints
		 * 
		 * @var mixed
		 * @access private
		 */
		private $endpoints;
		
		/**
		 * all_pages
		 * 
		 * @var mixed
		 * @access private
		 */
		private $all_pages;
		
		/**
		 * __construct function.
		 * 
		 * @access public
		 * @return void
		 */
		public function __construct(){
			
			add_action( 'admin_menu', array( $this, 'wolbusinessdesk_menu' ) );
			add_action( 'admin_init', array( $this, 'options_init' ) );
			
			$this->wol_base_options 			= get_option( WOLBUSINESSDESK_BASE_OPTION_NAME );
			$this->wol_company_info_options		= get_option( WOLBUSINESSDESK_COMPANY_INFO_OPTION_NAME );
			$this->wol_pages_options 			= get_option( WOLBUSINESSDESK_PAGES_OPTION_NAME );
			$this->wol_document_options 		= get_option( WOLBUSINESSDESK_DOCUMENT_OPTION_NAME );
			$this->wol_support_options 			= get_option( WOLBUSINESSDESK_SUPPORT_OPTION_NAME );
			$this->wol_crm_options 				= get_option( WOLBUSINESSDESK_CRM_OPTION_NAME );
			
			$this->all_pages					= $this->get_all_pages();
			$this->endpoints					= wol()->endpoints->standard_endpoint();
			
			
		}
		
		/**
		 * wolbusinessdesk_menu function.
		 * 
		 * @access public
		 * @return void
		 */
		public function wolbusinessdesk_menu() {
			
			/* *
			 * Add primary menu page wol Plugin			
 			 */
			add_menu_page( 'wolbusinessdesk', __( 'wolbusinessdesk', 'wolbusinessdesk' ), 'manage_options', 'wolbusinessdesk', array( $this, 'wolbusinessdesk_options' ), 'dashicons-businessman' );
							
			/**
			 * submenu
			 * 
			 * (default value: $this->submenu())
			 * 
			 * @var mixed
			 * @access public
			 */
			$submenu = $this->submenu();
			
			/**
			 * parent_sug
			 * 
			 * (default value: 'wolbusinessdesk')
			 * 
			 * @var string
			 * @access public
			 */
			$parent_sug = 'wolbusinessdesk';
			
			foreach ( $submenu as $sub ){
				/* *
				 * Add sub menu page Ticket Type Taxonomy			
 			     */
				add_submenu_page( $parent_sug, $sub['page_title'], $sub['menu_title'], $sub['capability'], $sub['menu-slug'], $sub['callback'] );
			}
			
			
		}
		
		/**
		 * submenu function.
		 * 
		 * @access public
		 * @return ordered by key array of submenu
		 */
		public function submenu() {
						
			$submenu_base = array(
				
				'1'	=> array(
					'page_title' => __( 'Settings', 'wolbusinessdesk' ),
					'menu_title' => 'Settings',
					'capability' => 'manage_options',
					'menu-slug'  => 'wolbusinessdesk-settings',
					'callback'   => array( $this, 'wolbusinessdesk_settings' ),
				),
				
				'10'	=> array(
					'page_title' => __( 'Clients', 'wolbusinessdesk' ),
					'menu_title' => 'Clients',
					'capability' => 'manage_options',
					'menu-slug'  => '/edit.php?post_type=wol-client',
					'callback'   => null,
				),
				
				'20'	=> array(
					'page_title' => __( 'Products', 'wolbusinessdesk' ),
					'menu_title' => 'Products',
					'capability' => 'manage_options',
					'menu-slug'  => '/edit.php?post_type=wol-products',
					'callback'   => null,
				),
			);
				
				
				
					
			$submenu_documents = array(
				'30'	=> array(
					'page_title' => __( 'Client Documents', 'wolbusinessdesk' ),
					'menu_title' => 'Client Documents',
					'capability' => 'manage_options',
					'menu-slug'  => '/edit.php?post_type=wol-client-document',
					'callback'   => null,
				),
			
				'40'	=> array(
					'page_title' => __( 'Documents', 'wolbusinessdesk' ),
					'menu_title' => 'Documents',
					'capability' => 'manage_options',
					'menu-slug'  => '/edit.php?post_type=wol-document',
					'callback'   => null,
				),
			);
			
			$submenu_documents = apply_filters( 'wol_plugin_backend_settings_submenu_documents', $submenu_documents );
				
				
					
			$submenu_support = array(
				
				'50'	=> array(
					'page_title' => __( 'Ticket Status', 'wolbusinessdesk' ),
					'menu_title' => 'Ticket Status',
					'capability' => 'manage_options',
					'menu-slug'  => '/edit-tags.php?taxonomy=wol-ticket-status&post_type=wol-ticket',
					'callback'   => null,
				),
			
				'60'	=> array(
					'page_title' => __( 'Ticket Priority', 'wolbusinessdesk' ),
					'menu_title' => 'Ticket Priority',
					'capability' => 'manage_options',
					'menu-slug'  => '/edit-tags.php?taxonomy=wol-ticket-priority&post_type=wol-ticket',
					'callback'   => null,
				),
			
				'70'	=> array(
					'page_title' => __( 'Ticket Type', 'wolbusinessdesk' ),
					'menu_title' => 'Ticket Type',
					'capability' => 'manage_options',
					'menu-slug'  => '/edit-tags.php?taxonomy=wol-ticket-type&post_type=wol-ticket',
					'callback'   => null,
				),
			);
				
				
			
			/**
			 * submenu
			 * 
			 * (default value: array_merge( $submenu_base, $submenu_documents, $submenu_support ))
			 * 
			 * @var mixed
			 * @access public
			 */
			$submenu = array_merge( $submenu_base, $submenu_documents, $submenu_support );
			
			
						
			
			ksort( $submenu );
			
			return  $submenu;
		}
		
		/**
		 * wolbusinessdesk_options function.
		 * 
		 * @access public
		 * @return void
		 */
		public function wolbusinessdesk_options() {
			
			if ( ! is_wol_administrator() )  {
				
				wp_die( __( 'You do not have sufficient permissions to access this page.', 'wolbusinessdesk' ) );
			}
			echo '<div class="wrap">';
			echo '<p>' . __( 'We have to do something, here', 'wolbusinessdesk' ) . '</p>';
			echo '</div>';
		}
		
		/**
		 * wolbusinessdesk_settings function.
		 * 
		 * @access public
		 * @return void
		 */
		public function wolbusinessdesk_settings(){
			
			
			if ( ! is_wol_administrator() ) {
				
				wp_die( __( 'You do not have sufficient permissions to access this page.', 'wolbusinessdesk' ) );
			}
						
			?>
			<div class="wrap">
					
				<div id="icon-themes" class="icon32"></div>
				<h2><?php _e( 'wolbusinessdesk Settings', 'wolbusinessdesk' ); ?></h2>
				<?php settings_errors(); ?>
         
				<?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'wol_base'; ?>
				
        		<h2 class="nav-tab-wrapper">
					
					<a href="?page=wolbusinessdesk-settings&tab=wol_base" class="nav-tab <?php echo $active_tab == 'wol_base' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Base settings', 'wolbusinessdesk' ); ?></a>
					<a href="?page=wolbusinessdesk-settings&tab=wol_company" class="nav-tab <?php echo $active_tab == 'wol_company' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Company', 'wolbusinessdesk' ); ?></a>
					<a href="?page=wolbusinessdesk-settings&tab=wol_pages" class="nav-tab <?php echo $active_tab == 'wol_pages' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Pages', 'wolbusinessdesk' ); ?></a>
					<a href="?page=wolbusinessdesk-settings&tab=wol_documents" class="nav-tab <?php echo $active_tab == 'wol_documents' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Documents', 'wolbusinessdesk' ); ?></a>
					<a href="?page=wolbusinessdesk-settings&tab=wol_support" class="nav-tab <?php echo $active_tab == 'wol_support' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Support', 'wolbusinessdesk' ); ?></a>
					<a href="?page=wolbusinessdesk-settings&tab=wol_crm" class="nav-tab <?php echo $active_tab == 'wol_crm' ? 'nav-tab-active' : ''; ?>"><?php _e( 'CRM', 'wolbusinessdesk' ); ?></a>
						
				</h2>
			
				<?php
         
				if ( $active_tab == 'wol_company' ){	
					
					?>
					<form method="post" action="options.php">
					<?php
					settings_fields( 'wolbusinessdesk_company_group' );
					do_settings_sections( 'wolbusinessdesk-settings&tab=wol_company' );
					submit_button();
					?>
					</form>
					<?php
						
				} elseif ( $active_tab == 'wol_base' ){	
					
					?>
					<form method="post" action="options.php">
					<?php
					settings_fields( 'wolbusinessdesk_base_group' );
					do_settings_sections( 'wolbusinessdesk-settings&tab=wol_base' );
					submit_button();
					?>
					</form>
					<?php
					

				} elseif ( $active_tab == 'wol_pages' ){	
					
					?>
					<form method="post" action="options.php">
					<?php
					settings_fields( 'wolbusinessdesk_pages_group' );
					do_settings_sections( 'wolbusinessdesk-settings&tab=wol_pages' );
					submit_button();
					?>
					</form>
					<?php
					
					
					
        			} elseif ( $active_tab == 'wol_documents' ){
	        			
	        			?>
					<form method="post" action="options.php">
					<?php
						
					settings_fields( 'wolbusinessdesk_documents_group' );
					do_settings_sections( 'wolbusinessdesk-settings&tab=wol_documents' );
					submit_button();
					
					?>
					</form>
					<?php
				} elseif ( $active_tab == 'wol_support' ){
	        			
	        			?>
					<form method="post" action="options.php">
					<?php
						
					settings_fields( 'wolbusinessdesk_support_group' );
					do_settings_sections( 'wolbusinessdesk-settings&tab=wol_support' );
					submit_button();
					
					?>
					</form>
					<?php
				} elseif ( $active_tab == 'wol_crm' ){
	        			
	        			?>
					<form method="post" action="options.php">
					<?php
						
					settings_fields( 'wolbusinessdesk_crm_group' );
					do_settings_sections( 'wolbusinessdesk-settings&tab=wol_crm' );
					submit_button();
					
					?>
					</form>
					<?php
				}// end if/else
                  
	    			?>
			
			</div>
			
			<?php
		}
		
		/**
	     * Register and add settings
	     */
	    public function options_init() {
		            
	        register_setting(
	            'wolbusinessdesk_base_group', // Option group
	            WOLBUSINESSDESK_BASE_OPTION_NAME, // Option name
	            array( $this, 'sanitize_base' ) // Sanitize
	        );
	        
	        register_setting(
	            'wolbusinessdesk_company_group', // Option group
	            WOLBUSINESSDESK_COMPANY_INFO_OPTION_NAME, // Option name
	            array( $this, 'sanitize_company' ) // Sanitize
	        );
	        
	        register_setting(
	            'wolbusinessdesk_pages_group', // Option group
	            WOLBUSINESSDESK_PAGES_OPTION_NAME, // Option name
	            array( $this, 'sanitize_pages' ) // Sanitize
	        );
	        
	        register_setting(
	            'wolbusinessdesk_documents_group', // Option group
	            WOLBUSINESSDESK_DOCUMENT_OPTION_NAME, // Option name
	            array( $this, 'sanitize_documents' ) // Sanitize
	        );
	        
	        register_setting(
	            'wolbusinessdesk_support_group', // Option group
	            WOLBUSINESSDESK_SUPPORT_OPTION_NAME, // Option name
	            array( $this, 'sanitize_support' ) // Sanitize
	        );
	        
	        register_setting(
	            'wolbusinessdesk_crm_group', // Option group
	            WOLBUSINESSDESK_CRM_OPTION_NAME, // Option name
	            array( $this, 'sanitize_crm' ) // Sanitize
	        );
				
			/**
			 *
			 * Base section
			 *
			 * @since 1.0
			 *
			 */
	        add_settings_section(
	            'wol_base_section_id', // ID
	            __( 'Base settings', 'wolbusinessdesk' ), // Title
	            array( $this, 'print_base_section_info' ), // Callback
	            'wolbusinessdesk-settings&tab=wol_base' // Page
	        );  
	
	        add_settings_field(
	            'date_format', // ID
	            __( 'Standard date format', 'wolbusinessdesk' ), // Title 
	            array( $this, 'date_format_info_callback' ), // Callback
	            'wolbusinessdesk-settings&tab=wol_base', // Page
	            'wol_base_section_id' // Section           
	        );     
	        
	       /**
			 *
			 * Company section
			 *
			 * @since 1.0
			 *
			 */
	        add_settings_section(
	            'wol_company_section_id', // ID
	            __( 'Company info', 'wolbusinessdesk' ), // Title
	            array( $this, 'print_company_section_info' ), // Callback
	            'wolbusinessdesk-settings&tab=wol_company' // Page
	        );  
	
	        add_settings_field(
	            'compnay_info', // ID
	            __( 'Company Info', 'wolbusinessdesk' ), // Title 
	            array( $this, 'company_info_callback' ), // Callback
	            'wolbusinessdesk-settings&tab=wol_company', // Page
	            'wol_company_section_id' // Section           
	        );      

	        
			/**
			 *
			 * Pages section
			 *
			 * @since 1.0
			 *
			 */
	        add_settings_section(
	            'wol_pages_section_id', // ID
	            __( 'Pages settings', 'wolbusinessdesk' ), // Title
	            array( $this, 'print_pages_section_info' ), // Callback
	            'wolbusinessdesk-settings&tab=wol_pages' // Page
	        );  
	
	        add_settings_field(
	            'new_support_request', // ID
	            __( 'New Support Request Page', 'wolbusinessdesk' ), // Title 
	            array( $this, 'new_support_request_callback' ), // Callback
	            'wolbusinessdesk-settings&tab=wol_pages', // Page
	            'wol_pages_section_id' // Section           
	        ); 
	        
	        add_settings_field(
	            'front_end_admin', // ID
	            __( 'Cockpit Page', 'wolbusinessdesk' ), // Title 
	            array( $this, 'cockpit_callback' ), // Callback
	            'wolbusinessdesk-settings&tab=wol_pages', // Page
	            'wol_pages_section_id' // Section           
	        ); 
	        
	        /**
			 *
			 * Endpoint section
			 *
			 * @since 1.0
			 *
			 */
	        add_settings_section(
	            'wol_endpoint_front_end_admin_section_id', // ID
	            __( 'Endpoints Front End  Admin', 'wolbusinessdesk' ), // Title
	            array( $this, 'print_endpoint_front_end_section_info' ), // Callback
	            'wolbusinessdesk-settings&tab=wol_pages' // Page
	        );  
	
	        add_settings_field(
	            'endpoint_request', // ID
	            __( 'Endpoints Slug', 'wolbusinessdesk' ), // Title 
	            array( $this, 'endpoint_slug_callback' ), // Callback
	            'wolbusinessdesk-settings&tab=wol_pages', // Page
	            'wol_endpoint_front_end_admin_section_id' // Section           
	        ); 
    
	        
	        /**
			 *
			 * Documents section
			 *
			 * @since 1.0
			 *
			 */
	        add_settings_section(
			    'wol_documents_section_id', // ID
			    __( 'Set opening and closing status', 'wolbusinessdesk' ), // Title
			    array( $this, 'print_section_opening_closing_status' ), // Callback
			    'wolbusinessdesk-settings&tab=wol_documents' // Page
			);
			
			add_settings_field(
			    'opening',
			    __( 'Opening status', 'wolbusinessdesk' ),
			    array( $this, 'doc_opening_status_callback' ),
			    'wolbusinessdesk-settings&tab=wol_documents',
			    'wol_documents_section_id'
			);
			
			add_settings_field(
			    'approve',
			    __( 'Approved status', 'wolbusinessdesk' ),
			    array( $this, 'doc_approve_status_callback' ),
			    'wolbusinessdesk-settings&tab=wol_documents',
			    'wol_documents_section_id'
			);
			
			add_settings_field(
			    'reject',
			    __( 'Rejected status', 'wolbusinessdesk' ),
			    array( $this, 'doc_reject_status_callback' ),
			    'wolbusinessdesk-settings&tab=wol_documents',
			    'wol_documents_section_id'
			);


	        add_settings_section(
	            'wol_documents_section_id_2', // ID
	            'wol Documents settings', // Title
	            array( $this, 'print_documents_section_info' ), // Callback
	            'wolbusinessdesk-settings&tab=wol_documents' // Page
	        ); 
	        
	        	
	        add_settings_field(
	            'id_number', // ID
	            __( 'ID Number DC', 'wolbusinessdesk' ), // Title 
	            array( $this, 'id_documents_number_callback' ), // Callback
	            'wolbusinessdesk-settings&tab=wol_documents', // Page
	            'wol_documents_section_id_2' // Section           
	        );      
	
	        add_settings_field(
	            'title', 
	            __( 'Title DC', 'wolbusinessdesk' ), 
	            array( $this, 'title_documents_callback' ), 
	            'wolbusinessdesk-settings&tab=wol_documents', 
	            'wol_documents_section_id_2'
	        );
	        
	        /**
			 *
			 * Support section
			 *
			 * @since 1.0
			 *
			 */
			add_settings_section(
			    'wol_support_section_id_2', // ID
			    __( 'Set opening and closing status', 'wolbusinessdesk' ), // Title
			    array( $this, 'print_section_opening_closing_status' ), // Callback
			    'wolbusinessdesk-settings&tab=wol_support' // Page
			);
			
			add_settings_field(
			    'opening',
			    __( 'Opening status', 'wolbusinessdesk' ),
			    array( $this, 'opening_status_callback' ),
			    'wolbusinessdesk-settings&tab=wol_support',
			    'wol_support_section_id_2'
			);
			
			add_settings_field(
			    'closing',
			    __( 'Closing status', 'wolbusinessdesk' ),
			    array( $this, 'closing_status_callback' ),
			    'wolbusinessdesk-settings&tab=wol_support',
			    'wol_support_section_id_2'
			);
			
			add_settings_section(
			    'wol_support_section_id_21', // ID
			    __( 'Set standard reply time (hours)', 'wolbusinessdesk' ), // Title
			    array( $this, 'print_section_standard_reply_time' ), // Callback
			    'wolbusinessdesk-settings&tab=wol_support' // Page
			);
			add_settings_field(
			    'closing',
			    __( 'Standard time reply in hours', 'wolbusinessdesk' ),
			    array( $this, 'standard_time_reply_callback' ),
			    'wolbusinessdesk-settings&tab=wol_support',
			    'wol_support_section_id_21'
			);
			
			
			add_settings_section(
			    'wol_support_section_id_3', // ID
			    __( 'Set standard listing', 'wolbusinessdesk' ), // Title
			    array( $this, 'print_section_standard_listing' ), // Callback
			    'wolbusinessdesk-settings&tab=wol_support' // Page
			);
			
			add_settings_field(
			    'listing-type',
			    __( 'Listing type', 'wolbusinessdesk' ),
			    array( $this, 'listing_type_callback' ),
			    'wolbusinessdesk-settings&tab=wol_support',
			    'wol_support_section_id_3'
			);
			add_settings_field(
			    'listing-priority',
			    __( 'Listing priority', 'wolbusinessdesk' ),
			    array( $this, 'listing_priority_callback' ),
			    'wolbusinessdesk-settings&tab=wol_support',
			    'wol_support_section_id_3'
			);
			add_settings_field(
			    'listing-status',
			    __( 'Listing status', 'wolbusinessdesk' ),
			    array( $this, 'listing_status_callback' ),
			    'wolbusinessdesk-settings&tab=wol_support',
			    'wol_support_section_id_3'
			);
			add_settings_field(
			    'listing-tickets-per-page',
			    __( 'Listing tickets per page', 'wolbusinessdesk' ),
			    array( $this, 'listing_tickets_per_page_callback' ),
			    'wolbusinessdesk-settings&tab=wol_support',
			    'wol_support_section_id_3'
			);
			
			 add_settings_field(
			    'listing-ticket-replies-per-page',
			    __( 'Listing tickets replies per page', 'wolbusinessdesk' ),
			    array( $this, 'listing_ticket_replies_per_page_callback' ),
			    'wolbusinessdesk-settings&tab=wol_support',
			    'wol_support_section_id_3'
			);
			
			add_settings_field(
			    'sorting-ticket-replies',
			    __( 'Sorting tickets replies', 'wolbusinessdesk' ),
			    array( $this, 'sorting_ticket_replies_callback' ),
			    'wolbusinessdesk-settings&tab=wol_support',
			    'wol_support_section_id_3'
			);
			
			/**
			 *
			 * CRM section
			 *
			 * @since 1.0
			 *
			 */
	        add_settings_section(
			    'wol_crm_section_id', // ID
			    __( 'Set opening and closing status', 'wolbusinessdesk' ), // Title
			    array( $this, 'print_section_opening_closing_status' ), // Callback
			    'wolbusinessdesk-settings&tab=wol_crm' // Page
			);
			
			add_settings_field(
			    'opening',
			    __( 'Opening status', 'wolbusinessdesk' ),
			    array( $this, 'crm_opening_status_callback' ),
			    'wolbusinessdesk-settings&tab=wol_crm',
			    'wol_crm_section_id'
			);
			
			add_settings_field(
			    'closing',
			    __( 'Closing status', 'wolbusinessdesk' ),
			    array( $this, 'crm_closing_status_callback' ),
			    'wolbusinessdesk-settings&tab=wol_crm',
			    'wol_crm_section_id'
			);
			
			add_settings_section(
			    'wol_crm_section_id_1', // ID
			    __( 'Set CRM standard listing', 'wolbusinessdesk' ), // Title
			    array( $this, 'print_section_crm_standard_listing' ), // Callback
			    'wolbusinessdesk-settings&tab=wol_crm' // Page
			);
			
			add_settings_field(
			    'crm-listing-type',
			    __( 'Listing type', 'wolbusinessdesk' ),
			    array( $this, 'crm_listing_type_callback' ),
			    'wolbusinessdesk-settings&tab=wol_crm',
			    'wol_crm_section_id_1'
			);
			add_settings_field(
			    'crm-listing-action',
			    __( 'Listing action', 'wolbusinessdesk' ),
			    array( $this, 'crm_listing_action_callback' ),
			    'wolbusinessdesk-settings&tab=wol_crm',
			    'wol_crm_section_id_1'
			);
			add_settings_field(
			    'crm-listing-status',
			    __( 'Listing status', 'wolbusinessdesk' ),
			    array( $this, 'crm_listing_status_callback' ),
			    'wolbusinessdesk-settings&tab=wol_crm',
			    'wol_crm_section_id_1'
			);
			add_settings_field(
			    'crm-listing-cpt',
			    __( 'Listing task sources', 'wolbusinessdesk' ),
			    array( $this, 'crm_listing_cpt_callback' ),
			    'wolbusinessdesk-settings&tab=wol_crm',
			    'wol_crm_section_id_1'
			);
			add_settings_field(
			    'crm-listing-task-per-page',
			    __( 'Listing tickets per page', 'wolbusinessdesk' ),
			    array( $this, 'crm_listing_task_per_page_callback' ),
			    'wolbusinessdesk-settings&tab=wol_crm',
			    'wol_crm_section_id_1'
			);
			
			 add_settings_field(
			    'crm-listing-task-replies-per-page',
			    __( 'Listing tickets replies per page', 'wolbusinessdesk' ),
			    array( $this, 'crm_listing_tasks_replies_per_page_callback' ),
			    'wolbusinessdesk-settings&tab=wol_crm',
			    'wol_crm_section_id_1'
			);
			
			add_settings_field(
			    'crm-sorting-task-replies',
			    __( 'Sorting tickets replies', 'wolbusinessdesk' ),
			    array( $this, 'crm_sorting_task_replies_callback' ),
			    'wolbusinessdesk-settings&tab=wol_crm',
			    'wol_crm_section_id_1'
			);
			
            
	    }
	    
	    	    
	    /**
	     * sanitize_company function.
	     * 
	     * @access public
	     * @param mixed $input
	     * @return void
	     */
	    public function sanitize_company( $input ){
		    		    
	        $new_input = array();
	        //Filter sanitize_base to add new options
	        $input = apply_filters( 'wol_sanitize_company', $input );
	        
			$company_fields = wol()->company_info->company_fields();
	        
	        foreach ( $input as $key => $i ){
		        
		        if ( 'wolnew' == $key ){
			        
			        $company_name = sanitize_title_with_dashes( $i['name'] );
			        
		        } else {
			        
			        $company_name = $key;
		        }
		        
		        if ( empty( $i['name'] ) )
		        	continue;
		        	
		        foreach ( $company_fields as $fkey => $fl ){
					
					switch ( $fl['type'] ) {
				
						case 'title':
							$new_input[$company_name][$fkey] = sanitize_title_with_dashes( $i[$fkey] );
							break;
							
						case 'text':
							$new_input[$company_name][$fkey] = sanitize_text_field( $i[$fkey] );
							break;
				
						default:
						
					}
					
				}
		        
		    }
	        
	       
	
	        return $new_input;
	    }
	    
	    /**
	     * sanitize_base function.
	     * 
	     * @access public
	     * @param mixed $input
	     * @return void
	     */
	    public function sanitize_base( $input ){ 
		    
		    $new_input = array();
		   
		    
		    if( isset( $input['std_date_format'] ) )
	        	$new_input['std_date_format'] =  sanitize_text_field( $input['std_date_format'] );
	        
	        return $new_input;
		    
		}
	    public function sanitize_pages( $input ){
		   
		    $new_input = array();
	        //Filter sanitize_base to add new options
	        $input = apply_filters( 'wol_sanitize_pages', $input );
	        
	        // ! TODO FILTER BddL
	        if( isset( $input['id_new_support_request'] ) )
	            $new_input['id_new_support_request'] =  absint( $input['id_new_support_request'] );
	            
	        if( isset( $input['id_front_end_admin'] ) )
	            $new_input['id_front_end_admin'] =  absint( $input['id_front_end_admin'] );   
	        
	        
	        if ( isset( $input['front_end_admin_end_point'] ) ){
		        
		        foreach ( $input['front_end_admin_end_point'] as $key => $i ){
			        
			        if ( ! empty( $i ) ){
			        	$new_input['front_end_admin_end_point'][$key] = sanitize_title( $i );
			        	} else {
				        	
				        	if ( $this->endpoints[$key] )
				        		$new_input['front_end_admin_end_point'][$key] = sanitize_title( $this->endpoints[$key]);
				        	
				        	
			        	}
		        }
	        }    
	           
	        delete_transient( 'wol_permalinks_transient' );
	        
		    return $new_input;
	    }
	    /**
	     * Sanitize each setting field as needed
	     *
	     * @param array $input Contains all settings fields as array keys
	     */
	    public function sanitize_documents( $input ) {
		    
	        $new_input = array();
	        
	        //Filter sanitize_documents to add new options
	        $input = apply_filters( 'wol_sanitize_documents', $input );
	        
	        if( isset( $input['doc_approve_status'] ) ){
			
			    $new_input['doc_approve_status'] = absint( $input['doc_approve_status'] );
			
			}
			
			if( isset( $input['doc_reject_status'] ) ){
			
			    $new_input['doc_reject_status'] = absint( $input['doc_reject_status'] );
			
			}
			
			if( isset( $input['doc_opening_status'] ) ){
			
			    $new_input['doc_opening_status'] = absint( $input['doc_opening_status'] );
			
			}
	        
	        if( isset( $input['id_number'] ) )
	            $new_input['id_number'] = absint( $input['id_number'] );
	
	        if( isset( $input['title'] ) )
	            $new_input['title'] = sanitize_text_field( $input['title'] );
	
	        return $new_input;
	    }
		
		/**
	     * Sanitize each setting field as needed
	     *
	     * @param array $input Contains all settings fields as array keys
	     */
	    public function sanitize_support( $input ) {
		    
			$new_input = array();
			
			if( isset( $input['status'] ) ){
			
			    $new_input['status'] = absint( $input['status'] );
			
			}
			
			if( isset( $input['opening_status'] ) ){
			
			    $new_input['opening_status'] = absint( $input['opening_status'] );
			
			}
			
			if( isset( $input['standard_reply_time'] ) ){
			
			    $new_input['standard_reply_time'] = absint( $input['standard_reply_time'] );
			
			}
			
			if( isset( $input['listing-type'] ) ){
			
			    $new_input['listing-type'] = absint( $input['listing-type'] );
			
			}
			
			if( isset( $input['listing-priority'] ) ){
			
			    $new_input['listing-priority'] = absint( $input['listing-priority'] );
			
			}
			
			if( isset( $input['listing-status-operator'] ) ){
			
			     if ( 0 == $input['listing-status-operator'] || 1 == $input['listing-status-operator'] ){
			
				 	$new_input['listing-status-operator'] = $input['listing-status-operator'];
			
			    }
			}
			
			if( isset( $input['listing-status'] ) ){
			
			    $new_input['listing-status'] = absint( $input['listing-status'] );
			
			}
			
			if( isset( $input['listing-tickets-per-page'] ) ){
			
			    $new_input['listing-tickets-per-page'] = absint( $input['listing-tickets-per-page'] );
			
			}
			
			if( isset( $input['listing-ticket-replies-per-page'] ) ){
			
			    $new_input['listing-ticket-replies-per-page'] = absint( $input['listing-ticket-replies-per-page'] );
			
			}

			if( isset( $input['sorting'] ) ){
			
			    if ( 'ASC' == $input['sorting'] || 'DESC' == $input['sorting'] ){
			
			    	$new_input['sorting'] = $input['sorting'] ;
			
			    }
			
			}
        
			return $new_input;
		    
		}
		
		/**
		 * sanitize_crm function.
		 * 
		 * @access public
		 * @param mixed $input
		 * @return void
		 */
		public function sanitize_crm( $input ) {
	        $new_input = array();
	        
	        //Filter sanitize_documents to add new options
	        $input = apply_filters( 'crm_documents', $input );
	        
	        if( isset( $input['crm_status'] ) ){
			
			    $new_input['crm_status'] = absint( $input['crm_status'] );
			
			}
			
			if( isset( $input['crm_opening_status'] ) ){
			
			    $new_input['crm_opening_status'] = absint( $input['crm_opening_status'] );
			
			}
			
			if( isset( $input['crm_std_listing_type'] ) ){
			
			    $new_input['crm_std_listing_type'] = absint( $input['crm_std_listing_type'] );
			
			}
			
			if( isset( $input['crm_std_listing_action'] ) ){
			
			    $new_input['crm_std_listing_action'] = absint( $input['crm_std_listing_action'] );
			
			}
			
			if( isset( $input['crm_listing_status_operator'] ) ){
			
			    $new_input['crm_listing_status_operator'] = absint( $input['crm_listing_status_operator'] );
			
			}
			
			if( isset( $input['crm_listing_status'] ) ){
			
			    $new_input['crm_listing_status'] = absint( $input['crm_listing_status'] );
			
			}
			
			if( isset( $input['crm_listing_cpt'] ) ){
				
				if ( 
					! empty( $input['crm_listing_cpt'] )
					&& is_array( $input['crm_listing_cpt'] )
					){
						
						foreach ( $input['crm_listing_cpt'] as $key => $cpt ){
							
							$new_input['crm_listing_cpt'][$key] = sanitize_text_field( $cpt );
							
						}
					}
			
			    
			
			}
			
			if( isset( $input['crm_listing_task_per_page'] ) ){
			
			    $new_input['crm_listing_task_per_page'] = absint( $input['crm_listing_task_per_page'] );
			
			}
			
			if( isset( $input['crm_listing_task_replies_per_page'] ) ){
			
			    $new_input['crm_listing_task_replies_per_page'] = absint( $input['crm_listing_task_replies_per_page'] );
			
			}
	        	        
	
	        return $new_input;
	    }
	    
	   	/**
	   	 * print_base_section_info function.
	   	 * 
	   	 * @access public
	   	 * @return void
	   	 */
	   	public function print_base_section_info() {
	        print __( 'General settings:', 'wolbusinessdesk' );
	        	        
	    }  
	    
	    /**
	     * date_format_info_callback function.
	     * 
	     * @access public
	     * @return void
	     */
	    public function date_format_info_callback () {
		    			
			    if( isset( $this->wol_base_options['std_date_format'] ) ) 
			    		$std_date_format = $this->wol_base_options['std_date_format'];
			    else 
			    		$std_date_format = 'd/m/Y';
						
				// [listing-status-operator]
				printf( 
			        '<ul>
			            <li>
			                <input type="radio"  name="wol-base-option[std_date_format]" value="yy-dd-mm"  class="lcs_check lcs_tt2"  autocomplete="off" %1$s /> %2$s
			            </li>
			            <li>
			                <input type="radio"  name="wol-base-option[std_date_format]" value="dd/mm/yy"  class="lcs_check lcs_tt2"  autocomplete="off" %3$s /> %4$s
			            </li>
			            <li>
			                <input type="radio"  name="wol-base-option[std_date_format]" value="mm/dd/yy"  class="lcs_check lcs_tt2"  autocomplete="off" %5$s /> %6$s
			            </li>
			        </ul>',
			        checked( $std_date_format, 'yy-dd-mm', false ), 					// 1
			        date( 'Y-m-d' ) . ' ' . __( 'year-month-day', 'wolbusinessdesk' ),	// 2
			        checked( $std_date_format, 'dd/mm/yy', false ),						// 3
			        date( 'd/m/Y' ) . ' ' . __( 'day/month/year', 'wolbusinessdesk' ),	// 4
			        checked( $std_date_format, 'mm/dd/yy', false ),						// 5
					date( 'm/d/Y' )	. ' ' . __( 'month/day/year', 'wolbusinessdesk' )	// 6
			        
			    );
				
					    
		    
	    }
	    
	    /**
	     * print_company_section_info function.
	     * 
	     * @access public
	     * @return void
	     */
	    public function print_company_section_info() {
	        print __( 'Insert your company infos', 'wolbusinessdesk' );
	        	        
	    }
	    
	    /**
	     * company_info_callback function.
	     * 
	     * @access public
	     * @return void
	     */
	    public function company_info_callback() {
		    	    	
		    $company_fields = wol()->company_info->company_fields();
		      
		    $wolkey = ( ! empty( $this->wol_company_info_options ) ) ?
		    	'old' :
		    	'wolnew';
			
			if ( 'old' == $wolkey ){
				
				foreach ( $this->wol_company_info_options as $wolkey => $o ){
					
					echo '<ul>';
		   		foreach ( $company_fields as $key => $cf ){
	       		   printf(
	       		    	'<li><input id="' . $key . '" type="text" name="wol-company-info-option[' . $wolkey . '][' . $key . ']" value="%s" /> ' . $cf['label'] . '</li>',
		   		   		isset( $this->wol_company_info_options[$wolkey][$key] ) ? esc_attr( $this->wol_company_info_options[$wolkey][$key]) : ''
		   		   	);
	       		
	       		}

			} 
			
			} else {
			
			
		   		echo '<ul>';
		   		foreach ( $company_fields as $key => $cf ){
	       		   printf(
	       		    	'<li><input id="' . $key . '" type="text" name="wol-company-info-option[' . $wolkey . '][' . $key . ']" value="%s" /> ' . $cf['label'] . '</li>',
		   		   		isset( $this->wol_company_info_options[$wolkey][$key] ) ? esc_attr( $this->wol_company_info_options[$wolkey][$key]) : ''
		   		   	);
	       		
	       		}
	        }
	        
	        echo '</ul>';
	        
	        do_action( 'wol_after_company_info_backend' );
	    }

	    /** 
	     * Print the Section text
	     */
	    public function print_pages_section_info() {
	        print __( 'Enter your settings below:', 'wolbusinessdesk' );
	        
	    }
	
	    /** 
	     * Get the settings option array and print one of its values
	     */
	    public function new_support_request_callback() {
		    
			$selected = isset( $this->wol_pages_options['id_new_support_request'] ) ? 
		    		absint( $this->wol_pages_options['id_new_support_request']) : 
		    		0;

			print '<select name="wol-pages-option[id_new_support_request]">';

				print '<option value="0" ' . selected( $selected, 0 ) . '>' . __( 'Chddse a Page', 'wolbusinessdesk' ) . '</option>';

			foreach ( $this->all_pages as $ap ){

				print '<option value="' . $ap->ID . '" ' . selected( $selected, $ap->ID ) . '>' . $ap->post_title . '</option>';
			}
			print '</select>';
	
	    }
	    
	    /** 
	     * Get the settings option array and print one of its values
	     */
	    public function cockpit_callback() {
		    
			$selected = isset( $this->wol_pages_options['id_front_end_admin'] ) ? 
		    		absint( $this->wol_pages_options['id_front_end_admin']) : 
		    		0;

			print '<select name="wol-pages-option[id_front_end_admin]">';

				print '<option value="0" ' . selected( $selected, 0 ) . '>' . __( 'Chddse a Page', 'wolbusinessdesk' ) . '</option>';

			foreach ( $this->all_pages as $ap ){

				print '<option value="' . $ap->ID . '" ' . selected( $selected, $ap->ID ) . '>' . $ap->post_title . '</option>';
			}
			print '</select>';
	
	    }
	    
	     /** 
	     * Print the Section text
	     */
	    public function print_endpoint_front_end_section_info() {
	        print __( 'Enter your slugs below:', 'wolbusinessdesk' );
	    }
	    
	    /** 
	     * Get the settings option array and print one of its values
	     */
	    public function endpoint_slug_callback() {
		    
		    $saved_endpoints = ( isset( $this->wol_pages_options['front_end_admin_end_point'] ) && $this->wol_pages_options['front_end_admin_end_point'] ) ?
		    	$this->wol_pages_options['front_end_admin_end_point'] :
		    	array();
		    
		    $endpoints_array = array();
			
			foreach ( $this->endpoints as $key => $se ){
				
				$endpoints_array[$key] = $se['endpoint'];
			}	
		    $new_endpoint = array_merge( $endpoints_array, $saved_endpoints );
		   
		    echo '<ul>';
		    foreach ( $new_endpoint as $key => $ep ){
	        	printf(
	            	'<li><input type="text" id="' . $key . '" name="wol-pages-option[front_end_admin_end_point][' . $key . ']" value="%s" /> %s</li>',
					isset( $new_endpoint[$key] ) ? esc_attr( $new_endpoint[$key]) : '',
					isset( $this->endpoints[$key]['name'] ) ? esc_attr( $this->endpoints[$key]['name'] ) : ''
				);
	        
	        }
	        
	        echo '</ul>';
	    }

	
	    /** 
	     * Print the Section text
	     */
	    public function print_documents_section_info()
	    {
	        print 'Enter your settings below:';
	    }
	
	    /** 
	     * Get the settings option array and print one of its values
	     */
	    public function id_documents_number_callback()
	    {
	        printf(
	            '<input type="text" id="id_number" name="wol-documents-option[id_number]" value="%s" />',
	            isset( $this->wol_document_options['id_number'] ) ? esc_attr( $this->wol_document_options['id_number']) : ''
	        );
	    }
	
	    /** 
	     * Get the settings option array and print one of its values
	     */
	    public function title_documents_callback()
	    {
	        printf(
	            '<input type="text" id="title" name="wol-documents-option[title]" value="%s" />',
	            isset( $this->wol_document_options['title'] ) ? esc_attr( $this->wol_document_options['title']) : ''
	        );
	    }
	    
	    /**
	     * doc_opening_status_callback function.
	     * 
	     * @access public
	     * @return void
	     */
	    public function doc_opening_status_callback(){

	    // no default values. using these as examples
		$taxonomies = array(
						'wol-document-status',
						);

		$args = array(
		    'orderby'           => 'name',
		    'order'             => 'ASC',
		    'hide_empty'        => false,

		);

		$status = get_terms( $taxonomies, $args );

		if ( ! empty( $status ) ){
			print '<select name="wol-documents-option[doc_opening_status]">';

			print '<option value="0" ' . selected( $this->wol_document_options['doc_opening_status'], -1 ) . '>' . __( 'Select Document opened Status', 'wolbusinessdesk' ) . '</option>';



			foreach ( $status as $st ){



				print '<option value="' . $st->term_id . '" ' . selected( $this->wol_document_options['doc_opening_status'], $st->term_id ) . '>' . $st->name . '</option>';
			}
			print '</select>';
			}
    }
	
    /**
     * doc_approve_status_callback function.
     * 
     * @access public
     * @return void
     */
    public function doc_approve_status_callback(){

	    // no default values. using these as examples
		$taxonomies = array(
						'wol-document-status',
						);

		$args = array(
		    'orderby'           => 'name',
		    'order'             => 'ASC',
		    'hide_empty'        => false,

		);

		$status = get_terms($taxonomies, $args);

		if ( ! empty( $status ) ){
			print '<select name="wol-documents-option[doc_approve_status]">';

			print '<option value="0" ' . selected( $this->wol_document_options['doc_approve_status'], -1 ) . '>' . __( 'Select Document approved Status', 'wolbusinessdesk' ) . '</option>';



			foreach ( $status as $st ){



				print '<option value="' . $st->term_id . '" ' . selected( $this->wol_document_options['doc_approve_status'], $st->term_id ) . '>' . $st->name . '</option>';
			}
			print '</select>';
			}
    }
    
    /**
     * doc_reject_status_callback function.
     * 
     * @access public
     * @return void
     */
    public function doc_reject_status_callback(){

	    // no default values. using these as examples
		$taxonomies = array(
						'wol-document-status',
						);

		$args = array(
		    'orderby'           => 'name',
		    'order'             => 'ASC',
		    'hide_empty'        => false,

		);

		$status = get_terms($taxonomies, $args);

		if ( ! empty( $status ) ){
			print '<select name="wol-documents-option[doc_reject_status]">';

			print '<option value="0" ' . selected( $this->wol_document_options['doc_reject_status'], -1 ) . '>' . __( 'Select Document rejected Status', 'wolbusinessdesk' ) . '</option>';



			foreach ( $status as $st ){



				print '<option value="' . $st->term_id . '" ' . selected( $this->wol_document_options['doc_reject_status'], $st->term_id ) . '>' . $st->name . '</option>';
			}
			print '</select>';
			}
    }

    /**
     * print_section_opening_closing_status function.
     *
	 * @package Wolbusinessdesk
	 *
	 * @since version 1.0
	 *
     *
     * @access public
     * @return void
     */
    public function print_section_opening_closing_status(){

        print _e( 'Opening and Closing Status Settings:', 'wolbusinessdesk' );
    }
	
	/**
	 * print_section_standard_reply_time function.
	 * 
	 * @access public
	 * @return void
	 */
	public function print_section_standard_reply_time(){
		
		print _e( 'Set standard time reply in hours:', 'wolbusinessdesk' );
	}

    /**
     * print_section_standard_listing function.
     *
	 * @package Wolbusinessdesk
	 *
	 * @since version 1.0
	 *
     *
     * @access public
     * @return void
     */
    public function print_section_standard_listing(){

        print _e( 'Set standard Settings for Tickets listing: ', 'wolbusinessdesk' );
    }


    /**
     * print_section_layout function.
     *
	 * @package Wolbusinessdesk
	 *
	 * @since version 1.0
	 *
     *
     * @access public
     * @return void
     */
    public function print_section_layout(){

        print _e( 'Layout options:', 'wolbusinessdesk' );
    }

    /**
     * opening_status_callback function.
     *
	 * @package Wolbusinessdesk
	 *
	 * @since version 1.0
	 *
     *
     * @access public
     * @return void
     */
    public function opening_status_callback(){

	    // no default values. using these as examples
		$taxonomies = array(
						'wol-ticket-status',
						);

		$args = array(
		    'orderby'           => 'name',
		    'order'             => 'ASC',
		    'hide_empty'        => false,

		);

		$status = get_terms( $taxonomies, $args );

		if ( ! empty( $status ) ){
			print '<select name="wol-support-option[opening_status]">';

			print '<option value="0" ' . selected( $this->wol_support_options['opening_status'], -1 ) . '>' . __( 'Select tickets opened Status', 'wolbusinessdesk' ) . '</option>';



			foreach ( $status as $st ){



				print '<option value="' . $st->term_id . '" ' . selected( $this->wol_support_options['opening_status'], $st->term_id ) . '>' . $st->name . '</option>';
			}
			print '</select>';
			}
    }

    /**
     * closing_status_callback function.
     *
	 * @package Wolbusinessdesk
	 *
	 * @since version 1.0
	 *
     *
     * @access public
     * @return void
     */
    public function closing_status_callback(){

	    // no default values. using these as examples
		$taxonomies = array(
						'wol-ticket-status',
						);

		$args = array(
		    'orderby'           => 'name',
		    'order'             => 'ASC',
		    'hide_empty'        => false,

		);

		$status = get_terms($taxonomies, $args);

		if ( ! empty( $status ) ){
			print '<select name="wol-support-option[status]">';

			print '<option value="0" ' . selected( $this->wol_support_options['status'], -1 ) . '>' . __( 'Select tickets closed Status', 'wolbusinessdesk' ) . '</option>';



			foreach ( $status as $st ){



				print '<option value="' . $st->term_id . '" ' . selected( $this->wol_support_options['status'], $st->term_id ) . '>' . $st->name . '</option>';
			}
			print '</select>';
			}
    }

	public function standard_time_reply_callback(){
		
		printf(
            '<input type="number" id="standard_reply_time" name="wol-support-option[standard_reply_time]" value="%s" />',
            isset( $this->wol_support_options['standard_reply_time'] ) ? esc_attr( $this->wol_support_options['standard_reply_time']) : ''
        );
	}
    /**
     * listing_type_callback function.
     *
	 * @package Wolbusinessdesk
	 *
	 * @since version 1.0
	 *
     *
     * @access public
     * @return void
     */
    public function listing_type_callback(){

	    // no default values. using these as examples
		$taxonomies = array(
						'wol-ticket-type',
						);

		$args = array(
		    'orderby'           => 'name',
		    'order'             => 'ASC',
		    'hide_empty'        => false,

		);

		$status = get_terms($taxonomies, $args);

		if ( ! empty( $status ) ){
			print '<select name="wol-support-option[listing-type]">';

			print '<option value="0" ' . selected( $this->wol_support_options['listing-type'], 0 ) . '>' . __( 'All Types', 'wolbusinessdesk' ) . '</option>';



			foreach ( $status as $st ){



				print '<option value="' . $st->term_id . '" ' . selected( $this->wol_support_options['listing-type'], $st->term_id ) . '>' . $st->name . '</option>';
			}
			print '</select>';
			}
    }

    /**
     * listing_priority_callback function.
     *
	 * @package Wolbusinessdesk
	 *
	 * @since version 1.0
	 *
     *
     * @access public
     * @return void
     */
    public function listing_priority_callback(){

	    $taxonomies = array(
						'wol-ticket-priority',
						);

		$args = array(
		    'orderby'           => 'name',
		    'order'             => 'ASC',
		    'hide_empty'        => false,

		);

		$status = get_terms($taxonomies, $args);

		if ( ! empty( $status ) ){
			print '<select name="wol-support-option[listing-priority]">';

			print '<option value="0" ' . selected( $this->wol_support_options['listing-priority'], 0 ) . '>' . __( 'All Priority', 'wolbusinessdesk' ) . '</option>';



			foreach ( $status as $st ){



				print '<option value="' . $st->term_id . '" ' . selected( $this->wol_support_options['listing-priority'], $st->term_id ) . '>' . $st->name . '</option>';
			}
			print '</select>';
		}
    }

    /**
     * listing_status_callback function.
     *
	 * @package Wolbusinessdesk
	 *
	 * @since version 1.0
	 *
     *
     * @access public
     * @return void
     */
    public function listing_status_callback(){

		$status = $this->get_all_status_terms();

		if ( ! empty( $status ) ){

            if( isset( $this->wol_support_options['listing-status-operator'] ) ) 
            		$listing_status_operator = $this->wol_support_options['listing-status-operator'];
            else 
            		$listing_status_operator = 0;
					
			// [listing-status-operator]
			printf( 
                '<ul>
                    <li>
                        <input type="radio"  name="wol-support-option[listing-status-operator]" value="1"  class="lcs_check lcs_tt2"  autocomplete="off" %1$s /> %2$s
                        
                    </li>
                    <li>
                        <input type="radio"  name="wol-support-option[listing-status-operator]" value="0"  class="lcs_check lcs_tt2"  autocomplete="off" %3$s /> %4$s
                    </li>
                </ul>',
                checked( $listing_status_operator, 1, false ),
                __( 'Is Not', 'wolbusinessdesk' ),
                checked( $listing_status_operator, 0, false ),
                __( 'Is', 'wolbusinessdesk' )
                
            );
			
                            
			print '<select name="wol-support-option[listing-status]">';

			print '<option value="0" ' . selected( $this->wol_support_options['listing-status'], 0 ) . '>' . __( 'All Status', 'wolbusinessdesk' ) . '</option>';



			foreach ( $status as $st ){

				print '<option value="' . $st->term_id . '" ' . selected( $this->wol_support_options['listing-status'], $st->term_id ) . '>' . $st->name . '</option>';
			}
			print '</select>';
		}
    }

	/**
	 * listing_tickets_per_page_callback function.
	 *
	 * @package Wolbusinessdesk
	 *
	 * @since version 1.0
	 *
	 *
	 * @access public
	 * @return void
	 */
	public function listing_tickets_per_page_callback(){

	    printf(
            '<input type="number" id="listing-tickets-per-page" name="wol-support-option[listing-tickets-per-page]" value="%s" />',
            isset( $this->wol_support_options['listing-tickets-per-page'] ) ? absint( $this->wol_support_options['listing-tickets-per-page']) : ''
        );

    }

    /**
     * listing_ticket_replies_per_page_callback function.
     *
	 * @package Wolbusinessdesk
	 *
	 * @since version 1.0
	 *
     *
     * @access public
     * @return void
     */
    public function listing_ticket_replies_per_page_callback(){

	    printf(
            '<input type="number" id="listing-ticket-per-page" name="wol-support-option[listing-ticket-replies-per-page]" value="%s" />',
            isset( $this->wol_support_options['listing-ticket-replies-per-page'] ) ? esc_attr( $this->wol_support_options['listing-ticket-replies-per-page']) : ''
        );

    }


    public function sorting_ticket_replies_callback(){
	    
	    $checked = ( isset( $this->wol_support_options['sorting'] ) && ! empty( $this->wol_support_options['sorting'] ) ) ?
	    	$this->wol_support_options['sorting']:
	    	'ASC';

	    print '<ul>
	    		<li><input type="radio" name="wol-support-option[sorting]" value="ASC" ' . checked( $checked, "ASC", false ) . '/> ' . __( 'Sort ascendind order (First older reply)', 'wolbusinessdesk' ) . '</li>
	    		<li><input type="radio" name="wol-support-option[sorting]" value="DESC" ' . checked( $checked, "DESC", false ) . '/> ' . __( 'Sort descending order (First newer reply)', 'wolbusinessdesk' ) . '</li>
				</ul>';

    }
    
    
    
    /**
     * crm_opening_status_callback function.
     * 
     * @package Wolbusinessdesk
     * @since 1-0
     * @access public
     * @return echo
     */
    public function crm_opening_status_callback(){

	    // no default values. using these as examples
		$taxonomies = array(
						'wol-crm-status',
						);

		$args = array(
		    'orderby'           => 'name',
		    'order'             => 'ASC',
		    'hide_empty'        => false,

		);

		$status = get_terms( $taxonomies, $args );

		if ( ! empty( $status ) ){
			print '<select name="wol-crm-option[crm_opening_status]">';

			print '<option value="0" ' . selected( $this->wol_crm_options['crm_opening_status'], -1 ) . '>' . __( 'Select Document opened Status', 'wolbusinessdesk' ) . '</option>';



			foreach ( $status as $st ){



				print '<option value="' . $st->term_id . '" ' . selected( $this->wol_crm_options['crm_opening_status'], $st->term_id ) . '>' . $st->name . '</option>';
			}
			print '</select>';
			}
    }

    /**
     * closing_status_callback function.
     *
	 * @package Wolbusinessdesk
	 *
	 * @since version 1.0
	 *
     *
     * @access public
     * @return void
     */
    public function crm_closing_status_callback(){

	    // no default values. using these as examples
		$taxonomies = array(
						'wol-crm-status',
						);

		$args = array(
		    'orderby'           => 'name',
		    'order'             => 'ASC',
		    'hide_empty'        => false,

		);

		$status = get_terms($taxonomies, $args);

		if ( ! empty( $status ) ){
			print '<select name="wol-crm-option[crm_status]">';

			print '<option value="0" ' . selected( $this->wol_crm_options['crm_status'], -1 ) . '>' . __( 'Select Document closed Status', 'wolbusinessdesk' ) . '</option>';



			foreach ( $status as $st ){



				print '<option value="' . $st->term_id . '" ' . selected( $this->wol_crm_options['crm_status'], $st->term_id ) . '>' . $st->name . '</option>';
			}
			print '</select>';
			}
    }
    
    	
	// ! TODO STD SORTING crm_sorting_task_replies_callback
	
	public function print_section_crm_standard_listing(){
		
		// ! TODO DEBUG DA RIMUOVERE
		echo '<pre>' . print_r( $this->wol_crm_options , 1 ) . '</pre>';

        print _e( 'Set standard Settings for CTRM tasks listing: ', 'wolbusinessdesk' );
    }
	
	 public function crm_listing_type_callback(){

	    // no default values. using these as examples
		$taxonomies = array(
						'wol-crm-type',
						);

		$args = array(
		    'orderby'           => 'name',
		    'order'             => 'ASC',
		    'hide_empty'        => false,

		);

		$type = get_terms( $taxonomies, $args );

		if ( ! empty( $type ) ){
			print '<select name="wol-crm-option[crm_std_listing_type]">';

			print '<option value="0" ' . selected( $this->wol_crm_options['crm_std_listing_type'], 0 ) . '>' . __( 'All types', 'wolbusinessdesk' ) . '</option>';



			foreach ( $type as $st ){



				print '<option value="' . $st->term_id . '" ' . selected( $this->wol_crm_options['crm_std_listing_type'], $st->term_id ) . '>' . $st->name . '</option>';
			}
			print '</select>';
			}
    }
    
    public function crm_listing_action_callback(){

	    // no default values. using these as examples
		$taxonomies = array(
						'wol-crm-action',
						);

		$args = array(
		    'orderby'           => 'name',
		    'order'             => 'ASC',
		    'hide_empty'        => false,

		);

		$actions = get_terms( $taxonomies, $args );

		if ( ! empty( $actions ) ){
			print '<select name="wol-crm-option[crm_std_listing_action]">';

			print '<option value="0" ' . selected( $this->wol_crm_options['crm_std_listing_action'], 0 ) . '>' . __( 'All actions', 'wolbusinessdesk' ) . '</option>';



			foreach ( $actions as $st ){



				print '<option value="' . $st->term_id . '" ' . selected( $this->wol_crm_options['crm_std_listing_action'], $st->term_id ) . '>' . $st->name . '</option>';
			}
			print '</select>';
			}
    }

	public function crm_listing_status_callback(){

		$taxonomies = array(
						'wol-crm-status',
						);

		$args = array(
		    'orderby'           => 'name',
		    'order'             => 'ASC',
		    'hide_empty'        => false,

		);

		$status = get_terms( $taxonomies, $args );

		if ( ! empty( $status ) ){

            if( isset( $this->wol_crm_options['crm_listing_status_operator'] ) ) 
            		$listing_status_operator = $this->wol_crm_options['crm_listing_status_operator'];
            else 
            		$listing_status_operator = 0;
					
			// [listing-status-operator]
			printf( 
                '<ul>
                    <li>
                        <input type="radio"  name="wol-crm-option[crm_listing_status_operator]" value="1"  class="lcs_check lcs_tt2"  autocomplete="off" %1$s /> %2$s
                        
                    </li>
                    <li>
                        <input type="radio"  name="wol-crm-option[crm_listing_status_operator]" value="0"  class="lcs_check lcs_tt2"  autocomplete="off" %3$s /> %4$s
                    </li>
                </ul>',
                checked( $listing_status_operator, 1, false ),
                __( 'Is Not', 'wolbusinessdesk' ),
                checked( $listing_status_operator, 0, false ),
                __( 'Is', 'wolbusinessdesk' )
                
            );
			
                            
			print '<select name="wol-crm-option[crm_listing_status]">';

			print '<option value="0" ' . selected( $this->wol_crm_options['crm_listing_status'], 0 ) . '>' . __( 'All Status', 'wolbusinessdesk' ) . '</option>';



			foreach ( $status as $st ){

				print '<option value="' . $st->term_id . '" ' . selected( $this->wol_crm_options['crm_listing_status'], $st->term_id ) . '>' . $st->name . '</option>';
			}
			print '</select>';
		}
    }

	public function crm_listing_cpt_callback(){
		
		$all_cpts = wol_get_crm_allowed_cpt();
				
		if ( 
			! empty( $all_cpts )
			&& is_array( $all_cpts ) 
			){
			
			foreach ( $all_cpts as $key => $cpt ){
				
				$checked_cpt = ( isset( $this->wol_crm_options['crm_listing_cpt'][$key] ) ) ?
					$this->wol_crm_options['crm_listing_cpt'][$key]:
					'';
					
				printf( 
                	'<input type="checkbox" name="wol-crm-option[crm_listing_cpt][%1$s]" value="%1$s"  class="lcs_check lcs_tt2"  autocomplete="off" %2$s /> %3$s ',
					$key,
					checked( $checked_cpt, $key, false ),
					$cpt                
				);
				
			}
		}
		
		
	}
	
	public function crm_listing_task_per_page_callback(){

	    printf(
            '<input type="number" id="listing-task-per-page" name="wol-crm-option[crm_listing_task_per_page]" value="%s" />',
            isset( $this->wol_crm_options['crm_listing_task_per_page'] ) ? absint( $this->wol_crm_options['crm_listing_task_per_page']) : ''
        );

    }
    
    public function crm_listing_tasks_replies_per_page_callback(){

	    printf(
            '<input type="number" id="listing-task-replies-per-page" name="wol-crm-option[crm_listing_task_replies_per_page]" value="%s" />',
            isset( $this->wol_crm_options['crm_listing_task_replies_per_page'] ) ? absint( $this->wol_crm_options['crm_listing_task_replies_per_page']) : ''
        );

    }
	
	
    private function get_all_pages(){
	    
	    $args = array(
			'sort_order' 	=> 'asc',
			'sort_column' 	=> 'post_title',
			'number'		=> '',
			'post_type' 	=> 'page',
			'post_status' 	=> 'publish'
		); 
		
		$pages = get_pages( $args ); 
		
		return $pages;
	    
	    
    }


	/**
	 * get_all_status_terms function.
	 *
	 * @package Wolbusinessdesk
	 *
	 * @since version 1.0
	 *
	 *
	 * @access private
	 * @return void
	 */
	private function get_all_status_terms(){

		// no default values. using these as examples
		$taxonomies = array(
						'wol-ticket-status',
						);

		$args = array(
		    'orderby'           => 'name',
		    'order'             => 'ASC',
		    'hide_empty'        => false,

		);

		$status = get_terms($taxonomies, $args);

		return $status;

	}

		
	}
	
	

<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'Wolbusinessdesk_Crm_Meta' ) ){
	
	
	/**
	 * Wolly_Plugin_Support_Meta class.
	 */
	class Wolbusinessdesk_Crm_Meta {
		
		/**
		 * id_task
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $id_task 			= '';
		
		/**
		 * task_user
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $task_user			= '';
		
		/**
		 * options
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $options 			= '';
		
		/**
		 * priority
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $priority 			= '';
		
		/**
		 * status
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $status 				= '';
		
		/**
		 * type
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $type 				= '';
		
		/**
		 * priority_selected
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $priority_selected 	= '';
		
		/**
		 * status_selected
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $status_selected 		= '';
		
		/**
		 * type_selected
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $type_selected 		= '';
			
		/**
		 * owner_assigned
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var $owner_assigned 		= '';
		
		var $can_own_ticket		= '';
		
		var $ticket_replies_data = '';
	
			
		/**
		 * __construct function.
		 * 
		 * @access public
		 * @param mixed $ticket_id (default: null)
		 * @param mixed $id_user (default: null)
		 * @return void
		 */
		public function __construct() {			
			
			
			$this->task_user 			= get_current_user_id(  );
			$this->options 				= get_option( WOLBUSINESSDESK_CRM_OPTION_NAME );
			// ! TODO DEBUG DA RIMUOVERE
			//echo '<pre>' . print_r( $this->options , 1 ) . '</pre>';
			$this->can_own_ticket 		= $this->can_own_ticket();
			$this->ticket_replies_data	= $this->get_task_replies_data();
						
		}
		
		public function get_priority(){
			
			$this->id_task = get_the_id();
			$this->get_type_priority_status();
			
			if ( ! is_post_type_archive( 'wol-crm' ) ){
			
				if ( TRUE == $this->can_own_ticket ){
					
					/**
					 * priority_render
					 * 
					 * (default value: wp_dropdown_categories( $this->priority_args() ))
					 * 
					 * @var mixed
					 * @access public
					 */
					$priority_render 	= wp_dropdown_categories( $this->priority_args() );
					
					} else {
						
						$priority_render = ( $this->priority ) ? 
							$this->priority[0]->name . '<input type="hidden" name="priority" id="priority" value="' . $this->priority_selected . '" />':
							'';
				
					}
					
					$html = '<strong>' . __('Current priority:','wolbusinessdesk') . '</strong> '
											.  $priority_render;
				} else {
					
					$priority_name = ( $this->priority ) ? 
							$this->priority[0]->name :
							'';
				
					$html =  $priority_name;
							
					
			}
										
			return $html;
			
			
		}
		
		public function get_status_name(){
			
			
			$this->id_task = get_the_id();
			$this->get_type_priority_status();
			
			if ( ! is_post_type_archive( 'wol-crm' ) ){
			
				if ( TRUE == $this->can_own_ticket ){
					
					/**
					 * priority_render
					 * 
					 * (default value: wp_dropdown_categories( $this->priority_args() ))
					 * 
					 * @var mixed
					 * @access public
					 */
					$status_render 	= wp_dropdown_categories( $this->status_args() );
					
					} else {
						
						$status_render = ( $this->status ) ? 
							$this->status[0]->name . '<input type="hidden" name="status" id="status" value="' . $this->status_selected . '" />':
							'';
				
					}
					
					$html = '<strong>' . __('Current status:','wolbusinessdesk') . '</strong> '
											.  $status_render;
				} else {
				
				
					if ( $this->status ){
						
						$status_color = ( get_term_meta( $this->status[0]->term_id, '_category_color', true ) ) ?
							'#' . get_term_meta( $this->status[0]->term_id, '_category_color', true ) :
							'#ffffff';
					
						$status_name = ( $this->status ) ? 
							$this->status[0]->name :
							'';
							
						} else {
						
							$status_color = '';
							$status_name = '';
					}
					
					$html = $status_name;
				
			}
			
			return $html;
			
			
		}
		
		public function get_status_color(){
			
			
			$this->id_task = get_the_id();
			$this->get_type_priority_status();
			
			if ( ! is_post_type_archive( 'wol-crm' ) ){
			
				if ( TRUE == $this->can_own_ticket ){
					
					/**
					 * priority_render
					 * 
					 * (default value: wp_dropdown_categories( $this->priority_args() ))
					 * 
					 * @var mixed
					 * @access public
					 */
					$status_render 	= wp_dropdown_categories( $this->status_args() );
					
					} else {
						
						$status_render = ( $this->status ) ? 
							$this->status[0]->name . '<input type="hidden" name="status" id="status" value="' . $this->status_selected . '" />':
							'';
				
					}
					
					$html = '<strong>' . __('Current status:','wolbusinessdesk') . '</strong> '
											.  $status_render;
				} else {
				
				
					if ( $this->status ){
						
						$status_color = ( get_term_meta( $this->status[0]->term_id, '_category_color', true ) ) ?
							'#' . get_term_meta( $this->status[0]->term_id, '_category_color', true ) :
							'#ffffff';
					
						$status_name = ( $this->status ) ? 
							$this->status[0]->name :
							'';
							
						} else {
						
							$status_color = '';
							$status_name = '';
					}
					
					$html = $status_color;
				
			}
			
			return $html;
			
			
		}

		
		
		
		public function get_type(){
			
			$this->id_task = get_the_id();
			$this->get_type_priority_status();
			
			if ( ! is_post_type_archive( 'wol-crm' ) ){
			
				if ( TRUE == $this->can_own_ticket ){
					
					/**
					 * priority_render
					 * 
					 * (default value: wp_dropdown_categories( $this->priority_args() ))
					 * 
					 * @var mixed
					 * @access public
					 */
					$type_render 	= wp_dropdown_categories( $this->type_args() );
					
					} else {
						
						$type_render = ( $this->type ) ? 
							$this->type[0]->name . '<input type="hidden" name="type" id="type" value="' . $this->type_selected . '" />':
							'';
				
					}
					
					$html = '<strong>' . __('Current type:','wolbusinessdesk') . '</strong> '
											.  $type_render;
				} else {
					
					$type_name = ( $this->type ) ? 
							$this->type[0]->name :
							'';
				
					$html = $type_name;
				
			}
										
			return $html;
			
			
		}
		
		public function get_owner_list(){
			
			$this->id_task 			= get_the_id();
			
			$this->owner_assigned 	= get_post_meta( $this->id_task, 'ticket_owner', true );
			/**
			 * owner_data
			 * 
			 * (default value: get_userdata( $this->owner_assigned ))
			 * 
			 * @var mixed
			 * @access public
			 */
			$owner_data 				=  get_userdata( $this->owner_assigned );
			
			if ( empty( $owner_data ) ){
	
				$owner_display_name = '';
	
			} else {
	
				$owner_display_name = $owner_data->display_name;
			}
			
			if ( ! is_post_type_archive( 'wol-crm' ) ){
			//$this->can_own_ticket = FALSE;
				if ( TRUE == $this->can_own_ticket ){
					
					/**
					 * priority_render
					 * 
					 * (default value: wp_dropdown_categories( $this->priority_args() ))
					 * 
					 * @var mixed
					 * @access public
					 */
					$owner_list_render 	= $this->owner_list();
					
					} else {
						
						$owner_list_render = $owner_display_name . '<input type="hidden" name="owner_list" id="owner_list" value="' . $this->owner_assigned . '" />';
					}
					
					$html = '<strong>' . __('Owner: ','wolbusinessdesk') . '</strong> '
											.  $owner_list_render;
				} else {
				
				$html = $owner_display_name;
			}
										
			return $html;
			
			
		}
		
		/**
		 * get_task_number function.
		 * 
		 * @since 1.0
		 * @access public
		 * @return void
		 */
		public function get_task_number(){
			
			$this->id_task 	= get_the_id();
			
			$ticket_number 	= get_post_meta( $this->id_task, 'wol_crm_number', true );
			
			return $ticket_number;
		}
		/**
		 * show_ticket_data function.
		 * 
		 * @access public
		 * @return void
		 */
		public function show_ticket_data(){
			
			$this->id_task 		= get_the_id();			
			/**
			 * render_ticket_data
			 * 
			 * (default value: '')
			 * 
			 * @var string
			 * @access public
			 */
			$render_ticket_data 	= '';
			
			/**
			 * can_own_ticket
			 * 
			 * (default value: '')
			 * 
			 * @var string
			 * @access public
			 */
			$can_own_ticket 		= '';
			$owner_list 			= $this->owner_list();
			
			$this->owner_assigned 	= get_post_meta( $this->id_task, 'ticket_owner', true );
						
			/**
			 * owner_data
			 * 
			 * (default value: get_userdata( $this->owner_assigned ))
			 * 
			 * @var mixed
			 * @access public
			 */
			$owner_data 				=  get_userdata( $this->owner_assigned );
			
			if ( empty( $owner_data ) ){
	
				$owner_display_name = __( 'Owner not yet assigned', 'wolbusinessdesk');
	
			} else {
	
				$owner_display_name = $owner_data->display_name;
			}
	
	
			if ( null != $this->task_user ){
	
				$can_own_ticket = ( user_can( $this->task_user , 'wol_can_own_ticket'  ) ) ?
					TRUE:
					FALSE;
				
				$can_own_ticket = apply_filters( 'wol_can_own_ticket', $can_own_ticket );
	
			}
	
			
	
			$this->get_type_priority_status();
					
			if ( TRUE == $can_own_ticket ){
				
				/**
				 * priority_render
				 * 
				 * (default value: wp_dropdown_categories( $this->priority_args() ))
				 * 
				 * @var mixed
				 * @access public
				 */
				$priority_render 	= wp_dropdown_categories( $this->priority_args() );
				
				/**
				 * status_render
				 * 
				 * (default value: wp_dropdown_categories( $this->status_args() ))
				 * 
				 * @var mixed
				 * @access public
				 */
				$status_render		= wp_dropdown_categories( $this->status_args() );
				
				/**
				 * type_render
				 * 
				 * (default value: wp_dropdown_categories( $this->type_args() ))
				 * 
				 * @var mixed
				 * @access public
				 */
				$type_render 		= wp_dropdown_categories( $this->type_args() );
				
				/**
				 * ticket_owner_list
				 * 
				 * (default value: $this->owner_list())
				 * 
				 * @var mixed
				 * @access public
				 */
				$ticket_owner_list 	= ( user_can( $this->task_user, 'wol_can_assign_owner' ) ) ?
					$this->owner_list() :
					$owner_display_name;
	
				} else {
					
					/**
					 * priority_render
					 * 
					 * (default value: $this->priority[0]->name . '<input type="hidden" name="priority" id="priority" value="' . $this->priority_selected . '" />')
					 * 
					 * @var string
					 * @access public
					 */
					$priority_render = ( $this->priority ) ? 
						$this->priority[0]->name . '<input type="hidden" name="priority" id="priority" value="' . $this->priority_selected . '" />':
						'';
					
					/**
					 * status_render
					 * 
					 * (default value: $this->status[0]->name . '<input type="hidden" name="status" id="status" value="' . $this->status_selected . '" />')
					 * 
					 * @var string
					 * @access public
					 */
					$status_render = ( $this->status ) ? 
						$this->status[0]->name . '<input type="hidden" name="status" id="status" value="' . $this->status_selected . '" />' :
						'';
					
					/**
					 * type_render
					 * 
					 * (default value: $this->type[0]->name . '<input type="hidden" name="type" id="type" value="' . $this->type_selected . '" />')
					 * 
					 * @var string
					 * @access public
					 */
					$type_render = ( $this->type ) ? 
						$this->type[0]->name . '<input type="hidden" name="type" id="type" value="' . $this->type_selected . '" />' : 
						'';
					
					/**
					 * ticket_owner_list
					 * 
					 * (default value: $owner_display_name . '<input type="hidden" name="owner_list" id="owner_list" value="' . $this->owner_assigned . '" />')
					 * 
					 * @var string
					 * @access public
					 */
					$ticket_owner_list = $owner_display_name . '<input type="hidden" name="owner_list" id="owner_list" value="' . $this->owner_assigned . '" />';
			}
	
	
	
			$render_ticket_data .= '<div class="riga">
									<div class="colonna-1-3">
										<strong>' . __('Current priority:','wolbusinessdesk') . '</strong> '
										.  $priority_render . '
									</div>
									<div class="colonna-1-3"><strong>' . __('Current status:','wolbusinessdesk') . '</strong> '
										. $status_render .
									'</div>
									<div class="colonna-1-3"><strong>' . __('Ticket type:','wolbusinessdesk') . '</strong> '
										. $type_render .
									'</div>
								  </div><!-- end riga -->
	
								  <div class="riga">
								  	<div class="colonna-1-3">
								  		<strong>' . __('Ticket owner:','wolbusinessdesk') . '</strong> '
								  			. $ticket_owner_list .
								  	'</div>
								  	<div class="colonna-1-3">
								  	</div>
								  	<div class="colonna-1-3">
								  	</div>
								  </div><!-- end riga -->';
	
			return $render_ticket_data;
	
		}
	
		public function get_type_priority_status(){
			
	
			$this->priority 	= ( ! is_wp_error( get_the_terms( $this->id_task, 'wol-crm-priority' ) ) ) ?
				get_the_terms( $this->id_task, 'wol-crm-priority' ) :
				FALSE ;
	
			$this->status 	= ( ! is_wp_error( get_the_terms( $this->id_task, 'wol-crm-status' ) ) ) ?
				get_the_terms( $this->id_task, 'wol-crm-status' ) :
				FALSE ;
	
			$this->type 		= ( ! is_wp_error( get_the_terms( $this->id_task, 'wol-crm-type' ) ) ) ?
				get_the_terms( $this->id_task, 'wol-crm-type' ) :
				FALSE ;
	
			$this->priority_selected 	= ( $this->priority ) ?
				 (int)$this->priority[0]->term_id :
				 '';
			$this->status_selected 	= ( $this->status ) ?
				(int)$this->status[0]->term_id :
				'';
			$this->type_selected 		= ( $this->type ) ? 
				(int)$this->type[0]->term_id :
				'';
	
	
	
		}
		
		public function archive_support_nonce(){
			
			$nonce = wp_nonce_field( 'wol_list_support_nonce_field', 'wol_list_support_nonce_name', true, false );
			
			return $nonce;
		}
		
		public function get_status_dropdown(){
			
			if (  isset( $_POST['wol_list_support_nonce_name'] ) &&  wp_verify_nonce( $_POST['wol_list_support_nonce_name'], 'wol_list_support_nonce_field' ) ) {
				
				$this->status_selected = ( isset( $_POST['status'] ) && is_numeric( $_POST['status'] ) ) ?
					(int)$_POST['status'] :
					$this->options['listing-status'];
				
				
				} else {
					
					$this->status_selected = $this->options['listing-status'];
					
				}
						
			
			
			$status_dropdown = wp_dropdown_categories( $this->status_args() );
			
			return $status_dropdown;
			
			
		}
		
		public function get_status_operator_dropdown(){
			
			if (  isset( $_POST['wol_list_support_nonce_name'] ) &&  wp_verify_nonce( $_POST['wol_list_support_nonce_name'], 'wol_list_support_nonce_field' ) ) {
				
				$status_operator_selected = ( isset( $_POST['status_operator'] ) && is_numeric( $_POST['status_operator'] ) ) ?
					(int)$_POST['status_operator'] :
					$this->options['listing-status-operator'];
				
				
				} else {
					
					$status_operator_selected = $this->options['listing-status-operator'];
					
				}
			
			
			$status_operator_dropdown = '<select name="status_operator" id="status_operator" class="form-control">
				<option value="0" ' . selected( (int)$status_operator_selected, 0, false ) . '>' . __( 'Is', 'wolly-plugin' ) . '</option>
				<option value="1" ' . selected( (int)$status_operator_selected, 1, false ) . '>' . __( 'Is NOT', 'wolly-plugin' ) . '</option>
			</select>';
			
			return $status_operator_dropdown;
			
			
		}
		
		public function get_priority_dropdown( $all = '' ){
			
			if (  isset( $_POST['wol_list_support_nonce_name'] ) &&  wp_verify_nonce( $_POST['wol_list_support_nonce_name'], 'wol_list_support_nonce_field' ) ) {
				
				$this->priority_selected = ( isset( $_POST['priority'] ) && is_numeric( $_POST['priority'] ) ) ?
					(int)$_POST['priority'] :
					$this->options['listing-priority'];
				
				
				} else {
					
					$this->priority_selected = $this->options['listing-priority'];
					
				}
			
			$priority_dropdown = wp_dropdown_categories( $this->priority_args( $all ) );
			
			return $priority_dropdown;
			
			
		}
		
		public function get_type_dropdown( $all = '' ){
			
			if (  isset( $_POST['wol_list_support_nonce_name'] ) &&  wp_verify_nonce( $_POST['wol_list_support_nonce_name'], 'wol_list_support_nonce_field' ) ) {
				
				$this->type_selected = ( isset( $_POST['type'] ) && is_numeric( $_POST['type'] ) ) ?
					(int)$_POST['type'] :
					$this->options['listing-type'];
				
				
				} else {
					
					$this->type_selected = $this->options['listing-type'];
					
				}
						
			$type_dropdown = wp_dropdown_categories( $this->type_args( $all ) );
			
			return $type_dropdown;
			
			
		}
		/**
		 * status_args function.
		 *
		 * @access public
		 * @param mixed $selected (default: null)
		 * @return $args
		 */
		public function status_args(){
	
			$args = array(
				'show_option_all'    => '',
				'hide_empty'         => 0,
				'echo'               => 0,
				'selected'           => $this->status_selected,
				'name'               => 'status',
				'class'              => 'ticket-dd form-control',
				'tab_index'          => 30,
				'taxonomy'           => 'wol-crm-status',
				'hide_if_empty'      => false,
				'value_field'	     => 'term_id',
				);
			return $args;
		}
	
	
		/**
		 * priority_args function.
		 *
		 * @access public
		 * @param mixed $selected (default: null)
		 * @return $args
		 */
		public function priority_args( $all = '' ){
			
			$all = ( empty( $all ) ) ?
				'':
				$all;
				
			$args = array(
				'show_option_all'    => $all,
				'hide_empty'         => 0,
				'echo'               => 0,
				'selected'           => $this->priority_selected,
				'name'               => 'priority',
				'class'              => 'ticket-dd form-control',
				'tab_index'          => 20,
				'taxonomy'           => 'wol-crm-priority',
				'hide_if_empty'      => false,
				'value_field'	     => 'term_id',
				);
			return $args;
		}
	
	
		/**
		 * type_args function.
		 *
		 * @access public
		 * @param mixed $selected (default: null)
		 * @return $args
		 */
		public function type_args( $all = '' ){
			
			$all = ( empty( $all ) ) ?
				'':
				$all;
	
			$args = array(
				'show_option_all'    => $all,
				'hide_empty'         => 0,
				'echo'               => 0,
				'selected'           => $this->type_selected,
				'name'               => 'type',
				'class'              => 'ticket-dd form-control',
				'tab_index'          => 10,
				'taxonomy'           => 'wol-crm-type',
				'hide_if_empty'      => false,
				'value_field'	     => 'term_id',
				);
			return $args;
		}
	
		/**
		 * owner_list function.
		 *
		 * @access public
		 * @param mixed $selected (default: null)
		 * @return $html
		 */
		public function owner_list(){
			
		$args = array(
	
		'role'		  => 'wol_can_own_ticket',
		'orderby'      => 'login',
		'order'        => 'ASC',
		'fields'       => 'all'
		);
		
		/**
		 * owner
		 * 
		 * (default value: get_users( $args ))
		 * 
		 * @var mixed
		 * @access public
		 */
		$owner 	= get_users( $args );
		
		/**
		 * html
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		$html 	='';
		
		$html .= '<select id="owner_list" name="owner_list" class="ticket-dd form-control">
			<option value="-1">' . __( 'Select ticket owner', 'wolbusinessdesk' ) . '</option>';
			
		foreach ( $owner as $ow ){
			
			$html .= '<option value="' . $ow->ID . '" ' . selected( $this->owner_assigned, $ow->ID, false ) . ' class="level-0">' . $ow->display_name . '</option>';
		}
	
		$html .= '</select>';
	
	
		return $html;
		}
	
		
		/**
		 * std_list function.
		 * 
		 * @access public
		 * @return void
		 */
		public function std_list(){
	
			$this->priority_selected 	= (int)$this->options['listing-priority'];
			$this->status_selected 	= (int)$this->options['listing-status'];
			$this->type_selected 		= (int)$this->options['listing-type'];
	
			$all_args = array();
	
			$all_args['type'] 		= $this->type_args();
			$all_args['priority'] 	= $this->priority_args();
			$all_args['status'] 		= $this->status_args();
	
			return $all_args;
	
	
	
		}
		
		private function can_own_ticket(){
			
			if ( null != $this->task_user ){
	
				$can_own_ticket_meta_data = get_user_option( 'wol_can_own_ticket', $this->task_user );
	
				if ( 1 == $can_own_ticket_meta_data ){
	
					$can_own_ticket = TRUE;
	
				} else {
	
					$can_own_ticket = FALSE;
				}
			} else {
				
				$can_own_ticket = FALSE;
			}
			
			return $can_own_ticket;
		}
		
		public function get_task_age(){

			$this->id_task 				= get_the_id();
			$this->ticket_replies_data	= $this->get_task_replies_data();
			$ticket_age 				= $this->ticket_replies_data['last_ticket_reply_age'];

			return $ticket_age;
		
		}
		
		public function get_task_reply_number(){

			$this->id_task 			= get_the_id();
			$this->ticket_replies_data	= $this->get_task_replies_data();
			$ticket_reply_number 		= $this->ticket_replies_data['reply_number'];
			
			$ticket_reply_number 		= ( 0 == $ticket_reply_number ) ?
				0 :
				$ticket_reply_number;

			return $ticket_reply_number;
		
		}
		
		public function get_task_last_reply_author(){

			$this->id_task 			= get_the_id();
			$this->ticket_replies_data	= $this->get_task_replies_data();
			$ticket_reply_number 		= $this->ticket_replies_data['reply_number'];
			
			
			$ticket_last_reply_author = ( 0 == $ticket_reply_number ) ?
				'' :
				$this->ticket_replies_data['last_ticket_reply_author'];

			return $ticket_last_reply_author;
		
		}
		
		public function get_task_last_reply_date(){

			$this->id_task 			= get_the_id();
			$this->ticket_replies_data	= $this->get_task_replies_data();
			$ticket_reply_number 		= $this->ticket_replies_data['reply_number'];
			$last_ticket_reply_date 	= $this->ticket_replies_data['last_ticket_reply_date'];
			$date_format 				=  get_option( 'date_format' );
			
			
			$last_reply_date = ( 0 == $ticket_reply_number ) ? 
				__( 'No reply, yet', 'wolly-plugin-support' ) :
				date( $date_format, strtotime( $last_ticket_reply_date ) );
				
			return $last_reply_date;
		
		}

		
		public function get_task_replies_data( $ticket_id = 0 ){
			
			if ( 0 == $ticket_id ){
				
				$ticked_id = $this->id_task;
				
				} elseif ( 0 < $ticked_id && is_numeric( $ticked_id ) ){
					
					$ticked_id = absint( $ticked_id );
					
					} else {
						
						$ticked_id = FALSE;
			}
			
			$ticket_reply_data = array();
			
			if ( $ticked_id && is_numeric( $ticked_id ) ){
			
				$args = array(
				'posts_per_page'   => -1,
				'orderby'          => 'date',
				'order'            => 'DESC',
				'post_type'        => 'wol-crm-reply',
				'post_parent'      => absint( $ticked_id ),
				'post_status'      => 'publish',
				'suppress_filters' => true
				);

				$ticket_reply  = get_posts( $args );
												
				$ticket_reply_data['reply_number'] = (int) count( $ticket_reply );

				if ( empty( $ticket_reply ) ){
				
					$ticket_reply_data['last_ticket_reply'] = 0;
				
				} else {
					
					$ticket_reply_data['last_ticket_reply'] = $ticket_reply[0];
				}
								
				if ( is_object( $ticket_reply_data['last_ticket_reply'] ) ){
				
					$get_last_ticket_reply_author_data = get_userdata( $ticket_reply_data['last_ticket_reply']->post_author );
				
					$ticket_reply_data['last_ticket_reply_author'] = $get_last_ticket_reply_author_data->display_name;
				
					} else {
				
						$ticket_reply_data['last_ticket_reply_author'] = __( 'No reply, yet', 'wolly-plugin-support' );
				}
				
				//
				
				
				if ( (int)0 == $ticket_reply_data['reply_number'] ){
				
					$ticket_reply_data['last_ticket_reply_date'] = date( 'Y-m-d  h:i:s', time() );
				
					} else {
				
						$ticket_reply_data['last_ticket_reply_date'] = $ticket_reply[0]->post_date;
				
				}
				
							
			} else {
				
				$ticket_reply_data['comment_number'] = 0;
				$ticket_reply_data['last_ticket_reply'] = FALSE;
				$ticket_reply_data['last_ticket_reply_author'] = __( 'No reply, yet', 'wolly-plugin-support' );
				$ticket_reply_data['last_ticket_reply_date'] = date( 'Y-m-d  h:i:s', time() ) ;
			}
			
			if ( ! is_wol_ticket_open( $ticked_id ) ){
				
					$end_date = $ticket_reply_data['last_ticket_reply_date'];
					

					} else {
					
						$end_date =  date( 'Y-m-d G:i:s', time() );
						

				}

				
				$ticket_date 		= new DateTime( get_post_time( 'Y-m-d G:i:s', true, $ticked_id, false ), new DateTimeZone('Europe/Rome') );
				
				
				$last_reply_date 	= new DateTime( $end_date, new DateTimeZone('Europe/Rome') );
				
				$interval = $ticket_date->diff( $last_reply_date );
																
				$ticket_age = ( $interval->d >= 1 ) ? 
				
					sprintf(
						_n(
						'%s day',
						'%s days',
						$interval->d,
						'wolly-plugin-support'
						),
						$interval->d
					) : 
					
					sprintf(
						_n(
						'%s hour',
						'%s hours',
						$interval->h,
						'wolly-plugin-support'
						),
						$interval->h
					) 
					
					. ' ' .
					
					sprintf(
						_n(
						'%s minute',
						'%s minutes',
						$interval->i,
						'wolly-plugin-support'
						),
						$interval->i
					);
					
					
				$ticket_reply_data['last_ticket_reply_age'] = $ticket_age;
				
				$ticket_reply_data['ticket_date'] = get_post_time( 'Y-m-d  h:i:s', true, $ticked_id, false );
				
				$ticket_reply_data['ticket_ID'] = $ticked_id;
				
			
			
			return $ticket_reply_data;
		}
	
	
	}// chiudo la classe

}


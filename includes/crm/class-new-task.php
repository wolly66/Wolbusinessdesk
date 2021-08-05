<?php
	namespace Wolbusinessdesk\Includes\Crm;
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'New_Task' ) ){
	
	/**
	 * Wolly_Plugin_Support_New_crm class.
	 */
	class New_Task {
		
		/**
		 * options
		 * 
		 * @var mixed
		 * @access private
		 */
		private $options;
		
		/**
		 * form
		 * 
		 * @var mixed
		 * @access public
		 */
		public $form;
			
		/**
		 * __construct function.
		 * 
		 * @access public
		 * @return void
		 */
		public function __construct() {
	
			 $this->options = get_option( WOLBUSINESSDESK_CRM_OPTION_NAME );
		
		}
	
		/**
		 * crm_save_data function.
		 * 
		 * @access private
		 * @return void
		 */
		private function crm_save_data() {
	
			if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['new_crm_task_nonce_name'], 'new_crm_task_nonce_action' ) ){
	
				print 'Sorry, your nonce did not verify.';
				exit;
	
			} else {
				
				$tax_input = array();
				
				if ( isset( $_POST['crm-action'] ) ){
	
				$tax_input['wol-crm-action']  =  array( (int)$_POST['crm-action'] );
	
				}
	
				if ( isset( $_POST['status'] ) ){
					
					$tax_input['wol-crm-status']  =  array( (int)$_POST['status'] );
	
				}
	
				if ( isset( $_POST['type'] ) ){
					
					$tax_input['wol-crm-type']  =  array( (int)$_POST['type'] );
					
				}
			
				$meta_input = array();
				
				if ( 
					isset( $_POST['due_date'] )
					&& ! empty( $_POST['due_date'] )
					){
						
						if ( 
							isset( $_POST['wol_hour'] )
							&& ! empty( $_POST['wol_hour'] )
							&& is_numeric( $_POST['wol_hour'] )
							&& ( 0 <= $_POST['wol_hour']) && ( $_POST['wol_hour'] <= 23) ){
								
							$hour = $_POST['wol_hour'];
							
						} else {
							
							$hour = '00';
						}
						
						if ( 
							isset( $_POST['wol_minutes'] )
							&& ! empty( $_POST['wol_minutes'] )
							&& is_numeric( $_POST['wol_minutes'] )
							&& ( 0 <= $_POST['wol_minutes']) && ( $_POST['wol_minutes'] <= 59) ){
								
							$minutes = $_POST['wol_minutes'];
							
						} else {
							
							$minutes = '00';
						}
						
						$datetime = $_POST['mysql_date'] . " " . $hour . ":" . $minutes . ":00";
						
						$date = new DateTime( $datetime );
						$mysql_date = $date->format('Y-m-d H:i:s');
						$meta_input['wol_due_date'] = $mysql_date;
						
				} else {
					
					$meta_input['wol_due_date'] = $date('Y-m-d H:i:s');
					
				}
				
				$meta_input['wol_crm_number'] 		= wol_get_crm_new_numerator();
				$meta_input['wol_original_type'] 	= $_POST['post-type'];
				
				// Add the content of the form to $post as an array 
				$post = array(
					'post_title' 		=> wp_strip_all_tags( $_POST['wol_title'] ),
					'post_content' 		=> $_POST['wol_description'],
					'post_status' 		=> 'publish',           // Choose: publish, preview, future, etc.
					'post_type' 		=> $_POST['post-type'],  // Use a custom post type if you want to
					'comment_status' 	=> 'closed',
					'ping_status' 		=> 'closed',
					'tax_input'			=> $tax_input,
					'meta_input'		=> $meta_input,
				);
				
				$new_crm_id 	= wp_insert_post( $post );  // http://codex.wordpress.org/Function_Reference/wp_insert_post
				
				$crm_permalink 	= get_the_permalink( $new_crm_id );
				
				$crm_title 		= get_the_title( $new_crm_id );
				
				//inizio invio email
				
				// ! TODO Email logic
				$args = array(
				
						'crm_title' 		=> wp_strip_all_tags( $_POST['wol_title'] ),
						'description' 		=> $_POST['wol_description'],
						'crm_permalink' 	=> $crm_permalink,
						);
				
				// ! TODO 
				//$wol_send_mail = new wol_SendMail( $args, 'new');
				//$wol_send_mail->send_mail();
								
				$location = $crm_permalink;
				
				echo "<meta http-equiv='refresh' content='0;url=$location' />"; exit;
			} // end IF
	
		}
		
		
				
		/**
		 * open_form function.
		 * 
		 * @access public
		 * @return void
		 */
		public function open_form(){
			
			$html = '';
			
			if ( is_wol_can_open_crm() ){
			if ( 
				isset( $_POST['action'] ) 
				&& 'wol-crm' == $_POST['action'] 
				&& wp_verify_nonce( $_POST['new_crm_task_nonce_name'], 'new_crm_task_nonce_action' ) 
				) {
					
					$validation = $this->validate();
					
					if ( ! is_wp_error( $validation ) ){
						
						$this->crm_save_data();
						
					} else {
						
						$html .= '<div class="wol-error-message">';
						
							$html .= '<ul class="wol-ul">';
						
								$html .= '<li>' . implode( '</li><li>', $validation->get_error_messages() ) . '</li>';
								
							$html .= '</ul>';
							
						$html .= '</div>';
					}
				
			} 
			
			$new_form = array(
				'keep_old_values' => TRUE,
				'default_echo'   => FALSE,
				'form_textdomain' => 'wolbusinessdesk',
			);
		
			/**
			 * form
			 * 
			 * (default value: new Wolbusinessdesk_Form_Generator( $new_form ))
			 * 
			 * @var mixed
			 * @access public
			 */
			$this->form = new Wolbusinessdesk_Form_Generator( $new_form );	
			
			/**
			 * open_form
			 * 
			 * @var mixed
			 * @access public
			 */
			$open_form = array(
				'id'      => 'wol-crm',
				'name'    => 'wol-crm',
				'method'  => 'POST',
				'action'  => '',
				'class'   => 'wol-crm',
				'enctype' => 'multipart/form-data',
							
			);
		
		
			/**
			 * html
			 * 
			 * @var mixed
			 * @access public
			 */
			$html .= $this->form->open_form( $open_form );
			
			} else {
				
				if ( ! is_user_logged_in() ){
	
				$html .= '<p>' . __( 'You have to login to open new support request', 'wolbusinessdesk' ) .  '</p>';
	
				$args = array(
				    'echo'           => FALSE,
				    'redirect'       => site_url( $_SERVER['REQUEST_URI'] ),
				    'form_id'        => 'loginform',
				    'label_username' => __( 'Username' ),
				    'label_password' => __( 'Password' ),
				    'label_remember' => __( 'Remember Me' ),
				    'label_log_in'   => __( 'Log In' ),
				    'id_username'    => 'user_login',
				    'id_password'    => 'user_pass',
				    'id_remember'    => 'rememberme',
				    'id_submit'      => 'wp-submit',
				    'remember'       => true,
				    'value_username' => NULL,
				    'value_remember' => false
					);
					
				$html .= wp_login_form( $args );
	
				} else {
			
					$html .= '<p>' . __( 'You do not have sufficient permissione to open new support request', 'wolbusinessdesk' ) . '</p>';
			
			}

			}
			
			return $html;
		
			
		}
		
		
		// task title //
		// task content //
		// task type //
		// task status //
		// task owner
		// task todo (taxonomy) //
		// task due date
		// task notes?
		// task comments?
		
		
				
		public function type(){
			
			/**
			 * type_args
			 * 
			 * @var mixed
			 * @access public
			 */
			$type_args = array(
				'taxonomy'	=> 'wol-crm-type',
				'echo'		=> FALSE,
				'hide_empty'=> 0,
				'name'		=> 'type',
				'class'		=> 'crm-dd form-control',
				'required'	=> TRUE,
				'label'		=> __( 'Type', 'wolbusinessdesk' ),
				'mandatory'	=> '*',
			);
			
			/**
			 * html
			 * 
			 * @var mixed
			 * @access public
			 */
			$html = $this->form->input_dropdown_wp_tax( $type_args );
			
			return $html;

		}
		
		public function action(){
			
			$action_args = array(
				'taxonomy'	=> 'wol-crm-action',
				'echo'		=> FALSE,
				'hide_empty'=> 0,
				'name'		=> 'crm-action',
				'class'		=> 'crm-dd form-control',
				'required'	=> TRUE,
				'label'		=> __( 'Action', 'wolbusinessdesk' ),
				'mandatory'	=> '*',
			);
		
			/**
			 * html
			 * 
			 * @var mixed
			 * @access public
			 */
			$html = $this->form->input_dropdown_wp_tax( $action_args );
			
			return $html;

		}
		
		public function status(){
			
			//check if opening status is set
			$status_new = ( empty( $this->options['opening_status'] ) || -1 == $this->options['opening_status'] ) ?
				'':
				(int)$this->options['opening_status'];
			
			/**
			 * status_priority
			 * 
			 * @var mixed
			 * @access public
			 */
		 	$status_args = array(
				'taxonomy'	=> 'wol-crm-status',
				'echo'		=> FALSE,
				'hide_empty'=> 0,
				'name'		=> 'status',
				'include'	=> $status_new,
				'class'		=> 'crm-dd form-control',
				'required'	=> TRUE,
				'label'		=> __( 'Status', 'wolbusinessdesk' ),
				'mandatory'	=> '*',
			);
		
			/**
			 * html
			 * 
			 * @var mixed
			 * @access public
			 */
			$html = $this->form->input_dropdown_wp_tax( $status_args );
		
			return $html;

		}
		
		/**
		 * title function.
		 * 
		 * @access public
		 * @return void
		 */
		public function title(){
			
			$title_args = array(
				'id'          => 'wol_title',
				'name'        => 'wol_title',
				'label'       => __( 'Task title', 'wolbusinessdesk' ),
				'mandatory'   => '*',
				'placeholder' => __( 'Task title', 'wolbusinessdesk' ),
				'class'       => 'form-control',
				'value'       => '',
			
			);
		
			$html = $this->form->input_text( $title_args );
			
			return $html;
		}
		
		/**
		 * content function.
		 * 
		 * @access public
		 * @return void
		 */
		public function content(){
			
			$crm_content = array(
				'id'          => 'wol_description',
				'name'        => 'wol_description',
				'rows'        => get_option('default_post_edit_rows', 10),
				'cols'        => 50,
				'label'       => __( 'crm Description', 'wolbusinessdesk' ),
				'mandatory'   => '*',
				'placeholder' => '',
				'class'       => 'form-input',
				'value'       => '',
			);
		

			$html = $this->form->input_textarea( $crm_content );
			
			return $html;
		}
		
		public function due_date(){
			
			 
			$base_options = get_option( WOLBUSINESSDESK_BASE_OPTION_NAME );
			
			$date_format = $base_options['std_date_format'];
			
			$due_date_args = array(
				'id'           => 'due_date',
				'name'         => 'due_date',
				'label'        => __( 'Date', 'wolbusinessdesk' ),
				'script_param' => array(
					'dateFormat' => $date_format,
					),
				'alt_field'    => array(
					'id'     => 'mysql_date',
					'name'   => 'mysql_date',
					'value'  => '',
					'format' => 'yy-mm-dd',
					),
				);
			
			$html = $this->form->input_datepicker( $due_date_args );
			
			return $html;
		}
		
		/**
		 * due_hour function.
		 * 
		 * @access public
		 * @return void
		 */
		public function due_hour(){
			// ! TODO get time zone
			$hour = date( 'H' );
			
			$due_hour_args = array(
				'id'          => 'wol_hour',
				'name'        => 'wol_hour',
				'label'       => __( 'Hour', 'wolbusinessdesk' ),
				'mandatory'   => '',
				'placeholder' => '',
				'class'       => '',
				'value'       => $hour,
			
			);
		
			$html = $this->form->input_text( $due_hour_args );
			
			return $html;
		}
		
		/**
		 * due_hour function.
		 * 
		 * @access public
		 * @return void
		 */
		public function due_minutes(){
			
			$minutes = date( 'i' );
			
			$due_minutes_args = array(
				'id'          => 'wol_minutes',
				'name'        => 'wol_minutes',
				'label'       => __( 'Minutes', 'wolbusinessdesk' ),
				'mandatory'   => '',
				'placeholder' => '',
				'class'       => '',
				'value'       => $minutes,
			
			);
		
			$html = $this->form->input_text( $due_minutes_args );
			
			return $html;
		}

		
		/**
		 * nonce function.
		 * 
		 * @access public
		 * @return void
		 */
		public function nonce(){
			
			$nonce = array(
				'action' => 'new_crm_task_nonce_action',
				'name'   => 'new_crm_task_nonce_name',
			);
		
			/**
			 * html
			 * 
			 * @var mixed
			 * @access public
			 */
		 	$html = $this->form->nonce_field( $nonce );
		 	
		 	return $html;

		}
		
		/**
		 * hidden function.
		 * 
		 * @access public
		 * @return void
		 */
		public function hidden(){
			
			$hidden = array(
				'fields' => array(
					'post-type' => 'wol-crm',
					'action' 	=> 'wol-crm',
				),			
			);				
		
			$html = $this->form->hidden_fields( $hidden );
		
			return $html;
		}
		
		/**
		 * submit function.
		 * 
		 * @access public
		 * @return void
		 */
		public function submit(){
			
			/**
			 * submit
			 * 
			 * @var mixed
			 * @access public
			 */
			$submit = array(
				'id'    => 'submit',
				'name'  => 'wol-submit',
				'class' => 'button',
				'value' => __( 'Add new task', 'wolbusinessdesk' ),
			);	
		
			/**
			 * html
			 * 
			 * @var mixed
			 * @access public
			 */
			$html = $this->form->submit_button( $submit );
			
			return $html;

		}

		
		/**
		 * close_form function.
		 * 
		 * @access public
		 * @return void
		 */
		public function close_form(){
			
			/**
			 * html
			 * 
			 * @var mixed
			 * @access public
			 */
			$html = $this->form->close_form();
			
			return $html;
		
		}
		
		
		
		/**
		 * validate function.
		 * 
		 * @access public
		 * @return void
		 */
		public function validate(){
			
			
			$validation_errors = new WP_Error();
			
			
			
			if ( 
				! isset( $_POST['type'] )
				|| ! is_numeric( $_POST['type'] )
				|| 0 >= $_POST['type']
				)
				{
					
					$validation_errors->add( 'type', __( '<span class="wol-red">ERROR:</span> You have to choose a valid type', 'wolbusinessdesk' ) );
				
					
				}
			
			if ( 
				! isset( $_POST['crm-action'] )
				|| ! is_numeric( $_POST['crm-action'] )
				|| 0 >= $_POST['crm-action']
				)
				{
					
					$validation_errors->add( 'action', __( '<span class="wol-red">ERROR:</span> You have to choose a valid action', 'wolbusinessdesk' ) );
					
				}
				
			if ( 
				! isset( $_POST['status'] )
				|| ! is_numeric( $_POST['status'] )
				|| 0 >= $_POST['status']
				)
				{
					
					$validation_errors->add( 'status', __( '<span class="wol-red">ERROR:</span> You have to choose a valid status', 'wolbusinessdesk' ) );
										
				}
				
			if ( 
				! isset( $_POST['wol_title'] )
				|| empty( $_POST['wol_title'] )
				)
				{
				
					$validation_errors->add( 'wol_title', __( '<span class="wol-red">ERROR:</span> You have to add a title', 'wolbusinessdesk' ) );
					
					
				}
				
			if ( 
				! isset( $_POST['wol_description'] )
				|| empty( $_POST['wol_description'] )
				)
				{
					
					$validation_errors->add( 'wol_description', __( '<span class="wol-red">ERROR:</span> You have to add a description', 'wolbusinessdesk' ) );
					
				}
				
			if (  1 > count( $validation_errors->get_error_messages() )  ){
				
				return TRUE;
				
				} else {
				
					return $validation_errors;
			}
			
		}
	
	}// chiudo la classe



}
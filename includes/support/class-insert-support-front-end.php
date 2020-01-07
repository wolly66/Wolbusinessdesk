<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'Wolbusinessdesk_Support_New_Ticket' ) ){
	
	/**
	 * Wolly_Plugin_Support_New_Ticket class.
	 */
	class Wolbusinessdesk_Support_New_Ticket {
		
		/**
		 * options
		 * 
		 * @var mixed
		 * @access private
		 */
		private $options;
		
		public $form;
			
		/**
		 * __construct function.
		 * 
		 * @access public
		 * @return void
		 */
		public function __construct() {
	
			 $this->options = get_option( WOLBUSINESSDESK_SUPPORT_OPTION_NAME );
		
		}
	
	
		// ! TODO	
		//	if ( ! is_user_logged_in() ){
		//
		//		echo '<p>' . __( 'You have to login to open new support request', 'wolbusinessdesk' ) .  '</p>';
		//
		//		$args = array(
		//		    'echo'           => true,
		//		    'redirect'       => site_url( $_SERVER['REQUEST_URI'] ),
		//		    'form_id'        => 'loginform',
		//		    'label_username' => __( 'Username' ),
		//		    'label_password' => __( 'Password' ),
		//		    'label_remember' => __( 'Remember Me' ),
		//		    'label_log_in'   => __( 'Log In' ),
		//		    'id_username'    => 'user_login',
		//		    'id_password'    => 'user_pass',
		//		    'id_remember'    => 'rememberme',
		//		    'id_submit'      => 'wp-submit',
		//		    'remember'       => true,
		//		    'value_username' => NULL,
		//		    'value_remember' => false
		//			);
		//			
		//		wp_login_form( $args );
		//
		//		} else {
		//	
		//			echo '<p>' . __( 'You do not have sufficient permissione to open new support request', 'wolbusinessdesk' ) . '</p>';
		//	
		//	}
	
		
	
		private function ticket_save_data() {
	
			if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['new_support_request_nonce_name'], 'new_support_request_nonce_action' ) ){
	
				print 'Sorry, your nonce did not verify.';
				exit;
	
			} else {
	
			// Add the content of the form to $post as an array
			$post = array(
				'post_title' 		=> wp_strip_all_tags( $_POST['wol_title'] ),
				'post_content' 		=> $_POST['wol_description'],
				'post_status' 		=> 'publish',           // Choose: publish, preview, future, etc.
				'post_type' 		=> $_POST['post-type'],  // Use a custom post type if you want to
				'comment_status' 	=> 'closed',
				'ping_status' 		=> 'closed',
			);
	
			$new_ticket_id 		= wp_insert_post( $post );  // http://codex.wordpress.org/Function_Reference/wp_insert_post
	
			$ticket_permalink 	= get_the_permalink( $new_ticket_id );
	
			$ticket_title 		= get_the_title( $new_ticket_id );
	
			//inizio invio email
	
			// ! TODO Email logic
			$args = array(
	
					'ticket_title' 		=> wp_strip_all_tags( $_POST['wol_title'] ),
					'description' 		=> $_POST['wol_description'],
					'ticket_permalink' 	=> $ticket_permalink,
					);
	
			// ! TODO 
			//$wol_send_mail = new wol_SendMail( $args, 'new');
			//$wol_send_mail->send_mail();
	
			// ! TODO TICKET NUMERATION LOGIC
			//Add ticket number
			$wol_ticket_numerator = get_option('wol-ticket-numerator');
	
			if ( ! $wol_ticket_numerator ){
	
				$wol_ticket_numerator = 0;
			}
	
			$wol_ticket_numerator = $wol_ticket_numerator + 1;
	
			update_option('wol-ticket-numerator', $wol_ticket_numerator );
	
			//$new_ticket_number = date( 'ymd', time() ) . '-' .  str_pad( $wol_ticket_numerator, 6, "0", STR_PAD_LEFT );
			$new_ticket_number = $wol_ticket_numerator;
			update_post_meta( $new_ticket_id, 'wol_ticket_number', $new_ticket_number );
			// end add tickt number
	
			if ( isset( $_POST['priority'] ) ){
	
				wp_set_object_terms( $new_ticket_id, array( (int)$_POST['priority'] ), 'wol-ticket-priority' );
				}
	
			if ( isset( $_POST['board'] ) ){
	
				wp_set_object_terms( $new_ticket_id, array( (int)$_POST['board'] ), 'wol-ticket-board' );
	
				}
	
			if ( isset( $_POST['status'] ) ){
	
				wp_set_object_terms( $new_ticket_id, array( (int)$_POST['status'] ), 'wol-ticket-status' );
	
				}
	
			if ( isset( $_POST['type'] ) ){
	
				wp_set_object_terms( $new_ticket_id, array( (int)$_POST['type'] ), 'wol-ticket-type' );
	
				}
			
			$args = array();
			external_task_to_crm( $args );	
	
			$location = $ticket_permalink;
	
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
			
			if ( is_wol_can_open_ticket() ){
			if ( 
				isset( $_POST['action'] ) 
				&& 'wol-ticket' == $_POST['action'] 
				&& wp_verify_nonce( $_POST['new_support_request_nonce_name'], 'new_support_request_nonce_action' ) 
				) {
					
					$validation = $this->validate();
					
					if ( ! is_wp_error( $validation ) ){
						
						$this->ticket_save_data();
						
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
				'id'      => 'wol-ticket',
				'name'    => 'wol-ticket',
				'method'  => 'POST',
				'action'  => '',
				'class'   => 'wol-ticket',
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
		
		public function boards(){
			
			/**
			 * boards_args
			 * 
			 * @var mixed
			 * @access public
			 */
			$boards_args = array(
				'taxonomy'	=> 'wol-ticket-board',
				'echo'		=> FALSE,
				'hide_empty'=> 0,
				'name'		=> 'board',
				'class'		=> 'ticket-dd form-control',
				'required'	=> TRUE,
				'label'		=> __( 'Boards', 'wolbusinessdesk' ),
				'mandatory'	=> '*',
			);
		
			/**
			 * html
			 * 
			 * @var mixed
			 * @access public
			 */
			$html = $this->form->input_dropdown_wp_tax( $boards_args );
			
			return $html;

		}
		
		public function type(){
			
			/**
			 * type_args
			 * 
			 * @var mixed
			 * @access public
			 */
			$type_args = array(
				'taxonomy'	=> 'wol-ticket-type',
				'echo'		=> FALSE,
				'hide_empty'=> 0,
				'name'		=> 'type',
				'class'		=> 'ticket-dd form-control',
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
		
		public function priority(){
			
			$priority_args = array(
				'taxonomy'	=> 'wol-ticket-priority',
				'echo'		=> FALSE,
				'hide_empty'=> 0,
				'name'		=> 'priority',
				'class'		=> 'ticket-dd form-control',
				'required'	=> TRUE,
				'label'		=> __( 'Priority', 'wolbusinessdesk' ),
				'mandatory'	=> '*',
			);
		
			/**
			 * html
			 * 
			 * @var mixed
			 * @access public
			 */
			$html = $this->form->input_dropdown_wp_tax( $priority_args );
			
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
				'taxonomy'	=> 'wol-ticket-status',
				'echo'		=> FALSE,
				'hide_empty'=> 0,
				'name'		=> 'status',
				'include'	=> $status_new,
				'class'		=> 'ticket-dd form-control',
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
		
		public function title(){
			
			$title_args = array(
				'id'          => 'wol_title',
				'name'        => 'wol_title',
				'label'       => __( 'Ticket title', 'wolbusinessdesk' ),
				'mandatory'   => '*',
				'placeholder' => __( 'Ticket title', 'wolbusinessdesk' ),
				'class'       => 'form-control',
				'value'       => '',
			
			);
		
			$html = $this->form->input_text( $title_args );
			
			return $html;
		}
		
		public function content(){
			
			$ticket_content = array(
				'id'          => 'wol_description',
				'name'        => 'wol_description',
				'rows'        => get_option('default_post_edit_rows', 10),
				'cols'        => 50,
				'label'       => __( 'Ticket Description', 'wolbusinessdesk' ),
				'mandatory'   => '*',
				'placeholder' => '',
				'class'       => 'form-input',
				'value'       => '',
			);
		

			$html = $this->form->input_textarea( $ticket_content );
			
			return $html;
		}
		
		public function nonce(){
			
			$nonce = array(
				'action' => 'new_support_request_nonce_action',
				'name'   => 'new_support_request_nonce_name',
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
		
		public function hidden(){
			
			$hidden = array(
				'fields' => array(
					'post-type' => 'wol-ticket',
					'action' 	=> 'wol-ticket',
				),			
			);				
		
			$html = $this->form->hidden_fields( $hidden );
		
			return $html;
		}
		
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
				'value' => ( isset( $row_to_modify ) ) ? 'MODIFICA' : 'NUOVO',
				
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
				! isset( $_POST['board'] )
				|| ! is_numeric( $_POST['board'] )
				|| 0 >= $_POST['board']
				){
					$validation_errors->add( 'boards', __( '<span class="wol-red">ERROR:</span> You have to choose a valid board', 'wolbusinessdesk' ) );
	
					
				}
			
			if ( 
				! isset( $_POST['type'] )
				|| ! is_numeric( $_POST['type'] )
				|| 0 >= $_POST['type']
				)
				{
					
					$validation_errors->add( 'type', __( '<span class="wol-red">ERROR:</span> You have to choose a valid type', 'wolbusinessdesk' ) );
				
					
				}
			
			if ( 
				! isset( $_POST['priority'] )
				|| ! is_numeric( $_POST['priority'] )
				|| 0 >= $_POST['priority']
				)
				{
					
					$validation_errors->add( 'priority', __( '<span class="wol-red">ERROR:</span> You have to choose a valid priority', 'wolbusinessdesk' ) );
					
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
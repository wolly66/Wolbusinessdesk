<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'Wolly_Plugin_Support_New_Ticket' ) ){
	
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
	
			 add_shortcode( 'wol-support', array( $this, 'front_end_form' ) );
	
	
		}
	
		
		/**
		 * front_end_form function.
		 * 
		 * @access public
		 * @return void
		 */
		public function front_end_form() {
	
			if ( is_user_logged_in() && ( current_user_can( 'wol_add_new_ticket' ) ) ){
	
		?>
	
		<?php $user_data = get_userdata( get_current_user_id() ); ?>
		<?php $company 	= get_user_meta( $user_data->ID, 'company_associata', true ); ?>
	
		<div class="row">
			<div class="col-md-12 inex-user-name">
				<p><?php echo _e( 'Welcome', 'wolbusinessdesk' ) . ' ' . $user_data->display_name ?></p>
			</div>
		</div>
		<form id="wol-ticket" name="wol-ticket" method="post" action="" class="wol-ticket">
			<?php
			//TO DO
			// Creare pannello di controllo per scegliere lo stato da utilizzare in apertura ticket
			?>
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<label for="category"><?php echo _e( 'Board', 'wolbusinessdesk' ) ?></label><br />
					<?php wp_dropdown_categories( 'tab_index=1&taxonomy=wol-ticket-board&hide_empty=0&name=board&class=ticket-dd form-control' ); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<label for="type"><?php echo _e( 'Type', 'wolbusinessdesk' ) ?></label><br />
					<?php wp_dropdown_categories( 'tab_index=10&taxonomy=wol-ticket-type&hide_empty=0&name=type&class=ticket-dd form-control' ); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<label for="priority"><?php echo _e( 'Priority', 'wolbusinessdesk' ) ?></label><br />
					<?php wp_dropdown_categories( 'tab_index=20&taxonomy=wol-ticket-priority&hide_empty=0&name=priority&class=ticket-dd form-control' ); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php
						//check if opening status is set
	
						if ( empty( $this->options['opening_status'] ) || -1 == $this->options['opening_status'] ){
	
							$include = '';
						} else {
	
							$include = '&include=' . (int)$this->options['opening_status'];
	
						}
					?>
					<label for="status"><?php echo _e( 'Status', 'wolbusinessdesk' ) ?></label><br />
					<?php wp_dropdown_categories( 'tab_index=30&taxonomy=wol-ticket-status' . $include . '&hide_empty=0&name=status&class=ticket-dd form-control' ); ?>
				</div>
			</div>
			<div class="row top-buffer">
				<div class="col-md-12">
					<p><label for="title"><?php echo _e( 'Ticket Title', 'wolbusinessdesk' ) ?></label><br />
	
						<input type="text" id="wol_title" value="" tabindex="40" size="138" name="wol_title" class="form-control" />
	
					</p>
	
					<p>
						<label for="description"><?php echo _e( 'Ticket Description', 'wolbusinessdesk' ) ?></label>
						<?php
						/*
						<textarea id="wol_description" tabindex="50" name="wol_description" cols="50" rows="15" class="form-control"></textarea>
						*/
						$content = '';
						$editor_id = 'wol_description';
						$settings =   array(
						    'wpautop' => true, // use wpautop?
						    'media_buttons' => true, // show insert/upload button(s)
						    'textarea_name' => 'wol_description', // set the textarea name to something different, square brackets [] can be used here
						    'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
						    'tabindex' => '',
						    'editor_css' => '', //  extra styles for both visual and HTML editors buttons,
						    'editor_class' => '', // add extra class(es) to the editor textarea
						    'teeny' => false, // output the minimal editor config used in Press This
						    'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
						    'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
						    'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
						);
						// Turn on the output buffer
						ob_start();
	
						// Echo the editor to the buffer
						wp_editor( $content, $editor_id, $settings );
	
						// Store the contents of the buffer in a variable
						$editor_contents = ob_get_clean();
						echo $editor_contents;
						?>
					</p>
	
					<p align="right"><input type="submit" value="Publish" tabindex="6" id="wol_submit" name="wol_submit" class="btn" /></p>
	
					<input type="hidden" name="post-type" id="post-type" value="wol-ticket" class="form-control" />
	
					<input type="hidden" name="action" value="wol-ticket" />
	
					<?php wp_nonce_field( 'new_ticket_action','new_ticket_nonce_field' ); ?>
				</div>
			</div>
		</form>
	<?php
	
		if(	isset( $_POST['wol_submit'] ) ){
	
			$this->ticket_save_data();
	
			$allowedtags = array(
				'img' => array(
			        'src' => true,
			    ),
			    'a' => array(
			        'href' => true,
			        'title' => true,
			    ),
			    'abbr' => array(
			        'title' => true,
			    ),
			    'acronym' => array(
			        'title' => true,
			    ),
			    'b' => array(),
			    'blockquote' => array(
			        'cite' => true,
			    ),
			    'cite' => array(),
			    'code' => array(),
			    'del' => array(
			        'datetime' => true,
			    ),
			    'em' => array(),
			    'i' => array(),
			    'q' => array(
			        'cite' => true,
			    ),
			    'strike' => array(),
			    'strong' => array()
			);
		}
	
	
	
		} else {
			
			if ( ! is_user_logged_in() ){
	
				echo '<p>' . __( 'You have to login to open new support request', 'wolbusinessdesk' ) .  '</p>';
	
				$args = array(
				    'echo'           => true,
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
					
				wp_login_form( $args );
	
				} else {
			
					echo '<p>' . __( 'You do not have sufficient permissione to open new support request', 'wolbusinessdesk' ) . '</p>';
			
			}
	
		}
		
		}
	
		private function ticket_save_data() {
	
			if ( empty( $_POST ) || !wp_verify_nonce( $_POST['new_ticket_nonce_field'], 'new_ticket_action' ) ){
	
				print 'Sorry, your nonce did not verify.';
				exit;
	
			} else {
	
	
				// Do some minor form validation to make sure there is content
				if ( isset ( $_POST['wol_title'] ) ) {
	
					$title = $_POST['wol_title'];
	
				} else {
	
					echo 'Please enter a title';
					exit;
				}
	
			if ( isset ( $_POST['wol_description'] ) ) {
	
				$description = wp_kses( $_POST['wol_description'], $allowedtags );
	
			} else {
	
				echo 'Please enter the content';
				exit;
			}
	
	
			// Add the content of the form to $post as an array
			$post = array(
			'post_title' => wp_strip_all_tags( $title ),
			'post_content' => $description,
			'post_status' => 'publish',           // Choose: publish, preview, future, etc.
			'post_type' => $_POST['post-type'],  // Use a custom post type if you want to
			'comment_status' => 'closed',
			'ping_status' => 'closed',
			);
	
			$new_ticket_id = wp_insert_post( $post );  // http://codex.wordpress.org/Function_Reference/wp_insert_post
	
			$ticket_permalink = get_the_permalink( $new_ticket_id );
	
			$ticket_title = get_the_title( $new_ticket_id );
	
			//inizio invio email
	
	
			$args = array(
	
					'ticket_title' => wp_strip_all_tags( $title ),
					'description' => $description,
					'ticket_permalink' => $ticket_permalink,
					);
	
			// ! TODO 
			//$wol_send_mail = new wol_SendMail( $args, 'new');
			//$wol_send_mail->send_mail();
	
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
	
			//$location = home_url(); // redirect location, should be login page
			$location = $ticket_permalink;
	
			echo "<meta http-equiv='refresh' content='0;url=$location' />"; exit;
			} // end IF
	
		}
		public function form_test(){
			
			$html = '';
			
			
			return $html;
			
		}
		
		public function new_form(){
			
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
			
		}
		
		public function open_form(){
			
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
		$html = $this->form->open_form( $open_form );
		
		return $html;
		
			
		}
		
		public function boards(){
			
			$boards_args = array(
			'taxonomy'	=> 'wol-ticket-board',
			'echo'		=> FALSE,
			'hide_empty'=> 0,
			'name'		=> 'board',
			'class'		=> 'ticket-dd form-control',
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
		
		
		
		public function form(){
			
				
				
		
		
				
						
		


		
		
		
		
					
			$hidden = array(
			'fields' => array(
						'mng_prestazioni_tecniche' => 'mng_artigiani_new',
						'new_prestazioni_tecniche_save' => 'mng_artigiani_new',
						
						),
			
			
			
		);
	
				
		
		//$html .= $form->hidden_fields( $hidden );
		
		
		
		
		
				
		}
	
	}// chiudo la classe



}
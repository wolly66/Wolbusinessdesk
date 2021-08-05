<?php
	namespace Wolbusinessdesk\Includes\Support;
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


if ( ! class_exists( 'Reply_Loop' ) ){
	/**
	 * wol_Ticket_Reply_Loop class.
	 *
	 * @package inex ticket
	 *
	 * @since version 1.0
	 *
	 */
	class Reply_Loop {
		
		/**
		 * ticket_id
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var 		$ticket_id = '0';
		
		/**
		 * id_user
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var 		$id_user = '0';
		
		/**
		 * options
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access private
		 */
		private 	$options = '';
		
		/**
		 * write
		 * 
		 * (default value: '')
		 * 
		 * @var string
		 * @access public
		 */
		var 		$write = FALSE;
	
		/**
		 * Wolly_Plugin_Support_Reply_Loop::__construct()
		 *
		 *
		 * @package inex ticket
		 *
		 * @since version 1.0
		 *
		 *
		 * @param array $args various params some overidden by default
		 *
		 * @void
		 */
	
		public function __construct() {
	
			
			$this->options = get_option( WOLBUSINESSDESK_SUPPORT_OPTION_NAME );
	
		}
	
		/**
		 * reply_loop function.
		 *
		 *
		 * @package inex ticket
		 *
		 * @since version 1.0
		 *
		 * @access public
		 * @return $reply_loop_render
		 */
		public function reply_loop(){
			
			// ! TODO STUDIARE LA LOGICA DEL CAN WRITE
			$this->id_user = absint( get_current_user_id(  ) );
	
			if ( 0 == $this->id_user || empty( $this->id_user ) ){
				
				$this->write = false;
				
			} else {
	
				$this->write = true;
	
			}
			
			$this->ticket_id = absint( get_the_id() );
	
			$reply_loop_render = '';
	
			//check if a reply is submitted
			if ( isset( $_POST['wol_submit'] )	){
	
				if ( ! wp_verify_nonce( $_POST['new_ticket_reply_nonce_field'], 'new_ticket_reply_action' ) ) {
	
					die( 'Nonce not verified' );
	
				} else {
	
					// Do stuff here.
					$reply_loop_render .= $this->save_reply();
				}
	
			}
	
			//custom wp_query for ticket reply
			$args = array(
	
				'post_type' 		=> 'wol-ticket-reply',
				'post_parent' 		=> $this->ticket_id,
				'orderby' 			=> 'ID',
				'order' 			=> $this->options['sorting'],
				'posts_per_page' 	=> -1,
			);
	
			$ticket_replies = new WP_Query( $args );
	
	
			//if there are replies I loop
			if ( $ticket_replies->have_posts() ) :
					// Start the Loop.
					while ( $ticket_replies->have_posts() ) : $ticket_replies->the_post();
	
	            $reply_loop_render .= '<div id="post-' . get_the_ID() . '">
	                     <div class="blog-post-tags">
	                    <ul class="list-unstyled list-inline blog-info">
	                        <li><i class="icon-calendar"></i> Risposta inviata il ' . get_the_time(__('j M y', 'wolbusinessdesk')) . ' alle ' . get_the_time() . '</li>
	                        <li><i class="icon-pencil"></i> da ' . get_the_author() . '</li>
						</ul>
	
	                </div>
	
	                <div class="blog-body">'
	                	. get_the_content() . '
	
	                </div>
	             </div>
	
				<hr>';
	
					endwhile;
					endif;
					wp_reset_postdata();
	
				$term_status = get_the_terms( $this->ticket_id, 'wol-ticket-status' );
				
				$term_id_status = ( is_object( $term_status ) ) ?
					(int)$term_status[0]->term_id :
					0;
	
				$standard_single_permissions = array(
										'read' => true,
										'write' => $this->write,
										'view_only_your_tickets' => FALSE,
										'pubblic' => null,
										'user_id' => (int)$this->id_user,
										'status' => $term_id_status,
										'ticket_id' => (int)$this->ticket_id,
										'company_id' => 0,
										);
	
				$filtered_single_permissions = apply_filters( 'wol_single_permissions', $standard_single_permissions );
				
				if ( is_wol_ticket_open( $this->ticket_id ) 
					 && is_wol_can_reply_to_ticket( $filtered_single_permissions ) ){
	
					$dropdowns = wol()->ticket_meta->show_ticket_data();
	
					$reply_title = __( 'Reply to: ', 'wolbusinessdesk' ) . get_the_title( $this->ticket_id );
	
					//editor
	
					// default settings - Kv_front_editor.php
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
	
					$reply_loop_render .= '
	
					<form id="wol-ticket-reply" name="wol-ticket-reply" method="post" action="">
					<p>' . $dropdowns . '</p>
					<p><label for="description">' . __( 'Ticket reply', 'wolbusinessdesk' ) . '</label><br />' .
					 $editor_contents . '</p>
	
					<p align="right"><input type="submit" value="' . __( 'Reply', 'wolbusinessdesk' ) . '" tabindex="6" id="wol_submit" name="wol_submit" /></p>
	
					<input type="hidden" name="post-type" id="post-type" value="wol-ticket-reply" />
	
					<input type="hidden" name="parent-ticket" id="parent-ticket" value="' . $this->ticket_id . '" />
	
					<input type="hidden" name="reply-title" id="reply-title" value="' . $reply_title . '" />
	
					<input type="hidden" name="reply-author" id="reply-author" value="' . $this->id_user . '" />
	
					<input type="hidden" name="action" value="wol-ticket-reply" />'
	
					. wp_nonce_field( 'new_ticket_reply_action','new_ticket_reply_nonce_field' ) . '
	
					</form>';
	
	
				}
	
	
				return $reply_loop_render;
		}
	
	
		/**
		 * save_reply function.
		 *
		 *
		 * @package inex ticket
		 *
		 * @since version 1.0
		 *
		 * @access private
		 * @return void
		 */
		private function save_reply(){
	
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
	
			if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['new_ticket_reply_nonce_field'], 'new_ticket_reply_action' ) ){
	
				print 'Sorry, your nonce did not verify.';
				exit;
	
				} else {
	
					if ( isset ( $_POST['reply-title'] ) ) {
	
					$title = ( $_POST['reply-title'] );
	
					} else {
	
						echo 'Please enter a title';
						exit;
					}
	
					if ( isset ( $_POST['wol_description'] ) ) {
	
						$description = wp_kses( $_POST['wol_description'], $allowedtags ); //esc_textarea( $_POST['wol_description'] );
	
					} else {
	
						echo 'Please enter the content';
						exit;
					}
	
					if ( isset ( $_POST['parent-ticket'] ) ) {
	
						$parent_ticket = absint( $_POST['parent-ticket'] );
	
					} else {
	
						echo 'Please enter the content';
						exit;
					}
	
					if ( isset ( $_POST['reply-author'] ) ) {
	
						$reply_author = absint( $_POST['reply-author'] );
	
					} else {
	
						echo 'Please enter the content';
						exit;
					}
	
					if ( -1 != $_POST['owner_list'] ) {
	
						$ticket_owner = absint( $_POST['owner_list'] );
	
					} else {
	
						$ticket_owner = -1;
					}
	
	
	
				$args = array(
	
					'post_title'    	=> $title,
					'post_content'  	=> $description,
					'post_status'   	=> 'publish',
					'post_author'   	=> $reply_author,
					'post_parent'	=> $parent_ticket,
					'post_type'		=> 'wol-ticket-reply'
					);
	
				$cpt_id = wp_insert_post( $args );
	
				//inizio invio email
				$ticket_permalink = get_the_permalink( $parent_ticket );
	
				$args = array(
	
				'ticket_title' 		=> wp_strip_all_tags( $title ),
				'description'		=> $description,
				'ticket_permalink' 	=> $ticket_permalink,
				'reply_author' 		=> $reply_author,
				'ticket_owner' 		=> $ticket_owner,
	
				);
	
				//$wol_send_mail = new wol_SendMail( $args, 'reply');
				//$wol_send_mail->send_mail();
	
				//update ticket owner
	
				update_post_meta( $parent_ticket, 'ticket_owner', $ticket_owner );
	
				// update terms
				if ( isset( $_POST['priority'] ) ){
	
					wp_set_object_terms( $parent_ticket, array( (int)$_POST['priority'] ), 'wol-ticket-priority' );
	
				}
				 // ! TODO THIS TAXONOMY DOES NOT EXIST
				if ( isset( $_POST['category'] ) ){
	
					wp_set_object_terms( $parent_ticket, array( (int)$_POST['category'] ), 'wol-ticket-ticket' );
	
				}
	
				if ( isset( $_POST['status'] ) ){
	
					wp_set_object_terms( $parent_ticket, array( (int)$_POST['status'] ), 'wol-ticket-status' );
	
				}
	
				if ( isset( $_POST['type'] ) ){
	
					wp_set_object_terms( $parent_ticket, array( (int)$_POST['type'] ), 'wol-ticket-type' );
	
				}
	
			}// end if empty $_POST
	
		}
	
	}// close the class

} // end if class exists

<?php
	namespace Wolbusinessdesk\Includes\Documents;
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'Client_Document' ) ){
	
	/**
	 * Wolly_Plugin_Support_New_Ticket class.
	 */
	class Client_Document extends \Wolbusinessdesk\Includes\Abstracts\Wol_Cpt_And_Tax{
		
		/**
		 * options
		 * 
		 * @var mixed
		 * @access private
		 */
		private $options;
		
		/**
		 * document_id
		 * 
		 * @var mixed
		 * @access private
		 */
		private $document_id;
		
		/**
		 * id_user
		 * 
		 * @var mixed
		 * @access private
		 */
		private $id_user;
			
		/**
		 * __construct function.
		 * 
		 * @access public
		 * @return void
		 */
		public function __construct() {
			
			
			$this->id_user 		= (  is_user_logged_in() ) ?
				get_current_user_id( ) :
				0;
			 $this->options = get_option( WOLBUSINESSDESK_DOCUMENT_OPTION_NAME );
	
			 add_shortcode( 'wol-document', array( $this, 'front_end_form' ) );
	
	
		}
	
		
		/**
		 * front_end_form function.
		 * 
		 * @access public
		 * @return void
		 */
		public function front_end_form() {
	
			if ( is_user_logged_in() &&  current_user_can( 'wol_manage_new_client_document' ) ){
	
		?>
	
		<?php $user_data 	= get_userdata( $this->id_user ); ?>
		<?php $company 		= get_user_meta( $user_data->ID, 'company_associata', true ); ?>
	
		<div class="row">
			<div class="col-md-12 inex-user-name">
				<p><?php echo _e( 'Welcome', 'wollyplugin' ) . ' ' . $user_data->display_name ?></p>
				
				<?php if(	isset( $_POST['client-document-submit'] ) ){
			
			// ! TODO DEBUG DA RIMUOVERE
			echo '<pre>' . print_r( $_POST , 1 ) . '</pre>';
	
			$errors = $this->document_save_data();
			
			if ( $errors ){
				
				// ! TODO DEBUG DA RIMUOVERE
				echo '<pre>' . print_r( $errors , 1 ) . '</pre>';
				
				}
	
			} 
			
			
			?>
			</div>
		</div>
		<form id="inex-ticket" name="inex-ticket" method="post" action="" class="inexticket">
			


    
		
			<div class="row top-buffer">
				<div class="col-md-12">
					<p><label for="document_title"><?php echo _e( 'Document Title', 'wollyplugin' ) ?></label><br />
	
						<input type="text" id="document_title" value="" tabindex="40" size="138" name="document_title" class="form-control" />
	
					</p>
	
					<p><?php
			$args = array(
			'to'    => 'wl-document',
			'label' => 'document',
			'title' => __( 'Std Document', 'wollyplugin' ),
		);

		echo wol()->relationship->generate_single_relationship_code( $args );
		
		
		$args_clients = array(
			'to'    => 'wl-client',
			'label' => 'Client',
			'title' => __( 'Client', 'wollyplugin' ),
		);

		echo wol()->relationship->generate_single_relationship_code( $args_clients ); ?></p>
		<?php // We'll use this nonce field later on when saving.
    wp_nonce_field( 'document_to_std_client_nonce', 'document_to_std_client_nonce' );

			?>
					<p align="right"><input type="submit" value="<?php _e( 'Create new Client Document', 'wollyplugin' ); ?>" tabindex="6" id="submit" name="client-document-submit" class="edit-submit" /></p>
	
					<input type="hidden" name="post-type" id="post-type" value="wl-client-document" class="form-control" />
	
					<input type="hidden" name="action" value="inex-ticket" />
	
					<?php wp_nonce_field( 'new_ticket_action','new_ticket_nonce_field' ); ?>
				</div>
			</div>
		</form>
	<?php
	
		
	
	
	
		} else {
			
			if ( ! is_user_logged_in() ){
	
				echo '<p>' . __( 'You have to login to open new support request', 'wollyplugin' ) .  '</p>';
	
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
			
					echo '<p>' . __( 'You do not have sufficient permissione to open new support request', 'wollyplugin' ) . '</p>';
			
			}
	
		}
		
		}
		
		/**
		 * document_save_data function.
		 * 
		 * @access private
		 * @return void
		 */
		private function document_save_data() {
	
			if ( empty( $_POST ) || !wp_verify_nonce( $_POST['document_to_std_client_nonce'], 'document_to_std_client_nonce' ) ){
	
				print 'Sorry, your nonce did not verify.';
				exit;
	
			} else {
	
	
				if ( ! current_user_can( 'wol_manage_new_client_document' ) ){
					

					exit;
					
				}
				
				
				/**
				 * errors
				 * 
				 * (default value: array())
				 * 
				 * @var array
				 * @access public
				 */
				$errors = array();
				
				// Do some minor form validation to make sure there is content
				if ( isset ( $_POST['document_title'] ) && ! empty( $_POST['document_title'] ) ) {
					
					/**
					 * title
					 * 
					 * (default value: $_POST['document_title'])
					 * 
					 * @var string
					 * @access public
					 */
					$title = $_POST['document_title'];
	
				} else {
					
					/**
					 * errors
					 * 
					 * @var mixed
					 * @access public
					 */
					$errors[] = 'Please enter a title';
					
				}
				
				if (  empty( $_POST['rel_wol-document']['to_id'] ) ){
					
					/**
					 * errors
					 * 
					 * @var mixed
					 * @access public
					 */
					$errors[] = 'Please choose a document';
										
					} else {
					
						
						/**
						 * content_post
						 * 
						 * (default value: get_post( absint( $_POST['rel_wol-document']['to_id'] ) ))
						 * 
						 * @var string
						 * @access public
						 */
						$content_post = get_post( absint( $_POST['rel_wol-document']['to_id'] ) );
						
						/**
						 * content
						 * 
						 * (default value: $content_post->post_content)
						 * 
						 * @var mixed
						 * @access public
						 */
						$content = $content_post->post_content;
						
						/**
						 * type
						 * 
						 * (default value: wp_get_post_terms( absint( $_POST['rel_wol-document']['to_id'] ), 'wol-document-type' ))
						 * 
						 * @var string
						 * @access public
						 */
						$type = wp_get_post_terms( absint( $_POST['rel_wol-document']['to_id'] ), 'wol-document-type' );
						

						if ( empty( $content ) ){
							
							/**
							 * errors
							 * 
							 * @var mixed
							 * @access public
							 */
							$errors[] = 'The std document has non content';
						}
						
						if ( empty( $type[0]->term_id ) ){
							
							/**
							 * errors
							 * 
							 * @var mixed
							 * @access public
							 */
							$errors[] = 'The std document has non type';
						}

	
				}
				
				if ( empty( $_POST['rel_wl-client']['to_id'] ) ){
					
					/**
					 * errors
					 * 
					 * @var mixed
					 * @access public
					 */
					$errors[] = 'Please choose a client';
					
				}
				
				/**
				 * wolly_documents_options
				 * 
				 * (default value: get_option( 'wolly_plugin_documents_option' ))
				 * 
				 * @var string
				 * @access public
				 */
				$wol_documents_options	= get_option( WOLBUSINESSDESK_DOCUMENT_OPTION_NAME );
				
				if ( $wolly_documents_options['doc_opening_status'] ){
					
					/**
					 * opening_status
					 * 
					 * (default value: absint( $wolly_documents_options['doc_opening_status'] ))
					 * 
					 * @var string
					 * @access public
					 */
					$opening_status = absint( $wol_documents_options['doc_opening_status'] );
					
				} else {
					
					$errors[] = 'Please seti an opening document status in wollyplugin settings';
				}
	
				if ( ! empty( $errors ) )
					return $errors;
				
					// Add the content of the form to $post as an array
					$post = array(
						'post_title' 		=> wp_strip_all_tags( $title ),
						'post_content' 		=> $content,
						'post_status' 		=> 'publish',           // Choose: publish, preview, future, etc.
						'post_type' 		=> $_POST['post-type'],  // Use a custom post type if you want to
						'comment_status' 	=> 'closed',
						'ping_status' 		=> 'closed',
					);
					
					/**
					 * new_client_document_id
					 * 
					 * (default value: wp_insert_post( $post ))
					 * 
					 * @var mixed
					 * @access public
					 */
					$new_client_document_id = wp_insert_post( $post );  // http://codex.wordpress.org/Function_Reference/wp_insert_post
			
			
					if ( ! empty( $_POST['rel_wol-document']['to_id'] ) && is_numeric( $_POST['rel_wol-document']['to_id'] ) ){
						
						/**
						 * args
						 * 
						 * @var mixed
						 * @access public
						 */
						$args = array(
							'from'    => get_post_type( $new_client_document_id ),
							'to'      => $_POST['rel_wol-document']['to'],
							'from_id' => $new_client_document_id,
							'to_id'   => $_POST['rel_wol-document']['to_id'],
						);
					
						wol()->relationship->set_relationship( $args );
					}
					
					if ( ! empty( $_POST['rel_wl-client']['to_id'] ) && is_numeric( $_POST['rel_wl-client']['to_id'] ) ){
						
						/**
						 * args
						 * 
						 * @var mixed
						 * @access public
						 */
						$args = array(
							'from'    => get_post_type( $new_client_document_id ),
							'to'      => $_POST['rel_wl-client']['to'],
							'from_id' => $new_client_document_id,
							'to_id'   => $_POST['rel_wl-client']['to_id'],
						);
					
						wol()->relationship->set_relationship( $args );
						
					}

					
					/**
					 * client_document_permalink
					 * 
					 * (default value: get_the_permalink( $new_client_document_id ))
					 * 
					 * @var mixed
					 * @access public
					 */
					$client_document_permalink = get_the_permalink( $new_client_document_id );
	
			
					
				
				
					if ( $type[0]->term_id ){
						
						wp_set_object_terms( $new_client_document_id, array( (int)$type[0]->term_id ), 'wol-document-type' );
					}
					
					if ( $opening_status ){
	
						wp_set_object_terms( $new_client_document_id, array( (int)$opening_status ), 'wol-document-status' );
					}
					
					/**
					 * location
					 * 
					 * (default value: $client_document_permalink)
					 * 
					 * @var mixed
					 * @access public
					 */
					$location = $client_document_permalink;
	
					echo "<meta http-equiv='refresh' content='0;url=$location' />"; exit;
			} // end IF
	
		}
		
		/**
		 * the_title function.
		 * 
		 * @access public
		 * @param string $open (default: '')
		 * @param string $close (default: '')
		 * @return void
		 */
		public function the_title( $open = '', $close = ''){
			
			if ( is_user_logged_in() &&  current_user_can( 'wol_manage_new_client_document' ) ){
				
				the_title( $open, $close );
				
				} else {
					
					
				}
			
			
		}
		
		/**
		 * the_content function.
		 * 
		 * @access public
		 * @return void
		 */
		public function the_content(){
			
			if ( is_user_logged_in() &&  current_user_can( 'wol_manage_new_client_document' ) ){
				
				$args = array(
					'editor_id' 		=> 'modify_client_document_id',
					'content' 			=> get_the_content(),
					'text_area_name' 	=> 'modify_client_document',
					'tabindex' 			=> 10,
				
				);
				
				echo $this->content_editor( $args );
				
				} else {
					
					the_content();
				}
			
			
		}
		
		/**
		 * modify_client_document function.
		 * 
		 * @access public
		 * @return void
		 */
		public function modify_client_document(){
			
			
			
			$html = '';
			
			if ( is_user_logged_in() &&  current_user_can( 'wol_manage_new_client_document' ) ){
						
				

				$document = $this->document_name();
				
				$html .= 'Standard document: ' . get_the_title( $document[0]['to_id'] ) . '<br>';
		

				$client = $this->document_client();
				
				$html .= 'For Client: ' .get_the_title( $client[0]['to_id'] ) . '<br>';
				
				
				$html .= $this->client_document_generated();
				
				$html .= $this->doc_status();
				
				$html .= $this->doc_type();
				
				
				} else {
					
					
					$html = '';
			}
			
			
			return $html;
		}
		
		public function document_name(){
			
			global $post;
			$this->document_id 	= $post->ID;
			
			$args_document = array(
						'from'	=> 'wl-client-document',
						'to'    => 'wl-document',
						'from_id' => $this->document_id,
						
					);

			$document = wol()->relationship->get_related_cpt( $args_document );
			
			return $document;
			
		}
		
		public function document_client(){
			
			global $post;
			$this->document_id 	= $post->ID;
			$args_clients = array(
						'from'	=> 'wl-client-document',
						'to'    => 'wl-client',
						'from_id' => $this->document_id,
						
					);

			$client = wol()->relationship->get_related_cpt( $args_clients );
			
			return $client;
		}
		public function client_document_generated(){
			
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
		 	 * generate_document
		 	 * 
		 	 * @var mixed
		 	 * @access public
		 	 * @return BOOL
		 	 */
		 	$generate_document = ( get_post_meta( get_the_id(  ), 'generate_document', true ) ) ?
		 		get_post_meta( get_the_id(  ), 'generate_document', true ) :
		 		0;
		 		
		 	$generate_document_description = ( $generate_document ) ?
		 		__( 'Generated', 'wollyplugin' ) :
		 		__( 'Not generated, yet; check the box to generate it', 'wollyplugin' );
		 	
		 	$html .= '<label for="generate_document">' . __( 'Is Client Document generated?', 'wollyplugin' ) . '</label>';
				
			$html .= sprintf( '<p><input type="checkbox" id="generate_document" name="generate_document" value="1" /> %s</p>',
				 $generate_document_description 
				 );
			
			return $html;
			
			
		}
		/**
		 * doc_status function.
		 * 
		 * @access private
		 * @return void
		 */
		public function doc_status(){
		
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
		 * taxonomies
		 * 
		 * @var mixed
		 * @access public
		 */
		$taxonomies = array(
			'wol-document-status',
		);
		
		/**
		 * args
		 * 
		 * @var mixed
		 * @access public
		 */
		$args = array(
		    'orderby'           => 'name',
		    'order'             => 'ASC',
		    'hide_empty'        => false,

		);
		
		/**
		 * status
		 * 
		 * (default value: get_terms( $taxonomies, $args ))
		 * 
		 * @var mixed
		 * @access public
		 */
		$status = get_terms( $taxonomies, $args );
		
		//$doc_status = wp_get_post_terms( absint( get_the_id(  ) ), 'wol-document-type' );
		
		/**
		 * doc_status
		 * 
		 * (default value: wp_get_post_terms( absint( get_the_id(  ) ), 'wol-document-status' ))
		 * 
		 * @var string
		 * @access public
		 */
		$doc_status = wp_get_post_terms( absint( get_the_id(  ) ), 'wol-document-status' );

		if ( ! empty( $status ) ){
			$html .= '<h3>' . __( 'Document status', 'wollyplugin' ) . '</h3>';
			$html .= '<p><select name="documents_status">';

			$html .= '<option value="0" ' . selected( $doc_status[0]->term_id, -1 ) . '>' . __( 'Select Document Status', 'wollyplugin' ) . '</option>';

			foreach ( $status as $st ){

				$html .= '<option value="' . $st->term_id . '" ' . selected( $doc_status[0]->term_id, $st->term_id, false ) . '>' . $st->name . '</option>';
			}
			
			$html .= '</select></p>';
			
			}
			
			return $html;
    	}
    	
    	/**
    	 * doc_type function.
    	 * 
    	 * @access private
    	 * @return void
    	 */
    	public function doc_type( $show = 'name' ){
		
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
		 * taxonomies
		 * 
		 * @var mixed
		 * @access public
		 */
		$taxonomies = array(
			'wol-document-type',
		);
		
		/**
		 * args
		 * 
		 * @var mixed
		 * @access public
		 */
		$args = array(
		    'orderby'           => 'name',
		    'order'             => 'ASC',
		    'hide_empty'        => false,

		);
		
		/**
		 * status
		 * 
		 * (default value: get_terms( $taxonomies, $args ))
		 * 
		 * @var mixed
		 * @access public
		 */
		$type = get_terms( $taxonomies, $args );
		
		//$doc_status = wp_get_post_terms( absint( get_the_id(  ) ), 'wol-document-type' );
		
		/**
		 * doc_status
		 * 
		 * (default value: wp_get_post_terms( absint( get_the_id(  ) ), 'wol-document-status' ))
		 * 
		 * @var string
		 * @access public
		 */
		$doc_type = wp_get_post_terms( absint( get_the_id(  ) ), 'wol-document-type' );

		if ( ! empty( $type ) ){
			
			if ( 'name' == $show ){
				
				$html .= '<h3>' . __( 'Document type', 'wollyplugin' ) . '</h3>';
				$html .= $doc_type[0]->name;
				
				} elseif ( 'dropdown' == $show ){
			
					$html .= '<h3>' . __( 'Document type', 'wollyplugin' ) . '</h3>';
					$html .= '<p><select name="documents_type">';

					$html .= '<option value="0" ' . selected( $doc_type[0]->term_id, -1 ) . '>' . __( 'Select Document Type', 'wollyplugin' ) . '</option>';

					foreach ( $type as $st ){

						$html .= '<option value="' . $st->term_id . '" ' . selected( $doc_type[0]->term_id, $st->term_id, false ) . '>' . $st->name . '</option>';
					}
			
					$html .= '</select></p>';
			
			}
			
		}
			
		return $html;
    	
    	}

	
	}// chiudo la classe



}
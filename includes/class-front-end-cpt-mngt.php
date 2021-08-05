<?php
	
namespace Wolbusinessdesk\Includes;
 
	// If this file is accessed directory, then abort.
	if ( ! defined( 'WPINC' ) ) {
	    die;
	}
if ( ! class_exists( 'Wolbusinessdesk_Front_End_Cpt' ) ){
	
	/**
	 * Wolbusinessdesk_Front_End_Cpt class.
	 */
	class Wolbusinessdesk_Front_End_Cpt {
		
		/**
		 * cpt
		 * 
		 * @var mixed
		 * @access public
		 */
		var $cpt;
		
		/**
		 * id
		 * 
		 * @var mixed
		 * @access public
		 */
		var $id;
		
		public function __construct( $cpt = '', $id = 0 ){
			
			$this->cpt 	= $cpt;
			$this->id 	= $id;
		}
		
		public function add_cpt(){
			
			if ( post_type_exists( $this->cpt ) ){
				
				if ( isset($_POST['submit_cpt'] ) ){
					
					if ( $this->cpt == $_POST['submit_cpt'] ){
						
						if (  isset( $_POST[$this->cpt . '_nonce_name'] ) &&  wp_verify_nonce( $_POST[$this->cpt . '_nonce_name'], $this->cpt . '_nonce_action' ) ) {
							
							$this->save_cpt();
						}						
						
					}
					
				}
								
				
			} else {
				
				//return error
			}
			
		}
		
		public function edit_cpt(){
			
			if ( 0 < $this->id && is_numeric( $this->id ) ){
				
				
			} else {
				
				//return error
			}
			
			
		}
		
		public function delete_cpt(){
			
			
		}
		
		public function content_editor( $args = array() ){
			
			/**
			 * editor_id
			 * 
			 * (default value: $args['editor_id'])
			 * 
			 * @var string
			 * @access public
			 */
			$editor_id 		= $args['editor_id'];
			
			/**
			 * content
			 * 
			 * (default value: $args['content'])
			 * 
			 * @var string
			 * @access public
			 */
			$content 		= $args['content'];
			
			/**
			 * text_area_name
			 * 
			 * (default value: $args['text_area_name'])
			 * 
			 * @var string
			 * @access public
			 */
			$text_area_name = $args['text_area_name'];
			
			/**
			 * tabindex
			 * 
			 * (default value: $args['tabindex'])
			 * 
			 * @var string
			 * @access public
			 */
			$tabindex 		= $args['tabindex'];
									
			/**
			 * settings
			 * 
			 * @var mixed
			 * @access public
			 */
			$settings =   array(
			    'wpautop' 		=> true, // use wpautop?
			    'media_buttons' => false, // show insert/upload button(s)
			    'textarea_name' => $text_area_name, // set the textarea name to something different, square brackets [] can be used here
			    'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
			    'tabindex' 		=> $tabindex,
			    'editor_css' 	=> '', //  extra styles for both visual and HTML editors buttons,
			    'editor_class'	=> '', // add extra class(es) to the editor textarea
			    'teeny' 		=> false, // output the minimal editor config used in Press This
			    'dfw' 			=> false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
			    'tinymce' 		=> true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
			    'quicktags' 	=> true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
			);
			// Turn on the output buffer
			ob_start();
	
			// Echo the editor to the buffer
			wp_editor( $content, $editor_id, $settings );
	
			// Store the contents of the buffer in a variable
			$editor_contents = ob_get_clean();
			
			return $editor_contents;

			
			
		}
		
		private function save_cpt(){
			
			 $fields_list = FALSE;
			 
			switch ( $this->cpt ) {
				
				case 'wol-client':
				    $fields_list = wollyplugin()->company_info->client_fields();
				    break;
				
				default:
				    $fields_list = FALSE;
				    
			}
						
			if ( $fields_list && is_array( $fields_list ) ){
				
				/**
				 * custom_fields
				 * 
				 * (default value: array())
				 * 
				 * @var array
				 * @access public
				 */
				$custom_fields = array();
				
				/**
				 * title
				 * 
				 * (default value: 0)
				 * 
				 * @var int
				 * @access public
				 */
				$title = FALSE;
				foreach ( $fields_list as $key => $fl ){
					
					switch ( $fl['type'] ) {
				
						case 'title':
							$title = sanitize_text_field( $_POST[$key] );
							break;
							
						case 'text':
							$custom_fields[$key] = sanitize_text_field( $_POST[$key] );
							break;
				
						default:
						
					}
					
				}
									
				if (  $title ){
					
					$args = array(
						'post_title' => wp_strip_all_tags( $title ),
						'post_content' => '',
						'post_type'	=> $this->cpt,
						'post_status' => 'publish',
						'post_author' => get_current_user_id(  ),
						'meta_input' => $custom_fields,
						
					);
					
					$post_id = wp_insert_post( $args );
					
					$post_permalink = get_the_permalink( $post_id );
					
					echo "<meta http-equiv='refresh' content='0;url=$post_permalink' />"; exit;
				
				}
				
								
			}
			
			
		}
	}// END CLASS
}// END IF CLASS EXISTS

<?php
	
	if ( ! defined( 'ABSPATH' ) ) {
	    exit; // Exit if accessed directly
		}
	
	/**
	 * Wolly_Support_Term_Meta class.
	 */
	class Wolbusinessdesk_Term_Meta{
		
		
		public function __construct(){
			
			add_action( 'wol-ticket-status_add_form_fields', 
				array( 
					$this, 
					'colorpicker_field_add_to_ticket_status' 
			) );  // Variable Hook Name
			
			add_action( 'wol-ticket-status_edit_form_fields',
				array( 
					$this, 
					'colorpicker_field_ticket_status' 
			) );   // Variable Hook Name
			
			add_action( 'created_wol-ticket-status', 
				array( 
					$this, 
					'save_wol_ticket_status' 
			) );  // Variable Hook Name
			
			add_action( 'edited_wol-ticket-status', 
				array( 
					$this, 
					'save_wol_ticket_status' 
			) );  // Variable Hook Name
			
		}
		
		
		/**
		 * Add new colorpicker field to "Add new Category" screen
		 * - https://developer.wordpress.org/reference/hooks/taxonomy_add_form_fields/
		 *
		 * @param String $taxonomy
		 *
		 * @return void
		*/
		
		public function colorpicker_field_add_to_ticket_status( $taxonomy ) {
		
		?>
		
			<div class="form-field term-colorpicker-wrap">
		    		<label for="term-colorpicker">Category Color</label>
				<input name="_category_color" value="#ffffff" class="colorpicker" id="term-colorpicker" />
				<p>This is the field description where you can tell the user how the color is used in the theme.</p>
			</div>
		
		<?php
		
		}
		
		/**
		 * Add new colopicker field to "Edit Category" screen
		 * - https://developer.wordpress.org/reference/hooks/taxonomy_add_form_fields/
		 *
		 * @param WP_Term_Object $term
		 *
		 * @return void
		 */
		 public function colorpicker_field_ticket_status( $term ) {
		 
		    $color = get_term_meta( $term->term_id, '_category_color', true );
		    $color = ( ! empty( $color ) ) ? "#{$color}" : '#ffffff';
		 
		  ?>
		 
		    <tr class="form-field term-colorpicker-wrap">
		        <th scope="row"><label for="term-colorpicker">Severity Color</label></th>
		        <td>
		            <input name="_category_color" value="<?php echo $color; ?>" class="colorpicker" id="term-colorpicker" />
		            <p class="description">This is the field description where you can tell the user how the color is used in the theme.</p>
		        </td>
		    </tr>
		 
		  <?php
		 
		 	
		
		}
		
		/**
		 * Term Metadata - Save Created and Edited Term Metadata
		 * - https://developer.wordpress.org/reference/hooks/created_taxonomy/
		 * - https://developer.wordpress.org/reference/hooks/edited_taxonomy/
		 *
		 * @param Integer $term_id
		 *
		 * @return void
		 */
		public function save_wol_ticket_status( $term_id ) {
		
		    // Save term color if possible
		    if( isset( $_POST['_category_color'] ) && ! empty( $_POST['_category_color'] ) ) {
		        update_term_meta( $term_id, '_category_color', sanitize_hex_color_no_hash( $_POST['_category_color'] ) );
		    } else {
		        delete_term_meta( $term_id, '_category_color' );
		    }
		
		}
		
		
		
		
	}
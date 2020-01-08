<?php
	
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	
	


/**
 * Wpit_Products class.
 */
class Wolbusinessdesk_Document_Metaboxes {

	

	/**
	 * Wpit_Products_Companies::__construct()
	 * Locked down the constructor, therefore the class cannot be externally instantiated
	 *
	 * @param array $args various params some overidden by default
	 *
	 * @return
	 */

	public function __construct() {

			add_action( 'add_meta_boxes', array( $this, 'meta_box_client_document_add' ));
			
			//save meta boxes data
			add_action( 'save_post', array( $this, 'client_document_save' ) );
			


	}


	

	/**
	 * meta_box_products function.
	 *
	 * @access public
	 * @return void
	 */

	 // ! TODO AGGIUNGERE BOX ORGANIZZAZIONE
	public function meta_box_client_document_add() {
		
    		add_meta_box( 'wol_association', __( 'Associate standard document and client ', 'wolbusinessdesk' ) , array( $this , 'meta_box_client_document' ), 'wol-client-document', 'normal', 'high' );
    		add_meta_box( 'wol_placeholders', __( 'Allowed placeholders ', 'wolbusinessdesk' ) , array( $this , 'meta_box_client_document_placeholders' ), 'wol-client-document', 'side', 'high' );
    		add_meta_box( 'wol_placeholders', __( 'Allowed placeholders ', 'wolbusinessdesk' ) , array( $this , 'meta_box_client_document_placeholders' ), 'wol-document', 'side', 'high' );
    		
	}

	public function meta_box_client_document() {

		$args = array(
			'to'    => 'wol-document',
			'label' => 'document',
			'title' => __( 'Standard Document', 'wolbusinessdesk' ),
		);

		echo wol()->relationship->generate_single_relationship_code( $args );
		
		
		$args_clients = array(
			'to'    => 'wol-client',
			'label' => 'Client',
			'title' => __( 'Client', 'wolbusinessdesk' ),
		);

		echo wol()->relationship->generate_single_relationship_code( $args_clients );


    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'document_to_std_client_nonce', 'document_to_std_client_nonce' );
    ?>
    
    <?php

	}

	public function meta_box_client_document_placeholders(){
		
		
		$my_placeholders = wol()->company_info->company_fields();
		$client_placeholders = wol()->company_info->client_fields();
		
		echo '<h2>' . __( 'Your Company placeholders', 'wolbusinessdesk' ) . '</h2>';
		echo '<ul>';
		
		
		foreach ( $my_placeholders as $key => $my ){
			
			echo '<li>{{' . $key . '}}' . ' ' . $my['label']. '</li>';
			
			
		}
		echo '</ul>';
		
		echo '<h2>' . __( 'Client placeholders', 'wolbusinessdesk' ) . '</h2>';
		echo '<ul>';
		
		
		foreach ( $client_placeholders as $key => $my ){
			
			echo '<li>{{' . $key . '}}' . ' ' . $my['label']. '</li>';
			
			
		}
		echo '</ul>';
	}

	public function client_document_save( $post_id ){
				
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    		return;

    // if our nonce isn't there, or we can't verify it, bail
    if( ! isset( $_POST['document_to_std_client_nonce'] ) || ! wp_verify_nonce( $_POST['document_to_std_client_nonce'], 'document_to_std_client_nonce' ) )
    		return;

    // if our current user can't edit this post, bail
    if( ! current_user_can( 'edit_posts', $post_id ) )
    		return;
		
	if ( ! empty( $_POST['rel_wol-document']['to_id'] ) && is_numeric( $_POST['rel_wol-document']['to_id'] ) ){
    		
    		$args = array(
			'from'    => get_post_type( $post_id ),
			'to'      => $_POST['rel_wol-document']['to'],
			'from_id' => $post_id,
			'to_id'   => $_POST['rel_wol-document']['to_id'],
		);

		wol()->relationship->set_relationship( $args );
	}
	
	if ( ! empty( $_POST['rel_wol-client']['to_id'] ) && is_numeric( $_POST['rel_wol-client']['to_id'] ) ){
    		
    		$args = array(
			'from'    => get_post_type( $post_id ),
			'to'      => $_POST['rel_wol-client']['to'],
			'from_id' => $post_id,
			'to_id'   => $_POST['rel_wol-client']['to_id'],
		);

		wol()->relationship->set_relationship( $args );
	}
		
	}//close function




	

}// chiudo la classe


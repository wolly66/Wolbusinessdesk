<?php
	
	if ( ! defined( 'ABSPATH' ) ) {
	    exit; // Exit if accessed directly
		}
	
	


/**
 * wol_Products class.
 */
class Wolbusinessdesk_Metaboxes {

	

	/**
	 * wol_Products_Companies::__construct()
	 * Locked down the constructor, therefore the class cannot be externally instantiated
	 *
	 * @param array $args various params some overidden by default
	 *
	 * @return
	 */

	public function __construct() {

			add_action( 'add_meta_boxes', array( $this, 'meta_box_products_add' ));
			add_action( 'add_meta_boxes', array( $this, 'meta_box_registries_add' ));


			//save meta boxes data
			add_action( 'save_post', array( $this, 'products_save' ));
			add_action( 'save_post', array( $this, 'registries_save' ));


	}


	

	/**
	 * meta_box_products function.
	 *
	 * @access public
	 * @return void
	 */

	 // ! TODO AGGIUNGERE BOX ORGANIZZAZIONE
	public function meta_box_products_add() {
    add_meta_box( 'wol_products', __( 'Product', 'wolbusinessdesk') , array( $this , 'meta_box_products' ), 'products', 'normal', 'high' );
	}

	public function meta_box_products() {

    // $post is already set, and contains an object: the WordPress post
    global $post;

    //Extract meta
    $products = get_post_meta( $post->ID, 'wol_products_meta', true );


    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'wol_products_nonce', 'wol_products_nonce' );
    ?>
    <p>
			<ul>
				<li>

					<!-- I create an array for further add of meta boxes-->
					Prezzo IVA esclusa: <input type="text" name="product[prize]" class="product" id="product" value="<?php echo $products['prize'] ?>">
				</li>
			</ul>
		</p>


    <?php

	}


	public function products_save( $post_id ){
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    	return;

    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['wol_products_nonce'] ) || !wp_verify_nonce( $_POST['wol_products_nonce'], 'wol_products_nonce' ) )
    	return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) )
    	return;


    // Make sure your data is set before trying to save it
    if( isset( $_POST['product'] )   ){
		update_post_meta( $post_id, 'wol_products_meta',  $_POST['product']  );
		}
	}//close function


	/**
	 * meta_box_products function.
	 *
	 * @access public
	 * @return void
	 */

	 // ! TODO AGGIUNGERE BOX ORGANIZZAZIONE
	public function meta_box_registries_add() {
    add_meta_box( 'wol-registries', __( 'Registry', 'wolbusinessdesk') , array( $this , 'meta_box_registries' ), 'wol-registry', 'normal', 'high' );
	}

	public function meta_box_registries() {

    // $post is already set, and contains an object: the WordPress post
    global $post;

    //Extract meta
    $company = get_post_meta( $post->ID, 'wol_registries_meta', true );
        // We'll use this nonce field later on when saving.
    wp_nonce_field( 'wol_registries_nonce', 'wol_registries_nonce' );
    
	}




	public function registries_save( $post_id ){
		
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    	return;

    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['wol_registries_nonce'] ) || !wp_verify_nonce( $_POST['wol_registries_nonce'], 'wol_registries_nonce' ) )
    	return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) )
    	return;


    // Make sure your data is set before trying to save it
    if( isset( $_POST['company'] )   ){


    	if ( ! empty ( $_POST['company']['end'] ) ){
	    	
	    

    	$_POST['company']['end'] =  $_POST['company']['end'];
    	
    	

    	}
		
		update_post_meta( $post_id, 'wol_registries_meta',  $_POST['company']  );
		
		}

	}//close function

	

}// chiudo la classe


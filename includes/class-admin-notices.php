<?php
/**
 * This class manage admin notices
 *
 * @package WPIT Premiums plugins
 * @subpackage manage all admin notices
 */

 class Wolbusinessdesk_Admin_Notices {

  	var $type = null;
 	var $is_dismissible = null;
 	var $message = null;
 	var $page = null;

 	/**
 	 * __construct function.
 	 *
 	 * @access public
 	 * @param mixed $arguments
 	 * @return void
 	 */
 	public function __construct( $arguments ) {

	 	if ( ! is_array( $arguments ) ){

		 	return;

	 	} else {

	 		if ( empty( $arguments['type'] ) ){

			 	$this->type = 'updated';

	 		} else {

	 		$this->type = $arguments['type'];

	 		}

	 		if ( empty( $arguments['is-dismissible'] ) ){

			 	$this->is_dismissible = '';

	 		} else {

	 		$this->is_dismissible = $arguments['is-dismissible'];

	 		}

	 		if ( empty( $arguments['message'] ) ){

			 	$this->message = __( ' Message not provided', 'wpitbase' );

	 		} else {

	 		$this->message = $arguments['message'];

	 		}

	 		if ( empty( $arguments['page'] ) ){

			 	$this->page = '';

	 		} else {

	 		$this->page = $arguments['page'];

	 		}

	 		add_action( 'admin_notices', array( $this, 'notice' ) );
 		}
 	}

 	public function notice(){

	?>
    <div class="notice <?php echo $this->type; ?> <?php echo $this->is_dismissible; ?>">
        <p><?php echo $this->message; ?></p>
    </div>

    <?php

 	}

 }// chiudo la classe


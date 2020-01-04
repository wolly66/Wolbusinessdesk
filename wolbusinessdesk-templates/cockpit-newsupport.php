<div class="wol-new-ticket">
	

	<?php	if ( is_user_logged_in() && ( current_user_can( 'wol_add_new_ticket' ) ) ){
		
		// ! TODO DEBUG DA RIMUOVERE
		echo '<pre>pippo' . print_r( $_POST , 1 ) . '</pre>';
	
		?>
	
		<?php $user_data	= get_userdata( get_current_user_id() ); ?>
		<?php $company		= get_user_meta( $user_data->ID, 'company_associata', true ); ?>
	
		<div class="row">
			<div class="col-md-12 inex-user-name">
				<p><?php echo _e( 'Welcome', 'wolbusinessdesk' ) . ' ' . $user_data->display_name ?></p>
			</div>
		</div>
			<!-- Create new form and open it, here is where the magic happen! -->
			<?php wol_new_ticket_new_form(); ?> 
			<?php wol_new_ticket_open_form(); ?>
			 
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php wol_new_ticket_boards(); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php wol_new_ticket_type(); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php wol_new_ticket_priority(); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php wol_new_ticket_status(); ?>
				</div>
			</div>
			<div class="row top-buffer">
				<div class="col-md-12">
					<p><?php wol_new_ticket_title(); ?></p>
	
					<p><?php wol_new_ticket_content(); ?></p>
	
					<p align="right"><?php wol_new_ticket_submit(); ?></p>
					
					<?php wol_new_ticket_hidden(); ?>
					
					<!-- Security, if you delete this, the sky will fall! -->
					<?php wol_new_ticket_nonce(); ?>
				</div>
			</div>
			<!-- Here we close the form, here is where the magic end! -->
			<?php wol_new_ticket_close_form(); ?>
	<?php
	
		if(	isset( $_POST['wol-submit'] ) ){
			die();
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
	
		}	?>
	
</div>
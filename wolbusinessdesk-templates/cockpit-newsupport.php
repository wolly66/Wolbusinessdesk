<div class="wol-new-ticket">
	

		<?php $user_data	= get_userdata( get_current_user_id() ); ?>
		<?php $company		= get_user_meta( $user_data->ID, 'company_associata', true ); ?>
	
		<div class="row">
			<div class="col-md-12 inex-user-name">
				<p><?php echo _e( 'Welcome', 'wolbusinessdesk' ) . ' ' . $user_data->display_name ?></p>
			</div>
		</div>
			<!-- Create new form and open it, here is where the magic happen! --> 
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
	
					<p align="left"><?php wol_new_ticket_submit(); ?></p>
					
					<?php wol_new_ticket_hidden(); ?>
					
					<!-- Security, if you delete this, the sky will fall! -->
					<?php wol_new_ticket_nonce(); ?>
				</div>
			</div>
			<!-- Here we close the form, here is where the magic end! -->
			<?php wol_new_ticket_close_form(); ?>

	
</div>
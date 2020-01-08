<div class="wol-new-crm">
		<?php $user_data	= get_userdata( get_current_user_id() ); ?>
		<?php $company		= get_user_meta( $user_data->ID, 'company_associata', true ); ?>
		
		<?php wol_add_cpt( 'wol-crm' ); ?>
		<div class="row">
			<div class="col-md-12 inex-user-name">
				<h2><?php _e( 'Add new task', 'wolbusinessdesk' ); ?></h2>
				<p><?php echo _e( 'Welcome', 'wolbusinessdesk' ) . ' ' . $user_data->display_name ?></p>
			</div>
		</div>
			<!-- Create new form and open it, here is where the magic happen! --> 
			<?php wol_new_new_task_open_form(); ?>
			 
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php wol_new_task_type(); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php wol_new_task_action(); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php wol_new_task_status(); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
				</div>

			</div>
			<div class="row top-buffer">
				<div class="col-md-12">
					<p><?php wol_new_task_title(); ?></p>
	
					<p><?php wol_new_task_content(); ?></p>
					<p><?php _e( 'Due date & time:', 'wolbusinessdesk' ); ?></p>
					<p><?php wol_new_task_due_date(); ?> <?php wol_new_task_due_hour(); ?> <?php wol_new_task_due_minutes(); ?></p>
	
					<p align="left"><?php wol_new_task_submit(); ?></p>
					
					<?php wol_new_task_hidden(); ?>
					
					<!-- Security, if you delete this, the sky will fall! -->
					<?php wol_new_task_nonce(); ?>
				</div>
			</div>
			<!-- Here we close the form, here is where the magic end! -->
			<?php wol_new_task_close_form(); ?>

	
</div>
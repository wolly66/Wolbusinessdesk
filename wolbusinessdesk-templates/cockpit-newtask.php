<div class="wol-new task">
	
	<h2><?php _e( 'Add new task', 'wolbusinessdesk' ); ?></h2>
	
	<?php wol_add_cpt( 'wol-crm' ); ?>
	
	<form name="new-task" method="post" action="">
		
		<?php wol_new_task_nonce(); ?>
		
		<?php wol_task_field(); ?>
		
		
		<input type="hidden" name="submit_cpt" value="wol-crm" />
		<input type="submit" name="submit" class="button" value="<?php _e( 'New', 'wolbusinessdesk' ); ?>" />
		
		
	</form>
	
	
</div>
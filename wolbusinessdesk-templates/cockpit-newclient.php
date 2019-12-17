<div class="wol-new client">
	
	<h2><?php _e( 'Add new client', 'wolbusinessdesk' ); ?></h2>
	
	<?php wol_add_cpt( 'wol-client' ); ?>
	
	<form name="new-client" method="post" action="">
		
		<?php wol_new_client_nonce(); ?>
		
		<?php wol_client_field(); ?>
		
		
		<input type="hidden" name="submit_cpt" value="wol-client" />
		<input type="submit" name="submit" class="button" value="<?php _e( 'New', 'wolbusinessdesk' ); ?>" />
		
		
	</form>
	
	
</div>
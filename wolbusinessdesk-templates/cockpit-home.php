<?php $query = wol_get_cockpit_home_query(); ?>
		

	<?php /* Start the Loop */
	while ( $query->have_posts() ) : $query->the_post(); ?>
	
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<div class="archive-single-ticket container">
						
			<div class="row row-eq-height top-buffer">
														
				<div class="col-md-2 col-sm-2 col-xs-12">
								
					<span class="label label-default" ><?php $postType = get_post_type_object(get_post_type());
if ($postType) {
    echo esc_html($postType->labels->singular_name);
} ?></span>
								
				</div>
							
				<div class="wol-title col-md-6 col-sm-6 col-xs-12">
								
					<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
								
				</div>
							
				<div class="wol-ticket-author col-md-4">
								
					<?php _e( 'Ticket Author: ', 'wolbusinessdesk' ); ?>
					<?php the_author(); ?>
					<?php _e( 'On: ', 'wolbusinessdesk' ); ?>
					<?php the_date(); ?>
								
				</div>
								
						
		</div>
						
		<hr class="wol-separator">
						
		<div class="row">
			
			<div class="col-md-1 col-sm-2 col-xs-2">
				
				<span class="wol-little-title"><?php _e( 'Nr: ', 'wolbusinessdesk' ); ?></span><br />
				
					<?php wol_ticket_ticket_number(); ?>
			
			</div>
			
			<div class="col-md-1 col-sm-2 col-xs-12 wol-owner">
				
			    		<span class="wol-little-title"><?php _e( 'Agent: ', 'wolbusinessdesk' ); ?></span>
			    		
						<?php wol_ticket_owner_list_meta(); ?>
			</div>
			
			<div class="col-md-2 col-sm-2 col-xs-12 wol-last-reply-date">
				
			    		<span class="wol-little-title"><?php _e( 'Last reply Date: ', 'wolbusinessdesk' ); ?></span>
			    		
						<?php wol_ticket_ticket_last_reply_date(); ?>
			</div>
			
			<div class="col-md-2 col-sm-2 col-xs-12 wol-last-reply-author">
				
			   	 	<span class="wol-little-title"><?php _e( 'Last reply Author: ', 'wolbusinessdesk' ); ?></span>
			   	 	
			   	 	<?php wol_ticket_ticket_last_reply_author(); ?>
			</div>
			
			<div class="col-md-2 col-sm-2 col-xs-12 wol-ticket-age">
			    
			    		<span class="wol-little-title"><?php _e( 'Age: ', 'wolbusinessdesk' ); ?></span>
				
						<?php wol_ticket_ticket_age(); ?>
			</div>
			
			<div class="col-md-2 col-sm-2 col-xs-12 wol-reply-number">
			    
			    		<span class="wol-little-title"><?php _e( 'Nr. Replies: ', 'wolbusinessdesk' ); ?></span>
						
						<?php wol_ticket_ticket_reply_number(); ?>
			</div>
			
			<div class="col-md-1 col-sm-2 col-xs-12 wol-type">
				
				<span class="wol-little-title"><?php _e( 'Type: ', 'wolbusinessdesk' ); ?></span>
					
					<?php wol_ticket_type_meta(); ?>
			
			</div>
			
			<div class="col-md-1 col-sm-2 col-xs-12 wol-priority">
				
				<span class="wol-little-title"><?php _e( 'Priority: ', 'wolbusinessdesk' ); ?></span>
				
					<?php wol_ticket_priority_meta(); ?>
			
			</div>
		
		</div>
						                                  
	</div>
     
</div>			
	<?php endwhile; // End of the loop. ?>


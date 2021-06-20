<?php get_header(); ?>

<div class="container">
	<div id="content" role="main">
		<section class="wol-support"> 
			<?php // ! TODO DEBUG DA RIMUOVERE
			//echo '<pre>' . print_r( $_POST , 1 ) . '</pre>';
			//echo '<pre>' . print_r( $wp_query , 1 ) . '</pre>'; ?>
			<div class="archive-filter-ticket container">
				
				<?php wol_ticket_archive_open_form(); ?>
						
					<div class="row input-group">
						<div class="col-md-3 col-sm-4 col-sx-12">
								<?php  wol_ticket_archive_type_dropdown( __( 'All', 'wolbusinessdesk' ) ); ?>
						</div>
						
						<div class="col-md-3 col-sm-4 col-sx-12">
								<?php wol_ticket_archive_priority_dropdown( __( 'All', 'wolbusinessdesk' ) ); ?>
						</div>
								
						<div class="col-md-3 col-sm-4 col-sx-12">
								<?php wol_ticket_archive_status_operator_dropdown(); ?>
								<?php wol_ticket_archive_status_dropdown(); ?>
						</div>
						
						<div class="col-md-3 col-sm-4 col-sx-12">
							<label for="author" class="wol-little-title"><?php _e( 'Ticket Author', 'wolbusinessdesk' ); ?></label><br />
								<input type="hidden" value="" name="author" />
							</div>
						</div>
						<?php wol_ticket_archive_nonce(); ?>
						<div class="row top-buffer">
							<div class="col-md-12 text-center">
								
									<input class="button-primary btn" type="submit" id="wol_filter" name="wol_filter" value="<?php _e( 'Filter', 'wolbusinessdesk' ); ?>" />
									<input class="button-primary btn" type="submit" id="wol_reset" name="wol_reset" value="<?php _e( 'Reset', 'wolbusinessdesk' ); ?>" />
								
								<input class="button-primary" type="hidden" id="wol_category_filter" name="wol_category_filter" value="0" />
								<input class="button-primary" type="hidden" id="wol_category_list_filter" name="wol_category_list_filter" value="" />
								<div id="resultticketlist"></div>
							</div>
						</div>
				</form> 
			</div>      
	    <?php
		    
			if ( have_posts() ) :
				
				while ( have_posts() ) : the_post(); ?>
					
					<div class="archive-single-ticket container">
						
						<div class="row row-eq-height top-buffer">
														
							<div class="wol-status col-md-2 col-sm-2 col-xs-12">
								
								<span class="label label-default wol-status" style="background-color: <?php wol_ticket_status_color_meta(); ?>; padding: 5px;"><?php wol_ticket_status_name_meta(); ?></span>
								
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
					
					
              
            	<?php endwhile;
	            	
	            	wol_ticket_archive_navigation();
			
			else:
				_e( 'No results', 'wolbusinessdesk' );	
			endif;
			
		?>
		</section>
    	<?php //get_sidebar();?>
	</div><!--/content-->
</div><!--/container-->

<?php get_footer(); ?>

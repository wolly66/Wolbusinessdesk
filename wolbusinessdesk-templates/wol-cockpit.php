<?php
	
/* Template Name: Wolly Plugin Cockpit */

/* https://startbootstrap.com/templates/simple-sidebar/ */


get_header();
?>
	<div class="d-flex" id="wrapper">
			
		<?php wol_get_template_part( 'sidebar', 'cockpit' ); ?>
		<!-- Page Content -->
		<div id="page-content-wrapper">

    			<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
				<button class="btn btn-primary" id="menu-toggle"><?php _e( 'Toggle Menu', 'wolbusinessdesk' ); ?></button>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
						<li class="nav-item active">
							<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
							</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php wol_add_new_task(); ?>"><?php _e( 'New Task', 'wolbusinessdesk' ); ?></a>
							</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?php _e( 'Common action', 'wolbusinessdesk' ); ?>
              				</a>
			  				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
			  					<a class="dropdown-item" href="<?php wol_add_new_client(); ?>"><?php _e( 'New Client', 'wolbusinessdesk' ); ?></a>
			  					<a class="dropdown-item" href="<?php wol_add_new_client_document(); ?>"><?php _e( 'New Client Document', 'wolbusinessdesk' ); ?></a>
			  					<div class="dropdown-divider"></div>
			  						<a class="dropdown-item" href="#">Something else here</a>
              				</div>
			  				</li>
			  		</ul>
        			</div>
      		</nav>

	  	<div class="container-fluid">
	    		<?php /* Start the Loop */
			while ( have_posts() ) :	the_post(); ?>
			
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
					
					<?php wol_cockpit_page(); ?>
					
				</div>      
			</div>			
			<?php endwhile; // End of the loop. ?>

		</div>
    </div>
    <!-- /#page-content-wrapper -->

			

					 	
											
		
</div><!-- #primary -->

<?php
	
get_footer();

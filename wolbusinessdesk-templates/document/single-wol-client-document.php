<?php
/**
 * The template for displaying all single wol-ticket
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
 
get_header(); ?>
 
    <div id="primary" class="content-area container">
        <main id="main" class="site-main" role="main">
 
        <?php if ( wol_doc_can_view() ): ?>
        
        	<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); 
 
            	/*
            	 * Include the post format-specific template for the content. If you want to
            	 * use this in a child theme, then include a file called called content-___.php
            	 * (where ___ is the post format) and that will be used instead.
            	 */
            	//get_template_part( 'content', get_post_format() ); ?>
            	
            	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 				
					<header class="entry-header">
						<?php wol_doc_the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    					</header><!-- .entry-header -->
  				
					<div class="entry-content">
						<form id="edit_client_document" name="edit_client_document-ticket" method="post" action="" class="edit_client_document">
						<?php wol_doc_the_content(); ?>
						
						<?php wol_doc_modify_client_document() ?>
						<p align="left"><input type="submit" value="<?php _e( 'Edit', 'wolbusinessdesk' ); ?>" tabindex="6"  name="submit" class="search-submit" /></p>
						</form>
    					</div><!-- .entry-content -->
 				
				
				</article><?php
 
			// End the loop.
			endwhile;
        
			else:// cannot view
        
        		wol_doc_cannot_view();
        
        endif; ?>
 
        </main><!-- .site-main -->
    </div><!-- .content-area -->
 
<!-- #post-## -->
 
 
<?php get_footer(); ?>
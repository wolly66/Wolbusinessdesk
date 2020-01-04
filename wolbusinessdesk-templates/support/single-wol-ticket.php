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
 
        <?php
	        
	        echo wolbusinessdesk()->support_check->can_view_html();
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
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    				</header><!-- .entry-header -->
  
				<div class="entry-content">
					<?php the_content(); ?>
					
    				</div><!-- .entry-content -->
 
				<?php edit_post_link( __( 'Edit', 'wolbusinessdesk' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

				<?php  wol_support_ticket_reply_loop(); ?>
					 
					
			</article><?php
 
        // End the loop.
        endwhile;
        ?>
 
        </main><!-- .site-main -->
    </div><!-- .content-area -->
 
<!-- #post-## -->
 
 
<?php get_footer(); ?>
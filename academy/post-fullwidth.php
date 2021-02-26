<?php
/**
 * Template Name: Full Width Post
 * Template Post Type: post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wpAcademy
 */

get_header();
get_search_form();
?>

    <style type="text/css"> 
    .content-area {
    	width: 100%;
    }
    .search-form{
    	margin: 1rem;
    }	
    .post-widget{
    	width: 100%;
    	text-align: center;
    }
	</style>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

    
<div class="post-widget"> <?php the_widget( 'WP_Widget_Meta' );?> </div>  
<?php
get_footer();

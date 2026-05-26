<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Travel_Agency_Pro
 */

get_header(); ?>

<main class="contentSection">
        <section class="content-container">

    		<?php
    		while ( have_posts() ) : the_post();
    
    			get_template_part( 'template-parts/content', 'team' );
                
    		endwhile; // End of the loop.
    		?>

		</section><!-- #main -->
	</main><!-- #primary -->

<?php
get_footer();

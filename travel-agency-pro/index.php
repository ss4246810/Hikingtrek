<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Travel_Agency_Pro
 */

get_header(); ?>

<div class="body-contentContainer">
   <div class="container main-content" data-sticky-sidebar-container>
	<div class="bg-white">
    	<div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8">
					<?php
					if ( have_posts() ) :

						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );
							echo '<a href="' . esc_url( get_the_permalink() ) . '" class="btn-more">' . esc_html( travel_agency_pro_get_readmore_btn() ) . '</a>';
								echo '<hr>';

						endwhile;

						/**
			             * Navigation
			             * 
			             * @hooked travel_agency_pro_pagination
			            */
			            do_action( 'travel_agency_pro_after_content' );
			            
					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>
					<?php 
                if (function_exists("pagination")) {
                echo  "<ul class=\"pagination\">";
                pagination($args->max_num_pages);
                echo "</ul>
                ";
                } 
                wp_reset_query();
                ?>
			</div>
         	<div class="col-xs-12 col-sm-4 col-md-4">
                  <?php get_sidebar(); ?>              
            </div>
          </div>
       </div>
	</div>
</div>
<?php
//get_sidebar();
get_footer();

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
            <div class="page-breadcrumb">
                    <?php /*if (simple_fields_fieldgroup('breadcrumb_image')){ 
                    $detailbannerimg=wp_get_attachment_image_url(simple_fields_fieldgroup('breadcrumb_image'), 'full');
                    } else { */
                    $detailbannerimg = get_template_directory_uri().'/assets/img/breadcrumb-banner.jpg';
                    //} ?>
                    <div class="breadcrumb-container" style="background-image: url(<?php echo $detailbannerimg; ?>);">
                    <div class="bg-overlay"></div>
                    <div class="container">
                    <div class="table-row">
                        <div class="table-cell">
                        <div class="text-center page-heading-label">
                            <h1><?php the_title(); ?></h1>
                            <?php if ( has_excerpt( $post->ID ) ) { ?>
                            <p><?php the_excerpt($post->ID); ?></p>
                            <?php } ?>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
                <?php
            while ( have_posts() ) : the_post();
            ?>
            <div class="body-contentContainer">
                <div class="container main-content">
                    <div class="bg-white">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-8">
                            <div class="pckg-body">
                                <div class="pckg-header">
                                    <h2><?php the_title(); ?></h2>
                                </div>
                                <div class="pckg-overview">
                                    <?php the_content(); ?>
                                </div>
                              
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 sidebarDesktop-only">
                        <?php get_sidebar(); ?>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <?php 
            endwhile; // End of the loop.
            ?>
        </section>
    </main>

<?php /* ?>	<div id="primary" class="content-area">
		<main id="main" class="site-main">
    		<?php
    		while ( have_posts() ) : the_post();
    			get_template_part( 'template-parts/content', get_post_format() );
                do_action( 'travel_agency_pro_after_post_content' );
    		endwhile; // End of the loop.
    		?>
		</main>
	</div>
    <?php */ ?>

<?php
get_footer();

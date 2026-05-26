<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Travel_Agency_Pro
 */

get_header(); ?>
 <main class="contentSection">
        <section class="content-container">
            <div class="page-breadcrumb">
                    <?php if (simple_fields_fieldgroup('breadcrumb_image')){ 
                    $detailbannerimg=wp_get_attachment_image_url(simple_fields_fieldgroup('breadcrumb_image'), 'full');
                    } else { 
                    $detailbannerimg = get_template_directory_uri().'/assets/img/breadcrumb-banner.jpg';
                    } ?>
                    <div class="breadcrumb-container" style="background-image: url(<?php echo $detailbannerimg; ?>);">
                    <div class="bg-overlay"></div>
                    <div class="container">
                    <div class="table-row">
                        <div class="table-cell">
                        <div class="text-center page-heading-label">
                            <h1>Page Not Found</h1>
                            <p>Can&rsquo;t find what you need? Take a moment and do a search below or start from our</p>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
            <div class="body-contentContainer">
                <div class="container main-content" data-sticky-sidebar-container>
                    <div class="bg-white">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-8">
                            <div class="pckg-body">
								<h2><?php esc_html_e( 'Sorry, The Page Not Found', 'travel-agency-pro' ); ?></h2>
								<p><?php esc_html_e( 'Can&rsquo;t find what you need? Take a moment and do a search below or start from our', 'travel-agency-pro' );?> 
								<a href="<?php echo esc_url( home_url('/') ); ?>"><?php echo esc_html__( 'Homepage', 'travel-agency-pro' ); ?></a></p>
								  <?php  get_search_form(); ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 sidebarDesktop-only">
                        <?php get_sidebar(); ?>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
    <?php 
get_footer();
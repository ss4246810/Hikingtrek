<?php
/**
 * Template Name: Contact Page Old
 * 
 * @package Travel_Agency_Pro
 */

get_header(); 

    /**
     * Contact Page Hook
     * 
     * @hooked travel_agency_pro_google_map   - 15
     * @hooked travel_agency_pro_contact_info - 20
     * @hooked travel_agency_pro_contact_form - 25
    */
    ?>
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
                            <h1><?php the_title(); ?></h1>
                            <?php if ( has_excerpt( $post->ID ) ) { ?>
                            <p><?php the_excerpt(); ?></p>
                            <?php } ?>
                        </div>
                        </div>
                    </div>
                    </div>
                	</div>
                </div>
             </div>
    <?php
    do_action( 'travel_agency_pro_contact_page' );
    ?>
    </section>
    </main>
<?php
get_footer();
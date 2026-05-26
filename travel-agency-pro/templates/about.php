<?php
/**
 * Template Name: About Page
 * 
 * @package Travel_Agency_Pro
 */

get_header(); 
?>
 <main class="contentSection">
        <section class="content-container">
        		<div class="page-breadcrumb">
                    <?php /*if (simple_fields_fieldgroup('breadcrumb_image')){ 
                    $detailbannerimg=wp_get_attachment_image_url(simple_fields_fieldgroup('breadcrumb_image'), 'full');
                    } else { */
                    $detailbannerimg = get_template_directory_uri().'/assets/img/breadcrumb-banner.jpg';
                   // } ?>
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
                <div class="body-contentContainer">
				<?php
				//$about_sections = get_theme_mod( 'about_sort', array( 'intro', 'clients', 'feature', 'services', 'stats', 'testimonials', 'team' ) );
				$about_sections = get_theme_mod( 'about_sort', array( 'intro','feature', 'testimonials', 'team' ) );

				if( $about_sections ){
				foreach( $about_sections as $about ){
					if($about!='clients' && $about!='services' && $about!='stats' && $about!='testimonials'){
					get_template_part( 'sections/about/' . esc_attr( $about ) );
					}
				  }
				}    
				?>
            </div>
 </div>
</section>
</main>
<?php   
get_footer();
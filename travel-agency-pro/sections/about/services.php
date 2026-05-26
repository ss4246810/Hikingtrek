<?php
/**
 * About Services Section
 * 
 * @package Travel_Agency_Pro
 */

$title   = get_theme_mod( 'service_about_title', __( 'Our Services', 'travel-agency-pro' ) );
$content = get_theme_mod( 'service_about_desc', __( 'Show the services provided to your customers here. You can customize this section from Appearance > Customize > About Page Settings > Service Section.', 'travel-agency-pro' ) );
$services = get_theme_mod( 'services_about', travel_agency_pro_get_customizer_defaults( 'services' ) );

if( $title || $content || $services ){ ?>
<section id="service_section" class="services">
	<div class="container">
		<?php 
            if( $title || $content ){
                echo '<header class="section-header">';
                if( $title ) echo '<h2 class="section-title">' . esc_html( travel_agency_pro_get_about_service_title() ) . '</h2>';
                if( $content ) echo '<div class="section-content">' . wp_kses_post( travel_agency_pro_get_about_service_sub_title() ) . '</div>';
                echo '</header>';
            }
            
            if( $services ){
                echo '<div class="grid">';
                foreach( $services as $service ){
                    echo '<div class="col">';
        				if( $service['image'] ){
        				    $img_url = ( ctype_digit( $service['image'] ) ) ? wp_get_attachment_image_url( $service['image'], 'full' ) : $service['image'];                         
                            echo '<div class="icon-holder"><img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $service['title'] ) . '"></div>';
        				}
                        if( $service['title'] || $service['content'] ){        				
                            echo '<div class="text-holder">';
        					if( $service['title'] ) echo '<h3 class="service-title">' . esc_html( $service['title'] ) . '</h3>';
        					if( $service['content'] ) echo wpautop( wp_kses_post( $service['content'] ) );
        				    echo '</div>';
                        }
        			echo '</div>';
                }
                echo '</div>';
            }            
        ?>        
	</div>
</section>
<?php
}
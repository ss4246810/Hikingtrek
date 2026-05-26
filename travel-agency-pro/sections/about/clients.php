<?php
/**
 * About Client Section
 * 
 * @package Travel_Agency_Pro
 */

$title   = get_theme_mod( 'about_client_title', __( 'Associated With', 'travel-agency-pro' ) );
$clients = get_theme_mod( 'about_clients', travel_agency_pro_get_customizer_defaults( 'team' ) );

if( $title || $clients ){ ?>
<section class="clients" id="about_clients">
	<div class="container">
		<?php 
            if( $title ) echo '<header class="section-header"><h2 class="section-title">' . esc_html( travel_agency_pro_get_about_client_title() ) . '</h2></header>';
            
            if( $clients ){
                echo '<div id="clients-slider" class="owl-carousel">';
                foreach( $clients as $client ){
                    if( $client['image'] ){
                        echo '<div class="item">';
                        echo ( isset( $client['link']) && !empty( $client['link'] ) ) ? '<a href="' . esc_url( $client['link'] ) . '" class="img-holder" target="_blank">' : '<div class="img-holder">';
                        $img_url = ( ctype_digit( $client['image'] ) ) ? wp_get_attachment_image_url( $client['image'], 'full' ) : $client['image'];
                        echo '<img src="' . esc_url( $img_url ) . '">';
                        echo ( isset( $client['link']) && !empty( $client['link'] ) ) ? '</a>' : '</div>';
            			echo '</div>';
                    }
                }
                echo '</div>';
            }
        ?>
	</div>
</section>
<?php
}
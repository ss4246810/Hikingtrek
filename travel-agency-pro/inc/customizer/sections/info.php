<?php
/**
 * Travel Agency Theme Info
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customizer_theme_info( $wp_customize ) {
	
    $wp_customize->add_section( 'theme_info', array(
		'title'       => __( 'Video Documentation & Demo' , 'travel-agency-pro' ),
		'priority'    => 6,
	) );
    
    /** Important Links */
	$wp_customize->add_setting( 'theme_info_theme',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $theme_info = '<p>';
	$theme_info .= sprintf( __( 'You can use this theme to create an online travel booking website like the %1$sdemo here.%2$s', 'travel-agency-pro' ),  '<a href="' . esc_url( 'https://raratheme.com/previews/?theme=travel-agency-pro' ) . '" target="_blank">', '</a>' );
    $theme_info .= sprintf( __( 'Please make sure to install the %1$srecommended plugins.%2$s', 'travel-agency-pro' ),  '<a href="' . esc_url( 'https://raratheme.com/documentation/travel-agency-pro-documentation/#Installing_Recommended_Plugins' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p><p>';
    $theme_info .= sprintf( __( 'For step-by-step videos and text tutorials, check the %1$stheme documentation page.%2$s', 'travel-agency-pro' ),  '<a href="' . esc_url( 'https://raratheme.com/documentation/travel-agency-pro/' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p><p>';    
    $theme_info .= sprintf( __( 'Please feel free to %1$scontact us here%2$s if you have any questions or need any support.', 'travel-agency-pro' ),  '<a href="' . esc_url( 'https://raratheme.com/support-ticket/' ) . '" target="_blank">', '</a>' );    
    $theme_info .= '</p>';

	$wp_customize->add_control( new Travel_Agency_Pro_Info_Text( $wp_customize,
        'theme_info_theme', 
            array(
                'section'     => 'theme_info',
                'description' => $theme_info
            )
        )
    );
    
    /** Changing priority for static front page */
    $wp_customize->get_section( 'static_front_page' )->priority = 99;
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    
}
add_action( 'customize_register', 'travel_agency_pro_customizer_theme_info' );

if ( class_exists( 'WP_Customize_control' ) ) {

	class Travel_Agency_Pro_Info_Text extends Wp_Customize_Control {
		
		public function render_content(){ ?>
    	    <span class="customize-control-title">
    			<?php echo esc_html( $this->label ); ?>
    		</span>
    
    		<?php if( $this->description ){ ?>
    			<span class="description customize-control-description">
    			<?php echo wp_kses_post($this->description); ?>
    			</span>
    		<?php }
        }
	}
}
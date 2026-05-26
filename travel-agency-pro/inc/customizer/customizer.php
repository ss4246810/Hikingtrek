<?php                                                
/**
 * Travel Agency Theme Customizer
 *
 * @package Travel_Agency_Pro
 */
$travel_agency_pro_panels   = array( 'header', 'home', 'about', 'contact', 'general', 'typography' );
$travel_agency_pro_sections = array( 'info', 'team', 'trip', 'sidebar', 'scheme', 'footer' );
$travel_agency_pro_sub_sections = array(
    'header'     => array( 'layout', 'misc', 'social' ),
    'home'       => array( 'slider', 'search', 'testimonial', 'blog', 'client', 'sort' ),
    'about'      => array( 'intro', 'client', 'feature', 'services', 'stats', 'testimonial', 'team', 'sort' ),
    'contact'    => array( 'map', 'info', 'form' ),   
    'general'    => array( 'basic', 'seo', 'post-page', 'archive', 'share', 'background' ), 
    'typography' => array( 'body', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
    
);

foreach( $travel_agency_pro_sections as $s ){
    require get_template_directory() . '/inc/customizer/sections/' . $s . '.php';
}

foreach( $travel_agency_pro_panels as $p ){
   require get_template_directory() . '/inc/customizer/panels/' . $p . '.php';
}

foreach( $travel_agency_pro_sub_sections as $k => $v ){
    foreach( $v as $w ){        
        require get_template_directory() . '/inc/customizer/panels/' . $k . '/' . $w . '.php';
    }
}

/**
 * Reset Theme Options
*/
require get_template_directory() . '/inc/customizer/customizer-reset/customizer-reset.php';

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function travel_agency_pro_customize_preview_js() {
	wp_enqueue_style( 'travel-agency-customizer', get_template_directory_uri() . '/inc/css/customizer.css', array(), TAP_THEME_VERSION );
    wp_enqueue_script( 'travel_agency_pro_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview', 'customize-selective-refresh' ), TAP_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'travel_agency_pro_customize_preview_js' );

function travel_agency_pro_customize_script(){
    wp_enqueue_style( 'travel-agency-pro-customize', get_template_directory_uri() . '/inc/css/customize.css', array(), TAP_THEME_VERSION );
    wp_enqueue_script( 'travel_agency_pro_customize', get_template_directory_uri() . '/inc/js/customize.js', array( 'jquery' ), TAP_THEME_VERSION, true );
}
add_action( 'customize_controls_enqueue_scripts', 'travel_agency_pro_customize_script' );

/**
 * Notifications in customizer
 */
require get_template_directory() . '/inc/customizer-plugin-recommend/customizer-notice/class-customizer-notice.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-install-helper.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/section-notice/class-section-notice.php';

$config_customizer = array(
	'recommended_plugins' => array( 
		'travel-agency-companion' => array(
			'recommended' => true,
			'description' => sprintf( esc_html__( 'If you want to take full advantage of the features this theme has to offer, please install and activate %s plugin.', 'travel-agency-pro' ), '<strong>Travel Agency Companion</strong>' ),
		),
	),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'travel-agency-pro' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'travel-agency-pro' ),
	'activate_button_label'     => esc_html__( 'Activate', 'travel-agency-pro' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'travel-agency-pro' ),
);
Travel_Agency_Customizer_Notice::init( apply_filters( 'travel_agency_customizer_notice_array', $config_customizer ) );

Travel_Agency_Customizer_Section::get_instance();
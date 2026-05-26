<?php
/**
 * Widgets
 *
 * @package Travel_Agency_Pro
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function travel_agency_pro_widgets_init() {
	
    $sidebars = array(
        'sidebar'   => array(
            'name'        => __( 'Sidebar', 'travel-agency-pro' ),
            'id'          => 'sidebar', 
            'description' => __( 'Default Sidebar', 'travel-agency-pro' ),
        ),
        'footer-one'=> array(
            'name'        => __( 'Footer One', 'travel-agency-pro' ),
            'id'          => 'footer-one', 
            'description' => __( 'Add footer one widgets here.', 'travel-agency-pro' ),
        ),
        'footer-two'=> array(
            'name'        => __( 'Footer Two', 'travel-agency-pro' ),
            'id'          => 'footer-two', 
            'description' => __( 'Add footer two widgets here.', 'travel-agency-pro' ),
        ),
        'footer-three'=> array(
            'name'        => __( 'Footer Three', 'travel-agency-pro' ),
            'id'          => 'footer-three', 
            'description' => __( 'Add footer three widgets here.', 'travel-agency-pro' ),
        ),
        'footer-four'=> array(
            'name'        => __( 'Footer Four', 'travel-agency-pro' ),
            'id'          => 'footer-four', 
            'description' => __( 'Add footer four widgets here.', 'travel-agency-pro' ),
        )
    );
    
    foreach( $sidebars as $sidebar ){
        register_sidebar( array(
    		'name'          => esc_html( $sidebar['name'] ),
    		'id'            => esc_attr( $sidebar['id'] ),
    		'description'   => esc_html( $sidebar['description'] ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title">',
    		'after_title'   => '</h2>',
    	) );
    }
    
    /** Dynamic sidebars */
    $dynamic_sidebars = travel_agency_pro_get_dynamnic_sidebar();
    
    foreach( $dynamic_sidebars as $k => $v ){
        if( ! empty( $v ) ){
            register_sidebar( array(
        		'name'          => esc_attr( $v ),
        		'id'            => esc_attr( $k ),
        		'description'   => '',
        		'before_widget' => '<section id="%1$s" class="widget %2$s">',
        		'after_widget'  => '</section>',
        		'before_title'  => '<h2 class="widget-title">',
        		'after_title'   => '</h2>',
        	) );
        }
    }
    
}
add_action( 'widgets_init', 'travel_agency_pro_widgets_init' );
<?php
/**
 * Home Page Blog Settings
 *
 * @package Travel_Agency_Pro
 */
 
function travel_agency_pro_customize_register_home_blog( $wp_customize ){
    /** Blog Section */   
    $wp_customize->add_section( 'blog_section', array(
        'title'    => __( 'Blog Section', 'travel-agency-pro' ),
        'priority' => 100,
        'panel'    => 'home_page_setting',
    ) ); 
    
    /** Title */
    $wp_customize->add_setting(
        'blog_section_title',
        array(
            'default'           => __( 'Latest Articles', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_section_title',
        array(
            'label'   => __( 'Title', 'travel-agency-pro' ),
            'section' => 'blog_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'blog_section_title', array(
        'selector' => '.blog-section .section-header .section-title',
        'render_callback' => 'travel_agency_pro_get_blog_section_title',
    ) );
    
    /** Sub Title */
    $wp_customize->add_setting(
        'blog_section_subtitle',
        array(
            'default'           => __( 'Show your latest blog posts here. You can modify this section from Appearance > Customize > Home Page Settings > Blog Section.', 'travel-agency-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_section_subtitle',
        array(
            'label'   => __( 'Sub Title', 'travel-agency-pro' ),
            'section' => 'blog_section',
            'type'    => 'textarea',
        )
    );    
    
    $wp_customize->selective_refresh->add_partial( 'blog_section_subtitle', array(
        'selector' => '.blog-section .section-header .section-content',
        'render_callback' => 'travel_agency_pro_get_blog_section_sub_title',
    ) );
    
    /** View All Label */
    $wp_customize->add_setting(
        'blog_view_all',
        array(
            'default'           => __( 'View All Posts', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_view_all',
        array(
            'label'           => __( 'View All label', 'travel-agency-pro' ),
            'section'         => 'blog_section',
            'type'            => 'text',
            'active_callback' => 'travel_agency_pro_blog_view_all_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'blog_view_all', array(
        'selector' => '.blog-section .btn-holder .btn-more',
        'render_callback' => 'travel_agency_pro_get_blog_view_all_btn',
    ) );

}
add_action( 'customize_register', 'travel_agency_pro_customize_register_home_blog' );

/**
 * Active Callback
*/    
function travel_agency_pro_blog_view_all_ac(){
    $blog = get_option( 'page_for_posts' );
    if( $blog ) return true;
    
    return false; 
}
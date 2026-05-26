<?php
/**
 * Partials for Selective Refresh
 *
 * @package Travel_Agency_Pro
 */

if( ! function_exists( 'travel_agency_pro_get_header_phone' ) ) :
/**
 * Prints phone number in header
*/
function travel_agency_pro_get_header_phone(){
    return get_theme_mod( 'phone', __( '(888) 123-45678', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_get_phone_label' ) ) :
/**
 * Prints phone label
*/
function travel_agency_pro_get_phone_label(){
    return get_theme_mod( 'phone_label', __( 'Call us, we are open 24/7', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_get_email' ) ) :
/**
 * Prints Email
*/
function travel_agency_pro_get_email(){
    return get_theme_mod( 'email', __( 'dhanne@hikingtrek.com', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_get_time' ) ) :
/**
 * Prints Time
*/
function travel_agency_pro_get_time(){
    return get_theme_mod( 'time', __( 'Mon - Fri 10:00-18:00', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_get_banner_title' ) ) :
/**
 * Display Banner title
*/
function travel_agency_pro_get_banner_title(){
    return get_theme_mod( 'banner_title', __( 'Find Your Best Holiday', 'travel-agency-pro' ) );           
}
endif;

if( ! function_exists( 'travel_agency_pro_get_banner_sub_title' ) ) :
/**
 * Display Banner sub-title
*/
function travel_agency_pro_get_banner_sub_title(){
   return wpautop( get_theme_mod( 'banner_subtitle', __( 'Find great adventure holidays and activities around the planet.', 'travel-agency-pro' ) ) );
    
}
endif;

if( ! function_exists( 'travel_agency_pro_get_banner_search' ) ) :
/**
 * Display search form in banner
*/
function travel_agency_pro_get_banner_search(){
    $ed_search = get_theme_mod( 'ed_banner_search', true );
    if( $ed_search ) get_search_form();
}
endif;

if( ! function_exists( 'travel_agency_pro_get_testimonial_title' ) ) :
/**
 * Display Testimonial title
*/
function travel_agency_pro_get_testimonial_title(){
    return get_theme_mod( 'testimonial_section_title', __( 'Testimonials', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_get_testimonial_sub_title' ) ) :
/**
 * Display Testimonial sub-title
*/
function travel_agency_pro_get_testimonial_sub_title(){
    return wpautop( get_theme_mod( 'testimonial_section_subtitle', __( 'Show your testimonial here. You can modify this section from Appearance > Customize > Home Page Settings > Testimonial Section.', 'travel-agency-pro' ) ) );
    
}
endif;

if( ! function_exists( 'travel_agency_pro_get_blog_section_title' ) ) :
/**
 * Display blog section title
*/
function travel_agency_pro_get_blog_section_title(){
    return get_theme_mod( 'blog_section_title', __( 'Latest Articles', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_get_blog_section_sub_title' ) ) :
/**
 * Display blog section sub-title
*/
function travel_agency_pro_get_blog_section_sub_title(){
    return wpautop( get_theme_mod( 'blog_section_subtitle', __( 'Show your latest blog posts here. You can modify this section from Appearance > Customize > Home Page Settings > Blog Section.', 'travel-agency-pro' ) ) );
    
}
endif;

if( ! function_exists( 'travel_agency_pro_get_blog_view_all_btn' ) ) :
/**
 * Display blog view all button
*/
function travel_agency_pro_get_blog_view_all_btn(){
    return get_theme_mod( 'blog_view_all', __( 'View All Posts', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_get_client_section_title' ) ) :
/**
 * Display client section title
*/
function travel_agency_pro_get_client_section_title(){
    return get_theme_mod( 'client_section_title', __( 'Recomended', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_get_related_title' ) ) :
/**
 * Display related post title
*/
function travel_agency_pro_get_related_title(){
    return get_theme_mod( 'related_title', __( 'You may also like...', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_get_readmore_btn' ) ) :
/**
 * Display readmore button label
*/
function travel_agency_pro_get_readmore_btn(){
    return get_theme_mod( 'readmore', __( 'Read More', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_get_footer_copyright' ) ) :
/**
 * Prints footer copyright
*/
function travel_agency_pro_get_footer_copyright(){
    $copyright = get_theme_mod( 'footer_copyright' );
    echo '<span class="copyright">';
    if( $copyright ){
        echo wp_kses_post( travel_agency_pro_apply_theme_shortcode( $copyright ) );
    }else{
        esc_html_e( '&copy; Copyright ', 'travel-agency-pro' ); 
        echo date_i18n( esc_html__( 'Y', 'travel-agency-pro' ) );
        echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';    
    }    
    echo '</span>';
}
endif;

if( ! function_exists( 'travel_agency_pro_ed_author_link' ) ) :
/**
 * Show/Hide Author link in footer
*/
function travel_agency_pro_ed_author_link(){
    $ed_author_link = get_theme_mod( 'ed_author_link' );
    if( ! $ed_author_link ) echo '<span class="author-link"><a href="' . esc_url( 'https://raratheme.com/wordpress-themes/travel-agency-pro/' ) .'" rel="author" target="_blank">' . esc_html__( ' Travel Agency Pro', 'travel-agency-pro' ) . '</a>' . esc_html__( ' by Rara Theme.', 'travel-agency-pro' ) . '</span>';
}
endif;

if( ! function_exists( 'travel_agency_pro_ed_wp_link' ) ) :
/**
 * Show/Hide WordPress link in footer
*/
function travel_agency_pro_ed_wp_link(){
    $ed_wp_link = get_theme_mod( 'ed_wp_link' );
    if( ! $ed_wp_link ) printf( esc_html__( '%1$s Powered by %2$s%3$s', 'travel-agency-pro' ), '<span class="wp-link">', '<a href="'. esc_url( __( 'https://wordpress.org/', 'travel-agency-pro' ) ) .'" target="_blank">WordPress</a>.', '</span>' );
}
endif;
 
if( ! function_exists( 'travel_agency_pro_get_about_intro_title' ) ) :
/**
 * Display about intro section title
*/
function travel_agency_pro_get_about_intro_title(){
    return get_theme_mod( 'about_intro_title', __( 'Create your Travel Booking Website with Travel Agency Theme', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_get_about_intro_sub_title' ) ) :
/**
 * Display about intro section sub-title
*/
function travel_agency_pro_get_about_intro_sub_title(){
    return wpautop( get_theme_mod( 'about_intro_content', __( 'Tell a story about your company here. You can modify this section from Appearance > Customize > Home Page Settings > About Section.

Travel Agency is a free WordPress theme that you can use create stunning and functional travel and tour booking website. It is lightweight, responsive and SEO friendly. It is compatible with WP Travel Engine, a WordPress plugin for travel booking.

It is also translation ready. So you can translate your website in any language.', 'travel-agency-pro' ) ) );    
}
endif;

if( ! function_exists( 'travel_agency_pro_get_about_client_title' ) ) :
/**
 * Display about client section title
*/
function travel_agency_pro_get_about_client_title(){
    return get_theme_mod( 'about_client_title', __( 'Associated With', 'travel-agency-pro' ) );
}
endif; 

if( ! function_exists( 'travel_agency_pro_get_about_whyus_title' ) ) :
/**
 * Display about whyus section title
*/
function travel_agency_pro_get_about_whyus_title(){
    return get_theme_mod( 'whyus_about_title', __( 'Why Book with Us', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_get_about_whyus_sub_title' ) ) :
/**
 * Display about whyus section sub-title
*/
function travel_agency_pro_get_about_whyus_sub_title(){
    return wpautop( get_theme_mod( 'whyus_about_desc', __( 'Let your visitors know why they should trust you and book with you. You can modify this section from Appearance > Customize > Home Page Settings > Why Book with Us.', 'travel-agency-pro' ) ) );    
}
endif;

if( ! function_exists( 'travel_agency_pro_get_about_service_title' ) ) :
/**
 * Display about service section title
*/
function travel_agency_pro_get_about_service_title(){
    return get_theme_mod( 'service_about_title', __( 'Our Services', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_get_about_service_sub_title' ) ) :
/**
 * Display about service section sub-title
*/
function travel_agency_pro_get_about_service_sub_title(){
    return wpautop( get_theme_mod( 'service_about_desc', __( 'Show the services provided to your customers here. You can customize this section from Appearance > Customize > About Page Settings > Service Section.', 'travel-agency-pro' ) ) );    
}
endif;

if( ! function_exists( 'travel_agency_pro_get_about_stats_title' ) ) :
/**
 * Display about service section title
*/
function travel_agency_pro_get_about_stats_title(){
    return get_theme_mod( 'about_stat_counter_title', __( 'Stats Counter', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_get_about_stats_sub_title' ) ) :
/**
 * Display about service section sub-title
*/
function travel_agency_pro_get_about_stats_sub_title(){
    return wpautop( get_theme_mod( 'about_stat_counter_desc', __( 'Display most valuable statistics about your company here. You can modify this section from Appearance > Customize > About Page Settings > Stats Section.', 'travel-agency-pro' ) ) );    
}
endif;

if( ! function_exists( 'travel_agency_pro_about_testimonial_title' ) ) :
/**
 * Display Testimonial title
*/
function travel_agency_pro_about_testimonial_title(){
    return get_theme_mod( 'about_testimonial_section_title', __( 'Testimonials', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_about_testimonial_sub_title' ) ) :
/**
 * Display Testimonial sub-title
*/
function travel_agency_pro_about_testimonial_sub_title(){
    return wpautop( get_theme_mod( 'about_testimonial_section_subtitle', __( 'Show your testimonial here. You can modify this section from Appearance > Customize > About Page Settings > Testimonial Section.', 'travel-agency-pro' ) ) );
    
}
endif;

if( ! function_exists( 'travel_agency_pro_about_team_title' ) ) :
/**
 * Display Testimonial title
*/
function travel_agency_pro_about_team_title(){
    return get_theme_mod( 'about_team_section_title', __( 'Our Team', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_about_team_sub_title' ) ) :
/**
 * Display Testimonial sub-title
*/
function travel_agency_pro_about_team_sub_title(){
    return wpautop( get_theme_mod( 'about_team_section_subtitle', __( 'Show your teams to your customers here. You can customize this section from Appearance > Customize > About Page Settings > Team Section.', 'travel-agency-pro' ) ) );    
}
endif;

if( ! function_exists( 'travel_agency_pro_phone_label' ) ) :
/**
 * Display Phone Label
*/
function travel_agency_pro_phone_label(){
    return get_theme_mod( 'contact_phone_label', __( 'Phone', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_contact_phone' ) ) :
/**
 * Display Contact Phone
*/
function travel_agency_pro_contact_phone(){
    $phone = get_theme_mod( 'contact_phone', __( '(888) 123-456789', 'travel-agency-pro' ) );
    $phone = explode( ',', $phone );
    ob_start();
    if( is_array( $phone ) ){
        foreach( $phone as $p ){?>
            <div class="phone-number"><a href="<?php echo esc_url( 'tel:' . preg_replace( '/\D/', '', $p ) );?>"><?php echo esc_html( $p );?></a></div>
            <?php
        }
    }    
    return $return = ob_get_clean();
}
endif;

if( ! function_exists( 'travel_agency_pro_email_label' ) ) :
/**
 * Display Email Label
*/
function travel_agency_pro_email_label(){
    return get_theme_mod( 'email_label', __( 'Email', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_contact_email' ) ) :
/**
 * Display Contact Email
*/
function travel_agency_pro_contact_email(){
    $email = get_theme_mod( 'contact_email', __( 'info@testing.com, info@gmail.com, support@test.com', 'travel-agency-pro' ) );
    $email = explode( ',', $email );
    ob_start();
    if( is_array( $email ) ){
        foreach( $email as $p ){?>
            <div class="email"><a href="<?php echo esc_url( 'mailto:' . sanitize_email( $p ) );?>"><?php echo esc_html( $p );?></a></div>
            <?php
        }
    }    
    return $return = ob_get_clean();
}
endif;

if( ! function_exists( 'travel_agency_pro_location_label' ) ) :
/**
 * Display Location Label
*/
function travel_agency_pro_location_label(){
    return get_theme_mod( 'location_label', __( 'Location', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_contact_address' ) ) :
/**
 * Display Contact Address
*/
function travel_agency_pro_contact_address(){
    return wpautop( get_theme_mod( 'contact_address', __( 'Travel Agency. PO Box 19604, Thamel Kathmandu, Nepal', 'travel-agency-pro' ) ) );    
}
endif;

if( ! function_exists( 'travel_agency_pro_whatsapp_label' ) ) :
/**
 * Display Whatsapp Label
*/
function travel_agency_pro_whatsapp_label(){
    return get_theme_mod( 'whatsapp_label', __( 'WhatsApp', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_contact_whatsapp' ) ) :
/**
 * Display Contact Whatsapp
*/
function travel_agency_pro_contact_whatsapp(){
    $phone = get_theme_mod( 'contact_whatsapp', __( '+977- 9876543210(Kathy), +977- 9877665544(Suji)', 'travel-agency-pro' ) );
    $phone = explode( ',', $phone );
    ob_start();
    if( is_array( $phone ) ){
        foreach( $phone as $p ){?>
            <div class="phone-number"><a href="<?php echo esc_url( 'tel:' . preg_replace( '/\D/', '', $p ) );?>"><?php echo esc_html( $p );?></a></div>
            <?php
        }
    }    
    return $return = ob_get_clean();
}
endif;

if( ! function_exists( 'travel_agency_pro_skype_label' ) ) :
/**
 * Display Skype Label
*/
function travel_agency_pro_skype_label(){
    return get_theme_mod( 'skype_label', __( 'Skype', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_contact_skype' ) ) :
/**
 * Display Contact Skype
*/
function travel_agency_pro_contact_skype(){
    $phone = get_theme_mod( 'contact_skype', __( 'skype@company.com', 'travel-agency-pro' ) );
    $phone = explode( ',', $phone );
    ob_start();
    if( is_array( $phone ) ){
        foreach( $phone as $p ){?>
            <div class="skype"><a href="<?php echo esc_url( 'skype:' . $p );?>"><?php echo esc_html( $p );?></a></div>
            <?php
        }
    }    
    return $return = ob_get_clean();
}
endif;

if( ! function_exists( 'travel_agency_pro_viber_label' ) ) :
/**
 * Display Viber Label
*/
function travel_agency_pro_viber_label(){
    return get_theme_mod( 'viber_label', __( 'Viber', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_contact_viber' ) ) :
/**
 * Display Testimonial sub-title
*/
function travel_agency_pro_contact_viber(){
    $phone = get_theme_mod( 'contact_viber', __( '+977- 9876543210(Kathy), +977- 9877665544(Suji)', 'travel-agency-pro' ) );
    $phone = explode( ',', $phone );
    ob_start();
    if( is_array( $phone ) ){
        foreach( $phone as $p ){?>
            <div class="viber"><a href="<?php echo esc_url( 'tel:' . preg_replace( '/\D/', '', $p ) );?>"><?php echo esc_html( $p );?></a></div>
            <?php
        }
    }    
    return $return = ob_get_clean();
}
endif;

if( ! function_exists( 'travel_agency_pro_contact_form_title' ) ) :
/**
 * Display Testimonial title
*/
function travel_agency_pro_contact_form_title(){
    return get_theme_mod( 'contact_info_title', __( 'Leave Us Your Info', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_contact_form_sub_title' ) ) :
/**
 * Display Testimonial sub-title
*/
function travel_agency_pro_contact_form_sub_title(){
    return wpautop( get_theme_mod( 'contact_info_content', __( 'The contact page is just for demonstration purpose. Please DON\'T contact us via the contact form. For any questions or support, contact us on our support forum.', 'travel-agency-pro' ) ) );    
}
endif;

if( ! function_exists( 'travel_agency_pro_related_trip_title' ) ) :
/**
 * Display Related Trip Title
*/
function travel_agency_pro_related_trip_title(){
    return get_theme_mod( 'related_trip_title', __( 'Related Trips', 'travel-agency-pro' ) );
}
endif;

if( ! function_exists( 'travel_agency_pro_related_trip_readmore' ) ) :
/**
 * Display Related Trip Title
*/
function travel_agency_pro_related_trip_readmore(){
    return get_theme_mod( 'related_trip_readmore', __( 'View Details', 'travel-agency-pro' ) );
}
endif;
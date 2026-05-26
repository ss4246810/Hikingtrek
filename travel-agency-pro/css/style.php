<?php
/**
 * Dynamic Styles
 * 
 * @package Travel_Agency_Pro
*/

function travel_agency_pro_dynamic_css(){
    
    $primary_font    = get_theme_mod( 'primary_font', 'Poppins' );
    $primary_fonts   = travel_agency_pro_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Montserrat' );
    $secondary_fonts = travel_agency_pro_get_fonts( $secondary_font, 'regular' );
    $font_size       = get_theme_mod( 'font_size', 16 );
    
    $h1_font      = get_theme_mod( 'h1_font', array( 'font-family'=>'Montserrat', 'variant'=>'700') );
    $h1_fonts     = travel_agency_pro_get_fonts( $h1_font['font-family'], $h1_font['variant'] );
    $h1_font_size = get_theme_mod( 'h1_font_size', 48 );
    $h1_color     = get_theme_mod( 'h1_color', '#353d47' );
    
    $h2_font      = get_theme_mod( 'h2_font', array('font-family'=>'Montserrat', 'variant'=>'700') );
    $h2_fonts     = travel_agency_pro_get_fonts( $h2_font['font-family'], $h2_font['variant'] );
    $h2_font_size = get_theme_mod( 'h2_font_size', 40 );
    $h2_color     = get_theme_mod( 'h2_color', '#353d47' );
    
    $h3_font      = get_theme_mod( 'h3_font', array('font-family'=>'Montserrat', 'variant'=>'700') );
    $h3_fonts     = travel_agency_pro_get_fonts( $h3_font['font-family'], $h3_font['variant'] );
    $h3_font_size = get_theme_mod( 'h3_font_size', 32 );
    $h3_color     = get_theme_mod( 'h3_color', '#353d47' );
    
    $h4_font      = get_theme_mod( 'h4_font', array('font-family'=>'Montserrat', 'variant'=>'700') );
    $h4_fonts     = travel_agency_pro_get_fonts( $h4_font['font-family'], $h4_font['variant'] );
    $h4_font_size = get_theme_mod( 'h4_font_size', 28 );
    $h4_color     = get_theme_mod( 'h4_color', '#353d47' );
    
    $h5_font      = get_theme_mod( 'h5_font', array('font-family'=>'Montserrat', 'variant'=>'700') );
    $h5_fonts     = travel_agency_pro_get_fonts( $h5_font['font-family'], $h5_font['variant'] );
    $h5_font_size = get_theme_mod( 'h5_font_size', 24 );
    $h5_color     = get_theme_mod( 'h5_color', '#353d47' );
    
    $h6_font      = get_theme_mod( 'h6_font', array('font-family'=>'Montserrat', 'variant'=>'700') );
    $h6_fonts     = travel_agency_pro_get_fonts( $h6_font['font-family'], $h6_font['variant'] );
    $h6_font_size = get_theme_mod( 'h6_font_size', 22 );
    $h6_color     = get_theme_mod( 'h6_color', '#353d47' );
    
    $body_color      = get_theme_mod( 'body_color', '#666666' );
    $color_scheme    = get_theme_mod( 'color_scheme', '#32b67a' );
    $bg_color        = get_theme_mod( 'bg_color', '#ffffff' );
    $body_bg         = get_theme_mod( 'body_bg', 'image' );
    $bg_image        = get_theme_mod( 'bg_image' );
    $bg_pattern      = get_theme_mod( 'bg_pattern', 'nobg' );
    $ed_auth_comment = get_theme_mod( 'ed_auth_comments' );
    
    $rgb = travel_agency_pro_hex2rgb( travel_agency_pro_sanitize_hex_color( $color_scheme ) ); 
    
    $image = '';
    if( $body_bg == 'image' && $bg_image ){
        $image = $bg_image;    
    }elseif( $body_bg == 'pattern' && $bg_pattern != 'nobg' ){
        $image = get_template_directory_uri() . '/images/patterns/' . $bg_pattern . '.png';
    }
    
    echo "<style type='text/css' media='all'>"; ?>
    
    body,
    button,
    input,
    select,
    textarea{
    	font-size: <?php echo absint( $font_size ); ?>px;
    	color: <?php echo travel_agency_pro_sanitize_hex_color( $body_color ); ?>;
    	font-family: <?php echo $primary_fonts['font']; ?>;        
    }

    body{
        background: url(<?php echo esc_url( $image ); ?>) <?php echo travel_agency_pro_sanitize_hex_color( $bg_color ); ?>;
    }
    
    /* Secondary font family */

    .site-branding .site-title,
    .main-navigation ul,
    .banner .form-holder .text h1,
    .banner .form-holder .search-form input[type="submit"],
    .about .text-holder .title,
    .about .text-holder .btn-more,
    .activities .section-header .section-title,
    #activities-slider .text-holder .title,
    #activities-slider .title-holder,
    .popular-destination .section-header .section-title,
    .popular-destination .grid .col .text-holder .title,
    .popular-destination .btn-holder .btn-more,
    .our-features .section-header .section-title,
    .our-features .features-holder .col .text-holder .title,
    .featured-trip .section-header .section-title,
    .featured-trip .grid .text-holder .title,
    .featured-trip .grid .text-holder .btn-more,
    .featured-trip .btn-holder .btn-more,
    .stats .section-header .section-title,
    .stats .grid .col .raratheme-sc-holder .hs-counter,
    .our-deals .section-header .section-title,
    .our-deals .grid .text-holder .title,
    .our-deals .grid .text-holder .btn-more,
    .our-deals .btn-holder .btn-more,
    .testimoinal .section-header .section-title,
    #testimonial-carousel .holder .title,
    .cta .text .title,
    .cta .text .btn-more,
    .blog-section .section-header .section-title,
    .blog-section .grid .post .text-holder .entry-title,
    .blog-section .btn-holder .btn-more,
    .clients .section-header .section-title,
    .widget .widget-title,
    .widget_travel_agency_featured_widget .readmore,
    .widget_raratheme_popular_post ul li .entry-header .entry-title,
    .widget_raratheme_recent_post ul li .entry-header .entry-title,
    #primary .post .entry-header .entry-title,
    #primary .post .entry-footer .btn-holder .btn-more,
    #primary .post .entry-content .dropcap,
    #primary .page .entry-content .dropcap,
    #primary .post .entry-content blockquote,
    #primary .page .entry-content blockquote,
    #primary .post .entry-content .pull-left,
    #primary .page .entry-content .pull-left,
    #primary .post .entry-content .pull-right,
    #primary .page .entry-content .pull-right,
    button,
    input[type="button"],
    input[type="reset"],
    input[type="submit"],
    .post-navigation .post-title,
    .related-post .title,
    .comments-area .comments-title,
    .comments-area .comment-body .fn,
    .comments-area .comment-reply-title,
    .page-header .page-title,
    .page-template-team .page-header .page-title,
    .team-holder .item .text .name,
    .page-template-about .about-intro .text-holder .title,
    .services .section-header .section-title,
    .services .grid .col .text-holder .service-title,
    .team-section .section-header .section-title,
    .page-template-contact .contact-info .grid .title,
    .contact-form-section .section-header .section-title,
    .page-template-template-destination .destination-holder .item .child-title,
    .page-template-template-activities .activities-holder .item .text-holder .title,
    .page-template-template-trip_types .trip_types-holder .item .text-holder .title,
    .page-template-template-activities .activities-holder .item .title-holder,
    .page-template-template-trip_types .trip_types-holder .item .title-holder,
    .archive .trip-content-area .activity-title,
    .archive .trip-content-area .grid .text-holder .title,
    .archive .trip-content-area .grid .text-holder .btn-more,
    .archive .trip-content-area .grid .text-holder .wp-travel-engine-cart,
    .single-trip .trip-post .entry-header .entry-title,
    .itinerary .itinerary-content .title,
    #tabs-container .tab-content h1,
    #tabs-container .tab-content h2,
    #tabs-container .tab-content h3,
    #tabs-container .tab-content h4,
    #tabs-container .tab-content h5,
    #tabs-container .tab-content h6,
    .faq .faq-row .accordion-tabs-toggle,
    .single-trip #wte_enquiry_contact_form h2,
    .trip-content-area .widget-area .trip-price .price-holder .top-price-holder,
    .trip-content-area .widget-area .trip-price .price-holder form .total-amt,
    .trip-content-area .widget-area .trip-price .price-holder form .check-availability,
    .trip-content-area .widget-area .trip-price .price-holder form .book-submit,
    .place-order-form-secondary-wrapper .trip-property li,
    #primary .page .entry-content .trip-title,
    .relation-options-title,
    .personal-options-title,
    .archive .trip-content-area .grid .btn-loadmore span,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .text-holder .entry-title,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .foundPosts,
    .single-trip .related-trips .section-header .section-title,
    .single-trip .related-trips .grid .col .text-holder .title,
    .single-trip .related-trips .grid .col .text-holder .btn-holder .btn-more,
    .trip-search h3,
    .trip-search-result #primary .advanced-search-wrapper .sidebar h2,
    .trip-search-result #primary .advanced-search-wrapper .sidebar h3,
    #primary .page .entry-content .payment-method h3{
        font-family: <?php echo $secondary_fonts['font']; ?>;
    }
    
    #primary .post .entry-content h1,
    #primary .page .entry-content h1{
        font-family: <?php echo $h1_fonts['font']; ?>;
        font-size: <?php echo absint( $h1_font_size ); ?>px;
        font-weight: <?php echo esc_attr( $h1_fonts['weight'] ); ?>;
        font-style: <?php echo esc_attr( $h1_fonts['style'] ); ?>;
        color: <?php echo travel_agency_pro_sanitize_hex_color( $h1_color ); ?>;
    }
    
    #primary .post .entry-content h2,
    #primary .page .entry-content h2{
        font-family: <?php echo $h2_fonts['font']; ?>;
        font-size: <?php echo absint( $h2_font_size ); ?>px;
        font-weight: <?php echo esc_attr( $h2_fonts['weight'] ); ?>;
        font-style: <?php echo esc_attr( $h2_fonts['style'] ); ?>;
        color: <?php echo travel_agency_pro_sanitize_hex_color( $h2_color ); ?>;
    }
    
    #primary .post .entry-content h3,
    #primary .page .entry-content h3{
        font-family: <?php echo $h3_fonts['font']; ?>;
        font-size: <?php echo absint( $h3_font_size ); ?>px;
        font-weight: <?php echo esc_attr( $h3_fonts['weight'] ); ?>;
        font-style: <?php echo esc_attr( $h3_fonts['style'] ); ?>;
        color: <?php echo travel_agency_pro_sanitize_hex_color( $h3_color ); ?>;
    }
    
    #primary .post .entry-content h4,
    #primary .page .entry-content h4{
        font-family: <?php echo $h4_fonts['font']; ?>;
        font-size: <?php echo absint( $h4_font_size ); ?>px;
        font-weight: <?php echo esc_attr( $h4_fonts['weight'] ); ?>;
        font-style: <?php echo esc_attr( $h4_fonts['style'] ); ?>;
        color: <?php echo travel_agency_pro_sanitize_hex_color( $h4_color ); ?>;
    }
    
    #primary .post .entry-content h5,
    #primary .page .entry-content h5{
        font-family: <?php echo $h5_fonts['font']; ?>;
        font-size: <?php echo absint( $h5_font_size ); ?>px;
        font-weight: <?php echo esc_attr( $h5_fonts['weight'] ); ?>;
        font-style: <?php echo esc_attr( $h5_fonts['style'] ); ?>;
        color: <?php echo travel_agency_pro_sanitize_hex_color( $h5_color ); ?>;
    }
    
    #primary .post .entry-content h6,
    #primary .page .entry-content h6{
        font-family: <?php echo $h6_fonts['font']; ?>;
        font-size: <?php echo absint( $h6_font_size ); ?>px;
        font-weight: <?php echo esc_attr( $h6_fonts['weight'] ); ?>;
        font-style: <?php echo esc_attr( $h6_fonts['style'] ); ?>;
        color: <?php echo travel_agency_pro_sanitize_hex_color( $h6_color ); ?>;
    }
    
    /* primary color */
    a{
    	color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
    }
    
    a:hover,
    a:focus{
    	color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
    }

    .site-header .header-t,
    .header-two .nav-holder .holder,
    .header-three .nav-holder,
    .about .text-holder .title:after,
    .activities .section-header .section-title:after,
    .popular-destination .section-header .section-title:after,
    .about .text-holder .btn-more:hover,
    .about .text-holder .btn-more:focus,
    .popular-destination .grid .col .price-holder,
    .popular-destination .btn-holder .btn-more:hover,
    .popular-destination .btn-holder .btn-more:focus,
    .our-features .section-header .section-title:after,
    .featured-trip .section-header .section-title:after,
    .featured-trip .grid .img-holder .price-holder,
    .featured-trip .grid .text-holder .btn-more:hover,
    .featured-trip .grid .text-holder .btn-more:focus,
    .featured-trip .btn-holder .btn-more:hover,
    .featured-trip .btn-holder .btn-more:focus,
    .stats .section-header .section-title:after,
    .stats .grid .col .raratheme-sc-holder .hs-counter:after,
    .our-deals .section-header .section-title:after,
    .our-deals .grid .img-holder .price-holder,
    .our-deals .grid .text-holder .btn-more:hover,
    .our-deals .grid .text-holder .btn-more:focus,
    .our-deals .btn-holder .btn-more:hover,
    .our-deals .btn-holder .btn-more:focus,
    .testimoinal .section-header .section-title:after,
    #testimonial-carousel .owl-dots .active span,
    .blog-section .section-header .section-title:after,
    .blog-section .grid .post .img-holder .cat-links a,
    .blog-section .btn-holder .btn-more:hover,
    .blog-section .btn-holder .btn-more:focus,
    .clients .section-header .section-title:after,
    .widget .widget-title:after,
    .widget_calendar caption,
    .widget_calendar table tbody td a,
    .widget_travel_agency_featured_widget .readmore:hover,
    .widget_travel_agency_featured_widget .readmore:focus,
    #primary .post .entry-footer .social-networks li a:hover,
    #primary .post .entry-footer .social-networks li a:focus,
    .pagination a:after,
    .pagination span:after,
    #load-posts a:hover,
    #load-posts a:focus,
    #primary .post .entry-content .pull-left:before,
    #primary .page .entry-content .pull-left:before,
    #primary .post .entry-content .pull-right:before,
    #primary .page .entry-content .pull-right:before,
    .related-post .title:after,
    .related-post .col .img-holder .cat-links a,
    .comments-area .comments-title:after,
    .comments-area .comment-reply-title:after,
    .page-header .page-title:after,
    .page-template-team .page-header .page-title:after,
    .team-holder .item .text-holder,
    .page-template-about .about-intro .text-holder .title:after,
    .services .section-header .section-title:after,
    .services .grid .col .text-holder .service-title:after,
    .team-section .section-header .section-title:after,
    .page-template-contact .contact-info .grid .title:after,
    .contact-form-section .section-header .section-title:after,
    .archive .trip-content-area .grid .img-holder .price-holder,
    .archive .trip-content-area .grid .text-holder .btn-more:hover,
    .archive .trip-content-area .grid .text-holder .btn-more:focus,
    .archive .trip-content-area .grid .text-holder .wp-travel-engine-cart:hover,
    .archive .trip-content-area .grid .text-holder .wp-travel-engine-cart:focus,
    .single-trip .trip-post .entry-header .entry-title:after,
    #tabs-container .tab-inner-wrapper .tab-anchor-wrapper .nav-tab-active,
    .itinerary-row:before,
    #tabs-container .tab-content h1:after,
    #tabs-container .tab-content h2:after,
    #tabs-container .tab-content h3:after,
    #tabs-container .tab-content h4:after,
    #tabs-container .tab-content h5:after,
    #tabs-container .tab-content h6:after,
    .trip-content-area .widget-area .trip-price .price-holder,
    .wp-travel-engine-order-form-wrapper .trip-title,
    .trip-search-result #primary .advanced-search-wrapper .sidebar ul li [type="checkbox"]:not(:checked)+span:after,
    .trip-search-result #primary .advanced-search-wrapper .sidebar ul li [type="checkbox"]:checked+span:after,
    .trip-search-result #primary .advanced-search-wrapper .sidebar .advanced-search-field .ui-slider-horizontal .ui-slider-range,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .text-holder .btn-more:hover, .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .text-holder .btn-more:focus, .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .text-holder .wp-travel-engine-cart:hover, .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .text-holder .wp-travel-engine-cart:focus,
    .single-trip .related-trips .section-header .section-title:after,
    .single-trip .related-trips .grid .col .img-holder .price-holder,
    .single-trip .related-trips .grid .col .text-holder .btn-holder .btn-more:hover,
    .single-trip .related-trips .grid .col .text-holder .btn-holder .btn-more:focus,
    .trip-search form .advanced-search-field-submit input[type="submit"]:hover,
    .trip-search form .advanced-search-field-submit input[type="submit"]:focus,
    .trip-search-result #primary .advanced-search-wrapper .sidebar h2:after,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .img-holder .price-holder,
    .group-discount-pop .popup-inner a[data-popup-close="popup-1"],
    .group-discount-pop h3:after{
        background: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
    }

    .trip-content-area .widget-area .trip-price .group-discount-notice:after{
        border-bottom-color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
    }

    .site-branding .site-title a:hover,
    .site-branding .site-title a:focus,
    .main-navigation ul li a:hover,
    .main-navigation ul li a:focus,
    .main-navigation .current_page_item > a,
    .main-navigation .current-menu-item > a,
    .main-navigation .current_page_ancestor > a,
    .main-navigation .current-menu-ancestor > a,
    .main-navigation ul li:hover:after,
    .main-navigation ul li:focus:after,
    .site-header.header-two .header-t,
    .header-two .social-networks li a,
    .site-header.header-three .header-t,
    .header-three .header-t .social-networks li a,
    .header-five .social-networks li a,
    #activities-slider .text-holder .btn-more:hover,
    #activities-slider .text-holder .btn-more:focus,
    #activities-slider .owl-next:after,
    #activities-slider .owl-prev:after,
    #destination-slider .owl-next:after,
    #destination-slider .owl-prev:after,
    .popular-destination .grid .col .text-holder .title a:hover,
    .popular-destination .grid .col .text-holder .title a:focus,
    .our-features .features-holder .col .text-holder .title a:hover,
    .our-features .features-holder .col .text-holder .title a:focus,
    .our-features .features-holder .col .icon-holder,
    .popular-destination .grid .col .text-holder .meta-info .fa,
    .featured-trip .grid .text-holder .title a:hover,
    .featured-trip .grid .text-holder .title a:focus,
    .featured-trip .grid .text-holder .meta-info .fa,
    .our-deals .grid .text-holder .title a:hover,
    .our-deals .grid .text-holder .title a:focus,
    .our-deals .grid .text-holder .meta-info .fa,
    .blog-section .grid .post .text-holder .posted-on a:hover,
    .blog-section .grid .post .text-holder .posted-on a:focus,
    .blog-section .grid .post .text-holder .entry-title a:hover,
    .blog-section .grid .post .text-holder .entry-title a:focus,
    .blog-section .grid .post .entry-footer span .fa,
    .blog-section .grid .post .entry-footer a:hover,
    .blog-section .grid .post .entry-footer a:focus,
    .blog-section .grid .post .entry-footer .like:hover,
    .blog-section .grid .post .entry-footer:focus,
    .site-footer .footer-b a:hover,
    .site-footer .footer-b a:focus,
    #crumbs .separator,
    #primary .post .entry-header .entry-meta .posted-on a:hover,
    #primary .post .entry-header .entry-meta .posted-on a:focus,
    #primary .post .entry-header .entry-title a:hover,
    #primary .post .entry-header .entry-title a:focus,
    #primary .post .entry-footer .btn-holder .btn-more:hover,
    #primary .post .entry-footer .btn-holder .btn-more:focus,
    #primary .post .entry-footer .meta-info .fa,
    #primary .post .entry-footer .meta-info a:hover,
    #primary .post .entry-footer .meta-info a:focus,
    #primary .post .entry-footer .meta-info .like:hover,
    #primary .post .entry-footer .meta-info .like:focus,
    #primary .post .entry-footer .social-networks li a,
    .pagination a:hover,
    .pagination a:focus,
    .pagination .current,
    .pagination .prev:before,
    .pagination .next:before,
    .posts-navigation .nav-links .nav-previous a:hover,
    .posts-navigation .nav-links .nav-previous a:focus,
    .posts-navigation .nav-links .nav-next a:hover,
    .posts-navigation .nav-links .nav-next a:focus,
    #crumbs a:hover,
    #crumbs a:focus,
    button:hover,
    input[type="button"]:hover,
    input[type="reset"]:hover,
    input[type="submit"]:hover,
    .post-navigation .nav-holder a:hover .post-title,
    .post-navigation .nav-holder a:focus .post-title,
    .related-post .col .text-holder .post-title a:hover,
    .related-post .col .text-holder .post-title a:focus,
    .related-post .col .text-holder .posted-on a:hover,
    .related-post .col .text-holder .posted-on a:focus,
    .comments-area .comment-body .reply a:hover,
    .comments-area .comment-body .reply a:focus,
    .widget_raratheme_popular_post ul li .entry-header .entry-title a:hover,
    .widget_raratheme_popular_post ul li .entry-header .entry-title a:focus,
    .widget_raratheme_recent_post ul li .entry-header .entry-title a:hover,
    .widget_raratheme_recent_post ul li .entry-header .entry-title a:focus,
    .widget_raratheme_popular_post ul li .entry-header .entry-meta a:hover,
    .widget_raratheme_popular_post ul li .entry-header .entry-meta a:focus,
    .widget_raratheme_recent_post ul li .entry-header .entry-meta a:hover,
    .widget_raratheme_recent_post ul li .entry-header .entry-meta a:focus,
    .widget ul li a:hover,
    .widget ul li a:focus,
    .page-template-about .clients #clients-slider .owl-prev:after,
    .page-template-about .clients #clients-slider .owl-next:after,
    .page-template-template-activities .activities-holder .item .text-holder .btn-more:hover,
    .page-template-template-activities .activities-holder .item .text-holder .btn-more:focus,
    .page-template-template-trip_types .trip_types-holder .item .text-holder .btn-more:hover,
    .page-template-template-trip_types .trip_types-holder .item .text-holder .btn-more:focus,
    .archive .trip-content-area .grid .text-holder .title a:hover,
    .archive .trip-content-area .grid .text-holder .title a:focus,
    .archive .trip-content-area .grid .text-holder .meta-info .fa,
    .trip-facts-value .trip-facts-text label, .trip-facts-value .trip-facts-textarea label,
    .single-trip #wte_enquiry_contact_form .package-name-holder .input,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .text-holder .entry-title a:hover,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .text-holder .entry-title a:focus,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .text-holder .meta-info .fa,
    .single-trip .related-trips .grid .col .text-holder .title a:hover,
    .single-trip .related-trips .grid .col .text-holder .title a:focus,
    .single-trip .related-trips .grid .col .text-holder .meta-info .fa,
    .trip-search form .advanced-search-field .custom-select:before,
    .trip-search form .trip-duration strong:before,
    .trip-search form .trip-cost strong:before,
    .group-discount-pop .popup-inner table tbody .fa{
        color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
    }

    .banner .form-holder .search-form input[type="submit"],
    .trip-search form .search-dur .ui-slider-horizontal .ui-slider-range,
    .trip-search form .search-price .ui-slider-horizontal .ui-slider-range{
        background-color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
    }

    .trip-search form .search-dur .ui-slider-horizontal .ui-slider-handle,
    .trip-search form .search-price .ui-slider-horizontal .ui-slider-handle{
        border-left-color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
    }

    .bslider .banner-text .btn,
    .cta .text .btn-more,
    #primary .post .entry-footer .btn-holder .btn-more,
    button, input[type="button"],
    input[type="reset"],
    input[type="submit"]{
        border-color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
        background: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>; 
    }

    .bslider .owl-prev:hover circle,
    .bslider .owl-next:hover circle,
    #activities-slider .owl-prev:hover circle,
    #activities-slider .owl-next:hover circle,
    #destination-slider .owl-prev:hover circle,
    #destination-slider .owl-next:hover circle,
    .our-features .features-holder .col:hover circle,
    .our-features .features-holder .col:hover circle,
    #testimonial-carousel .owl-prev:hover circle,
    #testimonial-carousel .owl-next:hover circle,
    #clients-slider .owl-prev:hover circle,
    #clients-slider .owl-next:hover circle,
    #team-slider .owl-prev:hover circle,
    #team-slider .owl-next:hover circle{
        stroke: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
    }

    .about .text-holder .btn-more,
    .popular-destination .btn-holder .btn-more,
    .featured-trip .grid .text-holder .btn-more,
    .featured-trip .btn-holder .btn-more,
    .our-deals .grid .text-holder .btn-more,
    .our-deals .btn-holder .btn-more,
    .blog-section .btn-holder .btn-more,
    .widget_travel_agency_featured_widget .readmore,
    #primary .post .entry-header .entry-meta .cat-links a,
    #load-posts a,
    .archive .trip-content-area .grid .text-holder .btn-more,
    .archive .trip-content-area .grid .text-holder .wp-travel-engine-cart,
    .trip-search-result #primary .advanced-search-wrapper .sidebar ul li [type="checkbox"]:checked+span:before,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .text-holder .btn-more, .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .text-holder .wp-travel-engine-cart,
    .single-trip .related-trips .grid .col .text-holder .btn-holder .btn-more{
        border-color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
    }

    #primary .post .entry-header .entry-meta .cat-links a:hover,
    #primary .post .entry-header .entry-meta .cat-links a:focus{
        background: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
        border-color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
    }

    .popular-destination .grid .col .price-holder span:before,
    .featured-trip .grid .img-holder .price-holder span:before,
    .our-deals .grid .img-holder .price-holder span:before,
    .archive .trip-content-area .grid .img-holder .price-holder span:before,
    #tabs-container .tab-inner-wrapper .tab-anchor-wrapper .nav-tab-active:after,
    .single-trip .related-trips .grid .col .img-holder .price-holder span:before,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .img-holder .price-holder span:before{
        border-top-color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
    }

    .popular-destination .grid .col .price-holder span:after,
    .featured-trip .grid .img-holder .price-holder span:after,
    .our-deals .grid .img-holder .price-holder span:after,
    .archive .trip-content-area .grid .img-holder .price-holder span:after,
    .single-trip .related-trips .grid .col .img-holder .price-holder span:after,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .img-holder .price-holder span::after{
        border-bottom-color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
    }

    #primary .post .entry-content blockquote,
    #primary .page .entry-content blockquote{
        border-left-color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
    }

    .trip-search-result #primary .advanced-search-wrapper .sidebar .advanced-search-field .ui-slider-horizontal .ui-slider-handle{
        border-left-color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
    }

    .trip-search form .advanced-search-field h3{font-family: <?php echo $primary_fonts['font']; ?>;}

    @media only screen and (min-width: 1025px){
        .header-five .main-navigation > div > ul > li > a:hover,
        .header-five .main-navigation > div > ul > li > a:focus,
        .header-five .main-navigation > div > ul > li:hover,
        .header-five .main-navigation > div > ul > li:focus,
        .header-five .main-navigation > div > ul > li:hover > a,
        .header-five .main-navigation > div > ul > li:focus > a,
        .header-five .main-navigation > div > ul > .current-menu-item > a,
        .header-five .main-navigation > div > ul > .current-menu-ancestor > a,
        .header-five .main-navigation > div > ul > .current_page_item > a,
        .header-five .main-navigation > div > ul > .current_page_ancestor > a{
            background: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
        }
    }

    @media only screen and (max-width: 1024px){
        .nav-holder .container,
        #site-navigation{
            background: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
        }
    }
    
    <?php if( $ed_auth_comment ){ ?>
        /* Author Comment Style */
        .comments-area .comment-list .bypostauthor > .comment-body{
            padding: 15px;
            background: #ededed;
        }
    
    <?php } ?>
    
    <?php if( is_woocommerce_activated() ) { ?>
        .woocommerce ul.products li.product .add_to_cart_button:hover,
        .woocommerce ul.products li.product .add_to_cart_button:focus,
        .woocommerce ul.products li.product .product_type_external:hover,
        .woocommerce ul.products li.product .product_type_external:focus,
        .woocommerce nav.woocommerce-pagination ul li a:after,
        .woocommerce nav.woocommerce-pagination ul li span.current:after,
        .woocommerce #secondary .widget_shopping_cart .buttons .button:hover,
        .woocommerce #secondary .widget_shopping_cart .buttons .button:focus,
        .woocommerce #secondary .widget_price_filter .ui-slider .ui-slider-range,
        .woocommerce #secondary .widget_price_filter .price_slider_amount .button:hover,
        .woocommerce #secondary .widget_price_filter .price_slider_amount .button:focus,
        .woocommerce #secondary .widget_product_tag_cloud .tagcloud a:hover,
        .woocommerce #secondary .widget_product_tag_cloud .tagcloud a:focus,
        .woocommerce div.product .product_title:after,
        .woocommerce div.product .woocommerce-tabs .panel h2:after,
        .woocommerce #reviews .comment-respond .comment-reply-title:after,
        .woocommerce div.product .up-sells > h2:after,
        .woocommerce div.product .related > h2:after,
        .woocommerce-cart #primary .page .entry-content table.shop_table td.actions .button:hover,
        .woocommerce-cart #primary .page .entry-content table.shop_table td.actions .button:focus,
        .woocommerce-cart #primary .page .entry-content .cart_totals h2:after,
        .woocommerce-checkout #primary .page .entry-content .woocommerce .woocommerce-billing-fields h3:after,
        .woocommerce-checkout #primary .page .entry-content .woocommerce .woocommerce-additional-fields h3:after,
        #primary .page .entry-content #order_review_heading:after{
            background: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
        }

        .woocommerce nav.woocommerce-pagination ul li span.current,
        .woocommerce #secondary .widget .product_list_widget li .product-title:hover,
        .woocommerce #secondary .widget .product_list_widget li .product-title:focus,
        .woocommerce div.product .entry-summary .woocommerce-product-rating .woocommerce-review-link:hover,
        .woocommerce div.product .entry-summary .woocommerce-product-rating .woocommerce-review-link:focus,
        .woocommerce div.product .entry-summary .variations_form .single_variation_wrap .button:hover,
        .woocommerce div.product .entry-summary .variations_form .single_variation_wrap .button:focus,
        .woocommerce div.product .entry-summary .product_meta .posted_in a:hover,
        .woocommerce div.product .entry-summary .product_meta .posted_in a:focus,
        .woocommerce div.product .entry-summary .product_meta .tagged_as a:hover,
        .woocommerce div.product .entry-summary .product_meta .tagged_as a:focus,
        .woocommerce #review_form #respond .form-submit input:hover,
        .woocommerce #review_form #respond .form-submit input:focus,
        .woocommerce div.product form.cart .single_add_to_cart_button:hover,
        .woocommerce div.product form.cart .single_add_to_cart_button:focus,
        .woocommerce div.product .cart .single_add_to_cart_button.alt:hover,
        .woocommerce div.product .cart .single_add_to_cart_button.alt:focus,
        .woocommerce-cart #primary .page .entry-content table.shop_table td.product-name a:hover,
        .woocommerce-cart #primary .page .entry-content table.shop_table td.product-name a:focus,
        .woocommerce-cart #primary .page .entry-content table.shop_table td.actions .coupon input[type="submit"]:hover,
        .woocommerce-cart #primary .page .entry-content table.shop_table td.actions .coupon input[type="submit"]:focus,
        .woocommerce-cart #primary .page .entry-content .cart_totals .checkout-button:hover,
        .woocommerce-cart #primary .page .entry-content .cart_totals .checkout-button:focus,
        .woocommerce-checkout .woocommerce form.woocommerce-form-login input.button:hover,
        .woocommerce-checkout .woocommerce form.woocommerce-form-login input.button:focus,
        .woocommerce-checkout .woocommerce form.checkout_coupon input.button:hover,
        .woocommerce-checkout .woocommerce form.checkout_coupon input.button:focus,
        .woocommerce form.lost_reset_password input.button:hover,
        .woocommerce form.lost_reset_password input.button:focus,
        .woocommerce .return-to-shop .button:hover,
        .woocommerce .return-to-shop .button:focus,
        .woocommerce #payment #place_order:hover,
        .woocommerce-page #payment #place_order:focus{
            color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
        }

        .woocommerce #secondary .widget_shopping_cart .buttons .button,
        .woocommerce #secondary .widget_price_filter .price_slider_amount .button,
        .woocommerce-cart #primary .page .entry-content table.shop_table td.actions .button{
            border-color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
            color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
        }

        .woocommerce div.product .entry-summary .variations_form .single_variation_wrap .button,
        .woocommerce #review_form #respond .form-submit input,
        .woocommerce div.product form.cart .single_add_to_cart_button,
        .woocommerce div.product .cart .single_add_to_cart_button.alt,
        .woocommerce-cart #primary .page .entry-content table.shop_table td.actions .coupon input[type="submit"],
        .woocommerce-cart #primary .page .entry-content .cart_totals .checkout-button,
        .woocommerce-checkout .woocommerce form.woocommerce-form-login input.button,
        .woocommerce-checkout .woocommerce form.checkout_coupon input.button,
        .woocommerce form.lost_reset_password input.button,
        .woocommerce .return-to-shop .button,
        .woocommerce #payment #place_order,
        .woocommerce-page #payment #place_order{
            background: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
            border-color: <?php echo travel_agency_pro_sanitize_hex_color( $color_scheme ); ?>;
        }

        .woocommerce ul.products li.product .woocommerce-loop-category__title,
        .woocommerce ul.products li.product .woocommerce-loop-product__title,
        .woocommerce ul.products li.product h3,
        .woocommerce ul.products li.product .add_to_cart_button,
        .woocommerce ul.products li.product .product_type_external,
        .woocommerce ul.products li.product .added_to_cart,
        .woocommerce div.product .product_title,
        .woocommerce div.product .entry-summary .variations_form .single_variation_wrap .button,
        .woocommerce div.product form.cart .single_add_to_cart_button,
        .woocommerce div.product .cart .single_add_to_cart_button.alt,
        .woocommerce div.product .woocommerce-tabs .panel h2,
        .woocommerce #reviews .comment-respond .comment-reply-title,
        .woocommerce #review_form #respond .form-submit input,
        .woocommerce div.product .up-sells > h2,
        .woocommerce div.product .related > h2,
        .woocommerce .woocommerce-message .button,
        .woocommerce-cart #primary .page .entry-content table.shop_table td.product-name a,
        .woocommerce-cart #primary .page .entry-content table.shop_table td.product-name .variation,
        .woocommerce-cart #primary .page .entry-content table.shop_table td.actions .coupon input[type="submit"],
        .woocommerce-cart #primary .page .entry-content table.shop_table td.actions .button,
        .woocommerce-cart #primary .page .entry-content .cart_totals h2,
        .woocommerce-cart #primary .page .entry-content .cart_totals .checkout-button,
        .woocommerce-checkout .woocommerce form.woocommerce-form-login input.button,
        .woocommerce-checkout .woocommerce form.checkout_coupon input.button,
        .woocommerce form.lost_reset_password input.button,
        .woocommerce .return-to-shop .button,
        .woocommerce #payment #place_order,
        .woocommerce-page #payment #place_order,
        .woocommerce-checkout #primary .page .entry-content .woocommerce .woocommerce-billing-fields h3,
        .woocommerce-checkout #primary .page .entry-content .woocommerce .woocommerce-additional-fields h3,
        #primary .page .entry-content #order_review_heading,
        .woocommerce #secondary .widget_shopping_cart .buttons .button,
        .woocommerce #secondary .widget_price_filter .price_slider_amount .button,
        .woocommerce #secondary .widget .product_list_widget li .product-title{
            font-family: <?php echo $secondary_fonts['font']; ?>;
        }
            
    <?php } ?>
    
    <?php echo "</style>";
}
add_action( 'wp_head', 'travel_agency_pro_dynamic_css', 99 );

/**
 * Function for sanitizing Hex color 
 */
function travel_agency_pro_sanitize_hex_color( $color ){
	if ( '' === $color )
		return '';

    // 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;
}

/**
 * convert hex to rgb
 * @link http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
*/
function travel_agency_pro_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}
<?php
/**
 * About Intro Section
 * 
 * @package Travel_Agency_Pro
 */

$image   = get_theme_mod( 'about_image' );
$code    = get_theme_mod( 'about_ad_content', '<img src="' . get_template_directory_uri() . '/images/fallback/img81.jpg">' );
$title   = get_theme_mod( 'about_intro_title', __( 'Create your Travel Booking Website with Travel Agency Theme', 'travel-agency-pro' ) );
$content = get_theme_mod( 'about_intro_content', __( 'Tell a story about your company here. You can modify this section from Appearance > Customize > Home Page Settings > About Section.

Travel Agency is a free WordPress theme that you can use create stunning and functional travel and tour booking website. It is lightweight, responsive and SEO friendly. It is compatible with WP Travel Engine, a WordPress plugin for travel booking.

It is also translation ready. So you can translate your website in any language.', 'travel-agency-pro' ) ); 

if( $image || $title || $content || $code ){ ?>
<div class="container main-content">
                    <div class="bg-white">
                        <div class="page-about">
                            <div class="row">
                            <div class="col-xs-12 col-sm-7 col-md-7">
                            <?php if( $title || $content || $code ){ ?>
                                <div class="content-about">
                                <?php if( $title ) echo '<h2>' . esc_html( travel_agency_pro_get_about_intro_title() ) . '</h2>'; ?>
                                <?php if( $content ) echo  wp_kses_post( travel_agency_pro_get_about_intro_sub_title() ); ?>
                                </div>
                              <?php } ?>
                            </div>
                            <?php   if( $image ) echo '<div class="col-xs-12 col-sm-5 col-md-5"><img src="' . esc_url( wp_get_attachment_image_url( $image, 'full' ) ) . '" alt=""></div>'; ?>
                            </div>
                        </div>  
                    </div>
                </div>
<?php
}
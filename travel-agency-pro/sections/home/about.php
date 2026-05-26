<?php /*?><?php


$title      = get_theme_mod( 'about_us_title', __( 'Create Your Travel Booking Website with Travel Agency Theme', 'travel-agency-companion' ) );
$content    = get_theme_mod( 'about_us_desc', __( 'Tell a story about your company here. You can modify this section from Appearance > Customize > Home Page Settings > About Section.

            Travel Agency is a free WordPress theme that you can use create stunning and functional travel and tour booking website. It is lightweight, responsive and SEO friendly. It is compatible with WP Travel Engine, a WordPress plugin for travel booking.
            
            It is also translation ready. So you can translate your website in any language.', 'travel-agency-companion' ) );
$label      = get_theme_mod( 'about_us_readmore', __( 'View More', 'travel-agency-companion' ) );
$link       = get_theme_mod( 'about_us_readmore_link', __( '#', 'travel-agency-companion' ) );
$adcode     = get_theme_mod( 'about_us_ad_content', '<img src="' . esc_url( TRAVEL_AGENCY_COMPANION_URL. 'includes/images/img1.jpg' ) . '"/>' );
$class      = $adcode ? '' : ' no-code'; 
if( $title || $content || ( $label && $link ) || $adcode ){ ?>
<div class="why-us">
<?php if( $title ) echo '<h2>' . esc_html( travel_agency_companion_get_about_title() ) . '</h2>'; ?>
                            <div class="wh-body">
                              <?php if( $content ) echo '<p>' . wp_kses_post( travel_agency_companion_get_about_content() ) . '</p>'; ?>
                               <?php if( $label && $link ) echo '<a href="' . esc_url( $link ) . '" class="btn-more">' . esc_html( travel_agency_companion_get_about_label() ) . '</a>'; ?>
                            </div>  
                        </div>
<?php
}<?php */?>
<div id="TA_selfserveprop754" class="TA_selfserveprop">
<ul id="vuwVJlxI" class="TA_links Lts3Vfdsp2">
<li id="vEs9lpfOzUE" class="bvm9yws">
<a target="_blank" href="https://www.tripadvisor.com/"><img src="https://www.tripadvisor.com/img/cdsi/img2/branding/150_logo-11900-2.png" alt="TripAdvisor"/></a>
</li>
</ul>
</div>
<script async src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=754&amp;locationId=12572646&amp;lang=en_US&amp;rating=false&amp;nreviews=4&amp;writereviewlink=false&amp;popIdx=true&amp;iswide=true&amp;border=false&amp;display_version=2"></script>

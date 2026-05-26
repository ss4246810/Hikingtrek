<?php
/**
 * Our Features Section
 * 
 * @package Travel_Agency
 */

$default    = new Travel_Agency_Companion_Dummy_Array;
$title      = get_theme_mod( 'whyus_title', __( 'Why Book with Us', 'travel-agency-companion' ) );
$content    = get_theme_mod( 'whyus_desc', __( 'Let your visitors know why they should trust you and book with you. You can modify this section from Appearance > Customize > Home Page Settings > Why Book with Us.', 'travel-agency-companion' ) );
$why_us     = get_theme_mod( 'why_us', $default->default_why_us() );
$bg_image   = get_theme_mod( 'whyus_bg_image', TRAVEL_AGENCY_COMPANION_URL . 'includes/images/img13.jpg' );

if( $bg_image ){
    $bg_img = ' style="background:url(' . esc_url( $bg_image ) . ') no-repeat"';
}else{
    $bg_img = '';
}

if( $title || $content || $why_us ){ ?>
<div class="why-us">
<?php 
            if( $title ) echo '<h2><i class="fa fa-briefcase" aria-hidden="true"></i>' . esc_html( travel_agency_companion_get_why_us_title() ) . '</h2>'; ?>
                            <div class="wh-body">
                                <ul class="tick-list">
                                <?php foreach( $why_us as $why ){ 
                                if( $why['whyus-icon'] || $why['title'] || $why['description'] ){ ?> 
                                <?php 
                                if( $why['title'] ) echo '<li>';
                                echo esc_html( $why['title'] ); 
                                if( $why['title'] ) echo '</li>';
                                ?>
                                  <?php } ?>
                                  <?php } ?>
                                </ul>
                                <?php if( $content ) { ?>
                                <span class="readmore"><a href="<?php echo $content; ?>">Read More</a></span>
                                <?php } ?>
                            </div>
                        </div>


<?php
}
<?php
/**
 * About Feature Section
 * 
 * @package Travel_Agency_Pro
 */

$title      = get_theme_mod( 'whyus_about_title', __( 'Why Book with Us', 'travel-agency-pro' ) );
$content    = get_theme_mod( 'whyus_about_desc', __( 'Let your visitors know why they should trust you and book with you. You can modify this section from Appearance > Customize > Home Page Settings > Why Book with Us.', 'travel-agency-pro' ) );
$why_us     = get_theme_mod( 'whyus_about', travel_agency_pro_get_customizer_defaults( 'whyus' ) );
$bg_image   = get_theme_mod( 'whyus_about_bg_image', get_template_directory_uri() . '/images/fallback/img13.jpg' );

if( $bg_image ){
    $bg_img = ' style="background:url(' . esc_url( $bg_image ) . ') no-repeat"';
}else{
    $bg_img = '';
}

if( $title || $content || $why_us ){ ?>
<div class="why-us-section">
                    <?php if( $title || $content ){ ?>
                    <div class="blue-bar">
                        <div class="container">
                           <?php if( $title ) echo  esc_html( travel_agency_pro_get_about_whyus_title() ); ?>
                        </div>
                    </div>
                    <?php } ?>
                     <?php if( $why_us ){ ?>
                    <div class="container">
                        <div class="row">
                             <?php foreach( $why_us as $why ){ 
                            if( $why['whyus-icon'] || $why['title'] || $why['description'] ){ ?>          
                            <div class="col-xs-12 col-sm-3 col-md-3">
                                <div class="wus-single">
                                <?php if( $why['whyus-icon'] ){ ?>
                                    <div class="wus-icon">
                                        <i class="<?php echo esc_attr( $why['whyus-icon'] ); ?>"></i>
                                    </div>
                                    <?php } ?>
                                   <?php if( $why['title'] ){ ?> <h3><?php  echo esc_html( $why['title'] ); ?></h3> <?php } ?>
                                   <?php if( $why['description'] ) echo '<p>'.wp_kses_post( wpautop( $why['description'] ) ).'</p>'; ?>
                                </div>
                            </div>
                            <?php } 
                            }
                            ?>
                            
                        </div>
                    </div>
                    <?php } ?>
                </div>
<?php
}
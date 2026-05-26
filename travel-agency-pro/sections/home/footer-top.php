<?php
/**
 * About Stats Section
 * 
 * @package Travel_Agency_Pro
 */

$title      = get_theme_mod( 'stat_counter_title', __( 'Stats Counter', 'travel-agency-pro' ) );
$content    = get_theme_mod( 'stat_counter_desc', __( 'Display most valuable statistics about your company here. You can modify this section from Appearance > Customize > About Page Settings > Stats Section.', 'travel-agency-pro' ) );
$counter    = get_theme_mod( 'counter', travel_agency_pro_get_customizer_defaults( 'stats' ) );
$bg_image   = get_theme_mod( 'stat_bg_image', get_template_directory_uri() . '/images/fallback/img20.jpg' ); 
$ran        = rand(1,1000); 
if( $bg_image ){
    $bg_img = ' style="background:url(' . esc_url( $bg_image ) . ') no-repeat"';
}else{
    $bg_img = '';
}

if( $title || $content || $counter ){ ?>
<div class="footer-top-row"<?php //echo $bg_img; ?>>
            <div class="container">
                <div class="row">
                <?php if( $counter ){ ?>
                    <?php foreach( $counter as $count ){ ?>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <div class="qs-single">
                        <?php if( $count['icon'] ){ ?>
                            <div class="qs-icon">
                            <i class="fa <?php echo esc_attr( $count['icon'] ); ?>"></i>
                            </div>
                        <?php } ?>
                            <div class="qs-content">
                             <?php if( $count['title'] ){ ?>
                                <strong><?php echo esc_html( $count['title'] ); ?></strong>
                                <?php } ?>
                                <?php  if( $count['number'] ) { ?><p><?php echo wp_kses_post( wpautop($count['number'])); ?></p> <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                  <?php } ?>
                </div>
            </div>
        </div>
<?php 
}
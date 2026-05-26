<?php
/**
 * Activities Section
 * 
 * @package Travel_Agency
 */

$default    = new Travel_Agency_Companion_Dummy_Array;
$obj        = new Travel_Agency_Companion_Functions;
$title      = get_theme_mod( 'activities_title', __( 'Adventure Activities', 'travel-agency-companion' ) );
$content    = get_theme_mod( 'activities_desc', __( 'This is the best place to tell your visitors what travel services your company provide. You can modify this section from Appearance > Customize > Home Page Settings > Adventure Activities Section on your WordPress.', 'travel-agency-companion' ) );
$activities = get_theme_mod( 'activities', $default->default_activities() );

if( $title || $content || $activities ){ ?>

<div class="nat-packageContainer">
                <div class="container">
                <?php if( $title || $content ){ ?>
                <div class="section-heading">
                        <?php 
                            if( $title ) echo '<h1>' . esc_html( travel_agency_companion_get_activities_title() ) . '</h1>';
                            if( $content ) echo '<span>' . wp_kses_post( travel_agency_companion_get_activities_content() ) . '</span>'; 
                        ?>            
                    </div>
                <?php } ?>

                    <?php if( $activities ){ ?>
                    <div class="row">
                        <?php foreach( $activities as $activity ){ ?> 
                        <div class="col-xs-12 col-sm-4 col-md-4 home-cat-single">
                            <div class="destination-grid">
                                <a href="<?php echo esc_url( $activity['url']); ?>">
                                    <?php if( $activity['thumbnail'] ){ 
                                    $img_url = is_numeric( $activity['thumbnail'] ) ? $obj->get_image_url( $activity['thumbnail'] ) : $activity['thumbnail'];
                                        $image_size = array('width' =>600 , 'height' => 400);
                                     ?>                        
                                    <img src="<?=bfi_thumb($img_url,$image_size); ?>" alt="<?php echo esc_attr( $activity['name'] ); ?>" class="img-responsive"/>
                                    <?php }else{ ?>
                                    <img src="<?php echo esc_url( TRAVEL_AGENCY_COMPANION_URL . 'includes/images/fallback-img-300-405.jpg' ); ?>" alt="<?php echo esc_attr( $activity['name'] ); ?>" class="img-responsive"/>
                                    <?php } ?>
                                </a>
                                <div class="mask">
                                    <?php 
                                    if( $activity['name'] ) echo '<h2>' . $activity['name'] . '</h2>'; 
                                    if( $activity['desc'] ) echo '<p>'.wp_kses_post( wpautop( $activity['desc'] ) ).'</p>';
                                    if( $activity['url'] ) echo '<a href="' . esc_url( $activity['url']) . '" class="thm-btn">Read More</a>';
                                    ?>
                                </div>
                                <div class="dest-name">
                                <?php if( $activity['name'] ) echo '<h4>' . esc_html( $activity['name'] ) . '</h4>'; ?>
                                </div>
                            </div>
                        </div>
                       <?php } ?>
                    </div>
                    <?php } ?>
                </div>
</div>
<?php
}
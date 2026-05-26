<?php
/**
 * About Team Section
 * 
 * @package Travel_Agency_Pro
 */

$title      = get_theme_mod( 'about_team_section_title', __( 'Our Team', 'travel-agency-pro' ) );
$content    = get_theme_mod( 'about_team_section_subtitle', __( 'Show your teams to your customers here. You can customize this section from Appearance > Customize > About Page Settings > Team Section.', 'travel-agency-pro' ) );
$post_order = get_theme_mod( 'about_team_post_order', 'date' );
$numpost    = (int) get_theme_mod( 'no_of_team', '12' );
        
$args = array(
    'post_type'      => 'tap_team',
    'post_status'    => 'publish',
    'posts_per_page' => $numpost,
);
if( $post_order == 'menu_order' ){
    $args['order']   = 'ASC';
    $args['orderby'] = 'menu_order';
}

$qry = new WP_Query( $args );

if( $title || $content || $qry->have_posts() ){ ?>
<div class="panel-team">
                    <div class="container">
                    <?php if( $title || $content ){
                    if( $title ) echo ' <h3 class="text-center">' . esc_html( travel_agency_pro_about_team_title() ) . '</h2>';
                    //if( $content ) echo '<div class="section-content">' . wp_kses_post( travel_agency_pro_about_team_sub_title() ) . '</div>'; 
                    }
                    ?>
                    <?php if( $qry->have_posts() ){ ?>
                        <div class="row">
                            <?php while( $qry->have_posts() ){
                            $qry->the_post();
                            $thumb_url_array = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium', false);
                            $image_url = $thumb_url_array[0];
                            $image_size = array('width' =>270 , 'height' => 288);
                            $alt= gia(get_post_thumbnail_id(get_the_ID()));
                            $designation = get_post_meta( get_the_ID(), '_tap_team_position', true ); ?>
                            <div class="col-xs-12 col-sm-3 col-md-3">
                                <div class="team-single">
                                    <?php if($image_url) : ?>
                                    <img src="<?=bfi_thumb($image_url,$image_size); ?>" title="<?php echo $alt['title']; ?>" alt="<?php echo $alt['alt']; ?>" class="img-responsive"/>
                                    <?php endif; ?>
                                    <a href="<?php the_permalink(); ?>">
                                    <?php
                                    the_title( '<h4>', '</h4>' );
                                    ?>
                                    </a>
                                    <?php
                                    if( $designation ) echo '<div class="tm-post">' . esc_html( $designation ) . '</div>';
                                    ?>
                                    <!--                                     
                                    <div class="tm-language"><strong>Language : </strong>English, French</div>
                                    -->                                
                                    </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
<?php
}
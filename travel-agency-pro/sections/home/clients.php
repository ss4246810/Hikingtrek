<?php
/**
 * Client Section
 * 
 * @package Travel_Agency_Pro
 */

$title   = get_theme_mod( 'client_section_title', __( 'Recommended', 'travel-agency-pro' ) );
$clients = get_theme_mod( 'clients_logo', travel_agency_pro_get_customizer_defaults( 'team' ) );
$image   = get_theme_mod( 'client_bg_image', get_template_directory_uri() . '/images/fallback/img30.jpg' );

if( $image ){
    $bg = ' style="background: url(' . esc_url( $image ) . ') no-repeat;"';
}else{
    $bg = '';
}


if( $title || $clients ){ ?>
  <div class="aff-box"<?php echo $bg; ?>>
                  <?php  if( $title ) echo '<span>' . esc_html( travel_agency_pro_get_client_section_title() ) . '</span>'; ?>
                  <?php if( $clients ){ ?>
                        <span>
                            <?php 
                                foreach( $clients as $client )
                                { 
                                $img_url = ( ctype_digit( $client['image'] ) ) ? wp_get_attachment_image_url( $client['image'], 'full' ) : $client['image'];
                                 $alt= gia($client['image']);
                                ?>
                                <?php if(isset( $client['link']) && !empty( $client['link'] ) ) { ?> 
                                <a href="<?php echo esc_url( $client['link'] ); ?>" target="_blank">
                                <img src="<?php echo esc_url( $img_url ); ?>" title="<?php echo $alt['title']; ?>" alt="<?php echo $alt['alt']; ?>">
                                </a>
                                <?php } else { ?>
                                <img src="<?php echo esc_url( $img_url ); ?>" title="<?php echo $alt['title']; ?>" alt="<?php echo $alt['alt']; ?>">
                                <?php } ?>
                        <?php } ?>
                    </span>
                    <?php } ?>
</div>
<?php
}
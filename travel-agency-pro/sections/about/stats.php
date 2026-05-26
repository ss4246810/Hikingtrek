<?php
/**
 * About Stats Section
 * 
 * @package Travel_Agency_Pro
 */

$title      = get_theme_mod( 'about_stat_counter_title', __( 'Stats Counter', 'travel-agency-pro' ) );
$content    = get_theme_mod( 'about_stat_counter_desc', __( 'Display most valuable statistics about your company here. You can modify this section from Appearance > Customize > About Page Settings > Stats Section.', 'travel-agency-pro' ) );
$counter    = get_theme_mod( 'about_counter', travel_agency_pro_get_customizer_defaults( 'stats' ) );
$bg_image   = get_theme_mod( 'about_stat_bg_image', get_template_directory_uri() . '/images/fallback/img20.jpg' ); 
$ran        = rand(1,1000); 
if( $bg_image ){
    $bg_img = ' style="background:url(' . esc_url( $bg_image ) . ') no-repeat"';
}else{
    $bg_img = '';
}

if( $title || $content || $counter ){ ?>
<section id="about_stats" class="stats"<?php echo $bg_img; ?>>
	<div class="container">
    
        <?php if( $title || $content ){ ?>
        <header class="section-header">
			<?php 
                if( $title ) echo '<h2 class="section-title">' . esc_html( travel_agency_pro_get_about_stats_title() ) . '</h2>';
                if( $content ) echo '<div class="section-content">' . wp_kses_post( wpautop( travel_agency_pro_get_about_stats_sub_title() ) ) . '</div>'; 
            ?>
		</header>
        <?php } ?>
        
        <?php if( $counter ){ ?>
        <div class="grid">
            <?php foreach( $counter as $count ){ ?>
            <div class="col">
                <div class="raratheme-sc-holder">
                    <?php 
                    if( $count['title'] ) echo '<h2 class="title">' . esc_html( $count['title'] ) . '</h2>'; 
                    if( $count['icon'] ){ ?>
                        <div class="icon-holder">                            
                            <i class="fa <?php echo esc_attr( $count['icon'] ); ?>"></i>
                        </div>
                        <?php 
                    } 
                    
                    if( $count['number'] ) { 
                        $ran++;
                        $delay = ($ran/1000)*100; ?>
                        <div id="<?php echo esc_attr( $ran );?>" class="hs-counter wow fadeInDown" data-wow-duration="<?php echo esc_attr( $delay/100 . 's' ); ?>">
                            <div class="odometer odometer<?php echo esc_attr( $ran );?>" data-count="<?php echo absint( $count['number'] ); ?>">0</div>
                        </div>
                        <?php 
                    }
                    ?>
                </div>
            </div>
            <?php } ?>                
        </div>
        <?php } ?>
        
	</div>
</section>
<?php 
}
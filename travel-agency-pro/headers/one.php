<?php
/**
 * Header One
 * 
 * @package Travel_Agency_Pro
*/

$ed_social = get_theme_mod( 'ed_social_links', true );
$ed_search = get_theme_mod( 'ed_search', true ); 
?>

<header class="site-header">		
    <div class="header-holder">
        <?php if( $ed_social || $ed_search ){ ?>
        <div class="header-t">
			<div class="container">
				<?php travel_agency_pro_social_links(); ?>
				<div class="tools">
					<?php 
                        travel_agency_pro_get_header_search();
                        
                        /**
                         * Language Switcher
                        */ 
                        do_action( 'travel_agency_pro_language_switcher' );
                    ?>						
				</div>
			</div>
		</div> <!-- .header-t -->        
        <?php } ?>
        
        <div class="header-b">
			<div class="container">
				<?php 
                    travel_agency_pro_site_branding(); 
                    travel_agency_pro_header_phone();
                ?>
			</div>
		</div> <!-- .header-b -->                    
	</div><!-- .header-holder -->
    
    <div class="sticky-holder"></div>
    
    <div class="nav-holder">
		<div class="container">
            <?php travel_agency_pro_primary_nav(); ?> 
		</div>
	</div><!-- .nav-holder -->    
</header><!-- .site-header -->
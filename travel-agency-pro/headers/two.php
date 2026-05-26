<?php
/**
 * Header Two
 * 
 * @package Travel_Agency_Pro
*/
?>

<header class="site-header header-two">
	<div class="header-holder">
		
        <div class="header-t">
			<div class="container">				
                <div class="left">
					<?php 
                        /**
                         * Language Switcher
                        */ 
                        do_action( 'travel_agency_pro_language_switcher' );
                        
                        travel_agency_pro_header_time();
                    ?>
				</div><!-- .left -->				
                <div class="right">
					<?php
                        travel_agency_pro_social_links();
                        travel_agency_pro_header_email();
                    ?>
				</div><!-- .right -->                
			</div>
		</div><!-- .header-t -->        
		
        <div class="header-b">
			<div class="container">
				<?php 
                    travel_agency_pro_site_branding();
                    travel_agency_pro_header_phone();
                ?>
			</div>
		</div><!-- .header-b -->
	</div><!-- .header-holder -->    
	
    <div class="sticky-holder"></div>
    
    <div class="nav-holder">
		<div class="container">
			<div class="holder">
				<?php 
                    travel_agency_pro_primary_nav(); 
                    travel_agency_pro_get_header_search();
                ?>
			</div>
		</div>
	</div><!-- .nav-holder -->
</header><!-- .site-header/.header-two -->
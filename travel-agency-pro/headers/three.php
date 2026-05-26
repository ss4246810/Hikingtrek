<?php
/**
 * Header Three
 * 
 * @package Travel_Agency_Pro
*/
?>

<header class="site-header header-three">
	<div class="header-holder">
		<div class="header-t">
			<div class="container">
				<div class="left">
					<?php
                        travel_agency_pro_header_time();
                        travel_agency_pro_header_email();
                    ?>
				</div><!-- .left -->
				<div class="right">
					<?php travel_agency_pro_social_links(); ?>
				</div><!-- .right -->
			</div>
		</div><!-- .header-t -->        
		<div class="header-b">
			<div class="container">
				<div class="grid">
					<div class="tools">
						<?php 
                            /**
                             * Language Switcher
                            */ 
                            do_action( 'travel_agency_pro_language_switcher' );
                            
                            travel_agency_pro_get_header_search();
                        ?>						
					</div><!-- .tools -->
					<?php 
                        travel_agency_pro_site_branding();
                        travel_agency_pro_header_phone();
                    ?>                    
				</div><!-- .grid -->
			</div>
		</div><!-- .header-b -->        
	</div><!-- .header-holder -->	
	
    <div class="sticky-holder"></div>
    
    <div class="nav-holder">
		<div class="container">
			<?php travel_agency_pro_primary_nav(); ?>
		</div>
	</div><!-- .nav-holder -->
</header><!-- .site-header/.header-three -->
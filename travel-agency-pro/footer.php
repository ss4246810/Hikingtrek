<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Travel_Agency_Pro
 */

    /**
     * After Content
     * 
     * @hooked travel_agency_pro_content_end - 20
    */
   // do_action( 'travel_agency_pro_before_footer' );
    
 ?>
 <footer>
        <?php if ( is_front_page() ) { 
        include_once( 'sections/home/footer-top.php' ); 
        }
        ?>
        <div class="footer-bottom-row">
            <div class="container">
                <div class="row">
                	<div class="col-xs-12 col-sm-3 col-md-3">
                        <h3>Quick Links</h3>
                        <ul class="list-act">
                            <?php
                                wp_nav_menu( array(
                                'theme_location' => 'adventure-activities',
                                'items_wrap'    => '%3$s',
                                'container'      => '',
                                'walker' => new Nav_Walker(),
                                ) );
                                ?>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <h3>Trekking in Nepal</h3>
                        <ul class="list-act">
                                <?php
                                wp_nav_menu( array(
                                'theme_location' => 'trekking',
                                'items_wrap'    => '%3$s',
                                'container'      => '',
                                'walker' => new Nav_Walker(),
                                ) );
                                ?>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <h3>Peak Climbing</h3>
                        <ul class="list-act">
                            <?php
                                wp_nav_menu( array(
                                'theme_location' => 'peak-climbing',
                                'items_wrap'    => '%3$s',
                                'container'      => '',
                                'walker' => new Nav_Walker(),
                                ) );
                                ?>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <h3>Other Activities</h3>
                        <ul class="list-act">
                            <?php
                                wp_nav_menu( array(
                                'theme_location' => 'sightseeing-tours',
                                'items_wrap'    => '%3$s',
                                'container'      => '',
                                'walker' => new Nav_Walker(),
                                ) );
                                ?>
                        </ul>
                    </div>
                    
                </div>
                <div class="footer-contact">
                    <?php
                    $phone   = get_theme_mod( 'contact_phone', __( '(888) 123-456789', 'travel-agency-pro' ) );
                    $email   = get_theme_mod( 'contact_email', __( 'info@testing.com, info@gmail.com, support@test.com', 'travel-agency-pro' ) );
                    $address = get_theme_mod( 'contact_address', __( 'Travel Agency. PO Box 19604, Thamel Kathmandu, Nepal', 'travel-agency-pro' ) );
                    ?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4 con-box">
                            <span class="con-icon"><i class="fa fa-map-marker"></i></span>
                            <div class="con-box-inner">
                                <?php if( $address ) { ?>
                                    <?php echo $address; ?>
                                    <?php } ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 con-box">
                            <span class="con-icon"><i class="fa fa-envelope"></i></span>
                            <div class="con-box-inner">
                                <?php if( $email ) { ?>
                                    <?php echo $email; ?>
                                    <?php } ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 con-box">
                            <span class="con-icon"><i class="fa fa-phone"></i></span>
                            <div class="con-box-inner">
                                    <?php if( $phone ) { ?>
                                    <?php echo $phone; ?>
                                    <?php } ?>
                                    <div class="skype-box">
                                    	<a href="skype:nepal.alsace?call"><i class="fa fa-skype"></i> nepal.alsace</a>
                                    </div>
                                    </div>
                                    </div>
                            </div>
                        </div>
               <?php include_once( 'sections/home/clients.php' ); ?>
            </div>
        </div>
        <div class="footer-copr">
           <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        © <?php echo date('Y'); ?> All rights reserved to <?php bloginfo( 'name' ); ?>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 text-right">
                        Website Designed &amp; Developed By: <a href="https://www.bestnepal.net" target="_blank">Best Nepal</a>
                    </div>
                </div>
           </div>
        </div>
</footer>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easytabs.min.js" type="text/javascript"></script>
<script type="text/javascript">
    (function($) {
         $('#tab-container').easytabs();
    })(jQuery);
    
</script>

<?php 
   /**
     * Footer
     * 
     * @hooked travel_agency_pro_footer_start  - 20
     * @hooked travel_agency_pro_footer_top    - 30
     * @hooked travel_agency_pro_footer_bottom - 40
     * @hooked travel_agency_pro_footer_end    - 50
    */
    //do_action( 'travel_agency_pro_footer' );
    
    /**
     * After Footer
     * 
     * @hooked travel_agency_pro_page_end - 20
    */
   // do_action( 'travel_agency_pro_after_footer' );   
wp_footer(); ?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5dc7acf343be710e1d1c929b/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>
</html>

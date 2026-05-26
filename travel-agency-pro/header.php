<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Travel_Agency_Pro
 */

    /**
     * Doctype Hook
     * 
     * @hooked travel_agency_pro_doctype
    */
    do_action( 'travel_agency_pro_doctype' );   
?>
<head>
<?php     
    /**
     * Before wp_head
     * 
     * @hooked travel_agency_pro_head
    */
    do_action( 'travel_agency_pro_before_wp_head' );
    
    wp_head(); 
?>
<meta name="google-site-verification" content="eupoy6b9xIeZNzFv42V15ioBRyuPfVaC-RnvNCmo188" />
<script src='https://www.google.com/recaptcha/api.js'></script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-46727459-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-46727459-1');
</script>

</head>

<body <?php body_class(); ?>>
	
<?php
    /**
     * Before Header
     * 
     * @hooked travel_agency_pro_page_start - 20 
    */
    //do_action( 'travel_agency_pro_before_header' );
    
    /**
     * Lawyer_Landing_Page Header
     * 
     * @hooked travel_agency_pro_header - 20     
    */
    //do_action( 'travel_agency_pro_header' );
    
    /**
     * Before Content
     * 
     * @hooked travel_agency_pro_breadcrumb - 20
    */
    //do_action( 'travel_agency_pro_after_header' );
    
    /**
     * Lawyer_Landing_Page Content
     * 
     * @hooked travel_agency_pro_content_start
    */
    //do_action( 'travel_agency_pro_content' );
    ?>
    <nav id="menu" class="smallDevice-only">
 <?php echo travel_agency_pro_mobile_nav(); ?>
</nav>
<div class="pageWhole-wrapper" id="page"> 
  <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]--> 
  
  <!------------------ Small device header ---------------->
    <div class="header mobileHeader smallDevice-only">
    	<div class="mbl-row">
			<?php echo travel_agency_pro_site_branding(); ?>
            <div class="call-section phone-box">
				<?php echo travel_agency_pro_header_phone(); ?>
            </div>
        </div>
        <div class="menu-bar">
        	<div class="menu-row">
            	<div class="menu-cell">
                	MENU
                </div>
                <div class="menu-cell">
                	<a href="#menu" class="mobileHamburger"></a>
                </div>
            </div>
        </div>
        
    </div>
    <header class="fixed-bar largeDevice-only">
        <div class="top-row">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    
                    <div class="call-section phone-box">
                        <span><i class="fa fa-phone"></i></span>
                        <?php echo travel_agency_pro_header_phone(); ?>
                    </div>
                    
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4" style="    text-align: center;">
                    <div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false, gaTrack: true, gaId: 'UA-120965842-1'}, 'google_translate_element');
}
</script>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="top-social-icons">
                        <div class="call-section pad-left-0">
                        	<span><i class="fa fa-envelope"></i></span>
                            <?php echo travel_agency_pro_header_email(); ?>
                            </div>
                            <?php echo travel_agency_pro_social_links(); ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="nav-row">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-4 col-sm-4">
                        <?php echo travel_agency_pro_site_branding(); ?>
                    </div>
                    <div class="col-xs-12 col-md-8 col-sm-8">
                    <?php echo travel_agency_pro_primary_nav(); ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
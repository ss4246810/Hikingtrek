jQuery(document).ready(function($){
    //Scroll to section
    $('body').on('click', '#sub-accordion-panel-home_page_setting .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    });
    
    $('body').on('click', '#sub-accordion-panel-about_page_setting .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToAboutSection( section_id );
    }); 
    
    $('body').on('click', '#sub-accordion-panel-contact_page_setting .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToContactSection( section_id );
    });
     
});

function scrollToSection( section_id ){
    var preview_section_id = "banner_section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-about_us_section':
        preview_section_id = "about_section";
        break;

        case 'accordion-section-activities_section':
        preview_section_id = "activities_section";
        break;

        case 'accordion-section-popular_section':
        preview_section_id = "popular_section";
        break;

        case 'accordion-section-whyus_section':
        preview_section_id = "whyus_section";
        break;

        case 'accordion-section-featured_section':
        preview_section_id = "featured_section";
        break;
        
        case 'accordion-section-stat_section':
        preview_section_id = "stat_section";
        break;

        case 'accordion-section-deal_section':
        preview_section_id = "deal_section";
        break;
        
        case 'accordion-section-testimonial_section':
        preview_section_id = "testimonial_section";
        break;

        case 'accordion-section-cta_section':
        preview_section_id = "cta_section";
        break;

        case 'accordion-section-blog_section':
        preview_section_id = "blog_section";
        break;
        
        case 'accordion-section-client_section':
        preview_section_id = "client_section";
        break;
        
        case 'accordion-section-sort_home_section':
        preview_section_id = "banner_section";
        break;
        
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}

function scrollToAboutSection( section_id ){
    var preview_section_id = "about_intro";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-client_about_section':
        preview_section_id = "about_clients";
        break;

        case 'accordion-section-whyus_about_section':
        preview_section_id = "about_whyus";
        break;

        case 'accordion-section-service_about_section':
        preview_section_id = "service_section";
        break;
        
        case 'accordion-section-stat_about_section':
        preview_section_id = "about_stats";
        break;
        
        case 'accordion-section-about_testimonial_section':
        preview_section_id = "about_testimonial";
        break;
        
        case 'accordion-section-about_team_section':
        preview_section_id = "about_team";
        break;
        
        case 'accordion-section-intro_about_section':
        case 'accordion-section-sort_about_section':
        preview_section_id = "about_intro";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.page-template-about').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}

function scrollToContactSection( section_id ){
    var preview_section_id = "map-canvas";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-google_map_settings':
        preview_section_id = "map-canvas";
        break;

        case 'accordion-section-contact_detail_settings':
        preview_section_id = "contact_info_section";
        break;

        case 'accordion-section-contact_form_settings':
        preview_section_id = "form_section";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.page-template-contact').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}
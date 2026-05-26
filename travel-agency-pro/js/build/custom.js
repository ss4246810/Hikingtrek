jQuery(document).ready(function($){
	
    //wow animatioin in site
	var wow = new WOW({});
	wow.init();

	//Header Search form show/hide
    $('html').click(function() {
        $('.site-header .form-holder').slideUp();
    });

    $('.site-header .form-section').click(function(event) {
        event.stopPropagation();
    });
    $("#btn-search").click(function() {
        $(".site-header .form-holder").slideToggle();
        return false;
    });

    //mobile menu
    var winWidth = $(window).width();
    if (winWidth < 1025) {
        $('#site-navigation ul li.menu-item-has-children').append('<span class="fa fa-caret-down"></span>');
        $('#site-navigation ul li .fa').click(function() {
            $(this).prev().slideToggle();
            $(this).toggleClass('active');
        });

        $('#primary-toggle-button').click(function() {
            $('.main-navigation').slideToggle();
        });
    }
    
    /** Variables from Customizer for Slider settings */
    var slider_auto, slider_loop, rtl;
    if( tap_data.auto == '1' ){
        slider_auto = true;
    }else{
        slider_auto = false;
    }
    
    if( tap_data.loop == '1' ){
        slider_loop = true;
    }else{
        slider_loop = false;
    }
    
    if( tap_data.rtl == '1' ){
        rtl = true;
    }else{
        rtl = false;
    }
    
    //Banner Slider        
    $("#banner-carousel").owlCarousel({
        items       : 1,
        animateOut  : tap_data.animation,
        loop        : slider_loop,
        autoplay    : slider_auto,
        nav         : true,
        lazyLoad    : true,
        rtl         : rtl,
        dots        : false,
        navText: ['<svg height="65" width="65"><circle id="circle" cx="12" cy="33" r="30" transform="rotate(-90, 22, 22)" fill="rgba(0, 0, 0, 0.5)"/></svg> ', ' <svg height="65" width="65"><circle cx="12" cy="33" r="30" transform="rotate(-90, 22, 22)" fill="rgba(0, 0, 0, 0.5)"/></svg> ']
    });
    
    //testimonial slider
    $('#testimonial-carousel').owlCarousel({
        nav     : true,
        dots    : true,
        items   : 1,
        center  : true,
        loop    : true,
        rtl     : rtl,
        navText : ['<svg height="65" width="65"><circle id="circle" cx="12" cy="33" r="30" transform="rotate(-90, 22, 22)" fill="rgba(0, 0, 0, 0.5)"/></svg> ', ' <svg height="65" width="65"><circle cx="12" cy="33" r="30" transform="rotate(-90, 22, 22)" fill="rgba(0, 0, 0, 0.5)"/></svg> '],
        responsive: {
            //breakpoint from 1700 and up
            1700:{
                stagePadding: 620,
                margin: 150,
            },
            //breakpoint from 1430 and up
            1430: {
                stagePadding: 320,
                margin: 150,
            },
            //breakpoint from 1200 and up
            1025: {
                stagePadding: 300,
                margin: 180,
            },
            //breakpoint from 768 and up
            768: {
                stagePadding: 150,
                margin: 100,
            },
            //breakpoint from 0 and up
            0: {
                stagePadding: 0,
                margin: 0,
            }
        }
    });

    // clients slider
    $('#clients-slider').owlCarousel({
        margin  : 30,
        nav     : true,
        dots    : false,
        rtl     : rtl,
        navText : ['<svg height="43" width="43"><circle id="circle" cx="22" cy="22" r="20" transform="rotate(-90, 22, 22)"/></svg> ', ' <svg height="43" width="43"><circle cx="22" cy="22" r="20" transform="rotate(-90, 22, 22)"/></svg> '],
        responsive: {
            //breakpoint from 0 and above
            0: {
                items: 1
            },
            //breakpoint from 768 and up
            768: {
                items: 3
            },
            //breakpoints from 1025 and up
            1025: {
                items: 5
            }
        }
    });
    
    //team page slider
    $('#team-slider').owlCarousel({
        margin  : 0,
        nav     : true,
        dots    : false,
        items   : 1,
        rtl     : rtl,
        navText : ['<svg height="65" width="65"><circle id="circle" cx="12" cy="33" r="30" transform="rotate(-90, 22, 22)" fill="rgba(0, 0, 0, 0.5)"/></svg> ', ' <svg height="65" width="65"><circle cx="12" cy="33" r="30" transform="rotate(-90, 22, 22)" fill="rgba(0, 0, 0, 0.5)"/></svg> ']
    });
    
    // Script for back to top
    $(window).scroll(function(){
        if($(this).scrollTop() > 300){
          $('#rara-top').fadeIn();
        }else{
          $('#rara-top').fadeOut();
        }
    });
        
    $("#rara-top").click(function(){
        $('html,body').animate({scrollTop:0},600);
    });
    
    /** Ajax call for post like */
    $('body').on( 'click', '.like', function(){
        var $container = $(this); 
        id = $container.attr('id').split('-').pop();
        $.ajax({
			type :'post',
            url  : tap_data.url, 
			data : {  'action' : 'travel_agency_pro_post_like', 'id' : id },
			beforeSend: function() {
                $container.addClass('loading');
			},
			success: function(data) {
				$container.html( '<i class="fa fa-heart-o"></i>'+ data );
			}
        }).done(function() {
            $container.removeClass('loading');
        });      
    });
    
    /** Lightbox */
    if( tap_data.lightbox == '1' ){        
        $('.entry-content').find('.gallery-columns-1').find('.gallery-icon > a').attr( 'rel', 'group1' );
        $('.entry-content').find('.gallery-columns-2').find('.gallery-icon > a').attr( 'rel', 'group2' );
        $('.entry-content').find('.gallery-columns-3').find('.gallery-icon > a').attr( 'rel', 'group3' );
        $('.entry-content').find('.gallery-columns-4').find('.gallery-icon > a').attr( 'rel', 'group4' );
        $('.entry-content').find('.gallery-columns-5').find('.gallery-icon > a').attr( 'rel', 'group5' );
        $('.entry-content').find('.gallery-columns-6').find('.gallery-icon > a').attr( 'rel', 'group6' );
        $('.entry-content').find('.gallery-columns-7').find('.gallery-icon > a').attr( 'rel', 'group7' );
        $('.entry-content').find('.gallery-columns-8').find('.gallery-icon > a').attr( 'rel', 'group8' );
        $('.entry-content').find('.gallery-columns-9').find('.gallery-icon > a').attr( 'rel', 'group9' );
        
        $("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.png'],a[href$='.gif']").fancybox();        
    }
    
    /** Sticky Header */
    var windowWidth = $(window).width();
    var header_layout = tap_data.h_layout;
    
    if( tap_data.sticky == '1' && windowWidth >= 1024 ){
        var mns = "sticky-menu";
        holder = ( header_layout == 'five' ) ? $('.header-t') : $('.header-holder');
        navhol = ( header_layout == 'five' ) ? $('.header-b') : $('.site-header .nav-holder');
        
        hdr = holder.outerHeight();
        nav = navhol.outerHeight();
        
        //mn = $(".header-b");
        
        $(window).scroll(function() {
            if( $(this).scrollTop() > hdr ) {
                navhol.addClass(mns);
                $('.sticky-holder').height(nav);
            }else{
                navhol.removeClass(mns);
                $('.sticky-holder').height(0);
            }
        });
    }

});
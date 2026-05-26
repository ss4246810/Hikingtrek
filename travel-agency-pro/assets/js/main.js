$(document).ready(function(){
	$('body').hide().fadeIn(1500);
	// Mobile menu -------------	
		$('nav#menu').mmenu({
				extensions	: [ 'effect-slide-menu', 'pageshadow' ],
				searchfield	: true,
				counters	: true,
				offCanvas: {
				position  : "right",
				zposition : "back"
			}
		});
		// Royal Slider //
		$(".royalSlider").royalSlider({
				autoScaleSliderHeight: 700,
				autoHeight: true,
				autoScaleSlider:false,
				imageScaleMode:'none',
				imageAlignCenter: false,
				imageScaleMode: 'none',
				loopRewind: true,
				loop: true,     
				arrowsNav: true,
				navigateByClick: false,
				sliderDrag: false,
				slidesOrientation: 'horizontal',
				transitionType: 'move',
				usePreloader: true, 
				controlsInside: true,
				arrowsNavAutoHide: true,
				arrowsNavHideOnTouch: true,
				transitionSpeed: 1000,
				controlNavigation: 'bullets',
				imgHautoHeighteight: null,
				autoPlay: {
					enabled: true,
					pauseOnHover: true,
					delay: 6000
				}
		}); 
		
		// DatePicker //
		$('[data-toggle="datepicker"]').datepicker({
			autoHide: true,
			zIndex: 2048,
		});
		
		/* Review slider */	 
	$("#review-carousel").owlCarousel({
		margin: 20,
		autoplay:false,
		nav: false,
		dots: true,
		loop: true,
		responsive: {
		  0: {
			items: 1
		  },
		  600: {
			items: 1
		  },
		  1000: {
			items: 1
		  }
		}
	})
});	

function myFunction() {
    document.getElementById("lang-dropdown").classList.toggle("show");
}
// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

$(function () {
    $(".home-package-single").slice(0, 12).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".home-package-single:hidden").slice(0, 8).slideDown();
        if ($(".home-package-single:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 1500);
    });
});
/*document.getElementById("btn-send-dis").disabled = true;
function enableBtn(){
	document.getElementById("btn-send-dis").disabled = false;
}*/
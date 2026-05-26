jQuery(document).ready(function($){
    
    var screen = tap_admin.screen;
    
    //Sortable for Team social links
    $('.tap-team-sortable-icons').sortable({
        cursor: "move"
    });     
    
    //datepicker for testimonail trip
    $('#trip-date').datepicker({ 
        maxDate: 0, 
        changeMonth: true,
        changeYear: true, 
        dateFormat: 'MM yy', 
        yearRange: "-100:+0" 
    });
    
    if( screen == 'tap_testimonial' ){
        var val = $("#trip-rating").val();
        $( "#rate-" + tap_admin.id ).rateYo({
         	onSet: function( rating, rateYoInstance ){
          		$("#trip-rating").val(rating);
        	}
      	});
        if( val ){
            $( "#rate-" + tap_admin.id ).rateYo( "rating", val );
        }
    }

    // Meta box hide selecting the template
    var post_type = tap_admin.post_type;
    function check_page_templates(){
        $('.inside #page_template').each(function(i,e){
            if( ( $(this).val() === "templates/about.php" )|| ( $(this).val() === "templates/contact.php" ) || ( $(this).val() === "templates/template-activities.php" ) || ( $(this).val() === "templates/template-destination.php" ) || ( $(this).val() === "templates/template-trip_types.php" )  ){
                $('#travel_agency_pro_sidebar_layout').hide();
            }else{
                $('#travel_agency_pro_sidebar_layout').show();
            }
        });
    }
    if( post_type == 'page' ){
        $('.inside #page_template').on( 'change', check_page_templates );
        check_page_templates();
    }else{
        $('#travel_agency_pro_sidebar_layout').show();
    }
    check_page_templates();
        
});
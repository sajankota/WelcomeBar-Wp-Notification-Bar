(function($) {
    "use strict";

    $( document ).ready(function() {
         $('#_rcbwb_themes_header_type,#_rcbwb_notification_transparent_selector, .pro, [name="_rcbwb_notification_schedule"],#_rcbwb_notification_schedule_datetime_date,#_rcbwb_notification_schedule_datetime_time,#_rcbwb_notification_where_to_show3, #_rcbwb_notification_where_to_show4').attr("disabled", true);

     $( 'span.pro,.cmb-th label span' ).click(function() {
     	$( "#rcbwb_dialog" ).dialog({
     		modal: true,
     		minWidth: 500,
     		buttons: {
                Ok: function() {
                  $( this ).dialog( "close" );
                }
            }
     	});
     });
         
        
    });

})(jQuery);
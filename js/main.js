(function ($) {
    "use strict";

$( document ).ready(function() {

/*-- Notification --*/
var $body = $('body');
var $window = $(window);

/*-- Notification --*/
var $notificationSection = $('.rcbwb-notification-section');
    
/*-- Notification Height --*/
var $notiTopHeight = $('.rcbwb-notification-section.rcbwb-n-top').height();
var $notiBottomHeight = $('.rcbwb-notification-section.rcbwb-n-bottom').height();
    
/*-- Open & Close Button --*/
var $openToggle = $('.rcbwb-n-open-toggle');
var $closeToggle = $('.rcbwb-n-close-toggle');

    
/*-- Body Padding For Default Open Notification --*/
if($notificationSection.hasClass('rcbwb-n-top rcbwb-n-open')) {
    
    $body.css('padding-top', $notiTopHeight);
    
}
if( $notificationSection.hasClass('rcbwb-n-bottom rcbwb-n-open') ) {
    
    $body.css('padding-bottom', $notiBottomHeight);
    
}
    
/*-- Body Padding For Default Closed Notification --*/
if( $notificationSection.hasClass('rcbwb-n-top rcbwb-n-close')) {
    
   $body.css('padding-top', '0px');
    
}
if( $notificationSection.hasClass('rcbwb-n-bottom rcbwb-n-close')) {
    
    $body.css('padding-bottom', '0px');
    
}
    
/*-- Closed Notification Open Icon Active Class --*/
if( $notificationSection.hasClass('rcbwb-n-close') ) {
    
   $('.rcbwb-n-close').find('.rcbwb-n-open-toggle').addClass('rcbwb-n-active');
    
}
 
    
/*-- Closed Notification --*/
if( $notificationSection.hasClass('rcbwb-n-top rcbwb-n-close') ) {
    
   $('.rcbwb-n-top.rcbwb-n-close').find('.rcbwb-notification-wrap').slideUp();
    
}
if( $notificationSection.hasClass('rcbwb-n-bottom rcbwb-n-close') ) {
    
   $('.rcbwb-n-bottom.rcbwb-n-close').find('.rcbwb-notification-wrap').slideUp();
    
}


/*-- left and right notification  --*/
var nLeftSection = $('.rcbwb-n-left');
var nLeftSectionWidth = nLeftSection.width();
var nRightSection = $('.rcbwb-n-right');
var nRightSectionWidth = nRightSection.width();

if( nLeftSection.hasClass('rcbwb-n-close') ) {
    
   nLeftSection.css({
    'left': -1 * nLeftSectionWidth + 'px',
   });
    
}
if( nRightSection.hasClass('rcbwb-n-close') ) {
    
   nRightSection.css({
    'right': -1 * nRightSectionWidth + 'px',
   });
    
}


/*-- Notification Close Function --*/
$closeToggle.on('click', function(e){
    e.preventDefault();
    
    var nSection = $(this).parents('.rcbwb-notification-buttons').parents('.rcbwb-notification-wrap').parents('.rcbwb-notification-section');
    var nSectionWidth = nSection.width();
    
    /* Open Toggle */
    nSection.find('.rcbwb-n-open-toggle').addClass('rcbwb-n-active');

    /* Top, Bottom, Left & Right Animation */
    if( nSection.hasClass('rcbwb-n-top') ){
        
        nSection.removeClass('rcbwb-n-open').addClass('rcbwb-n-close');
        nSection.find('.rcbwb-notification-wrap').slideToggle();
        $body.css('padding-top', '0px');
        
    }else if( nSection.hasClass('rcbwb-n-bottom') ){
        
        nSection.removeClass('rcbwb-n-open').addClass('rcbwb-n-close');
        nSection.find('.rcbwb-notification-wrap').slideToggle();
        $body.css('padding-bottom', '0px');
        
    }else if( nSection.hasClass('rcbwb-n-left') ){
        
        nSection.removeClass('rcbwb-n-open').addClass('rcbwb-n-close');
        nSection.css({
            'left' : -1 * nSectionWidth + 'px',
        });
        
    }else if( nSection.hasClass('rcbwb-n-right') ){
        
        nSection.removeClass('rcbwb-n-open').addClass('rcbwb-n-close');
        nSection.css({
            'right' : -1 * nSectionWidth + 'px',
        });
        
    }
    
});

/*-- Notification Open Function --*/
$openToggle.on('click', function(e){
    e.preventDefault();
    
    var nSection = $(this).parents('.rcbwb-notification-section');
    
    /* Open Toggle */
    nSection.find('.rcbwb-n-open-toggle').removeClass('rcbwb-n-active');

    /* Top, Bottom, Left & Right Animation */
    if( nSection.hasClass('rcbwb-n-top') ){
        
        nSection.removeClass('rcbwb-n-close').addClass('rcbwb-n-open');
        nSection.find('.rcbwb-notification-wrap').slideToggle();
        $body.css('padding-top', $notiTopHeight);
        
    }else if( nSection.hasClass('rcbwb-n-bottom') ){
        
        nSection.removeClass('rcbwb-n-close').addClass('rcbwb-n-open');
        nSection.find('.rcbwb-notification-wrap').slideToggle();
        $body.css('padding-bottom', $notiBottomHeight);
        
    }else if( nSection.hasClass('rcbwb-n-left') ){
        
        nSection.removeClass('rcbwb-n-close').addClass('rcbwb-n-open');
        nSection.css('left', '0px');
        nSection.find('.rcbwb-notification-wrap').show();
        
    }else if( nSection.hasClass('rcbwb-n-right') ){
        
        nSection.removeClass('rcbwb-n-close').addClass('rcbwb-n-open');
        nSection.css('right', '0px');
        nSection.find('.rcbwb-notification-wrap').show();
        
    }
    
});

$window.on('scroll', function() {
    var $scroll = $window.scrollTop();
    
    if ( $scroll > 400 && $notificationSection.hasClass('rcbwb-n-close rcbwb-n-scroll rcbwb-n-top') ) {
        
        var topSection = $('.rcbwb-n-top.rcbwb-n-scroll');
        /* Open Toggle */
        topSection.find('.rcbwb-n-open-toggle').removeClass('rcbwb-n-active');
        topSection.removeClass('rcbwb-n-close rcbwb-n-scroll').addClass('rcbwb-n-open');
        topSection.find('.rcbwb-notification-wrap').slideDown();
        topSection.parents('body').css('padding-top', $notiTopHeight);
        
    }
    
    if ( $scroll > 800 && $notificationSection.hasClass('rcbwb-n-close rcbwb-n-scroll rcbwb-n-bottom') ) {
        
        var bottomSection = $('.rcbwb-n-bottom.rcbwb-n-scroll');
        /* Open Toggle */
        bottomSection.find('.rcbwb-n-open-toggle').removeClass('rcbwb-n-active');
        bottomSection.removeClass('rcbwb-n-close rcbwb-n-scroll').addClass('rcbwb-n-open');
        bottomSection.find('.rcbwb-notification-wrap').slideDown();
        bottomSection.parents('body').css('padding-bottom', $notiBottomHeight);
        
    }
    
    if ( $scroll > 1200 && $notificationSection.hasClass('rcbwb-n-close rcbwb-n-scroll rcbwb-n-left') ) {
        
        var leftSection = $('.rcbwb-n-left.rcbwb-n-scroll');
        /* Open Toggle */
        leftSection.find('.rcbwb-n-open-toggle').removeClass('rcbwb-n-active');
        leftSection.removeClass('rcbwb-n-close rcbwb-n-scroll').addClass('rcbwb-n-open');
        leftSection.css('left', '0px');
        leftSection.find('.rcbwb-notification-wrap').show();
      
    }
    
    if ( $scroll > 1600 && $notificationSection.hasClass('rcbwb-n-close rcbwb-n-scroll rcbwb-n-right') ) {
        
        var rightSection = $('.rcbwb-n-right.rcbwb-n-scroll');
        /* Open Toggle */
        rightSection.find('.rcbwb-n-open-toggle').removeClass('rcbwb-n-active');
        rightSection.removeClass('rcbwb-n-close rcbwb-n-scroll').addClass('rcbwb-n-open');
        rightSection.css('right', '0px');
        rightSection.find('.rcbwb-notification-wrap').show();
        
    }
    
});

});


})(jQuery);
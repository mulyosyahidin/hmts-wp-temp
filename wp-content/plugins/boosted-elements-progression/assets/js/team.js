jQuery(document).ready(function($) {
	 'use strict';
/*! Mobile Flip JavaScript */
$('.boosted-elements-team-image')
.live('touchstart', function(){
    isScrolling = false;
})
.live('touchmove', function(e){
    isScrolling = true;
})
.live('touchend', function(e){
    if( !isScrolling )
    {
        window.location = $(this).attr('href');
    }
});

});
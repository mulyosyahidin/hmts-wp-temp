jQuery(document).ready(function($) {
	 'use strict';

/*! Mobile Flip JavaScript */
$('.boosted-elements-progression-flip-box-container')
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
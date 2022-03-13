jQuery(document).ready(function($) {
	 'use strict';
     
    var hidesearch = false;
 	var clickOrTouch = (('ontouchend' in window)) ? 'touchend' : 'click';
	
  	$(".boosted-elements-progression-search-container .boosted-elements-progression-search-ico").on(clickOrTouch, function(e) {
 		var clicks = $(this).data('clicks');
 		  if (clicks) {
 		     $(".boosted-elements-progression-search-container").removeClass("boosted-elements-active-search-icon-pro");
 		     $(".boosted-elements-progression-search-container").addClass("boosted-elements-hide-search-icon-pro");
			 
 		  } else {
 		     $(".boosted-elements-progression-search-container").addClass("boosted-elements-active-search-icon-pro");
 			  $(".boosted-elements-progression-search-container").removeClass("boosted-elements-hide-search-icon-pro");
 		  }
 		  $(this).data("clicks", !clicks);
  	});
     
     
});
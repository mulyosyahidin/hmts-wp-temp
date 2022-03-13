jQuery(document).ready(function($) {
	 'use strict';
     
     var hidecart = false;
     $("#boosted-elements-shopping-cart-count").hover(function(){
         if (hidecart) clearTimeout(hidecart);
 		$("#boosted-elements-shopping-cart-count").addClass("boosted-cart-activated-class").removeClass("boosted-cart-hover-out-class");
     }, function() {
         hidecart = setTimeout(function() { 
 			$("#boosted-elements-shopping-cart-count").removeClass("boosted-cart-activated-class").addClass("boosted-cart-hover-out-class");
 		}, 100);
     });
     

});
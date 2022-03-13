/**
 * Progression Mega Menu Framework
 *
 */
jQuery(document).ready(function($) {
	 'use strict';
	
    //$('.boosted-elements-mega-for').prop( 'checked', true ); Messes up the javascript by automatically checking them all
    
    $('.boosted-elements-mega-for').change(function(){
        if($(this).is(':checked')){
            $( this ).parents( '.menu-item:eq( 0 )' ).addClass("boosted-selector-megamenu");
            
            $( this ).parents( '.menu-item:eq( 0 )' ).addClass("boosted-selector-megamenu");
            
        } else {
            $( this ).parents( '.menu-item:eq( 0 )' ).removeClass("boosted-selector-megamenu");
        }
    }).change();

});

( function( $ ) {
	var settings_page = {};


	// Change CallBack - - - - - - - - - - - - - - - - - - - - - - - - -

	function handlescroll_viewport ( newValue ) {
		if(newValue){
			// SI

		}else{
			// NO

		}

	}

	$( window ).on( 'elementor/frontend/init', function() {


	} );

	window.onload = function() {

	};

	$( document ).on( 'ready', function() {
		if( typeof elementorFrontendConfig.settings.page !== 'undefined' ){
			if ( elementorFrontend.isEditMode() ){
				settings_page = elementorFrontendConfig.settings.page;
			}else{
				settings_page = JSON.parse( $('.elementor').attr('data-elementor-settings') );
			}

			if( settings_page ){
				if ( elementorFrontend.isEditMode() ){
					elementor.settings.page.addChangeCallback( 'scroll_viewport', handlescroll_viewport );

				}
			}
		}

	} );
} )( jQuery );

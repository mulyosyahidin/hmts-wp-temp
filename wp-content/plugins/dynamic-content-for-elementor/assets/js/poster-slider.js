( function( $ ) {
	var WidgetElements_PosterSliderHandler = function( $scope, $ ) {
		console.log( $scope );

		$scope.find('.dce-sliderposter-wrap').slick({
			dots: true,
			infinite: false,
			speed: 300,
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: false,
			fade: true,
		    focusOnSelect: true,
		    infinite: true,
			speed: 700,
			prevArrow : '<button type="button" class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
			nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
        });
	};

	// Make sure you run this code under Elementor..
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/dyncontel-posterSlider.default', WidgetElements_PosterSliderHandler );
	} );
} )( jQuery );

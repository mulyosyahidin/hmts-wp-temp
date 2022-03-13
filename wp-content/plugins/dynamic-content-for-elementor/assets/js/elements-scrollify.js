( function( $ ) {
	var settings_page = {};
	var is_scrollify = false;
	var PosttElements_ScrollifyHandler = function( ) {

		$('body').addClass('dce-scrollify dce-scrolling');

		if( settings_page.custom_class_section_sfy ){
	        $customClass = settings_page.custom_class_section_sfy;
    	}else{
    		$customClass = 'elementor-section';
    	}

    	$target_sections = '.elementor-'+settings_page.scroll_id_page;
    	if(!$target_sections) $target_sections = '';

    	var sezioni = $target_sections + '.elementor > .elementor-inner > .elementor-section-wrap > .' + $customClass;

    	// Class direction
    	$($target_sections).addClass('scroll-direction-'+settings_page.directionScroll);
    	/*if( settings_page.directionScroll == 'vertical' ){

		}*/


		// --------------------------------------------------------
		// --------------------------------------------------------

		$.scrollify({
		    section : sezioni,
		    sectionName : 'id',
		    interstitialSection : settings_page.interstitialSection, //"header, footer.site-footer",
		    //easing: settings_page.ease_scrollify || "easeOutExpo",
		    scrollSpeed: Number(settings_page.scrollSpeed.size) || 1100, //1100,
		    offset : Number(settings_page.offset.size) || 0, //0,

		    //scrollbars:  Boolean( settings_page.scrollbars ), //true,

		    // standardScrollElements: "",

		    setHeights: Boolean( settings_page.setHeights ), //true,
		    overflowScroll: Boolean( settings_page.overflowScroll ), //true,
		    updateHash: Boolean( settings_page.updateHash ), //true,
		    touchScroll: Boolean( settings_page.touchScroll ), //true,
		    // before:function() {},
		    // after:function() {},
		    // afterResize:function() {},
		    // afterRender:function() {}
		    before:function(i,panels) {
 		      var ref = panels[i].attr("data-id");
 		      //
		      $(".dce-scrollify-pagination .active").removeClass("active");
		      $(".dce-scrollify-pagination").find("a[href=\"#" + ref + "\"]").addClass("active");
		      //
		    },
		    afterRender:function() {
		      is_scrollify = true;
		      //
		      if(settings_page.enable_scrollify_nav){
			      var scrollify_pagination = "<ul class=\"dce-scrollify-pagination\">";
			      var activeClass = "";
			      $(sezioni).each(function(i) {
			        activeClass = "";
			        if(i===0) {
			          activeClass = "active";
			        }
			        //<span class=\"hover-text\">"+$(this).attr("data-id")+"</span>
			        scrollify_pagination += "<li><a class=\"" + activeClass + "\" href=\"#" + $(this).attr("data-id") + "\"></a></li>";
			      });
			      scrollify_pagination += "</ul>";

			      $("body").append(scrollify_pagination);

			      //Tip: The two click events below are the same:

			      $("body").on("click",".dce-scrollify-pagination a",function() {
			        $.scrollify.move($(this).attr("href"));
			      });
			  }
		    }
		  });
		$.scrollify.update();
	};
	function handleScrollify ( newValue ) {


		if(newValue){
			// SI

			if(is_scrollify){
				$.scrollify.enable();
				$('body').find('.dce-scrollify-pagination').show();
			}else{
				settings_page = elementor.settings.page.model.attributes;
			}

			PosttElements_ScrollifyHandler();
		}else{
			// NO
			$.scrollify.destroy();
			$('body').find('.dce-scrollify-pagination').hide();
			//

		}
	}
	function handleScrollify_speed ( newValue ) {
		//alert(newValue.size)
		$.scrollify.setOptions({scrollSpeed: newValue.size});

	}
	function handleScrollify_interstitialSection ( newValue ) {
		$.scrollify.setOptions({scrollSpeed: newValue});
	}
	function handleScrollify_offset ( newValue ) {
		$.scrollify.setOptions({offset: newValue.size});
	}
	function handleScrollify_ease ( newValue ) {
		$.scrollify.setOptions({easing: newValue});
	}
	function handleScrollify_setHeights ( newValue ) {
		$.scrollify.setOptions({setHeights: newValue ? true : false });
	}
	function handleScrollify_overflowScroll ( newValue ) {
		$.scrollify.setOptions({overflowScroll: newValue ? true : false });
	}
	function handleScrollify_updateHash ( newValue ) {
		$.scrollify.setOptions({updateHash: newValue ? true : false });
	}
	function handleScrollify_touchScroll ( newValue ) {
		$.scrollify.setOptions({touchScroll: newValue ? true : false });
	}
	function handleScrollify_enablenavigation ( newValue ) {
		if(newValue){
			$('body').addClass('dce-scrollify').find('.dce-scrollify-pagination').show();
		}else{
			$('body').removeClass('dce-scrollify').find('.dce-scrollify-pagination').hide();
		}
	}

	// Make sure you run this code under Elementor..
    $( function () {
		//
		if( typeof elementorFrontendConfig.settings.page !== 'undefined' ){

			settings_page = elementorFrontendConfig.settings.page;
			if(settings_page){
				var is_enable_dceScrolling = settings_page.enable_dceScrolling;
				var is_enable_scrollify = settings_page.enable_scrollify;

				if( is_enable_scrollify && is_enable_dceScrolling ){
					PosttElements_ScrollifyHandler( );
				}

				// Preview rendering
				if ( elementorFrontend.isEditMode() ){
			
					elementor.settings.page.addChangeCallback( 'enable_scrollify', handleScrollify );
					elementor.settings.page.addChangeCallback( 'scrollSpeed', handleScrollify_speed );
					elementor.settings.page.addChangeCallback( 'offset', handleScrollify_offset );
					elementor.settings.page.addChangeCallback( 'ease_scrollify', handleScrollify_ease );
					elementor.settings.page.addChangeCallback( 'setHeights', handleScrollify_setHeights );
					elementor.settings.page.addChangeCallback( 'overflowScroll', handleScrollify_overflowScroll );
					elementor.settings.page.addChangeCallback( 'updateHash', handleScrollify_updateHash );
					elementor.settings.page.addChangeCallback( 'touchScroll', handleScrollify_touchScroll );
					elementor.settings.page.addChangeCallback( 'enable_scrollify_nav', handleScrollify_enablenavigation );

				}
			}
		}

	} );
} )( jQuery );

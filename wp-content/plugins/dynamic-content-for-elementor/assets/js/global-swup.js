(function ($) {
    var settings_global = {};
    var settings_page = {};
    var is_swup = false;

    jQuery('body').addClass('dce-swup');
    // -----------

    var PosttElements_SwupHandler = function ( ) {


        let dce_swup_options = {
            LINK_SELECTOR: 'a[href^="' + window.location.origin + '"]:not([data-no-swup]):not(.is-lightbox), a[href^="/"]:not([data-no-swup]), a[href^="#"]:not([data-no-swup])',
            //LINK_SELECTOR: 'a.menu-link',
            //FORM_SELECTOR: 'form[data-swup-form]',
            //#outer-barba-wrap
            elements: ['#outer-wrap'],

            //animationSelector: '#main',
            cache: true,
            //pageClassPrefix: '',
            //scroll: true,
            //debugMode: false,
            preload: true,
            //support: true,
            /*skipPopStateHandling: function(event){
                if (event.state && event.state.source == "swup") {
                    return false;
                }
                return true;
            },*/
            plugins: [
                swupMergeHeadPlugin,
                //swupGtmPlugin,
                //swupGaPlugin
            ],
            //animateHistoryBrowsing: false,
        };
        swup = new Swup(dce_swup_options);

        swup.usePlugin(swupMergeHeadPlugin, {runScripts: true });

        swup.on('contentReplaced', function () {

            elementorFrontend.elementsHandler.initHandlers();
            swup.options.elements.forEach((selector) => {


                // load scripts for all elements with 'selector'
                var element_el = $(selector).find('.elementor-element');
                element_el.each(function (i) {
                    var el = jQuery(this).attr('data-element_type');

                    elementorFrontend.elementsHandler.runReadyTrigger(jQuery(this));
                });

            });

        });
    };

    function handleSwup(newValue) {


        if (newValue) {
            // SI
            if (is_swup) {

            } else {
                settings_page = elementor.settings.page.model.attributes;
            }


            PosttElements_SwupHandler();
        }
    }


    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {

        //
        //
        // per il renderin della preview in EditMode
        /*if (elementorFrontend.isEditMode()) {
            elementor.once('preview:loaded', function () {
                // questo è il callBack di fine loading della preview
            });

        }*/




    });
    //
    if( typeof elementorFrontendConfig.settings.dynamicooo !== 'undefined' ) {
        settings_global = elementorFrontendConfig.settings.dynamicooo;
        //
        if (settings_global.enable_swup){
            PosttElements_SwupHandler( );
        }
    }
    //
    //


})(jQuery);

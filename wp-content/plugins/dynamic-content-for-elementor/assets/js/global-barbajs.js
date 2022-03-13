(function ($) {
    var settings_global = {};
    var settings_page = {};
    var is_barbajs = false;

    jQuery('body').addClass('dce-barbajs');
    // -----------

    var PosttElements_BarbajsHandler = function ( ) {
        var sezioni = '.elementor-inner > .elementor-section-wrap > .elementor-section';
        var siteHeader = settings_global.header_site || '#site-header';
        var siteMain = settings_global.main_site || '#main';
        var siteFooter = settings_global.footer_site || '#footer';

        Barba.Pjax.Dom.wrapperId = settings_global.id_wrapper || 'barba-wrapper';
        Barba.Pjax.Dom.containerClass = settings_global.id_class || 'barba-container';

        Barba.Dispatcher.on('initStateChange', function (currentStatus) {
            var linkCSS = $('head').filter('link');
            linkCSS.each(function () {
                var file = $(this).attr('href');
                var idstyle = $(this).attr('id');
                alert(file + ' : ' + idstyle);
            });

        });
        Barba.Dispatcher.on('newPageReady', function (currentStatus, oldStatus, container, rawHTML) {
            var linkCSS = $(rawHTML).filter('link');


            linkCSS.each(function () {
                var file = $(this).attr('href');
                var idstyle = $(this).attr('id');


                if (typeof idstyle !== 'undefined') {

                    $('head').append('<link id="' + idstyle + '" rel="stylesheet" type="text/css" href="' + file + '">');

                }

            });

            var element_el = $(container).find('.elementor-element');
            element_el.each(function (i) {
                var el = jQuery(this).data('element_type');
                elementorFrontend.elementsHandler.runReadyTrigger(jQuery(this));
            });


            if (Barba.HistoryManager.history.length === 1) {  // Première vue
                return; // Aucune mise à jour n'est nécessaire pour le moment
            }

            // J'ai emprunté à jquery-pjax
            var $newPageHead = $('<head />').html(
                    $.parseHTML(
                            newPageRawHTML.match(/<head[^>]*>([\s\S.]*)<\/head>/i)[ 0 ],
                            document,
                            true
                            )
                    );
            // Tag que vous souhaitez modifier (Veuillez modifier en fonction de votre environnement)
            var headTags = [
                "link[rel='canonical']",
                "link[rel='shortlink']",
                "link[rel='alternate']",
                "meta[name='description']",
                "meta[property^='og']",
                "meta[name^='twitter']",
                "meta[name='robots']"
            ].join(',');
            $('head').find(headTags).remove(); // Supprimer le tag
            $newPageHead.find(headTags).appendTo('head'); // Ajouter un tag

            // Envoyer des hits à Analytics (si vous avez Google Analytics)
            if (typeof ga === 'function') {
                ga('send', 'pageview', location.pathname);
            }
        });

        Barba.Dispatcher.on('initStateChange', function (state) {
        });

        Barba.Pjax.init();
        Barba.Prefetch.init();
    };
    function handleBarbajs(newValue) {



        if (newValue) {
            // SI

            if (is_barbajs) {

            } else {
                settings_page = elementor.settings.page.model.attributes;
            }


            PosttElements_BarbajsHandler();
        } else {
            // NO


            //

        }
    }
    // ----------------------------------------
    var FadeTransition = Barba.BaseTransition.extend({
        start: function () {
            /**
             * This function is automatically called as soon the Transition starts
             * this.newContainerLoading is a Promise for the loading of the new container
             * (Barba.js also comes with an handy Promise polyfill!)
             */

            // As soon the loading is finished and the old page is faded out, let's fade the new page
            Promise
                    .all([this.newContainerLoading, this.fadeOut()])
                    .then(this.fadeIn.bind(this));
        },

        fadeOut: function () {
            /**
             * this.oldContainer is the HTMLElement of the old Container
             */

            return $(this.oldContainer).animate({opacity: 0}).promise();
        },

        fadeIn: function () {
            /**
             * this.newContainer is the HTMLElement of the new Container
             * At this stage newContainer is on the DOM (inside our #barba-container and with visibility: hidden)
             * Please note, newContainer is available just after newContainerLoading is resolved!
             */

            var _this = this;
            var $el = $(this.newContainer);

            $(this.oldContainer).hide();

            $el.css({
                visibility: 'visible',
                opacity: 0
            });

            $el.animate({opacity: 1}, 400, function () {
                /**
                 * Do not forget to call .done() as soon your transition is finished!
                 * .done() will automatically remove from the DOM the old Container
                 */

                _this.done();
            });
        }
    });

    var MoveRightTransition = Barba.BaseTransition.extend({

        start: function () {
            /**
             * This function is automatically called as soon the Transition starts
             * this.newContainerLoading is a Promise for the loading of the new container
             * (Barba.js also comes with an handy Promise polyfill!)
             */

            // As soon the loading is finished and the old page is faded out, let's fade the new page
            Promise
                    .all([this.newContainerLoading, this.pageOut()])
                    .then(this.pageIn.bind(this));
        },

        pageOut: function () {
            var deferred = Barba.Utils.deferred();
            var obj = {y: window.pageYOffset};

            TweenMax.to(obj, 0.4, {
                y: 0,
                onUpdate: function () {
                    if (obj.y === 0) {
                        deferred.resolve();
                    }
                    window.scroll(0, obj.y);
                },
                onComplete: function () {
                    deferred.resolve();
                }
            });

            return deferred.promise;
        },
        pageIn: function () {
            var _this = this;
            var $el = $(this.newContainer);
            TweenMax.set($(this.newContainer).find('#main'), {
                visibility: 'visible',
                xPercent: -100,
                position: 'absolute',
                overflow: 'hidden',
                left: 0,
                top: 0,
                right: 0
            });
            TweenMax.set($(this.oldContainer).find('#main'), {
                xPercent: 0,
                position: 'absolute',
                overflow: 'hidden',
            });
            TweenMax.to($(this.oldContainer).find('#main'), 0.8, {ease: Power2.easeOut, xPercent: 100});
            TweenMax.to($(this.newContainer).find('#main'), 0.8, {ease: Power2.easeOut, xPercent: 0, onComplete: function () {
                    TweenMax.set(_this.newContainer, {clearProps: 'all'});
                    _this.done();
                }

            });
        }

    });
    Barba.Pjax.getTransition = function () {
        var _this = this;
        var newPage = Barba.HistoryManager.currentStatus().url.split('/').pop();
        var oldPage = Barba.HistoryManager.prevStatus().url.split('/').pop();

        newPage = newPage.replace('.php', '');
        oldPage = oldPage.replace('.php', '');



        var newP = Barba.HistoryManager.currentStatus().namespace;
        var oldP = Barba.HistoryManager.prevStatus().namespace;

        var transitionObj = FadeTransition; //MoveRightTransition;



        return transitionObj;

    };

    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {

        //

        if( typeof elementorFrontendConfig.settings.dynamicooo !== 'undefined' ) {
            settings_global = elementorFrontendConfig.settings.dynamicooo;
            setTimeout(function () {
                if (settings_global.enable_barbajs)
                    PosttElements_BarbajsHandler( );
            }, 300);
        }
        //
        // per il renderin della preview in EditMode
        if (elementorFrontend.isEditMode()) {
            elementor.once('preview:loaded', function () {
                // questo è il callBack di fine loading della preview
            });
            elementor.settings.page.addChangeCallback('enable_barbajs', handleBarbajs);

        }



    });
})(jQuery);

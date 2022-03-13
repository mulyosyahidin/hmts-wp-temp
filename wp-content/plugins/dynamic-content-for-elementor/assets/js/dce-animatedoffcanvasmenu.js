;(function($) {
  var WidgetElements_AnimatedOffcanvasMenu = function($scope, $) {
    var elementSettings = get_Dyncontel_ElementSettings($scope);
    var id_scope = $scope.attr('data-id');

    var animatedoffcanvasmenu = '#animatedoffcanvasmenu-' + id_scope;
    var menu_position = elementSettings.aocm_position;

    var class_menu_li = animatedoffcanvasmenu + ' .dce-menu-aocm ul#dce-ul-menu > li';
    var class_template_before = animatedoffcanvasmenu + ' .dce-template-after';

    var class_hamburger = '.dce-button-hamburger';
    var class_modal = animatedoffcanvasmenu + ' .dce-menu-aocm';
    var class_sidebg = animatedoffcanvasmenu + ' .dce-bg';
    var class_quit = animatedoffcanvasmenu + ' .dce-menu-aocm .dce-close';
    var items_menu = $scope.find(class_menu_li + ', ' + class_template_before);

    var rate_menuside_desktop = Number(elementSettings.animatedoffcanvasmenu_rate.size);
    var rate_menuside_tablet = Number(elementSettings.animatedoffcanvasmenu_rate_tablet.size);
    var rate_menuside_mobile = Number(elementSettings.animatedoffcanvasmenu_rate_mobile.size);
    var rate_menuside = rate_menuside_desktop;

    var deviceMode = $('body').attr('data-elementor-device-mode');

    if (deviceMode == 'tablet' && rate_menuside_tablet) {
      rate_menuside = rate_menuside_tablet;
    } else if (deviceMode == 'mobile' && rate_menuside_mobile) {
      rate_menuside = rate_menuside_mobile;
    }

    var close_menu = function() {
      tl.reversed(!tl.reversed());
      $(class_hamburger).find('.con').removeClass('actived').removeClass('open');

      if (!elementorFrontend.isEditMode()) {
        $('body,html').removeClass('dce-modal-open');
      }
    };
    // GSAP animations Timeline
    var tl = new TimelineMax({
      paused: true
    });
    tl.set(class_modal, {
      width: 0,
    });
    if($(animatedoffcanvasmenu).find('dce-bg')) {
      if(menu_position == 'right') {
        tl.set(class_sidebg, {
          right: rate_menuside + '%',
        });
      } else {
        tl.set(class_sidebg, {
          left: rate_menuside + '%',
        });
      }
    }
    tl.to(class_modal, 0.4, {
      width: rate_menuside + '%',
      ease: Expo.easeOut,
      delay: 0
    });
    if($(animatedoffcanvasmenu).find('dce-bg')) {
      tl.to(class_sidebg, 0.4, {
        width: (100 - rate_menuside) + '%',
        ease: Expo.easeInOut,
        delay: 0
      });
    }
    tl.staggerFrom(items_menu, 0.5, {
      y: '12%',
      opacity: 0,
      ease: Expo.easeOut
    }, 0.1);

    tl.to(class_quit, 0.6, {
      scale: 1,
      ease: Expo.easeInOut,
      delay: 0
    }, -0.4);

    tl.reverse();


    // EVENTS
    $scope.on("click", class_hamburger, function(e) {
      e.preventDefault();
      $(".dce-close").fadeIn(3000, function() {
          $(this).removeClass("close-hidden");
      });
      tl.reversed(!tl.reversed());
      $(this).find('.con').toggleClass('actived');

      if (!elementorFrontend.isEditMode()) {
        $('body, html').addClass('dce-modal-open');
      }
      return false;
    });

    $(animatedoffcanvasmenu).on("click", 'a:not(.dce-close)', function(e) {
      close_menu();
    });

    $(document).on("click", class_quit, function(e) {
      e.preventDefault();
      $(".dce-close").fadeOut(1000, function() {
          $(this).addClass("close-hidden");
      });
      close_menu();
      return false;
    });
    $(document).on('keyup', function(evt) {
      if (evt.keyCode == 27) {
        $(".dce-close").fadeOut(1000, function() {
            $(this).addClass("close-hidden");
        });
        close_menu();
      }
    });

    $('.animatedoffcanvasmenu ul > li.menu-item-has-children > .menu-item-wrap').append('<span class="indicator-child no-transition">+</span>');
    // ACCORDION Menu
    $('.animatedoffcanvasmenu ul > li.menu-item-has-children > .menu-item-wrap .indicator-child').click(function(e) {
      e.preventDefault();
      $(this).closest('li').find('> .sub-menu').not(':animated').slideToggle();
    });

    if (!elementorFrontend.isEditMode()) {
      $(animatedoffcanvasmenu).prependTo("body");
    }
  };

  $(window).on('elementor/frontend/init', function() {
    elementorFrontend.hooks.addAction('frontend/element_ready/dce-animatedoffcanvasmenu.default', WidgetElements_AnimatedOffcanvasMenu);
  });
})(jQuery);

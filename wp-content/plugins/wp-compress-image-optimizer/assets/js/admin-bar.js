jQuery(document).ready(function ($) {


    function clear_Cache() {
        $('body').on('click', '.wp-compress-bar-clear-cache>a', function (e) {
            e.preventDefault();

            var li = $('#wp-admin-bar-wp-compress');
            var old_html = $(li).html();
            $(li).html('<span class="wp-compress-admin-bar-icon"></span><span style="padding-left: 30px;">Purging cache...</span>');

            $.post(wpc_vars.ajaxurl, {action: 'wps_ic_purge_cdn'}, function (response) {
                if (response.success) {
                    $(li).html(old_html);
                } else {

                }
            });

            return false;
        });
    }


    function preloadPage() {
        $('body').on('click', '.wp-compress-bar-preload-cache>a', function (e) {
            e.preventDefault();

            var li = $('#wp-admin-bar-wp-compress');
            var old_html = $(li).html();
            $(li).html('<span class="wp-compress-admin-bar-icon"></span><span style="padding-left: 30px;">Preloading page...</span>');

            $.post(wpc_vars.ajaxurl, {action: 'wps_ic_preload_page'}, function (response) {
                if (response.success) {
                    $(li).html(old_html);
                } else {

                }
            });

            return false;
        });
    }


    preloadPage();
    clear_Cache();

});
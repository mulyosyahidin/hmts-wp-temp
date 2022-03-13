(function ($) {

    $(window).on('elementor/frontend/init', function () {
        /*alert(elementorFrontend.isEditMode());
         if ( elementorFrontend.isEditMode() ){
         elementor.settings.page.addChangeCallback( 'other_post_source', handleGoToPage );
         }*/

        if (elementorFrontend.isEditMode()) {
            elementor.channels.editor.on('dceMain:previewPage', function (e, editor) {
                var model = e.getOption('editedElementView').getEditModel(),
                        currentElementType = model.get('elType');

            });
        }
    });

})(jQuery);

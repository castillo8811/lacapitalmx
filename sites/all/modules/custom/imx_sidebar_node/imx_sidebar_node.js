jQuery(window).load(function() {

    jQuery('#recomendated-editor-title').click(function(e) {
        e.stopPropagation();
        jQuery('#recomendated-editor-title').addClass('itemActive');
        jQuery('#most-visited-title').removeClass('itemActive');
        jQuery('#show-more-choose-y').css({
            'display': 'block'
        });

        jQuery('#show-more-choose-x').css({
            'display': 'none'
        });

        jQuery('#most-visited-nodes').children().fadeOut();
        jQuery('#recomendated-editor-nodes').children().fadeIn();
        jQuery('#recomendated-editor-nodes').css({
            'display': 'block'
        });
        jQuery('#most-visited-nodes').css({
            'display': 'none'
        });
    });

    jQuery('#most-visited-title').click(function(e) {
        e.stopPropagation();
        jQuery('#most-visited-title').addClass('itemActive');
        jQuery('#recomendated-editor-title').removeClass('itemActive');
        jQuery('#show-more-choose-y').css({
            'display': 'none'
        });
        jQuery('#show-more-choose-x').css({
            'display': 'block'
        });
        jQuery('#recomendated-editor-nodes').children().fadeOut();
        jQuery('#most-visited-nodes').children().fadeIn();
        jQuery('#most-visited-nodes').css({
            'display': 'block'
        });
        jQuery('#recomendated-editor-nodes').css({
            'display': 'none'
        });
    });

});
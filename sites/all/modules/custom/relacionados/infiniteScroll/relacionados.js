jQuery(document).ready(function() {
    var category = null;
    if (typeof Drupal.settings.infinite_config != 'undefined') {
        var config = Drupal.settings.infinite_config;
        if (typeof config.category != 'undefined') {
            category = config.category;
        }
    }
    jQuery("#wrapper-infinite-scroll").ImxInfiniteScroll({
        /*configuration of site*/
        site: "actitudfem",
        append: "#misfavoritos-contenido",
        loading:"http://www.actitudfem.com/sites/www.actitudfem.com/themes/actitudfem/images/loader_florecita40.gif",
        text_lenght: 50,
        analitics: true,
        category_analytics: "IMxInfiniteScroll",
        action_analytics: "Infinite-Scroll",
        label_analytics: "Numero-Scroll- ",
        IMxInit: function() {

        },
        IMxEnd: function() {

        }
    }, {
        limit: 4,
        fields: "id|title|summary|taxonomy|url|images|sinopsis",
        type: "article|gallerie|videos",
        category_ids: category,
        offset: 2
    });

//    var ar = jQuery('.footerSticky #relacionados-wrapper').length;
//    if (ar > 0) {
//        jQuery(window).scroll(function() {
//            var scrollWin = jQuery(window).scrollTop();
//            var altoRel = jQuery('.footerSticky #relacionados-wrapper').offset().top;
//            if (scrollWin >= altoRel) {
//                jQuery(".footerSticky #footerWrapper").fadeIn("fast", function() {
//                    jQuery(".footerSticky #lateral_right_wrapper .sticky_right").addClass('activeSticky');
//                });
//            } else {
//                jQuery('.footerSticky #footerWrapper').slideUp();
//                jQuery(".footerSticky #lateral_right_wrapper .sticky_right").removeClass('activeSticky');
//            }
//        });
//    }


});
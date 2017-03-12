jQuery("document").ready(function(){
//    if(jQuery("#block-imx-shareslateral-imx-shareslateral").length > 0){
//        var offset = jQuery("#block-imx-shareslateral-imx-shareslateral").offset();
//        var bottomPadding = jQuery(".stop").height();
//        var topPadding = 20;
//        jQuery( window ).scroll( function() {
//            if( jQuery( window ).scrollTop() < jQuery( document ).height() - bottomPadding - jQuery( "#block-imx-shareslateral-imx-shareslateral" ).height() ){
//                if (jQuery(window).scrollTop() > offset.top) {
//                    var ss= jQuery(window).scrollTop() - offset.top + topPadding;
//                    jQuery("#block-imx-shareslateral-imx-shareslateral").stop().animate({
//                        marginTop:ss
//                    });
//                } 
//                else {
//                    jQuery("#block-imx-shareslateral-imx-shareslateral").stop().animate({
//                        marginTop: 0
//                    });
//                }
//            }
//        });
//    }
    
    jQuery('section.node .addthis-comments, section.node .addthis-comments a').click(function(e) {
        e.preventDefault();
        jQuery('html, body').stop().animate({
            'scrollTop': jQuery('.queopinas').offset().top - 15
        }, 900, 'swing');
    });
    
    jQuery('.tools.guardar').click(function(){
        nid = jQuery(this).attr('nid');
        savedNodes = jQuery(this).find('.datos-guardar').html();
        jQuery.ajax({
            url: '/savenode/action',
            type: 'POST',
            dataType: 'json',
            data: {
                nid: nid,
                total: savedNodes
            },
            success: function(result) {
                if (result.status == 200) {
                    jQuery('.tools.guardar').find('.datos-guardar').html(result.data);
                }
            }
        });
    });
    
    /*jQuery('#relacionados-container .relacionados-content').jScrollPane({
        verticalDragMinHeight: 50,
        verticalDragMaxHeight: 50,
        horizontalDragMinWidth: 20,
        horizontalDragMaxWidth: 20
    });*/
    
});

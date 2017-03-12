jQuery("document").ready(function(){
    setTimeout(function(){
        fixTopShares();
    },1000);
    
    jQuery(window).resize(function() {
        fixTopShares();
  if(jQuery(window).width()>=1460){
        jQuery("#share-wrapper").removeClass("hidden");
    }else{
        jQuery("#share-wrapper").addClass("hidden");
    }
});
if(jQuery(window).width()>=1460){
        jQuery("#share-wrapper").removeClass("hidden");
    }
    
    if(jQuery("#block-imx-shareslateral-imx-shareslateral").length > 0){
        var offset = jQuery("#block-imx-shareslateral-imx-shareslateral").offset();
        var bottomPadding = jQuery(".stop").height();
        var topPadding = 20;
        
        jQuery( window ).scroll( function() {
            if(!jQuery("#share-wrapper").hasClass("hidden")){
                var size_shares=jQuery("#share-wrapper").height();
    var total_shares=jQuery(".field-name-addthis-inferior").position().top;
            if(jQuery( window ).scrollTop()> total_shares ){
                jQuery("#share-wrapper").fadeOut();
            }
            else{
                jQuery("#share-wrapper").fadeIn();
            }
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
            }

        });
    }
    
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
function fixTopShares(){
    jQuery("#share-wrapper").css("top",(jQuery("#pageWrapper").position().top+jQuery("#menuFixed").height()+20)+"px");
}
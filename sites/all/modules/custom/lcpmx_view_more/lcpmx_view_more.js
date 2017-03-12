jQuery(document).ready(function() {
    jQuery(".dom-taxonomy").on("click", function(e) {
        e.preventDefault();
        var parent_path=jQuery(this).attr("data-parent-path");
        var children_path=jQuery(this).attr("data-children-path").replace("/","#");
        if(jQuery(this).attr("data-parent-path")==jQuery(this).attr("data-children-path")){
            children_path="";
        }
        
        window.history.pushState(window.location.pathname,jQuery(this).html(),parent_path+children_path);
        sendGA(jQuery(this).attr("href"));
           jQuery(".para-la-calle").addClass("pleca-ocio-calle").removeClass("para-la-calle");
        jQuery(".para-el-sillon").addClass("pleca-ocio-sillon").removeClass("para-el-sillon");
        if(jQuery(this).hasClass("pleca-ocio-calle")){
        jQuery(this).addClass("para-la-calle").removeClass("pleca-ocio-calle");
        }
        if(jQuery(this).hasClass("pleca-ocio-sillon")){
        jQuery(this).addClass("para-el-sillon").removeClass("pleca-ocio-sillon");   
        }        
        var taxonomy_tid = jQuery(this).attr("data-id-taxonomy");
        var boton_click = jQuery(this);
        jQuery.ajax({
            type: "GET",
            cache: false,
            url: "/filter/taxonomy/superior/" + taxonomy_tid, // 
            success: function(data) {
                if (jQuery(".view-display-id-taxonomy_superior").attr("class")) {
                    jQuery(".view-display-id-taxonomy_superior").replaceWith(data);
                } else {
                    jQuery(".region-content-top").children().remove();
                    jQuery(".region-content-top").append(data);
                }
                jQuery(".submenu-active").removeClass("submenu-active");
                boton_click.addClass("submenu-active");
                if (!jQuery("#colaboradoresCarousel").attr("id")) {
                    jQuery.get("/ajax_carousel_colaborador", function(data_carousel) {
                        jQuery(data_carousel).insertAfter(".view-display-id-taxonomy_superior");
                    });                   
                }
                // on success, post (preview) returned data in popupbox
            } // success
        }); // ajax            
        setTimeout(function(){
                 jQuery.ajax({
            type: "GET",
            cache: false,
            url: "/filter/taxonomy/intermedio/" + taxonomy_tid, // 
            success: function(data) {
                if (jQuery(".view-display-id-taxonomy_intermedio").attr("class")) {
                    jQuery(".view-display-id-taxonomy_intermedio").children().remove();
                    jQuery(".view-display-id-taxonomy_intermedio").replaceWith(data);
                } else {
                    jQuery(".region-content-top").append(data);
                }
                if (!jQuery("#registroInvitacion").attr("id")) {
                    jQuery.get("/invitacion", function(data_invitacion) {
                        jQuery(data_invitacion).insertAfter(".view-display-id-taxonomy_intermedio");                            
                    });                   
                }
//                jQuery(".view-display-id-taxonomy_intermedio").html(data);
                // on success, post (preview) returned data in popupbox
            } // success
        }); // ajax
        },1000);
        
        setTimeout(function(){
                    jQuery.ajax({
            type: "GET",
            cache: false,
            url: "/filter/taxonomy/inferior/" + taxonomy_tid, // 
            success: function(data) {
                if (jQuery(".view-display-id-taxonomy_inferior").attr("class")) {
                    jQuery(".view-display-id-taxonomy_inferior").replaceWith(data);
                } else {
//                    jQuery(".region-content-top").append(data);
//                     jQuery(data).insertAfter("#registroInvitacion");
                       jQuery(".region-content-top").append(data);
                }
                setTimeout(function() {
                    jQuery(".lazy-garuyo").lazyload();
                    loadAdsAjaxTaxonomy();
                    insertShadowList();
                    var loadin = '<div class="wrapper-loading"><img src="/sites/all/themes/garuyod7/images/loading.gif"></div>';
                    var see_more = '<div id="iMxinfiniteScroll-wrapper-see-more"><div id="wrapper-click-see-more" class="wrapper-click-see-more"><span class="ico-see-more"></span><span class="txt-see-more">VER MÁS</span></div></div>';
                    jQuery(".view-display-id-taxonomy_inferior .listado-cuadricula").append(loadin);
                    jQuery(".view-display-id-taxonomy_inferior .listado-cuadricula").append(see_more);
                    jQuery("#wrapper-infinite-scrollTax").attr("category", jQuery(boton_click).attr("data-id-taxonomy"));
                },500);
                // on success, post (preview) returned data in popupbox
            } // success
        }); // ajax
        },1500);
        });

    jQuery("body").on("click", ".ajax_ocio", function(ev) {
        Drupal.settings.view_more_ajax=11;
        ev.preventDefault();
        sendGA(jQuery(this).attr("href"));
        
         var parent_path=jQuery(this).attr("data-parent-path");
        var children_path=jQuery(this).attr("data-children-path").replace("/","#");
        children_path=children_path.replace("/","-")
        if(jQuery(this).attr("data-parent-path")==jQuery(this).attr("data-children-path")){
            children_path="";
        }
        
        window.history.pushState(window.location.pathname,jQuery(this).html(),parent_path+children_path);
//        window.history.pushState(window.location.pathname,jQuery(this).html(),jQuery(this).attr("href"));
        jQuery(".para-la-calle").addClass("pleca-ocio-calle").removeClass("para-la-calle");
        jQuery(".para-el-sillon").addClass("pleca-ocio-sillon").removeClass("para-el-sillon");
        jQuery(".submenu-active").removeClass("submenu-active");
        if(jQuery(this).hasClass("pleca-ocio-calle")){
        jQuery(this).addClass("para-la-calle").removeClass("pleca-ocio-calle");
        }
        if(jQuery(this).hasClass("pleca-ocio-sillon")){
        jQuery(this).addClass("para-el-sillon").removeClass("pleca-ocio-sillon");   
        }
        jQuery.ajax({
            type: "GET",
            cache: false,
            url: jQuery(this).attr("data-ocio")+"/"+jQuery(this).attr("data-tid")+"/"+0, // 
            success: function(data) {
//                jQuery("#ver-mas-ocio").attr("data-offset",jQuery(".nodesList.listado-cuadricula.limited ul li").size());
                jQuery(".region-content-top").children().remove();
                jQuery(".region-content-top").append(data);
                setTimeout(function(){
                   jQuery(".lazy-garuyo").lazyload(); 
                   loadAdsAjaxTaxonomy();
                },500);
            } // success
        }); // ajax
    });
    jQuery("body").on("click", "#ver-mas-ocio", function() {
        jQuery(".image-loading").css("display","block");
        var offset=parseInt(jQuery("#ver-mas-ocio").attr("data-offset"));
        var new_offset=offset+11;
        jQuery.ajax({
            type: "GET",
            cache: false,
            url: window.location.origin+"/"+jQuery(this).attr("data-ocio")+"/"+jQuery(this).attr("data-tid")+"/"+Drupal.settings.view_more_ajax, // 
            success: function(data) {
                jQuery(".image-loading").css("display","none");
                Drupal.settings.view_more_ajax=Drupal.settings.view_more_ajax+11;
                ga('send', 'pageview');
                if(data.length>1){
                jQuery("#ver-mas-ocio").remove();
                jQuery(".region-content-top").append(data);    
                }else{
                jQuery("#ver-mas-ocio span").html("Lo sentimos, nos quedamos sin  contenido");    
                }
                setTimeout(function(){
                   jQuery(".lazy-garuyo").lazyload(); 
                   loadAdsAjaxTaxonomy();
                   insertShadowList();
                },500);
            } // success
        }); // ajax
    });

});

function sendGA($ref){
    ga('send', 'pageview',$ref);
    ga('send', 'event', 'navegacion-header', 'click',$ref);
}

function loadAdsAjaxTaxonomy(){
    if (jQuery("#imx_ads_block_1").length) {
        imx_smarts_render_block_by_invoque_id("#imx_ads_block_1","info");
    }
    if (jQuery("#imx_ads_block_2").length) {
        imx_smarts_render_block_by_invoque_id("#imx_ads_block_2","info");
    }
    if (jQuery("#infiniteAds_banner").length) {
        imx_smarts_render_block_by_invoque_id("#infiniteAds_banner","info");
    }
    if (jQuery("#imx_ads_block_3").length) {
        imx_smarts_render_block_by_invoque_id("#imx_ads_block_3","info");
    }
    setTimeout(function(){
       jQuery("#imx_ads_block_1").attr("id","imx_ads_block_1"+1) ;
       jQuery("#imx_ads_block_2").attr("id","imx_ads_block_2"+1) ;
       jQuery("#infiniteAds_banner").attr("id","infiniteAds_banner"+1) ;
       jQuery("#imx_ads_block_3").attr("id","imx_ads_block_3"+1) ;
    },1000);
}
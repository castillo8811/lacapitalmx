jQuery(document).ready(function () {


    //UpdateNewsletterField
    jQuery("#boletin-si").click(function(){
        alert("Activo");
    });


    jQuery(".imx_mark").each(function () {
        nid = jQuery(this).attr("data-mark-nid");
        type = jQuery(this).attr("data-mark-type");
        status = jQuery(this).attr("data-mark-status");

        if(type=1){
            imx_mark_class="imx-mark-pin-favorites";
        }else if(type=2){
            imx_mark_class="imx-mark-pin-readlater";
        }

        if(imx_mar_content_is_marked(nid,type)){
            jQuery(this).addClass(imx_mark_class+"-selected");
        }
        if (!jQuery(this).hasClass(imx_mark_class+"-selected")) {
            jQuery(this).click(function () {
                sendMark(nid, type, status, jQuery(this),imx_mark_class);
            });
        }
    });
});

function sendMark(nid, type, status, selector,imx_mark_class) {
    if (!selector.hasClass(imx_mark_class+"-selected")) {
        jQuery.ajax({
            method: "POST",
            url: "/imx_mark/js/add",
            data: {'nid': nid, 'type': type, 'status': status},
            success: function (result) {
                if (result) {
                    imx_mark_callback(selector,type,status,nid,imx_mark_class);
                }
            }
        });
    }
}


function imx_mar_content_is_marked($nid, $type) {
    marked = false;
    if (typeof Drupal.settings.imx_mark != "undefined") {
        if ($type == 1) {
            data_marked = Drupal.settings.imx_mark.user_favorites;
        } else {
            data_marked = Drupal.settings.imx_mark.user_readlater;
        }

        jQuery(data_marked).each(function (i,j) {
            if (j.nid == $nid) {
                marked=true;
                return true;
            }
        });

        return marked;
    }
}


function imx_mark_callback(selector,type,status,nid){
        selector.addClass(imx_mark_class+"-selected");
}
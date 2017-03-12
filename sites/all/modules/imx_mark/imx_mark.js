jQuery(document).ready(function() {
    initMark();
});

function initMark() {
    jQuery(".imx_mark").each(function() {
        nid = jQuery(this).attr("data-mark-nid");
        type = jQuery(this).attr("data-mark-type");
        status = jQuery(this).attr("data-mark-status");

        if (type = 1) {
            imx_mark_class = "imx-mark-pin-favorites";
        } else if (type = 2) {
            imx_mark_class = "imx-mark-pin-readlater";
        }

        if (imx_mar_content_is_marked(nid, type)) {
            jQuery(this).addClass(imx_mark_class + "-selected");
        }
        if (!jQuery(this).hasClass(imx_mark_class + "-selected")) {
            jQuery(this).click(function() {
                nid = jQuery(this).attr("data-mark-nid");
                type = jQuery(this).attr("data-mark-type");
                status = jQuery(this).attr("data-mark-status");
                sendMark(nid, type, status, jQuery(this), imx_mark_class);
            });
        }

        if (jQuery(this).hasClass(imx_mark_class + "-selected")) {
            jQuery(this).click(function() {
                nid = jQuery(this).attr("data-mark-nid");
                type = jQuery(this).attr("data-mark-type");
                status = jQuery(this).attr("data-mark-status");
                imx_mark_confirm_popup(nid, type, status, jQuery(this), imx_mark_class);
//                removeMark(nid, type, status, jQuery(this),imx_mark_class);
            });
        }
    });
}

function sendMark(nid, type, status, selector, imx_mark_class) {
    if (!selector.hasClass(imx_mark_class + "-selected")) {
        jQuery.ajax({
            method: "POST",
            url: "/imx_mark/js/add",
            data: {'nid': nid, 'type': type, 'status': status},
            success: function(result) {
                if (result) {
                    imx_mark_callback(selector, type, status, nid, imx_mark_class);
                    imx_mark_popup_agredecimiento();
                }
            }
        });
    }
}


function removeMark(nid, type, status, selector, imx_mark_class) {
    jQuery.ajax({
        method: "POST",
        url: "/imx_mark/js/remove",
        data: {'nid': nid, 'type': type, 'status': status},
        success: function(result) {
            if (result) {
                console.log(result);
                imx_mark_callback(selector, type, status, nid, imx_mark_class);
            }
        }
    });
}



function imx_mar_content_is_marked($nid, $type) {
    marked = false;
    if (typeof Drupal.settings.imx_mark != "undefined") {
        if ($type == 1) {
            data_marked = Drupal.settings.imx_mark.user_favorites;
        } else {
            data_marked = Drupal.settings.imx_mark.user_readlater;
        }

        jQuery(data_marked).each(function(i, j) {
            if (j.nid == $nid) {
                marked = true;
                return true;
            }
        });

        return marked;
    }
}


function imx_mark_callback(selector, type, status, nid) {
    selector.addClass(imx_mark_class + "-selected");
    if (selector.hasClass(imx_mark_class + "-remove_after")) {
        selector.parents("article").eq(0).fadeOut("slow", function() {
//                jQuery(this).parent().remove(); // Animation complete.
            var $grid = jQuery('.grid-pos').masonry({
                itemSelector: '.pos-grid', columnWidth: '.col-3',
                percentPosition: true
            });
            $grid.masonry("remove", jQuery(this).parent()).masonry('layout');
        });
    }
}
function imx_mark_popup_agredecimiento() {
    var html_confirm = "<section id='popup_olvidar_contrasena_v1' class='windowRegister'>";
    html_confirm += "<div class='windowHeader'><img src='/sites/all/themes/garuyod7/images/logo_garuyo_v4.png'/>";
    html_confirm += "<div class='windowRegister-close'>";
    html_confirm += "<span class='O25l1'>Cerrar <strong>X</strong></span>";
    html_confirm += "</div>";
    html_confirm += "</div>";
    html_confirm += "<div class='windowBody windowbgGray'>";
    html_confirm += "<p class='mt20 O30l0 lh30'>El contenido se ha guardado correctamente en favoritos.</p>";
    html_confirm += "</div>";
    html_confirm += "</section>";
    jQuery.colorbox({html: html_confirm, scrolling: false, width: "100%", heigh: "100%"});
    setTimeout(function() {
        jQuery.colorbox.close();
        var count_f = parseInt(jQuery(".count-favorites").html());
        var aumento = parseInt(1);
        jQuery(".count-favorites").html((count_f + aumento));
    }, 3000);
}

function imx_mark_confirm_popup(nid, type, status, object, mark_class) {
    var html_confirm = "<section id='popup_olvidar_contrasena_v1' class='windowRegister'><div class='windowHeader'><img src='/sites/all/themes/garuyod7/images/logo_garuyo_v4.png'/>";
    html_confirm += "<div class='windowRegister-close'>";
    html_confirm += "<span class='O25l1'>Cerrar <strong>X</strong></span>";
    html_confirm += "</div>";
    html_confirm += "</div>";
    html_confirm += "<div class='windowBody'>";
    html_confirm += "<p class='mt20 O30l0 lh30'>¿Estás seguro de que deseas eliminar este contenido de tus Favoritos?</p>";
    html_confirm += "<div class='tacenter buttons-confirms'>";
    html_confirm += "<a class='confirm-buttons yes-confirm' href='#yes'><img src='/sites/all/themes/garuyod7/images/btn_si.jpg'></a>";
    html_confirm += "<a class='confirm-buttons no-confirm' href='#no'><img src='/sites/all/themes/garuyod7/images/btn_no.jpg'></a>";
    html_confirm += "</div>";
    html_confirm += "</div></section>";
    jQuery.colorbox({html: html_confirm, scrolling: false, width: "100%", heigh: "100%"});
    jQuery(document).bind('cbox_complete', function() {
        jQuery(".no-confirm").on("click", function() {
            jQuery.colorbox.close();
        });
        jQuery(".yes-confirm").on("click", function() {

            removeMark(nid, type, status, object, mark_class);
            jQuery.colorbox.close();
            setTimeout(function() {
                jQuery(".count-favorites").html(jQuery(".pos-grid article").length);
            }, 2000);
        });

    });
}
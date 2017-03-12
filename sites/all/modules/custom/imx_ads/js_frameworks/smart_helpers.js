function SmartAdServer(sas_pageid, sas_formatid, sas_target) {
    if (sas_masterflag == 1) {
        sas_masterflag = 0;
        sas_master = 'M';
    } else {
        sas_master = 'S';
    }
    document.write('<scr' + 'ipt src="' + sas_scriptDomain + '/call/pubj/' + sas_pageid + '/' + sas_formatid + '/' + sas_master + '/' + sas_tmstp + '/' + escape(sas_target) + '?"></scr' + 'ipt>');
}

function imx_smarts_get_block_by_title($title, $format) {
    var url = "/imx_ads/getBlockByTitle";

    if (!$format) {
        $format = "block";
    }

    jQuery.ajax({
        type: "GET",
        url: url,
        dataType: 'json',
        data: {block_title: $title, format_ad: $format},
        success: function (data) {
            if (data) {
                console.log(data);
            }
        }
    });
}

function imx_smarts_get_blocks_by_region(region_title) {
    var region = {region: region_title};
    var url = "/imx_ads/getBlocksByRegion";
    jQuery.ajax({
        type: "GET",
        url: url,
        dataType: 'json',
        data: region,
        success: function (data) {
            if (data) {
                console.log(data);
            }
        }
    });
}

function imx_smarts_get_blocks_by_invoque_id(invoque_id, $format) {
    var url = "/imx_ads/getBlocksByInvoqueId";
    if (!$format) {
        $format = "block";
    }
    jQuery.ajax({
        type: "GET",
        url: url,
        dataType: 'json',
        data: {'id': invoque_id, 'format_ad': $format},
        success: function (data) {
            if (data) {
                console.log(data);
            }
        }
    });
}


function imx_smarts_render_block_by_invoque_id(invoque_id, $format) {
    var url = "/imx_ads/getBlocksByInvoqueId";
    if (!$format) {
        $format = "block";
    }

    jQuery.ajax({
        type: "GET",
        url: url,
        dataType: 'json',
        data: {'id': invoque_id, 'format_ad': $format},
        success: function (data) {
            if (data) {
                if (!data[0].site_id) {
                    if (sas_siteid)
                        data[0].site_id = sas_siteid;
                }
                createIframeIMX(data[0].site_id, data[0].page_id, data[0].format_id, sas_target, invoque_id);
            }
        }
    });
}


function imx_smarts_render_block_by_invoque_title(title, $format, append_to) {
    var url = "/imx_ads/getBlockByTitle";
    if (!$format) {
        $format = "block";
    }

    if (!append_to || !title) {
        return false;
    }

    jQuery.ajax({
        type: "GET",
        url: url,
        dataType: 'json',
        data: {'title': title, 'format_ad': $format},
        success: function (data) {
            if (data) {
                createIframeIMX(data[0].site_id, data[0].page_id, data[0].format_id, sas_target, append_to);
            }
        }
    });
}


function createIframeIMX(urlIframe, site_id, pageid, formatid, target) {
    var imx_pageid = typeof pageid !== 'undefined' ? encodeURIComponent(pageid) : '';
    var imx_formatid = typeof formatid !== 'undefined' ? encodeURIComponent(formatid) : '';
    var imx_target = typeof target !== 'undefined' ? encodeURIComponent(target) : '';

    if (typeof imx_pageid == 'undefined' || typeof imx_formatid == 'undefined')
        return false;

    var url = urlIframe + '?pageid=' + imx_pageid + '&formatid=' + imx_formatid + '&target=' + imx_target + '&siteid=' + site_id;
    var iframe = document.createElement('iframe');
    iframe.id = 'iframe_' + formatid;
    iframe.frameborder = 0;
    iframe.marginHeight = 0;
    iframe.marginWidth = 0;
    iframe.scrolling = 'no';
    (iframe.frameElement || iframe).style.cssText = 'width: 300px; height: 250px; border: 0;';
    iframe.src = url;

    wparent = window.parent.document.getElementById(formatid);

    if (wparent) {
        has_iframe = wparent.getElementsByTagName('iframe').length;

        sidebar_second_ads = window.parent.Drupal.settings.imx_ads.imx_ads_smart_page_info.regions['sidebar_second'];
        if (!sidebar_second_ads) {
            sidebar_second_ads = window.parent.Drupal.settings.imx_ads.imx_ads_smart_page_info.regions['second_sidebar'];
            if (!sidebar_second_ads) {
                sidebar_second_ads = window.parent.Drupal.settings.imx_ads.imx_ads_smart_page_info.regions['sidebar_first'];
                if (!sidebar_second_ads) {
                    sidebar_second_ads = window.parent.Drupal.settings.imx_ads.imx_ads_smart_page_info.regions['stickybar'];
                }
            }
        }

        if (sidebar_second_ads) {
            if (sidebar_second_ads.length) {
                for (index = 0; index < sidebar_second_ads.length; ++index) {
                    ad_name_parts = sidebar_second_ads[index].title.split('|');
                    box_parent = window.parent.document.getElementById('imx_ads_' + ad_name_parts[2]);
                    if (box_parent) {
                        //console.log(box_parent);
                        //sasconsole.log(box_parent);
                        box_parent.style.cssText = 'display: none;';
                    }
                }
            }
        }

        if (!has_iframe) {
            wparent.innerHTML = "";
            wparent.appendChild(iframe);
        }
    }
}


function createAsyncBanner(append_to) {
    var iframe = document.createElement('iframe');
    sj = jQuery("#smart_js").html();
    var html = '<body style="margin:0;"><script>' + sj + '<\/script><script>SmartAdServerAsync(sas_pageid,sas_formatid,sas_target);<\/script></body>';
    iframe.style.width = 300 + "px";
    iframe.style.height = 250 + "px";
    iframe.frameBorder = "0";
    iframe.scrolling = "no";
    iframe.src = 'data:text/html;charset=utf-8,' + encodeURI(html);
    /* agrego un  tag cualquier, y le agrego una clase "infinite_banner" que me servirá de referencia más adelante */
    banner_wrap = '<aside class="infinite_banner clear"></aside>';
    /* inserto el nuevo  tag (banner_wrap), en el tag  que  viene desde el  callback  del infinite scroll (paso N.1), en este caso la recibo  con  el  nombre: append_to  */
    append_to.append(banner_wrap);
    /* una vez insertado a nuestro nuevo  tag con clase "infinite_banner" () , le agrego  al  final el  iframe*/
    jQuery(".infinite_banner").last().append(iframe);
}


function createBannerAsync(urlIframe, site_id, pageid, formatid, target, append_to) {
    var imx_pageid = typeof pageid !== 'undefined' ? encodeURIComponent(pageid) : '';
    var imx_formatid = typeof formatid !== 'undefined' ? encodeURIComponent(formatid) : '';
    var imx_target = typeof target !== 'undefined' ? encodeURIComponent(target) : '';

    if (typeof imx_pageid == 'undefined' || typeof imx_formatid == 'undefined')
        return false;

    var url = urlIframe + '?pageid=' + imx_pageid + '&formatid=' + imx_formatid + '&target=' + imx_target + '&siteid=' + site_id;
    var iframe = document.createElement('iframe');
    iframe.id = 'iframe_' + formatid;
    iframe.frameborder = 0;
    iframe.marginHeight = 0;
    iframe.marginWidth = 0;
    iframe.scrolling = 'no';
    (iframe.frameElement || iframe).style.cssText = 'width: 300px; height: 250px; border: 0;';
    iframe.src = url;

    append_to = append_to.replace("#", "");
    bparent = document.getElementById(append_to);
    if (bparent) {
        bparent.appendChild(iframe);
    }
}


function createIframeIMX(siteId, pageId, formatId, target, appendTo_Id) {
    //console.log("Cargando iframe: " + formatId);
    /* valido si se le pasa un alto si no le aplico  250 */
    theight = 250;
    /* valido si las variables traen algo y terno null */
    if (typeof siteId == 'undefined' || typeof pageId == 'undefined' || typeof formatId == 'undefined' || siteId == null || typeof pageId == null || typeof formatId == null) {
        return null;
    }
    target = (target) ? target : "";
    /* creo el iframe */

    pageId = pageId.toString();
    page_id = pageId.split('/');
    if (page_id.length == 2) {
        page_id_smart = page_id[1];
    } else {
        page_id_smart = pageId;
    }

    var iframe = document.createElement('iframe');
    /* cargo los js que irán  en  el  head */
    var scripts = '<scr' + 'ipt type="text/javascript" src="http://ads.inventmx.com/config.js?nwid=1030"><\/script>';
    var style = '<style>body {' +
        'margin: 0;' +
        'padding: 0;' +
        'background-color: gray;' +
        '}</style>';
    /* se carga el head del que iframe */
    var head = '<head>' + style + scripts + '</head>';
    /* se crea el body con los llamados correspondientes */
    var html = head +
        '<body>' +
        '<scr' + 'ipt type="text/javascript">' +
        'sas.setup({ domain: "http://ads.inventmx.com", renderMode: 0});' +
        'window.addEventListener("load", function() {window.parent.postMessage("imx_ads-' + formatId + ':' + document.body.scrollWidth + '#' + document.body.scrollHeight + '","*");});' +
        '</scr' + 'ipt>' +
        '<scr' + 'ipt type="text/javascript">' +
        '//sas_formatid='+formatId+';\n'+
        'sas.call("std", { siteId:' + siteId + ', pageId:' + page_id_smart + ', formatId:' + formatId + ',target:"' + target + '"});' +
        '</scr' + 'ipt>' +
        '<noscript>' +
        '<a href="http://ads.inventmx.com/ac?jump=1&nwid=1030&siteid=' + siteId + 'pagename=exclusive_site&fmtid=' + formatId + '&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">' +
        '<img src="http://ads.inventmx.com/ac?out=nonrich&nwid=1030&siteid=' + siteId + 'pagename=exclusive_site&fmtid=' + formatId + '&visit=m&tmstp=[timestamp]&out=nonrich" border="0" alt="" />' +
        '</a>' +
        '</noscript>';

    '</body>';

    /* le asigno las propiedades al iframe */
    iframe.style.width = 300 + "px";
    iframe.style.height = theight + "px";
    iframe.frameBorder = "0";
    iframe.scrolling = "no";
    //iframe.src = 'data:text/html;charset=utf-8,' + encodeURI(html);


    iMxDiv = document.createElement('div');
    //iMxDiv.id = 'infinite-banner';
    iMxDiv.className = 'imx_ads_iframe_ad';
    append_to = appendTo_Id.replace("#", "");
    if (append_to) {
        iparent = document.getElementById(append_to);
        if (iparent) {
            iparent.appendChild(iMxDiv);
            iMxDiv.appendChild(iframe);
            iframe.contentWindow.contents = html;
            iframe.src = 'javascript:window["contents"]';
        }
    }
}


function imx_ads_resize_iframes(time) {
        jQuery(".imx_ads_iframe_ad iframe").each(function () {
            iframe_inner_height = jQuery(this).contents().find("iframe").eq(0).height();
            iframe_inner_width = jQuery(this).contents().find("iframe").eq(0).width();
            if (iframe_inner_height)
                jQuery(this).height(iframe_inner_height);
            if (iframe_inner_width)
                jQuery(this).width(iframe_inner_width);
        });
}

function start_imx_ads_resize_start() {
    if (typeof imx_ads_resize_iframes != 'undefined') {
        var imx_ads_times = [1000, 2000, 3000, 6000, 10000, 20000, 30000, 50000];
        jQuery.each(imx_ads_times, function (index, value) {
            if (jQuery(".imx_ads_iframe_ad iframe").length) {
                setTimeout(function () {
                    imx_ads_resize_iframes(value);
                }, value);
            }
        });
    }
}


jQuery(document).ready(function () {
    start_imx_ads_resize_start();

    function receiveMessageMx(event) {
        eventMx = event.data.toString();
        if (typeof eventMx.match == 'function') {
            if (eventMx.match(/^imx_ads.*/)) {
                //console.log(eventMx);
            }
        }
    }

    window.addEventListener("message", receiveMessageMx, false);

});
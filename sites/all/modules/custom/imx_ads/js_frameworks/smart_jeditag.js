
function createJeditag(siteId, pageId, formatId, target) {
    if (typeof siteId == 'undefined' || typeof pageId == 'undefined' || typeof formatId == 'undefined' || siteId == null || typeof pageId == null || typeof formatId == null) {
        return null;
    }
    //console.log("Jeditag V2");
    target = (target) ? target : '';

    pageId=pageId.toString();
    page_id=pageId.split('/');
    if(page_id.length==2){
        page_id_smart=page_id[1];
    }else{
        page_id_smart=pageId;
    }

    var iframe = document.createElement('iframe');
    var scripts = '<scr' + 'ipt type="text/javascript" src="http://ads.inventmx.com/config.js?nwid=1030"></script>';
    var style = '<style>body {' +
        'margin: 0;' +
        'padding: 0;' +
        'background-color: gray;' +
        '}</style>';
    var head = '<head>' + style + scripts + '</head>';
    var html = head +
        '<body>' +
        '<scr' + 'ipt type="text/javascript">' +
        'sas.setup({ domain: "http://ads.inventmx.com", async: true, renderMode: 0});' +
        '</scr' + 'ipt>' +
        '<scr' + 'ipt type="text/javascript">' +
        '//sas_formatid='+formatId+';\n'+
        'sas.call("std", { siteId:' + siteId + ', pageId:' + page_id_smart + ', formatId:' + formatId + ',target:"' + target + '"});' +
        '</scr' + 'ipt>' +
        '<noscript>' +
        '<a href="http://ads.inventmx.com/ac?jump=1&nwid=1030&siteid=' + siteId + 'pagename=exclusive_site&fmtid=' + formatId + '&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">' +
        '<img src="http://ads.inventmx.com/ac?out=nonrich&nwid=1030&siteid=' + siteId + 'pagename=exclusive_site&fmtid=' + formatId + '&visit=m&tmstp=[timestamp]&out=nonrich" border="0" alt="" />' +
        '</a>' +
        '</noscript>'+
    '</body>';

    iframe.style.width = 300  + "px";
    iframe.style.height = 250 + "px";
    iframe.frameBorder = "0";
    iframe.scrolling = "no";

    wparent = window.parent.document.getElementById(formatId);
    wp=window;

    if(!wparent){
        wparent=window.parent.window.parent.document.getElementById(formatId);
        wp=window.parent.window.parent.window;
    }

    //console.log(wparent);

    if (wparent) {
        has_iframe = wparent.getElementsByTagName('iframe').length;

        sidebar_second_ads = wp.Drupal.settings.imx_ads.imx_ads_smart_page_info.regions['sidebar_second'];
        if (!sidebar_second_ads) {
            sidebar_second_ads = wp.Drupal.settings.imx_ads.imx_ads_smart_page_info.regions['second_sidebar'];
            if (!sidebar_second_ads) {
                sidebar_second_ads = wp.Drupal.settings.imx_ads.imx_ads_smart_page_info.regions['sidebar_first'];
                if (!sidebar_second_ads) {
                    sidebar_second_ads = wp.Drupal.settings.imx_ads.imx_ads_smart_page_info.regions['stickybar'];
                }
            }
        }

        if (sidebar_second_ads) {
            if (sidebar_second_ads.length) {
                for (index = 0; index < sidebar_second_ads.length; ++index) {
                    ad_name_parts = sidebar_second_ads[index].title.split('|');
                    box_parent = wp.document.getElementById('imx_ads_' + ad_name_parts[2]);
                    if (box_parent) {
                        box_parent.style.cssText = 'display: none;';
                    }
                }
            }
        }

        if (!has_iframe) {
            wparent.innerHTML="";
            wparent.appendChild(iframe);
            iframe.contentWindow.contents = html;
            iframe.src = 'javascript:window["contents"]';
        }
    }
}

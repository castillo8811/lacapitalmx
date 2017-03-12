(function (jQuery) {
    jQuery.fn.IMxSmartReload = function (options) {
        var defaults = {
                selector_triggers: jQuery('.gallery-thumbs-container ul li .gallery-hover, .gallery-next, .gallery-prev, .gallery-arrow'),
                format_ids: null
            },
            settings = jQuery.extend({}, defaults, options);

        jQuery('.block-imx-ads').find(".imx_ads div[id^='sas_'], .imx_ads div[id^='eplAdDivbox_'], .imx_ads div[id^='imx_ads_'], .imx_ads iframe").each(function () {
            if (jQuery(this).height() > 100) {
                jQuery(this).parent().css("position", "relative");
                jQuery(this).parent().css("display", "inline-block");
                jQuery(this).parent().append('<div class="imx_loading" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;background: url(http://7327b8b8869b339d7dc2-e4c3f72b307ad87a3accc93231efb439.r9.cf2.rackcdn.com/progress.gif) no-repeat center center rgba(0,0,0,0.8);z-index: 10000;*z-index: 0;z-index: 0\9;display: none;"></div>');
            }
        });

        jQuery.each(settings.selector_triggers, function () {
            jQuery(this).click(function () {

                jQuery('.block-imx-ads').find(".imx_ads div[id^='sas_'], .imx_ads div[id^='eplAdDivbox_'], .imx_ads div[id^='imx_ads_'], .imx_ads iframe").each(function () {
                    if (jQuery(this).height() > 100) {
                        if (!jQuery(this).parent().find(".imx_loading").length) {
                            jQuery(this).parent().css("position", "relative");
                            jQuery(this).parent().css("display", "inline-block");
                            jQuery(this).parent().append('<div class="imx_loading" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;background: url(http://7327b8b8869b339d7dc2-e4c3f72b307ad87a3accc93231efb439.r9.cf2.rackcdn.com/progress.gif) no-repeat center center rgba(0,0,0,0.8);z-index: 10000;*z-index: 0;z-index: 0\9;display: none;"></div>');
                        }
                    }
                });


                fullscreenEnabled = document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement;

                if (typeof sas_callAds == 'function') {
                    //Metodo AjaxOne Call Activo
                    jQuery(".imx_loading").fadeIn('slow');
                    if (settings.format_ids) {
                        jQuery.each(settings.format_ids, function () {
                            if (!fullscreenEnabled) {
                                if (typeof sas_callAds == 'function')
                                    sas_callAds(this);
                            }
                        });
                    } else {
                        if (!fullscreenEnabled) {
                            if (typeof sas_callAds == 'function')
                                sas_callAds();
                        }
                    }

                    jQuery(".imx_loading").fadeOut('slow');

                } else {
                    //Metodo SmartServer Activo
                    if (!fullscreenEnabled) {
                        jQuery(".imx_loading").fadeIn('slow');
                        jQuery('.block-imx-ads').each(function () {
                            parent_block = jQuery(this);
                            jQuery(this).find(".imx_ads").each(function () {
                                if (jQuery(this).height() > 100) {
                                    var adContainer=jQuery(this).attr("id");
                                    ad_format = adContainer.replace('imx_ads_', '');
                                    //console.log(ad_format);
                                    if(settings.format_ids){
                                        for(var i in settings.format_ids){
                                            //console.log('Proccesing: '+settings.format_ids[i]);
                                            if(adContainer.search(settings.format_ids[i])){
                                                jQuery(this).children().remove();
                                                createBannerAsync("http://cf.imx.static.files.invent.mx/imx_ads_async.html",sas_siteid,sas_pageid, ad_format, sas_target, adContainer);
                                            }
                                        }
                                    }else{
                                        jQuery(this).children().remove();
                                        createBannerAsync("http://cf.imx.static.files.invent.mx/imx_ads_async.html",sas_siteid,sas_pageid, ad_format, sas_target, adContainer);
                                    }
                                    function receiveMessage(event) {
                                        if (event.data.match(/^imx_ads.*/)) {
                                            imx_ads_message = event.data;
                                            ads_message = imx_ads_message.split('-');
                                            ads_parts = ads_message[1].split(':');
                                            ads_sizes = ads_parts[1].split('#');

                                            if (jQuery("#imx_ads_" + ads_parts[0]).length) {
                                                jQuery("#imx_ads_" + ads_parts[0]).height(ads_sizes[1]);
                                                jQuery("#imx_ads_" + ads_parts[0] + " iframe").height(ads_sizes[1]);

                                                jQuery("#imx_ads_" + ads_parts[0] + " iframe").width(ads_sizes[0]);
                                                jQuery("#imx_ads_" + ads_parts[0]).width(ads_sizes[0]);

                                                if (ads_sizes[1] > 400) {
                                                    jQuery("#imx_ads_" + ads_parts[0] + " iframe").width(400);
                                                    jQuery("#imx_ads_" + ads_parts[0]).width(405);
                                                }
                                            }

                                            if (jQuery("#" + ads_parts[0]).length) {
                                                jQuery("#" + ads_parts[0]).height(ads_sizes[1]);
                                                jQuery("#" + ads_parts[0] + " iframe").height(ads_sizes[1]);

                                                jQuery("#" + ads_parts[0]).width(ads_sizes[0]);
                                                jQuery("#" + ads_parts[0] + " iframe").width(ads_sizes[0]);

                                                if (ads_sizes[1] > 400) {
                                                    jQuery("#" + ads_parts[0]).width(405);
                                                    jQuery("#" + ads_parts[0] + " iframe").width(400);
                                                }
                                            }
                                        }
                                        jQuery(".imx_loading").fadeOut('slow');
                                    }

                                    window.addEventListener("message", receiveMessage, false);
                                }
                            });
                        });
                    }
                }
            });
        });
    };
})(jQuery);
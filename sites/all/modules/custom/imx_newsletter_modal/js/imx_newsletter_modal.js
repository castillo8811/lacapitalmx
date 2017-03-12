jQuery(document).ready(function () {
    if(!jQuery('body').hasClass('logged-in')){
        showModalSOS = true;
        hide_modal = false;
        newsletter_config = {
            expires: 1,
            path: "/",
            domain: _get_domain()
        };
        count_modals = jQuery.cookie("newsletter_modal");
        confirm_cookie=jQuery.cookie("newsletter_modal_confirm");

        if (count_modals > 1) {
            hide_modal = true;
        }

        if(showModalSOS){
            if (jQuery("#block-imx-comments-imx-comments").length) {
                jQuery(window).scroll(function(e){
                    scroll_window = jQuery(window).scrollTop();
                    offset_news = jQuery("#block-imx-comments-imx-comments").offset();
                    console.log(scroll_window+"---"+offset_news.top);
                    if (scroll_window >= offset_news.top) {
                        console.log("Primera: "+count_modals + " "+hide_modal+" "+confirm_cookie);
                        if (!count_modals && !hide_modal && !confirm_cookie) {
                            //loadNewsletterModal();
                            showModalSOS = false;
                            hide_modal = true;
                            count_modals++;
                            jQuery.cookie("newsletter_modal", count_modals, newsletter_config);
                        }
                    }
                });
            } else {
                if (!count_modals && !hide_modal && !confirm_cookie) {
                    console.log("Segunda: "+count_modals + " "+hide_modal+" "+confirm_cookie);
                    //loadNewsletterModal();
                    count_modals++;
                    jQuery.cookie("newsletter_modal", count_modals, newsletter_config);
                    showModalSOS = false;
                    hide_modal = true;
                }
            }
        }
    }
});

function loadNewsletterModal() {
    jQuery.ajax({
        url: '/newsletter-modal/open',
        type: 'GET',
        success: function (result) {
            if (result) {
                jQuery.colorbox({
                    html: result,
                    fixed: true,
                    scrolling: false
                });

                jQuery(".modal-close").click(function(){
                    jQuery.colorbox.close();
                });

                if (typeof _gaq !== "undefined") {
                    _gaq.push(['_trackEvent', "Newsletter Modal", "Open Dialog", "Open Dialog"]);
                }
            }
        }
    });
}

function _get_domain(formato) {
    var domain = location.host;
    var elements = new Array();
    var cookie_domain = new Array();
    elements = domain.split('.');
    cookie_domain[0] = elements[1];
    cookie_domain[1] = elements[2];
    domain = cookie_domain.join('.');
    if (formato === 'global')
        return '.' + domain;
    else
        return domain;
}

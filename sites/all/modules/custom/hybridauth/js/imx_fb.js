jQuery(document).ready(function () {
    jQuery("#hybrid_logout, .userfem_logout a, .hybrid_logout a").click(function (e) {
        linkLogout = jQuery(this).attr('href') && jQuery(this).attr('href') != 'undefined' ? jQuery(this).attr('href') : "/user/logout?destination=#nocache";
        e.preventDefault();
        if (typeof(FB) != 'undefined') {
            FB.getLoginStatus(function (response) {
                if (response.status === 'connected') {
                    FB.logout(function (response) {
                        window.location = linkLogout;
                    });
                } else {
                    window.location = linkLogout;
                }
            });
        } else {
            window.location = linkLogout;
        }
        window.location = linkLogout;
    });
});

jQuery(window).load(function () {
    if (jQuery(".logged-in").length) {
        if (typeof(FB) != 'undefined') {
            FB.getLoginStatus(function (response) {
                if (response.status === 'connected') {
                    if (jQuery(".logged-fb-image img").length) {
                        FB.api('/me', function (response) {
                            fb_image = "http://graph.facebook.com/" + response.id + "/picture?height=100&width=100";
                            //jQuery(".logged-fb-image img").attr("src", fb_image);
                            //jQuery(".logged-fb-name").html(response.name);
                        });
                    }

                    if (!jQuery.cookie("show_fb_shares")) {
                        getFBInvite();
                        fb_shares_config = {
                            expires: 7,
                            path: "/",
                            domain: "." + location.host
                        };
                        jQuery.cookie("show_fb_shares", true, fb_shares_config);
                    }

                    jQuery("#hybrid_logout, .userfem_logout a, .hybrid_logout a").click(function (e) {
                        e.preventDefault();
                        if (typeof(FB) != 'undefined') {
                            FB.logout(function (response) {
                                window.location = "/user/logout";
                            });
                        } else {
                            window.location = "/user/logout";
                        }
                    });
                }
            });
        }
    }
});

window.fbAsyncInit = function () {
    FB.init({appId: '1535708306681196', init: true, status: true, oauth: true, cookie: true, xfbml: true});
    FB.getLoginStatus(function (response) {
        if (response.status === 'connected') {
            FB.api('/me', function (response) {
                //console.log("Iniciando a" + response.id);
                start_autologin(response.id);
            });
        }
    });
}

function getFBInvite() {
    if (typeof(FB) != 'undefined') {
        FB.ui({
                method: 'apprequests',
                message: 'Recomienda Garuyo a tus amigos'},
            function (response) {
                FB.ui({
                    method: 'feed',
                    link: location.protocol + "//" + location.host,
                    picture: 'http://mirror.garuyo.com/images/logo_garuyo_fb.png',
                    name: 'Bienvenido a Garuyo.com, el sitio de entretenimiento personalizado',
                    description: 'Ya elegí mis gustos en Garuyo.com para tener un sitio de entretenimiento, hecho a mi medida. Forma parte de esta nueva manera de divertirte e informarte.'
                }, function (response) {

                });
            }
        );
    }
}

function start_autologin(fb_id) {
    var fb_id = {fb_id: fb_id };
    var url = "/hybridauth/ajaxFBLogin";
    jQuery.ajax({
        type: "POST",
        url: url,
        dataType: 'json',
        data: fb_id,
        success: function (data) {
            if (data) {
                //console.log(data);
                window.location.reload();
            }
        }
    });

}
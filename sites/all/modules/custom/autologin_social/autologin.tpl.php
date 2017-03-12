<?php
global $user; 
$ruta = arg(0);

if (empty($user->uid) && $ruta !== 'social_logout'):
    ?>
    <div id="autologin" class="centertext">  
        <script type="text/javascript">           
            var facebook_id = Drupal.settings.id;
            window.fbAsyncInit = function() {
                FB.init({
                    appId: facebook_id,
                    cookie: true, // enable cookies to allow the server to access 
                    // the session
                    xfbml: true, // parse social plugins on this page
                    version: 'v2.0' // use version 2.0
                });
                // 1. Logged into your app ('connected')
                // 2. Logged into Facebook, but not your app ('not_authorized')
                // 3. Not logged into Facebook and can't tell if they are logged into
                //    your app or not.            
                FB.getLoginStatus(function(response) {
                    EstadoLoginAcciones(response);

                });


            };
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/es_LA/sdk.js";//connect.facebook.net/es_LA/all.js#xfbml=1
                fjs.parentNode.insertBefore(js, fjs);
            }
            (document, 'script', 'facebook-jssdk'));

            function EstadoLoginAcciones(response) {
                if (response.status === 'connected') {
                    userConectadoFacebook(response);
                } else if (response.status === 'not_authorized') {


                } else {
                    // se considerara estado unknown;  no esta conectado en facebook  
                }
            }

            function logout_session_usuario_facebook() {
                FB.getLoginStatus(function(response) {
                    if (response.status === 'connected') {
                        FB.logout(function(response) {
                            // si quieres poner algun accion para el deslogueo es aqui
                        });
                    }

                });


            }

            function userConectadoFacebook(response) {
               
                var userID = response.authResponse.userID;
                (function($) {
                    var post = {token: userID};
                    var url = "/admin/config/autologin";
                    $.ajax({
                        type: "POST",
                        url: url,
                        dataType: 'json',
                        data: post,
                
                        success: function(data) {
                                if (data) {
                                  avisoAutologueo(4,2);
                              }
                        }
                    });
                }(jQuery));

            }

            function avisoAutologueo(time,option) {
                var html = [
                    '<div class="centertext clear">',
                    '<div class="tinitalic fs38 strong">¡Bienvenid@ a Salud180!</div>',
                    ' <p class="tinitalic fs20">Espera un momento en lo que comienza tu sesión</p>',
                    ' </div>',
                    ' <div class="gifWrap centertext clear relative">',
                    '<span class="absolute snv face-autologin"></span>',
                    '<span class="absolute snv salud-autologin"></span>',
                    '<img src="/sites/all/themes/saludnv/img/autologin.gif" />',
                    ' </div>',
                ];   
                TINY.box.show({
                    html: html.join(''),
                    close: true,
                    mask: true,
                    boxid: 'autologinFacebook',
                    fixed:true ,
                    maskid:'panel_box_tiny',
                    autohide:time,
                    openjs: function() {                       
                    jQuery('.tbox').css('background', 'transparent');                  
                    },
                    closejs:function (){ window.location.reload();}
                
                
                
                
                });
            }

        </script> 
        
        </div>
        <?php  endif;

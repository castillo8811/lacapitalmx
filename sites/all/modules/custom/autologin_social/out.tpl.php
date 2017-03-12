<?php
$ruta = arg(0);
if ($ruta === 'social_logout'):
    ?>
    <div id="autologout" class="formSesion clear centertext relative bgBoxBorder borderBox center-elem">  
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
                    logout_session_usuario_facebook();
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


        </script>     
        <div>        
            <div class="titleBlock tinitalic strong fs30">Tu sesión se ha cerrado correctamente</div>
            <div>
                <a class="tit fs14 returnText" href="/">Ir a inicio de Salud180 ></a>
            </div>
            <span class="snv separator"></span>
            <div>
                <a class="tit fs14 returnText" href="/user/login">Volver a iniciar sesión ></a>
            </div>
            <div class="newsText tinitalic fs18">Noticias que te pueden interesar:</div>
        </div> 
        <div id="newsLogout" category="Noticias Logout" class="clicsAnalytics links-premium">
            <ul class="tripleItem">
                <?php foreach ($data['notas'] as $nota => $value): ?>
                    <li class="links-premium-item dis-in-bl centertext">
                        <a href="<?php print $value['url'] ?>" title="<?php print check_plain($value['title']); ?>">
                            <span class="imageWrapper dblock relative">
                                <img class="img-item-premium rds25" height="169" width="217" src="<?php print $value['image'] ?>" alt="<?php print check_plain($value['title']); ?>" title="<?php print check_plain($value['title']); ?>" />
                                <span class="absolute iconType snv type-<?php print $value['type'] ?>"></span>
                            </span>
                            <span class="dblock category tin fs16"><?php print $value['category']?></span>
                            <span class="snv separator"></span>
                            <span class="links-premium-text dblock oslight fs22"><?php print $value['title']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div> 
    <?php





 endif;


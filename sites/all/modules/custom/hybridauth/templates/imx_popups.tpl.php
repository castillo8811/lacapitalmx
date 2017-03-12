jQuery.ajax({
      type: "GET",
      cache: false,
      url: "hybridtauth/register/fancy", // preview.php
      //data: $("#postp").serializeArray(), // all form fields
      success: function (data) {
        jQuery.colorbox({html:data,scrolling:false})
        // on success, post (preview) returned data in fancybox

      } // success
    }); // ajax
    
        <section id='popup_iniciar_sesion' class='windowRegister'>
            <div class='windowHeader'>
                <img src='images/logo_garuyo_v4.png' />
                <div class='windowRegister-close'>
                    <span class='O25l1'>Cerrar <strong>X</strong></span>
                </div>
            </div>
            <div class='windowBody'>
                <h3 class='O25l0 tacenter mb20'>¡Inicia sesión con tu correo electrónico!</h3>
                <div class='userLoginForm tacenter'>
                    <?php print drupal_get_form('user_login') ?>
                </div>
                <h3 class='O25l0 tacenter mb20'>También puedes ingresar con tu red social favorita</h3>
                <div class='loginSocial tacenter'>
                       <?php
                $block = module_invoke('hybridauth', 'block_view', 'hybridauth');
                print render($block['content']);
                ?>
                </div>
                <p class='mb40 mt20'>
                    <a href='#' class='O20l4'>Soy nuevo, me quiero registrar</a>
                </p>
            </div>
        </section>    
    
    
         <section id='popup_registro_01' class='windowRegister'>
            <div class='windowHeader'>
                <img src='images/logo_garuyo_v4.png' />
                <div class='windowRegister-close'>
                    <span class='O25l1'>Cerrar <strong>X</strong></span>
                </div>
            </div>
            <div class='windowBody'>
                <h2 class='O30l0 tacenter mt30 mb30'>¡Regístrate ahora!</h2>
                <div class='userRegistrationForm tacenter'>
                    <form class="user-info-from-cookie" enctype="multipart/form-data" action="/user/register" method="post" id="user-register-form" accept-charset="UTF-8">
                      <?php
                $register_form = drupal_get_form('user_register_form');
                $register_form["actions"]['submit']["#value"] = "Registrar";
                $register_form["#action"] = "/user/register";
                ?>
                <?php print drupal_render($register_form) ?>
                    </form>
                </div>
                <div class='tacenter centered mt40 mb20'>
                    <p class='A13r0 mb5 lh20'>Al continuar, declaras que aceptas nuestros <a href='/terminos-y-condiciones-de-uso'>Términos y condiciones de uso</a> y nuestro <a href='/aviso-de-privacidad'>Aviso de privacidad</a>.</p>
                    <p class='A13r0 lh20'>Y quedarás suscrito al boletín de Garuyo.com y servicios, en caso de que no desees recibirlo podrás cancelarlo en cualquier momento.</p>
                </div>
            </div>
        </section>
    
    
     <section id='popup_olvidar_contrasena_v2' class='windowRegister'>
            <div class='windowHeader'>
                <img src='images/logo_garuyo_v4.png' />
                <div class='windowRegister-close'>
                    <span class='O25l1'>Cerrar <strong>X</strong></span>
                </div>
            </div>
            <div class='windowBody'>
              <p class="mt20 O30l0 lh30">¿Olvidaste tu contraseña?</p>

            </div>
        </section>
    
<?php global $user?>
<?php if(!$user->uid): ?>
<?php
$form["actions"]['submit']["#value"] = "Registrar";
$form["#action"] = "/user/register";
$form["account"]["mail"]["#title"] = "";
$form["account"]["mail"]["#description"] = "";
$form["account"]["mail"]['#attributes']["placeholder"] = "Tu correo electrónico";

$form["account"]["pass"]["pass1"]["#title"] = "";
$form["account"]["pass"]["pass2"]["#title"] = "";
$form["account"]["pass"]["#description"] = "";
$form["account"]["pass"]["pass1"]['#attributes']["placeholder"] = "Contraseña";
$form["account"]["pass"]["pass2"]['#attributes']["placeholder"] = "Repite la contraseña";
$form["actions"]['submit']["#attributes"]["class"][] = "btn-registrar";
?>
<section id="userRegistrationWrapper" class="border-top">
    <section id="userRegistration">
        <h2 class="O60l0 tacenter mb30 mt40">¡Regístrate ahora!</h2>
        <div class="userRegistrationForm tacenter">
                      <form class='user-info-from-cookie' enctype='multipart/form-data' action='<?php echo $form["#action"]?>' method='post' id='<?php echo $form["#form_id"]?>' accept-charset='UTF-8'>
            <?php print drupal_render_children($form); ?>
                        </form>
        </div>
        <div class="hybridauth-login-alternative tacenter">
            <h3 class="O40l0 tacenter mt40 mb20">También puedes ingresar con tu red social favorita</h3>
            <?php
            $block = module_invoke('hybridauth', 'block_view', 'hybridauth');
            print render($block['content']);
            ?>
        </div>
        <div class="userRegisterLegals tacenter centered mt40 mb40">
            <p class="A15r0 mb5 lh20">Al continuar, declaras que aceptas nuestros <a href="/terminos-y-condiciones-de-uso">Términos y condiciones de uso</a> y nuestro <a href="/aviso-de-privacidad">Aviso de privacidad</a>.</p>
            <p class="A15r0 lh20">Y quedarás suscrito al boletín de Garuyo.com y servicios, en caso de que no desees recibirlo podrás cancelarlo en cualquier momento en la sección de Configuración dentro del menú Mi Perfil.</p>
        </div>
    </section>
</section>
<script type="text/javascript">
        jQuery.removeCookie('last_section', {path: '/'});
        jQuery.cookie.json = true;
        var last_section = {"last_section": window.location.pathname};
        favorite_config = {
            expires: 10,
            path: "/",
        };
        jQuery.cookie("last_section", last_section, favorite_config);
</script>
<?php endif;?>

<?php $form = drupal_get_form("user_login"); ?>
<?php drupal_add_js(drupal_get_path('theme', 'actitudfemv2') . '/js/login.js');?>
<div class="actitudfem-user-login-form-wrapper mb30">
    <div class="actitudfem-login-Header">
        <p class="P50i3 bolder">Regístrate o conéctate</p>
        <p class="P36i2 taright">con tu cuenta social favorita</p>
    </div>
    <div class="hybridauth-login-alternative tacenter">
        <p class="B14r3 mb30">Únete a Garuyo.com</p>
        <?php
        $block = module_invoke('hybridauth', 'block_view', 'hybridauth');
        print render($block['content']);
        ?>
    </div>
    <p class="user-form-accept mtb20 P14r3">Al continuar, declaras que aceptas nuestros <a class="P14r7" href="/terminos-y-condiciones-de-uso">Términos y Condiciones de uso</a> y nuestro <a class="P14r7" href="/aviso-de-privacidad">Aviso de privacidad</a></p>
    <span class="P16i5 mtb20 link bolder showLoginFormBlock">Deseo acceder con mi cuenta de correo</span>
    <div class="user-login-form-block imxBuidForm mtb20" style="display: none;">
        <?php print drupal_render($form) ?>
        <a class="user-form-recovery mt20" href="/user/password">Recuperar contraseña</a>
    </div>
    <div class="clear"></div>
</div>

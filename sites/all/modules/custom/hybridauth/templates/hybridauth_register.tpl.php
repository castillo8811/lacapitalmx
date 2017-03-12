<?php $formReg = drupal_get_form("user_register_form"); ?>
<?php $formLogin = drupal_get_form("user_login"); ?>
<?php drupal_add_js(drupal_get_path('theme', 'bartik') . '/js/login.js');?>
<div id="socialHome" class="actitudfem-user-register-form-wrapper">
    <div class="actitudfem-login-Header">
        <p class="P45i3 bolder">¿Quieres recibir lo más reciente</p>
        <p class="P36i0 taright"> a tu correo?</p>
        <div class="socialSeparator prelative">
            <span class="circle"></span>
            <span class="dottedLineFull"></span>
        </div>
    </div>
    <div id="socialButtons">
        <div class="hybridauth-login-alternative tacenter">
            <p class="B14r3 mb30">Únete a Garuyo.com</p>
            <?php
            $block = module_invoke('hybridauth', 'block_view', 'hybridauth');
            print render($block['content']);
            ?>
        </div>
        <p class="user-form-accept mtb20 P14r3">Al continuar, declaras que aceptas nuestros <a class="P14r7" href="/terminos-y-condiciones-de-uso">Términos y Condiciones de uso</a> y nuestro <a class="P14r7" href="/aviso-de-privacidad">Aviso de privacidad</a></p>
        <span class="P16i5 mt20 mb10 link bolder dblock showLoginHFormBlock">Deseo acceder con mi cuenta antigua</span>
        <span class="P16i5 mb20 link bolder dblock showRegisterFormBlock">Soy nuev@ regístrame con mi email</span>
    </div>
    <div class="user-login-form-block imxBuidFormLogin mtb20" style="display: none;">
        <p class="B14r3">Por favor ingresa tus datos</p>
        <?php print drupal_render($formLogin) ?>
        <span class="P16i5 mtb20 link bolder showSocialButtons">Deseo acceder con mi red social</span>
    </div>
    <div class="user-register-form-block imxBuidFormReg mtb20" style="display: none;">
        <p class="B14r3">Por favor ingresa tus datos</p>
        <?php print drupal_render($formReg) ?>
        <p class="user-form-accept mtb20 P14r3">Al continuar, declaras que aceptas nuestros <a class="P14r7" href="/terminos-y-condiciones-de-uso">Términos y Condiciones de uso</a> y nuestro <a class="P14r7" href="/aviso-de-privacidad">Aviso de privacidad</a></p>
        <span class="P16i5 mtb20 link bolder showSocialButtons">Deseo acceder con mi red social</span>
    </div>
    <div class="clear"></div>
    <style type="text/css">
        .form-item-field-terminos-condiciones-und a {color: #f66;}
    </style>
</div>

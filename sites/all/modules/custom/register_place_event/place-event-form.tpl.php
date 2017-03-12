<?php
//drupal_add_css(drupal_get_path("theme","garuyod7")."/css/validationEngine.jquery.css");
//drupal_add_js(drupal_get_path("theme","garuyod7")."/js/validationEngine/jquery.validationEngine.js");
drupal_add_js(drupal_get_path("theme","garuyod7")."/js/jquery.validate.min.js");
drupal_add_js(drupal_get_path("theme","garuyod7")."/js/additional-methods.js");
$form['submit']["#attributes"]["class"][] = "btn-registrar centered";
//$form['deseo_registrar']["#attributes"]["class"][] = "validate[required]";
//print_r($form);exit;
if($user->uid){
  hide($form["email"]);
}else{
$form['submit']["#attributes"]["class"][] = "btn-registrar centered ";  
}
?>
<section id="registerEvent" class="tacenter">
    <h1 class="O60l0 tacenter mt30 mb30">¿Qué deseas registrar?</h1>
    <div class="registerEventForm <?php echo ($user->uid)? "pb40":""?>">
        <div class="registerEvent-form-item registerEvent-tipo relative">
            <?php print render($form["deseo_registrar"]); ?>
            <div class="clear"></div>
        </div>
        <div class="registerEvent-form-item registerEvent-soy relative">
            <?php print render($form["soy"]); ?>
            <div class="clear"></div>
        </div>
        <div class="registerEvent-form-item registerEvent-title relative">
            <?php print render($form["title"]); ?>
        </div>
        <div class="registerEvent-form-item registerEvent-description relative">
            <?php print render($form["description"]); ?>
        </div>
        <div class="registerEvent-form-item registerEvent-estado relative">
            <?php print render($form["estado"]); ?>
        </div>
        <div class="registerEvent-form-item registerEvent-direccion relative">
            <?php print render($form["direccion"]); ?>
        </div>
        <div class="registerEvent-form-item registerEvent-phone relative">
            <?php print render($form["phone"]); ?>
        </div>
        <div class="registerEvent-form-item registerEvent-web relative">
            <?php print render($form["pagina-web"]); ?>
        </div>
        <div class="registerEvent-form-item registerEvent-category relative">
            <?php print render($form["category"]); ?>
            <div class="clear"></div>
        </div>
        <div class="registerEvent-form-item registerEvent-publico relative">
            <?php print render($form["publico"]); ?>
            <div class="clear"></div>
        </div>
        <div class="registerEvent-form-item registerEvent-caracteristicas relative">
            <?php print render($form["caracteristicas"]); ?>
            <div class="clear"></div>
        </div>
        <div class="registerEvent-form-item registerEvent-pago relative">
            <?php print render($form["forma_pago"]); ?>
            <div class="clear"></div>
        </div>
        <div class="registerEvent-form-item registerEvent-rangos relative">
            <?php print render($form["rangos_precio"]); ?>
            <div class="clear"></div>
        </div>
      <?php if(!$user->uid):?>
        <div class="registerEvent-form-item registerEvent-email relative">
            <?php print render($form["email"]); ?>
        </div>
      <?php endif;?>
    </div>
    <?php if(!$user->uid):?>
    <div class="userRegisterLegals tacenter centered mt40 mb40">
        <p class="A15r0 mb5 lh20">Al continuar, declaras que aceptas nuestros <a href="/terminos-y-condiciones-de-uso">Términos y condiciones de uso</a> y nuestro <a href="/aviso-de-privacidad">Aviso de privacidad</a>.</p>
        <p class="A15r0 lh20">Y quedarás suscrito al boletín de Garuyo.com y servicios, en caso de que no desees recibirlo podrás cancelarlo en cualquier momento en la sección de Configuración dentro del menú Mi Perfil.</p>
    </div>
    <input id="registro-place" type="buttom" class="btn-registrar no-sesion" value="REGISTRAR" />
    <?php else: ?>
    <?php print drupal_render_children($form);?>
    <?php endif;?>
</section>
<div class="limited">
    <div class="userProfileData ptb20 mt30 mb20" itemscope itemtype="http://schema.org/Person">
        <div class="userProfileData-img left cuad-2 tacenter">
            <?php print theme('user_picture', array('account' => $user, 'style_name' => '')) ?>
        </div>
        <div class="userProfileData-info right cuad-10 bsbb">
            <h4 itemprop="name" class="O30r0 mb20 icn-boletin-b">Mi boletín</h4>
            <h5 class="N25b4">¡Hola <?php print ($user->name) ? $user->name : $user->mail ?>!</h5>
            <p itemprop="description" class="N18r0 mtb10">Esta sección es tuya, aquí encontrarás secciones para ofrecerte un mejor servicio.</p>
        </div>
        <div class="clear"></div>
    </div>
    <section id="boletinBenefits">
        <h1 class="O30r0 tacenter mb20 mw80">Date nuestro boletín y...</h1>
        <ul class="centered">
            <li class="mb20 dblock">
                <span class="icn-checkbox left"></span> <span class="N21r0 ml10 left mt20 mw80">Entérate de lo que pasa fuera de las cuatro paredes de tu oficina...</span>

                <div class="clear"></div>
            </li>
            <li class="mb20 dblock">
                <span class="icn-checkbox left"></span> <span class="N21r0 ml10 left mt20 mw80">Actualiza tu agenda...</span>

                <div class="clear"></div>
            </li>
            <li class="mb20 dblock">
                <span class="icn-checkbox left"></span> <span class="N21r0 ml10 left mt20 mw80">Decide qué hacer cuando llegue la hora de salida</span>

                <div class="clear"></div>
            </li>
            <li class="mb20 dblock">
                <span class="icn-checkbox left"></span> <span class="N21r0 ml10 left mt20 mw80">Entrégate a nuestra ciudad (en plena calle o desde la comodidad de tu sillón).</span>

                <div class="clear"></div>
            </li>
        </ul>
        <div class="boletinForm centered mt40 mb30">
            <form>
                <div>
                    <div class="N18r0 left bsbb col-2 tacenter mt7">Deseo recibir boletín</div>
                    <div class="N18r0 left bsbb col-2">
                        <label for="boletin-si">Sí</label> <input id="boletin-si" type="radio" name="boletin" <?php print ($has_newsletter)? 'checked="checked"': ''?>/>
                        <label for="boletin-no">No</label> <input id="boletin-no" type="radio" name="boletin" <?php print (!$has_newsletter)? 'checked="checked"': ''?>/>
                    </div>
                    <div class="clear"></div>
                </div>
            </form>
            <p class="N18r0 mt40 tacenter">Lee los <a href="/terminos-y-condiciones-de-uso">Términos y condiciones</a> del servicio y nuestro <a href="/aviso-de-privacidad">Aviso de privacidad</a>.</p>
        </div>
    </section>
</div>
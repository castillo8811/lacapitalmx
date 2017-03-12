<?php $logo= getLogoNlModal() ?>
<div class="imx-newsletter-modal-wrapper">
    <div class="imx-newsletter-modal">
        <div class="imx-newsletter-modal-logo tacenter">
            <img src="<?php print $logo?>" alt="Inicio" />
            <img src="/sites/all/themes/lacapitalmx_d7_responsive/lacapitalmx/images/cerrar.png" class="right modal-close link" alt="Inicio" />
        </div>
        <div class="imx-newsletter-modal-form">
            <div class="imx-newsletter-modal-text">
                <span>Recibe lo mejor de La Capital en tu correo electrónico</span>
            </div>
            <form id="imx-newsletter-data">
                <div class="imx-newsletter-modal-form-input-text">
                    <input id="imx_nm_name" type="text" name="imx_nm_name" class="clean_first" placeholder="Ingresa tu nombre" />
                    <input id="imx_nm_mail" type="text" name="imx_nm_mail" class="clean_first" placeholder="Ingresa tu correo electrónico" />
                </div>
                <div class="imx-newsletter-modal-form-action">
                    <input type="submit" class="imx-newsletter-modal-send link" value="Enviar" />
                    <div class="imx-newsletter-modal-form-input-check">Al continuar, declaras que aceptas nuestro <a target="_blank" href="/aviso-privacidad">Aviso de Privacidad</a></div>
                </div>
            </form>
            <div class="wrapper-loading imx_news_loading tacenter" style="display: none;"><img src="http://www.actitudfem.com/sites/www.actitudfem.com/themes/actitudfem/images/loader_florecita40.gif"></div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/<?php print drupal_get_path('module', 'imx_newsletter_modal') . '/js/imx_newsletter_modal_form.js'?>"></script>

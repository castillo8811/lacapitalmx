<?php
    global $theme;
    $logo= "/sites/all/themes/{$theme}/images/logo.png";
?>
<?php if(!$_COOKIE["newsletter_modal_confirm"]):?>
<div class="imx-newsletter-block-wrapper mt20">
    <div class="imx-newsletter-block">
        <div class="imx-newsletter-modal-logo tacenter">
            <img src="<?php print $logo?>" alt="Inicio" />
        </div>
        <div class="imx-newsletter-block-form">
            <div class="imx-newsletter-block-text">
                <span>Recibe las mejores noticias en tu correo en tu correo electrónico ¡Es Gratis!</span>
            </div>
            <form id="imx-newsletter-block-data">
                <div class="imx-newsletter-block-form-input-text">
                    <div class="left">
                        <input id="imx_nm_name" type="text" name="imx_nm_name" class="clean_first" placeholder="Ingresa tu nombre" />
                    </div>
                    <div class="left">
                        <input id="imx_nm_mail" type="text" name="imx_nm_mail" class="clean_first" placeholder="Ingresa tu correo electrónico" />
                    </div>
                    <input type="submit" class="imx-newsletter-block-send link" value="Unirme" />
                    <div class="clear"></div>
                </div>
                <div class="imx-newsletter-block-form-action">
                    <div class="imx-newsletter-block-form-input-check">Al continuar, declaras que aceptas nuestro <a target="_blank" href="/aviso-privacidad">Aviso de Privacidad</a>
                        . Y quedarás suscrito al boletín de La Capital y sus servicios, en caso que no desees recibirlo podrás cancelarlo
                          en cualquier momento</div>
                </div>
            </form>
            <div class="wrapper-loading imx_news_loading tacenter" style="display: none;"><img src="/sites/all/themes/lacapitalmx/images/loading_icon.gif"></div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/<?php print drupal_get_path('module', 'imx_newsletter_modal') . '/js/imx_newsletter_block_form.js'?>"></script>
<?php endif?>
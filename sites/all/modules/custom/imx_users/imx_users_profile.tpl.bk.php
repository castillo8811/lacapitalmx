<section id="imx-users-profile">
    <div class="colaboradorFirma pb20 bb1 mb20" itemscope itemtype="http://schema.org/Person">
        <?php if ($data['login']): ?>
            <span class="sesion-user"><a href="/user/logout">Cerrar Sesión</a></span>
        <?php endif ?>
        <div class="left cuad-2">
            <img itemprop="image" src="<?php echo ($data["image"])? $data["image"]:$data['background'] ?>" alt="<?php echo $data['name'] ?>" />
        </div>
        <div class="right cuad-10 bsbb">
            <h4 itemprop="name"><a itemprop="url" class="N25b4"><?php echo $data['name'] ?></a></h4>
            <p itemprop="description" class="N14r0 mtb10"><?php echo $data['signature'] ?></p>
            <?php if (!is_null($data['personal_url'])): ?>
                <a href="<?php echo htmlentities($data['personal_url']); ?>" itemprop="url" class="N14r7"><?php echo htmlentities(preg_replace('/(http|https)\:\/\//i ', '', $data['personal_url'])); ?></a>
            <?php endif ?>
            <div class="nodeAuthorSocial mt20">
                <ul>
                    <li class="diblock mr20">
                        <?php if (!is_null($data['twitter'])): ?>
                            <a href="https://twitter.com/<?php print $data['twitter']; ?>" class="twitter-follow-button" data-show-count="false">Seguir a @<?php echo $data['twitter']; ?></a>
                        <?php else: ?>
                            <a class="twitter-follow-button" style="text-aling:center;" href="https://twitter.com/migaruyo"  data-show-count="false" data-lang="es"  data-show-screen-name="false">Seguir a @migaruyo</a>
                        <?php endif; ?>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                    </li>
                    <li class="diblock mr20">
                        <?php if (!is_null($data['facebook'])): ?>
                            <div class="fb-follow" data-href="https://www.facebook.com/<?php echo $data['facebook']; ?>" data-layout="button" data-show-faces="true"></div>
                        <?php else: ?>
                            <div class="fb-follow" data-href="https://www.facebook.com/Garuyo" data-colorscheme="light" data-layout="button" data-show-faces="true"></div>
                        <?php endif; ?>
                    </li>
                    <li class="diblock">
                        <script src="https://apis.google.com/js/platform.js" async defer></script>
                        <?php if (!is_null($data['google'])): ?>
                            <div class="g-follow" data-href="<?php echo htmlentities($data['google']); ?>" data-rel="author" data-annotation="none"></div>
                        <?php else: ?>
                            <div class="g-follow" data-href="https://plus.google.com/+GaruyoOficial" data-rel="author" data-annotation="none"></div>
                        <?php endif ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</section>
<?php if (isset($data['background'])): ?>
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                var background_url = "<?php // echo $data['background'];  ?>";
                if (background_url != '') {
                    jQuery('body').css("background", "url('" + background_url + "' ) no-repeat fixed center 0");
                    jQuery('#page-wrapper').css('background', 'none');
                };
            });  //Termina ready
        })(jQuery);
    </script>
<?php endif; ?>
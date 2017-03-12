<?php drupal_add_js(drupal_get_path("theme","garuyod7")."/js/masonry.pkgd.min.js")?>
<div class="limited">
    <div class="userProfileData ptb20 mt30 mb20" itemscope itemtype="http://schema.org/Person">
        <div class="userProfileData-img left cuad-2 tacenter">
            <?php print theme('user_picture', array('account' =>$user,'style_name' => ''))?>
        </div>
        <div class="userProfileData-info right cuad-10 bsbb">
            <h4 itemprop="name" class="O30r0 mb20 icn-pin-b">Mis favoritos</h4>
            <h5 class="N25b4">¡Hola <?php print ($user->name)? $user->name:$user->mail ?>!</h5>
            <p itemprop="description" class="N18r0 mtb10">Esta sección es tuya, aquí encontrarás secciones para ofrecerte un mejor servicio.</p>
        </div>
        <div class="clear"></div>
    </div>
    <?php if(!$has_favorites):?>
        <section id="userProfileTutorial" class="mb30">
            <div class="col-2 bsbb left tacenter">
                <img src="/sites/all/themes/garuyod7/images/instruccion_popup.png"/>
                <p class="taleft mt10 lh18 N14r0">Para agregar contenido a la sección de Favoritos, solamente haz clic sobre el pin que se encuentra en la parte superior izquierda</p>
            </div>
            <div class="col-2 bsbb left tacenter">
                <img src="/sites/all/themes/garuyod7/images/img_fav_02.jpg"/>
                <p class="taleft mt10 lh18 N14r0">Para agregar contenido a la sección de Favoritos, solamente haz clic sobre el pin que se encuentra en la parte superior izquierda</p>
            </div>
            <div class="clear"></div>
        </section>
    <?php endif;?>
    <div id="userFavs" class="mb20">
        <?php if(!$has_favorites):?>
            <h1 class="O30r0 tacenter mb20">Esto es lo más visto en Garuyo</h1>
        <?php else: ?>
            <h1 class="O30r0 tacenter mb20">Tienes <span class="count-favorites"><?php print count($data)?></span> guardados</h1>
        <?php endif;?>
        <section class="nodesList listado-cuadricula limited">
            <ul class="grid-pos">
                <?php foreach($data as $i=>$node): ?>
                    <?php if ($i == 2): ?>
                        <li id="imx_ads_block_1" class="col-3 bsbb pl10 mt30 tacenter pr5 mb20 left pos-grid stamp">
                        </li>
                    <?php endif; ?>
                    <li class="col-3 bsbb pl10 mt30 pr5 mb20 left pos-grid">
                        <article itemscope itemtype="http://schema.org/NewsArticle">
                            <div class="nodesList-img prelative pt10">
                                <div class="nodesList-tools <?php print get_ocio_class_name($node["ocio"][0]["tid"],"bg")?>">
                                    <div class="nodesList-section <?php print get_ocio_class_name($node["ocio"][0]["tid"],"pleca")?>-s"></div>
                                    <span data-mark-nid="<?php echo $node['nid'] ?>" data-mark-status="0" data-mark-type="1" title="Agregar a favoritos" id="<?php echo $node['nid'] ?>" class="icn-pin imx-mark-pin-favorites right link mr10 mt5 imx_mark  <?php print ($has_favorites)?"imx-mark-pin-favorites-remove_after imx-mark-pin-favorites-selected" :"" ?>"></span>
                                </div>
                                <a href="<?php print url("node/".$node["nid"],array('absolute'=>true))?>">
                                    <img itemprop="image" src="<?php print image_style_url('home_y_canales', $node["image_uri"])?>" alt="<?php print $node["title"]?>" />
                                </a>
                                <div class="nodesList-ranking <?php print get_ocio_class_name($node["ocio"][0]["tid"],"bg")?>-o">
                                    <span class="stars-2"></span>
                                </div>
                            </div>
                            <div itemprop="keywords" class="N18b4 mt5">
                                <?php if ($node["category"]): ?>
                                    <a href="<?php echo url('taxonomy/term/' . $node["category"][0]["tid"],array('absolute' => true)) ?>" class="N16b4"><?php echo strtolower($node["category"][0]["name"]) ?></a>
                                <?php endif; ?>
                                <?php if(isset($node["category_second"])):?>
                                    <?php foreach ($node["category_second"] as $t): ?>
                                        |<a href="<?php echo url('taxonomy/term/' . $t["tid"],array('absolute' => true)) ?>" class="N16b4"><?php echo strtolower($t["name"]) ?></a>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                            <h1 itemprop="headline" class="mtb10">
                                <a href="#" class="O25r0"><?php print $node['title']?></a>
                            </h1>
                            <p itemprop="description" class="N18r0 lh22"><?php print $node['summary']?></p>
                        </article>
                    </li>
                <?php endforeach;?>
            </ul>
            <div class="clear"></div>
        </section>
    </div>
</div>
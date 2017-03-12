<?php 
    drupal_add_js(array('infinite_taxonomy' => array('category' => $items["tid"])), 'setting');
    drupal_add_css(drupal_get_path('theme', 'garuyod7') . '/js/infiniteScroll/IMXScroll.css');
    drupal_add_js(drupal_get_path('theme', 'garuyod7') . '/js/infiniteScroll/handlebars-v1.3.0.js', array('scope' => 'header', 'weight' => -2));
//    drupal_add_js(drupal_get_path('theme', 'garuyod7') . '/js/infiniteScroll/jquery.ImxInfiniteScroll.plugin-v2.0.min.js', array('scope' => 'header', 'weight' => -1));
    drupal_add_js(drupal_get_path('theme', 'garuyod7') . '/js/infiniteScroll_ajax_tax.js', array('scope' => 'header', 'weight' => 0));
?>
<?php if ($items["nodes"]): ?>
        <section class="nodesList listado-cuadricula limited">
            <ul>
            <?php
            foreach ($items["nodes"] as $idx => $v):
                $ocio = $v["ocio"];
                $images = $v["imagen"];
                $categoria = $v["categoria"];
                $body_sumary = $v["body"];
                $votos = $v["votos"];
                $title = $v["title"];
                ?>
                <?php if ($idx == 2): ?>
                    <li id="imx_ads_block_1" class="col-3 bsbb pl10 mt30 tacenter pr5 mb20 left">
                    </li>
                <?php endif; ?>
                <li class="col-3 bsbb pl10 mt30 pr5 mb20 left">
                    <article itemscope itemtype="http://schema.org/NewsArticle">
                        <div class="nodesList-img prelative pt10">
                            <div class="nodesList-tools <?php echo ($ocio == 305787) ? "bg-ocio-calle" : " bg-ocio-sillon" ?>">
                                <div class="nodesList-section <?php echo ($ocio == 305787) ? "pleca-ocio-calle-s" : "pleca-ocio-sillon-s" ?>"></div>
                                <?php if ($user->uid > 0): ?>
                                    <span title="Agregar a favoritos" id="<?php echo $v["nid"] ?>" class="icn-pin imx-mark-pin-favorites right link mr10 imx_mark" data-mark-nid="<?php echo $v["nid"] ?>" data-mark-status="0" data-mark-type="1"></span>
                                <?php else: ?>
                                    <span title="Agregar a favoritos" id="<?php echo $v["nid"] ?>" class="icn-pin no-sesion right link mr10" data-mark-nid="<?php echo $v["nid"] ?>" data-mark-status="0" data-mark-type="1"></span>
                                <?php endif; ?>
                            </div>
                            <a href="<?php echo url('node/' . $v["nid"], array('absolute' => true)) ?>">
                                <img itemprop="image" src="<?php print ($images) ? $images : "http://placehold.it/440x250"  ?>" alt="<?php echo $v["title"] ?>" />
                            </a>
                            <div class="nodesList-ranking  <?php echo ($ocio == 305787) ? "bg-ocio-calle-o" : "bg-ocio-sillon-o" ?>">
                                <span class="stars-<?php echo ($votos) ? $votos : "0" ?>"></span>
                            </div>
                        </div>
                        <div itemprop="keywords" class="N16b4 mt5">
                            <?php if ($categoria[0]): ?>
                                <a href="<?php echo $categoria[0]["path"] ?>" class="N16b4"><?php echo strtolower($categoria[0]["name"]) ?></a>
                            <?php endif; ?>
                            <?php foreach ($v["categoria_secundaria"] as $t): ?>
                                <?php if ($t["name"]): ?>
                                    |<a href="<?php echo $t["path"] ?>" class="N16b4"><?php echo strtolower($t["name"]) ?></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <h1 itemprop="headline" class="mtb10">
                            <a href="<?php print url('node/' . $v["nid"], array('absolute' => true)) ?>" class="O25r0"><?php echo $v["title"] ?></a>
                        </h1>
                        <p itemprop="description" class="N18r0 lh22"><?php print $v["body"] ?></p>
                    </article>
                </li>
            <?php endforeach; ?>          
            </ul>
            <div class="clear"></div>
        </section>
 <script type="text/IMxInfiniteScroll" id="wrapper-infinite-scrollTax" style="display:none;" offset="33" category="<?php echo $items["tid"]?>">
 <li id="infiniteAds_banner" class="col-3 bsbb pl10 mt30 tacenter pr5 mb20 left"></li>
    {{#ifC3 this.0.url "&&" this.0.title "&&" this.0.images.principal.0.styles.large.url }}
        <li class="col-3 bsbb pl10 mt30 pr5 mb20 left">
            <article itemscope itemtype="http://schema.org/NewsArticle">
                <div class="nodesList-img prelative pt10">
                    <div class="nodesList-tools bg-ocio-calle">
                        <div class="nodesList-section pleca-ocio-calle-s"></div>
                        <?php if ($user->uid): ?>
                            <span title="Agregar a favoritos" id="{{ this.0.id }}" class="icn-pin imx-mark-pin-favorites right link mr10 imx_mark" data-mark-nid="{{ this.0.id }}" data-mark-status="0" data-mark-type="1"></span>
                            <?php else:?>
                            <span title="Agregar a favoritos" id="{{ this.0.id }}" class="icn-pin no-sesion right link mr10" data-mark-nid="{{ this.0.id }}" data-mark-status="0" data-mark-type="1"></span>
                        <?php endif;?>
                        <!--<span title="Agregar a favoritos" id="{{ this.0.id }}" class="icn-pin imx-mark-pin-favorites right link mr10 imx_mark"></span>-->
                    </div>
                    <a href="{{ this.0.url }}">
                        <img itemprop="image" src="{{ this.0.images.principal.0.styles.large.url }}" alt="{{ this.0.title }}" />
                    </a>
                    <div class="nodesList-ranking bg-ocio-calle-o">
                        <span class="stars-1"></span>
                    </div>
                </div>
                <div itemprop="keywords" class="N16b4 mt5">
                    <a href="{{ this.0.taxonomy.0.url }}" class="N16b4">{{ this.0.taxonomy.0.name }}</a>
                </div>
                <h1 itemprop="headline" class="mtb10">
                    <a href="{{ this.0.url }}" class="O25r0">{{ this.0.title }}</a>
                </h1>
                <p itemprop="description" class="N18r0 lh22">{{ this.0.summary }}</p>
            </article>
        </li>
    {{/ifC3}}
    {{#ifC3 this.1.url "&&" this.1.title "&&" this.1.images.principal.0.styles.large.url }}
        <li class="col-3 bsbb pl10 mt30 pr5 mb20 left">
            <article itemscope itemtype="http://schema.org/NewsArticle">
                <div class="nodesList-img prelative pt10">
                    <div class="nodesList-tools bg-ocio-calle">
                        <div class="nodesList-section pleca-ocio-calle-s"></div>
                        <?php if ($user->uid): ?>
                            <span title="Agregar a favoritos" id="{{ this.1.id }}" class="icn-pin imx-mark-pin-favorites right link mr10 imx_mark" data-mark-nid="{{ this.1.id }}" data-mark-status="0" data-mark-type="1"></span>
                            <?php else:?>
                            <span title="Agregar a favoritos" id="{{ this.1.id }}" class="icn-pin no-sesion right link mr10" data-mark-nid="{{ this.1.id }}" data-mark-status="0" data-mark-type="1"></span>
                        <?php endif;?>
                        <!--<span title="Agregar a favoritos" id="{{ this.1.id }}" class="icn-pin imx-mark-pin-favorites right link mr10 imx_mark"></span>-->
                    </div>
                    <a href="{{ this.1.url }}">
                        <img itemprop="image" src="{{ this.1.images.principal.0.styles.large.url }}" alt="{{ this.1.title }}" />
                    </a>
                    <div class="nodesList-ranking bg-ocio-calle-o">
                        <span class="stars-1"></span>
                    </div>
                </div>
                <div itemprop="keywords" class="N16b4 mt5">
                    <a href="{{ this.1.taxonomy.0.url }}" class="N16b4">{{ this.1.taxonomy.0.name }}</a>
                </div>
                <h1 itemprop="headline" class="mtb10">
                    <a href="{{ this.1.url }}" class="O25r0">{{ this.1.title }}</a>
                </h1>
                <p itemprop="description" class="N18r0 lh22">{{ this.1.summary }}</p>
            </article>
        </li>
    {{/ifC3}}
    {{#ifC3 this.2.url "&&" this.2.title "&&" this.2.images.principal.0.styles.large.url }}
        <li class="col-3 bsbb pl10 mt30 pr5 mb20 left">
            <article itemscope itemtype="http://schema.org/NewsArticle">
                <div class="nodesList-img prelative pt10">
                    <div class="nodesList-tools bg-ocio-calle">
                        <div class="nodesList-section pleca-ocio-calle-s"></div>
                        <?php if ($user->uid): ?>
                            <span title="Agregar a favoritos" id="{{ this.2.id }}" class="icn-pin imx-mark-pin-favorites right link mr10 imx_mark" data-mark-nid="{{ this.2.id }}" data-mark-status="0" data-mark-type="1"></span>
                            <?php else:?>
                            <span title="Agregar a favoritos" id="{{ this.2.id }}" class="icn-pin no-sesion right link mr10" data-mark-nid="{{ this.2.id }}" data-mark-status="0" data-mark-type="1"></span>
                        <?php endif;?>
                        <!--<span title="Agregar a favoritos" id="{{ this.2.id }}" class="icn-pin imx-mark-pin-favorites right link mr10 imx_mark"></span>-->
                    </div>
                    <a href="{{ this.2.url }}">
                        <img itemprop="image" src="{{ this.2.images.principal.0.styles.large.url }}" alt="{{ this.2.title }}" />
                    </a>
                    <div class="nodesList-ranking bg-ocio-calle-o">
                        <span class="stars-1"></span>
                    </div>
                </div>
                <div itemprop="keywords" class="N16b4 mt5">
                    <a href="{{ this.2.taxonomy.0.url }}" class="N16b4">{{ this.2.taxonomy.0.name }}</a>
                </div>
                <h1 itemprop="headline" class="mtb10">
                    <a href="{{ this.2.url }}" class="O25r0">{{ this.2.title }}</a>
                </h1>
                <p itemprop="description" class="N18r0 lh22">{{ this.2.summary }}</p>
            </article>
        </li>
    {{/ifC3}}
    {{#ifC3 this.3.url "&&" this.3.title "&&" this.3.images.principal.0.styles.large.url }}
        <li class="col-3 bsbb pl10 mt30 pr5 mb20 left">
            <article itemscope itemtype="http://schema.org/NewsArticle">
                <div class="nodesList-img prelative pt10">
                    <div class="nodesList-tools bg-ocio-calle">
                        <div class="nodesList-section pleca-ocio-calle-s"></div>
                        <?php if ($user->uid): ?>
                            <span title="Agregar a favoritos" id="{{ this.3.id }}" class="icn-pin imx-mark-pin-favorites right link mr10 imx_mark" data-mark-nid="{{ this.3.id }}" data-mark-status="0" data-mark-type="1"></span>
                            <?php else:?>
                            <span title="Agregar a favoritos" id="{{ this.3.id }}" class="icn-pin no-sesion right link mr10" data-mark-nid="{{ this.3.id }}" data-mark-status="0" data-mark-type="1"></span>
                        <?php endif;?>
                        <!--<span title="Agregar a favoritos" id="{{ this.3.id }}" class="icn-pin imx-mark-pin-favorites right link mr10 imx_mark"></span>-->
                    </div>
                    <a href="{{ this.3.url }}">
                        <img itemprop="image" src="{{ this.3.images.principal.0.styles.large.url }}" alt="{{ this.3.title }}" />
                    </a>
                    <div class="nodesList-ranking bg-ocio-calle-o">
                        <span class="stars-1"></span>
                    </div>
                </div>
                <div itemprop="keywords" class="N16b4 mt5">
                    <a href="{{ this.3.taxonomy.0.url }}" class="N16b4">{{ this.3.taxonomy.0.name }}</a>
                </div>
                <h1 itemprop="headline" class="mtb10">
                    <a href="{{ this.3.url }}" class="O25r0">{{ this.3.title }}</a>
                </h1>
                <p itemprop="description" class="N18r0 lh22">{{ this.3.summary }}</p>
            </article>
        </li>
    {{/ifC3}}
    {{#ifC3 this.4.url "&&" this.4.title "&&" this.4.images.principal.0.styles.large.url }}
        <li class="col-3 bsbb pl10 mt30 pr5 mb20 left">
            <article itemscope itemtype="http://schema.org/NewsArticle">
                <div class="nodesList-img prelative pt10">
                    <div class="nodesList-tools bg-ocio-calle">
                        <div class="nodesList-section pleca-ocio-calle-s"></div>
                        <?php if ($user->uid): ?>
                            <span title="Agregar a favoritos" id="{{ this.4.id }}" class="icn-pin imx-mark-pin-favorites right link mr10 imx_mark" data-mark-nid="{{ this.4.id }}" data-mark-status="0" data-mark-type="1"></span>
                            <?php else:?>
                            <span title="Agregar a favoritos" id="{{ this.4.id }}" class="icn-pin no-sesion right link mr10" data-mark-nid="{{ this.4.id }}" data-mark-status="0" data-mark-type="1"></span>
                        <?php endif;?>
                        <!--<span title="Agregar a favoritos" id="{{ this.4.id }}" class="icn-pin imx-mark-pin-favorites right link mr10 imx_mark"></span>-->
                    </div>
                    <a href="{{ this.4.url }}">
                        <img itemprop="image" src="{{ this.4.images.principal.0.styles.large.url }}" alt="{{ this.4.title }}" />
                    </a>
                    <div class="nodesList-ranking bg-ocio-calle-o">
                        <span class="stars-1"></span>
                    </div>
                </div>
                <div itemprop="keywords" class="N16b4 mt5">
                    <a href="{{ this.4.taxonomy.0.url }}" class="N16b4">{{ this.4.taxonomy.0.name }}</a>
                </div>
                <h1 itemprop="headline" class="mtb10">
                    <a href="{{ this.4.url }}" class="O25r0">{{ this.4.title }}</a>
                </h1>
                <p itemprop="description" class="N18r0 lh22">{{ this.4.summary }}</p>
            </article>
        </li>
    {{/ifC3}}
    </script>
    <img class="image-loading" src="/sites/all/themes/garuyod7/images/loading.gif">
    <p id="ver-mas-ocio" class="O40l1 btn-vermas centered mt20 mb20" data-ocio="<?php echo  ($items["ocio"]==305787)? "ocio/para-la-calle":"ocio/para-el-sillon" ?>" data-tid="<?php echo $items["tid"]?>" data-offset="<?php echo count($items["nodes"]) ?>"><span>VER MÁS</span></p>
<?php endif; ?>
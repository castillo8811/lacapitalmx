<?php $items = $variables['items'];?>
<section id="footerGen">
    <div class="footerContent limited tacenter">
        <div id="logoFooter" class="centered ptb20 child_vert">
            <a href="/" title="Página de inicio">
                <img src="/<?php echo drupal_get_path("theme","garuyod7")?>/images/logo_garuyo_v2.png" alt="logo Garuyo">
            </a>
        </div>
        <div class="sections-footer centered mb30 child_vert">
            <a href="/<?php echo drupal_get_path_alias("taxonomy/term/305787")?>" class="pleca-ocio-calle mlr10"></a>
            <a href="/<?php echo drupal_get_path_alias("taxonomy/term/305788")?>" class="pleca-ocio-sillon mlr10"></a>
        </div>
        <ul>
            <?php foreach ($items as $p): ?>
                <?php // print_r($p);exit;?>
                <?php
                switch ($p["category"]["path"]) {
                    case "taxonomy/term/100":
                        $clase = "circle-music";
                        break;
                    case "taxonomy/term/279":
                        $clase = "circle-childs";
                        break;
                    case "taxonomy/term/251":
                        $clase = "circle-movies";
                        break;
                    case "taxonomy/term/60":
                        $clase = "circle-home";
                        break;
                    case "taxonomy/term/1":
                        $clase = "circle-food";
                        break;
                    case "taxonomy/term/372":
                        $clase = "circle-museum";
                        break;
                    case "taxonomy/term/46":
                        $clase = "circle-night";
                        break;
                    case "taxonomy/term/275":
                        $clase = "circle-television";
                        break;
                }
                ?>
                <li class="col-4 bsbb left taleft mb30 mt30">
                    <div class="tacenter mb20">
                        <a class="<?php echo $clase?> mb10 iconsFooter child_vert" href="<?php echo url($p["category"]["path"]) ?>"></a>
                        <a href="<?php echo url($p["category"]["path"]) ?>">
                        <h3 itemprop="category" class="O24b2 child_vert"><?php echo $p["category"]["title"]?></h3>
                        </a>
                        <?php if(count($p["submenus"])):?>
                            <span class="footer-icn-plus"></span>
                        <?php endif;?>
                    </div>
                    <ul class="listainvisible">
                        <li><a href="<?php echo url($p["category"]["path"])?>" class="N16r1 hoverY transitionColor">Todos</a></li>
                        <?php if(array_key_exists("submenus",$p)):?>
                            <?php foreach($p["submenus"] as $idx=> $s):?>
                                <li><a href="<?php echo url($s["path"])?>" class="N16r1 hoverY transitionColor"><?php echo $s["title"]?></a></li>
                                <?php if($idx==2){break;}?>
                            <?php endforeach;?>                                                           
                        <?php endif;?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

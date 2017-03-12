<?php // print_r($variables);exit; ?>
<?php $items = $variables['items']; ?>
<div class="topContent prelative">
    <span id="menuiFixed-openmenu" class="do-show-menu link transitionPosition" style="display: none;"></span>
    <section class="headerHome limited">
        <div id="logo" class="centered ptb10">
            <a href="/" title="Página de inicio">
                <img src="<?php echo drupal_get_path("theme", "garuyod7") ?>/images/logo_garuyo_v1.png" alt="logo Garuyo">
            </a>
        </div>
        <div class="sections-top centered">
            <a href="<?php echo url($items["ocio"][1]["path"]) ?>" class="pleca-ocio-calle mlr5"></a>
            <a href="<?php echo url($items["ocio"][0]["path"]) ?>" class="pleca-ocio-sillon mlr5"></a>
        </div>
        <div id="searchBox" class="centered mt10 mb10">
            <div id="block-search-form" class="block block-search contextual-links-region first odd" role="search" style="display: block;">
                <div class="block-inner clearfix">
                    <div>
                        <?php print render($items["busqueda"]) ?>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <nav id="mainMenu" style="text-transform:uppercase ">
            <ul>
                <?php foreach ($items["principales"] as $p): ?>

                    <?php
                    switch ($p["path"]) {
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
                    <li class="col-8 left">
                        <a href="<?php echo url($p["path"]) ?>" class="O17r1 lh30">
                            <span class="<?php echo $clase ?>"></span>
                            <span class="dblock"><?php echo strtoupper($p["title"]) ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="clear"></div>
        </nav>
    </section>
    <div class="loadProgress">
        <div class="pace  pace-inactive">
            <div class="pace-progress" data-progress-text="100%" data-progress="99" style="-webkit-transform: translate3d(100%, 0px, 0px); transform: translate3d(100%, 0px, 0px);">
                <div class="pace-progress-inner"></div>
            </div>
            <div class="pace-activity"></div>
        </div>
    </div>
</div>


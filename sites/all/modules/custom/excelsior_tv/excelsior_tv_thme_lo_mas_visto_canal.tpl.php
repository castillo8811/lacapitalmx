<?php
$canales = $variables["excelsior_tv_thme_lo_mas_visto_canales"];
$relacionados = $variables["excelsior_tv_thme_lo_mas_visto_relacionados"];
?>
<div>
    <div class="imx-multimedia-content">
        <?php
        $videos = array_asc_peso($relacionados['data'], 'peso');
        $videos_1 = array_slice($videos, 5, 14);
        ?>
        <div class="imx-multimedia-listado-wrapper imx-mm-listado-los-mas-vistos">
            <div class="imx-multimedia-listado">
                <ul>
                    <li>
                        <span class="dblock imx-multimedia-section left"></span>
                    </li>
                    <?php unset($videos_1[count($videos_1) - 1]); ?>
                    <?php foreach ($videos_1 as $k => $valor): ?>
                        <li class="<?php print $k==2||$k==5||$k==8||$k==11||$k==14 ? 'clear' : '' ?>">
                            <a href="/<?php print URL_ALIAS_CANAL . '/' . $valor['vid'] ?>" class="imx-multimedis-items"> 
                                <span class="dblock prelative">
                                    <span class="icn-video-small"></span>
                                    <img src="<?php print $valor['images']['mqdefault'] ?>" width="260">
                                </span>
                                <span class="dblock imx-multimedia-video-titulo P13i0"><?php print $valor['title'] ?></span>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
        <?php foreach ($canales as $key => $value): ?>
            <?php if (count($value['videos']) > 0): ?>
                <div class="imx-multimedia-listado-wrapper clear imx-mm-listad-<?php print $key?> imx-mm-listado-<?php print str_replace(' ', '-', $value['name'])?>">
                    <div class="imx-multimedia-listado">
                        <ul>
                            <li>
                                <span class="dblock imx-multimedia-section-gen P28r0"><?php echo $value['name']; ?></span>
                            </li>
                            <?php foreach ($value['videos'] as $k => $valor): ?>
                                <li class="<?php print $k==2||$k==5||$k==8||$k==11||$k==14 ? 'clear' : '' ?>">
                                    <a href="/<?php print URL_ALIAS_CANAL . '/' . $valor['id'] ?>" class="imx-multimedis-items" >
                                        <span class="dblock prelative">
                                            <span class="icn-video-small"></span>
                                            <img src="http://i1.ytimg.com/vi/<?php echo $valor['id'] ?>/mqdefault.jpg" width="260">
                                        </span>
                                        <span class="dblock imx-multimedia-video-titulo P13i0"><?php print $valor['title'] ?></span>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <div class="imx-videogaleria-ver-mas">
                        <a class="right btn-ver-mas-e45-content P20i7" target="_blank" href="<?php echo $value['url_lista'] ?>">VER MÁS</a> 
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
</div>
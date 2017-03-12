<?php $node_mark=menu_get_object("node");?>
<?php
$url = url('node/' . $items['nid'], array('absolute' => true));
$text = urlencode('Mira, estoy leyendo "' . $items['title'] . '" en ' . $url );
?>
<div class="nodeSocials tacenter">
    <ul>
        <li class="diblock">
            <a class="btn-whats" href="whatsapp://send?text=<?php print str_replace("+", " ", $text); ?>">
                <span class="share-whatsapp"></span>
            </a>
        </li>
        <li class="diblock">           
            <a class="addthis_button_facebook btn-fb" addthis:url="<?php echo $url?>" addthis:title="<?php echo $items['title']?>">
                <span></span>
            </a>
        </li>
        <li class="diblock">
            <a class="addthis_button_twitter btn-tw" addthis:url="<?php echo $url?>" addthis:title="<?php echo $items['title']?>">
                <span></span>
            </a>
        </li>
        <li class="diblock">
            <a class="addthis_button_google_plusone_share btn-gp" addthis:url="<?php echo $url?>" addthis:title="<?php echo $items['title']?>">
                <span></span>
            </a>
        </li>
        <?php if($user->uid):?>
        <li class="diblock" ><span class="btn-favoritos imx-mark-pin-favorites imx_mark link" data-mark-nid="<?php echo $node_mark->nid ?>" data-mark-status="0" data-mark-type="1"></span></li>
        <?php else:?>
        <li class="diblock" ><span class="btn-favoritos no-sesion link" data-mark-nid="<?php echo $node_mark->nid ?>" data-mark-status="0" data-mark-type="1"></span></li>
        <?php endif;?>
        <li class="diblock"><a href="#comenta" class="btn-comenta"></a></li>
        <!--<li class="diblock"><span class="btn-alerta link"></span></li>-->
    </ul>
    <div class="clear"></div>
</div>
<?php if(is_numeric(arg(1))){$count_node=  db_select("imx_mark","m")->condition("nid",  arg(1),"=")->countQuery()->execute()->fetchField();}?>
<div id="share-wrapper" class="hidden">
   <ul>
        <li class="">
            <a class="addthis_button_facebook_share" fb:like:layout="box_count"></a>
        </li>
        <li class="">
            <a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>
        </li>
        <li class="">
            <a class="addthis_button_tweet" tw:count="vertical" tw:via="migaruyo"></a>
        </li>
        <li class="">
            <a class="addthis_button_google_plusone" g:plusone:size="tall"></a>
        </li>
        <li class="">
            <div class="btn-custom-wrapper prelative link">
                <span class="counter A15r0 comments-fb-count">0</span>
                <span class="btn btn-comenta-s"></span>
            </div>
        </li>
        <li class="">
            <div class="btn-custom-wrapper prelative link">
                <span class="counter A15r0"><?php echo ($count_node)? $count_node : "0" ?></span>
                <?php if($user->uid):?>
                <span class="btn btn-favoritos-s imx_mark" data-mark-nid="<?php echo arg(1) ?>" data-mark-status="0" data-mark-type="1"></span>
                <?php else :?>
                <span class="btn btn-favoritos-s no-sesion" data-mark-nid="<?php echo arg(1) ?>" data-mark-status="0" data-mark-type="1"></span>
                <?php endif;?>
            </div>
        </li>
<!--        <li class="">
            <div class="btn-custom-wrapper prelative link">
                <span class="counter A15r0">0</span>
                <span class="btn btn-alerta-s"></span>
            </div>
        </li>-->
    </ul>
</div>
<?php drupal_add_js(drupal_get_path("module","imx_shareslateral")."/imx_shareslateral.js")?>
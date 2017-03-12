
<?php
$serie = $taxonomy;
$ytchannel = $taxonomy["ytchannel"];
$img_logo = $taxonomy["image_logo_url"];
?>
<div class="nodeAuthor ptb20 mb20" itemscope itemtype="http://schema.org/Person">
    <div class="left cuad-2">
        <img itemprop="image" src="<?php echo $img_logo ?>" alt="<?php echo $serie["name"] ?>" />
    </div>
    <div class="right cuad-10 bsbb">
        <h4 itemprop="name"><a itemprop="/<?php echo $serie["url"] ?>" class="N16r4"><?php echo $serie["name"] ?></a></h4>
        <p itemprop="description" class="N14r0 mtb10"><?php echo $serie["description"] ?></p>
        <div class="nodeAuthorSocial mt20">
            <ul>
                <li class="col-6 left bsbb">
                    <a class="addthis_button_facebook_share" fb:share:layout="button_count"></a>
                </li>
                <li class="col-6 left bsbb">
                    <a class="addthis_button_tweet" tw:via="migaruyo"></a>
                </li>
                <li class="col-6 left bsbb">
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                </li>
                <li class="col-6 left bsbb">
                <script src="https://apis.google.com/js/platform.js"></script>
                <?php if (preg_match('/^UC/i', $ytchannel)): ?>
                    <div class="g-ytsubscribe" data-channelid="<?php echo $ytchannel ?>" data-layout="default" data-count="undefined"></div>
                <?php else: ?>
                    <div class="g-ytsubscribe" data-channel="<?php echo $ytchannel ?>" data-layout="default" data-count="undefined"></div>
                <?php endif ?>
                    </li>
            </ul>
        </div>
    </div>
    <div class="clear"></div>
</div>
<section class="SeriesWrapper seriesCasa mt20 mb20 clear">
    <ul>
        <?php foreach ($data as $key => $value): ?>
            <?php // print_r($value);exit;?>
            <li class="col-2 left plr20 mb30 bsbb">
                <article class="serie-item tacenter" itemscope itemtype="http://schema.org/NewsArticle">
                    <a class="dblock prelative" href="/<?php echo $value["url"] ?>">
                        <span class="icn-play"></span>
                        <img itemprop="image" src="<?php echo ($value["youtube_id"]) ? "http://img.youtube.com/vi/" . $value["youtube_id"] . "/mqdefault.jpg" : "http://placehold.it/400x200" ?>" width="400" height="200" alt="Nombre serie" />
                    </a>
                    <h2 itemprop="headline" class="N16b0 mt10 lh22"><?php echo ($value["title"])? : "" ?></h2>
                </article>
            </li>
        <?php endforeach ?>
    </ul>
    <div class="clear"></div>
    <a href="#" class="O40l1 btn-vermas centered mt20 mb20"><span>VER MÁS</span></a>
</section>

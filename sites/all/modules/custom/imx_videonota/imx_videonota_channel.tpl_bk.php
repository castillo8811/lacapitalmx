<section class="imx-serie-header">
    <div class="imx-header-logo">
        <a href="/<?php echo $taxonomy['url'] ?>"> <p><?php echo $taxonomy['name'] ?></p></a>
    </div>
    <div class="imx-header-descripcion">
        <a href="/<?php echo $taxonomy['url'] ?>"> <?php echo $taxonomy['description']; ?> </a>
    </div>
</section>
<?php ?>
<section class="imx-wrapper-video-channel">
    <div class="imx-banner-channel">
        <a href="/<?php echo $taxonomy['url']; ?>">
            <img  src="<?php echo $taxonomy['image_channel_url']; ?>" alt="<?php echo strip_tags($taxonomy['image_channel_alt']); ?>">
        </a>
        <?php if (isset($taxonomy['ytchannel'])): ?>
            <script src="https://apis.google.com/js/platform.js"></script>
            <?php if (preg_match('/^UC/i', $taxonomy['ytchannel'])): ?>
                <div class="g-ytsubscribe" data-channelid="<?php echo $taxonomy['ytchannel'] ?>" data-layout="default" data-count="undefined"></div>
            <?php else: ?>
                <div class="g-ytsubscribe" data-channel="<?php echo $taxonomy['ytchannel'] ?>" data-layout="default" data-count="undefined"></div>
            <?php endif ?>
        <?php endif ?>
    </div>
    <ul id="imx-videonota-list-channel">
        <?php foreach ($data as $key => $value): ?>
            <?php print_r($data);
            exit; ?>
    <?php if ($key == 0): ?>
                <li>
                    <article class="imx-wrapper-reproductor-channel">
                        <a href="/<?php echo $value['url']; ?>">
                            <figure>
                                <?php if (isset($value['image_youtube'])): ?>
                                    <img width="100%" height="100%" src="<?php echo $value['image_youtube']; ?>" alt="<?php #echo $value['alt'] ?>">
                                <?php else: ?>
                                    <img width="100%" height="100%" src="<?php echo $value['image_uri']; ?>" alt="<?php #echo $value['alt'] ?>">
        <?php endif ?>
                                <span class= "dblock imx-plek-multimedia-video-channel"></span>
                            </figure>
                            <h2 class="imx-title-reproductor-channel"><?php echo $value['title']; ?></h2>
                        </a>
                    </article>
                </li>
    <?php else: ?>
                <li>
                    <a href="/<?php echo $value['url']; ?>">
                        <article class="imx-list-wrapper-video">
                            <figure>
                                <?php if (isset($value['image_youtube'])): ?>
                                    <img width="100%" height="160" src="<?php echo $value['image_youtube']; ?>"  alt="" >
                                <?php else: ?>
                                    <img width="100%" height="160" src="<?php echo $value['image_uri']; ?>"  alt="" >
        <?php endif ?>
                                <span class="dblock imx-plek-multimedia-chanel-list"></span>
                            </figure>
                            <h2  class="imx-title-channel-list-video"><?php echo $value['title']; ?></h2>
                        </article>
                    </a>
                </li>
            <?php endif ?>
<?php endforeach ?>
    </ul>
    <div class="imx-btn-ver-mas-home">
        <a class="btn-ver-mas-home-content dblock" href="/<?php echo $taxonomy['url']; ?>?page=2">
            <span class="dblock sprite-new-home left cuadrado-azul-home-mas"></span>
        </a>
    </div>
</section>

<section class="SeriesWrapper seriesCasa mt20 mb20 clear">

    <ul>
<?php foreach ($data as $key => $value): ?>
            <li class="col-2 left plr20 mb30 bsbb">
                <article class="serie-item tacenter" itemscope itemtype="http://schema.org/NewsArticle">
                    <a class="dblock prelative" href="#">
                        <span class="icn-play"></span>
                        <img itemprop="image" src="<?php echo ($value["image_youtube"])? $value["image_youtube"] : "http://placehold.it/400x200"?>" width="400" height="200" alt="Nombre serie" />
                    </a>
                    <h2 itemprop="headline" class="N16b0 mt10 lh22"><?php echo ($value["title"])? : ""?></h2>
                </article>
            </li>
<?php endforeach ?>
    </ul>
    <div class="clear"></div>
    <a href="#" class="O40l1 btn-vermas centered mt20 mb20"><span>VER MÁS</span></a>
</section>

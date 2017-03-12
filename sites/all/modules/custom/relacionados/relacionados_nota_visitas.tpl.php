<section id="masleido">
    <h1 class="U34r0 tacenter mt30 mb20">LO MÁS LEÍDO DE LA SEMANA</h1>
    <ul>
        <?php foreach ($data as $x => $item): ?>
            <?php if($x==4):?>
                <li class="col-3 bsbb pl10 pr10 mb20 left">
                    <div class="boxHome tacenter pal10 mbb20 ">
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- CAPMX 1 -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-3878010380895666"
                             data-ad-slot="1824526039"
                             data-ad-format="rectangle"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </li>
                <?php continue;?>
            <?php endif;?>
            <?php $uri = $item['image_uri']; ?>
                <li class="col-3 bsbb pl10 pr10 mb20 left">
                <article itemscope itemtype="http://schema.org/NewsArticle">
                    <div class="nodesList-img prelative">
                        <a href="<?php print $item["url"]?>">
                            <?php if($item['type'] == 'gallerie' || $item['type'] == 'video'):?>
                                <span class="icn-<?php echo $item['type']?> paC"></span>
                            <?php endif;?>
                            <img class="img-fluid" width="440" height="250" itemprop="image" src="<?php print image_style_url('home_y_canales', $uri)?>" alt="<?php print $item["title"]?>" />
                        </a>
                    </div>
                    <h1 itemprop="headline" class="mtb10">
                        <a href="<?php print $item["url"]?>" class="O25r0"><?php print $item["title"]?></a>
                    </h1>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
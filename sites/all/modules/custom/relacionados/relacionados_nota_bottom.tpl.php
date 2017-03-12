<section id="relacionadoBottom">
    <h1 class="U30r0 tacenter mt30">QUIENES LEYERON ESTA NOTA TAMBIÉN LEYERON</h1>
    <ul>
        <?php foreach ($data['items'] as $x => $item): ?>
            <?php $uri = $item['image_uri']; ?>
            <li class="col-3 bsbb pl10 mt30 pr10 mb20 left">
                <article itemscope itemtype="http://schema.org/NewsArticle">
                    <div class="nodesList-img prelative pt10">
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
        <li class="clear"></li>
    </ul>
</section>


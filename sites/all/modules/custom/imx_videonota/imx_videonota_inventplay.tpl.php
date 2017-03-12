<div>
    <section class="SeriesWrapper series-inventPlay clear">
        <div class="seriesTitle prelative tacenter mb20">
            <span class="seriesLine"></span>
            <span class="pleca-SeriesInvent-b"></span>
        </div>
        <ul>
            <?php foreach ($series as $key=>$value):?>
            <li class="col-2 left plr20 mb30 bsbb">
                <article class="serie-item" itemscope="" itemtype="http://schema.org/NewsArticle">
                    <a href="/<?php echo $value["url"] ?>">
                        <img itemprop="image" src="<?php echo ($value['image_list_url'])?  $value['image_list_url'] : "http://placehold.it/400x200"?>" width="400" height="200" alt="<?php echo ($value["name"])? $value["name"] :""?>">
                    </a>
                    <h2 itemprop="headline" class="N18r0 mt10 lh22"><?php echo ($value["description"])? $value["description"] :""?></h2>
                </article>
            </li>
            <?php endforeach;?>
        </ul>
        <div class="clear"></div>
        <a href="/videos" class="O40l1 btn-vermas centered mt20 mb20" target="_blank"><span>VER MÁS</span></a>
    </section>
</div>
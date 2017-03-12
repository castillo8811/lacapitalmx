<div class="imx-users-dinero">

    <?php if (intval($total_traffic)): ?>
        <div class="imx-users-line">
            <table id="imx-users-traffic-table">
                <tr id="imx-users-traffic-rows">
                    <td id="imx-user-title">Datos generales</td>
                    <td class="imx-table-cell"><span>Visto <?php echo $total_traffic['totalUniqueUsers'] ?></span></td>
                    <td class="imx-table-cell"><span>Pageviews <?php echo $total_traffic['totalEvents'] ?></span></td>
                    <td class="imx-table-cell"><span>Tiempo promedio <?php echo conversorSegundosHoras($total_traffic['averageActiveTime']) ?></span></td>
                </tr>
            </table>
        </div>
    <?php endif ?>
    <ul id="imx-users-item">
        <?php foreach ($data as $key => $value): ?>
            <li class="pb30 bsbb pl10 bb1 mb30">
                <article itemscope itemtype="http://schema.org/NewsArticle" class="ml30 bsbb">
                    <div class="cuad-3 left bsbb imx-users-image pr10">
                        <img class="img-fluid" src="<?php echo image_style_url('medium',$value['image']) ?>" />
                    </div>
                    <div class="cuad-9 left bsbb imx-users-info pl10">
                        <h1 itemprop="headline" class="mb10"><a class="O40r0 lh50" href="/<?php echo $value['url'] ?>"><?php echo $value['title'] ?></a></h1>
                        <p class="O18l6 lh24 mb10">
                            <?php echo $value['summary'] ?>
                        </p>
                    </div>
                    <div class="clear"></div>
                    <div class="sipiSocial mt10 pall5">
                        <span class="O21r0 pl10 ml30">Comparte con tus amigos:</span>
                        <ul class="right">
                            <li class="diblock mr10">
                                <div class="fb-like" data-href="<?php print $value['social_url'] ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                            </li>
                            <li class="diblock mr10">
                                <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php print $value['social_url'] ?>" data-text="<?php echo $value['title'] ?>" data-via="<?php echo $value['twitter_via'] ?>">Tweet</a>
                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                            </li>
                            <li class="diblock mr10">
                                <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
                                <div class="g-plusone" data-href="<?php print $value['social_url'] ?>" data-size="small" data-annotation="bubble"></div>
                            </li>
                        </ul>
                    </div>
                    <?php if (isset($value['traffic']['data']['activeTime'])): ?>
                        <div class="imx-users-metrica-content">
                            <spam class="imx-metrica-view">
                                <span class="imx-text-view">Visto: <span class="imx-tex-pik-gre"></span></span>
                                <span class="imx-time-text"><?php echo $value['traffic']['data']['uniqueUsers'] ?></span>
                            </spam>
                            <spam class="imx-full-time">
                                <span class="imx-text-view">Tiempo promedio:<span class="imx-tex-pik-gre"></span></span> 
                                <span class="imx-time-text"><?php echo conversorSegundosHoras($value['traffic']['data']['activeTime']) ?></span>
                            </spam>
                        </div>
                    <?php endif ?>
                    <div class="clear"></div>
                </article> 
            </li>
        <?php endforeach ?>
    </ul>
</div>
<!-- AddThis Smart Layers BEGIN -->
<script type="text/javascript">
    var addthis_share = addthis_share || {}
    addthis_share = {
        passthrough: {
            twitter: {
                via: "<?php echo $value['twitter_via'] ?>"
            }
        }
    }
</script>
<!-- AddThis Smart Layers END -->
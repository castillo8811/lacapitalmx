<?php
$data = $excelsior_tv_thme_videos_portada;
$is_id_video = $excelsior_tv_video['is_id_video'];
$path = $excelsior_tv_video['path'];
$titulo_videos = $excelsior_tv_video['title'];
$relateds = $excelsior_tv_video['related'];
?>
<?php if (isset($data['relacionados']['data']) && count($data['relacionados']['data']) > 0): ?>
    <div class="imx-videos-portada">
        <div class="left imx-video-content-portada">
            <div class="imx-multimedia-shares">
                <div class="imx-title-shares family-droid-serif-italic left P20i1">Síguenos en</div>
                <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style" addthis:title="<?php echo check_plain($titulo_videos); ?>" addthis:description="<?php echo check_plain($titulo_videos); ?>">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <div class="clear"></div>
                </div>
                <!-- AddThis Button END -->
                <script src="https://apis.google.com/js/platform.js"></script>
                <div class="g-ytsubscribe" data-channel="ActitudFEM" data-layout="default" data-theme="dark" data-count="undefined"></div>
            </div>
            <div class="imx-video-content-relate tacenter">
                <?php if (isset($path[1])): //datos dinamicos ?>
                    <div class="imx-titulos-video dblock family-titillium P25i1"> <?php echo $is_id_video[0]['title']; ?></div>
                    <iframe type="text/html" width="610" height="356" src="http://www.youtube.com/embed/<?php echo $is_id_video[0]['id']; ?>?rel=0&autoplay=1&fs=1" frameborder="0" allowfullscreen="0"></iframe>
                    <div class="dblock imx-multimedia-listado-related">
                        <?php foreach ($relateds as $k => $valor): ?>
                            <a href="/<?php print URL_ALIAS_CANAL . '/' . $valor['id'] ?>" class="imx-multimedis-items-related prelative">
                                <span class="icn-video-small"></span>
                                <span class="dblock imx-relacionados-videos ">
                                    <img src="http://i1.ytimg.com/vi/<?php echo $valor['id'] ?>/mqdefault.jpg " width="180">
                                    <span class="sprite-new-home dblock imx-plek-multimedia"></span>
                                </span>
                                <span class="imx-multimedia-title-relacionados family-titillium P15i0"><?php echo $valor['title'] ?></span>
                            </a>
                        <?php endforeach ?>
                    </div>
                <?php else: //datos estaticos ?>
                    <div class="imx-titulos-video dblock family-titillium P25i1"> <?php echo $data['relacionados']['data'][0]['title']; ?></div>
                    <iframe type="text/html" width="610" height="356" src="<?php echo $data['relacionados']['data'][0]['url']; ?>" frameborder="0" allowfullscreen="0"></iframe>
                    <div class="dblock imx-multimedia-listado-related">
                        <?php
                        $relacionados = count($data['relacionados']['data'][0]['relacionados']);
                        $relacionados_2 = ($relacionados > 3 ) ? array_slice($data['relacionados']['data'][0]['relacionados'], 0, 3) : $data['relacionados']['data'][0]['relacionados'];
                        ?>
                        <?php foreach ($relacionados_2 as $k => $valor): ?>	
                            <a href="/<?php print URL_ALIAS_CANAL . '/' . $k ?>" class="imx-multimedis-items-related prelative"> 
                                <span class="icn-video-small"></span>
                                <span class=" imx-relacionados-videos ">
                                    <img src="http://i1.ytimg.com/vi/<?php echo $k; ?>/mqdefault.jpg " width="180">
                                    <span class="sprite-new-home dblock imx-plek-multimedia"></span>
                                </span>
                                <span class="imx-multimedia-title-relacionados family-titillium P15i0"><?php echo $valor; ?></span>
                            </a>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>	
            </div>
            <?php $videos = array_asc_peso($data['data'], 'peso');
            $videos_2 = array_slice($videos, 0, 5); ?>
        </div>
        <div class="imx-multimedia-listado-right right">
            <ul id="imx-related-multimedia-portada">
                <?php $videos_2 = array_asc_peso($videos_2, 'peso'); ?>
                <?php foreach ($videos_2 as $j => $valor): ?>
                    <li>
                        <a href="/<?php print URL_ALIAS_CANAL . '/' . $valor['vid'] ?>" class="imx-multimedis-items-related-right"> 
                            <span class="dblock left prelative imx-thums-video-portada">
                                <span class="icn-video-small"></span>
                                <img src="<?php print $valor['images']['mqdefault'] ?>" width="130">
                                <span class="sprite-new-home dblock imx-plek-multimedia"></span>
                            </span>
                            <span class="dblock left imx-multimedia-video-titulo-portada family-titillium P15i0"><?php print $valor['title'] ?></span>
                        </a>
                        <div class="clear"></div>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
<?php endif ?>
<script type="text/javascript">
    var addthis_share = addthis_share || {}
    addthis_share = {
        passthrough: {
            twitter: {
                via: "actitudfem"
            }
        }
    };
//    function getUrlVars() { 
//            var vars = [], hash; 
//            var hashes = window.location.href.slice(window.location.href.indexOf('.') + 2).split('/');
//             for(var i = 0; i < hashes.length; i++) { 
//                    hash = hashes[i].split('/');
//                vars.push(hash[0]); 
//                vars[hash[0]] = hash[1]; 
//             } return vars[1]; 
//    } 
//    jQuery(document).ready(function(){
//        var url = getUrlVars();
//        if(url){
//            if(url == 'multimedia'){
//                var participante = jQuery('#block-system-main-menu .menu-wrapper .menu li.last.leaf a');
//                if(jQuery('#block-system-main-menu .menu-wrapper .menu li.last.leaf a').text()== 'Multimedia'){
//                    participante.addClass('active-trail active');
//                }
//            }
//        }
//    });
</script>
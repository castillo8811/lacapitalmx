<?php drupal_add_js(drupal_get_path('theme', 'lacapitalmx') . '/js/gallerie/galleria-1.2.9.min.js'); ?>
<?php drupal_add_js(drupal_get_path('theme', 'lacapitalmx') . '/js/gallerie/galleria.excelsior.js'); ?>
<?php drupal_add_css(drupal_get_path('theme', 'lacapitalmx') . '/css/gallerie/garuyo_videonota.classic.css'); ?>
<div class="region">
    <section id="node-VideonotaTop">
        <?php if (count($serie) > 0): ?>
        <div class="nodeVideonotaBanner">
                <div class="nodeVNBannerWrapper prelative limited">
                    <?php if (isset($ytchannel)): ?>
                        <div class="nodeButtonSubscribe">
                            <script src="https://apis.google.com/js/platform.js"></script>
                            <?php if (preg_match('/^UC/i', $ytchannel)): ?>
                                <div class="g-ytsubscribe" data-channelid="<?php echo $ytchannel ?>" data-layout="default" data-count="undefined"></div>
                            <?php else: ?>
                                <div class="g-ytsubscribe" data-channel="<?php echo $ytchannel ?>" data-layout="default" data-count="undefined"></div>
                            <?php endif ?>
                        </div>
                    <?php endif ?>

                </div>
            </div>
        <?php endif; ?>
        <div id="nodeVideonotaTop" class="limited pall10 bsbb">
            <header class="nodeHeader mb20">
                <h1 itemprop="headline" class="O45r0 lh50 mb20 tacenter"><?php echo $title ?></h1>
                <div class="A15r0 tacenter mt10 mb20"><?php echo date("d/m/y",$node->created); ?></div>
                <meta itemprop="datePublished" content="<?php print date('Y-m-d',$node->created) ?>"/>
                <meta itemprop="dateModified" content="<?php print date('Y-m-d',$node->created) ?>"/>
                <div class="nodeSocials tacenter prelative pt40 clear">
                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                    <div class="addthis_sharing_toolbox"></div>
                </div>
            </header>
            <?php if (count($gallery) == 1): ?>
                <?php
                switch ($config['player']):
                    case 'youtube':
                        ?>
                        <div class="nodeVideonotaVideo tacenter">
                            <iframe width="100%" height="500" type="text/html" src="<?php print $gallery[0]['iframe']; ?>" frameborder="0" allowfullscreen=""></iframe>
                        </div>
                        <script type="text/javascript">
                            // Add function to execute when the API is ready
                            imxYTReady(function() {
                                var frameID = getYoutubeFrameID("imx-videonota-wrapper");
                                if (frameID) { //If the frame exists
                                    imxPlayer = new YT.Player(frameID, {
                                        events: {
                                            "onStateChange": imxSendEvent
                                        }
                                    });
                                }
                            });
                        </script>
                        <?php break; ?>
                <?php endswitch ?>
            <?php elseif (count($gallery) > 1): ?>
                <?php
                $galleryObject = array();
                $titles = array();
                foreach ($gallery as $key => $value) {
                    $slide_object = null;
                    $slide_object = new stdClass();
                    if (isset($value['image'])) {
                        $slide_object->image = $value['image'];
                    }
                    if (isset($value['iframe'])) {
                        $slide_object->iframe = $value['iframe'];
                    }
                    if (isset($value['video'])) {
                        $slide_object->video = $value['video'];
                    }
                    if (isset($value['thumbnail'])) {
                        $slide_object->thumb = $value['thumbnail'];
                    }
                    $slide_object->description = $value['description'];
                    $galleryObject[] = $slide_object;
                    $titles[]['title'] = trunc($value['description'], 5);
                    unset($slide_object);
                }
                ?>
                <div class="nodeVideonotaVideo">
                    <div id="fotogaleria" style="display: none;"></div>
                </div>
                <script>
                    jQuery('#fotogaleria').css("display", "");
                    var fotogaleria_data = <?php print(json_encode($galleryObject)); ?>;

                    var fotogaleria_title = <?php print(json_encode($titles)); ?>;
                    Galleria.run('#fotogaleria', {
                        // transition: (jQuery.browser.msie &&  parseInt(jQuery.browser.version, 10) > 9)?'none':'slide',
                        // initialTransition: (jQuery.browser.msie &&  parseInt(jQuery.browser.version, 10) > 9)?'none':'fade',
                        show: (/^#imagen-(\d{1,})/.test(location.hash)) ? (location.hash.match(/^#imagen-(\d{1,})/)[1] - 1) : 0,
                        dataSource: fotogaleria_data,
                        responsive: true,
                        wait: true,
                        _justLanded: true,
                        debug: true,
                        //                _comScoreName: get_comscore_name(),
                        _titlesList: fotogaleria_title,
                        //                dummy: '<?php // echo $config['gallerie_dummy_logo'];   ?>'
                    });
                    //            Galleria.on('image', function(e) {
                    //              // Add function to execute when the API is ready
                    //              imxYTReady(function(){
                    //                var frameID = getYoutubeFrameID("fotogaleria");
                    //                if (frameID) { //If the frame exists
                    //                  imxPlayer = new YT.Player(frameID, {
                    //                    events: {
                    //                      "onStateChange": imxSendEvent
                    //                    }
                    //                  });
                    //                }
                    //              });
                    //            });
                </script>
<?php endif; ?>
        </div>
    </section>
</div>

<?php drupal_add_js(drupal_get_path('theme', 'garuyod7') . '/js/gallerie/galleria-1.2.9.min.js'); ?>
<?php drupal_add_js(drupal_get_path('theme', 'garuyod7') . '/js/gallerie/galleria.excelsior.js'); ?>
<?php drupal_add_css(drupal_get_path('theme', 'garuyod7') . '/css/gallerie/garuyo_videonota.classic.css'); ?>

<?php // print_r($items);exit;?>
<?php
    $serie = $items["video"]["#taxonomy"];
    $ytchannel = $items["video"]["#taxonomy"]["ytchannel"];
    $gallery = $items["video"]["#data"];
//print_r($items);exit;
?>
<div class="region">
    <section id="node-VideonotaTop">
        <?php if ($serie): ?>
            <div class="nodeVideonotaBanner"  style="background: url('<?php echo $serie['image_channel_url'] ?>') repeat-x center center;">
                <div class="nodeVNBannerWrapper prelative limited">
                    <span class="pleca-SeriesCasa-s"></span>
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
                <h1 itemprop="headline" class="O45r0 lh50 mb20 tacenter"><?php echo ($gallery[0]["title"]) ? $gallery[0]["title"] : "" ?></h1>
            </header>
            <?php if ($gallery): ?>
                <div class="nodeVideonotaVideo tacenter">
                    <iframe width="85%" height="550" type="text/html" src="https://www.youtube.com/embed/<?php print $gallery[0]['youtube_id']; ?>" frameborder="0" allowfullscreen=""></iframe>
                </div>
                <script type="text/javascript">
                    // Add function to execute when the API is ready
                    imxYTReady(function () {
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
            <?php endif; ?>
        </div>
    </section>
</div>


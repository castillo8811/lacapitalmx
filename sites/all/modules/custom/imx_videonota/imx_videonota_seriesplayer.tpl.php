<?php drupal_add_js(drupal_get_path('theme', 'garuyod7') . '/js/gallerie/galleria-1.2.9.min.js'); ?>
<?php drupal_add_js(drupal_get_path('theme', 'garuyod7') . '/js/gallerie/galleria.excelsior.js'); ?>
<?php drupal_add_css(drupal_get_path('theme', 'garuyod7') . '/css/gallerie/garuyo_videonota.classic.css'); ?>

<?php // print_r($gallery);exit;?>
<div class="region">
    <section id="node-VideonotaTop">
        <?php if (count($serie) > 0): ?>
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
        <div id="nodeVideonotaTop" class="limited bsbb">
            <header class="nodeHeader mb20">
                <h1 itemprop="headline" class="O45r0 lh50 mb20 tacenter"><?php echo ($gallery[0]["description"])? $gallery[0]["description"]:"" ?></h1>
            </header>
            <?php if (count($gallery) == 1): ?>
                <?php
                switch ($config['player']):
                    case 'youtube':
                        ?>
                        <div class="nodeVideonotaVideo tacenter">
                            <iframe width="85%" height="500" type="text/html" src="<?php print $gallery[0]['iframe']; ?>" frameborder="0" allowfullscreen=""></iframe>
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
                reponsive:true,
                dummy: "<?php echo $config['gallerie_dummy_logo']; ?>"
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
        <script type="text/javascript">
        </script>
<script type="text/javascript">
  (function($){
    $(window).load(function() {
      imx_videonota_change_player_title();
       window.onhashchange = function() {
        imx_videonota_change_player_title();
      }
    });
    function imx_videonota_change_player_title() {
      $("div.galleria-thumbnails div.galleria-image").each(function(index){
        if ($(this).hasClass('active')) {
//            alert($(".galleria-info-description").html());
          $(".nodeHeader h1").text($(".galleria-info-description").html());
//          $(".galleria-info-description").html($(this).text());
        }
      });
    }
  })(jQuery);
</script>
<?php endif; ?>
        </div>
    </section>
</div>

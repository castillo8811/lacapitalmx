<?php drupal_add_js(drupal_get_path('theme', 'garuyod7') . '/js/gallerie/galleria-1.2.9.min.js'); ?>
<?php drupal_add_js(drupal_get_path('theme', 'garuyod7') . '/js/gallerie/galleria.excelsior.js'); ?>
<?php drupal_add_css(drupal_get_path('theme', 'garuyod7') . '/css/gallerie/garuyo_videonota.classic.css'); ?>

<?php if (count($gallery) == 1): ?>
<div id="imagen-navegacion" class="margin nota-final-img left">
  <div id="wrapper-video">
    <div class="imx-banner-channel-video-nota ">
          <div class="imx-wrapper-header-channel">
    <?php if (count($serie) > 0): ?>
            <div class="imx-left-wrapper-header">
              <a href="/<?php echo $serie['url'] ?>">
                <figure><img width="41" height="41" src="<?php echo $serie['image_logo_url']; ?>" alt="<?php  echo $serie['image_logo_alt']; ?>"></figure>
              </a>
               <span class="imx-wrapper-channel-name">
                <a href="/<?php echo $serie['url'] ?>">
                  <!-- cxenseparse_start -->
                  <h3><?php echo $serie['name'] ?></h3>
                  <!-- cxenseparse_end -->
                </a>
                 <!-- <span><?php //echo $serie ['schedule']?></span>-->
              </span>
            </div>
     <?php endif ?>
            <div class="imx-wrapper-right-header" id="imx-wrapper-header-video-node">
             <?php if (isset($ytchannel)): ?>
                    <script src="https://apis.google.com/js/platform.js"></script>
                    <?php if (preg_match('/^UC/i', $ytchannel)): ?>
                      <div class="g-ytsubscribe" data-channelid="<?php echo $ytchannel ?>" data-layout="default" data-count="undefined"></div>
                    <?php else: ?>
                      <div class="g-ytsubscribe" data-channel="<?php echo $ytchannel ?>" data-layout="default" data-count="undefined"></div>
                    <?php endif ?>
              <?php endif ?>
                <a class="imx-do-you-think" href="#block-imx-comments-imx-comments">
                    <span class="globe-a-text-queopinas" id="imx_share_s" ><span></span>Opina</span>
                    <span class="globe-a-cont"><fb:comments-count href="<?php print url(drupal_get_path_alias('node/' . arg(1)), array('absolute' => 'true'));?>"></fb:comments-count></span>
                    <span class="pleca-comments dblock"><s></s><i></i></span>
                </a>
            </div>
          </div>

    <!-- cxenseparse_start -->
      <h1 class="imx-title-channel-video-notas-gallery"><?php echo $title; ?></h1>
    <!-- cxenseparse_end -->
    </div>
    <?php switch ($config['player']):
      case 'youtube': ?>
        <div id="imx-videonota-wrapper">
          <iframe width="990" height="600" type="text/html" src="<?php print $gallery[0]['iframe']; ?>" frameborder="0" allowfullscreen=""></iframe>
        </div>
        <script type="text/javascript">
          // Add function to execute when the API is ready
          imxYTReady(function(){
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
        <?php break;?>
      <?php case 'jwplayer': ?>
        <!-- embed -->
        <section id="video-livestreaming">
          <div id='player-live'></div>
        </section>
        <script type="text/javascript">
          var jwPlayerSettings = {
            playerId : document.getElementById('video-livestreaming').childNodes[1].getAttribute('id'),
            videoUrl : '//www.youtube.com/watch?v=<?php echo $gallery[0]["yid"]?>',
            <?php if ($gallery[0]['isList']): ?>
            playlist:'http://gdata.youtube.com/feeds/api/playlists/<?php echo $gallery[0]["list"]?>?alt=rss',
            <?php endif ?>
            islist: <?php echo $gallery[0]['isList']? 'true':'false'; ?>,
            startYid: '<?php echo $gallery[0]["yid"]; ?>',
            vastUrls : {
              desktop : '<?php echo $config["jwplayer_vastUrl_desktop"]; ?>',
              mobile  : '<?php echo $config["jwplayer_vastUrl_mobile"]; ?>'
            },
            image : '<?php echo $config["jwplayer_image"]; ?>',
            title : '<?php echo $config["jwplayer_title"]; ?>',
            logo  : {
              file : '<?php echo $config["jwplayer_logo_file"]; ?>',
              link : '<?php echo $config["jwplayer_logo_link"]; ?>',
              position : 'top-right'
            },
            sharing : {
              heading: '<?php echo $config["jwplayer_share"]; ?>'
            },
            clip : {
              ns_st_ci : "<?php echo $config['jwplayer_clip_ns_st_ci']; ?>",
              ns_st_pr : "<?php echo $config['jwplayer_clip_ns_st_pr']; ?>",
              ns_st_pl : "<?php echo $config['jwplayer_clip_ns_st_pl']; ?>",
              ns_st_ep : "<?php echo $config['jwplayer_clip_ns_st_ep']; ?>",
              ns_st_ge : "<?php echo $config['jwplayer_clip_ns_st_ge']; ?>",
              ns_st_ty : "<?php echo $config['jwplayer_clip_ns_st_ty']; ?>"
            },
            autoplay : <?php echo $config['jwplayer_autoplay']? 'true':'false'; ?>,
            isMobile : {
              Android: function() {
                return navigator.userAgent.match(/Android/i);
              },
              BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
              },
              iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
              },
              Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
              },
              Windows: function() {
                return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
              }
            },
            getVastUrl : function(){
              var vastUrl=this.vastUrls.desktop;
              if(this.isMobile.Android() || this.isMobile.BlackBerry() || this.isMobile.iOS() || this.isMobile.Opera() || this.isMobile.Windows()){
                return this.vastUrls.mobile;
              }
              return vastUrl;
            },
            checkList: function(items){
              var indexList = 0;
              if (this.islist) {
                search = RegExp(this.startYid);
                for (item in items){
                  if (items[item].file != 'undefined' && typeof items[item].file === "string") {
                    found = items[item].file.match(search);
                    if (found instanceof Array) {
                      indexList = item;
                      break;
                    }
                  }
                }
              }
              return indexList;
            },
          };
          var VideoLength = 0;
          var streamSense = new ns_.StreamSense({}, 'http://b.scorecardresearch.com/p?c1=2&c2=7672322&ns_site=cadenatres');
          var clips = [];
          clips[1] = jwPlayerSettings.clip;
          streamSense.setClip(clips[1]);
          var comScoreJWPlayer = jwplayer(jwPlayerSettings.playerId).setup({
            playlist: jwPlayerSettings.playlist,
            file: jwPlayerSettings.videoUrl,
            image: jwPlayerSettings.image,
            title: jwPlayerSettings.title,
            width: '<?php echo $config["jwplayer_width"]; ?>',
            height: '<?php echo $config["jwplayer_height"]; ?>',
            aspectratio: '<?php echo $config["jwplayer_aspect_ratio"]; ?>',
            primary: 'flash',
            ga: '{}',
            sharing: jwPlayerSettings.sharing,
            <?php if ($config['jwplayer_vast_flag']): ?>
              advertising: {
                client: 'vast',
                tag: jwPlayerSettings.getVastUrl(),
              },
            <?php endif ?>
            abouttext: jwPlayerSettings.title,
            aboutlink: jwPlayerSettings.logo.link,
            stretching: 'fill',
            autostart: jwPlayerSettings.autoplay
          });
          comScoreJWPlayer.onPlay(function () {
            VideoLength = comScoreJWPlayer.getDuration() * 1000;
            //comScoreJWPlayer.seek(comScoreJWPlayer.getDuration());
            streamSense.setLabels({
              name     : jwPlayerSettings.clip.ns_st_ci,
              ns_st_mv : jwplayer.version,
              ns_st_mp : "Reproductor JWPlayer"
            });
            streamSense.getClip().setLabel("ns_st_cl", VideoLength);
            streamSense.notify(ns_.StreamSense.PlayerEvents.PLAY, {}, comScoreJWPlayer.getPosition() * 1000);
          });
          comScoreJWPlayer.onPause(function () {
            streamSense.notify(ns_.StreamSense.PlayerEvents.PAUSED, {}, comScoreJWPlayer.getPosition() * 1000);
          });
          comScoreJWPlayer.onBuffer(function () {
            streamSense.notify(ns_.StreamSense.PlayerEvents.BUFFER, {}, comScoreJWPlayer.getPosition() * 1000);
          });
          comScoreJWPlayer.onComplete(function () {
            streamSense.notify(ns_.StreamSense.PlayerEvents.END, {}, comScoreJWPlayer.getPosition() * 1000);
          });
          (function($){
              $(window).load(function(){
                var items = comScoreJWPlayer.getPlaylist();
                var item = jwPlayerSettings.checkList(items);
                if (item > 0) {
                  comScoreJWPlayer.playlistItem(item);
                }
              });
          })(jQuery);
        </script>
        <!-- end Embed -->
        <?php break;?>
      <?php case 'ultimedia': ?>
        <style type="text/css">
        #videoWrapper {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            height: 0;
        }
        #videoWrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        </style>
        <div id="videoWrapper">
            <script type="text/javascript">
                var ULTIMEDIA_mdtk = "09847474"; //
                var ULTIMEDIA_zone = "9"; //
                var ULTIMEDIA_youtubedata = "<?php echo $gallery[0]['yid']?>"; //ID de la vidéo Youtube
            </script>
            <script type="text/javascript" src="http://www.ultimedia.com/js/common/iframe_switch.js"></script>
        </div>
        <?php break;?>
    <?php endswitch ?>
  </div>
</div>
<?php elseif(count($gallery) > 1): ?>
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
       <div id="gallerieWrapper">
          <div class="imx-wrapper-header-channel">
            <?php if (count($serie) > 0): ?>
                <div class="imx-left-wrapper-header">
                    <a href="/<?php echo $serie['url'] ?>">
                      <figure><img width="55" height="55" src="<?php echo $serie['image_logo_url']; ?>" alt="<?php  echo $serie['image_logo_alt']; ?>"></figure>
                    </a>
                     <span class="imx-wrapper-channel-name">
                      <a href="/<?php echo $serie['url'] ?>">
                          <!-- cxenseparse_start -->
                          <h3><?php echo $serie['name'] ?></h3>
                          <!-- cxenseparse_end -->
                      </a>
                    </span>
                </div>
            <?php endif ?>
            <div class="imx-wrapper-right-header">
                 <?php if (isset($ytchannel)): ?>
                      <p class="text-siguir-a">Sigue a Dineroenimagen en:</p>
                      <script src="https://apis.google.com/js/platform.js"></script>
                      <div class="g-ytsubscribe" data-channel="<?php echo $ytchannel; ?>" data-layout="default" data-count="undefined"></div>
                <?php endif ?>
                <a class="imx-do-you-think" href="#block-imx-comments-imx-comments">
                    <span class="globe-a-text-queopinas" id="imx_share_s" ><span></span>Opina</span>
                    <span class="globe-a-cont"><fb:comments-count href="<?php print url(drupal_get_path_alias('node/' . arg(1)), array('absolute' => 'true'));?>"></fb:comments-count></span>
                    <span class="pleca-comments dblock"><s></s><i></i></span>
                </a>
            </div>
          </div>


         <!-- cxenseparse_start -->
          <h1 class="imx-title-channel-video-notas-gallery"><?php echo $title; ?></h1>
         <!-- cxenseparse_end -->

        <div id="fotogaleria" style="display: none;"></div>
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
//                dummy: '<?php // echo $config['gallerie_dummy_logo']; ?>'
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
    </div>
<?php endif; ?>

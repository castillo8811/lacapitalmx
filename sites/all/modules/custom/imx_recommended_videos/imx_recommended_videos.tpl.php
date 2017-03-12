<?php if (count($items) == 1): ?>
    <div id="video-unique" class="video-unique-iframe w100p mb30 left">
        <div class="headerBlock P40i4">
            Video recomendado
            <div class="right suscribe-button">
                <span class="suscribe-invitation P15r1">Síguenos en:</span>
                <script src="https://apis.google.com/js/platform.js"></script>
                <div class="g-ytsubscribe" data-channel="ActitudFEM" data-layout="default" data-theme="dark" data-count="undefined"></div>
            </div>
        </div>
        <iframe width="100%" height="477" type="text/html" src="<?php print $items[0]['iframe']; ?>" frameborder="0" allowfullscreen=""></iframe>                             
        <div class="bottom-video-iframe">
            <span class="P20i1"><?php print $items[0]['description']; ?></span>
        </div>
    </div>
<?php else: ?>
    <?php
    $galleryObject = array();
    $titles = array();
    foreach ($items as $key => $value) {
        $slide_object = null;
        $slide_object = new stdClass();
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
    <div id="video-recommended-Wrapper">   
        <div class="headerBlock P40i4">
            Videos recomendados
            <div class="right suscribe-button">
                <span class="suscribe-invitation P15r1">Síguenos en:</span>
                <script src="https://apis.google.com/js/platform.js"></script>
                <div class="g-ytsubscribe" data-channel="ActitudFEM" data-layout="default" data-theme="dark" data-count="undefined"></div>
            </div>
        </div>
        <div id="videogaleria-recomended"></div>
        <script>
            var video_data = <?php print(json_encode($galleryObject)); ?>;
            var video_title = <?php print(json_encode($titles)); ?>;
            Galleria.run('#videogaleria-recomended', {
                dataSource: video_data,
                responsive: true,
                wait: true,
                _justLanded: true,
                debug: false,
                _comScoreName: get_comscore_name(),
                _titlesList: video_title,
                _second_gallery: true,
                dummy: '/sites/www.actitudfem.com/themes/actitudfem/images/pl_actitud.png',
                extend: function() {
                    var gallery = this;
                    jQuery('#videogaleria-recomended .galleria-thumbnails-container .galleria-nav-next').click(function() {
                        gallery.next();
                    });
                    jQuery('#videogaleria-recomended .galleria-thumbnails-container .galleria-nav-prev').click(function() {
                        gallery.prev();
                    });
                }
            });
        </script>                
    </div>
<?php endif; ?>
<div class="clear"></div>
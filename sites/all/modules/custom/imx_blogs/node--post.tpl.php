<?php
drupal_add_css( drupal_get_path('module', 'imx_blogs') . '/css/imx_blogs_post.css' );
$uid = $node-> uid;
$bloguero = profile2_load_by_user( $uid, "bloguero" );
$urlnota = url(drupal_get_path_alias ('node/' . $node->nid ), array( 'absolute' => true ) );
$blog = taxonomy_term_load($bloguero->field_blog[LANGUAGE_NONE][0]['tid']);

$total_images=0;

if ( array_key_exists( "und", $content['field_images']['#object']->field_images ) ) {
    $current_image = ( array_key_exists( "imagen", $_REQUEST ) ) ? ( $_REQUEST["imagen"] ) : '1';

    if ( $current_image >= 1 ) {
        $class = 'current';
    }else {
        $class = '';
    }

    $total_images = count( $content['field_images']['#object']->field_images['und'] );
    $field_images = $content['field_images']['#object']->field_images['und'];
}

$total_videos=0;
if ( array_key_exists( "und", $content['field_video']['#object']->field_video ) ) {
    $current_video = ( array_key_exists( "video", $_REQUEST ) ) ? $_REQUEST["video"] : '1';

    if ( $current_video >= 1 ) {
        $class = 'current';
    } else {
        $class = '';
    }

    $total_video = count( $content['field_video']['#object']->field_video['und'] );
    $field_video = $content['field_video']['#object']->field_video['und'];
}
?>
<h1 class="imx-blogs-canal-banner">
    <a href="/blogs"><img src="http://8d5306c18b850ea7e0ac-65b9b7a2fa68b3c92f951010bb26a4de.r54.cf2.rackcdn.com/blogs_cabezal_ch.png" alt="Blogs Excélsior" /></a>
</h1>

<header id="imx-blogs-autor-blog">
    <a href="/blog/usuario/<?php print(string_to_slug($bloguero->field_full_name[LANGUAGE_NONE][0]['safe_value'])); ?>"><img src="<?php print(file_create_url( $bloguero-> field_image_perfil[ LANGUAGE_NONE ][ 0 ] [ 'uri' ] )); ?>" alt="<?php print($bloguero->field_full_name[LANGUAGE_NONE][0]['safe_value']); ?>" class="imx-blogs-autor-blog-imagen"></a>
    <a href="<?php print(url('taxonomy/term/' . $blog->tid, array('absolute' => true))); ?>"><img src="<?php print(file_create_url($blog->field_logo[LANGUAGE_NONE][0]['uri'])); ?>" class="imx-blogs-autor-blog-logo"></a>
    <h2 class="imx-blogs-autor-blog-nombre"><?php print($bloguero->field_full_name[LANGUAGE_NONE][0]['safe_value']); ?></h2>
    <div class="imx-blogs-autor-blog-descripcion"><?php print($bloguero->field_description[LANGUAGE_NONE][0]['safe_value']); ?></div>    
</header>
<div id="imx-blogs-viralizacion">
    <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
        <a class="addthis_button_facebook_like"></a>
        <a class="addthis_button_tweet" tw:via="Excelsior"></a> 
        <a class="addthis_button_google_plusone" g:plusone:annotation="bubble"></a>     
    </div>
</div>

<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> ml10 w680 mb20"<?php print $attributes; ?>>
    <?php print render( $title_prefix ); ?>

    <?php if ( $title || $node->title ): ?>
    <h1 class="node-title" <?php print $title_attributes; ?>><?php print strip_tags( $node->title, '<i><em>' ); ?></h1>
    <?php endif; ?>

    <!-- galería -->
    <?php if ( (int)$total_images == 1 ) : ?>
    <div class="fotogaleria-wrapper mb2">
        <img class="single-image" src="<?php print(file_create_url( $field_images[0]['uri'] )); ?>" alt="<?php print($field_images[0]['alt']); ?>" />
        <div class="single-image-info">
            <div class="single-image-info-bullet">
                <div class="single-image-info-bullet-elogo"></div>
                <div class="single-image-info-bullet-arrow"></div>
            </div>
            <div class="single-image-info-text">
                <div class="single-image-info-description">
                    <?php print($field_images[0]['title']); ?>
                </div>
            </div>
        </div>
    </div>

    <?php elseif ( (int)$total_images > 1 ) : ?>
    <div class="fotogaleria-wrapper">
        <div id="fotogaleria" style="display: none;"></div>

        <script>

            jQuery('#fotogaleria').css("display","");
            <?php 
            $fotogaleria_data = array();
            foreach ( $field_images as $image ){
                $slide_object = null;
                $slide_object = new stdClass();
                $slide_object -> thumb = get_resized_url('thumbs_node',$image['fid'],'height',98);;
                $slide_object -> image = file_create_url( $image['uri'] );
                $slide_object -> description = $image['title'];
                $fotogaleria_data[] = $slide_object;
                unset( $slide_object );
            }                 
            ?>

            var fotogaleria_data = <?php print(json_encode($fotogaleria_data)); ?>;
            // Galleria.loadTheme('/sites/excelsior.com.mx/themes/excelsior/js/galleria/themes/excelsior/galleria.excelsior.js');
            Galleria.run('#fotogaleria', {
                // transition: (jQuery.browser.msie &&  parseInt(jQuery.browser.version, 10) > 9)?'none':'slide',
                // initialTransition: (jQuery.browser.msie &&  parseInt(jQuery.browser.version, 10) > 9)?'none':'fade',
                show:(/^#imagen-(\d{1,})/.test(location.hash))?(location.hash.match(/^#imagen-(\d{1,})/)[1] - 1):0,
                dataSource:fotogaleria_data,
                responsive:true,
                wait: true,
                _justLanded:true,
                debug: false,
                _comScoreName: get_comscore_name(),
                dummy:'http://8d5306c18b850ea7e0ac-65b9b7a2fa68b3c92f951010bb26a4de.r54.cf2.rackcdn.com/thumb_default_galerias.jpg'
            });

        </script>
        <noscript>
            <?php 
            $imagen_portada_grande = field_get_items( 'node', $node, 'field_image_portada_grande' );
            if ( $imagen_portada_grande ) : ?>
            <div class="fotogaleria-wrapper mb2">
                <img class="single-image" src="<?php print(file_create_url( $imagen_portada_grande[0]['uri'] )); ?>" alt="<?php print($imagen_portada_grande[0]['alt']); ?>" />
                <div class="single-image-info">
                    <div class="single-image-info-bullet">
                        <div class="single-image-info-bullet-elogo"></div>
                        <div class="single-image-info-bullet-arrow"></div>
                    </div>
                    <div class="single-image-info-text">
                        <div class="single-image-info-description">
                            <?php print($imagen_portada_grande[0]['title']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php else : ?>
            <div class="mb2">
                <img width="664" src="<?php print get_image_style( $content['body']['#object']->field_image_portada_large['und'][0]['uri'], 'horizontal' ); ?>" alt="<?php print $title; ?>" title="<?php print $title; ?>" />
            </div>            
            <?php endif; ?>
        </noscript>
    </div> 

    <?php endif; ?>
    <!-- /galería -->
    <div id="node-<?php print $type; ?>-body" class="node-post-body">
        <span class="node-post-date"><?php print date('M j, Y',$changed)?></span>    
        <?php print preg_replace("/^(<p>&nbsp;<\/p>)/", "", $content['body']['#object']->body['und'][0]['safe_value'] ); ?>
    </div>

</article>

<div class = "node_artitle_bottom" >
    <?php print render( $node_artitle_bottom ); ?>
</div>

<!-- article-related-node -->
<div id="article-related-node" class="left mb1">
    <h4 id="article-related-node-title" class="spriteFull">Relacionadas</h4>
    <ul id="article-related-node-list">
        <?php
        $i=0;
        $editorial_titles = array();
        foreach ( array_slice( field_get_items( 'node', $node, 'field_nodes_related' ), 0, 6 ) as $rel ) :
            if ( $rel["node"]->title === null ) 
                $rel["node"] = node_load( $rel["nid"] ); 
            $i++; ?>
        <li class="article-related-node-list-item mb2">
            <a class="article-related-node-list-item-link title-hover" href="<?php print url( drupal_get_path_alias( "node/{$rel["node"]->nid}" ), array( 'absolute'=>true ) );?>">
                <img class="article-related-node-list-item-link-image" src="<?php print ($rel["node"]->field_image_portada_grande[LANGUAGE_NONE][0]['uri'] == '')?'http://8d5306c18b850ea7e0ac-65b9b7a2fa68b3c92f951010bb26a4de.r54.cf2.rackcdn.com/grande200px_default.jpg':image_style_url('imagen_portada_grande_200px', $rel["node"]->field_image_portada_grande[LANGUAGE_NONE][0]['uri'] ); ?>" />
                <h4 class="article-related-node-list-item-link-title"><?php print strip_tags( $rel["node"]->title, '<i><em>' ); ?></h4>
            </a>
        </li>
        <?php 
            $editorial_titles[] = trim($rel["node"]->title);
        endforeach; 
        if((6-$i) > 0): ?>
            <!-- cxense -->
            <?php 
            $cxwId = "40909a030424c6b3808b21f75c5daf01d39e4643";
            $cxrRelacionadasNodo = array();
            $cxrRelacionadasNodo = json_decode(file_get_contents( 'http://api.cxense.com/public/widget/data?json='.urlencode('{"widgetId":"'.$cxwId.'","context":{"url":"http://www.excelsior.com.mx'.$_SERVER["REQUEST_URI"].';"}}')));
            echo '<!-- '.'http://api.cxense.com/public/widget/data?json='.urlencode('{"widgetId":"'.$cxwId.'","context":{"url":"http://www.excelsior.com.mx'.$_SERVER["REQUEST_URI"].';"}}').' -->';
            if(count($cxrRelacionadasNodo->items) > 0): ?>
                <?php $j=0;foreach($cxrRelacionadasNodo->items as $item): 

                    if(!in_array($item->title, $editorial_titles)){
                        ?>
                    <li class="article-related-node-list-item mb2">
                        <!-- <?php print $item->_type; ?> -->
                        <a class="article-related-node-list-item-link title-hover" href="<?php print $item->click_url;?>">
                            <img class="article-related-node-list-item-link-image" src="<?php print $item->{'imx-img-grande200px'}; ?>" />                
                            <h4 class="article-related-node-list-item-link-title"><?php print strip_tags( $item->title, '<i><em>' ); ?></h4>
                        </a>
                    </li>
                            <?php 
                            if(++$j >= (6-$i))
                                break;
                        }

                    endforeach; ?>
            <?php endif; ?>
            <!-- /cxense -->
        <?php endif; ?>
    </ul>
</div>

<?php if ( !$unpublished ):
    print render( $node_bottom );
endif;
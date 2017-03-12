<?php if($items["visited"]):?>
<?php 
$data_node=menu_get_object("node");
if($data_node){
    $uri_side_bar="taxonomy/term/".$data_node->field_categoria["und"][0]["tid"];
}
?>
<?php $style = variable_get('imx_sidebar_img_style', 'barra_lateral'); ?>
<div id="relatedBar">
    <div class="relatedBarWrapper">
      <ul class="height-sidebar">
          <li class="bsbb mb30">
              <div class="boxHome tacenter">
                  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                  <!-- CAPMX 1 -->
                  <ins class="adsbygoogle"
                       style="display:block"
                       data-ad-client="ca-pub-3878010380895666"
                       data-ad-slot="1824526039"
                       data-ad-format="rectangle"></ins>
                  <script>
                      (adsbygoogle = window.adsbygoogle || []).push({});
                  </script>
              </div>
          </li>
            <?php foreach($items["visited"] as $key=>$item):?>
           <?php if($key==4):?>
                    <li class="bsbb mb10">
                        <div class="boxHome tacenter pal10 ">
                            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- CAPMX 1 -->
                            <ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-client="ca-pub-3878010380895666"
                                 data-ad-slot="1824526039"
                                 data-ad-format="rectangle"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                    </li>
             <?php endif;?>
            <li class="mb10 pb20 pt10 w100p">
                    <div class="relatedTitle cuad-9 bsbb pr10 right">
                        <h1 class="pl5 bold" ><a href="<?php print $item["url"]?>" class="O15r3"><?php echo (array_key_exists("title",$item))? $item["title"] : ""?></a></h1>
                    </div>
                    <div class="relacionadoImg cuad-3 left">
                        <a  href="<?php echo $item["url"]?>" class="O19r0 lh24">
                        <img alt="título de nota" src="<?php print ($item["image"])? image_style_url($style, $item['image']) :"http://placehold.it/116x87"?>" />
                        </a>
                    </div>
                    <div class="clear"></div>
            </li>
            <?php endforeach;?>
          <li class="bsbb mb10">
              <div class="boxHome tacenter pal10 ">
                  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                  <!-- CAPMX 1 -->
                  <ins class="adsbygoogle"
                       style="display:block"
                       data-ad-client="ca-pub-3878010380895666"
                       data-ad-slot="1824526039"
                       data-ad-format="rectangle"></ins>
                  <script>
                      (adsbygoogle = window.adsbygoogle || []).push({});
                  </script>
              </div>
          </li>
        </ul>
        <a id="ver-mas" href="<?php echo ($uri_side_bar)? url($uri_side_bar): "/".$items["link_visited"] ?>" class="O40l1 btn-vermas centered mt20 mb20"><span>VER MÁS</span></a>
    </div>
</div>
<?php endif; ?>

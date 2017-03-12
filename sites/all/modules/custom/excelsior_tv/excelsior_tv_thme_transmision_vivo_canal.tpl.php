<?php 
        $data = $variables["excelsior_tv_thme_transmision_vivo_canal"];

?>
<div class="imx-multimedia-content">
    <div class="imx-multimedia-player">

      <?php if (array_key_exists("1",arg())): ?>

          <iframe width="980" height="670" src="http://www.youtube.com/embed/<?php echo arg(1) ?>?rel=0&autoplay=1&fs=1" frameborder="0" allowfullscreen></iframe>

      <?php else: ?>

      <?php
            $player = '';

            if($id_video =  _get_youtubeid($data [ "transmision_online" ][ "canal" ][ "embed" ]) ) {

             $parse_url = array();
              parse_str($data [ "transmision_online" ][ "canal" ][ "embed" ],$parse_url);
              // Armando algo como esto //www.youtube.com/embed/oOn9UeOat-U?list=PLYnzMSw5fD7SoebodXMobbj1H_XJjdfVo
              $src = "//www.youtube.com/embed/" . $id_video;
              if ( count($parse_url) > 1) {
                  $src .= '?';
                  $slice_parse = array_slice($parse_url,1); // quitamos el primer valor de arreglo
                  for ($i = 0; $i < count($slice_parse); $i++) {
                      $src .= key($slice_parse) .'='. current($slice_parse);  
                      if ($i <> (count($slice_parse) - 1) ) {
                          $src .= '&';
                      }
                      next($slice_parse);
                  }
              }
              $player = '<iframe type="text/html" width="980" height="670" src="'. $src .'   " frameborder="0" allowfullscreen="0"></iframe>';
          
            }
      ?>
                  <?php  echo $name_transmision = $data [ "transmision_online" ][ "canal" ][ "title" ];?>

                  <?php echo  $player; #' <iframe type="text/html" width="980" height="670" src="'.$embed_transmision = $data [ "transmision_online" ][ "canal" ][ "embed" ].' " frameborder="0" allowfullscreen="0"></iframe>' ?>
               
    <?php endif ?>
    <div class="fb-like" data-href="http://www.dineroenimagen.com/" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div>
  </div>
</div> 

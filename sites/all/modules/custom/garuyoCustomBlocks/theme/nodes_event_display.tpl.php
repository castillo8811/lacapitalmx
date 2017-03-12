<?php // print_r($items);
//  exit; ?>
<?php if(count($items["nodes"])):?>
<div id="related_wrapper" class="borderBox tacenter os">
  <h3 class="titleBlock">Relacionados a este evento</h3>
  <div class="relatedContent left">
    <ul>
    <li id="imx_ads_block_2"></li>
    </ul>
  </div>
  <div class="itemsContent">
    <ul class="relatedList">
      <?php foreach($items["nodes"] as $t):?>
      <li class="relatedItem">
        <a class="os" href="<?php echo url("node/".$t->nid)?>"><?php echo $t->title ?></a>
      </li>
<!--      <li class="relatedItem">
        <a class="os" href="#"> Realizar una actividad física es básico si quieres mantener un peso saludable</a>
      </li>
      <li class="relatedItem">
        <a class="os" href="#"> Realizar una actividad física es básico si quieres mantener un peso saludable</a>
      </li>-->
      <?php endforeach;?>
    </ul>
  </div>
</div>
<?php endif; ?>
<?php drupal_add_js(drupal_get_path("module","garuyo_custom_view_taxonomy")."/taxonomy_view_ajax.js")?>
<?php $items = $variables['items']; ?>
<?php
//print_r($items);exit;
$clase="";
$parent_header="";
//print_r($items);exit;
switch ($items["parent"]["path"]) {
    case "taxonomy/term/100":
        $clase = "icn-music-white";
//        $parent_header= "topMusic";
        break;
    case "taxonomy/term/279":
        $clase = "icn-childs-white";
        $parent_header= "topChild";
        break;
    case "taxonomy/term/251":
        $clase = "icn-movies-white";
        $parent_header= "topCine";
        break;
    case "taxonomy/term/60":
        $clase = "icn-home-white";
        $parent_header= "topTeatro";
        break;
    case "taxonomy/term/1":
        $clase = "icn-food-white";
        break;
    case "taxonomy/term/372":
        $clase = "icn-museum-white";
      $parent_header= "topMuseum";
        break;
    case "taxonomy/term/46":
        $clase = "icn-night-white";
        break;
    case "taxonomy/term/275":
        $clase = "icn-television-white";
        break;
}
if($items["category"]["tid"]=="305787"){
$clase_ocio="para-la-calle";    
}
if($items["category"]["tid"]=="305788"){
 $clase_ocio="para-el-sillon";   
}
if(arg(0)=="ocio" && arg(2)){
    $clase_ocio=arg(1);
}
//print_r($clase_ocio);exit;
?>
<div class="<?php echo ($parent_header)? $parent_header :"topContent" ?> prelative">
    <span id="menuiFixed-openmenu" class="do-show-menu link transitionPosition" style="display: none;"></span>
    <section class="headerCanal limited">
        <div id="logo" class="centered ptb10">
            <a href="/" title="Página de inicio">
                <img src="/<?php echo drupal_get_path("theme", "garuyod7") ?>/images/logo_garuyo_v4.png" alt="logo Garuyo">
            </a>
            <div class="headerCanal-Section">
                <span class="<?php echo $clase?>"></span> <span class="O50r1"><?php echo $items["parent"]["title"] ?></span>
            </div>
        </div>
        <div class="sections-top centered">
            <!--categorai ocio con filtro-->
            <?php if($items["category"]["tid"]!="305788" && $items["category"]["tid"]!="305787"):?>
            <a href="<?php echo url("taxonomy/term/305787").url($items["parent"]["path"]) ?>"
               class="<?php echo ($clase_ocio=="para-la-calle")? $clase_ocio:"pleca-ocio-calle" ?>  mlr5 ajax_ocio" 
               data-ocio="/ocio/para-la-calle" data-tid="<?php echo $items["parent"]["tid"]?>" data-offset="0" 
               data-parent-path="<?php echo url($items["parent"]["path"]) ?>"
               data-children-path="<?php echo url("taxonomy/term/305787") ?>"></a>
            <a href="<?php echo url("taxonomy/term/305788").url($items["parent"]["path"])?>" 
               class="<?php echo ($clase_ocio=="para-el-sillon")? $clase_ocio :"pleca-ocio-sillon"?> mlr5 ajax_ocio" 
               data-ocio="/ocio/para-el-sillon" data-tid="<?php echo $items["parent"]["tid"]?>" data-offset="0"
               data-parent-path="<?php echo url($items["parent"]["path"]) ?>"
               data-children-path="<?php echo url("taxonomy/term/305788") ?>"></a>
            <?php else:?>
            <!--ocio sin filtro-->
            <a href="<?php echo url("taxonomy/term/305787")?>" 
               class="<?php echo ($clase_ocio=="para-la-calle")? $clase_ocio:"pleca-ocio-calle" ?> mlr5 dom-taxonomy" data-id-taxonomy="305787"
               data-parent-path="<?php echo url("taxonomy/term/305787") ?>"
               data-children-path="<?php echo url("taxonomy/term/305787") ?>"></a>
            <a href="<?php echo url("taxonomy/term/305788")?>" 
               class="<?php echo ($clase_ocio=="para-el-sillon")? $clase_ocio:"pleca-ocio-sillon" ?> mlr5 dom-taxonomy" data-id-taxonomy="305788"
               data-parent-path="<?php echo url("taxonomy/term/305788") ?>"
               data-children-path="<?php echo url("taxonomy/term/305788") ?>"></a>
            <?php endif;?>
        </div>
        <div class="headerCanal-listado">
            <?php if($items["submenus"]):?>
            <ul>
                
                    <?php foreach($items["submenus"] as $idx=>$s):?>
                           <ul>
                               <?php foreach($s as $d):?>
                                <li class="col-5 left bsbb mt10 <?php echo ($idx>=2)? "hidden": ""?>">
                                    <!--<a href="<?php // echo url($d["path"])?>" class="N16b1 <?php // echo ($items["category"]["tid"]==$d["tid"])?"submenu-active":""?> dom-taxonomy" data-id-taxonomy="<?php // echo $d["tid"]?>"><?php // echo $d["title"]?></a>-->
                                  <a href="/<?php echo str_replace("/","",url("taxonomy/term/".$d["tid"]))?>" class="N16b1 <?php echo ($items["category"]["tid"]==$d["tid"])?"submenu-active":""?> dom-taxonomy" data-id-taxonomy="<?php echo $d["tid"]?>"
                                  data-parent-path="<?php echo url($items["parent"]["path"]) ?>"
                                  data-children-path="<?php echo url("taxonomy/term/".$d["tid"]) ?>"><?php echo $d["title"]?></a>
                                </li>
                                <?php endforeach;?> 
                            </ul>
                   <?php endforeach;?> 
            </ul>
            <?php if(count($items["submenus"])>=3): ?>
            <span id="headerCanal-showMore" class="clear tacenter N18r2 mt10 link">VER MÁS <span class="icn-show-more"></span></span>
            <?php endif;?>
            <?php endif;?>
        </div>
    </section>

</div>
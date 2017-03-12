<div id="relCxsenseBlock" category="Bloque_cxsense" class="clicsAnalytics clear left">
    <div class="headerBlock">También te puede interesar:</div>    
    <ul class="relCxsenseList">        
        <?php foreach ($data['items'] as $key => $value): ?>
            <?php $uri = $value['imagen']; ?>
            <li class="relCxsenseItem left">
                <div class="relItemCont">
                    <a href="<?php print $value['url']; ?>">
                        <div class="image_Rel_Cxsense">
                            <img src="<?php echo $uri ?>" />
                        </div>
                        <span class="categoryName O18l5 upp dblock"><?php print $value['categoria']; ?></span>
                        <span class="titleRel P15r0"><?php print $value['title']; ?></span>
                    </a>
                </div> 
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="clear"></div>


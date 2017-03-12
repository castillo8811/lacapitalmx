<div id="fotogalerias-wrapper" class="left">
    <div class="title-relacionados  dis-in-bl">
        <span class="cruz left"></span>
        <span class="bg-cruz left">Más fotogalerías</span>
    </div>
    <div id="links-masfotos-wrapper" class="left">
        <ul>
            <?php foreach($data['items'] as $item){  ?>
            <li class="mas-fotos-item left">
                <img class="img-item-masfotos" src="<?php print image_style_url('thumbnail', $item['image_uri']) ?>" alt="" title="" />
                <a class="blue A16" href="<?php echo url('node/' . $item['nid']) ?>" title="<?php echo $item['title'] ?>">
                    <span class="links-premium-text"><?php print $item['title'] ?></span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>
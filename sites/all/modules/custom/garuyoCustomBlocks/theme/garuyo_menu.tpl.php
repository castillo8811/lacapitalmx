<?php $items = $variables['items']; ?>
<ul class="menu clearfix">
    <?php foreach ($items["principales"] as $p): ?>
        <li class="leaf <?php echo ($p["tid"]==$items["zone_taxonomy"])? "active-trail ": ""?>"><a href="<?php echo url($p["path"]) ?>"  <?php echo ($p["tid"]==$items["zone_taxonomy"])? "class='active-trail active'": ""?> title="<?php echo $p["title"] ?>"><?php echo $p["title"] ?></a></li>
        <?php endforeach; ?>
</ul>
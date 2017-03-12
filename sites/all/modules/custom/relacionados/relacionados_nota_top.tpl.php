<div id="relacionadosNotaBottom" category="Bloque_nodereference" class="clicsAnalytics left">
    <div class="headerTextRel">Quienes leyeron esto también visitaron:</div>
    <ul>
        <?php foreach ($data['items'] as $row): ?>
            <li class="relItem left">
                <div class="relWrapTitle">
                    <a href="<?php print $row['url'] ?>"><span class="bullet-red dis-in-bl"></span><?php print $row['title'] ?></a>
                </div>
            </li>
            <?php $x++; ?>
        <?php endforeach; ?>
    </ul>
</div>








<?php
$currentblocks = variable_get('customhome', getDefaultBlocks());
global $user;
?>
<?php if ($user->roles[3] == 'administrator'):?>
    <div id="customhome-blocks-form">
        <?php print drupal_render($form['newblock']);?>
    </div>
<?php endif;?>
<div id="customhome-wrapper">
    <table>
        <thead>
            <tr>
                <th colspan="2">Bloque</th>
                <th style="text-align: center;">Posición</th>
                <th style="text-align: center;">¿Carrusel corto en Home?</th>
                <th style="text-align: center;">Activo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($currentblocks as $i => $currentblock):?>
                <tr>
                    <td>
                        <img src="/sites/www.actitudfem.com/themes/actitudfem/images/customhome/<?php print $currentblock['machinename']?>.jpg" style="float: left;margin: 6px 10px 0 0;">
                    </td>
                    <td>
                        <?php print drupal_render($form['bloque'][$i]['bloque']);?>
                    </td>
                    <td style="text-align: center;">
                        <?php print drupal_render($form['bloque'][$i]['peso']);?>
                    </td>
                    <td style="text-align: center;">
                        <?php print $i == 0 ? drupal_render($form['bloque'][$i]['tipo']) : '';?>
                    </td>
                    <td style="text-align: center;">
                        <?php print drupal_render($form['bloque'][$i]['status']);?>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <?php print drupal_render_children($form);?>
</div>
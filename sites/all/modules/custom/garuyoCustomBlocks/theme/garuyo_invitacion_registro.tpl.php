<?php
$tid = (int) arg(2);
$term = taxonomy_term_load($tid);
$vid = $term->vid;
?>
<?php if ($vid != 12): ?>

    <section id="registroInvitacion" class="<?php echo (arg(0)=="taxonomy")? "mt30":"" ?> mb20">
        <div class="limited tacenter pt20">
            <img src="/<?php echo drupal_get_path("theme", "garuyod7") ?>/images/logo_garuyo_v2.png" alt="logo Garuyo">
            <p class="O30l1 lh40">¿Tienes un lugar o evento que quieras compartir en Garuyo?</p>
            <p class="O30l1 lh40">Regístralo y permite que todos te encuentren</p>
            <p class="O30l1 lh40">en Internet, es GRATIS</p>
            <?php if(arg(0)=="taxonomy" || arg(0)=="invitacion"):?>
            <a href="/registrar-evento-lugar" class="O25l1 mt30 btn-vermasAzul centered"><span>REGISTRAR</span></a>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
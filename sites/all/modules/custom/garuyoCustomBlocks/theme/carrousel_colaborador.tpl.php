<?php // $query_colaboradores = db_select("node", "n")->fields("n", array("uid"))->groupBy("n.uid")->orderBy("n.created", "DESC")->orderBy("n.changed", "DESC")->range(0, 15)->execute()->fetchAll();  ?>
<?php
$query_colaboradores = db_select("field_data_field_colaborador", "fc");
$query_colaboradores->extend('PagerDefault');
$query_colaboradores->join("node", "n", "fc.entity_id=n.nid");
$query_colaboradores->join("users", "u", "u.uid=fc.field_colaborador_uid");
$query_colaboradores->fields("fc", array("field_colaborador_uid"));
$query_colaboradores->fields("n", array("nid"));
$query_colaboradores->condition("u.status",1,"=");
$query_colaboradores->range(0,20);
$query_colaboradores->orderBy("n.created","ASC");
$query_colaboradores->groupBy("fc.field_colaborador_uid");
$query_colaboradores->distinct();
$data_q = $query_colaboradores->execute()->fetchAll();
//$query_colaboradores = db_select("field_data_field_colaborador", "fc");
//$query_colaboradores->extend('PagerDefault');
//$query_colaboradores->join("node", "n", "fc.entity_id=n.nid");
//$query_colaboradores->join("users", "u", "u.uid=fc.field_colaborador_uid");
//$query_colaboradores->fields("fc", array("field_colaborador_uid"));
//$query_colaboradores->fields("n", array("nid"));
//$query_colaboradores->condition("u.status",1,"=");
//$query_colaboradores->range(0,10);
//$query_colaboradores->orderBy("n.created");
//$query_colaboradores->groupBy("fc.field_colaborador_uid");
//$query_colaboradores->distinct();
//$data_q = $query_colaboradores->execute()->fetchAll();

//print_r($data_q);exit;
?>
<section id="colaboradoresCarousel" class="mt30 mb20 ohidden tacenter">
    <div class="limited prelative">
        <div class="colaboradoresCarousel-Header pt10">
            <h2 class="O25l1">Colaboradores</h2>
            <img src="/<?php echo drupal_get_path("theme", "garuyod7") ?>/images/logo_garuyo_v4.png" alt="logo Garuyo" />
        </div>
        <span class="arrow-prev-gray link"></span>
        <span class="arrow-next-gray link"></span>
        <div id="colaboradoresCarousel_wrapper">
            <ul>
                <?php foreach ($data_q as $u): ?>
                    <?php
                    $data_user = user_load($u->field_colaborador_uid);
                    $editor_profile = profile2_load_by_user($u->field_colaborador_uid, "editor");
                    $image_profile="";
                    if ($data_user->picture->uri) {
                        $image_profile = image_style_url("colaborador_carrousel", $data_user->picture->uri);
                    } else {
                        if ($editor_profile->field_profile_background["und"][0]["uri"]) {
                            $image_profile = image_style_url("colaborador_carrousel", $editor_profile->field_profile_background["und"][0]["uri"]);
                        }
                    }
                    ?>
                    <li>
                        <div class="colaboradores-item plr10 bsbb" itemscope itemtype="https://schema.org/Person">
                            <a href="<?php echo url("user/" . $u->field_colaborador_uid) ?>"><img itemprop="image" src="<?php echo ($image_profile) ? $image_profile : drupal_get_path("theme", "garuyod7")."/images/aliados_default.png" ?>" alt="<?php echo $data_user->name ?>" width="150" height="150" /></a>
                            <h2 itemprop="name" class="O15r2 mt10 mb5"><?php echo $data_user->name ?></h2>
                            <?php
//                            $nota=node_load($u->nid);
                            $node_q = db_select("node", "n");
                            $node_q->extend("PagerDefault");
                            $node_q->join("field_data_field_colaborador", "fc", "fc.entity_id=n.nid");
                            $node_q->fields("n", array("title","nid"));
                            $node_q->condition("fc.field_colaborador_uid", $u->field_colaborador_uid, "=");
                            $node_q->orderBy("n.created","DESC");
                            $node_q->range(0, 1);
                            $nota=$node_q->execute()->fetchAll();
//                            print_r($nota);exit;
    ?>
                            <a itemprop="url" href="<?php echo url("node/".$nota[0]->nid) ?>" class="O17r1 lh20"><?php echo ($nota[0]->title) ? $nota[0]->title : ""?></a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="clear"></div>
        <a href="/aliados" class="O25l1 mt5 btn-vermasAzul centered"><span>VER MÁS</span></a>
    </div>
</section>
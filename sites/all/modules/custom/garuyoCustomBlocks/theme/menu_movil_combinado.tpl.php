<?php
if ($user->uid) {
    $data_user = user_load($user->uid);
    if ($data_user->picture->uri) {
        $image_profile = image_style_url("profile_menu", $data_user->picture->uri);
    } else {
        $editor_profile = profile2_load_by_user($user->uid, "editor");
        if ($editor_profile->field_profile_background["und"][0]["uri"]) {
            $image_profile = image_style_url("profile_menu", $editor_profile->field_profile_background["und"][0]["uri"]);
        }
    }
}
?>
<?php $items = $variables['items']; ?>
<section id="menuMobile">
    <div id="menuMobileUserActions">
        <ul>
            <?php if ($user->uid): ?>
                <li class="diblock bsbb mb10 prelative menuMobileUserActions-pic">
                    <img id="image-profile-user" width="25" height="25" class="ml10 left mr10" src="<?php echo ($image_profile) ? $image_profile : "http://placehold.it/25x25" ?>" alt="<?php echo $user->name ?>">
                    <a href="/usuario/favoritos" class="O18r1 mt10 left hoverY transitionColor">MI PERFIL</a>
                    <div class="clear"></div>
                </li>
                <li class="diblock bsbb mb10 pt10 prelative menuMobileUserActions-favs">
                    <span class="icn-pin-xs left mr5"></span> <a href="/usuario/favoritos" class="N14r1 hoverY transitionColor">Favoritos (<span class="count-favorites"><?php echo count(imx_mark_load_uid($user->uid, 1, true)) ?></span>)</a>
                </li>
                <li class="diblock bsbb mb10 pt10">
                    <a class="N14r1 hoverY transitionColor" href="/user/logout">Cerrar sesión</a>
                </li>
                <li class="diblock bsbb mb20 pt10">
                    <a class="O18r1 hoverY transitionColor" href="/registrar-evento-lugar">AGREGAR LUGAR O EVENTO</a>
                </li>
            <?php else: ?>
                <li class="diblock bsbb mb10 pt10 prelative">
                    <span class="icn-pin-s btn-instruccion-favorito no-sesion"></span> <a href="#favoritos" class="O18r1 hoverY transitionColor btn-instruccion-favorito no-sesion">FAVORITOS</a>
                </li>
                <li class="diblock bsbb mb10 prelative menuMobileUserActions-pic">
                    <span class="icn-user-xs"></span> <a class="O18r1 hoverY transitionColor" href="/user/login">INICIAR SESIÓN/REGISTRO</a>
                    <div class="clear"></div>
                </li>
                <li class="diblock bsbb mb20 pt10">
                    <a class="O18r1 hoverY transitionColor" href="/registrar-evento-lugar">AGREGAR LUGAR O EVENTO</a>
                    <div class="clear"></div>
                </li> 
            <?php endif; ?>
        </ul>
    </div>
    <nav id="menuFixedMobile">
        <ul class="menu clearfix">
            <?php foreach ($items["principales"] as $p): ?>
                <li class="leaf <?php echo ($p["tid"] == $items["zone_taxonomy"]) ? "active-trail " : "" ?>"><a href="<?php echo url($p["path"]) ?>"  <?php echo ($p["tid"] == $items["zone_taxonomy"]) ? "class='active-trail active'" : "" ?> title="<?php echo $p["title"] ?>"><?php echo $p["title"] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
</section>


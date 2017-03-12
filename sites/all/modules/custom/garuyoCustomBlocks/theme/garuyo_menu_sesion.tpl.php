<?php if($user->uid): ?>
<?php 
$data_user=user_load($user->uid);
    if ($data_user->picture->uri) {
        $image_profile = image_style_url("profile_menu", $data_user->picture->uri);
    }
else{
$editor_profile=profile2_load_by_user($user->uid,"editor");
if($editor_profile->field_profile_background["und"][0]["uri"]){
$image_profile=image_style_url("profile_menu",$editor_profile->field_profile_background["und"][0]["uri"]);    
}
}
?>

<ul>
        <li class="diblock">
            <img id="image-profile-user" class="ml10 left mr10" src="<?php echo ($image_profile)? $image_profile :"http://placehold.it/40x40"?>" alt="<?php echo $user->name?>">
            <a href="/usuario/favoritos" class="N14b1 mt10 left hoverY transitionColor">MI PERFIL</a>
            <div class="clear"></div>
        </li>
        <li class="diblock pt10">
            <span class="icn-pin-s left mr5"></span> <a href="/usuario/favoritos" class="N14b1 hoverY transitionColor">FAVORITOS (<span class="count-favorites"><?php echo count(imx_mark_load_uid($user->uid,1,true)) ?></span>)</a>
        </li>
        <li class="diblock pt10">
            <a class="N14b1 hoverY transitionColor" href="/user/logout">CERRAR SESIÓN</a>
        </li>
        <li class="diblock pt10">
            <a class="N14b1 hoverY transitionColor" href="/registrar-evento-lugar">AGREGAR LUGAR O EVENTO</a>
        </li>
</ul>
<?php else:?>
<ul>
<li class="diblock pt10 right">
            <a class="N14b1 hoverY transitionColor" href="/registrar-evento-lugar">AGREGAR LUGAR O EVENTO</a>
            <div class="clear"></div>
        </li> 
        <li class="diblock pt10 right">
            <a class="N14b1 hoverY transitionColor" href="/user/login">INICIAR SESIÓN/REGISTRO</a>
            <div class="clear"></div>
        </li>
        <li class="diblock pt10 right">
            <span class="icn-pin-s left mr5 btn-instruccion-favorito no-sesion"></span> <a href="#favoritos" class="N14b1 hoverY transitionColor btn-instruccion-favorito no-sesion">FAVORITOS</a>
        </li>
</ul>
<?php endif; ?>
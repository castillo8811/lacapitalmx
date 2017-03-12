<?php

    $data = $variables['data'];
    $identities = $data["identities"];
    foreach ($identities as $identitie) {
        if (array_key_exists("data", $identitie)) {
            $data_profile = unserialize($identitie["data"]);
        }
    }
    if (array_key_exists("photoURL", $data_profile)) {
        $image_user_url = $data_profile["photoURL"];
        if ($image_user_url) {
            $image_user = "<img width='100' src='{$image_user_url}' />";
        }
    } else {
        $image_user = theme('user_picture', array('account' => $user));
    }

    if (array_key_exists("displayName", $data_profile)) {
        $user_name = ($data_profile["displayName"]) ? $data_profile["displayName"] : $data["user"]->mail;
    }

?>
<div class="actitudfem-user-login-form-wrapper tacenter mb30">
    <div class="actitudfem-login-Header">
        <p class="P50i3 bolder">Bienvenid@ a </p>

        <p class="P36i2 taright">Garuyo.com</p>
    </div>
    <div class="actitudfem-welcome-Body tacenter">
        <p class="P22r3 mb30">Bienvenido a Garuyo.com, el sitio de entretenimiento personalizado</p>

        <div class="logged-user-image">
            <?php print $image_user ?>
        </div>
        <span class="logged-fb-name mt20 mb10 dblock P18i5"><?php print $user_name ?></span>
    </div>
    <div class="hybridauth-login-alternative tacenter">
        <?php if (empty($data['identities'])): ?>
            <span class="mb20 dblock P20r3">¿Por qué no te unes con tu red social favorita?</span>
            <?php print render($data["form"]) ?>
        <?php endif; ?>
    </div>
    <a href="/user" class="P14r7 mt20">Ir a mi perfil</a>

    <div class="clear"></div>
</div>
<div class="limited">
    <div class="userProfileData ptb20 mt30 mb20" itemscope itemtype="http://schema.org/Person">
        <div class="userProfileData-img left cuad-2 tacenter">
            <?php print theme('user_picture', array('account' =>$user,'style_name' => ''))?>
        </div>
        <div class="userProfileData-info right cuad-10 bsbb">
            <h4 itemprop="name" class="O30r0 mb20 icn-user-b">Mi perfil</h4>
            <h5 class="N25b4">¡Hola <?php print ($user->name)? $user->name:$user->mail ?>!</h5>
            <p itemprop="description" class="N18r0 mtb10">Esta sección es tuya, aquí encontrarás secciones para ofrecerte un mejor servicio.</p>
        </div>
        <div class="clear"></div>
    </div>
    <section id="userProfileBenefits" class="mb30">
        <div class="right cuad-10">
            <ul>
                <li class="prelative">
                    <a href="/usuario/favoritos" class="link-abs uline N13r4">Editar mis favoritos</a>
                    <h4 class="icn-pin-b mb10"><a href="/usuario/favoritos" class="O30r0">Mis favoritos</a></h4>
                    <p class="N18r0 mt10 lh22">En esta sección podrás guardar los artículos de tu interés y mantenerlos para leerlos cuando gustes.</p>
                </li>
                <!--
                <li class="prelative">
                    <a href="#" class="link-abs uline N13r4">Editar mis alertas</a>
                    <h4 class="icn-alertas-b mb10"><a href="/usuario/alertas" class="O30r0">Mis alertas</a></h4>
                    <p class="N18r0 mt10 lh22">En esta sección podrás guardar los artículos de tu interés y mantenerlos para leerlos cuando gustes.</p>
                </li>
                -->
                <li class="prelative">
                    <a href="/usuario/boletin" class="link-abs uline N13r4">Editar mi boletín</a>
                    <h4 class="icn-boletin-b mb10"><a href="/usuario/boletin" class="O30r0">Boletín</a></h4>
                    <p class="N18r0 mt10 lh22">En esta sección podrás guardar los artículos de tu interés y mantenerlos para leerlos cuando gustes.</p>
                </li>
                <li class="prelative">
                    <a href="/usuario/configuracion" class="link-abs uline N13r4">Editar mis datos</a>
                    <h4 class="icn-settings-b mb10"><a href="/usuario/configuracion" class="O30r0">Configuración</a></h4>
                    <p class="N18r0 mt10 lh22">En esta sección podrás guardar los artículos de tu interés y mantenerlos para leerlos cuando gustes.</p>
                </li>
            </ul>
        </div>
        <div class="clear"></div>
    </section>
</div>
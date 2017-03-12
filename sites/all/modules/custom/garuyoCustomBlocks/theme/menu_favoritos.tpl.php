<?php $uri_user=  request_uri(); ?>
<nav id="userProfileMenu">
  <ul class="limited centered">
    <li class="bsbb col-4 left tacenter prelative">
      <!--Activar clase "active" para tab actual-->
      <div class="mi-perfil O30l1 link ptb5 transitionBG <?php echo ($uri_user=="/usuario/perfil")?"active":"" ?>">
        <a href="/usuario/perfil">
        <span class="icn-user-w"></span> Mi perfil
        <span class="line-w"></span></a>
      </div>
    </li>
    <li class="bsbb col-4 left tacenter prelative">
      <div class="mi-favoritos O30l1 link ptb5 transitionBG <?php echo ($uri_user=="/usuario/favoritos")?"active":"" ?>">
        <a href="/usuario/favoritos">
        <span class="icn-pin-w"></span> Mis favoritos
        <span class="line-w"></span></a>
      </div>
    </li>
<!--    <li class="bsbb col-5 left tacenter prelative">
      <div class="mi-alertas O30l1 link ptb5 transitionBG <?php echo ($uri_user=="/usuario/alertas")?"active":"" ?>">
        <a href="/usuario/alertas">
        <span class="icn-alertas-w"></span> Mi alertas
        <span class="line-w"></span></a>
      </div>
    </li>-->
    <li class="bsbb col-4 left tacenter prelative">
      <div class="mi-boletin O30l1 link ptb5 transitionBG <?php echo ($uri_user=="/usuario/boletin")?"active":"" ?>">
        <a href="/usuario/boletin">
        <span class="icn-boletin-w"></span> Boletín
        <span class="line-w"></span></a>
      </div>
    </li>
    <li class="bsbb col-4 left tacenter prelative">
      <div class="mi-configuracion O30l1 link ptb5 transitionBG <?php echo ($uri_user=="/usuario/configuracion")?"active":"" ?>">
        <a href="/usuario/configuracion">
        <span class="icn-settings-w"></span> Configuración
      </a>
      </div>
    </li>
    <li class="clear"></li>
  </ul>
</nav>
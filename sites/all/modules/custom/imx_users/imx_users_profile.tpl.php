<script>
    jQuery('document').ready(function(){
        jQuery('.menuFixedNav ul.menu li').eq(1).addClass('active-trail');
    });
</script>

<div class="colaboradorFirma pb20 bb1 mb20" itemscope="" itemtype="http://schema.org/Person">
    <div class="mirador-img-profile cuad-4 left bsbb prelative">
        <span class="helperArrow-2"></span>
        <img class="img-fluid" width="100%" height="100%" itemprop="image" src="<?php print $data["image"] ?>" alt="" />
    </div>
    <div class="mirador-text cuad-8 bsbb pl10 left prelative">
        <div class="nodeAuthorSocial">
            <ul>
                <li class="diblock mr20">
                    <a class="O20l4" href="https://twitter.com/<?php print $data['twitter']; ?>" target="_blank"><?php echo $data['twitter'] ? $data['twitter'] : '@LaCapitalmx'; ?></a>
                </li>
            </ul>
        </div>
        <h4 itemprop="name"><a itemprop="url" class="O21r0"><?php echo $data['blog'] ?></a></h4>
        <h4 itemprop="name"><a itemprop="url" class="O21r0"><?php echo $data['name'] ?></a></h4>
        <p itemprop="description" class="O18l6 lh24 mb10"><?php echo $data['signature'] ?></p>
    </div>
    <div class="clear"></div>
</div>
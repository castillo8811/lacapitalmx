<?php #dvm($data);  ?>
<div id="followme_wrapper" class="left">
    <div class="followme-content left">
        <div class="editor-pic left">
            <img src="<?php echo $data['picture_uri']; ?>" alt="" width="100%" height="auto" />
        </div>
        <div class="editor-info left">
            <p class="editor_name_content"><span class="editor_name"><?php echo $data['name']; ?></span><span class="rolEditor"> | <?php echo $data['edit']; ?></span></p>
            <div class="shares_class left">
                <a href="https://twitter.com/<?php print $data['twitter']; ?>" class="twitter-follow-button left" data-show-count="false">Seguir a @Salud180</a><!--LLamado a su perfil de twitter -->
                <div class="fb-follow left" data-href="http://www.facebook.com/<?php print $data['facebook']; ?>" data-colorscheme="light" data-layout="standard" data-width="20" data-show-faces="false"></div><!--LLamado a su perfil de facebook -->
                <div class="g-plusone right" data-size="medium" data-href="http://www.salud180.com/"></div><!--Cuenta de google+ -->
            </div>

        </div>
    </div>
</div>

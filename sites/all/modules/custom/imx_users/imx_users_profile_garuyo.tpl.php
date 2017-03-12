<?php // print_r($data);exit;?>
<div class="nodeAuthor ptb20 mb20" itemscope itemtype="http://schema.org/Person">
    <div class="left col-3 prelative mr10">
        <span class="helperArrow-2"></span>
        <img itemprop="image" src="<?php echo ($data["image"])? $data["image"]:$data['background'] ?>" width="100%">
    </div>
    <div class="left cuad-7 bsbb">
        <h4 itemprop="name" class="imx-users-title-name O21r0 mb10">
            <a href="<?php echo  url("user/".$data["uid"])?>" class="O25r0">
                Por <?php echo $data['name'] ?>
            </a>
        </h4>
        <a class="O20l4 block" href="https://twitter.com/<?php print $data['twitter']; ?>" target="_blank"><?php echo $data['twitter'] ? $data['twitter'] : ''; ?></a><br>
        <!-- <h4 class="O21r0 mb10"><?php echo $data['blog'] ?></h4>-->
        <p itemprop="description" class="O18l6 lh24 mb10 user-description"><?php echo $data['signature'] ?></p>
    </div>
    <div class="clear"></div>
</div>
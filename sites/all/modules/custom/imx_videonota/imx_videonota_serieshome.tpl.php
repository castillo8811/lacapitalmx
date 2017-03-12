<section class="imx-wrapper-serie-multimedia-home">
    <article  class="imx-row-series-home">
        <div class="imx-banner-series-home">
            <a href="/<?php echo $data['serie']['url'] ?>">
                <img width="100%" height="115" src="<?php echo $data['serie']['image_channel_url']; ?>" alt="<?php echo $data['serie']['image_channel_alt']; ?>">
            </a>
            <script src="https://apis.google.com/js/platform.js"></script>
            <?php if (preg_match('/^UC/i', $data['serie']['ytchannel'])): ?>
                <div class="g-ytsubscribe" data-channelid="<?php echo $data['serie']['ytchannel'] ?>" data-layout="default" data-count="undefined"></div>
            <?php else: ?>
                <div class="g-ytsubscribe" data-channel="<?php echo $data['serie']['ytchannel'] ?>" data-layout="default" data-count="undefined"></div>
            <?php endif ?>
        </div>
        <ul class="imx-ul-chanel-home-videos">
            <?php foreach ($data['data'] as $key => $value): ?>
                <?php if ($key == 0): ?>
                    <li>
                        <a href="/<?php echo $value['url']; ?>">
                            <article class="imx-wrapper-node-videos-list-top">
                                <figure class="imx-wrapper-img-chanel-list-top">
                                    <?php if (isset($value['youtube_id'])): ?>
                                        <img src="<?php echo "http://img.youtube.com/vi/" . $value["youtube_id"] . "/mqdefault.jpg"; ?>" alt="<?php echo $value['summary']; ?>">
                                    <?php else: ?>
                                        <img src="<?php echo $value['image_uri']; ?>" alt="<?php echo $value['summary']; ?>">
                                    <?php endif ?>
                                    <span class= "dblock imx-plek-multimedia-video-channel"></span>
                                </figure>
                                <foter class="imx-title-home-chanel-list-top">
                                    <h3><?php echo $value['title'] ?></h3>
                                </foter>
                            </article>
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="/<?php echo $value['url']; ?>">
                            <article class="imx-wrapper-node-videos-list">
                                <figure class="imx-wrapper-img-chanel-list">
                                    <?php if (isset($value['youtube_id'])): ?>
                                        <img src="<?php echo "http://img.youtube.com/vi/" . $value["youtube_id"] . "/mqdefault.jpg"; ?>" alt="<?php echo $value['summary']; ?>">
                                    <?php else: ?>
                                        <img src="<?php echo $value['image_uri']; ?>" alt="<?php echo $value['summary']; ?>">
                                    <?php endif ?>
                                    <span class= "dblock imx-plek-multimedia-video-channel"></span>
                                </figure>
                                <foter class="imx-title-home-chanel-list">
                                    <h3><?php echo $value['title'] ?></h3>
                                </foter>
                            </article>
                        </a>
                    </li>
                <?php endif ?>
            <?php endforeach ?>
        </ul>
        <div class="imx-home-videos-chanel-mas">
            <a href="/<?php echo $data['serie']['url'] ?>" class="imx-btn-home-videos-ver-mas"></a>
        </div>
    </article>
</section>

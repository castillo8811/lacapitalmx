<?php
/**
 * @file
 * The tpl for the ampproject node.
 */

hide($content['comments']);
hide($content['links']);
$relacionados= data_relacionados_nota_nid($node->nid);
?>

<article  class="pall15" itemscope itemtype="http://schema.org/NewsArticle">
    <meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="https://google.com/article"/>
    <?php if (true): ?>
        <div class="nodeImg tacenter centered mb20" >
            <?php print render($content["field_image"]) ?>
            <?php if (isset($content["field_image"]["#object"]->field_image["und"][0]["title"])): ?>
                <p itemprop="description" class="nodeImgfooter A15r0 prelative">
              <span class="icn-capital-white-wrapper">
                  <span class="icn-capital-white"></span>
              </span><?php echo $content["field_image"]["#object"]->field_image["und"][0]["title"] ?>
                </p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <header class="nodeHeader">
        <h1 itemprop="headline" class="O45r0 lh50 mb20 tacenter"><?php echo $node->title; ?></h1>
    </header>
    <hr/>
    <h3 itemprop="author" itemscope itemtype="https://schema.org/Person" class="tacenter autor">
        Por : <span itemprop="name">Redacción</span>
    </h3>
    <hr/>
    <div class="nodeBody A21r0 lh30 mb30" itemprop="articleBody">
        <?php print render($content['body']); ?>
    </div>
    <meta itemprop="datePublished" content="<?php print date('Y-m-d',$node->created) ?>"/>
    <meta itemprop="dateModified" content="<?php print date('Y-m-d',$node->created) ?>"/>
    <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
        <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject" class="hidden">
            <amp-img
                src="http://www.lacapitalmx.com/sites/all/themes/lacapitalmx_d7_responsive/lacapitalmx/logo.png"
                layout="responsive" placeholder
                width="440"
                height="250"
                >
            </amp-img>
            <meta itemprop="url" content="http://www.lacapitalmx.com/sites/all/themes/lacapitalmx_d7_responsive/lacapitalmx/logo.png">
            <meta itemprop="width" content="280">
            <meta itemprop="height" content="42">
        </div>
        <meta itemprop="name" content="LaCapital">
    </div>
</article>
<section id="relateds-amp">
    <div class="more-articles">Te sugerimos leer</div>
    <ul>
        <?php foreach ($relacionados["items"] as $item): ?>
            <?php $uri = $item['image_uri']; ?>
            <li class="bsbb pl10 mt30 pr10 mb20">
                <article itemscope itemtype="http://schema.org/NewsArticle">
                    <meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="https://google.com/article"/>
                    <div class="nodesList-img prelative pt10">
                        <a href="<?php print $item["url"]?>">
                            <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                                <amp-img
                                    src="<?php print image_style_url('home_y_canales', $uri)?>"
                                    layout="responsive" placeholder
                                    width="440"
                                    height="250"
                                    >
                                </amp-img>
                                <meta itemprop="url" content="<?php print image_style_url('home_y_canales', $uri)?>">
                                <meta itemprop="width" content="600">
                                <meta itemprop="height" content="480">
                            </div>
                        </a>
                    </div>
                    <h1 itemprop="headline" class="mtb10">
                        <a href="<?php print $item["url"]?>" class="O25r0"><?php print $item["title"]?></a>
                    </h1>
                    <meta itemprop="datePublished" content="<?php print date('Y-m-d',$node->created) ?>"/>
                    <meta itemprop="dateModified" content="<?php print date('Y-m-d',$node->created) ?>"/>
                    <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                        <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject" class="hidden">
                            <amp-img
                                src="http://www.lacapitalmx.com/sites/all/themes/lacapitalmx_d7_responsive/lacapitalmx/logo.png"
                                layout="responsive" placeholder
                                width="440"
                                height="250"
                            >
                            </amp-img>
                            <meta itemprop="url" content="http://www.lacapitalmx.com/sites/all/themes/lacapitalmx_d7_responsive/lacapitalmx/logo.png">
                            <meta itemprop="width" content="280">
                            <meta itemprop="height" content="42">
                        </div>
                        <meta itemprop="name" content="LaCapital">
                    </div>
                    <h3 itemprop="author" itemscope itemtype="https://schema.org/Person" class="tacenter autor hidden">
                        Por : <span itemprop="name">Redacción</span>
                    </h3>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
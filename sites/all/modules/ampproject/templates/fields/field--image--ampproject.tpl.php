<?php
/**
 * @file
 * The tpl for the ampproject image field type.
 *
 * The template will support a standard image field(not rendered)
 *
 * Complete documentation for this file is available online.
 * @see https://github.com/ampproject/amphtml/blob/master/builtins/amp-img.md
 */
?>

<?php foreach ($items as $item) : ?>

  <?php if (!empty($item['#item']['width']) && !empty($item['#item']['height'])): ?>
<div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
  <amp-img
    src="<?php print $item['#item']['src_url']; ?>"
    <?php if (!empty($ampproject['srcset'])): ?>
      srcset="<?php print $ampproject['srcset']; ?>"
    <?php endif; ?>
    layout="responsive" placeholder
    width="600"
    height="480"
    alt="<?php print $item['#item']['alt']; ?>">
  </amp-img>
  <meta itemprop="url" content="<?php print $item['#item']['src_url']?>">
  <meta itemprop="width" content="600">
  <meta itemprop="height" content="480">
</div>
  <?php endif; ?>

<?php endforeach; ?>

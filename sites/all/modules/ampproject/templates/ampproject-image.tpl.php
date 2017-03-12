<?php
/**
 * @file
 * The tpl for the custom ampproject image rendering.
 *
 * The template will support a standard image field(not rendered)
 *
 * Complete documentation for this file is available online.
 * @see https://github.com/ampproject/amphtml/blob/master/builtins/amp-img.md
 */
?>

<?php if (!empty($ampproject['width']) && !empty($ampproject['height'])): ?>

  <amp-img
    src="<?php print $ampproject['src_url']; ?>"
    <?php if (!empty($ampproject['srcset'])): ?>
      srcset="<?php print $ampproject['srcset']; ?>"
    <?php endif; ?>
    layout="responsive" placeholder
    width="<?php print $ampproject['width']; ?>"
    height="<?php print $ampproject['height']; ?>"
    <?php if (!empty($ampproject['alt'])): ?>
      alt="<?php print $ampproject['alt']; ?>"
    <?php endif; ?>
  ></amp-img>
<?php endif; ?>

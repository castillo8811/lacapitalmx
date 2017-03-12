<?php
/**
 * @file
 * The tpl for ampproject youtube rendering.
 *
 * Complete documentation for this file is available online.
 * @see https://www.ampproject.org/docs/reference/extended/amp-youtube.html
 */
?>

<amp-youtube
  data-videoid="<?php print $ampproject['vid']; ?>"
  layout="responsive"
  width="<?php print $ampproject['width']; ?>"
  height="<?php print $ampproject['height']; ?>"></amp-youtube>

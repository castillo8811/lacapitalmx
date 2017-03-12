<?php
/**
 * @file
 * The tpl for ampproject twitter rendering.
 *
 * Complete documentation for this file is available online.
 * @see https://www.ampproject.org/docs/reference/extended/amp-twitter.html
 */
?>

<amp-twitter
  width=<?php print $ampproject['width']; ?>
  height=<?php print $ampproject['height']; ?>
  layout="responsive"
  data-tweetid="<?php print $ampproject['status_id']; ?>"
>

<?php
/**
 * @file
 * The tpl for the ampproject field.
 */
?>

<div class="<?php print $classes; ?>">
  <?php if (!$label_hidden): ?>
    <div class="field-label"><?php print $label ?>:&nbsp;</div>
  <?php endif; ?>
  <div class="field-items">
    <?php foreach ($items as $delta => $item): ?>
      <div class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"><?php print render($item); ?></div>
    <?php endforeach; ?>
  </div>
</div>

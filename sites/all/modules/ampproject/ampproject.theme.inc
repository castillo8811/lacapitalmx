<?php
/**
 * @file
 * Theme functions for Google AMP.
 *
 * @addtogroup theming
 */

function template_preprocess_ampproject_html(&$vars) {
  $vars['content'] = theme('ampproject_content', $vars);
}

function template_preprocess_ampproject_content(&$vars) {
  $vars['content'] = entity_view($vars['ampproject']['type'], [$vars['ampproject']['entity']], 'ampproject');
}

function template_preprocess_ampproject_image(&$vars) {
  if (empty($vars['ampproject']['width']) || empty($vars['ampproject']['height'])) {
    return '';
  }
}

function template_preprocess_ampproject_twitter(&$vars) {
  if (empty($vars['ampproject']['status_id'])) {
    return '';
  }
}

function template_preprocess_ampproject_youtube(&$vars) {
  if (empty($vars['ampproject']['vid'])) {
    return '';
  }
}

function template_preprocess_ampproject_facebook(&$vars) {
  if (empty($vars['ampproject']['href'])) {
    return '';
  }

  if (empty($vars['ampproject']['embed_as'])) {
    $vars['ampproject']['embed_as'] = 'post';
  }
}

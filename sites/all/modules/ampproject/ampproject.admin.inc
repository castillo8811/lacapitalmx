<?php

/**
 * @file
 * Admin page.
 */

/**
 * AMP settings form.
 */
function ampproject_settings_form() {

  $form['ampproject_url_segment'] = [
    '#type' => 'textfield',
    '#title' => t('AMP URL segment'),
    '#default_value' => variable_get('ampproject_url_segment', ''),
    '#required' => TRUE,
  ];

  $form['ampproject_styles'] = [
    '#type' => 'textarea',
    '#title' => t('AMP Style URLs'),
    '#description' => t('Enter your style paths. Each style per new line.<br />Absolute URLs are expected.<br />The CSS file shouldn\'t exceeds the 50,000 bytes limit.'),
    '#default_value' => variable_get('ampproject_styles', ''),
  ];

  $form['ampproject_srcset'] = [
    '#type' => 'textarea',
    '#title' => t('AMP srcset definition'),
    '#description' => t('Enter your srcset definitions for images(each rule per new line). <br />Expected format: [style_name] => [width]<br />E.g: img_640w => 640w\r\nimg_320w => 320w'),
    '#default_value' => variable_get('ampproject_srcset', ''),
  ];

  $form['ampproject_advanced'] = [
    '#type' => 'fieldset',
    '#title' => t('AMP visibility'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  ];

  $form['ampproject_advanced']['ampproject_entity_types'] = [
    '#type' => 'checkboxes',
    '#title' => t('Apply for following entities.'),
    '#options' => _ampproject_get_entity_types_options(),
    '#default_value' => variable_get('ampproject_entity_types', []),
  ];

  $form['ampproject_advanced']['ampproject_node_types'] = [
    '#type' => 'checkboxes',
    '#title' => t('Apply for following bundles.'),
    '#options' => node_type_get_names(),
    '#default_value' => variable_get('ampproject_node_types', []),
    '#states' => [
      'invisible' => [
        ':input[name="ampproject_entity_types[node]"]' => ['checked' => FALSE],
      ],
    ],
  ];

  return system_settings_form($form);
}

function _ampproject_get_entity_types_options() {
  $options = [];
  foreach (entity_get_info() as $entity_type => $entity_info) {
    if (!empty($entity_info['fieldable'])) {
      $options[$entity_type] = $entity_type;
    }
  }
  return $options;
}

function _ampproject_get_fields_by_type_options($type = 'list_boolean') {
  $options = ['' => t('- None -')];

  foreach (field_info_fields() as $field_info) {
    if ($field_info['type'] == $type) {
      $options[$field_info['field_name']] = $field_info['field_name'];
    }
  }

  return $options;
}

/**
 * Ensure a correct URL segment value.
 */
function ampproject_settings_form_validate($form, &$form_state) {
  if (!empty($form_state['values']['ampproject_url_segment'])) {
    $original_val = $form_state['values']['ampproject_url_segment'];
    $form_state['values']['ampproject_url_segment'] = trim($form_state['values']['ampproject_url_segment'], '/');
    if ($original_val != $form_state['values']['ampproject_url_segment']) {
      drupal_set_message(t('The value has been optimised from "@original_val" to "@optimised_val"', [
        '@original_val' => $original_val,
        '@optimised_val' => $form_state['values']['ampproject_url_segment'],
      ]));
    }
  }
}

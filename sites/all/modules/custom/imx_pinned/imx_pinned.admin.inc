<?php

function imx_pinned_admin_start_form($form, &$form_state, $no_js_use = FALSE) {
    drupal_add_js(drupal_get_path('module', 'imx_pinned') . '/imx_pinned.js');
    $n = variable_get('imx_pinned_nodes');
    $v = variable_get('imx_pinned_vocabulary');
    $form['description'] = array(
        '#markup' => '<div>' . t('Seleccione el vocabulario adecuado a su sitio')
    );
    $form['#tree'] = TRUE;
    $form['block_info_fieldset']["vocabulario"] = array(
        '#type' => 'select',
        '#title' => t("Vocabulario de taxonomía"),
        '#options' => getVocabulary(),
        '#default_value' => $v ? $v : 3
    );
    $form['block_info_fieldset']["nodes"] = array(
        '#type' => 'checkboxes',
        '#options' => array(1 => t('Sí')),
        '#title' => t('¿Utilizar en las notas la personalización de su canal?'),
        '#default_value' => $n ? $n : 0
    );
    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => 'Aceptar',
    );
    $form['return'] = array(
        '#type' => 'link',
        '#title' => t('Regresar'),
        '#href' => '/admin/config/pinned',
    );
    return $form;
}

function imx_pinned_admin_start_form_submit($form, &$form_state) {
    $canales_taxonomy = ($form_state['values']['block_info_fieldset']["vocabulario"]) ? $form_state['values']['block_info_fieldset']["vocabulario"] : 3;
    $nodes = ($form_state['values']['block_info_fieldset']["nodes"]) ? $form_state['values']['block_info_fieldset']["nodes"] : 0;
    variable_set("imx_pinned_nodes", $nodes);
    variable_set("imx_pinned_vocabulary", $canales_taxonomy);
    drupal_set_message("Configuración guardada con éxito");
}

function imx_pinned_admin_settings_form($form, &$form_state, $no_js_use = FALSE) {
    drupal_add_js(drupal_get_path('module', 'imx_pinned') . '/imx_pinned.js');
    drupal_add_js(drupal_get_path('module', 'imx_pinned') . '/colorpicker/js/colorpicker.js');
    drupal_add_css(drupal_get_path('module', 'imx_pinned') . '/colorpicker/css/colorpicker.css');
    $items = variable_get('imx_pinned_info');
    $canales_taxonomy = variable_get('imx_pinned_vocabulary');
    $categorias = getCategories($canales_taxonomy);
    $form['description'] = array(
        '#markup' => '<div>' . t('Configuracion de etiquetas "meta" para Pinned Sites</div>')
    );
    $form['#tree'] = TRUE;
    $form['block_fieldset']['home'] = array(
        '#type' => 'fieldset',
        '#title' => t('Home'),
        '#prefix' => '<div id="region-pinned-fieldset">',
        '#suffix' => '</div>',
        '#collapsible' => TRUE,
        '#collapsed' => FALSE,
    );
    $form['block_fieldset']['home']["pinned_info"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Nombre de la sección o sitio"),
        '#default_value' => $items['home'] ? $items['home']['pinned_info'] : variable_get('site_name', "Default site name"),
    );
    $form['block_fieldset']['home']["pinned_description"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Descripción de la sección o sitio"),
        '#default_value' => $items['home'] ? $items['home']['pinned_description'] : '',
    );
    $form['block_fieldset']['home']["pinned_color"] = array(
        '#type' => 'textfield',
        '#title' => t("Seleccione un color para la sección o sitio"),
        '#default_value' => $items['home'] ? $items['home']['pinned_color'] : '',
        '#required' => TRUE,
        '#size' => 6,
        '#maxlength' => 6,
        '#suffix' => "
      <script type='text/javascript'>
        jQuery(document).ready(function(){
            colorPickerAttach('#edit-block-fieldset-home-pinned-color');
        });
      </script>"
    );
    $form['block_fieldset']['home']['pinned_image'] = array(
        '#type' => 'managed_file',
        '#title' => t('Imagen representativa de la sección o sitio (144x144)'),
        '#upload_location' => 'public://imx_pinned/images/',
        '#default_value' => $items['home'] ? $items['home']['pinned_image'] : '',
        '#required' => TRUE,
    );
    $form['block_fieldset']['home']['pinned_tid'] = array(
        '#type' => 'hidden',
        '#value' => 'home',
    );
    foreach ($categorias as $tid => $value) {
        $form['block_fieldset'][$tid] = array(
            '#type' => 'fieldset',
            '#title' => t($value),
            '#prefix' => '<div id="region-pinned-fieldset">',
            '#suffix' => '</div>',
            '#collapsible' => TRUE,
            '#collapsed' => $items[$tid]['pinned_color'] && $items[$tid]['pinned_image'] ? FALSE : TRUE,
        );
        $form['block_fieldset'][$tid]["pinned_info"] = array(
            '#type' => 'textfield',
            '#required' => FALSE,
            '#title' => t("Nombre de la sección o sitio"),
            '#default_value' => $items[$tid] ? $items[$tid]['pinned_info'] : t($value) . ' | ' . variable_get('site_name', "Default site name"),
        );
        $form['block_fieldset'][$tid]["pinned_description"] = array(
            '#type' => 'textfield',
            '#required' => FALSE,
            '#title' => t("Descripción de la sección o sitio"),
            '#default_value' => $items[$tid] ? $items[$tid]['pinned_description'] : '',
        );
        $form['block_fieldset'][$tid]["pinned_color"] = array(
            '#type' => 'textfield',
            '#title' => t("Seleccione un color para la sección o sitio"),
            '#default_value' => $items[$tid] ? $items[$tid]['pinned_color'] : '',
            '#required' => FALSE,
            '#size' => 6,
            '#maxlength' => 6,
            '#suffix' => "
          <script type='text/javascript'>
            jQuery(document).ready(function(){
                colorPickerAttach('#edit-block-fieldset-$tid-pinned-color');
            });
          </script>"
        );
        $form['block_fieldset'][$tid]['pinned_image'] = array(
            '#type' => 'managed_file',
            '#title' => t('Imagen representativa de la sección o sitio (144x144)'),
            '#upload_location' => 'public://imx_pinned/images/',
            '#default_value' => $items[$tid] ? $items[$tid]['pinned_image'] : '',
            '#required' => FALSE,
        );
        $form['block_fieldset'][$tid]['pinned_tid'] = array(
            '#type' => 'hidden',
            '#value' => $tid,
        );
    }
    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => 'Guardar',
    );
    $form['return'] = array(
        '#type' => 'link',
        '#title' => t('Regresar'),
        '#href' => '/admin/config/pinned',
    );
    $js = "
    function colorPickerAttach(which) {
      jQuery(which).ColorPicker({
        onSubmit: function(hsb, hex, rgb) {
          jQuery(which).val(hex);
        },
        onBeforeShow: function () {
          jQuery(this).ColorPickerSetColor(this.value);
        }
      })
      .bind('keyup', function(){
        jQuery(this).ColorPickerSetColor(this.value);
      });
    }";
    drupal_add_js($js, 'inline');
    return $form;
}

function imx_pinned_admin_settings_form_submit($form, &$form_state) {
    foreach ($form_state['values']['block_fieldset'] as $item) {
        $pinned_info[$item['pinned_tid']] = $item;
    }
    variable_set("imx_pinned_info", $pinned_info);
    drupal_set_message("Configuración guardada con éxito");
}

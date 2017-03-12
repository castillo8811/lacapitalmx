<?php

function imx_newsletter_modal_admin_settings_form($form, &$form_state, $no_js_use = FALSE) {
    drupal_add_js(drupal_get_path('module', 'imx_newsleter_modal') . '/imx_newsleter_modal.js');
    $items = variable_get('imx_newsleter_modal_info',array());
    $form['description'] = array(
        '#markup' => t('Configuracion de tag y visibilidad del modal newsletter')
    );
    $form['#tree'] = TRUE;
    $form['status'] = array(
        '#type' => 'checkbox',
        '#title' => t('Activado'),
        '#default_value' => !count($items) ? 0 : ($items['status'] == 0 || !$items['status'] ? 0 : 1),
    );
    $form["mlist"] = array(
        '#type' => 'textfield',
        '#description' => t("Lista de mail chimp a utilizar"),
        '#required' => TRUE,
        '#title' => t("Mailchimp List"),
        '#size' => 100,
        '#default_value' => $items['mlist'] ? $items['mlist'] : '',
    );
    $form['places'] = array(
        '#type' => 'checkboxes',
        '#options' => array(
            'Todo'=> t('Todo'), 
            'Home'=> t('Home'), 
            'Notas'=> t('Notas'),
            'Canales'=> t('Canales')
        ),
        '#title' => t('Visibilidad en:'),
        '#default_value' => $items['places'] ? $items['places'] : array('Notas'),
    );
    $form['debug'] = array(
        '#title' => t('Modo debug?'),
        '#type' => 'checkbox',
        '#attributes' => ($items['debug'] == 0) ? array() : array('checked' => 'checked'),
        '#default_value' => ($items['debug'] == 0) ? 0 : 1
    );
    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => 'Guardar',
    );
    return $form;
}

function imx_newsletter_modal_admin_settings_form_submit($form, &$form_state) {
    $items = array(
        'status' => $form_state['values']['status'],
        'mlist' => $form_state['values']['mlist'],
        'debug' => $form_state['values']['debug']
    );
    foreach($form_state['values']['places'] as $pid => $place){
        $items['places'][$pid] = $place;
    }
    variable_set("imx_newsleter_modal_info", $items);
    drupal_set_message("Configuración Newsletter Modal guardada con éxito");
}
<?php

/**
 * 
 * @param type $form
 * @param type $form_state
 * @return type
 */
function imx_sidebar_node_config_queue_form($form, &$form_state) {
    $form['account'] = array(
        '#type' => 'fieldset',
        '#title' => t('Configuracion del Nodequeue de El Editor te recomienda'),
    );

    $form['account']['imx_sidebar_queue_title'] = array(
        '#title' => t('Nombre del queue'),
        '#type' => 'textfield',
        '#default_value' => variable_get('imx_sidebar_queue_title', 'recomendaciones_editor'),
        '#size' => 80,
        '#maxlength' => 150,
        '#required' => TRUE,
        '#weight' => -10,
        '#description' => t('Nombre maquina del queue'),
    );

    $styles = sidebar_get_images_styles();
    $form['account']['imx_sidebar_queue_style'] = array(
        '#title' => 'Seleccione el estilo de imagen:',
        '#type' => 'select',
        '#options' => $styles,
        '#default_value' => variable_get('imx_sidebar_queue_style', 'gallerie'),
        '#weight' => -9,
        '#required' => TRUE,
        '#description' => t('Elija el estilo de imagen que tendran las imagenes del listado'),
    );

    $form['account']['imx_sidebar_queue_link'] = array(
        '#title' => t('Ruta del ver más de El editor te recomienda'),
        '#type' => 'textfield',
        '#default_value' => variable_get('imx_sidebar_queue_link', NULL),
        '#size' => 80,
        '#maxlength' => 150,
        '#required' => TRUE,
        '#weight' => -8,
        '#description' => t('Coloque la ruta del listado del edtor te recomienda sin diagonal (/) al inicio, ejemplo: recomendamos'),
    );

    $form['save_buttom']['save_queue_name'] = array(
        '#type' => 'submit',
        '#submit' => array('imx_sidebar_node_config_queue_summit'),
        '#value' => t('Guardar Configuración'),
        '#weight' => -6,
    );

    return $form;
}

/**
 * Implements hook_validate().
 */
function imx_sidebar_node_config_queue_form_validate($form, &$form_state) {
    if (!$form_state['values']['imx_sidebar_queue_title']) {
        form_set_error('imx_sidebar_queue_title', t('Debes indicar el nombre maquina del queue'));
    } else {
        $text = (string) strip_tags($form_state['values']['imx_sidebar_queue_title']);
        $text = check_plain($text);
        $queue = validate_queue_exist_query($text);
        if ($queue !== TRUE) {
            form_set_error('imx_sidebar_queue_title', t('El queue indicado no existe, ingrese un queue existente'));
        }
    }
    if (!$form_state['values']['imx_sidebar_queue_style']) {
        form_set_error('imx_sidebar_queue_style', t('Debes seleccionar el estilo de imagen'));
    }
}

/**
 * 
 * @param type $form
 * @param type $form_state
 */
function imx_sidebar_node_config_queue_summit($form, &$form_state) {

    $text = (string) strip_tags($form_state['values']['imx_sidebar_queue_title']);
    $queue = check_plain($text);
    $uri = (string) strip_tags($form_state['values']['imx_sidebar_queue_link']);
    $link = check_url($uri);
    $style = (string) $form_state['values']['imx_sidebar_queue_style'];
    variable_set('imx_sidebar_queue_title', $queue);
    variable_set('imx_sidebar_queue_link', $link);
    variable_set('imx_sidebar_queue_style', $style);
    drupal_set_message('Se han guardado los datos de form correcta');
}

/**
 * 
 * @param type $form
 * @param type $form_state
 */
function imx_sidebar_node_config_most_visited_form($form, &$form_state) {
    $form['account'] = array(
        '#type' => 'fieldset',
        '#title' => t('Configuracion de las notas más visitadas de la barra lateral'),
    );

    $form['account']['imx_sidebar_visited_time'] = array(
        '#title' => t('Indique el número de días para mostrar las notas más visitadas en ese rango a la fecha actual'),
        '#type' => 'textfield',
        '#default_value' => variable_get('imx_sidebar_visited_time', 7),
        '#size' => 4,
        '#maxlength' => 4,
        '#required' => TRUE,
        '#weight' => -10,
        '#description' => t('Seleccione el periodo de dias, para traer las notas más visitadas en ese periodo'),
    );

    $form['account']['imx_sidebar_created_time'] = array(
        '#title' => t('Indique el número de días para limitar las notas creadas en ese periodo'),
        '#type' => 'textfield',
        '#default_value' => variable_get('imx_sidebar_created_time', 15),
        '#size' => 4,
        '#maxlength' => 4,
        '#required' => TRUE,
        '#weight' => -9,
        '#description' => t('Seleccione el periodo de dias, para traer las notas más visitadas (creadas o modificadas) en ese periodo'),
    );

    $types = sidebar_get_node_types();
    $serialize = variable_get('imx_sidebar_types', NULL);
    $unserialize = array();
    if ($serialize) {
        $unserialize = unserialize($serialize);
    }
    $form['account']['imx_sidebar_types'] = array(
        '#type' => 'checkboxes',
        '#title' => 'Elija los tipos de contenido, que seran habilitados para filtrar los más visitados',
        '#options' => $types,
        '#weight' => -8,
        '#required' => TRUE,
        '#default_value' => $unserialize,
    );

    $styles = sidebar_get_images_styles();

    $form['account']['imx_sidebar_img_style'] = array(
        '#title' => 'Seleccione el estilo de imagen:',
        '#type' => 'select',
        '#options' => $styles,
        '#default_value' => variable_get('imx_sidebar_img_style', 'gallerie'),
        '#weight' => -7,
        '#required' => TRUE,
        '#description' => t('Elija el estilo de imagen que tendran las imagenes del listado'),
    );

    $form['account']['imx_sidebar_visited_link'] = array(
        '#title' => t('Ruta del ver más de las notas más visitadas'),
        '#type' => 'textfield',
        '#default_value' => variable_get('imx_sidebar_visited_link', NULL),
        '#size' => 80,
        '#maxlength' => 150,
        '#required' => TRUE,
        '#weight' => -6,
        '#description' => t('Coloque la ruta de la pagina del listado de as notas más vistas sin diagonal (/) al inicio, ejemplo: recomendamos'),
    );
    $form['save_buttom']['save'] = array(
        '#type' => 'submit',
        '#submit' => array('imx_sidebar_node_config_most_visited_submit'),
        '#value' => t('Guardar Configuración'),
        '#weight' => -3,
    );
    return $form;
}

/**
 * 
 * @param type $form
 * @param type $form_state
 */
function imx_sidebar_node_config_most_visited_form_validate($form, &$form_state) {
    if (!$form_state['values']['imx_sidebar_visited_time']) {
        form_set_error('imx_sidebar_visited_time', t('Indique el número de días para mostrar las notas más visitadas en ese rango'));
    } else if (!is_numeric($form_state['values']['imx_sidebar_visited_time'])) {
        form_set_error('imx_sidebar_visited_time', t('Debes indicar un valor numerico, para el numero de días'));
    }

    if (!$form_state['values']['imx_sidebar_created_time']) {
        form_set_error('imx_sidebar_visited_time', t('Indique el número de días para mostrar las notas más visitadas en ese rango'));
    } else if (!is_numeric($form_state['values']['imx_sidebar_created_time'])) {
        form_set_error('imx_sidebar_created_time', t('Debes indicar un valor numerico, para el numero de días'));
    }

    if (!$form_state['values']['imx_sidebar_img_style']) {
        form_set_error('imx_sidebar_img_style', t('Debes seleccionar el estilo de imagen'));
    }

    if (!$form_state['values']['imx_sidebar_types']) {
        form_set_error('imx_sidebar_types', t('Debes seleccionar al menos un tipo de contenido'));
    }
}

/**
 * 
 * @param type $form
 * @param type $form_state
 */
function imx_sidebar_node_config_most_visited_submit($form, &$form_state) {
    $time = (int) $form_state['values']['imx_sidebar_visited_time'];
    $created = (int) $form_state['values']['imx_sidebar_created_time'];
    $uri = (string) strip_tags($form_state['values']['imx_sidebar_visited_link']);
    $style = (string) $form_state['values']['imx_sidebar_img_style'];
    $link = check_url($uri);
    variable_set('imx_sidebar_visited_time', $time);
    variable_set('imx_sidebar_created_time', $created);
    variable_set('imx_sidebar_visited_link', $link);
    variable_set('imx_sidebar_img_style', $style);
    $type = $form_state['values']['imx_sidebar_types'];
    $array = array();
    foreach ($type as $key => $value) {
        if ($value !== 0) {
            $array[$key] = $value;
        }
    }
    $serialize = serialize($array);
    variable_set('imx_sidebar_types', $serialize);
    drupal_set_message('Se han guardado los datos de forma correcta');
}
<?php

/**
 * 
 * @param type $form
 * @param type $form_state
 * @return type
 */
function videos_recomendados_admind_config_form($form, &$form_state) {
    $modo = (variable_get('imx_recommended_videos_modo')) ? variable_get('imx_recommended_videos_modo') : 0;
    $videos = recuperar_video();

    $form['account'] = array(
        '#type' => 'fieldset',
        '#title' => t('Configuracion de bloque'),
    );

    $form['account']['status_block'] = array(
        '#type' => 'select',
        '#title' => t('Estado del bloque:'),
        '#default_value' => $modo,
        '#options' => array(
            '0' => t('Ocultar'),
            '1' => t('Visible'),
        ),
        '#weight' => -20,
        '#description' => t('Muestre u oculte el bloque de videos recomendados'),
    );
    $form['account']['videos'] = array(
        '#type' => 'container',
        '#tree' => TRUE,
        '#prefix' => '<div id="videos">',
        '#suffix' => '</div>',
    );

    if ($form_state['clicked_button']['#title'] === 'agregar') {
        $form_state['total']['videos']++;
    } elseif ($form_state['clicked_button']['#title'] === 'borrar') {
        $eliminar = $form_state['clicked_button']['#name'];
        $eliminar = explode('_', $eliminar);
        $form_state['total']['quitar'].=$eliminar[1] . '/';
    }

    if (empty($videos)) {
        $primer_titulo = NULL;
        $primer_url = NULL;
        $secuencia = 1;
    } else {
        $primer_titulo = $videos[0]['titulo'];
        $primer_url = $videos[0]['url'];
        $secuencia = count($videos);
    }

    $form_state['total']['videos'] = isset($form_state['total']['videos']) ? $form_state['total']['videos'] : $secuencia;


    $form['account']['videos']['lista'][0] = array(
        '#type' => 'fieldset',
        '#title' => t('Ingrese los datos del video'),
        '#weight' => -1,
    );
    $form['account']['videos']['lista'][0]['titulo'] = array(
        '#title' => t('Título del video'),
        '#type' => 'textfield',
        '#default_value' => $primer_titulo,
        '#size' => 80,
        '#maxlength' => 150,
        '#required' => TRUE,
        '#weight' => 1,
        '#description' => t('Indica el titulo del video'),
    );
    $form['account']['videos']['lista'][0]['url'] = array(
        '#title' => t('Url del video'),
        '#type' => 'textfield',
        '#default_value' => $primer_url,
        '#size' => 80,
        '#maxlength' => 150,
        '#required' => TRUE,
        '#weight' => 2,
        '#description' => t('Ingrese la url del video'),
    );

    if ($form_state['total']['videos'] > 1) {
//$form['videos']['totales']; 
        $peso = 3;
        $formulario = 1;
        $z = 2;
        $quitar = explode('/', $form_state['total']['quitar']);
        for ($i = 2; $i <= $form_state['total']['videos']; $i++) {
            $peso++;

            $titulo_videos = (!empty($videos[$formulario]['titulo'])) ? $videos[$formulario]['titulo'] : null;
            $url_videos = (!empty($videos[$formulario]['url'])) ? $videos[$formulario]['url'] : null;

            if (!in_array($formulario, $quitar)) {
                $form['account']['videos']['lista'][$formulario] = array(
                    '#type' => 'fieldset',
                    '#title' => t('Ingrese los datos del video  ' . $z),
                    '#weight' => $peso,
                    //     '#attributes' => array('style' => array('background-color:#eee')),
                    '#collapsible' => TRUE,
                    '#collapsed' => FALSE,
                );
                $form['account']['videos']['lista'][$formulario]['titulo'] = array(
                    '#title' => t('Título del video'),
                    '#type' => 'textfield',
                    '#default_value' => $titulo_videos,
                    '#size' => 80,
                    '#maxlength' => 150,
                    //'#required' =>True,
                    '#weight' => $peso,
                    '#description' => t('Indica el titulo del video'),
                );
                $peso++;
                $form['account']['videos']['lista'][$formulario]['url'] = array(
                    '#title' => t('Url del video'),
                    '#type' => 'textfield',
                    '#default_value' => $url_videos,
                    '#size' => 80,
                    '#maxlength' => 150,
                    // '#required' => True,
                    '#weight' => $peso,
                    '#description' => t('Ingrese la url del video'),
                );

                $form['account']['videos']['lista'][$formulario]['delete'] = array(
                    '#title' => t('borrar'),
                    '#type' => 'button',
                    '#default_value' => 'Eliminar este video',
                    '#weight' => $peso + 1,
                    '#ajax' => array(
                        'callback' => 'eliminar_video',
                        'wrapper' => 'videos',
                        'method' => 'replace',
                        'effect' => 'fade',
                    ),
                    '#name' => 'delete_' . $formulario,
                );
                $z++;
            }$formulario++;
        }
    }

    $form['account']['agregar'] = array(
        '#type' => 'button',
        '#value' => t('agregar otro video'),
        '#ajax' => array(
            'callback' => 'agregar_video',
            'wrapper' => 'videos',
        ),
        '#weight' => 99,
        '#title' => 'agregar'
    );
    $form['save_challenge'] = array(
        '#type' => 'submit',
        '#submit' => array('videos_recomendados_admind_config_form_submit'),
        '#value' => t('Guardar'),
        '#weight' => 100,
    );

    return $form;
}

function agregar_video($form, &$form_state) {
    return $form['account']['videos'];
}

function eliminar_video($form, &$form_state) {

    return $form['account']['videos'];
}

/**
 * 
 * @global type $user
 * @param type $form
 * @param type $form_state
 */
function videos_recomendados_admind_config_form_validate($form, &$form_state) {
    if ($form_state['values']['videos']['lista'] && $form_state['clicked_button']['#title'] !== 'borrar') {
        $captura = $form_state['values']['videos']['lista'];
        foreach ($captura as $key => $value) {
            if (empty($value['titulo'])) {
                form_set_error('videos][lista][' . $key . '][titulo', t('No puede  dejar el titulo  vacio '));
            }
            if (empty($value['url'])) {
                form_set_error('videos][lista][' . $key . '][url', t('No puede dejar la url vacia '));
            }
        }
    }
}

function videos_recomendados_admind_config_form_submit($form, &$form_state) {
    $videos = array();
    $filename = VIDEOS_DEFAULT_FILE_PATH . 'videos_recomendados.json';
    variable_set('imx_recommended_videos_modo', $form_state['values']['status_block']);
    if ($form_state['values']['videos']['lista']) {
        $captura = $form_state['values']['videos']['lista'];
        foreach ($captura as $key => $value) {
            $videos[] = array(
                'titulo' => $value['titulo'],
                'url' => $value['url'],
            );
        }
    }
    if (file_exists($filename)) {
        unlink($filename);
        file_put_contents($filename, drupal_json_encode($videos));
    } else {
        file_put_contents($filename, drupal_json_encode($videos));
    }
//$dd  = variable_get('imx_recommended_videos_modo');
    drupal_set_message('Se  ha guardado la configuracion de videos  ');
}

function recuperar_video() {

    $filename = VIDEOS_DEFAULT_FILE_PATH . 'videos_recomendados.json';
    $videos_array = FALSE;
    $videos = FALSE;
    if (file_exists($filename)) {
        $videos = json_decode(file_get_contents($filename));
    }
    if (!empty($videos)) {
        foreach ($videos as $key => $value) {
            $videos_array[] = array(
                'titulo' => $value->titulo,
                'url' => $value->url
            );
        }
    }

    return $videos_array;
}

/**
 * Eliminar pimer video
 * @param type $form
 * @param type $form_state
 */
function eliminar_primero($form, &$form_state) {
    $filename = VIDEOS_DEFAULT_FILE_PATH . 'videos_recomendados.json';
    if (file_exists($filename)) {
        $videos = recuperar_video();
        unset($videos[0]);
        $videos = array_values($videos);
        unlink($filename);
        file_put_contents($filename, json_encode($videos));
    }
}

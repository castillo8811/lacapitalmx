<?php

/**
 * Función para administrar el ordenamiento de los bloques del home de Adrenalina360
 * Tiene dos submits distintos, el primer botón de submit es para ordenar los bloques: re-setea la variable_set('customhome')
 * El segundo submit hace la función de leer el ordenamiento de los bloques para hacer los queries respectivos y guardar
 * los resultados en ese orden en un archivo .json independiente ubicado en /var/www/html/fem/cache/homeFEM.json
 * @global type $user, lo uso para validar ciertos elementos en el form que serán visibles solo para webmaster
 * @return array $form
 */
function customhome_admin_blocks_form($form, &$form_state, $no_js_use = FALSE) {
//    variable_del('customhome');
//    exit;
    drupal_add_js(drupal_get_path('theme', 'actitudfem') . '/js/jquery-ui.js');
    drupal_add_js(drupal_get_path('module', 'customhome') . '/customhome.js');
    drupal_add_css(drupal_get_path('module', 'customhome') . '/customhome.css');
    global $user;
    $currentblocks = variable_get('customhome', getDefaultBlocks());
    $carruselcortoSub = variable_get('carruselcortoSub');
    $form = array();
    $form['#tree'] = TRUE;
    $form['newblock'] = array(
        '#type' => 'fieldset',
        '#title' => t('Nuevo bloque'),
        '#weight' => 5,
        '#collapsible' => TRUE,
        '#collapsed' => FALSE,
    );
    $form['newblock']["bloque"] = array(
        '#type' => 'textfield',
        '#required' => FALSE,
        '#title' => t("Bloque"),
        '#default_value' => '',
        '#size' => 30,
    );
    $form['newblock']["peso"] = array(
        '#type' => 'select',
        '#title' => t("Posición"),
        '#options' => range(0, 25),
        '#default_value' => 0
    );
    $form['newblock']["status"] = array(
        '#type' => 'checkboxes',
        '#options' => array(1 => t('')),
        '#title' => t('Activo'),
        '#default_value' => 0,
        '#attributes' => array('checked' => 'checked')
    );
    $form['carruselcortoSub'] = array(
        '#type' => 'checkboxes',
        '#options' => array(1 => t('')),
        '#title' => t('Carrusel Corto en Canales'),
        '#default_value' => $carruselcortoSub ? 1 : 0,
        '#attributes' => $carruselcortoSub ? array('checked' => 'checked') : array()
    );
    foreach ($currentblocks as $i => $block) {
        $form['bloque'][$i]['bloque'] = array(
            '#title' => t(''),
            '#type' => 'textfield',
            '#default_value' => $currentblocks ? $block['bloque'] : '',
            '#attributes' => ($user->uid != 1) ? array('readonly' => 'readonly') : array(),
            '#size' => 30,
        );
        $form['bloque'][$i]['peso'] = array(
            '#type' => 'select',
            '#options' => range(0, 25),
            '#default_value' => $currentblocks ? $block['peso'] : ''
        );
        if($block['machinename'] == 'carrusel'){
            $form['bloque'][$i]['tipo'] = array(
                '#type' => 'checkbox',
                '#attributes' => ($block['tipo'] == 0) ? array() : array('checked' => 'checked'),
                '#default_value' => ($block['tipo'] == 0) ? 0 : 1
            );
        }
        $form['bloque'][$i]['status'] = array(
            '#type' => 'checkbox',
            '#attributes' => ($block['status'] == 0) ? array() : array('checked' => 'checked'),
            '#default_value' => ($block['status'] == 0) ? 0 : 1
        );
    }
    $form['newblock']['send'] = array(
        '#type' => 'submit',
        '#value' => 'Agregar bloque',
        '#submit' => array('customhome_admin_newblock_form_submit')
    );
    $form['update'] = array(
        '#type' => 'submit',
        '#value' => 'Actualizar bloques',
        '#submit' => array('customhome_admin_blocks_form_submit_update'),
    );
    if ($user->uid == 1) {
        $form['makehome'] = array(
            '#type' => 'submit',
            '#value' => t('Regenerar HOME'),
            '#submit' => array('customhome_admin_blocks_form_submit_magic'),
        );
        $form['restoreCounterPagerHome'] = array(
            '#type' => 'submit',
            '#value' => t('Actualizar nodos totales Pager Bottom'),
            '#submit' => array('customhome_admin_blocks_form_submit_restoreCounter'),
        );
    }
    return $form;
}

function customhome_admin_blocks_form_submit_restoreCounter($form, &$form_state) {
    variable_del('pager_num_nodes');
    drupal_set_message("Conteo de nodos realizado nuevamente, revise el paginador del home por favor", "warning");
}

function customhome_admin_newblock_form_submit($form, &$form_state) {
    $currentblocks = variable_get('customhome', getDefaultBlocks());
    if ($form_state['values']['newblock']['bloque']) {
        $newblock = array(
            'bloque' => $form_state['values']['newblock']['bloque'],
            'machinename' => strtolower(str_replace(' ', '', $form_state['values']['newblock']['bloque'])),
            'peso' => $form_state['values']['newblock']['peso'],
            'status' => $form_state['values']['newblock']['status'][1],
        );
        array_push($currentblocks, $newblock);
        $currentblocks = arrayCustomOrder($currentblocks, 'peso');
        variable_set("customhome", $currentblocks);
        drupal_set_message("Bloque agregado");
    } else {
        drupal_set_message("Por favor especifique el nombre del bloque", "error");
    }
}

/**
 * Función que hace el submit de la actualización de bloques
 * Lee la variable actual 'customhome' para recuperar los valores de los bloques actuales
 * para posteriormente ordenarlos por peso y re-setear la variable anteriormente descrita
 * @param type $form
 * @param type $form_state 
 */
function customhome_admin_blocks_form_submit_update($form, &$form_state) {
    $currentblocks = variable_get('customhome', getDefaultBlocks());
    foreach ($currentblocks as $key => $bloque) {
        $currentblocks[$key]['bloque'] = $form_state['values']['bloque'][$key]['bloque'];
        $currentblocks[$key]['machinename'] = strtolower(str_replace(' ', '', $form_state['values']['bloque'][$key]['bloque']));
        $currentblocks[$key]['peso'] = $form_state['values']['bloque'][$key]['peso'];
        $currentblocks[$key]['status'] = $form_state['values']['bloque'][$key]['status'];
        if($bloque['machinename'] == 'carrusel'){
            $currentblocks[$key]['tipo'] = $form_state['values']['bloque'][$key]['tipo'];
        }
    }
    $currentblocks = arrayCustomOrder($currentblocks, 'peso');
    if ($currentblocks)
        variable_del("customhome");
    variable_set("customhome", $currentblocks);
    
    variable_del("carruselcortoSub");
    variable_set("carruselcortoSub", $form_state['values']['carruselcortoSub'][1]);
    
    drupal_set_message("Bloques reordenados");
}

/**
 * Función que permite que por medio de un botón se regenere el archivo json que pinta todo el contenido del home Adrenalina360
 * @param type $form
 * @param type $form_state 
 */
function customhome_admin_blocks_form_submit_magic($form, &$form_state) {
    $items = array();
    $data = array();
    $file = '/srv/data/files/cache/fem/homeFEM.json';
    $currentblocks = variable_get('customhome', getDefaultBlocks());
    $notesGroup = 0;
    foreach ($currentblocks as $key => $block) {
        if ($block['status'] == 1) {
            $function = is_callable('get_' . $block['machinename']) ? 'get_' . $block['machinename'] : NULL;
            $data = $function ? call_user_func($function) : array();
            if (count($data)) {
                if (($block['machinename'] == 'notas')) {
                    $items['notas-' . $notesGroup] = $data[$notesGroup];
                    $currentblocks[$key]['posicion'] = $notesGroup;
                    variable_set('imx_magichome', $currentblocks);
                    $notesGroup++;
                } else {
                    $items[$block['machinename']] = $data;
                }
            }
        }
    }
    if (count($items) > 0) {
        unlink($file);
        file_put_contents($file, json_encode($items));
        echo json_encode($items);
        unset($items, $data);
        drupal_set_message("Home actualizado");
        return;
    }
}

function customhome_admin_blocks_form_alter(&$form, &$form_state, $form_id) {
    $form['#theme'] = array('customhome_admin_blocks_form');
}
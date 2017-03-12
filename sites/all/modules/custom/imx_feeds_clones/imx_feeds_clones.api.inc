<?php

/**
 * Trae la vista de datos desde el módulo Views, previamente creada.
 */
function imx_feeds_clones_list($view_name = NULL, $type = 'stage', $source = '') {
    if (!$view_name || !$type)
        return NULL;
    //Execute dynamically functions
    if (!$source) {
        $return = call_user_func('imx_feeds_clones' . '_' . $type, $view_name);
    } else {
        $return = call_user_func('imx_feeds_clones' . '_' . $type . '_' . $source, $view_name);
    }
    echo json_encode($return);
    exit;
}

function imx_feeds_clones_stage_excelsior($view_name = NULL) {
    if (!$view_name)
        return NULL;
    var_dump($view_name);
    exit;

    $view = views_get_view($view_name, $display_id = 'Master');
    $view->preview($display_id);
    $view = $view->result;
    $items = array();
    foreach ($view as $node) {
        $items[] = array(
            'id' => $node->_field_data['nid']['entity']->nid,
            'titulo' => $node->_field_data['nid']['entity']->title,
            'tipo_contenido' => $node->_field_data['nid']['entity']->type,
            'fecha_publicacion' => date('Y-m-d H:i:s', $node->_field_data['nid']['entity']->created),
            'section' => array(
                'tid' => $node->taxonomy_term_data_node_tid,
                'name' => $node->taxonomy_term_data_node_name,
                'url' => url(drupal_get_path_alias('taxonomy/term/' . $node->taxonomy_term_data_node_tid), array('absolute' => true)),
            ),
            'contenido' => $node->_field_data['nid']['entity']->body['und']['0']['safe_value'],
            'sumario' => $node->_field_data['nid']['entity']->body['und']['0']['safe_summary'],
            'autor' => $node->_field_data['nid']['entity']->name,
            'video' => imx_feeds_clones_get_video($node->field_field_video),
            'url' => url(drupal_get_path_alias('node/' . $node->nid), array('absolute' => true)),
            'imagen_nota' => imx_feeds_clones_get_image_style($node, 'large_mobile'),
            'imagen_media' => imx_feeds_clones_get_image_style($node, 'medium_mobile'),
            'imagen_thumb' => imx_feeds_clones_get_image_style($node, 'thumb_mobile'),
            'galeria' => imx_feeds_clones_get_galleries($node->field_field_images),
        );
    }

    if ($_SERVER['HTTP_HOST'] === 'corazonolimpico.excelsior.com.mx') {
        $items[] = imx_feed_get_html_block('medallero');
    }

    return($items);
    unset($items);
}

function imx_feeds_clones_stage($view_name = NULL) {
    if (!$view_name)
        return NULL;

    $view = views_get_view($view_name, $display_id = 'default');
    $view->preview('default');
    $view = $view->result;
    $items = array();
    foreach ($view as $node) {
        $items[] = array(
            'id' => $node->_field_data['nid']['entity']->nid,
            'titulo' => $node->_field_data['nid']['entity']->title,
            'tipo_contenido' => $node->_field_data['nid']['entity']->type,
            'fecha_publicacion' => date('Y-m-d H:i:s', $node->_field_data['nid']['entity']->created),
            'section' => array(
                'tid' => $node->taxonomy_term_data_node_tid,
                'name' => $node->taxonomy_term_data_node_name,
                'url' => url(drupal_get_path_alias('taxonomy/term/' . $node->taxonomy_term_data_node_tid), array('absolute' => true)),
            ),
            'galeria' => imx_feeds_clones_get_galleries($node->field_field_images),
        );
    }

    if ($_SERVER['HTTP_HOST'] === 'corazonolimpico.excelsior.com.mx') {
        $items[] = imx_feed_get_html_block('medallero');
    }

    return($items);
    unset($items);
}

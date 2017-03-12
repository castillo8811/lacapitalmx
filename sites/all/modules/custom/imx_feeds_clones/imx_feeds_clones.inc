<?php

/**
 * Trae la vista de datos desde el módulo Views, previamente creada.
 */
function imx_feeds_clones_list($old_view_name = NULL, $type = 'stage') {
    if (!$type)
        return NULL;
    
    $return = imx_feeds_clones_stage('stage_carrusel');
    echo json_encode($return);
    exit;
}

function imx_feeds_clones_stage($view_name = NULL) {
    if (!$view_name)
        return NULL;
    $view = views_get_view($view_name, $display_id = 'default');
    $view->preview('default');
    $view = $view->result;
    $items = array();
    foreach ($view as $node) {
        if($_SERVER['HTTP_HOST'] == 'www.estrategia45.com' || $_SERVER['HTTP_HOST'] == 'local.estrategia45.com' || $_SERVER['HTTP_HOST'] == 'gim-e45.jediteam.mx'){
            $exp = imx_feeds_clones_info_expert($node->_field_data['nid']['entity']->nid);
        }
        $body = $node->_field_data['nid']['entity']->body['und'][0]['safe_value'];
        $summary = $node->_field_data['nid']['entity']->body['und'][0]['safe_summary'];
        $items[] = array(
            'id' => $node->_field_data['nid']['entity']->nid,
            'titulo' => $node->_field_data['nid']['entity']->title,
            'experto' => array(
                'uid' => $exp[0]['uid'],
                'name' => $exp[0]['name'],
                'currentjob' => $exp[0]['currentjob'],
                'resena' => $exp[0]['resena'],
                'image' => image_style_url('avatar', $exp[0]['imagen']),
                'imagevertical' => image_style_url('vertical', $exp[0]['imagen']),
                'imagesquare' => image_style_url('square_thumbnail', $exp[0]['imagen'])
            ),
            'tipo_contenido' => $node->_field_data['nid']['entity']->type,
            'fecha_publicacion' => date('Y-m-d H:i:s', $node->_field_data['nid']['entity']->created),
            'section' => array(
                'tid' => $node->taxonomy_term_data_node_tid,
                'name' => $node->taxonomy_term_data_node_name,
                'url' => url(drupal_get_path_alias('taxonomy/term/' . $node->taxonomy_term_data_node_tid), array('absolute' => true)),
            ),
            'contenido' => $body,
            'sumario' => (trim(strip_tags($summary)) !== '' ? strip_tags($summary) : trunc(strip_tags($body), 50)),
            'autor' => $node->_field_data['nid']['entity']->name,
            'video' => imx_feeds_clones_get_video($node->field_field_video),
            'url' => url(drupal_get_path_alias('node/' . $node->nid), array('absolute' => true)),
            'imagen_nota' => imx_feeds_clones_get_image_style($node, 'large_mobile'),
            'imagen_media' => imx_feeds_clones_get_nodeimage_wide($node),
            'imagen_thumb' => imx_feeds_clones_get_image_style($node, 'thumb_mobile'),
            'imagen_feed' => imx_feeds_clones_get_image_style($node, 'wide_feed'), //Estilo existen unicamente en e45 por el momento
            'galeria' => imx_feeds_clones_get_galleries($node->field_field_images),
        );
    }
    return($items);
    unset($items);
}

function imx_feed_get_tips($limit = 1) {
    $view = views_get_view('feed', $display_id = 'page_tips');
    $view->preview('page_tips');
    $view = $view->result;
    $items = array();
    $index = 0;
    foreach ($view as $node) {
        $index++;
        $user = user_load($node->_field_data['nid']['entity']->field_userreference['und']['0']['uid']);
        $items[] = array(
            'titulo' => $node->_field_data['nid']['entity']->body['und']['0']['safe_value'],
            'fecha_publicacion' => date('Y-m-d H:i:s', $node->_field_data['nid']['entity']->created),
            'autor' => $user->name,
            'foto' => $user->picture,
        );
        if ($index == $limit)
            break;
    }
    return $items;
}
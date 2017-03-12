<?php

function get_nodes_event($nid) {
    $entities = db_select("field_data_field_evento_relacionado", "er");
    $entities->extend('PagerDefault');
    $entities->innerJoin("node", "n", "er.entity_id=n.nid");
    $entities->fields("n", array("title","nid"));
    $entities->condition("n.status",1, "=");
    $entities->condition("er.field_evento_relacionado_nid",$nid, "=");
    $entities->range(0,3);
    $entities->orderBy("created", "DESC");
    return $entities->execute()->fetchAll();
}
function getSubCategoriesByTid($tid = 100, $limit = 3) {
    $entities = db_select("taxonomy_term_hierarchy", "th");
    $entities->extend('PagerDefault');
    $entities->innerJoin("taxonomy_term_data", "td", "td.tid=th.tid");
    $entities->innerJoin("field_data_field_is_submenu", "sm", "sm.entity_id=th.tid");
    $entities->fields("th", array("tid", "parent"));
    $entities->fields("td", array("name"));
    $entities->condition("th.parent", $tid, "=");
    $entities->condition("sm.field_is_submenu_value",1, "=");
    $entities->range(0, $limit);
    $entities->orderBy("name", "asc");
    $entities->orderBy("weight", "desc");
    return $entities->execute()->fetchAll();
}

function getTagsRelatedByTid($tid = 100, $limit = 3) {
    $query = db_select("field_data_field_categoria_relacionada", "cr");
    $query->extend('PagerDefault');
    $query->innerJoin("taxonomy_term_data", "td", "cr.entity_id=td.tid");
    $query->condition("field_categoria_relacionada_tid", $tid, "=");
    $query->fields("td", array("name", "tid"));
    $query->range(0, $limit);
    $query->orderBy("name");
    $query->orderBy("weight", "desc");
    return $query->execute()->fetchAll();
}

function getMenuLinks() {
    $items = array();
    $data = cache_get("garuyo_menu_links");
    if ($data) {
        $items = $data->data;
    } else {
//        $menu_time_cache = mktime(date("H"), date("i"), date("s"), date('m'), date('d') , date('Y'));
        $query = new EntityFieldQuery();
        $entities = $query->entityCondition('entity_type', 'taxonomy_term')
                ->entityCondition('bundle', 'categorias')
                ->fieldCondition('field_is_menu', 'value', 1, '=')
                ->fieldOrderBy("field_peso_menu", "value")
                ->execute();
        $values = array_values($entities["taxonomy_term"]);

        foreach ($values as $e) {
            $t = taxonomy_term_load($e->tid);
            $items[] = array("title" => $t->name, "path" => "taxonomy/term/" . $t->tid, "tid" => $t->tid);
        }
        if (count($items)) {
            cache_set("garuyo_menu_links", $items, "cache");
        }
    }
    return $items;
}

function getVectorLinks($object_taxonomy_term) {
    $items = array();
    foreach ($object_taxonomy_term as $o) {
        $items[] = array("title" => $o->name, "path" => "taxonomy/term/" . $o->tid, "tid" => $o->tid);
    }
    return $items;
}

function getParentsOrRelated($taxonomy_objetc) {
    $tid = "";
    $parent = array_values(taxonomy_get_parents($taxonomy_objetc->tid));
    if (count($parent)) { //si es un submenu ejemplo baladas
        $tid = $parent[0]->tid;
    }
    $parent_tag = get_object_vars($taxonomy_objetc);
    if (array_key_exists("field_categoria_relacionada", $parent_tag)) { //si es un tag 
        $parent_t = $parent_tag["field_categoria_relacionada"]["und"][0]["tid"];
        $tid = $parent_t;
    }
    return $tid;
}
function getParentsOfTaxonomy($term_id=0) {
   $tid =$term_id;
    $parent = array_values(taxonomy_get_parents($term_id));
    if (count($parent)) { //si es un submenu ejemplo baladas
        $tid = ($parent[0]->tid)? $parent[0]->tid : $term_id ;
    }      
    return $tid;
}

function getVideoEmbedInventPlay(){
      drupal_add_css(drupal_get_path('module', 'imx_videonota') . "/css/imx_videonota_channel.css");

      $content = '';
      $data_first = array();
      $data = array();
      $path = arg();
      $series_vid = NULL;

      // Obtener el vocabulario.
      $series_vid = imx_videonota_get_id_vocabulary();
      $q = drupal_get_query_parameters();
      if ($path[0] == 'taxonomy' && $path[1] == 'term' && is_numeric($path[2])) {
        if ($taxonomy = taxonomy_term_load($path[2])) {
          if ($taxonomy->vid == $series_vid) {
            $imx_videonota_config = imx_videonota_get_config();
            if (!isset($q['page'])) {
              // Sin paginador.
              $taxonomy_formated = imx_videonota_get_taxonomy_formated($taxonomy);
              $content = array(
                '#taxonomy' => $taxonomy_formated,
                '#data' => $data,
                '#title' => $taxonomy->name,
                '#theme' => 'imx_videonota_channel',
              );
              $options = array(
                'tid' => $taxonomy->tid,
                'vid' => $taxonomy->vid,
                'type' => array($imx_videonota_config['type']),
              );
              $options_node = array(
                'image_style' => $imx_videonota_config['style_channel_first'],
                'image_default' => $imx_videonota_config['field_image'],
              // Campo de imagen default.
              );
              $nids = imx_videonota_get_recent_nodes($options, $offset = 0, $limit =1);
              if ($nids && count($nids) > 0) {
                foreach ($nids as $key => $nid) {
                  $node = node_load($nid['nid']);
                  if ($key == 0) {
                    $node_data_formated = imx_videonota_get_node_data_formated($node, $options_node);
                    if (isset($node_data_formated['youtube_id'])) {
                      $node_data_formated['image_youtube'] = 'http://img.youtube.com/vi/' . $node_data_formated['youtube_id'] . '/hqdefault.jpg';
                    }
                    $data[] = $node_data_formated;
                  }
                  else {
                    $options_node['image_style'] = $imx_videonota_config['style_channel'];
                    $node_data_formated = imx_videonota_get_node_data_formated($node, $options_node);
                    if (isset($node_data_formated['youtube_id'])) {
                      $node_data_formated['image_youtube'] = 'http://img.youtube.com/vi/' . $node_data_formated['youtube_id'] . '/mqdefault.jpg';
                    }
                    $data[] = $node_data_formated;
                  }
                }
                $data = array_merge($data_first, $data);
                // seo.
                $tags = array(
                  array(
                    'meta' => array(
                      'property' => 'og:image',
                      'content' => $taxonomy_formated['image_channel_url'],
                    ),
                  ),
                  array(
                    'meta' => array(
                      'property' => 'og:description',
                      'content' => truncate_utf8(strip_tags($taxonomy_formated['description']), 80, FALSE, TRUE, 5),
                    ),
                  ),
                  array(
                    'meta' => array(
                      'name' => 'description',
                      'content' => truncate_utf8(strip_tags($taxonomy_formated['description']), 80, FALSE, TRUE, 5),
                    ),
                  ),
                );
                imx_videonota_create_html_tag($tags, 'series');
                // Reasignamos la variable con datos.
                $content['#data'] = $data;
              }
            }
            else {
              // Con paginador.
              $title_count = 100;
              // Palabras en título
              $options = array(
                'tid' => $taxonomy->tid,
                'vid' => $taxonomy->vid,
                'title' => $taxonomy->name,
                'theme' => 'imx_videonota_channel_list',
                'image_style' => $imx_videonota_config['style_list'],
                'image_default' => $imx_videonota_config['field_image'],
                'title_count' => $title_count,
                'pager_default' => 'PagerVideoNotas',
                'type' => array($imx_videonota_config['type']),
              );
              $pager_options = array(
                'pager' => TRUE,
                  // 'up' => true,
                'down' => TRUE,
              );
              $content = imx_videonota_get_recent_nodes($options, $offset = 0, $limit = 10, $pager_options);
            }
          }
        }
      }
//      $block['subject'] = t('Muestra bloque portada de serie por canal');
      return $content;
}
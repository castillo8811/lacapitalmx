<?php

function transfer_image_remote($image)
{
    $url = $image["src"];
    $ch = curl_init($url);
    $realpath = FALSE;
    $uri = NULL;
    $file = NULL;
    $filename = basename($url);
    if ($wrapper = file_stream_wrapper_get_instance_by_uri('public://')) {
        $realpath = $wrapper->realpath();
    }
    $realpath = drupal_realpath(file_default_scheme() . '://') . "/";
    if ($realpath) {
        $fp = fopen($realpath . $filename, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        $uri = "public://" . $filename;
        $handle = fopen($realpath . $filename, 'r');
        $file = file_save_data($handle, $uri, FILE_EXISTS_RENAME);
        $file->status = 0;
        file_save($file);
        fclose($handle);
    }

    return $file;
}

function getNodeAPIType($node)
{
    switch ($node['tipo']) {
        case "Articulo" :
            $type = IMX_GCMS_CONTENT_ARTICLE;
            break;
        case "Galeria" :
            $type = IMX_GCMS_CONTENT_GALLERIE;
            break;
        case "Video" :
            $type = IMX_GCMS_CONTENT_VIDEO;
            break;

        default:
            $type = IMX_GCMS_CONTENT_ARTICLE;
            break;
    }

    return $type;
}


function imx_gcms_insert_history_import($field = array())
{
    //Buscar NID previo si existe actualizar campos, sino insertar
    $result = db_select('imx_gcms_imports_history', 'n')
        ->fields('n')
        ->condition('id_source', $field['id_source'], '=')
        ->condition('site_src', $field['site_src'], '=')
        ->execute()
        ->fetchAssoc();
    if (!$result) {
        $result = db_insert('imx_gcms_imports_history')
            ->fields(array(
                'id_source' => $field['id_source'],
                'id_dst' => $field['id_dst'],
                'uid' => $field['uid'],
                'site_src' => $field['site_src'],
                'created' => $field['created'],
            ))
            ->execute();
    }

    if (!$result)
        return FALSE;

    return TRUE;
}


function imx_gcms_check_item_import($id_source, $site_src)
{
    if (!is_numeric($id_source)) {
        $id_source = crc32($id_source);
    }    //Buscar NID previo si existe actualizar campos, sino insertar
    $result = db_select('imx_gcms_imports_history', 'n')
        ->fields('n')
        ->condition('id_source', $id_source, '=')
        ->condition('site_src', $site_src, '=')
        ->execute()
        ->fetchAssoc();
    if (!$result) {
        return FALSE;
    } else {
        return $result["id_dst"];
    }
}


function getGCMSRelateds()
{
    $nodes = FALSE;
    $node = menu_get_object();
    $relacionados_sindicados = FALSE;

    if (variable_get("imx_gcms_field_relateds", FALSE)) {
        if (field_info_instance('node', variable_get("imx_gcms_field_relateds"), $node->type)) {
            $relacionados_sindicados = field_get_items('node', $node, variable_get("imx_gcms_field_relateds"));
        }
    }

    if ($relacionados_sindicados) {
        $nodes = array();
        foreach ($relacionados_sindicados as $item) {
            $title_field = variable_get("imx_gcms_field_relateds_title", FALSE);
            $url_field = variable_get("imx_gcms_field_relateds_url", FALSE);
            $fc = field_collection_item_load($item["value"]);
            if ($title_field && $url_field) {
                if (isset($fc->{$title_field}["und"][0]["value"]) && isset($fc->{$url_field}["und"][0]["value"])) {
                    $nodes[] = array(
                        'nid' => FALSE,
                        'title' => $fc->{$title_field}["und"][0]["value"],
                        'type' => FALSE,
                        'url' => $fc->{$url_field}["und"][0]["value"],
                        'image_uri' => FALSE,
                        'gcms' => TRUE,
                    );
                }
            }
        }
    }

    return $nodes;
}

function isSiteExternal($sitename)
{
    $external = false;
    $sites_cache = cache_get("imx_api_sites_cache_external");
    if ($sites_cache) {
        $sites = $sites_cache->data;
    } else {
        $sites = getAPISites(true, true);
    }
    $sites = array_flip($sites);
    foreach ($sites as $site) {
        if ($site == $sitename) {
            $external = true;
            break;
        }

    }

    return $external;
}

function getGCMSRssRelateds($node_object, $limit)
{
    if (isset($node_object->field_gcms_site_source)) {
        $site_src = $node_object->field_gcms_site_source["und"][0]['value'];
        if (isSiteExternal($site_src)) {
            $cache_data = cache_get("imx_gcms_{$node_object->nid}_relateds");
            if (!$cache_data) {
                $relateds = array();
                $external_contents = getAPISiteRepoContents($site_src, "nodes");
                if (count($external_contents)) {
                    $external_contents = array_slice($external_contents, 0, $limit);
                    foreach ($external_contents as $et) {
                        if ($node_object->title != $et['title']) {
                            $url = $et["url"];
                            $url = $url . "?gcms_source=true&gcms_site_origin=" . $_SERVER["HTTP_HOST"];
                            $relateds[] = array("title" => $et["title"], "url" => $url);
                        }
                    }
                    cache_set("imx_gcms_{$node_object->nid}_relateds", $relateds, 'cache', strtotime("+8 hours"));
                    return $relateds;
                }
            } else {
                return $cache_data->data;
            }
        }
    } else {
        return false;
    }
}


function getFeedContents($site, $search)
{

    $feed_url="http://{$site}/json-feed/{$search}";
    print_r($feed_url);
    $contents = file_get_contents($feed_url);
    $contents = json_decode($contents, true);

    if (count($contents["nodes"])) {
        foreach ($contents["nodes"] as $node) {
            if (true) {
                $nodes[] = $node['node'];
            }
        }
    }

    return $nodes;
}


function getFeedContent($site, $id)
{
    $site=getSite($site);
    $contents = file_get_contents("http://{$site}/json-feed/node/" . $id);
    $contents = json_decode($contents, true);
    $nodes = array();
    if (count($contents["nodes"])) {
        foreach ($contents["nodes"] as $node) {
            if (true) {
                $nodes[] = $node['node'];
            }
        }
    }

    return $nodes[0];
}

function getSite($ciudad){
    $sites=getSites();

    return $sites[$ciudad];
}

function getSiteByDns($dns){
    $sites=array_flip(getSites());
    return $sites[$dns];
}

function getSites(){
    $sites=array(
        'ElQueretanoMx'=>'www.elqueretano.mx',
        'LaCapitalMx'=>'www.lacapitalmx.com',
        'ElMexiquense'=>'www.elmexiquense.com.mx'
    );

    return $sites;
}
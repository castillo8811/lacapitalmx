<?php

/*
 * Queries utilizados por imx_ads
 */


/* Funcion que devuelve todas las regiones de un tema
 * @arguments string $theme nombre del tema
 * @return array con regiones
 *
 */

function getAllRegions($theme = "")
{
    $theme   = NULL;
    $regions = system_region_list(getThemeActive(), REGIONS_VISIBLE);
    return $regions;
}

/**
 * @arguments string $machine_name: taxonomy machinename
 * @return array con taxonomias
 */
function get_taxonomy_term_options($machine_name, $add_todos)
{
    $machine_name   = variable_get("imx_ads_vocabulary", "categorias");
    $vid            = taxonomy_vocabulary_machine_name_load($machine_name)->vid;
    $options_source = taxonomy_get_tree($vid);
    foreach ($options_source as $item) {
        $key = $item->tid;
        if (!$item->depth) {
            $value             = $item->name;
            $options["{$key}"] = $value;
        }
    }

    if ($add_todos) {
        $options["<front>"] = "Home";
    }

    ksort($options);

    return $options;
}

function getTaxonomyTree($machine_name)
{
    $machine_name   = variable_get("imx_ads_vocabulary", "categorias");
    $vid            = taxonomy_vocabulary_machine_name_load($machine_name)->vid;
    $options_source = taxonomy_get_tree($vid);

    return $options_source;
}

function get_conditions_options()
{
    return array(0 => "Todas los canales excepto las que se enumeran", 1 => "Sólo los canales enumeradas");
}

/**
 * Funcion para el autocomplete de nodos
 * autocomplete helper
 * $string = string for search
 */
function imx_ads_node_autocomplete($string)
{
    $matches = array();
    $result  = db_select('node', 'n')
        ->fields('n', array('title', 'created'))
        ->condition('title', '%' . db_like($string) . '%', 'LIKE')
        ->condition('status', 1, '=')
        ->orderBy("created", "DESC")
        ->range(0, 20)
        ->execute();

    // save the query to matches
    foreach ($result as $row) {
        $matches[$row->title] = "<span style:'font-size:5px;'>" . date("Y-m-d H:i:s", $row->created) . "</span> - " . check_plain($row->title);
    }

    // Return the result to the form in json
    drupal_json_output($matches);
}

/**
 * Funcion para el autocomplete de nodos
 * autocomplete helper
 * $string = string for search
 */
function nid_by_title($string)
{
    $node   = NULL;
    $result = db_select('node', 'n')
        ->fields('n', array('nid', 'title'))
        ->condition('title', $string, '=')
        ->execute();

    // save the query to matches
    foreach ($result as $row) {
        $node = $row->nid;
    }

    // Return the result to the form in json
    return $node;
}

/*
 * Devuelve los tipos de contenidos disponibles en el sitios
 *
 */

function getNodeTypes()
{
    $nt    = array();
    $types = node_type_get_types(TRUE);
    foreach ($types as $t) {
        if (!$t->disabled)
            $nt[$t->type] = $t->name;
    }

    return $nt;
}

/* Funcion de guardado del bloque hacia imx_ads y drupal blocks */

function save_block($block_data)
{
    $block       = FALSE;
    $nt          = array();
    $values      = array();
    $transaction = db_transaction();
    try {
        if (!blockExist($block_data["block"]["name"])) {
            //Execucion de Block node types
            $query_insert = db_insert('block_node_type')
                ->fields(array('module', 'delta', 'type'));

            foreach ($block_data["types"] as $key => $type) {
                if ($type) {
                    $nt[]   = $type;
                    $values = array(
                        'module' => 'imx_ads',
                        'delta'  => $block_data["block"]["name"],
                        'type'   => $key,
                    );

                    $query_insert->values($values);
                }
            }
            $adBlock = db_insert('imx_ads_blocks')
                ->fields(array(
                    'fid'                  => $block_data["block"]["fid"],
                    'title'                => $block_data["block"]["name"],
                    'block_info'           => $block_data["block"]["info"],
                    'sec'                  => $block_data["block"]["sec"],
                    'ss'                   => $block_data["block"]["ss"],
                    'display_condition'    => $block_data["condition"],
                    'tids'                 => $block_data["tids"],
                    'tags'                 => $block_data["tags_titles"],
                    'subcanals'            => $block_data["subcanales"],
                    'node_tags'            => $block_data["node_tags"],
                    'node_subcanals'       => $block_data["node_subcanales"],
                    'canales'              => $block_data["canales"],
                    'nids'                 => $block_data["nids"],
                    'custom_pages'         => $block_data["custom_pages"],
                    'cxwh'                 => $block_data["block"]["cxwh"],
                    'cxinicial_vh'         => $block_data["block"]["cxinicial_vh"],
                    'region'               => $block_data["block"]["region"],
                    'nodes'                => $block_data["nodes"],
                    'pages'                => $block_data["pages"],
                    'file_id'              => $block_data["block_image"],
                    "image_uri"            => $block_data["image_uri"],
                    'types'                => implode("|", $nt),
                    'status'               => $block_data["block"]["status"],
                    'async'               => $block_data["block"]["async"],
                    'uid'                  => 1,
                    'link_info'            => $block_data["block"]["link"],
                    'created'              => time(),
                    'exclusive'            => $block_data["block"]["exclusive"],
                    'custom_pages_exclude' => $block_data["block"]["custom_pages_exclude"],
                    "img_url"              => $block_data["img_url"],
                    "invoque_id"           => $block_data["block"]["invoque_id"],

                ))
                ->execute();

            if ($adBlock) {

                $block = db_insert('block')
                    ->fields(array(
                        'module'     => "imx_ads",
                        'delta'      => $block_data["block"]["name"],
                        'theme'      => $block_data["block"]["theme"],
                        'status'     => 1,
                        'weight'     => 1,
                        'region'     => $block_data["block"]["region"],
                        'custom'     => 0,
                        'visibility' => 1,
                        'pages'      => $block_data["pages"],
                        'title'      => "<none>",
                        'cache'      => 0
                    ))
                    ->execute();

                //Insercion de block en tipos de contenido
                $query_insert->execute();

                $domain_blocks = hasDomainBlocks();
                if ($domain_blocks) {
                    $sites        = $block_data["sites"];
                    $query_insert = db_insert('domain_blocks')
                        ->fields(array('module', 'delta', 'realm', 'domain_id'));
                    foreach ($sites as $site_id) {
                        $values = array(
                            'module'    => 'imx_ads',
                            'delta'     => $block_data["block"]["name"],
                            'realm'     => 'domain_id',
                            'domain_id' => $site_id,
                        );

                        $query_insert->values($values);
                    }
                    $query_insert->execute();
                }
            }
            db_delete("cache")
                ->condition("cid", db_like("imx_ads") . '%', 'LIKE')
                ->execute();
        } else {
            drupal_set_message(t('Ya existe un bloque con ese nombre. ' . $block_data["block"]["name"]), "error");
        }
    }
    catch (Exception $e) {
        $transaction->rollback();
        watchdog_exception('block', $e);
        throw $e;
    }

    return $adBlock;
}

/* FUncion de actualizacion de un bloque hacia imx_ads_blocks y drupal blocks */

function update_block($block_data)
{
    $block  = FALSE;
    $nt     = array();
    $values = array();

    $transaction = db_transaction();
    try {

        db_delete("block_node_type")
            ->condition("delta", $block_data["block"]["old_name"])
            ->execute();

        //Borramos registros del bloque asociados a otro tema
        db_delete("block")
            ->condition("theme", $block_data["block"]["theme"], "!=")
            ->condition("delta", $block_data["block"]["old_name"])
            ->execute();

        db_delete("block")
            ->condition("theme", $block_data["block"]["theme"], "!=")
            ->condition("delta", $block_data["block"]["name"])
            ->execute();


        if (hasDomainBlocks()) {
            db_delete("domain_blocks")
                ->condition("delta", $block_data["block"]["name"])
                ->execute();
        }

        $query_insert = db_insert('block_node_type')
            ->fields(array('module', 'delta', 'type'));

        foreach ($block_data["types"] as $key => $type) {
            if ($type) {
                $nt[]   = $type;
                $values = array(
                    'module' => 'imx_ads',
                    'delta'  => $block_data["block"]["name"],
                    'type'   => $key,
                );

                $query_insert->values($values);
            }
        }
        $adBlock = db_update('imx_ads_blocks')
            ->fields(array(
                'fid'                  => $block_data["block"]["fid"],
                'title'                => $block_data["block"]["name"],
                'block_info'           => $block_data["block"]["info"],
                'sec'                  => $block_data["block"]["sec"],
                'ss'                   => $block_data["block"]["ss"],
                'display_condition'    => $block_data["condition"],
                'tids'                 => $block_data["tids"],
                'tags'                 => $block_data["tags_titles"],
                'subcanals'            => $block_data["subcanales"],
                'node_tags'            => $block_data["node_tags"],
                'node_subcanals'       => $block_data["node_subcanales"],
                'canales'              => $block_data["canales"],
                'nids'                 => $block_data["nids"],
                'custom_pages'         => $block_data["custom_pages"],
                'cxwh'                 => $block_data["block"]["cxwh"],
                'cxinicial_vh'         => $block_data["block"]["cxinicial_vh"],
                'region'               => $block_data["block"]["region"],
                'nodes'                => $block_data["nodes"],
                'pages'                => $block_data["pages"],
                'file_id'              => $block_data["block_image"],
                "image_uri"            => $block_data["image_uri"],
                'types'                => implode("|", $nt),
                'status'               => $block_data["block"]["status"],
                'async'               => $block_data["block"]["async"],
                'uid'                  => 1,
                'link_info'            => $block_data["block"]["link"],
                'created'              => time(),
                'exclusive'            => $block_data["block"]["exclusive"],
                'custom_pages_exclude' => $block_data["block"]["custom_pages_exclude"],
                "img_url"              => $block_data["block"]["img_url"],
                "invoque_id"              => $block_data["block"]["invoque_id"],

            ));
        $adBlock->condition("bid", $block_data["block"]["bid"])->execute();


        if ($adBlock) {

            $block = db_update('block')
                ->fields(array(
                    'module'     => "imx_ads",
                    'delta'      => $block_data["block"]["name"],
                    'status'     => 1,
                    'region'     => $block_data["block"]["region"],
                    'theme'      => $block_data["block"]["theme"],
                    'custom'     => 0,
                    'visibility' => $block_data["condition"],
                    'pages'      => $block_data["pages"],
                    'title'      => "<none>",
                    'cache'      => 1
                ));
            $block->condition("delta", $block_data["block"]["old_name"])->execute();

            //Insercion de block en tipos de contenido
            $query_insert->execute();

            //Validamo la existencia del modulo domain_blocks (salud180 hasta ahora)
            $domain_blocks = hasDomainBlocks();
            if ($domain_blocks) {
                $sites        = $block_data["sites"];
                $query_insert = db_insert('domain_blocks')
                    ->fields(array('module', 'delta', 'realm', 'domain_id'));
                foreach ($sites as $site_id) {
                    $values = array(
                        'module'    => 'imx_ads',
                        'delta'     => $block_data["block"]["name"],
                        'realm'     => 'domain_id',
                        'domain_id' => $site_id,
                    );

                    $query_insert->values($values);
                }
                $query_insert->execute();
            }
        }

        db_delete("cache")
            ->condition("cid", db_like("imx_ads") . '%', 'LIKE')
            ->execute();
    }
    catch (Exception $e) {
        $transaction->rollback();
        watchdog_exception('block', $e);
        throw $e;
    }

    //Limpiamos la cache del modulo para evitar problemas


    return $adBlock;
}

function delete_block($name)
{
    $success     = FALSE;
    $transaction = db_transaction();
    try {

        db_delete("block_node_type")
            ->condition("delta", $name)
            ->execute();

        db_delete('imx_ads_blocks')
            ->condition("title", $name)->execute();

        db_delete('block')
            ->condition("delta", $name)->execute();

        db_delete("cache")
            ->condition("cid", db_like("imx_ads") . '%', 'LIKE')
            ->execute();

        $success = TRUE;
    }
    catch (Exception $e) {
        $transaction->rollback();
        watchdog_exception('block', $e);
        throw $e;
    }

    return $success;
}

/*
 * Guarda un Framework de Ads
 * @arguments $data Array con los datos del Framework
 */

function imx_ads_framework_save($data)
{
    $framework   = FALSE;
    $transaction = db_transaction();
    try {
        $framework = db_insert('imx_ads_frameworks')
            ->fields(array(
                'name'        => $data["name"],
                'sid'         => $data["sid"],
                'sec'         => $data["sec"],
                'ss'          => $data["ss"],
                'user'        => $data["user"],
                'password'    => $data["password"],
                'account'     => $data["account"],
                'site_id'     => $data["site_id"],
                'script_url'  => $data["script"],
                'domain_name' => $data["domain_name"],
            ));
        $framework->execute();
    }
    catch (Exception $e) {
        $transaction->rollback();
        watchdog_exception('block', $e);
        throw $e;
    }
}

function imx_ads_framework_update($data)
{
    $framework   = FALSE;
    $transaction = db_transaction();
    try {
        $framework = db_update('imx_ads_frameworks')
            ->fields(array(
                'name'        => $data["name"],
                'sid'         => $data["sid"],
                'sec'         => $data["sec"],
                'ss'          => $data["ss"],
                'script_url'  => $data["script"],
                'password'    => $data["password"],
                'account'     => $data["account"],
                'user'        => $data["user"],
                'site_id'     => $data["site_id"],
                'script_url'  => $data["script"],
                'domain_name' => $data["domain_name"],
            ));
        $framework->condition("fid", $data["fid"]);
        $framework->execute();
    }
    catch (Exception $e) {
        $transaction->rollback();
        watchdog_exception('block', $e);
        throw $e;
    }
    return $framework;
}

function imx_ads_framework_ss_save($data)
{
    $framework = FALSE;
    $query     = db_select('imx_ads_frameworks', 'f')
        ->fields('f', array('ss'))
        ->condition('fid', 1);

    $result = $query->execute()->fetchAll();
    $ss     = explode("|", $result[0]->ss);
    $ss[]   = $data["ss"];
    array_unique($ss);
    $transaction = db_transaction();
    try {
        $framework = db_update('imx_ads_frameworks')
            ->fields(array(
                'ss' => implode("|", $ss),
            ));
        $framework->condition("fid", 1);
        $framework->execute();
    }
    catch (Exception $e) {
        $transaction->rollback();
        watchdog_exception('block', $e);
        throw $e;
    }
}

/*
 * Devuelve un listado de blocks por region en imx_ads_blocks
 * @arguments $region Region a consultar
 */

function getBlockByRegion($region)
{

    $query = db_select("imx_ads_blocks", "ab");
    $query->condition("ab.region", $region, "=");
    $query->addField("ab", "title");
    $query->addField("ab", "fid");
    $query->addField("ab", "status");
    $query->addField("ab", "async");
    $query->addField("ab", "block_info");
    $query->addField("ab", "region");
    $query->addField("ab", "invoque_id");
    $query->addField("ab", "bid");
    $result = $query->execute()->fetchAll();

    $blocks = array();
    if ($result) {
        foreach ($result as $i => $r) {
            $blocks[$i]["bid"]        = $r->bid;
            $blocks[$i]["title"]      = $r->title;
            $blocks[$i]["fid"]        = $r->fid;
            $blocks[$i]["block_info"] = $r->block_info;
            $blocks[$i]["status"]     = $r->status;
            $blocks[$i]["async"]     = $r->status;
            $blocks[$i]["region"]     = $r->region;
            $blocks[$i]["invoque_id"]     = $r->invoque_id;
        }
    }


    return $blocks;
}

/**
 * Funcion para obtener los blockes en imx_ads en una region
 * @return array con los bloques
 */
function getBlocksInfo($active_only = FALSE)
{
        $query = db_select("imx_ads_blocks", "ab");
        $query->innerJoin("imx_ads_frameworks", "af", "af.fid=ab.fid");
        $query->addField("ab", "title");
        $query->addField("ab", "fid");
        $query->addField("af", "name");
        $query->addField("af", "site_id");
        $query->addField("ab", "status");
        $query->addField("ab", "async");
        $query->addField("ab", "block_info");
        $query->addField("ab", "region");
        $query->addField("ab", "invoque_id");
        $query->addField("ab", "sec");
        $query->addField("ab", "ss");
        $query->addField("ab", "image_uri");
        $query->addField("ab", "cxwh");
        $query->addField("ab", "exclusive");
        $query->addField("ab", "cxinicial_vh");
        $query->addField("ab", "link_info");
        $query->addField("ab", "img_url");
        $query->addField("ab", "bid");
        $query->addField("ab", "custom_pages_exclude");
        if ($active_only) {
            $query->condition("ab.status", 1, '=');
        }
        $result = $query->execute()->fetchAll();

        $blocks = array();
        if ($result) {
            foreach ($result as $i => $r) {
                $blocks[$i]["bid"]                  = $r->bid;
                $blocks[$i]["block_info"]           = $r->block_info;
                $blocks[$i]["title"]                = $r->title;
                $blocks[$i]["status"]               = $r->status;
                $blocks[$i]["async"]               = $r->async;
                $blocks[$i]["fid"]                  = $r->fid;
                $blocks[$i]["framework"]            = $r->name;
                $blocks[$i]["site_id"]              = $r->site_id;
                $blocks[$i]["region"]               = $r->title;
                $blocks[$i]["image_uri"]            = $r->image_uri;
                $blocks[$i]["img_url"]              = $r->img_url;
                $blocks[$i]["cxwh"]                 = $r->cxwh;
                $blocks[$i]["cxinicial_vh"]         = $r->cxinicial_vh;
                $blocks[$i]["link_info"]            = $r->link_info;
                $blocks[$i]["ss"]                   = $r->ss;
                $blocks[$i]["sec"]                  = $r->sec;
                $blocks[$i]["exclusive"]            = $r->exclusive;
                $blocks[$i]["custom_pages_exclude"] = $r->custom_pages_exclude;
                $blocks[$i]["region"]               = $r->region;
                $blocks[$i]["invoque_id"]           = $r->invoque_id;

            }
        }

    return $blocks;
}

/*
 * Devuelve a informacion de un bloque especifico
 * @arguments $bid Id del Bloque en imx_ads_block a consultar
 *
 * */

function getBlockData($bid)
{
    //$cache = cache_get("imx_ads_getBlockData_{$bid}");
    //if (!$cache) {
        $query = db_select("imx_ads_blocks", "ab");
        $query->innerJoin("imx_ads_frameworks", "af", "af.fid=ab.fid");
        $query->innerJoin("block", "b", "ab.title=b.delta and ab.region=b.region");
        $query->fields("ab", array("bid", "fid", "title", "block_info", "region","invoque_id", "display_condition", "tags", "node_subcanals", "tids", "nids", "status","async", "types", "node_tags", "sec", "ss", "file_id", "img_url", "link_info", "custom_pages", "cxinicial_vh", "cxwh", "exclusive", "custom_pages_exclude"));
        $query->addField("af", "name");
        $query->addField("b", "theme");
        $query->condition("ab.bid", $bid);
        $query->condition("b.module", "imx_ads");

        $result = $query->execute()->fetchAll();

    /*    cache_set("imx_ads_getBlockData_{$bid}", $result, 'cache', CACHE_TEMPORARY);
    } else {
        $result = $cache->data;
    }
    */
    return $result;
}

/*
 * Devuelve un array con los Frameworks de Ads Configurados
 * */

function getFrameWorksOptions()
{
    $query = db_select("imx_ads_frameworks", "f");
    $query->fields("f", array("fid", "name", "sid", "script_url"));
    $result = $query->execute()->fetchAll();

    if ($result) {
        foreach ($result as $r) {
            $f[$r->fid] = $r->name;
        }
    }
    return $f;
}

function get_framework_ss()
{
    $f     = array();
    $query = db_select("imx_ads_frameworks", "f");
    $query->fields("f", array("ss"));
    $result = $query->execute()->fetchAll();
    $ss     = explode("|", $result[0]->ss);

    $f[NULL] = "Selecciona un ss";
    if ($ss) {
        foreach ($ss as $r) {
            $f[$r] = $r;
        }
    }
    return $f;
}

function get_framework_sec()
{
    $f     = array();
    $query = db_select("imx_ads_frameworks", "f");
    $query->fields("f", array("sec"));
    $result = $query->execute()->fetchAll();
    $sec    = explode("|", $result[0]->sec);

    $f[NULL] = "Selecciona un sec";
    if ($sec) {
        foreach ($sec as $r) {
            $f[$r] = $r;
        }
    }
    return $f;
}

/*
 * Devuelve la informacion de un Framework determinado
 * @argument $fid Id del Framework
 */

function getFrameworkData($fid)
{
    $f     = array();
    $query = db_select("imx_ads_frameworks", "f");
    $query->fields("f", array("fid", "name", "sid", "script_url", "sec", "ss", "user", "password", "account", "site_id", "domain_name"));
    if ($fid != "all") {
        if (is_numeric($fid)) {
            $query->condition("fid", $fid);
        } else {
            $query->condition("name", $fid);
        }
    }
    $result = $query->execute()->fetchAll();

    if ($result) {
        foreach ($result as $i => $r) {
            $f[$i]["fid"]         = $r->fid;
            $f[$i]["sid"]         = $r->sid;
            $f[$i]["name"]        = $r->name;
            $f[$i]["user"]        = $r->user;
            $f[$i]["password"]    = $r->password;
            $f[$i]["site_id"]     = $r->site_id;
            $f[$i]["account"]     = $r->account;
            $f[$i]["domain_name"] = $r->domain_name;
            $f[$i]["script_url"]  = $r->script_url;
            $f[$i]["sec"]         = $r->sec;
            $f[$i]["ss"]          = $r->ss;
        }
    }

    return $f;
}

function getBlockForNodeCanal($region, $node_tids, $type, $current_url)
{
    $types = array($type);
    $cache = cache_get("imx_ads_getBlockForNodeCanal_{$region}", 'cache');
    if (!$cache) {
        $query = db_select("block", "b");
        $query->leftJoin("imx_ads_blocks", "ab", "b.delta=ab.title");
        $query->leftJoin("imx_ads_frameworks", "af", "ab.fid=af.fid");
        $query->fields("b", array("weight", "bid", "delta"));
        $query->fields("ab", array("fid", "bid", "region", "node_tags", "node_subcanals", "types", "cxwh", "cxinicial_vh", "title", "sec", "ss", "link_info", "image_uri", "img_url", "status","async", "exclusive", "custom_pages_exclude"));
        $query->fields("af", array("name", "site_id"));
        $query->orderBy("b.weight", "ASC");
        $query->condition("b.region", $region);
        $query->condition("b.module", "imx_ads");
        $result = $query->execute()->fetchAll();
        cache_set("imx_ads_getBlockForNodeCanal_{$region}", $result, 'cache', CACHE_TEMPORARY);
    } else {
        $result = $cache->data;
    }
    $render_block           = array();
    $render_block_exclusive = array();

    //print_r($node_tids);
    if (count($result)) {
        foreach ($result as $i => $blocks) {
            //Validamos que no exista una exclusion de url
            $block        = $blocks;
            $exclude_urls = explode("\n", $block->custom_pages_exclude);
            $url_exist    = array_search($current_url, $exclude_urls);

            //print_r($url_exist);
            if ($url_exist === FALSE) {
                //Validacion para notas pertenecientes al canales
                if ($block->node_tags && $block->types) {
                    $tids         = explode("|", $block->node_tags);
                    $node_types   = explode("|", $block->types);
                    $bandera_tids = (count(array_intersect($node_tids, $tids))) ? TRUE : FALSE;
                    $bandera_type = (count(array_intersect($node_types, $types))) ? TRUE : FALSE;

                    if ($bandera_tids && $bandera_type) {
                        $render_block[] = $block;
                        if ($block->exclusive) {
                            $render_block_exclusive[] = $block;
                        }
                    }
                } else if ($block->node_tags && !$block->types) {
                    $tids         = explode("|", $block->node_tags);
                    $bandera_tids = (count(array_intersect($node_tids, $tids))) ? TRUE : FALSE;
                    if ($bandera_tids) {
                        $render_block[] = $block;
                        if ($block->exclusive) {
                            $render_block_exclusive[] = $block;
                        }
                    }
                } else if (!$block->node_tags && $block->types) {
                    $node_types   = explode("|", $block->types);
                    $bandera_type = (count(array_intersect($node_types, $types))) ? TRUE : FALSE;
                    if ($bandera_type) {
                        $render_block[] = $block;
                        if ($block->exclusive) {
                            $render_block_exclusive[] = $block;
                        }
                    }
                }

                //Validacion de subcanales

                if ($block->node_subcanals && $block->types) {
                    $tids         = explode("|", $block->node_subcanals);
                    $node_types   = explode("|", $block->types);
                    $bandera_tids = (count(array_intersect($node_tids, $tids))) ? TRUE : FALSE;
                    $bandera_type = (count(array_intersect($node_types, $types))) ? TRUE : FALSE;

                    if ($bandera_tids && $bandera_type) {
                        $render_block[] = $block;
                        if ($block->exclusive) {
                            $render_block_exclusive[] = $block;
                        }
                    }
                } else if ($block->node_subcanals && !$block->types) {
                    $tids         = explode("|", $block->node_subcanals);
                    $bandera_tids = (count(array_intersect($node_tids, $tids))) ? TRUE : FALSE;
                    if ($bandera_tids) {
                        $render_block[] = $block;
                        if ($block->exclusive) {
                            $render_block_exclusive[] = $block;
                        }
                    }
                }
            }
        }
    }

    if (count($render_block_exclusive)) {
        $render_block = $render_block_exclusive;
    }
    //print_r($render_block);
    return $render_block;
}

function getRegionsForAds()
{
    $rd = json_decode(variable_get("imx_ads_regions"), TRUE);
    return $rd;
}

function getTermsNode($nid)
{
    $cache       = cache_get("imx_ads_taxonomy_tids_{$nid}", 'cache');
    $results_vid = db_select("taxonomy_vocabulary", "tv")
        ->fields("tv", array("vid"))
        ->condition("name", variable_get("imx_ads_vocabulary", 1))
        ->execute()->fetchAll();
    $vid         = ($results_vid[0]->vid) ? $results_vid[0]->vid : FALSE;
    $terms       = array();
    if (!$cache && $vid) {
        $query = db_select("taxonomy_index", "ti");
        $query->innerJoin("taxonomy_term_data", "td", "td.tid=ti.tid");
        $query->fields("ti", array("tid"));
        $query->condition("ti.nid", $nid);
        $query->condition("td.vid", $vid);
        $query->orderBy('ti.tid', 'ASC');
        $results = $query->execute()->fetchAll();

        foreach ($results as $result) {
            $terms[] = $result->tid;
            //Buscamos los padres del contenido
            $term_parents = taxonomy_get_parents($result->tid);
            if ($term_parents) {
                foreach ($term_parents as $t) {
                    $terms[] = $t->tid;
                }
            }
        }
        $cache = cache_set("imx_ads_taxonomy_tids_{$nid}", $terms, 'cache', CACHE_PERMANENT);
    } else {
        $terms = $cache->data;
    }

    return $terms;
}

function getTermsNodeExclude($nid,$vocabulary_sysname=array("tags"))
{
    $vids=array();
    $terms       = array();

    $cache       = cache_get("imx_ads_taxonomy_tids_exclude_{$nid}", 'cache');
    $results_vid = db_select("taxonomy_vocabulary", "tv")
        ->fields("tv", array("vid"))
        ->condition("machine_name",$vocabulary_sysname,"NOT IN")
        ->execute()->fetchAll();
    if($results_vid){
        foreach($results_vid as $r){
            $vids[]=$r->vid;
        }
    }
    if (!$cache) {
        $query = db_select("taxonomy_index", "ti");
        $query->innerJoin("taxonomy_term_data", "td", "td.tid=ti.tid");
        $query->fields("ti", array("tid"));
        $query->condition("ti.nid", $nid);
        $query->condition("td.vid", $vids,"IN");
        $query->orderBy('ti.tid', 'ASC');
        $results = $query->execute()->fetchAll();

        foreach ($results as $result) {
            $terms[] = $result->tid;
            //Buscamos los padres del contenido
            $term_parents = taxonomy_get_parents($result->tid);
            if ($term_parents) {
                foreach ($term_parents as $t) {
                    $terms[] = $t->tid;
                }
            }
        }
        $terms=array_unique($terms);
        $cache = cache_set("imx_ads_taxonomy_tids_exclude_{$nid}", $terms, 'cache', CACHE_PERMANENT);
    } else {
        $terms = array_unique($cache->data);
    }

    return $terms;
}

function getThemeActive()
{
    global $conf;
    $theme = $conf['theme_default'];

    return $theme;
}

function hasDomainBlocks()
{
    $hasdomain = NULL;
    $q         = db_select("system", "s")
        ->fields("s", array("type", "status"))
        ->condition("type", "module")
        ->condition("name", "domain_blocks")
        ->execute()->fetchAll();
    if ($q) {
        $hasdomain = $q[0]->status;
    } else {
        $hasdomain = NULL;
    }

    return $hasdomain;
}

function getDomains()
{
    $q = NULL;
    $q = db_select("domain", "d")
        ->fields("d", array("domain_id", "subdomain"))
        ->execute()->fetchAll();
    return $q;
}

function getDomainOptions()
{
    $domains = getDomains();
    $do      = array();
    if ($domains) {
        foreach ($domains as $d) {
            $do[$d->domain_id] = $d->subdomain;
        }
    }
    return $do;
}

function getOptionsDomainsForBlock($delta)
{
    $q  = NULL;
    $do = array();
    $q  = db_select("domain_blocks", "d")
        ->fields("d", array("domain_id", "delta"))
        ->condition("delta", $delta, "=")
        ->condition("realm", "domain_id", "=")
        ->execute()->fetchAll();
    if ($q) {
        foreach ($q as $d) {
            $do[] = $d->domain_id;
        }
    }

    return $do;
}

function update_block_status_by_fid($status, $fid)
{
    $adBlock = db_update('imx_ads_blocks')
        ->fields(array(
            'status' => $status,
        ));
    $adBlock->condition("fid", $fid)->execute();

    return $adBlock;
}


function blockExist($delta)
{

    $exist = FALSE;
    $q     = db_select("block", "b")
        ->fields("b", array("delta"))
        ->condition("delta", $delta, "=")
        ->execute()->fetchAll();
    if ($q) {
        $exist = TRUE;
    }

    return $exist;

}


function getBlocksAsyncsNames()
{
    //$cache = cache_get("imx_ads_getBlockData_{$bid}");
    //if (!$cache) {
    $regions=array('sidebar_second','second_sidebar','sidebar_first','stickybar',"sidebar_top","sidebar_bottom","sidebar_second_top");
    $query = db_select("imx_ads_blocks", "ab");
    $query->innerJoin("imx_ads_frameworks", "af", "af.fid=ab.fid");
    $query->fields("ab", array("title"));
    $query->fields("af", array("site_id"));
    $query->condition("ab.async","1");
    $query->condition("ab.status","1");
    $query->condition("ab.region",$regions,"IN");
    $query->range(0,2);

    $result = $query->execute()->fetchAll();

    return $result;
}
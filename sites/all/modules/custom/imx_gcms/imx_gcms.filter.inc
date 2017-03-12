<?php

/**
 * @file
 * Administrative page callbacks for the imx_ads module.
 */

/**
 * Implements hook_admin_settings() for module settings configuration.
 */
function imx_gcms_filter_form($form, &$form_state, $no_js_use = FALSE)
{
    $cid = FALSE;
    $type = FALSE;
    $filter_aliados = false;
    $aliados = arg(7);
    $repo = arg(6);
    $site_arg = arg(5);
    $search = false;

    if (isset($_SESSION["imx_gcms"]["filters"])) {
        $filter = $_SESSION["imx_gcms"]["filters"];
        if (isset($filter["source"])) {
            $source = $filter["source"];
        }
    }




    if ($repo == "play") {
        $source = 3;
    } else if ($repo == "impreso") {
        $source = 4;
    } else if ($repo == "nodes" && !$aliados && $source != 5) {
        $source = 1;
    } elseif ($aliados || $source==5) {
        $source = 5;
        $filter_aliados = true;
    }



    if (isset($_SESSION["imx_gcms"]["filters"])) {
        $filter = $_SESSION["imx_gcms"]["filters"];
        if (isset($filter["categories"])) {
            $cid = $filter["categories"];
        }
        if (isset($filter["series"])) {
            $series = $filter["series"];
        }
        if (isset($filter["types"])) {
            $type = $filter["types"];
        }
        if (isset($filter["search"])) {
            $search = $filter["search"];
        }
        if (isset($filter["tags"])) {
            $tags = $filter["tags"];
        }
        if ($filter["source"]) {
            $source = $filter["source"];
            if ($repo == "play") {
                $source = 3;
            } else if ($repo == "impreso") {
                $source = 4;
            } else if ($repo == "nodes" && $source != 5) {
                $source = 1;
            }
        }
    }


    $form["gmc_data_source"] = array(
        '#type' => 'select',
        '#title' => t("Fuente:"),
        '#options' => array(1 => "Sitios Invent", 2 => "Temáticas Invent", 3 => "Invent.Play", 4 => "Impreso", 5 => "Aliados"),
        '#default_value' => $source,
    );


    $form["gmc_site"] = array(
        '#type' => 'select',
        '#required' => FALSE,
        '#options' => getAPISites(TRUE, $filter_aliados),
        '#attributes' => array(
            'class' => array('container-inline'), // change to just 'text' for Drupal 6
        ),
        '#ajax' => array(
            'event' => 'change',
            'callback' => 'ajax_get_category_site_callback',
            'wrapper' => 'sites-wrapper',
        ),
        "#default_value" => $site_arg,
        '#title' => t("Sitio:"),
        '#validated' => TRUE,
    );

    $form["gmc_categories"] = array(
        '#type' => 'select',
        '#attributes' => array(
            'class' => array('container-inline'), // change to just 'text' for Drupal 6
        ),
        '#prefix' => '<div id="sites-wrapper">',
        '#suffix' => '</div>',
        '#options' => _load_categories(isset($form_state['values']["gmc_site"]) ? $form_state['values']["gmc_site"] : arg(5)),
        "#default_value" => ($cid) ? $cid : "Todas",
        '#title' => t("Categoria/Canal:"),
        '#validated' => TRUE,
        '#ajax' => array(
            'event' => 'change',
            'callback' => 'ajax_get_series_callback',
            'wrapper' => 'series-wrapper',
        ),
    );


    $form["gmc_series"] = array(
        '#type' => 'select',
        '#attributes' => array(
            'class' => array('container-inline'), // change to just 'text' for Drupal 6
        ),
        '#prefix' => '<div id="series-wrapper">',
        '#suffix' => '</div>',
        '#options' => _load_series(isset($form_state['values']["gmc_categories"]) ? $form_state['values']["gmc_categories"] : $cid),
        "#default_value" => (isset($series)) ? $series : "Todas",
        '#title' => t("Series"),
        '#validated' => TRUE
    );


    $form["gmc_types"] = array(
        '#type' => 'select',
        '#attributes' => array(
            'class' => array('container-inline'),
        ),
        '#required' => FALSE,
        '#options' => array("Todos" => "Todos", "article" => "Articulos", "video" => "Videogalerías", "gallerie" => "Fotogalerías"),
        '#title' => t("Tipo de contenido"),
        "#default_value" => (isset($type)) ? $type : "Todas",
    );


    $form["gmc_search"] = array(
        '#type' => 'textfield',
        '#size' => 60,
        '#attributes' => array(
            'class' => array('container-inline'),
        ),
        '#required' => FALSE,
        '#title' => t("Buscar:"),
        "#default_value" => $search,
    );

    $form["gmc_tags"] = array(
        '#type' => 'textfield',
        '#size' => 30,
        '#attributes' => array(
            'class' => array('container-inline'),
        ),
        '#required' => FALSE,
        '#title' => t("Tags:"),
        "#default_value" => "",
    );

    $form["submit"] = array(
        '#type' => "submit",
        '#attributes' => array(
            'class' => array('container-inline'), // change to just 'text' for Drupal 6
        ),
        "#value" => "Filtrar contenidos"
    );

    $path = drupal_get_path('module', 'imx_gcms');
// Attach the CSS and JS to the form
    $form['#attached'] = array
    (
        'css' => array
        (
            'type' => 'file',
            'data' => $path . '/form_style.css',
        ),
        'js' => array
        (
            'type' => 'file',
            'data' => $path . '/imx_gcms.js',
        ),
    );


    return $form;
}

function imx_gcms_filter_form_submit($form, &$form_state)
{
    $filters = array();
    $repo = arg(6);
    $cid = $form_state["values"]["gmc_categories"];
    $site = $form_state["values"]["gmc_site"];
    $serie = $form_state["values"]["gmc_series"];
    $type = $form_state["values"]["gmc_types"];
    $search = $form_state["values"]["gmc_search"];
    $tags = $form_state["values"]["gmc_tags"];
    $source = $form_state["values"]["gmc_data_source"];

    if ($source) {
        $filters["source"] = $source;
    }

    if ($cid) {
        if ($cid != "Todas") {
            $filters["categories"] = $cid;
        }
    }
    if ($serie) {
        if ($serie != "Todas") {
            $filters["series"] = $serie;
        }
    }
    if ($site) {
        $filters["site"] = $site;
    }
    if ($type) {
        if ($type != "Todos") {
            $filters["types"] = $type;
        }
    }
    if ($search) {
        $filters["search"] = $search;
    }
    if ($tags) {
        $filters["tags"] = $tags;
    }
    if ($source == 3) {
        $repo = "play";
        $site = "inventmx";
        if ($serie == "747006106") {
            $repo = "top_videos";
        }
    } elseif ($source == 4) {
        $repo = "impreso";
        $site = "excelsior";
    } else {
        $repo = "nodes";
    }

    if (count($filters)) {
        $_SESSION["imx_gcms"]["filters"] = $filters;
    }
    drupal_goto("admin/config/imx_gcms/sites/repo/{$site}/{$repo}");


}

function ajax_get_category_site_callback($form, $form_state)
{
    return $form["gmc_categories"];
}

function ajax_get_series_callback($form, $form_state)
{
    return $form["gmc_series"];
}

function _load_categories($site)
{
    $categories = array();
    $categories_cache = cache_get("imx_gcms_{$site}_channels");
    if (!$categories) {
        $json_path = "/categories.json/";
        $categories = array("Todas" => "Todas");
        if ($site == "hub") {
            $json_path = "/repos.json/";
        } elseif ($site == "inventmx") {
            $json_path = "/play_categories.json/";
        }
        $url = IMX_API_BASE_URL . $site . $json_path . IMX_API_TOKEN . "?limit=100&sort=name:ASC";
        $data = file_get_contents($url);
        $data = json_decode($data, TRUE);
        if (count($data["data"])) {
            foreach ($data["data"] as $category) {
                if ($site != "hub") {
                    $categories[$category["id"]] = $category["name"];
                } else {
                    if ($category["reponame"] != "node") {
                        $categories[$category["reponame"]] = $category["name"];
                    }
                }

            }
            cache_set("imx_gcms_{$site}_channels", $categories, 'cache', CACHE_PERMANENT);
        }
    } else {
        $categories = $categories_cache->data;
    }

    return $categories;
}


function _load_series($channel)
{
    $json_path = "/play_series.json/";
    $categories = array("Todas" => "Todas");
    $categories["747006106"] = "Top Videos";
    $repo = "top_videos";

    $cache_series = cache_get("imx_gcms_{$channel}_series");
    if (!$cache_series) {
        if ($channel == "Todas") {
            $url = IMX_API_BASE_URL . "inventmx" . $json_path . IMX_API_TOKEN . "?limit=100&sort=name:ASC";
        } else {
            $url = IMX_API_BASE_URL . "inventmx" . $json_path . IMX_API_TOKEN . "?limit=100&sort=name:ASC&channel_ids=" . $channel;
        }

        $data = file_get_contents($url);

        $data = json_decode($data, TRUE);
        if (count($data["data"])) {
            foreach ($data["data"] as $category) {
                $categories[$category["tid"]] = $category["name"];
            }

        } else {
            $categories = array("Todas" => "Todas");
            $categories["747006106"] = "Top Videos";
        }
        cache_set("imx_gcms_{$channel}_series", $categories, "cache", CACHE_PERMANENT);
    } else {
        $categories = $cache_series->data;
    }

    return $categories;
}

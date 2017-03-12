<?php

/**
 * @file
 * Administrative page callbacks for the imx_ads module.
 */

/**
 * Implements hook_admin_settings() for module settings configuration.
 */
function imx_gcms_admin_settings_form($form, &$form_state, $no_js_use = FALSE)
{

    $form['description'] = array(
        '#markup' => '<div>' . t('Configuracion de IMX GCMS</div>')
    );

    $form['#tree'] = TRUE;
    $form["#rebuild"] = TRUE;
    $form_state['no_cache'] = TRUE;


    $form['data_fields'] = array(
        '#type' => 'fieldset',
        // Set up the wrapper so that AJAX will be able to replace the fieldset.
        '#prefix' => '<div id="block_info">',
        '#title' => 'Mapeo de campos',
        '#suffix' => '</div>',
    );

    $form['data_fields']["rewrite_url"] = array(
        '#type' => 'checkboxes',
        '#options' => array(1 => t('Sí')),
        '#title' => t('¿Rescribir url canonical y og:url?'),
        '#default_value' => array(variable_get("imx_gcms_rewrite_url", 0))
    );

    $form['data_fields']["tags_field"] = array(
        '#type' => 'checkboxes',
        '#options' => array(1 => t('Sí')),
        '#title' => t('¿Importar tags?'),
        '#default_value' => array(variable_get("imx_gcms_field_tags", 0))
    );

    $form['data_fields']["v_tags"] = array(
        '#type' => 'select',
        '#title' => t("Vocabulario de Tags"),
        '#options' => getVocabulary_tags(),
        '#default_value' => variable_get("imx_gcms_field_v_tags", 0)
    );

    $form['data_fields']["image_field"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Nombre del campo de Imagen principal:"),
        "#size" => 100,
        '#default_value' => variable_get("imx_gcms_field_image", FALSE)
    );


    $form['data_fields']["images_field"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Nombre del campo de Fotogalería (NA para ninguno):"),
        "#size" => 100,
        '#default_value' => variable_get("imx_gcms_field_images", FALSE)
    );

    $form['data_fields']["video_field"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Nombre del Campo Embed,Youtube o fieldCollection de videos (NA para ninguno):"),
        "#size" => 100,
        '#default_value' => variable_get("imx_gcms_field_video", FALSE)
    );

    $form['data_fields']["video_url_field"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Nombre del campo Youtube de url de videos,comúnmente usando con FieldCollection (NA para ninguno):"),
        "#size" => 100,
        '#default_value' => variable_get("imx_gcms_field_video_url", FALSE)
    );

    $form['data_fields']["video_desc_field"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Nombre del campo de descripción video comúnmente usando con FieldCollection (NA para ninguno):"),
        "#size" => 100,
        '#default_value' => variable_get("imx_gcms_field_video_desc", FALSE)
    );

    $form['data_fields']["autor_field"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Nombre del campo para autor:"),
        "#size" => 100,
        '#default_value' => variable_get("imx_gcms_field_autor", FALSE)
    );

    $form['data_fields']["columnista_field"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Nombre del campo para columnista:"),
        "#size" => 100,
        '#default_value' => variable_get("imx_gcms_field_columnista", FALSE)
    );

    $form['data_fields']["relateds_field"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Nombre del fieldCollection de contenidos relacionados (NA para ninguno):"),
        "#size" => 100,
        '#default_value' => variable_get("imx_gcms_field_relateds", FALSE)
    );


    $form['data_fields']["relateds_url_field"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Nombre del campo de url de contenidos relacionados:"),
        "#size" => 100,
        '#default_value' => variable_get("imx_gcms_field_relateds_url", FALSE)
    );

    $form['data_fields']["relateds_title_field"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Nombre del campo de titulo de contenidos relacionados(NA para ninguno):"),
        "#size" => 100,
        '#default_value' => variable_get("imx_gcms_field_relateds_title", FALSE)
    );


    $form['content_types'] = array(
        '#type' => 'fieldset',
        // Set up the wrapper so that AJAX will be able to replace the fieldset.
        '#prefix' => '<div id="block_info">',
        '#title' => 'Mapeo de tipos de contenido',
        '#suffix' => '</div>',
    );

    $form['content_types']["content_article"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Tipo de contenido para Article:"),
        "#size" => 100,
        '#default_value' => variable_get("imx_gcms_content_article", FALSE)
    );

    $form['content_types']["content_gallerie"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Tipo de contenido para Gallerie:"),
        "#size" => 100,
        '#default_value' => variable_get("imx_gcms_content_gallerie", FALSE)
    );

    $form['content_types']["content_video"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Tipo de contenido para Video:"),
        "#size" => 100,
        '#default_value' => variable_get("imx_gcms_content_video", FALSE)
    );

    $form['content_types']["content_blog"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Tipo de contenido para Opinión:"),
        "#size" => 100,
        '#default_value' => variable_get("imx_gcms_content_blog", FALSE)
    );

    $form["submit"] = array(
        '#type' => "submit",
        "#value" => "Guardar configuración"
    );


    return $form;
}

function imx_gcms_admin_settings_form_submit($form, &$form_state)
{
    $base_url = $form_state["values"]['general']["imx_api_base_url"];
    $access_token = $form_state["values"]['general']["imx_api_base_token"];
    $site = $form_state["values"]['general']["imx_api_site_defaut"];
    $site_rel = $form_state["values"]['general']["imx_api_site_relateds"];
    $site_external = $form_state["values"]['general']["imx_api_site_aliados"];

    $dns = $form_state["values"]['general']["imx_api_queue_dns"];
    $port = $form_state["values"]['general']["imx_api_queue_port"];
    $max_recs = $form_state["values"]['general']["imx_api_max_recs"] + 1;


    $rewrite_url = $form_state["values"]['data_fields']["rewrite_url"][1];
    $field_tags = $form_state["values"]['data_fields']["tags_field"][1];
    $v_tags = $form_state["values"]['data_fields']["v_tags"];

    $field_image = $form_state["values"]['data_fields']["image_field"];
    $field_images = $form_state["values"]['data_fields']["images_field"];
    $field_video = $form_state["values"]['data_fields']["video_field"];
    $field_video_url = $form_state["values"]['data_fields']["video_url_field"];
    $field_video_desc = $form_state["values"]['data_fields']["video_desc_field"];
    $field_autor = $form_state["values"]['data_fields']["autor_field"];
    $field_columnista = $form_state["values"]['data_fields']["columnista_field"];


    $field_relateds = $form_state["values"]['data_fields']["relateds_field"];
    $field_relateds_url = $form_state["values"]['data_fields']["relateds_url_field"];
    $field_relateds_title = $form_state["values"]['data_fields']["relateds_title_field"];


    $content_article = $form_state["values"]['content_types']["content_article"];
    $content_gallerie = $form_state["values"]['content_types']["content_gallerie"];
    $content_video = $form_state["values"]['content_types']["content_video"];
    $content_blog = $form_state["values"]['content_types']["content_blog"];


    variable_set("imx_gcms_api_base_url", $base_url);
    variable_set("imx_gcms_api_token", $access_token);
    variable_set("imx_gcms_api_site_default", $site);
    variable_set("imx_api_site_relateds", json_encode($site_rel));
    variable_set("imx_api_site_aliados", json_encode($site_external));
    variable_set("imx_api_queue_dns", $dns);
    variable_set("imx_api_queue_port", $port);
    variable_set("imx_api_max_recs", $max_recs);


    variable_set("imx_gcms_rewrite_url", $rewrite_url);
    variable_set("imx_gcms_field_tags", $field_tags);
    variable_set("imx_gcms_field_v_tags", $v_tags);

    variable_set("imx_gcms_field_image", $field_image);
    variable_set("imx_gcms_field_images", $field_images);

    variable_set("imx_gcms_field_video", $field_video);
    variable_set("imx_gcms_field_video_url", $field_video_url);
    variable_set("imx_gcms_field_video_desc", $field_video_desc);
    variable_set("imx_gcms_field_autor", $field_autor);
    variable_set("imx_gcms_field_columnista", $field_columnista);


    variable_set("imx_gcms_field_relateds", $field_relateds);
    variable_set("imx_gcms_field_relateds_url", $field_relateds_url);
    variable_set("imx_gcms_field_relateds_title", $field_relateds_title);


    variable_set("imx_gcms_content_article", $content_article);
    variable_set("imx_gcms_content_gallerie", $content_gallerie);
    variable_set("imx_gcms_content_video", $content_video);
    variable_set("imx_gcms_content_blog", $content_blog);


    variable_set("imx_gcms_config", TRUE);
    drupal_set_message("Configuración guardada con éxito");
}


function imx_gcms_recs_history_list()
{
    $header = array(
        array(
            'data' => t('Title'),
            'field' => 'n.title',
        ),
        array(
            'data' => t('Site DST'),
            'field' => 'nh.site_dst',
        ),
        array(
            'data' => t('User sended'),
            'field' => 'nh.uid',
        ),
        array(
            'data' => t('Date'),
            'field' => 'n.created',
        ),
    );

    // Default ordering
    if (!isset($_GET['order']) && !isset($_GET['sort'])) {
        $_GET['order'] = t('Sended');
        $_GET['sort'] = 'DESC';
    }

    $query = db_select('imx_gcms_recs_history', 'nh')->extend('PagerDefault');
    $query->limit(20);
    $query->join('node', 'n', 'n.nid = nh.nid');
    $query->join('users', 'u', 'u.uid = nh.uid');
    $query->fields('nh', array('nid', 'site_dst', 'created'));
    $query->fields('n', array('title'));
    $query->fields('u', array('name'));
    $query->orderBy("created", "DESC");
    $query = $query
        ->extend('TableSort')
        ->orderByHeader($header);
    $result = $query->execute();

    $rows = array();

    foreach ($result as $node) {
        $rows[] = array(
            l($node->title, "node/$node->nid"),
            ucfirst($node->site_dst),
            theme('username', array('account' => $node)),
            ($node->created ? format_date($node->created, 'custom', 'd/m/y h:i') : '&nbsp;'),
        );
    }
    if (count($rows) && ($pager = theme('pager'))) {
        $rows[] = array(
            array(
                'data' => $pager,
                'colspan' => 6,
            ),
        );
    }
    $build['imx_gcms_recs_history'] = array(
        '#theme' => 'table',
        '#header' => $header,
        '#rows' => $rows,
        '#empty' => t('There are no IMx GCMS Recs info nodes.'),
    );
    return $build;

}

function imx_gcms_imports_history_list()
{
    drupal_add_css(drupal_get_path('module', 'imx_gcms') . '/imx_gcms.css');

    $invent=array_keys(getAPISites(true,false));
    $aliados=array_keys(getAPISites(true,true));
    $total=  getTotalContentImports();
    $invent= getTotalContentImports($invent,"IN");
    $aliados=getTotalContentImports($aliados,"IN");
    $play=getTotalContentImports(array("inventmx"),"IN");




    $head_links[] = "<div class='imx-gcms-nav-menu'>";
    $head_links[] = "<div class='header-links '>" . l("Contenidos importados: ".$total, "#", array("attributes" => array("target" => "_blank", "style" => "float: left;margin: 0 20px 20px 0;"))) . "</div>";
    $head_links[] = "<div class='header-links '>" . l("Contenidos importados Red Invent: ".$invent, "#", array("attributes" => array("target" => "_blank", "style" => "float: left;margin: 0 20px 20px 0;"))) . "</div>";
    $head_links[] = "<div class='header-links '>" . l("Contenidos importados Aliados (Sindicación): ".$aliados, "", array("attributes" => array("target" => "_blank", "style" => "float: left;margin: 0 20px 20px 0;"))) . "</div>";
    $head_links[] = "<div class='header-links '>" . l("Contenidos impotados invent.Play: ".$play, "", array("attributes" => array("target" => "_blank", "style" => "float: left;margin: 0 20px 20px 0;"))) . "</div>";
    $head_links[] = "</div>";


    $type = (isset($_GET["type"])) ? $_GET["type"] : false;
    $site_aliado = (isset($_GET["site_aliado"])) ? $_GET["site_aliado"] : false;
    $site_invent = (isset($_GET["site_invent"])) ? $_GET["site_invent"] : false;
    $start_date=(isset($_GET["start_date"])) ? $_GET["start_date"] : false;
    $end_date=(isset($_GET["end_date"])) ? $_GET["end_date"] : false;


    $type = (isset($_GET["type"])) ? $_GET["type"] : false;



    $form = drupal_get_form("imx_gcms_imports_filter_form");

    $header = array(
        array(
            'data' => t('Sitio SRC'),
            'field' => 'nh.site_src',
        ),
        array(
            'data' => t('Titulo'),
            'field' => 'n.title',
        ),
        array(
            'data' => t('Tipo'),
            'field' => 'n.type',
        ),
        array(
            'data' => t('Importador'),
            'field' => 'nh.uid',
        ),
        array(
            'data' => t('Fecha'),
            'field' => 'n.created',
        ),

    );

    // Default ordering
    if (!isset($_GET['order']) && !isset($_GET['sort'])) {
        $_GET['order'] = t('Sended');
        $_GET['sort'] = 'DESC';
    }

    $query = db_select('imx_gcms_imports_history', 'nh')->extend('PagerDefault');
    $query->limit(20);
    $query->join('node', 'n', 'n.nid = nh.id_dst');
    $query->join('users', 'u', 'u.uid = nh.uid');
    $query->fields('nh', array('id_dst', 'site_src', 'created'));
    $query->fields('n', array('title', 'type'));
    $query->fields('u', array('name'));
    $query->orderBy("created", "DESC");

    $type_tmp=array();


    if ($type) {
        $type_tmp[]=$type;
        if($type=="gallerie"){
            $type_tmp[]="gallery";
            $type_tmp[]="galery";
            $type_tmp[]="galerie";
        }
        if($type=="video"){
            $type_tmp[]="videos";
            $type_tmp[]="videogalery";
            $type_tmp[]="videogalerie";
            $type_tmp[]="videogalerie";
        }

        $query->condition("n.type", $type_tmp, "IN");
    }

    if ($site_invent) {
        if($site_invent!="Ninguno") {
            $query->condition("nh.site_src", $site_invent, "=");
        }else{
            $site=getAPISites(true,false);
            $site_value=array_keys($site);
            $query->condition("nh.site_src", $site_value, "NOT IN");
        }
    }

    if ($site_aliado) {
        if($site_aliado!="Ninguno") {
            $query->condition("nh.site_src", $site_aliado, "=");
        }else{
            $site=getAPISites(true,true);
            $site_value=array_keys($site);
            $query->condition("nh.site_src", $site_value, "NOT IN");
        }
    }

    if($start_date){
        $query->condition("n.created", $start_date, ">=");

    }
    if($end_date){
        if($start_date){
            $query->condition("n.created", $end_date, "<=");

        }
    }

    $query = $query
        ->extend('TableSort')
        ->orderByHeader($header);
    $result = $query->execute();

    $rows = array();

    foreach ($result as $node) {
        $rows[] = array(
            ucfirst($node->site_src),
            l($node->title, "node/$node->id_dst"),
            $node->type,
            theme('username', array('account' => $node)),
            ($node->created ? format_date($node->created, 'custom', 'd/m/Y h:i') : ''),
        );
    }
    if (count($rows) && ($pager = theme('pager'))) {
        $rows[] = array(
            array(
                'data' => $pager,
                'colspan' => 6,
            ),
        );
    }
    $build['imx_gcms_recs_history'] = array(
        '#theme' => 'table',
        '#header' => $header,
        '#rows' => $rows,
        '#empty' => t('No hay resultados.'),
    );
    return implode($head_links,"").drupal_render($form) . drupal_render($build);

}

function imx_gcms_reject_list()
{
    $header = array(
        array(
            'data' => t('Title SRC'),
            'field' => 'nh.title_source',
        ),
        array(
            'data' => t('Sitio SRC'),
            'field' => 'nh.site_src',
        ),
        array(
            'data' => t('Date'),
            'field' => 'nh.created',
        ),

    );

    // Default ordering
    if (!isset($_GET['order']) && !isset($_GET['sort'])) {
        $_GET['order'] = t('Sended');
        $_GET['sort'] = 'DESC';
    }

    $query = db_select('imx_gcms_reject_history', 'nh')->extend('PagerDefault');
    $query->limit(20);
    $query->fields('nh', array('site_src', 'created', "title_source", "url_source"));
    $query->orderBy("created", "DESC");
    $query = $query
        ->extend('TableSort')
        ->orderByHeader($header);
    $result = $query->execute();

    $rows = array();

    foreach ($result as $node) {
        $rows[] = array(
            l($node->title_source, "$node->url_source"),
            ucfirst($node->site_src),
            ($node->created ? format_date($node->created, 'custom', 'd/m/y h:i') : '&nbsp;'),
        );
    }
    if (count($rows) && ($pager = theme('pager'))) {
        $rows[] = array(
            array(
                'data' => $pager,
                'colspan' => 6,
            ),
        );
    }
    $build['imx_gcms_rejects_history'] = array(
        '#theme' => 'table',
        '#header' => $header,
        '#rows' => $rows,
        '#empty' => t('There are no IMx GCMS Rejects info nodes.'),
    );
    return $build;

}

function getVocabulary_tags()
{
    $v = array();
    $query = db_select("taxonomy_vocabulary", "tv");
    $query->fields('tv', array("vid", "name"));
    $result = $query->execute()->fetchAll();
    foreach ($result as $item) {
        $v[$item->vid] = $item->name;
    }
    return $v;
}

function imx_gcms_imports_filter_form($form, &$form_state, $no_js_use = FALSE)
{
    $type = (isset($_GET["type"])) ? $_GET["type"] : "Todos";
    $site_aliado = (isset($_GET["site_aliado"])) ? $_GET["site_aliado"] : "Todos";
    $site_invent = (isset($_GET["site_invent"])) ? $_GET["site_invent"] : "Todos";
    $start_date=(isset($_GET["start_date"])) ? $_GET["start_date"] : false;
    $end_date=(isset($_GET["end_date"])) ? $_GET["end_date"] : false;


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

    $sites_i=getAPISites(TRUE, false);
    $sites_i["Todos"]="Todos";
    $sites_i["Ninguno"]="Ninguno";



    $form["gmc_site_invent"] = array(
        '#type' => 'select',
        '#required' => FALSE,
        '#options' => $sites_i,
        '#attributes' => array(
            'class' => array('container-inline'), // change to just 'text' for Drupal 6
        ),
        "#default_value" => (isset($site_invent)) ? $site_invent : "Todas",
        '#title' => t("Sitio Invent:"),
        '#validated' => TRUE,
    );

    $sites_a=getAPISites(TRUE, TRUE);
    $sites_a["Todos"]="Todos";
    $sites_a["Ninguno"]="Ninguno";

    $form["gmc_site_aliado"] = array(
        '#type' => 'select',
        '#required' => FALSE,
        '#options' => $sites_a,
        '#attributes' => array(
            'class' => array('container-inline'), // change to just 'text' for Drupal 6
        ),
        "#default_value" => (isset($site_aliado)) ? $site_aliado : "Todas",
        '#title' => t("Sitio Aliado:"),
        '#validated' => TRUE,
    );

    $form['start_date'] = array(
        '#title' => t('Fecha inicial'),
        '#date_label_position' => 'none',
        '#date_format' => 'd M Y',
        '#type' => 'date_popup',
        '#attributes' => array('placeholder' => t('Fecha Inicial'), 'class' => array('container-inline')),
        '#datepicker_options' => array('maxDate' => 30),
        '#date_year_range' => '0:+0',
        '#required' => false,
    );

    $form['end_date'] = array(
        '#title' => t('Fecha final'),
        '#date_label_position' => 'none',
        '#date_format' => 'd M Y',
        '#type' => 'date_popup',
        '#attributes' => array('placeholder' => t('Fecha final'), 'class' => array('container-inline')),
        '#datepicker_options' => array('maxDate' => 30),
        '#date_year_range' => '0:+0',
        '#required' => false,
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
    );


    return $form;
}

function imx_gcms_imports_filter_form_submit($form, &$form_state)
{

    $type = $form_state["values"]["gmc_types"];
    $si = $form_state["values"]["gmc_site_invent"];
    $sa = $form_state["values"]["gmc_site_aliado"];
    $esd = $form_state["values"]["start_date"];
    $end = $form_state["values"]["end_date"];
    $filters=array();


    if ($type) {
        if ($type != "Todos") {
            $filters["type"] = $type;
        }
    }
    if ($si) {
        if ($si != "Todos") {
            $filters["site_invent"] = $si;
        }
    }
    if ($sa) {
        if ($sa != "Todos") {
            $filters["site_aliado"] = $sa;
        }
    }
    if ($esd) {
        if ($esd != "Todos") {
            $filters["start_date"] = strtotime($esd);
        }
    }

    if ($end) {
        if ($esd != "Todos") {
            $filters["end_date"] = strtotime($end);
        }
    }

    $url="admin/config/imx_gcms/imports";
    $options['query']=$filters;

    drupal_goto($url,$options);
}


function getTotalContentImports($sites=false,$condition=false){
    $result=array();
    $query = db_select('imx_gcms_imports_history', 'nh');
    $query->join('node', 'n', 'n.nid = nh.id_dst');
    $query->join('users', 'u', 'u.uid = nh.uid');
    $query->fields('nh', array('id_dst', 'site_src', 'created'));
    $query->fields('n', array('title', 'type'));
    $query->fields('u', array('name'));
    $query->orderBy("created", "DESC");

    if ($sites && $condition) {
       $query->condition("nh.site_src", $sites, $condition);
    }

    $result = $query->execute()->fetchAll();

    return count($result);
}
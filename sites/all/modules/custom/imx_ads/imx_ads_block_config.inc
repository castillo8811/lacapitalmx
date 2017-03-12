<?php
/**
 * @file
 * Administrative page callbacks for the imx_ads module.
 */

/**
 * Implements hook_admin_settings() for module settings configuration.
 */
function imx_ads_block_config_form($form, &$form_state, $no_js_use = FALSE)
{

    $bid  = arg(5);
    $mode = (is_numeric($bid)) ? "edit" : "new";
    if ($mode == "edit") {
        $block  = getBlockData($bid);
        $region = NULL;
    } else {
        $block  = NULL;
        $region = $bid;
    }


    $form['#tree']         = TRUE;
    $form_state['rebuild'] = FALSE;
    $form["#token"]        = FALSE;

    $form['block_info_fieldset'] = array(
        '#type'   => 'fieldset',
        // Set up the wrapper so that AJAX will be able to replace the fieldset.
        '#prefix' => '<div id="block_info">',
        '#title'  => 'Información del bloque',
        '#suffix' => '</div>',
    );

    $form['block_info_fieldset']["block_fid"] = array(
        '#type'          => 'select',
        '#required'      => TRUE,
        '#options'       => getFrameWorksOptions(),
        '#title'         => t("Framework Ads"),
        '#default_value' => ($block) ? $block[0]->fid : 1
    );

    $form['block_info_fieldset']["block_name"] = array(
        '#type'          => 'textfield',
        '#required'      => TRUE,
        '#title'         => t("Nombre del bloque (máximo 30 carácteres):"),
        "#size"          => 30,
        '#default_value' => ($block) ? $block[0]->title : NULL
    );

    $form['block_info_fieldset']["block_region_select"] = array(
        '#type'          => 'select',
        '#required'      => TRUE,
        '#options'       => array_merge(array("-1" => "Escoje una region"), getAllRegions()),
        '#title'         => t("Region"),
        '#default_value' => ($block) ? $block[0]->region : $region
    );


    $invoque_regions= variable_get("imx_ads_invoque_ids",false);
   if($invoque_regions){
       $invoques["ninguno"]="Selecciona zona especial";
       $invoque_parts=explode(",",$invoque_regions);
       foreach($invoque_parts  as $invoque_data){
           $invoques[$invoque_data]=$invoque_data;
       }
        $form['block_info_fieldset']["block_invoque_id"] = array(
            '#type'          => 'select',
            '#options'       => $invoques,
            '#title'         => t("ID de invocación"),
            '#default_value' => ($block) ? $block[0]->invoque_id : "#none"
        );
    }


    $form['block_info_fieldset']["block_async"] = array(
        '#type'          => 'radios',
        '#title'         => t("Block Async"),
        '#options'       => array(0 => "No", 1 => "Si"),
        '#default_value' => ($block) ? $block[0]->async : 0
    );


    //Sacamos la lista de temas disponibles
    $themes        = list_themes(TRUE);
    $default_theme = getThemeActive();
    $theme_list    = array();
    foreach ($themes as $theme) {
        if ($theme->status) {
            $theme_list[$theme->name] = $theme->name;
        }
    }


    $form['block_info_fieldset']["block_theme_select"] = array(
        '#type'          => 'select',
        '#required'      => TRUE,
        '#options'       => $theme_list,
        '#title'         => t("Tema"),
        '#default_value' => ($block) ? $block[0]->theme : $default_theme
    );

    $form['block_info_fieldset']["block_sec"] = array(
        '#type'          => 'select',
        '#title'         => t("sec para el bloque (usado por eplanning)"),
        '#options'       => get_framework_sec(),
        '#default_value' => ($block) ? $block[0]->sec : NULL
    );

    $form['block_info_fieldset']["block_ss"] = array(
        '#type'          => 'select',
        '#title'         => t("ss para el bloque (usado por eplanning)"),
        '#options'       => get_framework_ss(),
        '#default_value' => ($block) ? $block[0]->ss : NULL
    );

    $form['block_info_fieldset']["block_old_name"] = array(
        '#type'          => 'hidden',
        '#default_value' => ($block) ? $block[0]->title : NULL
    );

    $form['block_info_fieldset']["block_region"] = array(
        '#type'          => 'hidden',
        '#default_value' => ($block) ? $block[0]->region : $bid
    );

    $form['block_info_fieldset']["block_info"] = array(
        '#type'          => 'textfield',
        '#required'      => TRUE,
        '#title'         => t("Información del bloque"),
        '#default_value' => ($block) ? $block[0]->block_info : NULL
    );

    $form['block_info_fieldset']['block_link'] = array(
        '#type'          => 'textfield',
        '#title'         => t('Link Info ( href | category| action | label )  campañas internas:'),
        '#default_value' => ($block) ? $block[0]->link_info : NULL,
    );

    $form['block_info_fieldset']['block_image'] = array(
        '#type'            => 'managed_file',
        '#title'           => t('Imágen para el bloque (solo campañas internas):'),
        '#default_value'   => ($block) ? $block[0]->file_id : NULL,
        '#upload_location' => 'public://imx_ads/images/',
    );

    $form['block_info_fieldset']['block_image_url'] = array(
        '#type'          => 'textfield',
        '#maxlength' => 256,
        '#title'         => t('URL de la imagen, en caso que la poseas:'),
        '#default_value' => ($block) ? $block[0]->img_url : NULL,
    );

    $form['block_info_fieldset']['block_adunit'] = array(
        '#type'          => 'textfield',
        '#title'         => t('adUnitWidth | adUnitHeight (solo cxense):'),
        '#default_value' => ($block) ? $block[0]->cxwh : NULL,
    );

    $form['block_info_fieldset']['block_adunits_hv'] = array(
        '#type'          => 'textfield',
        '#title'         => t('initialHorizontalAdUnits | ainitialVerticalAdUnits (solo cxense):'),
        '#default_value' => ($block) ? $block[0]->cxinicial_vh : NULL,
    );

    $form['block_info_fieldset']["block_status"] = array(
        '#type'          => 'radios',
        '#title'         => t("Status del Bloque"),
        '#options'       => array(0 => "No publicado", 1 => "Publicado"),
        '#default_value' => ($block) ? $block[0]->status : 1
    );

    $form['block_info_fieldset']["block_exclusive"] = array(
        '#type'          => 'checkboxes',
        '#title'         => "Exclusividad:",
        '#options'       => array(1 => "Este bloque elimina los demás bloques no exclusivos en la misma región"),
        '#default_value' => ($block) ? explode("|", $block[0]->exclusive) : NULL
    );


    $form['block_display_fieldset'] = array(
        '#type'   => 'fieldset',
        '#title'  => 'Donde será visible tu bloque?',
        '#prefix' => '<div id="ad-display">',
        '#suffix' => '</div>',
    );

    if (hasDomainBlocks()) {

        $options = getDomainOptions();

        if ($options) {
            $form['block_display_fieldset']["sitios"] = array(
                '#type'   => 'fieldset',
                '#title'  => 'Visibilidad en sitios',
                '#prefix' => '<div id="ad-display-sitios">',
                '#suffix' => '</div>',
            );

            $domains_options                                 = getOptionsDomainsForBlock($block[0]->title);
            $form['block_display_fieldset']["sitios"]["all"] = array(
                '#type'          => 'checkboxes',
                '#title'         => "Limitar a los Sitios:",
                '#options'       => getDomainOptions(),
                '#default_value' => ($block) ? $domains_options : NULL
            );
        }
    }

    $form['block_display_fieldset']["display_canales"] = array(
        '#type'   => 'fieldset',
        '#title'  => 'Visibilidad en canales',
        '#prefix' => '<div id="ad-display-canal">',
        '#suffix' => '</div>',
    );

    $form['block_display_fieldset']["display_tags"] = array(
        '#type'   => 'fieldset',
        '#title'  => 'Visibilidad en contenidos con tag',
        '#prefix' => '<div id="ad-display-tag">',
        '#suffix' => '</div>',
    );

    $form['block_display_fieldset']["display_tags"]['tags'][1] = array(
        '#type'              => 'textfield',
        '#title'             => "Tags",
        '#default_value'     => ($block) ? explode("|", $block[0]->tags) : NULL,
        '#autocomplete_path' => 'taxonomy/autocomplete/field_tags',
        '#maxlength'         => 1024,
    );


    $form['block_display_fieldset']["display_canales"]["canales"]["all"] = array(
        '#type'          => 'checkboxes',
        '#title'         => "Limitar a los Canales:",
        '#options'       => get_taxonomy_term_options("canales", TRUE),
        '#default_value' => ($block) ? explode("|", $block[0]->tids) : NULL
    );


    $options_taxonomies = getTaxonomyTree("canales");
    foreach ($options_taxonomies as $tags) {
        if (!$tags->depth) {
            $childrens = taxonomy_get_children($tags->tid, $tags->vid);
            if ($childrens) {
                foreach ($childrens as $child) {
                    $children_options[$child->tid] = $child->name;
                }
                $form['block_display_fieldset']["display_canales"]["canales"]["subcanal"][$tags->tid]           = array(
                    '#type'        => 'fieldset',
                    '#title'       => "Subcanales de: " . $tags->name,
                    '#prefix'      => '<div id="ad-display-tag">',
                    '#suffix'      => '</div>',
                    '#collapsible' => TRUE,
                    '#collapsed'   => TRUE,
                );
                $form['block_display_fieldset']["display_canales"]["canales"]["subcanal"][$tags->tid]["childs"] = array(
                    '#type'          => 'checkboxes',
                    '#options'       => $children_options,
                    '#attributes'    => array('class' => array("childs-{$tags->tid}")),
                    '#default_value' => ($block) ? explode("|", $block[0]->tids) : NULL
                );
            }
        }
        $children_options = array();
    }

    $form['block_display_fieldset']["display_nodes"] = array(
        '#type'   => 'fieldset',
        '#title'  => 'Visibilidad en notas',
        '#prefix' => '<div id="ad-display-nodes">',
        '#suffix' => '</div>',
    );

    $form['block_display_fieldset']["display_nodes"]["all"] = array(
        '#type'          => 'checkboxes',
        '#title'         => "Contenidos pertenecientes a los canales:",
        '#options'       => get_taxonomy_term_options("canales", TRUE),
        '#default_value' => ($block) ? explode("|", $block[0]->node_tags) : NULL
    );


    $form['block_display_fieldset']["display_nodes"]["all"] = array(
        '#type'          => 'checkboxes',
        '#title'         => "Contenidos pertenecientes a los canales:",
        '#options'       => get_taxonomy_term_options("canales", TRUE),
        '#default_value' => ($block) ? explode("|", $block[0]->node_tags) : NULL
    );

    $options_taxonomies = getTaxonomyTree("canales");
    foreach ($options_taxonomies as $tags) {
        if (!$tags->depth) {
            $childrens = taxonomy_get_children($tags->tid, $tags->vid);
            if ($childrens) {
                foreach ($childrens as $child) {
                    $children_options[$child->tid] = $child->name;
                }
                $form['block_display_fieldset']["display_nodes"]["node_subcanal"][$tags->tid]           = array(
                    '#type'        => 'fieldset',
                    '#title'       => "Subcanales de: " . $tags->name,
                    '#prefix'      => '<div id="ad-display-tag">',
                    '#suffix'      => '</div>',
                    '#collapsible' => TRUE,
                    '#collapsed'   => TRUE,
                );
                $form['block_display_fieldset']["display_nodes"]["node_subcanal"][$tags->tid]["childs"] = array(
                    '#type'          => 'checkboxes',
                    '#options'       => $children_options,
                    '#attributes'    => array('class' => array("subcanal-childs-{$tags->tid}")),
                    '#default_value' => ($block) ? explode("|", $block[0]->node_subcanals) : NULL
                );
            }
        }
        $children_options = array();
    }


    $form['block_display_fieldset']["display_nodes"]["types"] = array(
        '#type'          => 'checkboxes',
        '#title'         => "Contenidos de tipo:",
        '#options'       => getNodeTypes(),
        '#default_value' => ($block) ? explode("|", $block[0]->types) : NULL
    );


    // Build the fieldset with the proper number of names. We'll use
    // $form_state['num_names'] to determine the number of textfields to build.
    if (empty($form_state['num_nodes'])) {
        $form_state['num_nodes'] = 1;
    }
    $nodes = ($block) ? explode("|", $block[0]->nids) : NULL;

    if ($nodes) {
        $form_state['num_nodes'] = count($nodes);
    }
    for ($i = 0; $i < $form_state['num_nodes']; $i++) {

        $form['block_display_fieldset']["display_nodes"]["find_contend"]["search"][$i] = array(
            '#type'              => 'textfield',
            '#id'                => "search_{$i}",
            '#title'             => 'Buscar contenido',
            '#autocomplete_path' => 'imx_helpers/autocomplete_node_by_title',
            '#default_value'     => ($nodes) ? $nodes[$i] : NULL
        );
    }


    $form['block_display_fieldset']["display_nodes"]["find_contend"]["add"] = array(
        '#type'   => 'submit',
        "#id"     => "add-submit",
        '#submit' => array('ajax_add_node_more'),
        '#title'  => 'Agregar contenido',
        '#value'  => 'Agregar otro contenido',
        '#ajax'   => array(
            'callback' => 'ajax_add_more',
            'wrapper'  => 'ad-display-nodes',
        ),
    );

    $form['block_display_fieldset']["display_pages"]["custom_pages"] = array(
        '#type'          => 'textarea',
        '#title'         => 'Mostrar en estas URLS:',
        '#default_value' => ($block) ? $block[0]->custom_pages : NULL
    );

    $form['block_display_fieldset']["display_pages"]["custom_pages_exclude"] = array(
        '#type'          => 'textarea',
        '#title'         => 'Evitar estas URLS:',
        '#default_value' => ($block) ? $block[0]->custom_pages_exclude : NULL
    );

    if ($mode == "new") {
        $form['block_display_fieldset']["submit"] = array(
            '#type'   => 'submit',
            '#submit' => array('imx_ads_block_config_form_new_submit'),
            "#id"     => "save-submit",
            '#value'  => 'Guardar Bloque',
        );
    } else {
        $form['block_display_fieldset']["submit"] = array(
            '#type'   => 'submit',
            '#submit' => array('imx_ads_block_config_form_edit_submit'),
            "#id"     => "save-submit-edit",
            '#value'  => 'Actualizar Bloque',
        );
    }


    $form['#validate'][] = 'imx_ads_img_form_form_validate';


    $form['#attached']['js'] = array(
        drupal_get_path('module', 'imx_ads') . '/imx_ads.js',
    );


    return $form;
}

function ajax_add_node_more($form, &$form_state)
{
    $form_state['num_nodes']++;
    $form_state['rebuild'] = TRUE;
}

function ajax_add_more($form, $form_state)
{
    return $form['block_display_fieldset']["display_nodes"];
}

function ajax_autocomplete_callback($form, &$form_state)
{
    $item                           = $form_state["triggering_element"]["#array_parents"][4];
    $value                          = $form['block_display_fieldset']["display_nodes"]["find_contend"]["search"][$item]["#value"];
    $node                           = node_by_title($value);
    $form_state['nodes_url'][$item] = "node/" . $node->nid;
    $form_state['rebuild']          = TRUE;
}

/**
 * Final submit handler.
 *
 * Reports what values were finally set.
 */
function imx_ads_block_config_form_new_submit($form, &$form_state)
{
    //global $user;
    $arg = arg(5);
    $bid = (is_numeric($arg)) ? $arg : 0;
    global $user;
    $node_titles = NULL;
    $node        = NULL;

    $subcanal_childs_tids      = array();
    $data["block"]["bid"]      = $bid;
    $data["block"]["name"]     = $form_state["values"]["block_info_fieldset"]["block_name"];
    $data["block"]["sec"]      = $form_state["values"]['block_info_fieldset']["block_sec"];
    $data["block"]["ss"]       = $form_state["values"]['block_info_fieldset']["block_ss"];
    $data["block"]["status"]   = $form_state["values"]["block_info_fieldset"]["block_status"];
    $data["block"]["async"]   = $form_state["values"]["block_info_fieldset"]["block_async"];
    $data["block"]["fid"]      = $form_state["values"]["block_info_fieldset"]["block_fid"];
    $data["block"]["region"]   = $form_state["values"]['block_info_fieldset']["block_region_select"];
    if($form_state["values"]['block_info_fieldset']["block_invoque_id"]!="ninguno"){
        $data["block"]["invoque_id"]   = $form_state["values"]['block_info_fieldset']["block_invoque_id"];
    }

    $data["block"]["theme"]    = $form_state["values"]['block_info_fieldset']["block_theme_select"];
    $data["block"]["old_name"] = $form_state["values"]["block_info_fieldset"]["block_old_name"];
    $data["block"]["info"]     = $form_state["values"]["block_info_fieldset"]["block_info"];
    $data["block"]["link"]     = $form_state["values"]['block_info_fieldset']['block_link'];
    $data["block"]["img_url"]  = $form_state["values"]['block_info_fieldset']['block_image_url'];

    $data["block"]["custom_pages"] = $form_state["values"]['block_display_fieldset']["display_pages"]["custom_pages"];

    $data["block"]["custom_pages_exclude"] = $form_state["values"]['block_display_fieldset']["display_pages"]["custom_pages_exclude"];
    $data["block"]["exclusive"]            = $form_state["values"]["block_info_fieldset"]["block_exclusive"];


    $data["condition"]             = 1;
    $canales                       = $form_state["values"]["block_display_fieldset"]["display_canales"]["canales"]["all"];
    $tags                          = explode(",", $form['block_display_fieldset']["display_tags"]['tags'][1]["#value"]);
    $node_canal                    = $form_state["values"]['block_display_fieldset']["display_nodes"]["all"];
    $data["block"]["cxwh"]         = explode("|", $form_state["values"]['block_info_fieldset']['block_adunit']);
    $data["block"]["cxinicial_vh"] = explode("|", $form_state["values"]['block_info_fieldset']['block_adunits_hv']);


    /* SOlo para blockdomain */
    if (array_key_exists("sitios", $form_state["values"]['block_display_fieldset'])) {
        $sitios    = $form_state["values"]['block_display_fieldset']["sitios"]["all"];
        $sites_ids = array();
        foreach ($sitios as $key => $value) {
            if ($value) {
                $sites_ids[] = $value;
            }
        }
    }

    $results_vid = db_select("taxonomy_vocabulary", "tv")
        ->fields("tv", array("vid"))
        ->condition("name", variable_get("imx_ads_vocabulary", 1))
        ->execute()->fetchAll();
    $vid         = ($results_vid[0]->vid) ? $results_vid[0]->vid : FALSE;

    foreach ($canales as $key => $value) {
        if ($value) {
            $canal  = str_replace("taxonomy/term/", "", $value);
            $tids[] = $value;
            if ($canal == "<front>") {
                $c[] = $canal;
            } else {
                $c[] = "taxonomy/term/" . $canal;
            }

            //Agregamos los Hijos del canal
            if((int)$canal>0){
                $term_childs = taxonomy_get_children($canal, $vid);
                if ($term_childs) {
                    foreach ($term_childs as $t) {
                        $c[] = "taxonomy/term/" . $t->tid;
                    }
                }
            }
        }
    }


    /* Contenidos asociados a un canal */
    $nc = array();

    foreach ($node_canal as $key => $value) {
        if ($value) {
            $nc[] = $value;
            //Agregamos los Hijos del canal
            $term_childs = taxonomy_get_children($value, $vid);
            if ($term_childs) {
                foreach ($term_childs as $t) {
                    $nc[] = "taxonomy/term/" . $t->tid;
                }
            }
        }
    }


    $tags_tid = array();

    foreach ($tags as $t) {
        $t_data = taxonomy_get_term_by_name(trim($t), $vocabulary = NULL);
        foreach ($t_data as $tx) {
            $ttid[]     = $tx->tid;
            $tags_tid[] = "taxonomy/term/" . $tx->tid;
        }
    }

    //subcanal
    $subcanales      = $form_state["values"]['block_display_fieldset']["display_canales"]["canales"]["subcanal"];
    $subcanal_childs = array();
    foreach ($subcanales as $subcanal) {
        foreach ($subcanal["childs"] as $key => $value) {
            if ($value) {
                $subcanal_childs[] = "taxonomy/term/" . $value;
                $tids[]            = $value;

                //Agregamos los Hijos del canal
                if((int)$canal>0){
                    $term_childs = taxonomy_get_children($canal, $vid);
                    if ($term_childs) {
                        foreach ($term_childs as $t) {
                            $c[] = "taxonomy/term/" . $t->tid;
                        }
                    }
                }
            }
        }
    }

    //contenido_subcanal
    $node_subcanales           = $form_state["values"]['block_display_fieldset']["display_nodes"]["node_subcanal"];
    $contenido_subcanal_childs = array();
    foreach ($node_subcanales as $subcanal) {
        foreach ($subcanal["childs"] as $key => $value) {
            if ($value) {
                $contenido_subcanal_childs[] = $value;
                //Agregamos los Hijos del canal
                $term_childs = taxonomy_get_children($value, $vid);
                if ($term_childs) {
                    foreach ($term_childs as $t) {
                        $contenido_subcanal_childs[] = "taxonomy/term/" . $t->tid;
                    }
                }
            }
        }
    }

    $data["sites"]     = $sites_ids;
    $data["canales"]   = implode("\n", $c);
    $data["tags"]      = implode("\n", $tags_tid);
    $data["tags_tids"] = implode("\n", $tags_tid);

    $data["subcanales"]      = "\n" . implode("\n", $subcanal_childs);
    $data["subcanales_tids"] = implode("|", $subcanal_childs_tids);
    $data["custom_pages"]    = $data["block"]["custom_pages"];

    $data["node_subcanales"] = implode("|", $contenido_subcanal_childs);
    $data["node_tags"]       = implode("|", $nc);
    $data["tags_titles"]     = $form['block_display_fieldset']["display_tags"]['tags'][1]["#value"];
    $node_data               = $form_state["values"]['block_display_fieldset']["display_nodes"]["find_contend"]["search"];
    if ($node_data) {
        foreach ($node_data as $n) {
            if ($n) {
                $node_result = nid_by_title($n);
                if ($node_result) {
                    $node[]        = "node/" . $node_result;
                    $node_titles[] = $n;
                }
            }
        }
    }

    if (count($subcanal_childs_tids)) {
        $tids = array_merge($tids, $subcanal_childs_tids);
    }


    $data["tids"]        = implode("|", $tids);
    $data["nids"]        = ($node_titles) ? implode("|", $node_titles) : "";
    $data["nodes"]       = ($node) ? "\n" . implode("\n", $node) : "";
    $data["types"]       = $form_state["values"]['block_display_fieldset']["display_nodes"]["types"];
    $data["pages"]       = ($data["canales"] . $data["subcanales"] . $data["nodes"] . $data["tags"] . $data["custom_pages"]);
    $data["uid"]         = 1;
    $data["block_image"] = $form_state["values"]['block_info_fieldset']["block_image"];
    $data["image_uri"]   = "";
    if ($data["block_image"]) {
        $fid          = $data["block_image"];
        $file         = @file_load($fid);
        $file->status = FILE_STATUS_PERMANENT;
        file_save($file);
        file_usage_add($file, 'imx_ads', 'user', $user->uid);
        $data["image_uri"] = $file->uri;
    }

    $block = save_block($data);
    if ($block) {
        drupal_set_message(t('The block configuration has been saved.'));
    } else {
        drupal_set_message(t('Hubo un pex.'), "error");
    }

    drupal_goto('admin/config/inventmx_ads/blocks');
}

function imx_ads_block_config_form_edit_submit(&$form, &$form_state)
{
    //global $user;
    $arg = arg(5);
    $bid = (is_numeric($arg)) ? $arg : 0;
    global $user;
    $node_titles = NULL;
    $node        = NULL;

    $subcanal_childs_tids      = array();
    $subcanal_childs           = array();
    $contenido_subcanal_childs = array();
    $tids                      = array();
    $form_state['rebuild']     = FALSE;

    $data["block"]["bid"]      = $bid;
    $data["block"]["name"]     = $form_state["values"]["block_info_fieldset"]["block_name"];
    $data["block"]["sec"]      = $form_state["values"]['block_info_fieldset']["block_sec"];
    $data["block"]["ss"]       = $form_state["values"]['block_info_fieldset']["block_ss"];
    $data["block"]["status"]   = $form_state["values"]["block_info_fieldset"]["block_status"];
    $data["block"]["async"]   = $form_state["values"]["block_info_fieldset"]["block_async"];
    $data["block"]["fid"]      = $form_state["values"]["block_info_fieldset"]["block_fid"];
    $data["block"]["region"]   = $form_state["values"]['block_info_fieldset']["block_region_select"];
    if($form_state["values"]['block_info_fieldset']["block_invoque_id"]!="ninguno"){
           $data["block"]["invoque_id"]   = $form_state["values"]['block_info_fieldset']["block_invoque_id"];
    }

    $data["block"]["theme"]    = $form_state["values"]['block_info_fieldset']["block_theme_select"];
    $data["block"]["old_name"] = $form_state["values"]["block_info_fieldset"]["block_old_name"];
    $data["block"]["info"]     = $form_state["values"]["block_info_fieldset"]["block_info"];
    $data["block"]["link"]     = $form_state["values"]['block_info_fieldset']['block_link'];
    $data["block"]["img_url"]  = $form_state["values"]['block_info_fieldset']['block_image_url'];

    $data["block"]["custom_pages"] = $form_state["values"]['block_display_fieldset']["display_pages"]["custom_pages"];

    $data["block"]["custom_pages_exclude"] = $form_state["values"]['block_display_fieldset']["display_pages"]["custom_pages_exclude"];
    $data["block"]["exclusive"]            = $form_state["values"]["block_info_fieldset"]["block_exclusive"];


    $data["condition"]             = 1;
    $canales                       = $form_state["values"]["block_display_fieldset"]["display_canales"]["canales"]["all"];
    $tags                          = explode(",", $form['block_display_fieldset']["display_tags"]['tags'][1]["#value"]);
    $data["block"]["cxwh"]         = $form_state["values"]['block_info_fieldset']['block_adunit'];
    $data["block"]["cxinicial_vh"] = $form_state["values"]['block_info_fieldset']['block_adunits_hv'];


    if (array_key_exists("sitios", $form_state["values"]['block_display_fieldset'])) {
        $sitios    = $form_state["values"]['block_display_fieldset']["sitios"]["all"];
        $sites_ids = array();
        foreach ($sitios as $key => $value) {
            if ($value) {
                $sites_ids[] = $value;
            }
        }
    }

    $results_vid = db_select("taxonomy_vocabulary", "tv")
        ->fields("tv", array("vid"))
        ->condition("name", variable_get("imx_ads_vocabulary", 1))
        ->execute()->fetchAll();
    $vid         = ($results_vid[0]->vid) ? $results_vid[0]->vid : FALSE;

    $node_canal = $form_state["values"]['block_display_fieldset']["display_nodes"]["all"];
    $c          = array();

    foreach ($canales as $key => $value) {
        if ($value) {
            $canal  = str_replace("taxonomy/term/", "", $value);
            $tids[] = $value;
            if ($canal == "<front>") {
                $c[] = $canal;
            } else {
                $c[] = "taxonomy/term/" . $canal;
            }

            if((int)$canal>0){
            $term_childs = taxonomy_get_children($canal, $vid);
                if ($term_childs) {
                    foreach ($term_childs as $t) {
                        $c[] = "taxonomy/term/" . $t->tid;
                    }
                }
            }
        }
    }

    /* Contenidos asociados a un canal */
    $nc = array();

    foreach ($node_canal as $key => $value) {
        if ($value) {
            $nc[] = $value;
            //Agregamos los Hijos del subcanal
            $term_childs = taxonomy_get_children($value, $vid);
            if ($term_childs) {
                foreach ($term_childs as $t) {
                    $nc[] = $t->tid;
                }
            }
        }
    }


    $tags_tid = array();

    foreach ($tags as $t) {
        $t_data = taxonomy_get_term_by_name(trim($t), $vocabulary = NULL);
        foreach ($t_data as $tx) {
            $ttid[]     = $tx->tid;
            $tags_tid[] = "taxonomy/term/" . $tx->tid;
        }
    }

    //subcanal
    if (array_key_exists("subcanal", $form_state["values"]['block_display_fieldset']["display_canales"]["canales"])) {
        $subcanales      = $form_state["values"]['block_display_fieldset']["display_canales"]["canales"]["subcanal"];
        $subcanal_childs = array();
        foreach ($subcanales as $subcanal) {
            foreach ($subcanal["childs"] as $key => $value) {
                if ($value) {
                    $subcanal_childs[] = "taxonomy/term/" . $value;
                    $tids[]            = $value;

                    //Agregamos los Hijos del subcanal
                    $term_childs = taxonomy_get_children($value, $vid);
                    if ($term_childs) {
                        foreach ($term_childs as $t) {
                            $subcanal_childs[] = "taxonomy/term/" . $t->tid;
                            $tids[]            = $t->tid;
                        }
                    }
                }
            }
        }
    }

    //contenido_subcanal
    if (array_key_exists("node_subcanal", $form_state["values"]['block_display_fieldset']["display_nodes"])) {
        $node_subcanales           = $form_state["values"]['block_display_fieldset']["display_nodes"]["node_subcanal"];
        $contenido_subcanal_childs = array();
        foreach ($node_subcanales as $subcanal) {
            foreach ($subcanal["childs"] as $key => $value) {
                if ($value) {
                    $contenido_subcanal_childs[] = $value;

                    //Agregamos los Hijos del subcanal
                    $term_childs = taxonomy_get_children($value, $vid);
                    if ($term_childs) {
                        foreach ($term_childs as $t) {
                            $contenido_subcanal_childs[] = $t->tid;
                        }
                    }
                }
            }
        }
    }


    $data["sites"]     = $sites_ids;
    $data["canales"]   = implode("\n", $c);
    $data["tags"]      = implode("\n", $tags_tid);
    $data["tags_tids"] = implode("\n", $tags_tid);

    $data["subcanales"]      = "\n" . implode("\n", $subcanal_childs);
    $data["subcanales_tids"] = implode("|", $subcanal_childs_tids);

    $data["node_subcanales"] = implode("|", $contenido_subcanal_childs);
    $data["node_tags"]       = implode("|", $nc);
    $data["custom_pages"]    = $data["block"]["custom_pages"];
    $data["tags_titles"]     = $form['block_display_fieldset']["display_tags"]['tags'][1]["#value"];
    $node_data               = $form_state["values"]['block_display_fieldset']["display_nodes"]["find_contend"]["search"];

    if ($node_data) {
        foreach ($node_data as $n) {
            if ($n) {
                $node_result = nid_by_title($n);
                if ($node_result) {
                    $node[]        = "node/" . $node_result;
                    $node_titles[] = $n;
                }
            }
        }
    }

    if (count($subcanal_childs_tids)) {
        $tids = array_merge($tids, $subcanal_childs_tids);
    }

    $data["tids"]        = implode("|", $tids);
    $data["nids"]        = ($node_titles) ? implode("|", $node_titles) : "";
    $data["nodes"]       = ($node) ? "\n" . implode("\n", $node) : "";
    $data["types"]       = $form_state["values"]['block_display_fieldset']["display_nodes"]["types"];
    $data["pages"]       = ($data["canales"] . $data["subcanales"] . $data["nodes"] . $data["tags"] . $data["custom_pages"]);
    $data["uid"]         = 1;
    $data["block_image"] = $form_state["values"]['block_info_fieldset']["block_image"];
    $data["image_uri"]   = "";
    if ($data["block_image"]) {
        $fid          = $data["block_image"];
        $file         = @file_load($fid);
        $file->status = FILE_STATUS_PERMANENT;
        file_save($file);
        file_usage_add($file, 'imx_ads', 'user', $user->uid);
        $data["image_uri"] = $file->uri;
    }


    $block = update_block($data);
    if ($block) {
        drupal_set_message(t('The block configuration has been saved.'));
    } else {
        drupal_set_message(t('Hubo un pex.'), "error");
    }
    drupal_goto('admin/config/inventmx_ads/blocks');
}

function imx_ads_img_form_form_validate(&$form, &$form_state)
{

    if (strlen($form_state['values']["block_info_fieldset"]['block_image_url'])) {
        if (!valid_url($form_state['values']["block_info_fieldset"]['block_image_url'])) {
            form_set_error('title', t('Url no valida para el campo URL de imagen.'));
        }
        if (!is_valid_image($form_state['values']["block_info_fieldset"]['block_image_url'])) {
            form_set_error('title', t('Solo se aceptan formatos de imagen jpg,png, gif o bmp.'));
        }
    }
}

function is_valid_image($url)
{
    $valid = FALSE;
    if (preg_match('/([^\s]+(\.(?i)(jpg|png|gif|bmp))$)/', $url)) {
        $valid = TRUE;
    }
    return $valid;

}

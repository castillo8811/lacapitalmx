<?php

/**
 * @file
 * Administrative page callbacks for the imx_ads module.
 */

/**
 * Implements hook_admin_settings() for module settings configuration.
 */
function imx_ads_framework_config_form($form, &$form_state, $no_js_use = FALSE)
{

    $form['#tree'] = TRUE;
    $mode = "new";
    $fid = arg(5);
    if ($fid) {
        $data = getFrameworkData($fid);
        $f = $data[0];
        $mode = "edit";
    }


    $form['framework_info_fieldset'] = array(
        '#type' => 'fieldset',
        // Set up the wrapper so that AJAX will be able to replace the fieldset.
        '#prefix' => '<div id="framework_info">',
        '#title' => 'Información del Framework de publicidad a utilizar 3 posibles (eplanning,cxense,google analitics)',
        '#suffix' => '</div>',
    );

    $form['framework_info_fieldset']["framework_name"] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#title' => t("Nombre del Framework"),
        '#default_value' => ($f) ? $f["name"] : NULL
    );

    $form['framework_info_fieldset']["framework_fid"] = array(
        '#type' => 'hidden',
        '#value' => ($f) ? $f["fid"] : NULL
    );


    $form['framework_info_fieldset']["site_sid"] = array(
        '#type' => 'textfield',
        '#title' => t("si (usado por start script en  eplanning)"),
        '#default_value' => ($f) ? $f["sid"] : NULL
    );

    $form['framework_info_fieldset']["sec"] = array(
        '#type' => 'textfield',
        '#title' => t("sec usados por el framework(separados por '|' )"),
        '#default_value' => ($f) ? $f["sec"] : NULL
    );


    $form['framework_info_fieldset']["ss"] = array(
        '#type' => 'textfield',
        '#title' => t("ss usados por el framework(separados por '|' )"),
        '#default_value' => ($f) ? $f["ss"] : NULL
    );


    $form['framework_info_fieldset']["framework_script"] = array(
        '#type' => 'textfield',
        '#required' => FALSE,
        '#title' => t("Filename del js del Framework( debe estar ubicado en imx_ads/js_frameworks/ )"),
        '#default_value' => ($f) ? $f["script_url"] : ""
    );

    /*
      $form['framework_info_fieldset']["ad_script"] = array(
      '#type' => 'textarea',
      '#required' => false,
      '#title' => t("Ad-Script"),
      '#default_value' => ($f) ? $f["ad_script"] : null
      );
     * */


    $form['framework_account_fieldset']["site_id"] = array(
        '#type' => 'textfield',
        '#title' => t("Identificador del sitio"),
        '#default_value' => ($f) ? $f["site_id"] : "0"
    );

    $form['framework_account_fieldset']["account"] = array(
        '#type' => 'textfield',
        '#title' => t("Cuenta(Usado por Cxsense y Google analitics)"),
        '#default_value' => ($f) ? $f["account"] : NULL
    );

    $form['framework_account_fieldset']["domain_name"] = array(
        '#type' => 'textfield',
        '#title' => t("Domain name(Usado por Google analitics)"),
        '#default_value' => ($f) ? $f["domain_name"] : NULL
    );

    $form['framework_account_fieldset']["user"] = array(
        '#type' => 'textfield',
        '#title' => t("Usuario (para accesos a apis)"),
        '#default_value' => ($f) ? $f["user"] : NULL
    );

    $form['framework_account_fieldset']["password"] = array(
        '#type' => 'textfield',
        '#title' => t("Password (para accesos a apis)"),
        '#default_value' => ($f) ? $f["password"] : NULL
    );

    if ($f["name"] == "smart") {


        $form['framework_account_fieldset']["off"] = array(
            '#type' => 'radios',
            '#title' => t("Apagar llamados"),
            '#options' => array(0 => "Inactivo", 1 => "Activo"),
            '#default_value' => variable_get("imx_ads_smart_off", 0)
        );

        $form['framework_account_fieldset']["smart_call_method"] = array(
            '#type' => 'select',
            '#required' => FALSE,
            '#options' => array("onecall" => "SmartAdServerAjaxOneCall", "std" => "SmartAdServer","ajax"=>"SmartAdServerAjax"),
            '#title' => t("Metodo de llamado de Ads"),
            '#default_value' => variable_get("imx_ads_smart_call_method", "ajax")
        );


        $form['framework_account_fieldset']["legacy"] = array(
            '#type' => 'radios',
            '#title' => t("Modo Legacy"),
            '#options' => array(0 => "Inactivo", 1 => "Activo"),
            '#default_value' => variable_get("imx_ads_legacy_smart", 0)
        );


        $form['framework_account_fieldset']["urlhost"] = array(
            '#type' => 'radios',
            '#title' => t("URL Host Support"),
            '#options' => array(0 => "Inactivo", 1 => "Activo"),
            '#default_value' => variable_get("imx_ads_urlhost_smart", 0)
        );

        $form['framework_account_fieldset']["tail_target"] = array(
            '#type' => 'radios',
            '#title' => t("Tail Target Support"),
            '#options' => array(0 => "Inactivo", 1 => "Activo"),
            '#default_value' => variable_get("imx_ads_tail_target_smart", 0)
        );


        $form['framework_account_fieldset']["prequal_url"] = array(
            '#type' => 'textfield',
            '#title' => t("Prequal URL (SMART P&G)"),
            '#default_value' => variable_get("imx_ads_prequal_url_smart")
        );

        $form['framework_account_fieldset']["prequal_status"] = array(
            '#type' => 'radios',
            '#title' => t("Estatus Prequal"),
            '#options' => array(0 => "Inactivo", 1 => "Activo"),
            '#default_value' => variable_get("imx_ads_prequal_status_smart", 0)
        );
    }


    $form["actions"]["submit"] = array(
        '#type' => 'submit',
        '#submit' => ($mode == "new") ? array('imx_ads_framework_config_new_form_submit') : array("imx_ads_framework_config_edit_form_submit"),
        '#value' => 'Guardar Bloque',
    );

    return $form;
}

/**
 * Final submit handler.
 *
 * Reports what values were finally set.
 */
function imx_ads_framework_config_new_form_submit($form, &$form_state)
{
    //global $user;
    $data["name"] = $form_state["values"]["framework_info_fieldset"]["framework_name"];
    $data["sid"] = $form_state["values"]["framework_info_fieldset"]["site_sid"];
    $data["script"] = $form_state["values"]["framework_info_fieldset"]["framework_script"];
    //$data["ad_script"] = $form_state["values"]["framework_info_fieldset"]["ad_script"];
    $data["ss"] = $form_state["values"]["framework_info_fieldset"]["ss"];
    $data["sec"] = $form_state["values"]["framework_info_fieldset"]["sec"];
    $data["account"] = $form_state["values"]["framework_account_fieldset"]["account"];
    $data["domain_name"] = $form_state["values"]["framework_account_fieldset"]["domain_name"];


    $data["user"] = $form_state["values"]["framework_account_fieldset"]["user"];
    $data["password"] = $form_state["values"]["framework_account_fieldset"]["password"];
    $data["site_id"] = $form_state["values"]["framework_account_fieldset"]["site_id"];

    if ($data["name"] == "smart") {

        $data["prequal_url"] = $form_state["values"]["framework_account_fieldset"]["prequal_url"];
        variable_set("imx_ads_prequal_url_smart", $data["prequal_url"]);

        $data["prequal_status"] = $form_state["values"]["framework_account_fieldset"]["prequal_status"];
        variable_set("imx_ads_prequal_status_smart", $data["prequal_status"]);

        $data["smart_call_method"] = $form_state["values"]["framework_account_fieldset"]["smart_call_method"];
        variable_set("imx_ads_smart_call_method", $data["smart_call_method"]);

        $data["smart_legacy"] = $form_state["values"]["framework_account_fieldset"]["legacy"];
        variable_set("imx_ads_legacy_smart", $data["smart_legacy"]);

        $data["smart_urlhost"] = $form_state["values"]["framework_account_fieldset"]["urlhost"];
        variable_set("imx_ads_urlhost_smart", $data["smart_urlhost"]);

        $data["smart_tail_target"] = $form_state["values"]["framework_account_fieldset"]["tail_target"];
        variable_set("imx_ads_tail_target_smart", $data["smart_tail_target"]);

        $data["smart_off"] = $form_state["values"]["framework_account_fieldset"]["off"];
        variable_set("imx_ads_smart_off", $data["smart_off"]);



    }


    $framework = imx_ads_framework_save($data);

    if ($framework) {
        drupal_set_message(t('Configuración guardada correctamente.'));
    } else {
        drupal_set_message(t('Hubo un pex.'), "error");
    }
    $form_state['redirect'] = 'admin/config/inventmx_ads/frameworks';
}

function imx_ads_framework_config_edit_form_submit($form, &$form_state)
{
    //global $user;
    $data["name"] = $form_state["values"]["framework_info_fieldset"]["framework_name"];
    $data["fid"] = $form_state["values"]['framework_info_fieldset']["framework_fid"];
    $data["sid"] = $form_state["values"]["framework_info_fieldset"]["site_sid"];
    $data["script"] = $form_state["values"]["framework_info_fieldset"]["framework_script"];
    $data["ad_script"] = $form_state["values"]["framework_info_fieldset"]["ad_script"];
    $data["sec"] = $form_state["values"]["framework_info_fieldset"]["sec"];
    $data["ss"] = $form_state["values"]["framework_info_fieldset"]["ss"];
    $data["account"] = $form_state["values"]["framework_account_fieldset"]["account"];
    $data["domain_name"] = $form_state["values"]['framework_account_fieldset']["domain_name"];


    $data["user"] = $form_state["values"]["framework_account_fieldset"]["user"];
    $data["password"] = $form_state["values"]["framework_account_fieldset"]["password"];
    $data["site_id"] = $form_state["values"]["framework_account_fieldset"]["site_id"];

    if ($data["name"] == "smart") {

        $data["prequal_url"] = $form_state["values"]["framework_account_fieldset"]["prequal_url"];
        variable_set("imx_ads_prequal_url_smart", $data["prequal_url"]);

        $data["prequal_status"] = $form_state["values"]["framework_account_fieldset"]["prequal_status"];
        variable_set("imx_ads_prequal_status_smart", $data["prequal_status"]);

        $data["smart_call_method"] = $form_state["values"]["framework_account_fieldset"]["smart_call_method"];
        variable_set("imx_ads_smart_call_method", $data["smart_call_method"]);

        $data["smart_legacy"] = $form_state["values"]["framework_account_fieldset"]["legacy"];
        variable_set("imx_ads_legacy_smart", $data["smart_legacy"]);

        $data["smart_urlhost"] = $form_state["values"]["framework_account_fieldset"]["urlhost"];
        variable_set("imx_ads_urlhost_smart", $data["smart_urlhost"]);

        $data["smart_tail_target"] = $form_state["values"]["framework_account_fieldset"]["tail_target"];
        variable_set("imx_ads_tail_target_smart", $data["smart_tail_target"]);

        $data["smart_off"] = $form_state["values"]["framework_account_fieldset"]["off"];
        variable_set("imx_ads_smart_off", $data["smart_off"]);

    }

    $framework = imx_ads_framework_update($data);
    if ($framework) {
        drupal_set_message(t('The block configuration has been saved.'));
    } else {
        drupal_set_message(t('Hubo un pex.'), "error");
    }
    //$form_state['redirect'] = 'admin/config/inventmx_ads/frameworks';
}

function imx_ads_framework_stop()
{
    $fid = arg(5);
    if (is_numeric($fid)) {
        $update_blocks = update_block_status_by_fid(0, $fid);
        if ($update_blocks) {
            drupal_set_message(t('Bloques detenidos.'));
        } else {
            drupal_set_message(t('Hubo un pex.'), "error");
        }
    } else {
        drupal_set_message(t('Fid invalido.'), "error");
    }
    drupal_goto("admin/config/inventmx_ads/frameworks");
}

function imx_ads_framework_start()
{
    $fid = arg(5);
    if (is_numeric($fid)) {
        $update_blocks = update_block_status_by_fid(1, $fid);
        if ($update_blocks) {
            drupal_set_message(t('Bloques activados.'));
        } else {
            drupal_set_message(t('Hubo un pex.'), "error");
        }
    } else {
        drupal_set_message(t('Fid invalido.'), "error");
    }
    drupal_goto("admin/config/inventmx_ads/frameworks");
}
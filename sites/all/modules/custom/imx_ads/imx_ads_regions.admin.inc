<?php

/**
 * @file
 * Administrative page callbacks for the imx_ads module.
 */

/**
 * Implements hook_admin_settings() for module settings configuration.
 */
function imx_ads_regions_admin_settings_form($form, &$form_state, $no_js_use = FALSE)
{

    $regions             = json_decode(variable_get("imx_ads_regions"), TRUE);
    $form['description'] = array(
        '#markup' => '<div>' . t('Configuración general de Imx Ads</div>')
    );

    // Because we have many fields with the same values, we have to set
    // #tree to be able to access them.
    $form['#tree']           = TRUE;
    $form['blocks_fieldset'] = array(
        '#type'   => 'fieldset',
        // Set up the wrapper so that AJAX will be able to replace the fieldset.
        '#prefix' => '<div id="enlaces-fieldset-wrapper">',
        '#suffix' => '</div>',
    );

    $form['blocks_fieldset']["vocabulario"] = array(
        '#type'          => "textfield",
        '#title'         => "Nombre maquina de Taxonomía de canales:",
        "#required"      => TRUE,
        "#default_value" => variable_get("imx_ads_vocabulary", "categorias"),
    );

    $form['blocks_fieldset']["regions"] = array(
        '#type'          => "checkboxes",
        '#title'         => "Regiones con publicidad:",
        "#required"      => TRUE,
        "#options"       => getOptionsRegions(),
        "#default_value" => $regions
    );

    $form['blocks_fieldset']["invoque_id"] = array(
        '#type'          => 'textarea',
        '#title'         => t("Secciones especiales para invocación de bloques ejem:  #carrusel,#carrusel_bottom"),
        '#default_value' => variable_get("imx_ads_invoque_ids","")
    );

    $form['blocks_fieldset']["submit"] = array(
        '#type'  => "submit",
        "#value" => "Guardar"
    );


    return $form;
}

function imx_ads_regions_admin_settings_form_submit($form, &$form_state)
{
    $regions          = array();
    $canales_taxonomy = "categorias";
    foreach ($form_state["values"]['blocks_fieldset']["regions"] as $key => $value) {
        if ($value) {
            $regions[$key] = $key;
        }
    }

    $canales_taxonomy = $form_state["values"]['blocks_fieldset']["vocabulario"];
    variable_set("imx_ads_regions", json_encode($regions));
    variable_set("imx_ads_vocabulary", $canales_taxonomy);

    $data["imx_ads_invoque_ids"]=$form_state["values"]['blocks_fieldset']["invoque_id"];
    variable_set("imx_ads_invoque_ids", $data["imx_ads_invoque_ids"]);

    drupal_set_message("Configuración guardada con exito");
}

function getOptionsRegions()
{
    $regions     = getAllRegions("dinero");
    $regions_ads = array();
    foreach ($regions as $key => $value) {
        $regions_ads[$key] = $value;
    }

    asort($regions_ads);
    return $regions_ads;
}
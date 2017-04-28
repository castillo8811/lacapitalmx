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
    $repo = arg(6);
    $site_arg = arg(5);
    $search = false;

    if (isset($_SESSION["imx_gcms"]["search"])) {
            $search = $_SESSION["imx_gcms"]["search"];
    }

    $form=array();

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

    $form["submit"] = array(
        '#type' => "submit",
        '#attributes' => array(
            'class' => array('container-inline'), // change to just 'text' for Drupal 6
        ),
        "#value" => "Buscar"
    );

    $path = drupal_get_path('module', 'imx_gcms');

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
    $site= arg(2);

    $search = $form_state["values"]["gmc_search"];

    if ($search) {
        $filters["search"] = $search;
    }

    if (count($filters)) {
        $_SESSION["imx_gcms"]["search"] = $search;
    }

    drupal_goto("/admin/content/{$site}");

}
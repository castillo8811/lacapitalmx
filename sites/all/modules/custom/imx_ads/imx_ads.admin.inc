<?php

/**
 * @file
 * Administrative page callbacks for the imx_ads module.
 */

/**
 * Implements hook_admin_settings() for module settings configuration.
 */
function imx_ads_admin_settings_form($form, &$form_state, $no_js_use = FALSE)
{

    $regions = getAllRegions("dinero");
    asort($regions);
    $regions_ads         = getRegionsForAds();
    $form['description'] = array(
        '#markup' => '<div>' . t('Configuracion de espacios publicitarios</div>')
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

    $i = 0;
    foreach ($regions as $key => $value) {
        if (array_key_exists($key, $regions_ads)) {
            $block                       = getBlockByRegion($key);
            $form['blocks_fieldset'][$i] = array(
                '#type'   => 'fieldset',
                '#title'  => t($value . "[{$key}]"),
                // Set up the wrapper so that AJAX will be able to replace the fieldset.
                '#prefix' => '<div id="region-fieldset">',
                '#suffix' => '</div>',
            );

            if ($block) {
                foreach ($block as $b) {
                    $data[]                                       = array(
                        l($b["title"], "admin/config/inventmx_ads/blocks/form/" . $b["bid"]),
                        l($b["block_info"], "admin/config/inventmx_ads/blocks/form/" . $b["bid"]),
                        l(($b["status"]) ? "Activo" : "Desactivo", "admin/config/inventmx_ads/blocks/form/" . $b["bid"]),
                        l("Editar", "admin/config/inventmx_ads/blocks/form/" . $b["bid"]),
                        l("Eliminar", "admin/config/inventmx_ads/blocks/delete/" . $b["title"])
                    );
                    $form['blocks_fieldset'][$i][$key][$b["bid"]] = array(
                        '#markup' => table_region($data)
                    );

                    $data = NULL;
                }
            }

            $form['blocks_fieldset'][$i]["add_espace"] = array(
                '#markup' => l("+Agregar espacio", "admin/config/inventmx_ads/blocks/form/{$key}"),
            );
            $i++;
        }
    }

    return $form;
}

function table_region($rows)
{
    $table = array(
        'header' => array(
            t('Block Name'),
            t('Block Info'),
            t('Status'),
            t('Editar'),
            t('Eliminar'),
        ),
        'rows'   => $rows
    );
    return theme('table', $table);
}
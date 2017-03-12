/**
 * @author Sergio Castillo
 */

jQuery(document).ready(function () {
    jQuery("#edit-block-display-fieldset-display-nodes-all input[type='checkbox']").each(function (e) {
        jQuery(this).change(function () {
            //console.log(jQuery(this).val());
            if (jQuery(this).val() == "*") {
                if (jQuery(this).is(":checked")) {
                    console.log("Activado");
                    jQuery(this).addClass("filter");
                    jQuery("#edit-block-display-fieldset-display-nodes-all input:not(.filter)").attr("checked", true);
                } else {
                    console.log("desactivado");
                    jQuery(this).removeClass("filter");
                    jQuery("#edit-block-display-fieldset-display-nodes-all input:not(.filter)").attr("checked", false);
                }
            } else {
                if (!jQuery(this).is(":checked")) {
                    jQuery("#edit-block-display-fieldset-display-nodes-all input").eq(0).attr("checked", false);
                }
            }
        });
    });

    jQuery("#edit-block-display-fieldset-display-canales-canales input[type='checkbox']").each(function (e) {
        jQuery(this).change(function () {
            //console.log(jQuery(this).val());
            if (jQuery(this).val() == "*") {
                if (jQuery(this).is(":checked")) {
                    console.log("Activado");
                    jQuery(this).addClass("filter");
                    jQuery("#edit-block-display-fieldset-display-canales-canales input:not(.filter)").attr("checked", true);
                } else {
                    console.log("desactivado");
                    jQuery(this).removeClass("filter");
                    jQuery("#edit-block-display-fieldset-display-canales-canales input:not(.filter)").attr("checked", false);
                }
            } else {
                if (!jQuery(this).is(":checked")) {
                    jQuery("#edit-block-display-fieldset-display-canales-canales input").eq(0).attr("checked", false);
                }
            }
        });
    });


    jQuery("#edit-block-display-fieldset-display-canales input[type='checkbox']").each(function (e) {
        jQuery(this).change(function () {
            if (jQuery(this).is(":checked")) {
                value_parent = jQuery(this).val();
                console.log(value_parent);
                jQuery(".childs-" + value_parent).attr("checked", "checked");
            } else {
                value_parent = jQuery(this).val();
                jQuery(".childs-" + value_parent).attr("checked", false);
            }

        });
    });


    //Activado dinamico de los subcanales

    jQuery("#edit-block-display-fieldset-display-nodes-all input[type='checkbox']").each(function (e) {
        jQuery(this).change(function () {
            if (jQuery(this).is(":checked")) {
                value_parent = jQuery(this).val();
                console.log(value_parent);
                jQuery(".subcanal-childs-" + value_parent).attr("checked", "checked");
            } else {
                value_parent = jQuery(this).val();
                jQuery(".subcanal-childs-" + value_parent).attr("checked", false);
            }

        });
    });

    //Desactivado de subcanales
    jQuery("#edit-block-display-fieldset-general-taxonomy-all").change(function () {
        if (jQuery(this).is(":checked")) {
            jQuery("#edit-block-display-fieldset-display-canales").attr("disabled", true);
            jQuery("#edit-block-display-fieldset-display-tags").attr("disabled", true);

        } else {
            jQuery("#edit-block-display-fieldset-display-canales").attr("disabled", false);
            jQuery("#edit-block-display-fieldset-display-tags").attr("disabled", false);
        }
    });

});
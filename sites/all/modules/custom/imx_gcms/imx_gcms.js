/**
 * @author Sergio Castillo
 */

jQuery(document).ready(function () {
    //Activado dinamico de los subcanales
    jQuery("#edit-gmc-series").attr("disabled", true);
    jQuery(".form-item-gmc-search").css("width", "20%");

    if (jQuery("#edit-gmc-data-source").val() == 3) {
        jQuery("#edit-gmc-site").attr("disabled", true);
        jQuery("#edit-gmc-types").attr("disabled", true);
        jQuery("#edit-gmc-data-source").attr("disabled", false);
        jQuery("#edit-gmc-series").attr("disabled", false);
        jQuery(".form-item-gmc-series").show();
        jQuery("#edit-gmc-series").show();
        jQuery(".form-item-gmc-site").hide();
        jQuery(".form-item-gmc-types").hide();
        jQuery(".form-item-gmc-data-source").hide();
        jQuery(".form-item-gmc-search").css("width", "20%");
    } else if (jQuery("#edit-gmc-data-source").val() == 5) {
        jQuery("#edit-gmc-types").attr("disabled", true);
        jQuery("#edit-gmc-types").hide();
        jQuery("#edit-gmc-series").attr("disabled", true);
        jQuery("#edit-gmc-series").hide();
        jQuery(".form-item-gmc-search").css("width", "20%");
        jQuery(".form-item-gmc-series").hide();
        jQuery(".form-item-gmc-types").hide();

    } else {
        jQuery(".form-item-gmc-site").show();
        jQuery(".form-item-gmc-types").show();
        jQuery("#edit-gmc-types").show();
        jQuery(".form-item-gmc-data-source").show();
        jQuery("#edit-gmc-series").attr("disabled", true);
        jQuery("#edit-gmc-series").hide();
        jQuery(".form-item-gmc-series").hide();

    }

    jQuery("#edit-gmc-data-source").change(function () {
        mode = jQuery(this).val();
        if (mode == 2) {
            jQuery("#edit-gmc-site").val("hub").change();
            jQuery("#edit-gmc-site").attr("disabled", false);
            jQuery("#edit-gmc-categories").attr("disabled", false);
            jQuery("#edit-gmc-types").attr("disabled", false);
        } else if (mode == 3 || mode == 4) {
            jQuery("#edit-gmc-types").attr("disabled", true);
        } else {
            jQuery("#edit-gmc-site").attr("disabled", false);
            jQuery("#edit-gmc-categories").attr("disabled", false);
            jQuery("#edit-gmc-types").attr("disabled", false);
            jQuery("#edit-gmc-series").attr("disabled", true);
            jQuery("#edit-gmc-data-source").attr("disabled", false);

            jQuery(".form-item-gmc-site").show();
            jQuery(".form-item-gmc-types").show();
            jQuery(".form-item-gmc-data-source").show();

        }

        if (mode == 3) {
            jQuery("#edit-gmc-site").val("inventmx").change();
            jQuery("#edit-gmc-site").attr("disabled", true);
            jQuery("#edit-gmc-types").attr("disabled", true);
            jQuery("#edit-gmc-data-source").attr("disabled", false);

            jQuery(".form-item-gmc-site").hide();
            jQuery(".form-item-gmc-types").hide();
            jQuery(".form-item-gmc-data-source").hide();
            jQuery(".form-item-gmc-search").css("width", "20%");

            jQuery("#edit-gmc-series").attr("disabled", false);
            jQuery(".form-item-gmc-series").show();
            jQuery("#edit-gmc-series").show();

        }

        if (mode == 5) {
            jQuery("#edit-gmc-types").attr("disabled", true);
            jQuery("#edit-gmc-types").hide();
            jQuery("#edit-gmc-series").attr("disabled", true);
            jQuery("#edit-gmc-series").hide();
            jQuery(".form-item-gmc-search").css("width", "20%");
        }

    });
});
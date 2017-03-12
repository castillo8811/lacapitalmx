var imx_nm_send_info = false;
newsletter_comfirm_config = {
    expires: 30,
    path: "/",
    domain: _get_domain()
};
jQuery(document).ready(function () {

    jQuery("#imx_nm_name,#imx_nm_mail").each(function () {
        jQuery(this).focus(function () {
            if (jQuery(this).hasClass("clean_first")) {
                jQuery(this).val("");
                jQuery(this).removeClass("clean_first");
            }
        });
    });

    jQuery("#imx_nm_mail").focus(function () {
        if (jQuery("#imx_nm_name").hasClass("clean_first")) {
            name_temp = jQuery("#imx_nm_name").val();
            if (name_temp == "Ingresa tu nombre" || name_temp == "INGRESA TU NOMBRE") {
                jQuery("#imx_nm_name").val("");
            }
            jQuery(this).removeClass("clean_first");
            jQuery(this).removeClass("clean_first");
        }
    });

    jQuery("#imx-newsletter-block-data").submit(function (e) {
        if (jQuery("#imx-newsletter-block-data").valid() && !imx_nm_send_info) {
            e.preventDefault();
            imx_nm_send_info = true;
            imx_name = jQuery("#imx_nm_name").val();
            imx_mail = jQuery("#imx_nm_mail").val();
            jQuery(".imx_news_loading").show();
            jQuery.ajax({
                url: '/newsletter-modal/close',
                type: 'POST',
                timeout:60000,
                data: {imx_name: imx_name, imx_mail: imx_mail},
                success: function (result) {
                    if (result) {
                        jQuery(".imx-newsletter-block-form").html(
                            "<div class='imx-newsletter-thanks'><h1>Muchas gracias por ser parte de LA CAPITAL</h1><h2>A partir de ahora recibirás la mejor información en tu correo electrónico</h2></div>");
                        imx_nm_send_info = false;
                        jQuery.cookie("newsletter_modal_confirm", true, newsletter_comfirm_config);
                    }
                }
            });
        }

        return false;
    });

    jQuery("#imx-newsletter-block-data").validate({
            rules: {
                imx_nm_mail: {
                    required: true,
                    email: true
                },
                imx_nm_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 120
                },
                imx_nm_mail_check: "required"
            },
            messages: {
                imx_nm_mail: "Por favor ingresa un correo válido",
                imx_nm_name: {
                    required: "Por favor ingresa tu nombre",
                    minlength: "Tu nombre debe ser mayor a 3 caracteres"
                },
                imx_nm_mail_check: "Debes aceptar el aviso de privacidad para finalizar tu suscripción"
            }
        });
});

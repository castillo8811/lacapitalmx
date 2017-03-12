jQuery(document).ready(function() {
    jQuery(".fancybox").live('click', function() {
        jQuery(this).fancybox({
            scrolling: 'no',
            width : 478,
            autoSize   : true,
            autoHeight : true,
            autoWidth  : false
        });
    });
});
//
//////var tb_pathToImage = 'images/loading.gif';
///*!!!!!!!!!!!!!!!!! edit below this line at your own risk !!!!!!!!!!!!!!!!!!!!!!!*/
////on page load call tb_init
//
//jQuery(document).ready(function() {
//    
//    //Protected capture
//    jQuery(".node-form .form-submit").click(function() {
//        jQuery(this).css('display', 'none');
//    });
//
//    //Personalización de tamano de ventana
//    var ventana = {
//        alto: {
//            sesion: 360,
//            registro: 520
//        },
//        ancho: {
//            sesion: 460,
//            registro: 460
//        }
//    };
//    // Config Thickbox.
//    tb_window_settings = {
//        size: {
//            width: ventana.ancho.sesion,
//            height: ventana.alto.sesion
//        },
//        modal: false
//    };
//    //A ver si jala esto
//    if (Drupal.Ajax) {
//        if (Drupal.Ajax.userfem && typeof Drupal.Ajax.userfem !== "undefined") {
//            Drupal.Ajax.userfem.action = 'login';
//            Drupal.Ajax.userfem.registrando = function() {
//                if (Drupal.Ajax.userfem.data.form_id !== 'user_login') {
//                    var st = jQuery.cookie('page_count');
//                    if (st == 2 || st > 3) {
//                        st = 0;
//                    }
//                    tb_window_show('', '/userfem/message?st=' + st, ventana.ancho.registro, 300, false);
//                    tb_focusFirstFormElement();
//                    adwords_conversion_track_ajax(st);
//                    return false;
//                } else {
//                    return true;
//                }
//            };
//        }
//    }
//
//    jQuery('#ver-politicas').live('click', function() {
//        window.open("http://www.actitudfem.com/politicas-de-privacidad", "terminos-y-condiciones", "menubar=0,status=0,scrollbars=1;resizable=1,width=640,height=480");
//    });
//
//    jQuery('#TB_ajaxContent #edit-name').live('keypress', function(event) {
//        return valida.alfanumericosignos_sinenter(event);
//    });
//    jQuery('#TB_ajaxContent #edit-mail').live('keypress', function(event) {
//        return valida.string_email(event);
//    });
//    jQuery('#TB_ajaxContent #edit-pass').live('keypress', function(event) {
//        return valida.alfanumericosignos_sinenter(event);
//    });
//    jQuery('#TB_ajaxContent #edit-pass-pass1').live('keypress', function(event) {
//        return valida.alfanumericosignos_sinenter(event);
//    });
//    jQuery('#TB_ajaxContent #edit-pass-pass2').live('keypress', function(event) {
//        return valida.alfanumericosignos_sinenter(event);
//    });
//
//    jQuery('#TB_ajaxContent #edit-name').blur(function() {
//        return check_field_exists('name');
//    });
//
//    jQuery('#TB_ajaxContent #edit-mail').blur(function() {
//        return check_field_exists('mail');
//    });
//
//    jQuery('#TB_ajaxContent #user-register #edit-submit').live('click', function() {
//        var opciones = {
//            success: register_success //funcion que se ejecuta una vez enviado el formulario
//        };
//        jQuery(this).val('Validando...');
//        //Validar campos llenos
//        if (jQuery('#edit-name').val() !== '') {
//            if (jQuery('#edit-mail').val() !== '') {
//                if (valida.email(jQuery('#edit-mail').val())) {
//                    if (jQuery('#edit-pass-pass1').val() !== '') {
//                        if (jQuery('#edit-pass-pass2').val() !== '') {
//                            if (jQuery('#edit-pass-pass1').val() === jQuery('#edit-pass-pass2').val()) {
//                                if (check_preferencias_news()) {
//                                    if (jQuery('#politicas-uso').attr('checked')) {
//                                        //Validar si nombre existe
//                                        var name_exists = check_field_exists('name');
//                                        if (!name_exists) {
//                                            //Validar si mail existe
//                                            var mail_exists = check_field_exists('mail');
//                                            if (!mail_exists) {
//                                                jQuery('#user-register').submit(function() {
//                                                    jQuery(this).ajaxSubmit(opciones);
//                                                });
//                                                jQuery('#user-register').submit();
//                                            }
//                                        }
//                                    } else {
//                                        show_errors('* Debes aceptar los Términos y condiciones para tu registro en FEM', '#politicas-uso');
//                                    }
//                                } else {
//                                    show_errors('* Debes elegir al menos una sección de tu interés', '#actitud');
//                                }
//                            } else {
//                                show_errors('* Las contraseñas deben ser iguales', '#edit-pass-pass1');
//                            }
//                        } else {
//                            show_errors('* Debes confirmar tu contraseña', '#edit-pass-pass2');
//                        }
//                    } else {
//                        show_errors('* El campo contraseña es obligatorio', '#edit-pass-pass1');
//                    }
//                } else {
//                    show_errors('* El e-mail tiene que ser un e-mail válido', '#edit-mail');
//                }
//            } else {
//                show_errors('* El campo e-mail es obligatorio', '#edit-mail');
//            }
//        } else {
//            show_errors('* El campo nombre es obligatorio', '#edit-name');
//        }
//        return false;
//    });
//
//
//    jQuery('#news-enviar').live('click', function() {
//        if (jQuery('#politicas-uso').attr('checked')) {
//            //Politicas aceptadas hacer el registro de los temas de interés del usuario
//            jQuery('#message-politicas-uso').html('');
//            //Llamada ajax para registro de preferencias 
//            registra_preferencias_news();
//        } else {
//            //Politicas no aceptadas regresar el foco al control para que seleccione
//            jQuery('#politicas-uso').focus();
//            jQuery('#message-politicas-uso').html('<span class="error">Debes aceptar los Términos de servicio y las Políticas de privacidad</span>');
//        }
//        return false;
//    });
//
//    jQuery('#btn-terminar').live('click', function() {
//        window.location.reload();
//    });
//
//    jQuery('#btn-mis-favoritos').live('click', function() {
//        window.location.href = '/mis-favoritos';
//    });
//
//    jQuery('a.thickbox').bind('click', function() {
//        var url = jQuery(this).attr('href');
//        var height = 0;
//        var width = 0;
//
//        if (jQuery(this).hasClass('ulogin')) {
//            height = ventana.alto.sesion;
//            width = ventana.ancho.sesion;
//            //			Drupal.Ajax.userfem.action='login';
//        } else {
//            height = ventana.alto.registro;
//            width = ventana.ancho.registro;
//            //			Drupal.Ajax.userfem.action='register';
//        }
//
//        tb_window_show('', url, width, height, false);
//
//        tb_focusFirstFormElement();
//
//        return false;
//    });
//
//    jQuery('.registrate_login span.n').live('click', function() {
//        jQuery('#TB_overlay').click(tb_remove);
//        var url = '';
//        var height = 0;
//        var width = 0;
//
//        if (jQuery(this).hasClass('register')) {
//            url = '/userfem/login';
//            height = ventana.alto.sesion;
//            width = ventana.ancho.sesion;
//            //			Drupal.Ajax.userfem.action='login';
//        } else {
//            url = '/userfem/register';
//            height = ventana.alto.registro;
//            width = ventana.ancho.registro;
//            //			Drupal.Ajax.userfem.action='register';
//            jQuery(this).children('#TB_ajaxContent #edit-pass-wrapper label').css({
//                'width': 'none'
//            });
//        }
//
//        tb_window_show('', url, width, height, false);
//        tb_focusFirstFormElement();
//    });
//    jQuery('#user-pass .form-submit').live('click', function() {
//
//        var url = '';
//        var height = 0;
//        var width = 0;
//
//        if (jQuery('#edit-name-1').val() != '') {
//            if (valida.email(jQuery('#edit-name-1').val())) {
//                jQuery.ajax({
//                    url: '/userfem/recordar_pass',
//                    dataType: 'json',
//                    type: 'POST',
//                    data: 'correo=' + jQuery('#edit-name-1').val(),
//                    success: function(data) {
//
//                        if (data.bandera == 1) {
//                            //                                             alert('se enviaron correctamente.');
//                            tb_window_show('', '/tools_notafinal/confirmacion?msj=Se%20enviaron%20instrucciones%20a%20su%20correo.', 720, 150, false);
//                            //                                             jQuery('#TB_closeWindowButton').click();
//                        } else {
//                            tb_window_show('', '/tools_notafinal/confirmacion?msj=Error,%20por%20favor%20vuelva%20a%20intentarlo%20en%20algunos%20minutos.', 720, 150, false);
//                            //                                            alert('Error enviando la contraseña, por favor, vuelva a intentarlo en algunos minutos.');
//                        }
//
//                    }
//                });
//            } else {
//                alert('Ingresar un correo valido.');
//            }
//        } else {
//            alert('Necesitas ingresar tu correo.');
//        }
//
//        return false;
//    });
//    jQuery('.registrate_login span.n').live('mouseover', function() {
//        jQuery(this).css({
//            'cursor': 'pointer'
//        })
//    });
//    jQuery('.registrate_login span.n').live('mouseout', function() {
//        jQuery(this).css({
//            'cursor': 'none'
//        })
//    });
//
//    jQuery('#user-login #edit-submit').live('click', function() {
//        jQuery('#TB_ajaxContent #container-error-messages').html(' - ');
//        if (jQuery('#edit-name').val() == '') {
//            show_errors('* El campo e-mail es obligatorio', '#edit-name');
//        } else if (jQuery('#edit-pass').val() == '') {
//            show_errors('* El campo contrasena es obligatorio', '#edit-pass');
//        } else {
//            var status = false;
//            jQuery.ajax({
//                url: '/userfem/news/mail_exists',
//                data: {
//                    fdata: jQuery('#edit-name').val()
//                },
//                dataType: 'json',
//                cache: false,
//                async: false,
//                type: 'post',
//                statusCode: {
//                    404: function() {
//                        show_errors('* Hay algún problema con tu petición inténtalo más tarde por favor', jQuery('#edit-name').focus());
//                    }
//                },
//                success: function(data) {
//                    status = data.status;
//                    //                           show_errors(data.message,jQuery('#edit-name').focus());
//                }
//            });
//            if (!status) {
//                jQuery.ajax({
//                    url: '/userfem/news/name_exists',
//                    data: {
//                        fdata: jQuery('#edit-name').val()
//                    },
//                    dataType: 'json',
//                    cache: false,
//                    async: false,
//                    type: 'post',
//                    statusCode: {
//                        404: function() {
//                            show_errors('* Hay algún problema con tu petición inténtalo más tarde por favor', jQuery('#edit-name').focus());
//                        }
//                    },
//                    success: function(data) {
//                        status = data.status;
//                    }
//                });
//            }
//            if (!status) {
//                show_errors('No se encuentra registrado en nuestra base de datos, favor de registrarte. ', jQuery('#edit-name').focus());
//            }
//        }
//
//    });
//
//    jQuery('#TB_ajaxContent h3').live('click', function() {
//        //oculta form login
//        jQuery('#login-title').css({
//            'display': 'none'
//        })
//        jQuery('#user-login').css({
//            'display': 'none'
//        });
//        jQuery(this).css({
//            'display': 'none'
//        });
//        //muestra form password
//        jQuery('#TB_ajaxContent .forgot-password-content').css({
//            'display': 'block'
//        });
//    }).live('mouseover', function() {
//        jQuery(this).css({
//            'cursor': 'pointer'
//        })
//    }).live('mouseout', function() {
//        jQuery(this).css({
//            'cursor': 'none'
//        })
//    });
//
//    //imgLoader.src = tb_pathToImage;
//
//    function check_field_exists(field) {
//        var result = false;
//        jQuery.ajax({
//            url: '/userfem/news/' + field + '_exists',
//            data: {
//                fdata: jQuery('#edit-' + field).val()
//            },
//            dataType: 'json',
//            cache: false,
//            async: false,
//            type: 'post',
//            statusCode: {
//                404: function() {
//                    show_errors('* Hay algún problema con tu petición inténtalo más tarde por favor', jQuery(selector).focus());
//                }
//            },
//            success: function(data) {
//                show_errors(data.message, jQuery('#edit-' + field).focus());
//                result = data.status;
//            }
//        });
//        return result;
//    }
//
//    function show_errors(message, selector) {
//        if (message !== '') {
//            jQuery('#TB_ajaxContent #container-error-messages').html(message);
//        } else {
//            jQuery('#TB_ajaxContent #container-error-messages').html('Error no especificado, inténtalo de nuevo');
//        }
//        jQuery('#TB_ajaxContent #user-register #edit-submit').val('Siguiente');
//        jQuery(selector).focus();
//    }
//
//    function check_preferencias_news() {
//        var preferences = new Array();
//        jQuery('.newsfem:checked').each(function() {
//            preferences.push(jQuery(this).val());
//        });
//
//        if (preferences.length > 0) {
//            jQuery('#newsletter:checked').each(function() {
//                preferences.push(jQuery(this).val());
//            });
//            jQuery('#TB_ajaxContent #edit-topics').val(preferences.join(','));
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//    function registra_preferencias_news() {
//        var preferences = new Array();
//        jQuery('.newsfem:checked').each(function() {
//            preferences.push(jQuery(this).val());
//        });
//
//        if (preferences.length > 0) {
//            jQuery.ajax({
//                url: '/userfem/news/preferences',
//                data: {
//                    tid: [preferences]
//                },
//                dataType: 'json',
//                cache: false,
//                async: false,
//                type: 'post',
//                statusCode: {
//                    404: function() {
//                        alert('Página no encontrada, inténtalo más tarde');
//                    }
//                },
//                success: function(data) {
//                    if (data.status) {
//                        register_success();
//                    } else {
//                        alert('No se registraron correctamente tus temas, ve a tus favoritos para editarlos');
//                    }
//                }
//            });
//        } else {
//            alert('Debes seleccionar al menos un tema');
//        }
//
//        return false;
//    }
//
//    function register_success() {
//        tb_window_show('', '/userfem/message', ventana.ancho.registro, 290, false);
//        tb_focusFirstFormElement();
//        return true;
//    }
//
//});
//
//function adwords_conversion_track_ajax(st) {
//    if (st == 2 || st > 3) {
//        return;
//    }
//
//    var iframe = document.createElement('iframe');
//    iframe.style.width = '0px';
//    iframe.style.height = '0px';
//    document.body.appendChild(iframe);
//    iframe.src = 'http://' + location.host + '/camps/registro' + st + '.html';
//}

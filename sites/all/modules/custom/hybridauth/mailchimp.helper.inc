<?php

/**
 * Zona de validacion de existencia de emails en lista de mailchimp
 */

/**
 * Verfica si un email ya esta en la lista maestra de usuarios de mailchimp
 * Retorna true si el usuario existe en la lista, false si el usuario no existe en la lista
 * si existe algun error en la conexion con el api de mailchimp se retorna el string 'error'
 * @param object $api
 *   El objeto del api de mailchimp para peticiones
 * @param string $email
 *   El email que se buscara en la lista
 * @param string $listId
 *   El id de la lista en la que buscar el email
 * @return null|string|boolean
 */

function imx_hybridauth_check_if_exist_mail_mailchimp_list($api = NULL, $email = '', $listId = NULL) {
    if (!$api || !$listId) {
        return NULL;
    }
    $mail[] = array('email' => $email);
    try {
        $retval = $api->lists->memberInfo($listId, $mail);
        if ($retval['success_count'] == 1) {
            //el email existe
            $return_val = TRUE;
        } else {
            //no existe el email
            $return_val = FALSE;
        }
    } catch (Mailchimp_Error $e) {
        //this excepcion capcth all errors
        return 'error';
    }
    return $return_val;
}

/**
 *
 * @param type $api
 * @param type $email
 * @param type $listId
 * @return null|string|boolean
 */
function imx_hybridauth_update_check_if_exist_mail_mailchimp_list($api = NULL, $email = '', $listId = NULL) {
    $return_val = array();
    if (!$api || !$listId) {
        //no enviaron ni el api ni la lista
        $return_val['value'] = NULL;
    } else {
        $mail[] = array('email' => $email);
        try {
            $retval = $api->lists->memberInfo($listId, $mail);
            if ($retval['success_count'] == 1) {
                //si existe el email
                $return_val['value'] = TRUE;
                // agregamos el status del usuario para validar si esta activo o no
                $return_val['status'] = $retval['data'][0]['status'];
            } else {
                //no existe el email registrado
                $return_val['value'] = FALSE;
            }
        } catch (Mailchimp_Error $e) {
            //this excepcion capcth all errors
            $return_val['value'] = 'error';
        }
    }
    return $return_val;
}

/**
 *
 * @param type $api
 * @param type $mail
 * @param type $listId
 * @param type $merge_vars
 */
function imx_hybridauth_update_or_suscribe_account_of_user_mailchimp($api = NULL, $mail = '', $listId = NULL, $merge_vars = array()) {
    if (!$api || !$listId) {
        return NULL;
    }
    $update = false;
    $retval = imx_hybridauth_update_check_if_exist_mail_mailchimp_list($api, $mail, $listId); //validamos existencia
    if ($retval['value'] == TRUE) {
        // el usuario existe por lo tanto validar el status para actualizar
        if ($retval['status'] == 'subscribed') {
            //actualizar datos del usuario
            $update = imx_hybridauth_update_user_in_mailchimp_list_master($api, $mail, $listId, $merge_vars);
        }
    } else if ($retval['value'] == FALSE) {
        //no existe por lo tanto suscribirlo a la lista
        $update = imx_hybridauth_add_user_to_mailchimp_list($api, $mail, $listId, $merge_vars);
    }
    return $update;
}

/**
 *
 * @param type $api
 * @param type $init_mail
 * @param type $listId
 * @param type $new_email
 * @param type $merge_vars
 */
function imx_hybridauth_update_or_register_changes_of_email_mailchimp($api = NULL, $init_mail = '', $listId = NULL, $new_email = '', $merge_vars = array()) {
    if (!$api || !$listId) {
        return NULL;
    }
    $update = false;
    $retval = imx_hybridauth_update_check_if_exist_mail_mailchimp_list($api, $init_mail, $listId);
    if ($retval['value'] == TRUE) {
        if ($retval['status'] == 'subscribed') {
            //actualizar la cuenta del usuario cambiando el email
            $update = imx_hybridauth_update_member_changing_email_list($api, $init_mail, $listId, $merge_vars, $new_email);
        }
    } else if ($retval['value'] == FALSE) {
        //verificar que el nuevo email exista o no en la lista
        $update = imx_hybridauth_update_or_suscribe_account_of_user_mailchimp($api, $new_email, $listId, $merge_vars);
    }
    return $update;
}

/**
 * Funciones para agregar, actualizar o eliminar
 * usuarios en listas de mailchimp
 */

/**
 * Agrega a un usuario (email) a una lista de mailchimp, retorna True si fue exitosa,
 * retorna false si no se pudo agregar el usuario
 * Si el email ya existe en la lista lo actualizara
 * Se reciben los datos para setear la configuracion del suscriptor en la lista
 * en la variable $merge_vars ejemplo (nombre,grupos)
 * @param object $api
 *   El objeto del api de mailchimp para peticiones
 * @param string $email
 *   El email que se desea agregar a una lista de maiclhimp
 * @param string $listId
 *   El id de una lista de mailchimp
 * @param mixed $merge_vars
 *   valores para setear la configuracion de inicio de la cuenta ejemplo(FNAME, GROUPING, etc)
 * @return boolean
 */
function imx_hybridauth_add_user_to_mailchimp_list($api = NULL, $email = '', $listId = NULL, $merge_vars = array()) {
    if ($api == NULL || $email == '' || $listId == NULL) {
        return FALSE;
    }
    $double_optin = FALSE; //FALSE si se pone como false no envia correo de confirmacion pero por default es true y si envia correo de confirmacion
    $update_existing = TRUE;
    $replace_interests = TRUE;
    $send_welcome = false;
    try {
        $add = $api->lists->subscribe($listId, array('email' => $email), $merge_vars, 'html', $double_optin, $update_existing, $replace_interests, $send_welcome);
        if (!empty($add)) {
            $retval = TRUE;
        } else {
            $retval = FALSE;
        }
    } catch (Mailchimp_Error $e) {
        //this excepcion capcth all errors
        return FALSE;
    }
    return $retval;
}

/**
 *
 * @param type $api
 * @param type $email
 * @param type $listId
 * @param type $merge_vars
 * @return boolean
 */
function imx_hybridauth_update_user_in_mailchimp_list_master($api = NULL, $email = '', $listId = NULL, $merge_vars = array()) {
    if ($api == NULL || $email == '' || $listId == NULL) {
        return FALSE;
    }
    //actualizamos preferencias del usuario en la lista de mailchimp
    // a esta funcion se le manda como usltimo parametro true para que sobrescriba las preferencias del usaurio
    try {
        $update = $api->lists->updateMember($listId, array('email' => $email), $merge_vars, 'html', TRUE);
        if (!empty($update)) {
            $retval = TRUE;
        } else {
            $retval = FALSE;
        }
    } catch (Mailchimp_Error $e) {
        //this excepcion capcth all errors
        return FALSE;
    }
    return $retval;
}

/**
 *
 * @param type $api
 * @param type $email
 * @param type $listId
 * @param type $merge_vars
 * @param type $new_email
 * @return boolean
 */
function imx_hybridauth_update_member_changing_email_list($api = NULL, $email = '', $listId = NULL, $merge_vars = array(), $new_email = '') {
    if ($api == NULL || $email == '' || $listId == NULL) {
        return FALSE;
    }
    $var_push = array('NEW-EMAIL' => $new_email);
    $merge = array_merge($var_push, $merge_vars);
    //actualizamos preferencias del usuario en la lista de mailchimp
    // a esta funcion se le manda como usltimo parametro true para que sobrescriba las preferencias del usaurio
    try {
        $update = $api->lists->updateMember($listId, array('email' => $email), $merge, 'html', TRUE);
        if (!empty($update)) {
            $retval = TRUE;
        } else {
            $retval = FALSE;
        }
    } catch (Mailchimp_Error $e) {
        //this excepcion capcth all errors
        return FALSE;
    }
    return $retval;
}

/**
 *
 * @param type $api
 * @param type $email
 * @param type $listId
 * @return boolean
 */
function imx_hybridauth_unsubcribe_member_of_mailchimp_list($api = NULL, $email = '', $listId = NULL) {
    if ($api == NULL || $email == '' || $listId == NULL) {
        return FALSE;
    }
    try {
        $unsubscribe = $api->lists->unsubscribe($listId, array('email' => $email), true, false, false);
        if ($unsubscribe['complete'] == TRUE) {
            $retval = TRUE;
        } else {
            $retval = FALSE;
        }
    } catch (Mailchimp_Error $e) {
        //this excepcion capcth all errors
        return FALSE;
    }
    return $retval;
}
?>
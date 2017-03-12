<?php
function autologin_social_configuraciones_form($form, &$form_state) {
    $form['google'] = array(
        '#type' => 'fieldset',
        '#title' => t('Configuraciones  Autologin'),
        '#weight' => 1,
    );
  $form['google']['Desactivar_Autologin'] = array(
  '#type' => 'checkbox',
       '#default_value' => 1,
  '#title' => t('Desactivar  Autologin  general'),
);
  
  $form['google']['Aviso_Autologueo'] = array(
  '#type' => 'checkbox',
       '#default_value' => 1,
  '#title' => t('Activar el aviso de autologueo "Popup"'),
      
      
);
     $form['google']['save'] = array(
        '#type' => 'submit',
        '#value' => 'Guadar configuracion',
        '#require' => TRUE,
        '#maxlength' => 250,
        '#size' => 95,
    ); 
  
  
  return $form;
}

function  autologin_social_configuraciones_form_validate($form ,&$form_state){
 
}

function autologin_social_configuraciones_form_submit ($form,&$form_state){
    variable_set('Autologin_desactivar', $form_state['values']['Desactivar_Autologin']);
    variable_set('Activar_popup', $form_state['values']['Aviso_Autologueo']);
   
    drupal_set_message('Se a guardado la configuracion   el comportammiento de Autologin  ');
    
}
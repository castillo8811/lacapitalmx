$view = new view();
$view->name = 'imx_blog';
$view->description = '';
$view->tag = 'default';
$view->base_table = 'node';
$view->human_name = 'imx_blogs';
$view->core = 7;
$view->api_version = '3.0';
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

/* Display: Master */
$handler = $view->new_display('default', 'Master', 'default');
$handler->display->display_options['use_more_always'] = FALSE;
$handler->display->display_options['access']['type'] = 'perm';
$handler->display->display_options['cache']['type'] = 'none';
$handler->display->display_options['query']['type'] = 'views_query';
$handler->display->display_options['query']['options']['pure_distinct'] = TRUE;
$handler->display->display_options['exposed_form']['type'] = 'basic';
$handler->display->display_options['exposed_form']['options']['reset_button_label'] = 'Reiniciar';
$handler->display->display_options['pager']['type'] = 'full';
$handler->display->display_options['pager']['options']['tags']['first'] = '« primera';
$handler->display->display_options['pager']['options']['tags']['previous'] = '‹ anterior';
$handler->display->display_options['pager']['options']['tags']['next'] = 'siguiente ›';
$handler->display->display_options['pager']['options']['tags']['last'] = 'última »';
$handler->display->display_options['style_plugin'] = 'default';
$handler->display->display_options['row_plugin'] = 'fields';
/* Campo: Contenido: Título */
$handler->display->display_options['fields']['title']['id'] = 'title';
$handler->display->display_options['fields']['title']['table'] = 'node';
$handler->display->display_options['fields']['title']['field'] = 'title';
$handler->display->display_options['fields']['title']['label'] = '';
$handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
$handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
/* Sort criterion: Contenido: Publicacion */
$handler->display->display_options['sorts']['created']['id'] = 'created';
$handler->display->display_options['sorts']['created']['table'] = 'node';
$handler->display->display_options['sorts']['created']['field'] = 'created';
$handler->display->display_options['sorts']['created']['order'] = 'DESC';
/* Filter criterion: Contenido: Publicado */
$handler->display->display_options['filters']['status']['id'] = 'status';
$handler->display->display_options['filters']['status']['table'] = 'node';
$handler->display->display_options['filters']['status']['field'] = 'status';
$handler->display->display_options['filters']['status']['value'] = 1;
$handler->display->display_options['filters']['status']['group'] = 1;
$handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;

/* Display: page_canal_blog */
$handler = $view->new_display('page', 'page_canal_blog', 'page_canal_blog');
$handler->display->display_options['defaults']['title'] = FALSE;
$handler->display->display_options['defaults']['access'] = FALSE;
$handler->display->display_options['access']['type'] = 'perm';
$handler->display->display_options['defaults']['cache'] = FALSE;
$handler->display->display_options['cache']['type'] = 'time';
$handler->display->display_options['cache']['results_lifespan'] = '3600';
$handler->display->display_options['cache']['results_lifespan_custom'] = '0';
$handler->display->display_options['cache']['output_lifespan'] = '-1';
$handler->display->display_options['cache']['output_lifespan_custom'] = '0';
$handler->display->display_options['defaults']['pager'] = FALSE;
$handler->display->display_options['pager']['type'] = 'full';
$handler->display->display_options['pager']['options']['items_per_page'] = '17';
$handler->display->display_options['pager']['options']['offset'] = '0';
$handler->display->display_options['pager']['options']['id'] = '0';
$handler->display->display_options['pager']['options']['quantity'] = '9';
$handler->display->display_options['pager']['options']['tags']['first'] = '« primera';
$handler->display->display_options['pager']['options']['tags']['previous'] = '‹ anterior';
$handler->display->display_options['pager']['options']['tags']['next'] = 'siguiente ›';
$handler->display->display_options['pager']['options']['tags']['last'] = 'última »';
$handler->display->display_options['defaults']['relationships'] = FALSE;
/* Relationship: Contenido: Taxonomy terms on node */
$handler->display->display_options['relationships']['term_node_tid']['id'] = 'term_node_tid';
$handler->display->display_options['relationships']['term_node_tid']['table'] = 'node';
$handler->display->display_options['relationships']['term_node_tid']['field'] = 'term_node_tid';
$handler->display->display_options['relationships']['term_node_tid']['required'] = TRUE;
$handler->display->display_options['relationships']['term_node_tid']['vocabularies'] = array(
  'blogs' => 'blogs',
  'especiales' => 0,
  'navegacion_adrenalina' => 0,
  'secciones' => 0,
  'suplementos' => 0,
);
/* Relationship: Contenido: Autor */
$handler->display->display_options['relationships']['uid']['id'] = 'uid';
$handler->display->display_options['relationships']['uid']['table'] = 'node';
$handler->display->display_options['relationships']['uid']['field'] = 'uid';
$handler->display->display_options['relationships']['uid']['required'] = TRUE;
/* Relationship: Usuario: Perfil */
$handler->display->display_options['relationships']['profile']['id'] = 'profile';
$handler->display->display_options['relationships']['profile']['table'] = 'users';
$handler->display->display_options['relationships']['profile']['field'] = 'profile';
$handler->display->display_options['relationships']['profile']['relationship'] = 'uid';
$handler->display->display_options['relationships']['profile']['required'] = TRUE;
$handler->display->display_options['relationships']['profile']['bundle_types'] = array(
  'bloguero' => 'bloguero',
);
$handler->display->display_options['defaults']['fields'] = FALSE;
/* Campo: Contenido: Título */
$handler->display->display_options['fields']['title']['id'] = 'title';
$handler->display->display_options['fields']['title']['table'] = 'node';
$handler->display->display_options['fields']['title']['field'] = 'title';
$handler->display->display_options['fields']['title']['label'] = '';
$handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['title']['link_to_node'] = FALSE;
/* Campo: Perfil: Nombre completo */
$handler->display->display_options['fields']['field_full_name']['id'] = 'field_full_name';
$handler->display->display_options['fields']['field_full_name']['table'] = 'field_data_field_full_name';
$handler->display->display_options['fields']['field_full_name']['field'] = 'field_full_name';
$handler->display->display_options['fields']['field_full_name']['relationship'] = 'profile';
$handler->display->display_options['fields']['field_full_name']['label'] = '';
$handler->display->display_options['fields']['field_full_name']['element_label_colon'] = FALSE;
/* Campo: Contenido: Updated date */
$handler->display->display_options['fields']['changed']['id'] = 'changed';
$handler->display->display_options['fields']['changed']['table'] = 'node';
$handler->display->display_options['fields']['changed']['field'] = 'changed';
$handler->display->display_options['fields']['changed']['label'] = '';
$handler->display->display_options['fields']['changed']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['changed']['date_format'] = 'custom';
$handler->display->display_options['fields']['changed']['custom_date_format'] = 'M j, Y';
/* Campo: Contenido: Body */
$handler->display->display_options['fields']['body']['id'] = 'body';
$handler->display->display_options['fields']['body']['table'] = 'field_data_body';
$handler->display->display_options['fields']['body']['field'] = 'body';
$handler->display->display_options['fields']['body']['label'] = '';
$handler->display->display_options['fields']['body']['alter']['max_length'] = '512';
$handler->display->display_options['fields']['body']['alter']['strip_tags'] = TRUE;
$handler->display->display_options['fields']['body']['alter']['trim'] = TRUE;
$handler->display->display_options['fields']['body']['element_label_colon'] = FALSE;
$handler->display->display_options['defaults']['sorts'] = FALSE;
/* Sort criterion: Contenido: Publicacion */
$handler->display->display_options['sorts']['created']['id'] = 'created';
$handler->display->display_options['sorts']['created']['table'] = 'node';
$handler->display->display_options['sorts']['created']['field'] = 'created';
$handler->display->display_options['sorts']['created']['order'] = 'DESC';
$handler->display->display_options['defaults']['arguments'] = FALSE;
/* Contextual filter: Término de taxonomía: ID del término */
$handler->display->display_options['arguments']['tid']['id'] = 'tid';
$handler->display->display_options['arguments']['tid']['table'] = 'taxonomy_term_data';
$handler->display->display_options['arguments']['tid']['field'] = 'tid';
$handler->display->display_options['arguments']['tid']['relationship'] = 'term_node_tid';
$handler->display->display_options['arguments']['tid']['exception']['title'] = 'Todo(s)';
$handler->display->display_options['arguments']['tid']['default_argument_type'] = 'fixed';
$handler->display->display_options['arguments']['tid']['summary']['number_of_records'] = '0';
$handler->display->display_options['arguments']['tid']['summary']['format'] = 'default_summary';
$handler->display->display_options['arguments']['tid']['summary_options']['items_per_page'] = '25';
$handler->display->display_options['defaults']['filter_groups'] = FALSE;
$handler->display->display_options['defaults']['filters'] = FALSE;
/* Filter criterion: Contenido: Publicado */
$handler->display->display_options['filters']['status']['id'] = 'status';
$handler->display->display_options['filters']['status']['table'] = 'node';
$handler->display->display_options['filters']['status']['field'] = 'status';
$handler->display->display_options['filters']['status']['value'] = '1';
$handler->display->display_options['path'] = 'blog/%';

/* Display: page_canal_user */
$handler = $view->new_display('page', 'page_canal_user', 'page_canal_user');
$handler->display->display_options['defaults']['title'] = FALSE;
$handler->display->display_options['title'] = 'page_canal_user';
$handler->display->display_options['defaults']['access'] = FALSE;
$handler->display->display_options['access']['type'] = 'perm';
$handler->display->display_options['defaults']['cache'] = FALSE;
$handler->display->display_options['cache']['type'] = 'time';
$handler->display->display_options['cache']['results_lifespan'] = '60';
$handler->display->display_options['cache']['results_lifespan_custom'] = '0';
$handler->display->display_options['cache']['output_lifespan'] = '-1';
$handler->display->display_options['cache']['output_lifespan_custom'] = '0';
$handler->display->display_options['defaults']['pager'] = FALSE;
$handler->display->display_options['pager']['type'] = 'full';
$handler->display->display_options['pager']['options']['items_per_page'] = '17';
$handler->display->display_options['pager']['options']['offset'] = '0';
$handler->display->display_options['pager']['options']['id'] = '0';
$handler->display->display_options['pager']['options']['quantity'] = '9';
$handler->display->display_options['pager']['options']['tags']['first'] = '« primera';
$handler->display->display_options['pager']['options']['tags']['previous'] = '‹ anterior';
$handler->display->display_options['pager']['options']['tags']['next'] = 'siguiente ›';
$handler->display->display_options['pager']['options']['tags']['last'] = 'última »';
$handler->display->display_options['defaults']['relationships'] = FALSE;
/* Relationship: Contenido: Autor */
$handler->display->display_options['relationships']['uid']['id'] = 'uid';
$handler->display->display_options['relationships']['uid']['table'] = 'node';
$handler->display->display_options['relationships']['uid']['field'] = 'uid';
$handler->display->display_options['relationships']['uid']['required'] = TRUE;
/* Relationship: Usuario: Perfil */
$handler->display->display_options['relationships']['profile']['id'] = 'profile';
$handler->display->display_options['relationships']['profile']['table'] = 'users';
$handler->display->display_options['relationships']['profile']['field'] = 'profile';
$handler->display->display_options['relationships']['profile']['relationship'] = 'uid';
$handler->display->display_options['relationships']['profile']['required'] = TRUE;
$handler->display->display_options['relationships']['profile']['bundle_types'] = array(
  'bloguero' => 'bloguero',
);
$handler->display->display_options['defaults']['fields'] = FALSE;
/* Campo: Contenido: Nid */
$handler->display->display_options['fields']['nid']['id'] = 'nid';
$handler->display->display_options['fields']['nid']['table'] = 'node';
$handler->display->display_options['fields']['nid']['field'] = 'nid';
$handler->display->display_options['fields']['nid']['label'] = '';
$handler->display->display_options['fields']['nid']['element_label_colon'] = FALSE;
/* Campo: Contenido: Título */
$handler->display->display_options['fields']['title']['id'] = 'title';
$handler->display->display_options['fields']['title']['table'] = 'node';
$handler->display->display_options['fields']['title']['field'] = 'title';
$handler->display->display_options['fields']['title']['label'] = '';
$handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
$handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
/* Campo: Contenido: Body */
$handler->display->display_options['fields']['body']['id'] = 'body';
$handler->display->display_options['fields']['body']['table'] = 'field_data_body';
$handler->display->display_options['fields']['body']['field'] = 'body';
$handler->display->display_options['fields']['body']['label'] = '';
$handler->display->display_options['fields']['body']['element_label_colon'] = FALSE;
/* Campo: Contenido: Publicacion */
$handler->display->display_options['fields']['created']['id'] = 'created';
$handler->display->display_options['fields']['created']['table'] = 'node';
$handler->display->display_options['fields']['created']['field'] = 'created';
$handler->display->display_options['fields']['created']['label'] = '';
$handler->display->display_options['fields']['created']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['created']['date_format'] = 'custom';
$handler->display->display_options['fields']['created']['custom_date_format'] = 'M j, Y';
/* Campo: Contenido: Updated date */
$handler->display->display_options['fields']['changed']['id'] = 'changed';
$handler->display->display_options['fields']['changed']['table'] = 'node';
$handler->display->display_options['fields']['changed']['field'] = 'changed';
$handler->display->display_options['fields']['changed']['label'] = '';
$handler->display->display_options['fields']['changed']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['changed']['date_format'] = 'custom';
$handler->display->display_options['fields']['changed']['custom_date_format'] = 'M j, Y';
/* Campo: Perfil: Nombre completo */
$handler->display->display_options['fields']['field_full_name']['id'] = 'field_full_name';
$handler->display->display_options['fields']['field_full_name']['table'] = 'field_data_field_full_name';
$handler->display->display_options['fields']['field_full_name']['field'] = 'field_full_name';
$handler->display->display_options['fields']['field_full_name']['relationship'] = 'profile';
$handler->display->display_options['fields']['field_full_name']['label'] = '';
$handler->display->display_options['fields']['field_full_name']['element_label_colon'] = FALSE;
$handler->display->display_options['defaults']['arguments'] = FALSE;
/* Contextual filter: Perfil: Nombre completo (field_full_name) */
$handler->display->display_options['arguments']['field_full_name_value']['id'] = 'field_full_name_value';
$handler->display->display_options['arguments']['field_full_name_value']['table'] = 'field_data_field_full_name';
$handler->display->display_options['arguments']['field_full_name_value']['field'] = 'field_full_name_value';
$handler->display->display_options['arguments']['field_full_name_value']['relationship'] = 'profile';
$handler->display->display_options['arguments']['field_full_name_value']['exception']['title'] = 'Todo(s)';
$handler->display->display_options['arguments']['field_full_name_value']['default_argument_type'] = 'fixed';
$handler->display->display_options['arguments']['field_full_name_value']['summary']['number_of_records'] = '0';
$handler->display->display_options['arguments']['field_full_name_value']['summary']['format'] = 'default_summary';
$handler->display->display_options['arguments']['field_full_name_value']['summary_options']['items_per_page'] = '25';
$handler->display->display_options['arguments']['field_full_name_value']['limit'] = '0';
$handler->display->display_options['arguments']['field_full_name_value']['case'] = 'lower';
$handler->display->display_options['arguments']['field_full_name_value']['path_case'] = 'lower';
$handler->display->display_options['arguments']['field_full_name_value']['transform_dash'] = TRUE;
$handler->display->display_options['defaults']['filter_groups'] = FALSE;
$handler->display->display_options['defaults']['filters'] = FALSE;
/* Filter criterion: Contenido: Publicado */
$handler->display->display_options['filters']['status']['id'] = 'status';
$handler->display->display_options['filters']['status']['table'] = 'node';
$handler->display->display_options['filters']['status']['field'] = 'status';
$handler->display->display_options['filters']['status']['value'] = 1;
$handler->display->display_options['filters']['status']['group'] = 1;
$handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
/* Filter criterion: Contenido: Tipo */
$handler->display->display_options['filters']['type']['id'] = 'type';
$handler->display->display_options['filters']['type']['table'] = 'node';
$handler->display->display_options['filters']['type']['field'] = 'type';
$handler->display->display_options['filters']['type']['value'] = array(
  'post' => 'post',
);
$handler->display->display_options['path'] = 'blog/usuario/%';

/* Display: page_canal_blog_users */
$handler = $view->new_display('attachment', 'page_canal_blog_users', 'attachment_blog_users');
$handler->display->display_options['defaults']['query'] = FALSE;
$handler->display->display_options['query']['type'] = 'views_query';
$handler->display->display_options['query']['options']['distinct'] = TRUE;
$handler->display->display_options['query']['options']['pure_distinct'] = TRUE;
$handler->display->display_options['pager']['type'] = 'some';
$handler->display->display_options['pager']['options']['items_per_page'] = '0';
$handler->display->display_options['pager']['options']['offset'] = '0';
$handler->display->display_options['defaults']['style_plugin'] = FALSE;
$handler->display->display_options['style_plugin'] = 'default';
$handler->display->display_options['style_options']['default_row_class'] = FALSE;
$handler->display->display_options['style_options']['row_class_special'] = FALSE;
$handler->display->display_options['defaults']['style_options'] = FALSE;
$handler->display->display_options['defaults']['row_plugin'] = FALSE;
$handler->display->display_options['row_plugin'] = 'fields';
$handler->display->display_options['row_options']['default_field_elements'] = FALSE;
$handler->display->display_options['defaults']['row_options'] = FALSE;
$handler->display->display_options['defaults']['relationships'] = FALSE;
/* Relationship: Contenido: Autor */
$handler->display->display_options['relationships']['uid']['id'] = 'uid';
$handler->display->display_options['relationships']['uid']['table'] = 'node';
$handler->display->display_options['relationships']['uid']['field'] = 'uid';
$handler->display->display_options['relationships']['uid']['required'] = TRUE;
/* Relationship: Usuario: Perfil */
$handler->display->display_options['relationships']['profile']['id'] = 'profile';
$handler->display->display_options['relationships']['profile']['table'] = 'users';
$handler->display->display_options['relationships']['profile']['field'] = 'profile';
$handler->display->display_options['relationships']['profile']['relationship'] = 'uid';
$handler->display->display_options['relationships']['profile']['required'] = TRUE;
$handler->display->display_options['relationships']['profile']['bundle_types'] = array(
  'bloguero' => 'bloguero',
);
$handler->display->display_options['defaults']['fields'] = FALSE;
/* Campo: Perfil: Nombre completo */
$handler->display->display_options['fields']['field_full_name']['id'] = 'field_full_name';
$handler->display->display_options['fields']['field_full_name']['table'] = 'field_data_field_full_name';
$handler->display->display_options['fields']['field_full_name']['field'] = 'field_full_name';
$handler->display->display_options['fields']['field_full_name']['relationship'] = 'profile';
$handler->display->display_options['fields']['field_full_name']['label'] = '';
$handler->display->display_options['fields']['field_full_name']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['field_full_name']['element_default_classes'] = FALSE;
/* Campo: Perfil: Imagen perfil */
$handler->display->display_options['fields']['field_image_perfil']['id'] = 'field_image_perfil';
$handler->display->display_options['fields']['field_image_perfil']['table'] = 'field_data_field_image_perfil';
$handler->display->display_options['fields']['field_image_perfil']['field'] = 'field_image_perfil';
$handler->display->display_options['fields']['field_image_perfil']['relationship'] = 'profile';
$handler->display->display_options['fields']['field_image_perfil']['label'] = '';
$handler->display->display_options['fields']['field_image_perfil']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['field_image_perfil']['click_sort_column'] = 'fid';
$handler->display->display_options['fields']['field_image_perfil']['settings'] = array(
  'image_style' => '',
  'image_link' => '',
);
$handler->display->display_options['defaults']['sorts'] = FALSE;
$handler->display->display_options['defaults']['arguments'] = FALSE;
/* Contextual filter: Perfil: Blog (field_blog) */
$handler->display->display_options['arguments']['field_blog_tid']['id'] = 'field_blog_tid';
$handler->display->display_options['arguments']['field_blog_tid']['table'] = 'field_data_field_blog';
$handler->display->display_options['arguments']['field_blog_tid']['field'] = 'field_blog_tid';
$handler->display->display_options['arguments']['field_blog_tid']['relationship'] = 'profile';
$handler->display->display_options['arguments']['field_blog_tid']['exception']['title'] = 'Todo(s)';
$handler->display->display_options['arguments']['field_blog_tid']['default_argument_type'] = 'fixed';
$handler->display->display_options['arguments']['field_blog_tid']['summary']['number_of_records'] = '0';
$handler->display->display_options['arguments']['field_blog_tid']['summary']['format'] = 'default_summary';
$handler->display->display_options['arguments']['field_blog_tid']['summary_options']['items_per_page'] = '25';
$handler->display->display_options['defaults']['filter_groups'] = FALSE;
$handler->display->display_options['defaults']['filters'] = FALSE;
$handler->display->display_options['displays'] = array(
  'page_canal_blog' => 'page_canal_blog',
  'default' => 0,
  'page_canal_user' => 0,
);

/* Display: page_canal_user_users */
$handler = $view->new_display('attachment', 'page_canal_user_users', 'attachment_user_users');
$handler->display->display_options['pager']['type'] = 'some';
$handler->display->display_options['pager']['options']['items_per_page'] = '1';
$handler->display->display_options['pager']['options']['offset'] = '0';
$handler->display->display_options['defaults']['style_plugin'] = FALSE;
$handler->display->display_options['style_plugin'] = 'default';
$handler->display->display_options['style_options']['default_row_class'] = FALSE;
$handler->display->display_options['style_options']['row_class_special'] = FALSE;
$handler->display->display_options['defaults']['style_options'] = FALSE;
$handler->display->display_options['defaults']['row_plugin'] = FALSE;
$handler->display->display_options['row_plugin'] = 'fields';
$handler->display->display_options['row_options']['default_field_elements'] = FALSE;
$handler->display->display_options['defaults']['row_options'] = FALSE;
$handler->display->display_options['defaults']['relationships'] = FALSE;
/* Relationship: Contenido: Autor */
$handler->display->display_options['relationships']['uid']['id'] = 'uid';
$handler->display->display_options['relationships']['uid']['table'] = 'node';
$handler->display->display_options['relationships']['uid']['field'] = 'uid';
$handler->display->display_options['relationships']['uid']['required'] = TRUE;
/* Relationship: Usuario: Perfil */
$handler->display->display_options['relationships']['profile']['id'] = 'profile';
$handler->display->display_options['relationships']['profile']['table'] = 'users';
$handler->display->display_options['relationships']['profile']['field'] = 'profile';
$handler->display->display_options['relationships']['profile']['relationship'] = 'uid';
$handler->display->display_options['relationships']['profile']['required'] = TRUE;
$handler->display->display_options['relationships']['profile']['bundle_types'] = array(
  'bloguero' => 'bloguero',
);
/* Relationship: Perfil: Blog (field_blog) */
$handler->display->display_options['relationships']['field_blog_tid']['id'] = 'field_blog_tid';
$handler->display->display_options['relationships']['field_blog_tid']['table'] = 'field_data_field_blog';
$handler->display->display_options['relationships']['field_blog_tid']['field'] = 'field_blog_tid';
$handler->display->display_options['relationships']['field_blog_tid']['relationship'] = 'profile';
$handler->display->display_options['relationships']['field_blog_tid']['required'] = TRUE;
$handler->display->display_options['defaults']['fields'] = FALSE;
/* Campo: Perfil: Nombre completo */
$handler->display->display_options['fields']['field_full_name']['id'] = 'field_full_name';
$handler->display->display_options['fields']['field_full_name']['table'] = 'field_data_field_full_name';
$handler->display->display_options['fields']['field_full_name']['field'] = 'field_full_name';
$handler->display->display_options['fields']['field_full_name']['relationship'] = 'profile';
$handler->display->display_options['fields']['field_full_name']['label'] = '';
$handler->display->display_options['fields']['field_full_name']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['field_full_name']['element_default_classes'] = FALSE;
/* Campo: Término de taxonomía: Logo */
$handler->display->display_options['fields']['field_logo']['id'] = 'field_logo';
$handler->display->display_options['fields']['field_logo']['table'] = 'field_data_field_logo';
$handler->display->display_options['fields']['field_logo']['field'] = 'field_logo';
$handler->display->display_options['fields']['field_logo']['relationship'] = 'field_blog_tid';
$handler->display->display_options['fields']['field_logo']['label'] = '';
$handler->display->display_options['fields']['field_logo']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['field_logo']['click_sort_column'] = 'fid';
$handler->display->display_options['fields']['field_logo']['settings'] = array(
  'image_style' => '',
  'image_link' => '',
);
/* Campo: Término de taxonomía: ID del término */
$handler->display->display_options['fields']['tid']['id'] = 'tid';
$handler->display->display_options['fields']['tid']['table'] = 'taxonomy_term_data';
$handler->display->display_options['fields']['tid']['field'] = 'tid';
$handler->display->display_options['fields']['tid']['relationship'] = 'field_blog_tid';
$handler->display->display_options['fields']['tid']['label'] = '';
$handler->display->display_options['fields']['tid']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['tid']['separator'] = '';
/* Campo: Campo: Facebook username */
$handler->display->display_options['fields']['field_facebook_username']['id'] = 'field_facebook_username';
$handler->display->display_options['fields']['field_facebook_username']['table'] = 'field_data_field_facebook_username';
$handler->display->display_options['fields']['field_facebook_username']['field'] = 'field_facebook_username';
$handler->display->display_options['fields']['field_facebook_username']['relationship'] = 'profile';
$handler->display->display_options['fields']['field_facebook_username']['label'] = '';
$handler->display->display_options['fields']['field_facebook_username']['element_label_colon'] = FALSE;
/* Campo: Campo: Twitter username */
$handler->display->display_options['fields']['field_twitter_username']['id'] = 'field_twitter_username';
$handler->display->display_options['fields']['field_twitter_username']['table'] = 'field_data_field_twitter_username';
$handler->display->display_options['fields']['field_twitter_username']['field'] = 'field_twitter_username';
$handler->display->display_options['fields']['field_twitter_username']['relationship'] = 'profile';
$handler->display->display_options['fields']['field_twitter_username']['label'] = '';
$handler->display->display_options['fields']['field_twitter_username']['element_label_colon'] = FALSE;
$handler->display->display_options['defaults']['sorts'] = FALSE;
$handler->display->display_options['defaults']['arguments'] = FALSE;
/* Contextual filter: Perfil: Nombre completo (field_full_name) */
$handler->display->display_options['arguments']['field_full_name_value']['id'] = 'field_full_name_value';
$handler->display->display_options['arguments']['field_full_name_value']['table'] = 'field_data_field_full_name';
$handler->display->display_options['arguments']['field_full_name_value']['field'] = 'field_full_name_value';
$handler->display->display_options['arguments']['field_full_name_value']['relationship'] = 'profile';
$handler->display->display_options['arguments']['field_full_name_value']['exception']['title'] = 'Todo(s)';
$handler->display->display_options['arguments']['field_full_name_value']['default_argument_type'] = 'fixed';
$handler->display->display_options['arguments']['field_full_name_value']['summary']['number_of_records'] = '0';
$handler->display->display_options['arguments']['field_full_name_value']['summary']['format'] = 'default_summary';
$handler->display->display_options['arguments']['field_full_name_value']['summary_options']['items_per_page'] = '25';
$handler->display->display_options['arguments']['field_full_name_value']['limit'] = '0';
$handler->display->display_options['arguments']['field_full_name_value']['case'] = 'lower';
$handler->display->display_options['arguments']['field_full_name_value']['path_case'] = 'lower';
$handler->display->display_options['arguments']['field_full_name_value']['transform_dash'] = TRUE;
$handler->display->display_options['defaults']['filter_groups'] = FALSE;
$handler->display->display_options['defaults']['filters'] = FALSE;
$handler->display->display_options['displays'] = array(
  'page_canal_user' => 'page_canal_user',
  'default' => 0,
  'page_canal_blog' => 0,
);
$translatables['imx_blog'] = array(
  t('Master'),
  t('more'),
  t('Apply'),
  t('Reiniciar'),
  t('Sort by'),
  t('Asc'),
  t('Desc'),
  t('Items per page'),
  t('- All -'),
  t('Offset'),
  t('« primera'),
  t('‹ anterior'),
  t('siguiente ›'),
  t('última »'),
  t('page_canal_blog'),
  t('term'),
  t('author'),
  t('Perfil'),
  t('Todo(s)'),
  t('page_canal_user'),
  t('page_canal_blog_users'),
  t('page_canal_user_users'),
  t('term from field_blog'),
  t('.'),
);

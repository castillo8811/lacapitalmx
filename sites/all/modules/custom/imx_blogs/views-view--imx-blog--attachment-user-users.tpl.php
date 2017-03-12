<?php $bloguero = $view->result[0]->_field_data['profile_users_pid']['entity']; ?>
<header id="imx-blogs-autor-blog">
	<img src="<?php print(file_create_url($bloguero->field_image_perfil[LANGUAGE_NONE][0]['uri'])); ?>" alt="<?php print($bloguero->field_full_name[LANGUAGE_NONE][0]['safe_value']); ?>" class="imx-blogs-autor-blog-imagen">
	<a href="<?php print(url('taxonomy/term/' . $view->result[0]->taxonomy_term_data_field_data_field_blog_tid, array('absolute' => true))); ?>"><img src="<?php print(file_create_url($view->result[0]->field_field_logo[0]['raw']['uri'])); ?>" class="imx-blogs-autor-blog-logo"></a>
	<h2 class="imx-blogs-autor-blog-nombre"><?php print($bloguero->field_full_name[LANGUAGE_NONE][0]['safe_value']); ?></h2>
	<div class="imx-blogs-autor-blog-descripcion"><?php print($bloguero->field_description[LANGUAGE_NONE][0]['safe_value']); ?></div>
</header>
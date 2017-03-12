<?php
$i=0;
foreach($view->result as $row): 
	$bloguero = $row->_field_data['profile_users_pid']['entity']; ?>
	<a class="imx-blogs-editor-ficha <?php print( ($i++ % 2 > 0)?"":"mr2" ) ?>" href="/blog/usuario/<?php print(string_to_slug($bloguero->field_full_name[LANGUAGE_NONE][0]['safe_value'])); ?>">
		<img class="imx-blogs-editor-ficha-imagen" src="<?php print(file_create_url($bloguero->field_image_perfil[LANGUAGE_NONE][0]['uri'])); ?>">
		<h2 class="imx-blogs-editor-ficha-nombre" ><?php print($bloguero->field_full_name[LANGUAGE_NONE][0]['safe_value']); ?></h2>
	</a>
<?php endforeach; 
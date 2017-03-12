<?php 
drupal_add_css( drupal_get_path('module', 'imx_blogs') . '/css/imx_blogs_page_canal_user.css' ); ?>
<h1 class="imx-blogs-canal-banner">
	<a href="/blogs"><img src="http://8d5306c18b850ea7e0ac-65b9b7a2fa68b3c92f951010bb26a4de.r54.cf2.rackcdn.com/blogs_cabezal_ch.png" alt="Blogs Excélsior" /></a>
</h1>
<section id="imx-blogs-autor-listado">
<?php echo $view->attachment_before; ?>
<ul>
	<li></li>
</ul>
</section>
<div id="imx-blogs-viralizacion">
	<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
        <a class="addthis_button_facebook_like"></a>
        <a class="addthis_button_tweet" tw:via="Excelsior"></a> 
        <a class="addthis_button_google_plusone" g:plusone:annotation="bubble"></a>	    
	</div>
	<div class="atclear"></div>
</div>
<section id="imx-blogs-listado">
	<ul class="imx-blogs-listado-entradas">	
	<?php foreach($view->result as $post): ?>
		<li class="imx-blogs-listado-entradas-entrada">
			<h2 class="imx-blogs-listado-entradas-entrada-titulo"><a href="<?php print(url('node/' . $post->nid, array('absolute' => true))); ?>" class="imx-blogs-listado-entradas-entrada-link"><?php print($post->node_title); ?></a></h2>
			<span class="imx-blogs-listado-entradas-entrada-fecha"><?php print( date('M j, Y',$post->node_changed) ); ?></span>
			<div class="imx-blogs-listado-entradas-entrada-sumario"><?php print(text_summary($post->field_body[0]['raw']['value'])); ?></div>
		</li>
	<?php endforeach; ?>
	</ul>
</section>
<?php 
//print_r ( $view-> result );
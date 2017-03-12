<div id="imx-video-nota-recomendados-jcxense-wrapper">
		<div class="imx-mas-notas-title">
		<span class="plek-rectangulo"></span>
		<span class="plek-triangulo"></span>
			<span class="imx-title-notas-color f21 dblock family-titillium">POR QUE VISTE ESTA NOTA, TE RECOMENDAMOS</span>
		</div>
    <div class="imx-video-nota-recomendados-jcxense-content">
        <ul id="recomendados-cXense">
        </ul>
    </div>
    <?php if (count($serie)> 0): ?>
    <div class="imx-play-ver-mas left">
			<a class="right btn-ver-mas-play-content" href="/<?php echo $serie['url']; ?>">
	    	<span class=" dblock left sprite-new-home imx-cuadro-mas-azul-ver"></span>
	    </a>
    </div>
    <?php endif ?>
</div>
<!-- mustache template -->
<script id="poblar_cXense" type="text/html">
{{#items}}
    <li class="items">
      <a href="{{click_url}}">
      	<span>
        	<img class="image" width="285" height="163" src="{{imx-img-principal}}" alt="{{title}}" title="{{title}}" />
      	</span>
        <span class="title">{{title}}</span>
      </a>
    </li>
{{/items}}
</script>
<script type="text/javascript">
(function($){
    jQuery(document).ready(function(){
        var cXense = "<?php echo $url; ?>";
        jQuery.getJSON( cXense, {
            format: "json",
        },
        function( data ) {
        	if (data.httpStatus == 200) {
	            var tempResponse = data.response, cXense_notas;
	            for(var k in tempResponse.items) {
	                tempResponse.items[k]['imx-img-principal'] = tempResponse.items[k]['imx-img-principal'].replace('media\/dinero\/images', 'media/dinero/styles/destacada_flujo/public/images');
	            }
	            data.response = tempResponse;
	            cXense_notas = ich.poblar_cXense(data.response);
	            jQuery('#recomendados-cXense').append(cXense_notas);
        	}
        });
    });
})(jQuery);
</script>

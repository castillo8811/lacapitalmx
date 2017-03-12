<div class="imx-mas-dinero">
	<?php if (isset($title)): ?>
		<div class="imx-mas-notas-title">
		<span class="plek-rectangulo"></span>
		<span class="plek-triangulo"></span>
			<span class="imx-title-notas-color f21 dblock family-titillium"><?php echo $title?></span>
		</div>
	<?php endif ?>
	<?php foreach ($data as $key => $value): ?>
		<?php #dvm($value)?>
		<div class="imx-mas-dinero-content">
			<div class="imx-mas-dinero-img left imx-mas-dinero-shares-btn ">
				<div class="dblock left imx-adis-share ">
						<a class="addthis_button_facebook sha-fb sprite-taxonomy-name" addthis:url="<?php echo $value['full_url'] ?>" addthis:title="<?php echo $value['title'] ?>">
							<!--<img src="/sites/gimm-dinero.jediteam.mx/themes/dinero/images/facebook.png" width="23" height="23" border="0" alt="Compartir a Facebook" />-->
						</a>
						<a class="addthis_button_twitter sha-tw sprite-taxonomy-name" addthis:url="<?php echo $value['full_url'] ?>" addthis:title="<?php echo $value['title'] ?>">
							<!--<img src="/sites/gimm-dinero.jediteam.mx/themes/dinero/images/twitter.png" width="23" height="23" border="0" alt="Compartir a Twitter" />-->
						</a>
						<a class="addthis_button_google_plusone_share sha-gg sprite-taxonomy-name" addthis:url="<?php echo $value['full_url'] ?>" addthis:title="<?php echo $value['title'] ?>">
							<!--<img src="/sites/gimm-dinero.jediteam.mx/themes/dinero/images/google_plusone_share.png" width="23" height="23" border="0" alt="Compartir a Google+" />-->
						</a>
						<a class="addthis_button_email sha-mail sprite-taxonomy-name" addthis:url="<?php echo $value['full_url'] ?>" addthis:title="<?php echo $value['title'] ?>">
							<!--<img src="/sites/gimm-dinero.jediteam.mx/themes/dinero/images/email.png" width="23" height="23" border="0" alt="Compartir por Email" />-->
						</a>
						<a class="addthis_button_rss sha-rss sprite-taxonomy-name" title="Rss" href="http://dineroenimagen.com.feedsportal.com/c/35419/f/667221/index.rss" target="_blank">
							<!--<img src="/sites/gimm-dinero.jediteam.mx/themes/dinero/images/email.png" width="23" height="23" border="0" alt="Compartir por Email" />-->
						</a>

				</div>
				<a  class="imx-img-related-btn dblock left prelative" href="/<?php echo $value['url']  ?>"  >
				<?php if (isset($value['image_youtube'])): ?>
					<img src="<?php echo $value['image_youtube']  ?>" width="182" height="149px"  alt="<?php print strip_tags($value['image_alt'] ); ?>">
				<?php else: ?>
					<img src="<?php echo $value['image_uri']  ?>" width="182" height="149px"  alt="<?php print strip_tags($value['image_alt'] ); ?>">
				<?php endif ?>
				</a>
			</div>
			<div class="imx-mas-dinero-content-text left">
				<a href="/<?php echo $value['url']  ?>"  >
					<span class="imx-mas-dinero-title-nota dblock family-droid-serif f20"><?php echo $value['title']  ?> </span>
				</a>
					<span class="imx-mas-dinero-taxonomy dblock">
						<span class="dblock sprite-new-home imx-cuadro-azul"></span>
						<span class="imx-date-nota f12 family-droid-sans dblock left"><?php echo $value['date']; ?></span>
						<?php if ($value['library']): ?>
							<?php #foreach ($value['library'] as $library): ?>
								<!--<a href="http://docs.google.com/gview?url=<?php #echo $library['file_url']; ?>">-->
									<span class="dblock imx-pdf-file-list left"></span>
								<!--</a>-->
							<?php #endforeach ?>
						<?php endif ?>
					</span>
					<a href="/<?php echo $value['url']  ?>" >
						<span class="imax-mas-dinero-sumary dblock family-source-sans f14"><?php echo $value['summary'] ?></span>
					</a>
			</div>
		</div>
	<?php endforeach ?>
</div>
<!-- AddThis Smart Layers BEGIN -->
<script type="text/javascript">
var addthis_share = addthis_share || {}
addthis_share = {
        passthrough : {
                twitter: {
                        via: "<?php echo $value['twitter_via'] ?>"
                }
        }
}
</script>
<!-- AddThis Smart Layers END -->

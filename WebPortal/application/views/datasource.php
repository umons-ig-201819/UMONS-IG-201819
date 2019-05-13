	<section id="top_page">
		<h1>Sources de donn&eacute;es</h1>
	</section>
<section>
	<article>
<?php
echo form_open('datasource');
echo form_fieldset('Sources de donn&eacute;es');
echo '<p>';
    echo form_label('Source');
    echo form_dropdown('datasource',$options,$selected,'id="datasource" required="required"');
    ?> <br><br> <?php 
    echo form_submit('action', 'Charger',"class='buttonvalider'");
echo '</p>';
echo form_fieldset_close();
echo form_close();
		?>
		<input type="button" value="Ajouter un fichier de donn&eacute;es" id="lien" onclick="window.location.href='<?=site_url("datasource/addSource"); ?>'"> </input>
		<input type="button" value="Gérer mes sources de donn&eacute;es et acc&egrave;s" id="lien" onclick="window.location.href='<?=site_url("datasource/manage"); ?>'"></input> 
	</article>
	<?php foreach($url as $zeppelin_link): ?>
	<!--  sandbox="allow-plugins allow-scripts allow-same-origin"  --> 
	<iframe id="table_view" width="100%" height="500px" src="<?=$zeppelin_link;?>" scrolling="yes"></iframe>
	<?php endforeach; ?>
</section>

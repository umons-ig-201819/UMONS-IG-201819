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
    echo form_submit('action', 'Charger',"class='buttonvalider'");
echo '</p>';
echo form_fieldset_close();
echo form_close();
		?>
		<p><a href="<?=site_url("datasource/addSource"); ?>">Ajouter un fichier de donn&eacute;es</a></p>
		<p><a href="<?=site_url("datasource/manage"); ?>">G&eacute;rer mes sources de donn&eacute;es et acc&egrave;s</a></p>
	</article>
	<?php foreach($url as $zeppelin_link): ?>
	<!--  sandbox="allow-plugins allow-scripts allow-same-origin"  --> 
	<iframe id="table_view" width="100%" height="500px" src="<?=$zeppelin_link;?>" scrolling="yes"></iframe>
	<?php endforeach; ?>
</section>
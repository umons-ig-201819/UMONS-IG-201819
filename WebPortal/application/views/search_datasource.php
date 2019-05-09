<section id="top_page">
<h1>Recherche d'une source de donn&eacute;es</h1>
</section>
<section>
	
<?php
		echo form_open("search/datasource");
		echo form_fieldset('Recherche d\'une source de donn&eacute;es');
		
		echo '<p>';
		echo form_label("Nom d'utilisateur du propriétaire",'owner');
		echo form_input('owner','','id="owner"');
		echo '</p>';
		
		echo '<p>';
		echo form_label("Nom de la source",'name');
		echo form_input('name','','id="name"');
		echo '</p>';
		
		echo '<p>';
		echo form_submit('action', 'Rechercher',"class='buttonvalider'");
		echo '</p>';
		
		echo form_fieldset_close();
		echo form_close();
?>		
	<article>
		<table>
		<?php foreach($result as $data): ?>
			<tr><td style="padding-left:15px;"><?=htmlentities($data['file_name']).' ('.htmlentities($data['login']).')';?></td><td> <input type="button" value="Demander l'acc&egrave;s" id="lien" onclick="window.location.href='<?=site_url("datasource/ask/$data[id]"); ?>'"> </input></td>
		<?php endforeach; ?>
		</table>
	</article>
</section>

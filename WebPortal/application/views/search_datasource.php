<section>
	<h1>Recherche d'une source de donn&eacute;es</h1>
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
		echo form_submit('action', 'Rechercher');
		echo '</p>';
		
		echo form_fieldset_close();
		echo form_close();
?>		
	<article>
		<ul>
		<?php foreach($result as $data): ?>
			<li><?=htmlentities($data['file_name']).' ('.htmlentities($data['login']).')';?> <a href="<?=site_url("datasource/ask/$data[id]");?>">Demander l'acc&egrave;s</a></li>
		<?php endforeach; ?>
		</ul>
	</article>
</section>
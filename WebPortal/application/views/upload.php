<section>
	<h1>Mes fichiers et applications</h1>
	<?php if(! is_null($error)): ?>
		<?php if(array_key_exists('error', $error)): ?>
	<article class="error"><p><?=$error['error'];?></p></article>
		<?php else: ?>
	<article class="success"><p>Le fichier a bien &eacute;t&eacute; envoy&eacute;.</p></article>
		<?php endif; ?>
	<?php endif; ?>
	<article>
		<h2>Ajouter une source de donn&eacute;es (fichier csv, accdb ou mdb)</h2>
		<?php
		echo form_open_multipart("datasource/addSource");
		echo form_fieldset('Envoyer un fichier de données');
		echo '<input type="file" id="datafile" name="datafile" multiple="false" required="required" accept=".csv,.accdb,.mdb,application/msaccess,application/x-msaccess,text/csv">';
		echo form_submit('action', 'Envoyer');
		echo form_fieldset_close();
		echo form_close();
		?>
	</article>
</section>
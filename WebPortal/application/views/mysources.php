<section>
	<article>
	<?php if(!empty($error)): ?>
	<p class="error"><?=$error;?></p>
	<?php endif; ?>
	<?php if(!empty($success)): ?>
	<p class="success"><?=$success;?></p>
	<?php endif; ?>
		<h1>Gestion de mes sources de donn&eacute;es</h1>
		<?php foreach($source as $data):
echo form_open("datasource/update/$data[id]");
echo form_fieldset(htmlentities($data['file_name']));
echo '<p>';
    echo form_label('Nom','file_name');
    echo form_input('file_name',htmlentities($data['file_name']),'id="file_name"');
echo '</p>';

echo '<p>';
    echo form_label('Date d\'ajout','add_date');
    echo '<input type="date" name="add_date" value="'.strftime("%d-%m-%Y",strtotime(htmlentities($data['add_date']))).'" id="add_date">'; // TODO check Y-m-d
echo '</p>';

echo '<p>';
    echo form_label('Visibilit&eacute;');
    echo form_label('Priv&eacute;','visible_2').form_radio('visible','2',$data['visible'] == 2, 'id="visible_2"');
    echo form_label('Public','visible_1').form_radio('visible','1',$data['visible'] == 1, 'id="visible_1"');
    echo form_label('Sur demande','visible_0').form_radio('visible','0',$data['visible'] == 0, 'id="visible_0"');
    //    echo form_input('gender',$gender,'id="gender"');/*** TODO input type to radio (HTML5) **/
echo '</p>';

echo '<p><a href="'.site_url("datasource/advisor/$data[id]").'">Consulter/Ajouter un conseiller</a></p>';
echo '<p><a href="'.site_url("datasource/project/$data[id]").'">Consulter/Révoquer un projet de recherche</a></p>';
echo '<p><a href="'.site_url("datasource/remove/$data[id]").'">Supprimer</a></p>';

echo '<p>';
    echo form_submit('action', 'Modifier');
echo '</p>';

echo form_fieldset_close();
echo form_close();
		?>
		<?php endforeach; ?>
	</article>
	<article>
		<h1>Gestion des sources auxquelles j'ai acc&egrave;s</h1>
		<ul>
		<?php foreach($access as $data): ?>
		<li><?=htmlentities($data['file_name']);?> <a href="<?=site_url("datasource/revoke/$data[id]"); ?>">Supprimer</a></li>
		
		<?php endforeach; ?>
		</ul>
	</article>
</section>
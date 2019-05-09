<section id="top_page">
<h1>Gestion des projets</h1>
</section>
<section>
	<article>
	<?php if(!empty($error)): ?>
	<p class="error"><?=$error;?></p>
	<?php endif; ?>
	<?php if(!empty($success)): ?>
	<p class="success"><?=$success;?></p>
	<?php endif; ?>
		
		
		<?php
		echo form_open("administration/addProject");
		echo form_fieldset('Ajouter un projet');
		echo '<p>';
		echo form_label('Nom','project_name');
		echo form_input('project_name','','id="project_name"');
		echo '</p>';
		
		echo '<p>';
		echo form_label('Date de d&eacute;but','add_date');
		echo '<input type="date" name="date_start" value="" id="date_start">';// TODO check Y-m-d
		echo '</p>';
		
		echo '<p>';
		echo form_label('Date de fin','date_end');
		echo '<input type="date" name="date_end" value="" id="date_end">';// TODO check Y-m-d
		echo '</p>';
		
		echo '<p>';
		echo form_label('Description','project_description');
		echo '<textarea rows="4" cols="50" name="project_description" id="project_description"></textarea>';
		echo '</p>';
		
		echo '<p>';
		echo form_submit('addaction', 'Ajouter',"class='buttonvalider'");
		echo '</p>';
		
		echo form_fieldset_close();
		echo form_close();
		?>
	</article>
	<article>
		<?php
		echo form_open("administration");
		echo form_fieldset('Recherche un projet');
		
		echo '<p>';
		echo form_label('Recherche','search');
		echo form_input('search','','id="search"'); 
		?><br><br><?php 
		echo form_submit('action', 'Rechercher',"class='buttonvalider'");
		echo '</p>';
		
		echo form_fieldset_close();
		echo form_close();
		?>
	</article>
	<article>
	
	<?php foreach($projects as $project): ?>
	<input type="button" id="projet" style="background-color: blanchedalmond; width: -webkit-fill-available;font-style: italic; font-size: inherit;padding: 10px" value="<?=htmlentities($project['project_name']); ?> (<?=htmlentities($project['date_start']);?>, <?=htmlentities($project['date_end']);?>)" id="lien" onclick="window.location.href='<?=site_url("administration/project/$project[id]") ; ?>'"> </input>
	<?php endforeach; ?>
	
	</article>
</section>

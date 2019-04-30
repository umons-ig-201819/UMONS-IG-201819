<section>
	<article>
	<?php if(!empty($error)): ?>
	<p class="error"><?=$error;?></p>
	<?php endif; ?>
	<?php if(!empty($success)): ?>
	<p class="success"><?=$success;?></p>
	<?php endif; ?>
		<h1>Gestion des projets</h1>
		
		// FORM ADD
		<?php
		echo form_open("administration/addProject");
		echo form_fieldset('Ajouter un projet');
		
		echo '<p>';
		echo form_label('Nom','project_name');
		echo form_input('project_name',htmlentities($project['project_name']),'id="project_name"');
		echo '</p>';
		
		echo '<p>';
		echo form_label('Date de d&eacute;but','add_date');
		echo '<input type="date" name="date_start" value="'.htmlentities($project['date_start']).'" id="date_start">';// TODO check Y-m-d
		echo '</p>';
		
		echo '<p>';
		echo form_label('Date de fin','date_end');
		echo '<input type="date" name="date_end" value="'.htmlentities($project['date_end']).'" id="date_end">';// TODO check Y-m-d
		echo '</p>';
		
		echo '<p>';
		echo form_label('Description','project_description');
		echo '<textarea rows="4" cols="50" name="project_description" id="project_description">'.htmlentities($project['date_end']).'</textarea>';
		echo '</p>';
		
		echo '<p>';
		echo form_submit('addaction', 'Ajouter');
		echo '</p>';
		
		echo form_fieldset_close();
		echo form_close();
		?>
	</article>
	<article>
		<?php
		echo form_open("administration/project/$project[id]");
		echo form_fieldset('Recherche un projet');
		
		echo '<p>';
		echo form_label('Recherche','search');
		echo form_input('search','','id="search"');
		echo form_submit('action', 'Rechercher');
		echo '</p>';
		
		echo form_fieldset_close();
		echo form_close();
		?>
	</article>
	<article>
	<ul>
	<?php foreach($projects as $project): ?>
	<li><a href="<?=site_url("administration/project/$project[id]");?>"><?=htmlentities($project['project_name']); ?> (<?=htmlentities($project['date_start']);?>, <?=htmlentities($project['date_end']);?>)</a></li>
	<?php endforeach; ?>
	</ul>
	</article>
</section>
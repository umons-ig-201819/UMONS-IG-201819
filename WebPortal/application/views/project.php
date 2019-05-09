<section id="top_page">
<h1>Gestion du projet <?=$project['project_name'];?></h1>
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
		echo form_open("administration/project/$project[id]");
		echo form_fieldset(htmlentities($project['project_name']));
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
        echo '<textarea rows="4" cols="50" name="project_description" id="project_description">'.htmlentities($project['project_description']).'</textarea>';
        echo '</p>';

        
        echo '<p><a href="'.site_url("administration/removeProject/$project[id]").'">Supprimer le projet</a></p>';
        
        echo '<p>';
        echo form_submit('action', 'Modifier',"class='buttonvalider'");
        echo '</p>';
        
        echo form_fieldset_close();
        echo form_close();
		?>
	</article>
	<article>
		<?php
		echo form_open("administration/project/$project[id]");
		echo form_fieldset('Ajouter un membre');
		echo '<p>';
		echo form_label('Gestionnaire du projet','manage');
		echo form_checkbox(array(
		    'name'          => 'manage',
		    'id'            => 'manage',
		    'value'         => 'true',
		    'checked'       => false,
		));
		echo '</p>';
		
		echo '<p>';
		echo form_label('Nom d\'utilisateur','login');
		echo form_input('login','','id="login"');
		echo '</p>';
        
        echo '<p>';
            echo form_submit('addaction', 'Ajouter');
        echo '</p>';
        
        echo form_fieldset_close();
        echo form_close();
		?>
	</article>
	<article>
	<ul>
		<?php foreach($scientists as $scientist): ?>
		<li>
		<?php
		echo form_open("administration/update/$project[id]/$scientist[member_id]");
		echo form_fieldset("$scientist[member_username] ($scientist[member_firstname] $scientist[member_lastname])");
		
		echo '<p>';
		echo form_label('Gestionnaire du projet','manage');
		echo form_checkbox(array(
		    'name'          => 'manage',
		    'id'            => 'manage',
		    'value'         => 'true',
		    'checked'       => $scientist['member_gestion'] == '1',
		));
		echo '</p>';
		
		echo '<p><a href="'.site_url("administration/removeUser/$project[id]/$scientist[member_id]").'">Supprimer du projet l\'utilisateur</a></p>';
		
		echo '<p>';
		echo form_submit('update', 'Modifier');
		echo '</p>';
		
		echo form_fieldset_close();
        echo form_close();
		?>
		</li>
		<?php endforeach; ?>
	</ul>
	</article>
</section>

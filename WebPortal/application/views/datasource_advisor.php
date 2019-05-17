<section id="top_page">
	<h1>Conseillers sur <?=htmlentities($source['name']);?></h1>
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
		echo form_open("datasource/addAdvisor/$source[id]");
		echo form_fieldset('Ajouter un conseiller');
				
		echo '<p>';
		echo form_label("Nom d'utilisateur du conseiller",'login');
		echo form_input('login','','id="login" class="suggestion"');
		echo form_submit('actionadd', 'Ajouter',"class='buttonvalider'");
		echo '</p>';
		
		echo form_fieldset_close();
		echo form_close();
		?>
	</article>
	<article>
	<ul>
	<?php foreach($advisors as $data): ?>
		<li> 
		<?php
		echo form_open("datasource/advisor/$source[id]");
		echo form_fieldset(htmlentities($data['username']).'('.htmlentities($data['firstname']).', '.htmlentities($data['lastname']).')');
				
		$options = array(
    		'0'   => 'Action requise',
    		'1'   => 'Autoris&eacute;',
    		'2'   => 'Refus&eacute;'
		);
		$selected = $data['state'];
				
		echo '<p>';
		echo form_label('Source','state');
		echo form_hidden('advisorid',$data['userid']);
		echo form_dropdown('state',$options,$selected,'id="state" required="required"');
		echo form_submit('action', 'Modifier',"class='buttonvalider'");
		echo '</p>';
		
		echo form_fieldset_close();
		echo form_close();
		?>
		</li>
	<?php endforeach; ?>
	</ul>
	</article>
</section>

<section>
<?php
print_r($source); ?>
	<h1>Conseillers sur <?=htmlentities($source['name']);?></h1>
	<article>
	<p>TODO ajouter un conseiller</p>
	<ul>
	<?php print_r($advisors); ?>
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
		echo form_label('Source');
		echo form_dropdown('state',$options,$selected,'id="state" required="required"');
		echo form_submit('action', 'Modifier');
		echo '</p>';
		
		echo form_fieldset_close();
		echo form_close();
		?>
		</li>
	<?php endforeach; ?>
	</ul>
	</article>
</section>

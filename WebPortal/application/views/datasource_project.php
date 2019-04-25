<section>
	<h1>Acc&egrave;s de projets sur <?=htmlentities($source['name']);?></h1>
	<article>
	<?php if(!empty($error)): ?>
	<p class="error"><?=$error;?></p>
	<?php endif; ?>
	<?php if(!empty($success)): ?>
	<p class="success"><?=$success;?></p>
	<?php endif; ?>
	</article>
	<article>
	<ul>
	<?php foreach($projects as $data): ?>
		<li> 
		<?php
		echo form_open("datasource/project/$source[id]");
		echo form_fieldset(htmlentities($data['name']).'('.htmlentities($data['end_date']).')');
		
		$options = array(
    		'0'   => 'Action requise',
    		'1'   => 'Autoris&eacute;',
    		'2'   => 'Refus&eacute;'
		);
		$selected = $data['state'];
				
		echo '<p>';
		echo form_label('Source','state');
		echo form_hidden('projectid',$data['id']);
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

<section>
	<article>
		<h1>Source de données</h1>
<?php
echo form_open('datasource');
echo form_fieldset('Source de données');
echo '<p>';
    echo form_label('Source');
    echo form_dropdown('datasource',$options,$selected,'id="datasource" required="required"');
    echo form_submit('action', 'Charger');
echo '</p>';
echo form_fieldset_close();
echo form_close();
		?>
	</article>
	<?php foreach($url as $zeppelin_link): ?>
	<!--  sandbox="allow-plugins allow-scripts allow-same-origin"  --> 
	<iframe id="table_view" width="100%" height="500px" src="<?=$zeppelin_link;?>" scrolling="yes"></iframe>
	<?php endforeach; ?>
</section>
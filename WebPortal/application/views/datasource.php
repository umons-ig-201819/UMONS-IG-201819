<section>
	<article>
		<h1>Source de données</h1>
<?php
echo form_open('datasource');
echo form_fieldset('Source de données');
echo '<p>';
    echo form_label('Source');
    echo form_dropdown('datasource',$sources,$selected,'id="datasource" required="required"');
echo '</p>';
echo form_submit('action', 'Se connecter');
echo form_fieldset_close();
echo form_close();
		?>
	</article>
	<iframe id="table_view" src="<?=$notebook_table?>" sandbox="allow-plugins allow-scripts allow-same-origin"></iframe>
	<iframe id="graph_view" src="<?=$notebook_graph?>" sandbox="allow-plugins allow-scripts allow-same-origin"></iframe>
</section>
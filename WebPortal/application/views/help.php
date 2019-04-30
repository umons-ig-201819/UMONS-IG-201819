<h1>Connexion</h1>
<section>
		<?php        
            echo form_open('connection');
            echo form_fieldset('Informations:');
            echo form_submit('action', 'Se connecter');
            echo form_fieldset_close();
            echo form_close();
        ?>
</section>

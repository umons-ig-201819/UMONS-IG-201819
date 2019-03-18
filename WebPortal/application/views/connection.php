<section>
	<article>
		<h1>Connexion</h1>
<?php
if(isset($this->session->UserID)):
?>		<p id="success">Bienvenue <?=ucfirst($firstname).' '.strtoupper($lastname);?>.</p>

<?php
else:
        if(isset($error)):
?>
		<p id="error">Erreur de login/mot de passe.</p>
<?php
        endif;
        echo form_open('connection');
        echo form_fieldset('Informations de connexion&nbsp;:');
        echo '<p>';
            echo form_label('Identifiant','username');
            echo form_input('username',$this->input->post('username',TRUE),'id="username" required="required"');
        echo '</p>';
        echo '<p>';
            echo form_label('Mot de passe','password');
            echo form_password('password','','id="password" required="required"');
        echo '</p>';
        echo form_submit('action', 'Se connecter');
        echo form_fieldset_close();
        echo form_close();
endif;
?>
	</article>
</section>

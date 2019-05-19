	<section id="top_page">
		<h1>Connexion</h1>
	</section>
	<section>
<?php if(isset($this->session->UserID)): ?>
			<h2>
			<p id="success">Bienvenue <?=ucfirst($firstname).' '.strtoupper($lastname);?>.</p>
			</h2>
<?php else:
        if(isset($error)):
?>
		<p id="error"><font color="red">Erreur de login/mot de passe.</font></p>
		<?php endif; ?>
	<?php        
        echo form_open('connection');
        echo form_fieldset('Informations de connexion&nbsp;:');
        echo '<p>'; 
        echo form_label('Identifiant : ','username');
        echo form_input('username',$this->input->post('username',TRUE),'id="username" required="required"');  
        echo '<br>';
        echo form_label('Mot de passe : ','password');
        echo form_password('password','','id="password" required="required"');
        echo '<br>';
        echo '</p>';
        echo form_submit('action', 'Se connecter', "class='buttonvalider'");
        echo '<p><a href="'.site_url("connection/lost").'">Mot de passe oubli&eacute;&nbsp;?</a></p>';
        echo form_fieldset_close();
        echo form_close();
    endif;
?>
</section>


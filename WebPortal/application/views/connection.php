<section>
	<article>
		<h1>Connexion</h1>
		<?php
$required = array('required' => 'required');

echo form_open('connection');
echo form_fieldset('Informations de connexion&nbsp;:');
echo '<p>';
    echo form_label('Identifiant','username');
    echo form_input('username',$this->input->post('username',TRUE) ,$required,'id="username"');
echo '</p>';
echo '<p>';
    echo form_label('Mot de passe','password');
    echo form_password('password',$required,'id="password"');
echo '</p>';
echo form_submit('action', 'Se connecter');
echo form_fieldset_close();
echo form_close();
		?>
	</article>
</section>

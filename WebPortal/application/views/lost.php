	<section id="top_page">
		<h1>Connexion</h1>
	</section>
	<section>
<?php if(isset($state)): ?>
			<h2>
			<p id="success">Votre nouveau mot de passe a &eacute;t&eacute; envoy&eacute; par email.</p>
			</h2>
<?php else:
        echo form_open('connection/lost');
        echo form_fieldset('Informations de r&eacute;cup&eacute;ration de mot de passe&nbsp;:');
        echo '<p>'; 
        echo form_label('Adresse email : ','email');
        echo form_input('email','','id="email" required="required"');  
        echo '</p>';
        echo form_submit('action', 'Demander un nouveau mot de passe', "class='buttonvalider'");
        echo form_fieldset_close();
        echo form_close();
    endif;
?>
</section>
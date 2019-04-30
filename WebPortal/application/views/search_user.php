<section>
	<h1>Recherche d'un utilisateur</h1>
<?php
		echo form_open("search/user");
		echo form_fieldset('Critères de recherche d\'utilisateur');
				
		echo '<p>';
		echo form_label("Nom",'lastname');
		echo form_input('lastname','','id="lastname"');

		echo form_label("Pr&eacute;nom",'firstname');
		echo form_input('firstname','','id="firstname"');
		echo '</p>';
		
		echo '<p>';
		echo form_label("Email",'email');
		echo form_input('email','','id="email"');
		echo '</p>';
		
		echo '<p>';
		echo form_label("Nom d'utilisateur",'login');
		echo form_input('login','','id="login"');
		echo '</p>';
		
		echo '<p>';
		echo form_label("T&eacute;l&eacute;phone",'phone');
		echo form_input('phone','','id="phone"');
		echo '</p>';
		
		echo '<p>';
		echo form_label("T&eacute;l&eacute;phone portable",'mobile');
		echo form_input('mobile','','id="mobile"');
		echo '</p>';
		
		echo '<p>';
		echo form_submit('action', 'Rechercher');
		echo '</p>';
		
		echo form_fieldset_close();
		echo form_close();
?>		
	<article>
		<ul>
		<?php foreach($result as $data): ?>
			<li><?=htmlentities($data['firstname']).' '.htmlentities($data['lastname']).'&nbsp;: '.htmlentities($data['login']);?>
			<?php
			if(array_key_exists('roles', $data)):
			    echo '<p>';
			    echo form_open("search/update/$data[id]");
			    echo form_hidden('lastname',htmlentities($this->input->post('lastname')));
			    echo form_hidden('firstname',htmlentities($this->input->post('firstname')));
			    echo form_hidden('email',htmlentities($this->input->post('email')));
			    echo form_hidden('login',htmlentities($this->input->post('login')));
			    echo form_hidden('phone',htmlentities($this->input->post('phone')));
			    echo form_hidden('mobile',htmlentities($this->input->post('mobile')));
			    echo form_hidden('action','Rechercher');
			    echo form_dropdown("roles[]", $roles, $data['roles'],'multiple="multiple"');
			    echo form_submit('updateaction', 'Modifier');
			    echo form_close();
			    echo '</p>';
			endif;
			?>
			</li>
		<?php endforeach; ?>
		</ul>
	</article>
</section>
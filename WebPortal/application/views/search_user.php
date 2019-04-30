<section>
	<h1>Recherche d'un utilisateur</h1>
<?php
		echo form_open("search/user");
		echo form_fieldset('Recherche du login d\'un utilisateur');
		
		echo '<p>';
		echo form_label("Nom",'lastname');
		echo form_input('lastname','','id="lastname"');
		echo '</p>';
		
		echo '<p>';
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
			if(array_key_exists('roles', $data)){
			    echo form_dropdown("roles_$data[id]", $roles, $data['roles']);
			}
			?>
			</li>
		<?php endforeach; ?>
		</ul>
	</article>
</section>
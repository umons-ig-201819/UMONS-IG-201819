		<h1>Connexion</h1>
<?php
if(isset($this->session->UserID)):
?>		<p id="success">Bienvenue <?=ucfirst($firstname).' '.strtoupper($lastname);?>.</p>

<?php
else:
        if(isset($error)):
?>
		<p id="error"><font color="red">Erreur de login/mot de passe.</font></p>
<?php endif;
        ?><section><?php        
        echo form_open('connection');
      
        echo form_fieldset('Informations de connexion&nbsp;:');
        echo '<p>'; 
        ?>
        	<label><?php echo form_label('Identifiant','username'); ?></label> 
            <?php 
            echo form_input('username',$this->input->post('username',TRUE),'id="username" required="required"');  
            echo '<br>';
            ?>
            <label><?php echo form_label('Mot de passe','password'); ?></label> 
            <?php
            echo form_password('password','','id="password" required="required"');
            echo '<br>';
            ?>
        <?php 
        echo '</p>';
        echo form_submit('action', 'Se connecter');
        echo form_fieldset_close();
        echo form_close();
endif;
?>
</section>

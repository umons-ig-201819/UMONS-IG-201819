<!DOCTYPE html>
<html>
    <body>    
    <!-- INSCRIPTION ELEVEUR : s'inscrit lui-même. -->


<?php echo validation_errors(); ?>

        <section>
            	<article><h1>Inscription</h1></article>
        <br><aside>Remarque : les inscriptions ne peuvent &ecirc;tre faites manuellement que pour la cr&eacute;ation de comptes &eacute;leveurs. 
        Pour les autres types d'inscriptions (par ex. : scientifiques, conseillers), vous pouvez nous contacter <a href="#">ici</a>. </aside><br>
        
        </section>
        
        <section class="column middle">
        <?php if(isset($error)):
?>
		<font color ='red'><p id="error"><?php echo $error; ?></p></font>
<?php
        endif;
        ?>
        	<form action="#" method="POST" onSubmit="return inscriptionValidate(this)">
        	<fieldset>
        	<legend> Informations d'inscription :  </legend>
        		<article>
        		 	<label >Nom d'utilisateur (Login) : </label>
        		 	<input type="text" name="login" value="<?php echo set_value('login');?>">
        		 	<font color = 'red'>* champs obligatoire</font><br><br>
      	       		<label >Sexe : </label>
                		<input type="radio" name="gender" value="man"> Homme&nbsp;&nbsp;
        				<input type="radio" name="gender" value="female"> Femme&nbsp;&nbsp;
        				<input type="radio" name="gender" value="other"> autre<br><br>
                	<label >Nom : </label>
                	<input type="text" name="lastname" value="<?php echo set_value('lastname');?>">
                	<font color = 'red'>* champs obligatoire</font><br><br>
                	<label >Pr&eacute;nom : </label>
                	<input type="text" name="firstname" value="<?php echo set_value('firstname');?>">
                	<font color = 'red'>* champs obligatoire</font><br><br>
                	<label >Date de naissance : </label>
                	<input type="date" name="birthdate" ><br><br>
                	<label >E-mail : </label>
                	<input type="text" name="email" value="<?php echo set_value('email');?>" ><br><br>
                	<label >Num&eacute;ro de t&eacute;l&eacute;phone : </label>
                	<input type="text" name="phone" value="<?php echo set_value('phone');?>">&nbsp
                	<label >Num&eacute;ro de GSM : </label>
                	<input type="text" name="mobile" value="<?php echo set_value('mobile');?>"><br><br>
		  	 		<label >Mot de passe : </label>
		  	 		<input type="password" id="mdp" name="password" placeholder="Votre mot de passe" value="<?php echo set_value('password');?>"/>
		  	 		<font color = 'red'>* champs obligatoire</font>
        			<input type="password" id="confirm_mdp" name="confirm_mdp" placeholder="Confirmation du mot de passe" value="default"/>
        			<font color = 'red'>* champs obligatoire</font><br><br>
            		<input type="submit" value="Cr&eacute;er le compte" name="registering">
            		<label >Conseiller : </label>
                	<input type="checkbox" name="advice" unchecked ><br><br>	
        		</article>
        	</fieldset>
        	</form>
		</section>
    </body>
</html>

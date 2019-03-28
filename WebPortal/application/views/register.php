<section>
	<article><h1>Inscription</h1></article>
        <?php if(isset($error)):?>
		<p id="error"><font color ='red'><?= $error; ?></font></p>
		<?php endif; ?>
		
<?= form_open('register'); ?>
<fieldset>
<legend> Informations d'inscription :  </legend>
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
	</fieldset>
	</form>
</section>


<section id="top_page">
<h1>Inscription</h1>
</section>
<section>
        <?php if(isset($error)):?>
		<p id="error"><font color ='red'><?= $error; ?></font></p>
		<?php endif; ?>
		<?php echo validation_errors(); ?>		


<?= form_open('register'); ?>
<fieldset>
<legend> Informations d'inscription :  </legend>
	 	<label >Nom d'utilisateur (Login) : </label>
	 	<input type="text" name="login" value="<?php echo set_value('login');?>">
	 	<br><br>
   		<label >Sexe : </label>
    		<input type="radio" name="gender" value="1" <?php echo set_radio('gender',1,TRUE);?>> Homme&nbsp;&nbsp;
			<input type="radio" name="gender" value="0" <?php echo set_radio('gender',0);?>> Femme&nbsp;&nbsp;
			<input type="radio" name="gender" value="2" <?php echo set_radio('gender',2);?>> Autre<br><br>
    	<label >Nom : </label>
    	<input type="text" name="lastname" value="<?php echo set_value('lastname');?>">
    	<br><br>
    	<label >Pr&eacute;nom : </label>
    	<input type="text" name="firstname" value="<?php echo set_value('firstname');?>">
    	<br><br>
    	<label >Date de naissance : </label>
    	<input type="date" name="birthdate" value="<?php echo set_value('birthdate');?>"><br><br>
    	<label >E-mail : </label>
    	<input type="text" name="email" value="<?php echo set_value('email');?>" ><br><br>
    	<label >Num&eacute;ro de t&eacute;l&eacute;phone : </label>
    	<input type="text" name="phone" value="<?php echo set_value('phone');?>"><br><br>
    	<label >Num&eacute;ro de GSM : </label>
    	<input type="text" name="mobile" value="<?php echo set_value('mobile');?>"><br><br>
 		<label >Mot de passe <font color = 'red'>*</font> : </label>
 		<input type="password" id="mdp" name="password" placeholder="Votre mot de passe" value="<?php echo set_value('password');?>">
  	 	<br><br>
  	 	<label >Confirmation <font color = 'red'>*</font> :</label>	
		<input type="password" id="confirm_mdp" name="confirm_mdp" placeholder="Confirmation du mot de passe" value="<?php echo set_value('confirm_mdp');?>">
			<br><br>
    	
    	<input type="reset"  name="reset"><input type="submit" value="Cr&eacute;er le compte" name="registering"><br><br>
    		<font color = 'red'>* champs obligatoire</font>
	</fieldset>
	</form>
	
</section>


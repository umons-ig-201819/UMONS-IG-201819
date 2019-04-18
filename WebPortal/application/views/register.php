<section>
	<article>
		<h1>Inscription</h1>
        <?php if(isset($error)):?>
		<p id="error"><font color ='red'><?= $error; ?></font></p>
		<?php endif; ?>
		<?php echo validation_errors(); ?>		
		
<?= form_open('register'); ?>
<fieldset>
<legend> Informations d'inscription :  </legend>
	 	<label >Nom d'utilisateur (Login) : </label>
	 	<input type="text" name="login" style="border-color:red" value="<?php echo set_value('login');?>">
	 	<font color = 'red'>*</font><br><br>
   		<label >Sexe : </label>
    		<input type="radio" name="gender" value="1" <?php echo set_radio('gender',1,TRUE);?>> Homme&nbsp;&nbsp;
			<input type="radio" name="gender" value="0" <?php echo set_radio('gender',0);?>> Femme&nbsp;&nbsp;
			<input type="radio" name="gender" value="2" <?php echo set_radio('gender',2);?>> Autre<br><br>
    	<label >Nom : </label>
    	<input type="text" name="lastname" style="border-color:red" value="<?php echo set_value('lastname');?>">
    	<font color = 'red'>*</font><br><br>
    	<label >Pr&eacute;nom : </label>
    	<input type="text" name="firstname" style="border-color:red" value="<?php echo set_value('firstname');?>">
    	<font color = 'red'>*</font><br><br>
    	<label >Date de naissance : </label>
    	<input type="date" name="birthdate" value="<?php echo set_value('birthdate');?>"><br><br>
    	<label >E-mail : </label>
    	<input type="text" name="email" value="<?php echo set_value('email');?>" ><br><br>
    	<label >Num&eacute;ro de t&eacute;l&eacute;phone : </label>
    	<input type="text" name="phone" value="<?php echo set_value('phone');?>">&nbsp
    	<label >Num&eacute;ro de GSM : </label>
    	<input type="text" name="mobile" value="<?php echo set_value('mobile');?>"><br><br>
 		<label >Mot de passe : </label>
 		<input type="password" id="mdp" name="password" style="border-color:red" placeholder="Votre mot de passe" value="<?php echo set_value('password');?>"/>
  	 		<font color = 'red'>*</font>
			<input type="password" id="confirm_mdp" name="confirm_mdp" style="border-color:red" placeholder="Confirmation du mot de passe" value="<?php echo set_value('confirm_mdp');?>"/>
			<font color = 'red'>*</font><br><br>
    		<input type="submit" value="Cr&eacute;er le compte" name="registering"><br><br>
    		<font color = 'red'>* champs obligatoire</font>
	</fieldset>
	</form>
	</article>
</section>



<section id="top_page">
    <h1>Inscription</h1>
</section>
<section>
<fieldset>
    <?= form_open('register'); ?>
    <legend> Informations d'inscription :  </legend>
           	<br><label >sexe : </label><br>
        		<input type="radio" name="gender" value="man"> Homme&nbsp;&nbsp;
    			<input type="radio" name="gender" value="female"> Femme&nbsp;&nbsp;
    			<input type="radio" name="gender" value="other"> autre<br><br>
    
        	<label >Nom : </label><br>
        		<input type="text" name="lastname" required><br><br>
        	<label >Pr&eacute;nom : </label><br>
        		<input type="text" name="firstname" required><br><br>
        	<label >Date de naissance : </label> <br>
        		<input type="date" name="date_nais" required><br><br>
        	<label >E-mail : </label> <br>
        		<input type="text" name="mail" required><br><br>
        	<label >Num&eacute;ro de t&eacute;l&eacute;phone : </label> <br>
        		<input type="text" name="tel1" required><br><br>
        	<label >Num&eacute;ro de GSM : </label><br>
        		<input type="text" name="tel2" required><br><br>
    
    		<label >Nom d'utilisateur :</label><br>
    			<input type="text" name="login" required><br><br>
    
    	<label >Mot de passe :</label> <br>
    	<input type="password" id="mdp" name="mdp" placeholder="Votre mot de passe" required/><br><br>
    	<input type="password" id="confirm_mdp" name="confirm_mdp" placeholder="Confirmation du mot de passe" required/> <br><br>
    
    	<input type="submit"><input type="reset">				
</form>
</fieldset>
</section>

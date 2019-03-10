<!DOCTYPE html>
<html>
<head>
<<<<<<< HEAD
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<title>Portail AWE</title>
=======

<meta charset="utf-8" />
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url(); ?>assets/css/style.css">
<title>Portail AWE</title>
>>>>>>> branch 'master' of git@github.com:umons-ig-201819/UMONS-IG-201819.git
</head>
<body>

<?php include ("header.php")?>

<!-- ACCUEIL -->

<h2>Bienvenue !</h2>
	<section>
		<article>
			<h3>
				<img src="tofill.png" alt="IMAGE " />Actualit&eacute;s
			</h3>
		</article>
		<article>
			<h3>
				<img src="tofill.png" alt="IMAGE " />G&eacute;n&eacute;ralit&eacute;s
			</h3>
		</article>

		<aside>
			<h3>Nombre d'agriculteurs inscrits</h3>

			<h3>Nombre de visites par jour</h3>
		</aside>
	</section>
	
<!-- CONNEXION -->

 <section>
    	<article><h1>Connexion</h1></article>
    </section>

<section class="column middle">
	<fieldset>
	<legend> Informations de connexion  :  </legend>
		<article>
    		<br><label >Identifiant :</label><br>
    			<input type="text" name="login"><br><br>
    		<label >Mot de passe :</label><br>
    			<input type="password" name="mdp">
    		<br><br>
    		<a href="#">mot de passe perdu ?</a><br><br>
    		<input type="submit"><input type="reset">				
		</article>
	</fieldset>
</section>


<!-- INSCRIPTION ELEVEUR : s'inscrit lui-même. -->

<section>
    	<article><h1>Inscription</h1></article>
<br><aside>Remarque : les inscriptions ne peuvent &ecirc;tre faites manuellement que pour la cr&eacute;ation de comptes &eacute;leveurs. 
Pour les autres types d'inscriptions (par ex. : scientifiques, conseillers), vous pouvez nous contacter <a href="#">ici</a>. </aside><br>

</section>

<section class="column middle">

	<fieldset>
	<legend> Informations d'inscription :  </legend>
		<article>
	       	<br><label >sexe : </label><br>
        		<input type="radio" name="type" value="homme"> Homme&nbsp;&nbsp;
				<input type="radio" name="type" value="femme"> Femme<br><br>
	
        	<label >Nom : </label><br>
        		<input type="text" name="nom"><br><br>
        	<label >Pr&eacute;nom : </label><br>
        		<input type="text" name="nom"><br><br>
        	<label >Date de naissance : </label> <br>
        		<input type="date" name="date_nais"><br><br>
        	<label >E-mail : </label> <br>
        		<input type="text" name="email"><br><br>
        	<label >Num&eacute;ro de t&eacute;l&eacute;phone : </label> <br>
        		<input type="text" name="tel"><br><br>
        	<label >Num&eacute;ro de GSM : </label><br>
        		<input type="text" name="tel"><br><br>
 
    		<label >Nom d'utilisateur :</label><br>
    			<input type="text" name="login"><br><br>

		<label >Mot de passe :</label> <br>
		<input type="password" id="mdp" name="mdp" placeholder="Votre mot de passe" size="22" maxlength="20" required/><br><br>
		<input type="password" id="confirm_mdp" name="confirm_mdp" placeholder="Confirmation du mot de passe" size="22" maxlength="20" required/> <br><br>

    	<input type="submit"><input type="reset">				
		</article>
	</fieldset>
</section>

<?php include ("footer.php")?>

</body>
</html>
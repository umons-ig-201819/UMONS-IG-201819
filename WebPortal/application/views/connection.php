<!DOCTYPE html>
<html>
    <head>
    
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css"
    	href="<?php echo base_url(); ?>assets/css/style.css">
    <title>Portail AWE</title>
    </head>
    
    <body>    
    <?php include ("header.php")?>
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

    
    
    <?php include ("footer.php")?>
    </body>
</html>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8" />
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url(); ?>assets/css/style.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/home.js"></script>
<title>Portail AWE</title>
</head>

<body>
    <header>
        <div id="titre_principal">
            <div id="logo">
            	<img src="<?php echo base_url(); ?>assets/images/logo_awe_asbl.png" alt="Logo Principal AWE!" />
            	<h1> Portail de l'association wallonne de l'&eacute;levage </h1>
            </div>
            	<h2> Page principale</h2>
            	 <img src="<?php echo base_url(); ?>assets/images/top_commercial.png" alt="top commercial!" name="commercial" />
        </div>    
    
    	<nav>
            <ul> 
                <li><a href="<?php echo base_url("home/main"); ?>">Accueil</a></li>
                <li><a href="<?php echo base_url("home/help"); ?>">Help</a></li>
                <li><a href="<?php echo base_url("home/connect"); ?>">Connexion</a></li>
                <li><a href="<?php echo base_url("home/inscript"); ?>">Inscription</a></li>
            </ul>
    	</nav>
     
    </header>
</body>
</html>
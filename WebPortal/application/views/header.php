<!DOCTYPE html>
<html>
    <head>
    	<meta charset="UTF-8">
    	<title>Portail de l'AWE</title>
    	<!--[if lt IE 9]>
    		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<![endif]-->
    	<link rel="stylesheet" type="text/css" media="only screen" href="<?php echo base_url(); ?>assets/css/style.css" />
    	<style type="text/css">
        	.alert-warning {
        	   visibility: hidden;
        	   display: none;
        	}
    	</style>
    </head>
    <body>
    	<header id="main_header">    	 
            <div id="titre_principal">
                <div id="logo">
                	<img src="<?php echo base_url(); ?>assets/images/logo_awe_asbl.png" alt="Logo Principal AWE!" />
                	<h1> Portail de l'association wallonne de l'&eacute;levage </h1>
                </div>
                	
                	 
 <!--           </div>     -->
    		<nav>
    		<h2> Page principale</h2>
    			<ul>
    				<li><a href="<?php echo site_url("home"); ?>">Accueil</a></li>
                    <li><a href="<?php echo site_url("help"); ?>">Help</a></li>
                    <?php if(isset($this->session->UserID)): ?>
                    <li><a href="<?php echo site_url("connection/logout"); ?>">D&eacute;connexion</a></li>
                    <li><a href="<?php echo site_url("profil"); ?>">Mon profil</a></li>
                    <li><a href="<?php echo site_url("datasource"); ?>">Mes donn&eacute;es/applications</a></li>
                    <?php else: ?>
                    <li><a href="<?php echo site_url("connection"); ?>">Connexion</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo site_url("register"); ?>">Inscription</a></li>
              <!--     <li><a href="?php echo site_url("connection/register"); ?>">Inscription</a></li>        -->              
    			</ul>
    		</nav>
    		</div>
    	</header>

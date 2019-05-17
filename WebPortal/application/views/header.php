<!DOCTYPE html>
<html>
    <head>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta charset="UTF-8">
    	<title>Wallesmart</title>
    	<!--[if lt IE 9]>
    		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<![endif]-->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> <!--  Ajout de la largeur de l'�cran pour le d�v-->
    	<script src="../assets/javascript/suggestion.js"></script>
    	<link rel="stylesheet" type="text/css"  href="<?php echo base_url(); ?>assets/css/style.css" />
    	<link rel="stylesheet" type="text/css"  href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" />
    	<link rel="icon" href="../assets/images/favicon.ico" />
    	<style type="text/css">
        	.alert-warning {
        	   visibility: hidden;
        	   display: none;
        	}
    	</style>
    
        
    </head>
    <body>
       
              <div id="logo">
                	<!--  <img src="<?php echo base_url(); ?>assets/images/Wallesmart2.png" alt="Logo Principal AWE!" />-->
                	
                	
                </div>
    
    	<div class="header" id="myHeader">
    	
    <!--  <div class="topnav" id="myTopnav">-->	
            		   	
            				<a href="<?php echo site_url("home"); ?>">Accueil</a>
                            <a href="<?php echo site_url("help"); ?>">&Agrave; propos</a>
                            <?php if(isset($this->session->UserID)): ?>
                            
                            <?php if(in_array('MANAGE_PROJECT', $this->session->Rights)): ?>
                            <a href="<?php echo site_url("administration"); ?>">Gestion</a>
                            <?php endif; ?>
                            <a href="<?php echo site_url("profil"); ?>">Mon profil</a>
                            <a href="<?php echo site_url("datasource"); ?>">Mes donn&eacute;es</a>
                            <a href="<?php echo site_url("search/user"); ?>">Rechercher un utilisateur</a>
                            <a href="<?php echo site_url("search/datasource"); ?>">Rechercher des donn&eacute;es</a>
                            <?php else: ?>
                            <a href="<?php echo site_url("connection"); ?>">Connexion</a>
                            <a href="<?php echo site_url("register"); ?>">Inscription</a>
                            
                            <?php endif; ?>
                            <?php if(isset($this->session->UserID)): ?>
                            <a href="<?php echo site_url("connection/logout"); ?>">D&eacute;connexion</a>
                            <?php endif; ?>
                            <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                      <!--     <li><a href="?php echo site_url("connection/register"); ?>">Inscription</a></li>        -->              
            			
        
    			</div>
  </div>


<script type="text/javascript">
function myFunction() {
    var x = document.getElementById("myHeader");
    if (x.className === "header") {
      x.className += " responsive";
    } else {
      x.className = "header";
    }
  }



    	window.onscroll = function() {myFunction2()};

    	var header = document.getElementById("myHeader");
    	var sticky = header.offsetTop;

    	function myFunction2() {
    	  if (window.pageYOffset > sticky) {
    	    header.classList.add("sticky");
    	  } else {
    	    header.classList.remove("sticky");
    	  }
    	}

       

</script>
	

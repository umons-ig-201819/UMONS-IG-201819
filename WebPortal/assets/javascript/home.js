/**
 * script appelé par les views suivantes :
 * home.php
 * header.php
 * footer.php
 * connexion.php
 * inscription.php
 * help.php
 * 
 */

       
function inscriptionValidate(f)          
{
/* USE CASE : l'utilisateur existe déjà? */
        ok=true;  	            	
    	var email = f.mail.value;
    	var phone1= f.tel1.value;
    	var phone2= f.tel2.value;
    	var regex1 = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
    	var mdp1 = f.mdp.value;
    	var mdp2 = f.confirm_mdp.value;
    	var p1 = email.indexOf("@"));
    	var p2 = email.indexOf("."));
   	
    	/*Ce qui suit en commentaire ne fonctionne pas!! A regarder à tête reposée...
    	if ((p1 == -1 || p2 == -1)    	
        { 		
        	alert("adresse mail non conforme") ;	
        	ok = false ;  	
        }
		
		if (phone1.match(regex1))       
    	{       
    		alert("Le numéro de téléphone doit être un nombre !!");      
    		return false;   
    	}  
		if (phone2.match(regex1))       
    	{       
    		alert("Le numéro de téléphone doit être un nombre !!");      
    		return false;   
    	} */
        if (mdp1 != mdp2) 
        {       	
        	alert("Les mots de passe ne correspondent pas!"); 	
        	return false; 
        }

return ok ;
}



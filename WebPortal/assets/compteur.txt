<?php

$fp = fopen("compteur.txt","r+"); 
$nbvisites = fgets($fp,255); 
$nbvisites++; 
fseek($fp,0); 
fputs($fp,$nbvisites); 
fclose($fp); 
echo'Nombre de pages : '.$nbvisites.'';

?>
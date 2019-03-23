<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
//require_once("../../lib/go-pear.phar");
define("__ROOT__",dirname(dirname(dirname(__FILE__))));
require_once(__ROOT__.'/WebPortal/application/models/UserModel.php');

// Connexion test case
echo "test";
class ConnexionTest extends PHPUnit_Framework_TestCase
{
    
    /**
     *
     * @var Connexion
     */
    private $connexion;
    
    
    
    
    public function testAuthentification($login, $password)
    {
        
        $a=new UserModel;
        $a->authentification("acools","test");
        
        //echo ($this->assertequal(false, authentification($login,$password)));
        
        
        
    }
    
    //test
    
    
}
$login="acools";
$password="test";
$test= new ConnexionTest;
$test->testAuthentification($login, $password);


<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../configuration.php');

load_model('UserModel');

// Connexion test case

class ConnexionTest extends TestCase
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


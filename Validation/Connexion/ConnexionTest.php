<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../configuration.php');

load_model('UserModel');

print("test loaded\n");
// Connexion test case

class UserModelTest extends TestCase
{
    
    /**
     *
     * @var Connexion
     */
    private $connexion;
    
    
    
    
    public function testAuthentification($login, $password)
    {
        
        $this->authentification("acools","test");
        
        //echo ($this->assertequal(false, authentification($login,$password)));
        
        
        
    }
    
    //test
    
    
}
/*
echo "a";
$login="acools";
$password="test";
echo "b";
$test= new UserModelTest();
echo "c";
$test->testAuthentification($login, $password);
echo "d";*/

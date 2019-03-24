<?php

// use PHPUnit\Framework\TestCase;

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../configuration.php');

load_model('UserModel');

class UserModelTest extends TestCase
{
    
    /**
     *
     * @var Connexion
     */
    private $connexion;
    
    
    
    
    public function testAuthentification($login, $password)
    {
        $a = new UserModel();
        $a->authentification("acools","test");
        
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

<?php

// use PHPUnit\Framework\TestCase;

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../configuration.php');

load_model('UserModel');

class ConnectionTest extends TestCase
{
    
    /**
     *
     * @var Connexion
     */
    public $connexiontest;
    private $connexion;
    public function setUp()
    {
        $this->connexiontest = new UserModel();
    }
    
    
    
    
     public function testIfWheelWorks()
     {
        // Suppose we have 100 gumballs...
        $this->connexiontest->getUserRoles(100);

        // ... And we turn the wheel once...
        $this->connexiontest->authentification("test","test");

        $this->connexiontest->getRoles();

        // ... we should now have 99 gumballs remaining in the machine right?
        //$this->assertEquals(99, $this->connexiontest->getGumballs()); 
    }
    
    //test
    
    
}

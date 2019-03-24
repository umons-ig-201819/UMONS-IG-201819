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
    
    public function testAuthentification()
    {
        $a = new UserModel();
        $a->authentification("acools","test");
        
    }
  
}


    


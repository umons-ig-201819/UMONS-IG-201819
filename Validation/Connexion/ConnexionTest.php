<?php

// Connexion test case

class ConnexionTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Connexion
     */
    private $connexion;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        // TODO Auto-generated ConnexionTest::setUp()

        $this->connexion = new Connexion(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated ConnexionTest::tearDown()
        $this->connexion = null;

        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }
    
    
    
    public function testAuthentification($login, $password){
        $login="acools";
        $password="test";
        
        
        $this->notassertequal(false, authentification($login,$password));
        
        
        
    }
    
    
    
}


<?php

// use PHPUnit\Framework\TestCase;

use PHPUnit\Framework\TestCase;
//use PHPUnit\DbUnit\TestCaseTrait;

require_once(__DIR__.'/../configuration.php');

load_model('UserModel');

class UserModelTest extends TestCase
{
    
    /**
     *
     * @var Connexion
     */
    private $connexion;
        
    /*
    static private $pdo = null;

    // only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
    private $conn = null;
    */
    public function testCalculate()
    {
        $this->assertEquals(2, 1 + 1);
    }
    
    /*
    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO( $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'] );
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
        }

        return $this->conn;
    }
    
     public function getDataSet()
    {
        return $this->createFlatXMLDataSet( __DIR__ . '/../../Fixtures/test.xml' );
    }
    */
    public function test_connexion()
    {
        $a = new UserModel();
        $a->load->database(getConnection());
        ;
        $this->assertEquals(false,$a->authentification("acools","test"));
    }

    /*protected function setUp()
    {
        parent::setUp();

        $connexion = new PDO("mysql:host=localhost;dbname=wallesmart", "root", "");
        return $this->createDefaultDBConnection($connexion, "wallesmart");
 
        
    }

 
    protected function tearDown()
    {
        // TODO Auto-generated ConTest::tearDown()
        $this->con = null;

        parent::tearDown();
    }

   
    public function __construct()
    {
        $a = new UserModel();
        $a->authentification("acools","test");
    }
    public function testCalculate()
    {
        $this->assertEquals(2, 1 + 1);
    }*/

    
    
    
    
   /* public function getConnection() {
        $connexion = new PDO(
            "mysql:host=localhost;dbname=wallesmart", "root", "");
        return $this->createDefaultDBConnection($connexion, "wallesmart");
    }

    public function getDataSet() {
        return $this->createXMLDataSet("seed.xml");
    }
    
   
*/    /*use TestCaseTrait;

    // only instantiate pdo once for test clean-up/fixture load
    static private $pdo = null;

    // only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
    private $conn = null;

    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO( $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'] );
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
        }

        return $this->conn;
    }
    */
    
    
    
    
    public function testAuthentification(){
        $a = new UserModel();
        $a->authentification("acools","test");
       
    } 
    
     } 

/*
    public function testloginisfree()
    {
        $a= new UserModel();
        $a->loginIsFree("acools");
    }*/
    
    //test
    
    


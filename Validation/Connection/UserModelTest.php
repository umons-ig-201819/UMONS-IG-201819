<?php

// use PHPUnit\Framework\TestCase;

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;

require_once(__DIR__.'/../configuration.php');

load_model('UserModel');

class ConnectionTest extends TestCase
{
    
    use TestCaseTrait;

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
    
    /**
     *
     * @var Connexion
     */
    private $connexion;
    
    
    
    
    /*public function testAuthentification()
    {
        $a = new UserModel();
        $a->authentification("acools","test");
        
        //echo ($this->assertequal(false, authentification($login,$password)));
           
    }*/
    public function testloginisfree()
    {
        $a= new UserModel();
        $a->loginIsFree("acools");
    }
    
    //test
    
    
}

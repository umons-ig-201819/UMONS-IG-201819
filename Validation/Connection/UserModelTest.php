<?php
use PHPUnit\Framework\TestCase;
require_once(__DIR__.'/../configuration.php');
load_model('UserModel');
class UserModelTest extends TestCase{
    private $userModel;
    public function __construct(){
        parent::__construct();
        $userModel = null;
    }
    protected function setUp(){
        $this->userModel = new UserModel();
    }
    protected function tearDown(){
        $this->userModel = null;
    }
   
    public function testAuthentification(){
        $res = $this->userModel->authentification("DurandJ","test");     
        $this->assertEquals($res["id"],"1");
    }
    
   
    public function testAuthentification2(){
        $res = $this->userModel->authentification("as","t");
        $this->assertEquals($res,false);
    }
    
    
    public function testGetUserRoles(){
        $res=$this->userModel->getUserRoles(1);
        $this->assertEquals($res["name"],"agriculteur");
    }
    
    /*public function testGetRoles(){
        $this->userModel->getRoles();
        // assertEquals(?)
    }
    
    public function testGetUserRights(){
        $this->userModel->getUserRights(1);
        // assertEquals(?)
    }
    
    public function testGetRights(){
        $this->userModel->getRights();
        // assertEquals(?)
    }
    
    public function testRoleRights(){
        $this->userModel->getRoleRights();
        // assertEquals(?)
    }
    
    
    public function testGetRight(){
        $this->userModel->getRight();
        // assertEquals(?)
    }
    
    public function testGetUser(){
        $this->userModel->getUser();
        // assertEquals(?)
    }
    
    public function testGetUsers(){
        $this->userModel->getUsers();
        // assertEquals(?)
    }
    
    public function testLoginIsFree(){
        $this->userModel->loginIsFree("acools");
        // assertEquals(?)
    }
    
    
    public function testGetUsersFromRole(){
        $this->userModel->getUsersFromRole();
        // assertEquals(?)
    }
    
    public function testGetAdvice(){
        $this->userModel->getAdvice();
        // assertEquals(?)
    }
    
    public function testGetAdvices(){
        $this->userModel->getAdvices();
        // assertEquals(?)
    }
    
    public function testGetUserAdvices(){
        $this->userModel->getUserAdvices();
        // assertEquals(?)
    }
    
    public function testGetAdvisorAdvices(){
        $this->userModel->getAdvisorAdvices();
        // assertEquals(?)
    }
    
    //--------INSERTION----------
    
    public function testAddUser(){
        $this->userModel->addUser();
        // assertEquals(?)
    }
    
    public function testAddUserRole(){
        $this->userModel->addUserRole();
        // assertEquals(?)   
    }
    
    public function testAddRole(){
        $this->userModel->addRole();
        // assertEquals(?)
    }
    
    public function testAddRight(){
        $this->userModel->addRight();
        // assertEquals(?)
    }
    
    public function testAddRoleRight(){
        $this->userModel->addRoleRight();
        // assertEquals(?)
    }
    
    public function testAddAdvice(){
        $this->userModel->addAdvice();
        // assertEquals(?)
    }
    
    //-------UPDATE------
    
    public function testUpdateUser(){
        $this->userModel->updateUser();
        // assertEquals(?)
    }
    
    public function testUpdateRole(){
        $this->userModel->updateRole();
        // assertEquals(?)
    }
    
    public function testUpdateRight(){
        $this->userModel->updateRight();
        // assertEquals(?)
    }
    
    public function testUpdateAdvice(){
        $this->userModel->updateAdvice();
        // assertEquals(?)
    }
    
    //-------DELETE------
    
    public function testDeleteUser(){
        $this->userModel->deleteUser();
        // assertEquals(?)
    }
    
    public function testDeleteUserRole(){
        $this->userModel->deleteUserRole();
        // assertEquals(?)
    }
    
    public function testDeleteUserAllRole(){
        $this->userModel->deleteUserAllRole();
        // assertEquals(?)
    }
    
    public function testDeleteRole(){
        $this->userModel->deleteRole();
        // assertEquals(?)
    }
    
    public function testDeleteRight(){
        $this->userModel->deleteRight();
        // assertEquals(?)
    }
    
    public function testDeleteRoleRight(){
        $this->userModel->deleteRoleRight();
        // assertEquals(?)
    }
    
    public function testDeleteRoleAllRight(){
        $this->userModel->deleteRoleAllRight();
        // assertEquals(?)
    }
    
    public function testDeleteAdvice(){
        $this->userModel->deleteAdvice();
        // assertEquals(?)
    }*/
}


    


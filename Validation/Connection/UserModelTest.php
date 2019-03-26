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
    
   
    public function testAuthentification2()
    {
        $res = $this->userModel->authentification("as","t");
        $this->assertEquals($res,false);
    }
    
    
    public function testGetUserRoles()
    {
        $res=$this->userModel->getUserRoles("1");

        $this->assertEquals($res[0]["id"],"3");
        
        
        
    }
    
    public function testGetRoles()
    {
        $res=$this->userModel->getRoles();
        //print_r ($res);
        $this->assertEquals($res[0]["id"],"3");
        
    }
    
    
    public function testGetUserRights(){
        $res=$this->userModel->getUserRights("1");
        $this->assertEquals($res[0]["id"],"5");
        $this->assertEquals($res[1]["id"],"3");
        $this->assertEquals($res[2]["id"],"6");
       
    }
    
    public function testGetRights()
    {
        $res=$this->userModel->getRights();
        $this->assertEquals($res[0]["id"],"7");
        
        // assertEquals(?)
    }
    
    public function testRoleRights()
    {
        $res=$this->userModel->getRoleRights("3");
        $this->assertEquals($res[0]["id"],"5");
        $this->assertEquals($res[1]["id"],"3");
        $this->assertEquals($res[2]["id"],"6");
        
        // assertEquals(?)
    }
    
    
    public function testGetRight()
    {
        $res=$this->userModel->getRight("1");
        //print_r ($res);
        $this->assertEquals($res["id"],"5");
        
    }
    
    public function testGetUser(){
        $res=$this->userModel->getUser("1");
        $this->assertEquals($res["id"],"1");
        
        // assertEquals(?)
    }
    
   /* public function testGetUsers(){
        $res=$this->userModel->getUsers();
        $this->assertEquals($res[0]["id"],"5");
    }*/
    
    public function testLoginIsFree(){
        $res=$this->userModel->loginIsFree("acools");
        $this->assertEquals($res,true);
    }
    
    public function testLoginIsFree2(){
        $res=$this->userModel->loginIsFree("DurandJ");
        $this->assertEquals($res,false);
    }
    
    
    public function testGetUsersFromRole(){
        $res=$this->userModel->getUsersFromRole("2");
        //print_r ($res);
        $this->assertEquals($res[0]["id"],"4");
        
        
    }
    
    public function testGetAdvice(){
        $res=$this->userModel->getAdvice("1");
        $this->assertEquals($res["user_id"],"2");
    }
    
    public function testGetAdvices(){
        $res=$this->userModel->getAdvices();
        $this->assertEquals($res[1]["id"],"1");
        //print_r ($res);
        // assertEquals(?)
    }
    
    
    public function testGetUserAdvices(){
        $res=$this->userModel->getUserAdvices("1");
        print_r ($res);
        // assertEquals(?)
    }
    
    public function testGetAdvisorAdvices(){
        $res=$this->userModel->getAdvisorAdvices("1");
        print_r ($res);
        // assertEquals(?)
    }
    
    //--------INSERTION----------
    
    public function testAddUser(){
        $res=$this->userModel->addUser();
        // assertEquals(?)
    }
    
    public function testAddUserRole(){
        $res=$this->userModel->addUserRole();
        // assertEquals(?)   
    }
    
    public function testAddRole(){
        $res=$this->userModel->addRole();
        // assertEquals(?)
    }
    
    public function testAddRight(){
        $res=$this->userModel->addRight();
        // assertEquals(?)
    }
    
    public function testAddRoleRight(){
        $res=$this->userModel->addRoleRight();
        // assertEquals(?)
    }
    
    public function testAddAdvice(){
        $res=$this->userModel->addAdvice();
        // assertEquals(?)
    }
    
    //-------UPDATE------
    
    public function testUpdateUser(){
        $res=$this->userModel->updateUser();
        // assertEquals(?)
    }
    
    public function testUpdateRole(){
        $res=$this->userModel->updateRole();
        // assertEquals(?)
    }
    
    public function testUpdateRight(){
        $res=$this->userModel->updateRight();
        // assertEquals(?)
    }
    
    public function testUpdateAdvice(){
        $res=$this->userModel->updateAdvice();
        // assertEquals(?)
    }
    
    //-------DELETE------
    
    public function testDeleteUser(){
        $res=$this->userModel->deleteUser();
        // assertEquals(?)
    }
    
    public function testDeleteUserRole(){
        $res=$this->userModel->deleteUserRole();
        // assertEquals(?)
    }
    
    public function testDeleteUserAllRole(){
        $res=$this->userModel->deleteUserAllRole();
        // assertEquals(?)
    }
    
    public function testDeleteRole(){
        $res=$this->userModel->deleteRole();
        // assertEquals(?)
    }
    
    public function testDeleteRight(){
        $res=$this->userModel->deleteRight();
        // assertEquals(?)
    }
    
    public function testDeleteRoleRight(){
        $res=$this->userModel->deleteRoleRight();
        // assertEquals(?)
    }
    
    public function testDeleteRoleAllRight(){
        $res=$this->userModel->deleteRoleAllRight();
        // assertEquals(?)
    }
    
    public function testDeleteAdvice(){
        $res=$this->userModel->deleteAdvice();
        // assertEquals(?)
    }*/
}


    


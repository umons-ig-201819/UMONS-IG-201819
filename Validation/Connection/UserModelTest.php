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
   
    
    public function testAddUser(){
        $res=$this->userModel->addUser();
        $this->assertEquals($res,false);
    }
    
    public function testAddUser2(){
       
        
        $user['lastname']="Cools";
        $user['firstname']="Aurélie";
        $user['birthdate']='1994-02-03';
        $user['email'] = 'cools.aurelie@hotmail.com';
        $user['phone'] =  '0498837255';
        $user['mobile']='0498837255';
        $user['gender']= 0;
        $user['login']= 'COA';
        $user['visible']=1;
        $user['advice']=1;
        $user['password']=sha1("test");
        $res=$this->userModel->addUser($user);
        $lastid = $this->userModel->getId();
        $this->assertEquals($res,[1, $lastid]);
       
    }
    
    public function testAddRole(){
        $res=$this->userModel->addRole("bigboss","le meilleur");
        $this->assertNotEquals($res,false);
        
    }
    
    public function testAddRight(){
        $res=$this->userModel->addRight("master","il peut faire ce qu'il veut");
        $this->assertNotEquals($res,false);
        
    }
   
    public function testAddRoleRight(){
        $lastidrole=$this->userModel->getIdRole();
        $lastiddroit=$this->userModel->getIdRight();
        $res=$this->userModel->addRoleRight($lastidrole,$lastiddroit);
        $this->assertEquals($res,true);
    }
    
    // vérifier le droit et role
    
    public function testAddUserRole()
    {
        $lastidrole=$this->userModel->getIdRole();
        $lastid = $this->userModel->getId();
        $res=$this->userModel->addUserRole($lastid,$lastidrole);
        $this->assertEquals($res,true);
    }
     // vérifier que COA a bien le bon rôle 
    
    public function testAddAdvice(){
        $lastid = $this->userModel->getId();
        $res=$this->userModel->addAdvice($lastid,"4","Dormez bien");
        $this->assertNotEquals($res,false);
    }
    
    
    
    public function testAuthentification()
    {
        $res = $this->userModel->authentification("COA","test");
        $lastid = $this->userModel->getId();
        $this->assertEquals($res["id"],$lastid);
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
    }
    
    public function testRoleRights()
    {
        $res=$this->userModel->getRoleRights("3");
        $this->assertEquals($res[0]["id"],"5");
        $this->assertEquals($res[1]["id"],"3");
        $this->assertEquals($res[2]["id"],"6");
    }
    
    
    public function testGetRight()
    {
        
        $res=$this->userModel->getRight("1");
        print_r ($res);
        $this->assertEquals($res[0]["id"],"2");
        $this->assertEquals($res[0]["id"],"4");
    }
    
    public function testGetUser(){
        $res=$this->userModel->getUser("1");
        $this->assertEquals($res["id"],"1");
     
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
        $this->assertEquals($res[0]["id"],"4");
        
        
    }
    /*
    public function testGetAdvice(){
        $res=$this->userModel->getAdvice("1");
        $this->assertEquals($res["user_id"],"2");
    }
    
    public function testGetAdvices(){
        $res=$this->userModel->getAdvices();
        $this->assertEquals($res[1]["id"],"1");
    }
    
    
    public function testGetUserAdvices(){
        $res=$this->userModel->getUserAdvices("2");
        $this->assertEquals($res[0]["id"],"1");
        
    }
    
    public function testGetAdvisorAdvices(){
        $res=$this->userModel->getAdvisorAdvices("1");
        $this->assertEquals($res[0]["id"],"3");
    }
    
    
    //-------UPDATE------
    
    public function testUpdateUser(){
        $res=$this->userModel->updateUser();
        $this->assertEquals($res,false);
        // assertEquals(?)
    }
    
    public function testUpdateRole(){
        $lastidrole=$this->userModel->getIdRole();
        $res=$this->userModel->updateRole($lastidrole,"Aurélie");
        $this->assertEquals($res,true);
        // assertEquals(?)
    }
    
    public function testUpdateRight(){
        $lastiddroit=$this->userModel->getIdRight();
        $res=$this->userModel->updateRight($lastiddroit,"Aurélie","vert");
        $this->assertEquals($res,true);
        // assertEquals(?)
    }
    /*
    public function testUpdateAdvice(){
        $res=$this->userModel->updateAdvice("8","4",NULL,"vive l'europe");
        $this->assertEquals($res,true);
        // assertEquals(?)
    }
    
    //-------DELETE------
    
    public function testDeleteUser(){
        $res=$this->userModel->deleteUser(NULL);
        $this->assertNotEquals($res,true);
        // assertEquals(?)
    }
    
    public function testDeleteUserRole(){
        $res=$this->userModel->deleteUserRole("1","5");
        $this->assertEquals($res,true);
    }
    
    public function testDeleteUserAllRole(){
        $res=$this->userModel->deleteUserAllRole("");
        $this->assertEquals($res,false);
    }
    
    public function testDeleteRole(){
        $res=$this->userModel->deleteRole("9");
        $this->assertEquals($res,true);
        // assertEquals(?)
    }
    
    public function testDeleteRight(){
        $res=$this->userModel->deleteRight("8");
        $this->assertEquals($res,true);
        // assertEquals(?)
    }
    
    public function testDeleteRoleRight(){
        $res=$this->userModel->deleteRoleRight("1","5");
        $this->assertEquals($res,true);
        // assertEquals(?)
    }
    
    public function testDeleteRoleAllRight(){
        $res=$this->userModel->deleteRoleAllRight("");
        $this->assertEquals($res,false);
        // assertEquals(?)
    }
    
    public function testDeleteAdvice(){
        $res=$this->userModel->deleteAdvice("2");
        $this->assertEquals($res,true);
        // assertEquals(?)
    }
    */
}


    

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
        $user['password']="test";
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
   
    public function testAddUserRole()
    {
        $lastidrole=$this->userModel->getIdRole();
        $lastid = $this->userModel->getId();
        $res=$this->userModel->addUserRole($lastid,$lastidrole);
        $this->assertEquals($res,true);
    }
     
    public function testAddAdvice(){
        $lastid = $this->userModel->getId();
        $res=$this->userModel->addAdvice($lastid,"4","Dormez bien");
        $this->assertNotEquals($res,false);
    }
   
    public function testAuthentification()
    {
        $lastid = $this->userModel->getId();
        $res=$this->userModel->authentification("COA","test");
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
        //SELECT LAST_INSERT_ID();
        $res=$this->userModel->getRight("1");
  
        $this->assertEquals($res["id"],"2");
        //$this->assertEquals($res[0]["id"],"4");
        
    }
    
    public function testGetUser(){
        $res=$this->userModel->getUser("1");
        $this->assertEquals($res["id"],"1");
     
    }
    
    public function testGetUsers()
    {
        $lastid = $this->userModel->getId();
        $res=$this->userModel->getUsers();
    
        $this->assertEquals($res[0]["id"],$lastid);
        $this->assertEquals($res[1]["id"],5);
        $this->assertEquals($res[2]["id"],1);
        $this->assertEquals($res[9]["id"],2);
        
     }
    
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
    
    public function testGetAdvice(){
        $lastiduser = $this->userModel->getId();
        $lastid = $this->userModel->getIdConseil();
        $res=$this->userModel->getAdvice($lastid);
        $this->assertEquals($res["user_id"],$lastiduser);
    }
    
    /*
    public function testGetAdvices(){
        $res=$this->userModel->getAdvices();
        $this->assertEquals($res[1]["id"],"1");
    }
    
    public function testGetUserAdvices(){
        $res=$this->userModel->getUserAdvices("2");
        $this->assertEquals($res[0]["id"],"1");
        
    }*/
    
    public function testGetAdvisorAdvices(){
        $res=$this->userModel->getAdvisorAdvices("1");
        $this->assertEquals($res[0]["id"],"3");
    }
    
    //-------UPDATE------
    
    public function testUpdateUser(){
        $res=$this->userModel->updateUser();
        $this->assertEquals($res,false);
    }
    
    public function testUpdateUser2(){
       
        $lastiduser = $this->userModel->getId();
        $user['id']=$lastiduser;
        $user['lastname']="";
        $user['firstname']="";
        $user['birthdate']='';
        $user['email'] = 'cools.aurelie2@hotmail.com';
        $user['phone'] =  '';
        $user['mobile']='';
        $user['gender']= '';
        $user['login']= '';
        $user['visible']=0;
        $user['advice']=0;
        $user['password']="";
      
        $res=$this->userModel->updateUser($user);
        print_r($res);
        $this->assertEquals($res,true);
    }
    
    public function testUpdateRole(){
        $lastidrole=$this->userModel->getIdRole();
        $res=$this->userModel->updateRole($lastidrole,"Nouveaurôle");
        $this->assertEquals($res,true);
    }
    
    public function testUpdateRight(){
        $lastiddroit=$this->userModel->getIdRight();
        $res=$this->userModel->updateRight($lastiddroit,"Aurélie","vert");
        $this->assertEquals($res,true);
    }
    
    public function testUpdateAdvice(){
        $lastid = $this->userModel->getId();
        $lastidconseil = $this->userModel->getIdConseil();
        $res=$this->userModel->updateAdvice($lastidconseil,$lastid,NULL,"vive l'europe");
        $this->assertEquals($res,true);
    } 
    
    //-------DELETE------ 
    
    public function testDeleteUserRole(){
        $lastid = $this->userModel->getId();
        $lastidrole = $this->userModel->getIdRole();
        $res=$this->userModel->deleteUserRole($lastid,$lastidrole);
        $this->assertEquals($res,true);
    }
    
    public function testDeleteUserAllRole(){
        $res=$this->userModel->deleteUserAllRole("");
        $this->assertEquals($res,false);
    }
  
    public function testDeleteUserAllRole2(){
        $lastid = $this->userModel->getId();
        $res=$this->userModel->deleteUserAllRole($lastid);
        $this->assertEquals($res,true);
    }
    
    public function testDeleteRoleRight()
    {
        $lastid = $this->userModel->getId();
        $lastidright = $this->userModel->getIdRight();
        $res=$this->userModel->deleteRoleRight($lastid,$lastidright);
        $this->assertEquals($res,true);
    }
    
    public function testDeleteRight(){
        $lastidright = $this->userModel->getIdRight();
        $res=$this->userModel->deleteRight($lastidright);
        $this->assertEquals($res,true);
    }
     
    public function testDeleteRoleAllRight()
    {
        $res=$this->userModel->deleteRoleAllRight("");
        $this->assertEquals($res,false);
    }
    
    public function testDeleteRole(){
        $lastidrole = $this->userModel->getIdRole();
        $res=$this->userModel->deleteRole($lastidrole);
        $this->assertEquals($res,true);
    }
   
    public function testDeleteAdvice()
    {
        $lastidconseil = $this->userModel->getIdConseil();
        $res=$this->userModel->deleteAdvice($lastidconseil);
        $this->assertEquals($res,true);
    }
    
    public function testDeleteUser()
    {
        $res=$this->userModel->deleteUser(NULL);
        $this->assertNotEquals($res,true);
    }
    
    public function testDeleteUser2()
    {
        $lastid = $this->userModel->getId();
        $res=$this->userModel->deleteUser($lastid);
        $this->assertEquals($res,true);
    }
    
}


    

<?php
// use PHPUnit\Framework\TestCase;
// use PHPUnit\Framework\TestCase;
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
    
    public function testGetUserRoles()
    {
        
     $a = new UserModel();
     $a->getUserRoles(1);
     // assertEquals(?)   
     
    }
    
    public function testGetRoles()
    {
        $a = new UserModel();
        $a->getRoles();
        // assertEquals(?)
        
    }
    
    public function testGetUserRights()
    {
        
        $a = new UserModel();
        $a->getUserRights(1);
        // assertEquals(?)
        
    }
    
    public function testGetRights()
    {
        $a = new UserModel();
        $a->getRights();
        // assertEquals(?)
        
    }
    
    public function testRoleRights()
    {
        $a = new UserModel();
        $a->getRoleRights();
        // assertEquals(?)
        
    }
    
    
    public function testGetRight()
    {
        $a = new UserModel();
        $a->getRight();
        // assertEquals(?)
        
    }
    
    public function testGetUser()
    {
        $a = new UserModel();
        $a->getUser();
        // assertEquals(?)
        
    }
    
    public function testGetUsers()
    {
        $a = new UserModel();
        $a->getUsers();
        // assertEquals(?)
        
    }
    
    public function testLoginIsFree()
    {
        $a = new UserModel();
        $a->loginIsFree("acools");
        // assertEquals(?)
        
    }
    
    
    public function testGetUsersFromRole()
    {
        $a = new UserModel();
        $a->getUsersFromRole();
        // assertEquals(?)
        
    }
    
    public function testGetAdvice()
    {
        $a = new UserModel();
        $a->getAdvice();
        // assertEquals(?)
        
    }
    
    public function testGetAdvices()
    {
        $a = new UserModel();
        $a->getAdvices();
        // assertEquals(?)
        
    }
    
    public function testGetUserAdvices()
    {
        $a = new UserModel();
        $a->getUserAdvices();
        // assertEquals(?)
        
    }
    
    public function testGetAdvisorAdvices()
    {
        $a = new UserModel();
        $a->getAdvisorAdvices();
        // assertEquals(?)
        
    }
    
    //--------INSERTION----------
    
    public function testAddUser()
    {
        $a = new UserModel();
        $a->addUser();
        // assertEquals(?)
        
    }
    
    public function testAddUserRole()
    {
        $a = new UserModel();
        $a->addUserRole();
        // assertEquals(?)   
    }
    
    public function testAddRole()
    {
        $a = new UserModel();
        $a->addRole();
        // assertEquals(?)
        
    }
    
    public function testAddRight()
    {
        $a = new UserModel();
        $a->addRight();
        // assertEquals(?)
    }
    
    public function testAddRoleRight()
    {
        $a = new UserModel();
        $a->addRoleRight();
        // assertEquals(?)
    }
    
    public function testAddAdvice()
    {
        $a = new UserModel();
        $a->addAdvice();
        // assertEquals(?)
    }
    
    //-------UPDATE------
    
    public function testUpdateUser()
    {
        $a = new UserModel();
        $a->updateUser();
        // assertEquals(?)
    }
    
    public function testUpdateRole()
    {
        $a = new UserModel();
        $a->updateRole();
        // assertEquals(?)
    }
    
    public function testUpdateRight()
    {
        $a = new UserModel();
        $a->updateRight();
        // assertEquals(?)
    }
    
    public function testUpdateAdvice()
    {
        $a = new UserModel();
        $a->updateAdvice();
        // assertEquals(?)
    }
    
    //-------DELETE------
    
    public function testDeleteUser()
    {
        $a = new UserModel();
        $a->deleteUser();
        // assertEquals(?)
    }
    
    public function testDeleteUserRole()
    {
        $a = new UserModel();
        $a->deleteUserRole();
        // assertEquals(?)
    }
    
    public function testDeleteUserAllRole()
    {
        $a = new UserModel();
        $a->deleteUserAllRole();
        // assertEquals(?)
    }
    
    public function testDeleteRole()
    {
        $a = new UserModel();
        $a->deleteRole();
        // assertEquals(?)
    }
    
    public function testDeleteRight()
    {
        $a = new UserModel();
        $a->deleteRight();
        // assertEquals(?)
    }
    
    public function testDeleteRoleRight()
    {
        $a = new UserModel();
        $a->deleteRoleRight();
        // assertEquals(?)
    }
    
    public function testDeleteRoleAllRight()
    {
        $a = new UserModel();
        $a->deleteRoleAllRight();
        // assertEquals(?)
    }
    
    public function testDeleteAdvice()
    {
        $a = new UserModel();
        $a->deleteAdvice();
        // assertEquals(?)
    }
    
    
}


    


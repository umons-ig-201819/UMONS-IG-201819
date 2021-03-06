<?php
use PHPUnit\Framework\TestCase;
require_once(__DIR__.'/../configuration.php');
load_model('ProjectModel');

class ProjectModelTest extends TestCase{
    public function __construct(){
        parent::__construct();
        $this->projectModel = null;
    }
    
    protected function setUp(){
        $this->projectModel = new ProjectModel();
    }
    
    protected function tearDown(){
        $this->projectModel = null;
    }
    
    // -------------------------------------------------------------
    // -------------------- SELECT ---------------------------------
    // -------------------------------------------------------------
    /**
    * testGetProject() this method test the method getProject()
    */
    public function testGetProject()
    {
        $projID=$this->projectModel->getProjectID();
        $res=$this->projectModel->getProject($projID);
        $this->assertNotEquals($res,false);
    }
    /**
    * testListProjects() this method tests the method listProjects()
    */
    public function testListProjects()
    {
        $filter['id']="1";
        $filter['project_name']="test50";
        $filter['project_description']="test51";
        $filter['date_start']='2019-01-01';
        $filter['date_end']='2030-01-01';
        $filter['owner_lastname']="Durand";
        $filter['owner_firstname']="Jean";
        $and=false;
        $res=$this->projectModel->listProjects($filter,$and);
  //      $this->assertTrue(!is_null($res),true);
//        $this->assertTrue(count($res)>0,true);
        $this->assertNotEquals($res[0]['id'],false);
    }
    /**
    * testGetProjects() this method tests the method getProjects()
    */
    public function testGetProjects()
    {
        $filter['id']="1";
        $filter['project_name']="test50";
        $filter['project_description']="test51";
        $filter['date_start']='2019-01-01';
        $filter['date_end']='2030-01-01';
        $filter['owner_lastname']="Durand";
        $filter['owner_firstname']="Jean";
        $and=false;
        $res=$this->projectModel->getProjects($filter,$and);
        $this->assertTrue(!is_null($res),true);
//        $this->assertTrue(count($res)>0,true);
        $this->assertEquals($res[0],false);
    }
    /**
    * testGetProjectMembers() this method tests the method getProjectMembers()
    */
    public function testGetProjectMembers()
    {
        try{
            $filter['member_lastname']="Durand";
            $filter['member_firstname']="Jean";
            $filter['member_role']="propriétaire du terrain";
            $filter['member_gestion']=0;
            $filter['owner_lastname']="vanderelst";
            $filter['owner_firstname']="Nadine";
            $and=false;
            $res=$this->projectModel->getProjectMembers(1,$filter,$and);
            $this->assertNotEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }
     /**   
     * testGetUserProjects() this method tests the method getUserProjects()
     */
    
    /*public function testGetUserProjects()
    {
        $filter['project_id']=1;
        $filter['project_name']="détection des chaleurs par podomètre";
        $filter['project_date_start']='2018-12-02';
        $filter['project_date_end']='2020-01-01';
        $filter['project_role']="aide";
        $filter['project_gestion']=1;
        $filter['project_owner']=2;
        $and=false;
        $res=$this->projectModel->getUserProjects(1, $filter, $and);
        $this->assertNotEquals($res,false);
    }*/
    
    // -------------------------------------------------------------
    // -------------------- INSERT ---------------------------------
    // -------------------------------------------------------------
    /**
    * testAddProject() this method tests the method addProject()
    */
    public function testAddProject()
    {
        $project['pname']="test36";
        $project['pdate_start']='2019-01-01';
        $project['pdate_end']='2030-01-01';
        $project['pdescription']='test31';
        $userId=$this->projectModel->getUserID();
        $res=$this->projectModel->addProject($userId,$project);
        $this->assertNotEquals('$res',false);
    }
    
    /**
    * testAddProject1() this method tests the method addProject1()
    */
    public function testAddProject1()
    {
        $userId=$this->projectModel->getUserID();
        $project['pname']="test32";
        $project['pdate_start']='test33';
        $project['pdate_end']='2030-01-01';
        $res=$this->projectModel->addProject($userId,$project);
        $this->assertNotEquals('$res',false);
    }
    
    /**
    * testAddUserProject() this method tests the method addUserProject()
    */
    public function testAddUserProject()
    {
        $userProject['role_project']="test40";
        $userProject['gestion']=1;
        $login=$this->projectModel->getLogin();
        $projID=$this->projectModel->getProjectID();
        $res = $this->projectModel->addUserProject($login,$projID,$userProject);
        $this->assertEquals($res,true);
    }
    
    /**
    * testAddUserProject1() this method tests the method addUserProject1()
    */
     public function testAddUserProject1()
    {
        $userProject['gestion']=1;
        $login=$this->projectModel->getLogin();
        $projID=$this->projectModel->getProjectID();
        $res=$this->projectModel->addUserProject($login,$projID-1,$userProject);
        $this->assertEquals($res,true);
    }
    
    // -------------------------------------------------------------
    // -------------------- UPDATE ---------------------------------
    // -------------------------------------------------------------
    /**
     * testUpdateProject() this method tests the method updateProject()
     */
    public function testUpdateProject()
    {
        $filter['id']="1";
        $filter['project_name']="test";
        $filter['project_description']="test";
        $filter['date_start']='2019-01-01';
        $filter['date_end']='2030-01-01';
        $filter['owner_lastname']="test";
        $filter['owner_firstname']="test";
        $and=false;
        $res=$this->projectModel->getProjects($filter,$and);
        $project['id']=$res[0]["id"];
        $project['pname']="test10";
        $project['pdescription']="test11";
        $project['pdate_start']='2018-12-02';
        $project['pdate_end']='2020-01-01';
        $userId= $this->projectModel->getUserID();
        $resu=$this->projectModel->updateProject($res[0]["id"], $userId, $project);
        $this->assertEquals($resu,true);
    }
    /**
     * testUpdateUserProject() this method tests the method updateUserProject()
     */
    public function testUpdateUserProject()
    {
        $filter['id']="1";
        $filter['project_name']="test";
        $filter['project_description']="test";
        $filter['date_start']='2019-01-01';
        $filter['date_end']='2030-01-01';
        $filter['owner_lastname']="test";
        $filter['owner_firstname']="test";
        $and=false;
        $res=$this->projectModel->getProjects($filter,$and);
        $this->assertTrue(!is_null($res),true);
        $this->assertTrue(count($res)>0,true);
        $userProject['role']="aide";
        $userProject['manage']=1;
        $resu=$this->projectModel->updateUserProject(1, $res[0]["id"], $userProject);
        $this->assertEquals($resu,true);
    }
    
    // -------------------------------------------------------------
    // -------------------- DELETE ---------------------------------
    // -------------------------------------------------------------
    /**
    * testDeleteProject() this method tests the method deleteProject()
    */
    public function deleteProject()
    {
        $filter['id']="1";
        $filter['project_name']="test";
        $filter['project_description']="test";
        $filter['date_start']='2019-01-01';
        $filter['date_end']='2030-01-01';
        $filter['owner_lastname']="test";
        $filter['owner_firstname']="test";
        $and=false;
        $res=$this->projectModel->getProjects($filter,$and);
        $this->assertTrue(!is_null($res),true);
        $this->assertTrue(count($res)>0,true);
        $resu=$this->projectModel->deleteProject($res[0]["id"]);
        $this->assertEquals($resu,true);
    }
    /**
     * testDeleteUserProject() this method tests the method deleteUserProject()
     */
    public function testDeleteUserProject()
    {
        $userId=$this->projectModel->getUserID();
        $projId=$this->projectModel->getProjectID();
        $res = $this->projectModel->deleteUserProject($userId,$projId);
        $this->assertEquals($res,true);
    }
    /**
     * testDeleteAllProjectsUser() this method tests the method deleteAllProjectsUser()
     */
    /*public function testDeleteAllProjectsUser()
    {
        $userId=$this->projectModel->getUserID();
        $res = $this->projectModel->deleteAllProjectsUser($userId);
        $this->assertEquals($res,true);
    }*/
    /**
     * testDeleteAllUsersProject() this method tests the method deleteAllUsersProject()
     */
    public function testDeleteAllUsersProject()
    {
        try{
            $filter['id']="1";
            $filter['project_name']="test";
            $filter['project_description']="test";
            $filter['date_start']='2019-01-01';
            $filter['date_end']='2030-01-01';
            $filter['owner_lastname']="test";
            $filter['owner_firstname']="test";
            $and=false;
            $res=$this->projectModel->getProjects($filter,$and);
            $this->assertTrue(!is_null($res),true);
            $this->assertTrue(count($res)>0,true);
            $resu=$this->projectModel->deleteAllUsersProject($res[0]["id"]);
            $this->assertEquals($resu,true);
        }catch(Exception $e) { $this->assertTrue(false); }
    }
    
}

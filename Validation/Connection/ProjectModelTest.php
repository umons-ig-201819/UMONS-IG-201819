<?php
use PHPUnit\Framework\TestCase;
require_once(__DIR__.'/../configuration.php');
load_model('ProjectModel');
class ProjectModelTest extends TestCase{
public function __construct()
    {
        parent::__construct();
        $projectModel = null;
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
        $this->assertNotEquals($res["id"],NULL);
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
        $this->assertEquals($res[0]["id"],NULL);
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
        $this->assertEquals($res[0]["id"],NULL);
    }
    /**
    * testGetProjectMembers() this method tests the method getProjectMembers()
    */
    public function testGetProjectMembers()
    {
        $filter['member_lastname']="Durand";
        $filter['member_firstname']="Jean";
        $filter['member_role']="propriétaire du terrain";
        $filter['member_gestion']=0;
        $filter['owner_lastname']="vanderelst";
        $filter['owner_firstname']="Nadine";
        $and=false;
        $res=$this->projectModel->getProjectMembers(1,$filter,$and);
        $this->assertNotEquals($res[0]["member_lastname"],NULL);
    }
     /**   
     testGetUserProjects() this method tests the method getUserProjects()
     */
    /**
    public function testGetUserProjects()
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
        $this->assertNotEquals($res[0]["id"],NULL);
    }
    */
    // -------------------------------------------------------------
    // -------------------- INSERT ---------------------------------
    // -------------------------------------------------------------
    /**
    * testAddProject() this method tests the method addProject()
    */
    public function testAddProject()
    {
        $project['pName']="test30";
        $project['pDate_start']='test31';
        $project['pDate_end']='2030-01-01';
        $project['pDescription']='2019-01-01';
        $userId=$this->projectModel->getUserID();
        $res=$this->projectModel->addProject($userId,$project);
        $this->assertNotEquals($res[0],NULL);
    }
    
    /**
    * testAddProject1() this method tests the method addProject1()
    */
    public function testAddProject1()
    {
        $userId=$this->projectModel->getUserID();
        $project['pName']="test32";
        $project['pDate_start']='test33';
        $project['pDate_end']='2030-01-01';
        $res=$this->projectModel->addProject($userId,$project);
        $this->assertNotEquals($res,false);
    }
    
    /**
    * testAddUserProject() this method tests the method addUserProject()
    */
    public function testAddUserProject()
    {
        $userProject['role_p']="test40";
        $userProject['gestion']=1;
        $userID=$this->projectModel->getUserID();
        $projID=$this->projectModel->getProjectID();
        $res = $this->projectModel->addUserProject($userID,$projID,$userProject);
        $this->assertEquals($res,true);
    }
    
    /**
    * testAddUserProject1() this method tests the method addUserProject1()
    */
     public function testAddUserProject1()
    {
        $userProject['gestion']=1;
        $userID=$this->projectModel->getUserID();
        $projID=$this->projectModel->getProjectID();
        $res=$this->projectModel->addUserProject($userID,$projID-1,$userProject);
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
        $project['id']=1;
        $project['pname']="détection des chaleurs par podomètre";
        $project['pdescription']="Etude de corrélation entre l'activité physique des ";
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
    public function testDeleteAllProjectsUser()
    {
        $userId=$this->projectModel->getUserID();
        $res = $this->projectModel->deleteAllProjectsUser($userId);
        $this->assertEquals($res,true);
    }
    /**
     * testDeleteAllUsersProject() this method tests the method deleteAllUsersProject()
     */
    public function testDeleteAllUsersProject()
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
        $resu=$this->projectModel->deleteAllUsersProject($res[0]["id"]);
        $this->assertEquals($resu,true);
    }
    
}

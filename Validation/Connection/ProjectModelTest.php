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
    // -------------------- INSERT ---------------------------------
    // -------------------------------------------------------------
    public function testAddProject()
    {
        $userId=4;
        $project['pName']="test30";
        $project['pDate_start']='test31';
        $project['pDate_end']='2030-01-01';
        $project['pDescription']='2019-01-01';
        $res=$this->projectModel->addProject($userId,$project);
        $this->assertNotEquals($res[0],NULL);
    }
    
    public function testAddProject1()
    {
        $userId=4;
        $project['pName']="test32";
        $project['pDate_start']='test33';
        $project['pDate_end']='2030-01-01';
        $res=$this->projectModel->addProject($userId,$project);
        $this->assertNotEquals($res,false);
    }
    
    public function testAddUserProject()
    {
        $userProject['role_p']="test40";
        $userProject['gestion']=1;
        $res=$this->projectModel->addUserProject(3,2,$userProject);
        $this->assertEquals($res,true);
    }
    
     public function testAddUserProject1()
    {
        $userProject['gestion']=1;
        $res=$this->projectModel->addUserProject(5,2,$userProject);
        $this->assertEquals($res,true);
    }
    // -------------------------------------------------------------
    // -------------------- SELECT ---------------------------------
    // -------------------------------------------------------------
    /**
    * getProject() this method returns a project based on its id
    */
    public function testGetProject()
    {
        $res=$this->projectModel->getProject(1);
        $this->assertNotEquals($res["id"],NULL);
    }
    /**
    * getProjects() this method returns a project based on its id
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
    * getProjectMembers() this method returns the members of a project based on its id
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
    
    // -------------------------------------------------------------
    // -------------------- DELETE ---------------------------------
    // -------------------------------------------------------------
    * deleteProject() delete a project based on its id
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
     * deleteUserProject() remove a project for a specific user
     */
    public function testDeleteUserProject()
    {
        $and=false;
        $res=$this->projectModel->deleteUserProject(3,2,$and);
        $this->assertEquals($res,true);
    }
    /**
     * deleteAllProjectsUser() remove all projects for a specific user
     */
    public function testDeleteAllProjectsUser()
    {
        
        $res=$this->projectModel->deleteAllProjectsUser(3);
        $this->assertEquals($res,true);
    }
    /**
     * deleteAllUsersProject() remove all users for a specific project
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
    // -------------------------------------------------------------
    // -------------------- UPDATE ---------------------------------
    // -------------------------------------------------------------
    /**
     * updateProject() is a method for updating a project
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
        $resu=$this->projectModel->updateProject($res[0]["id"], 2, $project);
        $this->assertEquals($resu,true);
    }
    /**
     * updateUserProject() is a method for updating a project
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
}

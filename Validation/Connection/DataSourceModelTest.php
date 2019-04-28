<?php
use PHPUnit\Framework\TestCase;
require_once(__DIR__.'/../configuration.php');
load_model('DataSourceModel');
class DataSourceModelTest extends TestCase{
    private $dataSourceModel;
    public function __construct(){
        parent::__construct();
        $dataSourceModel = null;
    }

    protected function setUp(){
        $this->dataSourceModel = new DataSourceModel();
    }

    protected function tearDown(){
        $this->dataSourceModel = null;
    }

    //-------------------------------------------------------------
    //-------------------- INSERT ---------------------------------
    //-------------------------------------------------------------

    public function testAddDataSourceApp(){
        $dataSource['name']="test";
        $dataSource['visible']=2;
        $resu=$this->dataSourceModel->getUserID();
        $res =$this->dataSourceModel->addDataSourceApp($resu,$dataSource);
        $this->assertNotEquals($res,false);
    }

    public function testAddDataSourceApp1(){
        $dataSource['name']="test";
        $dataSource['url']='test40';
        $dataSource['appli']=0;
        $dataSource['config']=NULL;
        $dataSource['visible']=2;
        $resu=$this->dataSourceModel->getUserID();
        $res =$this->dataSourceModel->addDataSourceApp($resu,$dataSource);
        $this->assertNotEquals($res,false);
    }

    public function testAddDataSourceProject(){
        $resu=this->dataSourceModel->getDataSourceID();
        $resul=$this->dataSourceModel->getProjetID();
        $res = $this->dataSourceModel->addDataSourceProject($resu,$resul);
        $this->assertNotEquals($res,false);
    }

    public function testAddDataSourceUser(){
        $dataSourceUser['read']=0;
        $dataSourceUser['modify']=0;
        $dataSourceUser['remove']=0;
        $dataSourceUser['askAccess']=1;
        $resu =$this->dataSourceModel->getDataSourceID();
        $resul=$this->dataSourceModel->getUserID();
        $res = $this->dataSourceModel->addDataSourceUser($resu,$resul,$dataSourceUser);
        $this->assertEquals($res,true);
    }
    /**
    public function testAddAdvisor(){
        $res=$this->dataSourceModel->addAdvisor(1,1,$dataSourceUser);
        $this->assertEquals($res,true);
    }
    
    public function testAskAccess(){
        $res=$this->dataSourceModel->askAccess(1,1);
        $this->assertEquals($res,true);
    }
*/
    //-------------------------------------------------------------
   	//-------------------- DELETE ---------------------------------
   	//-------------------------------------------------------------

    public function testDeleteDataSource(){
        $and = false;
        $filter['file_name']="test";
        $filter['file_url']="test40";
        $filter['application']=0;
        $filter['visible']=2;
        $filter['add_date']='1980-01-01 00:00:00';
        $res=$this->dataSourceModel->getDataSources($filter,$and);
        $resu=$this->dataSourceModel->deleteDataSource($res[0]["id"]);
        $this->assertEquals($resu,true);
    }

    public function testDeleteUserDataSource()
    {
        $and = false;
        $filter['file_name']="test";
        $filter['file_url']="test40";
        $filter['application']=1;
        $filter['visible']=1;
        $filter['add_date']='1980-01-01 00:00:00';
        $res=$this->dataSourceModel->getDataSources($filter,$and);
        $resul=$this->dataSourceModel->getUserID();
        $resu=$this->dataSourceModel->deleteUserDataSource($resul,$res[0]["id"]);
        $this->assertEquals($resu,true);
    }

    public function testDeleteDataSourceProject()
    {
        $and = false;
        $filter['file_name']="test";
        $filter['file_url']="test40";
        $filter['application']=0;
        $filter['visible']=2;
        $filter['add_date']='1980-01-01 00:00:00';
        $res=$this->dataSourceModel->getDataSources($filter,$and);
        $resul=$this->dataSourceModel->getProjetID();
        $resu=$this->dataSourceModel->deleteDataSourceProject($res[0]["id"],$resulID);
        $this->assertEquals($resu,true);
    }

    public function testDeleteAllDataSourcesUser()
    {
        $resu=$this->dataSourceModel->getUserID();
        $res=$this->dataSourceModel->deleteAllDataSourcesUser($resu);
        $this->assertEquals($res,true);
    }

    public function testDeleteAllUsersDataSource(){
        $and = false;
        $filter['file_name']="test";
        $filter['file_url']="test40";
        $filter['application']=0;
        $filter['visible']=2;
        $filter['add_date']='1980-01-01 00:00:00';
        $res=$this->dataSourceModel->getDataSources($filter,$and);
        $resu=$this->dataSourceModel->deleteAllUsersDataSource($res[0]["id"]);
        $this->assertEquals($resu,true);
    }

    public function testDeleteAllProjectsDataSource(){
        $and = false;
        $filter['file_name']="test";
        $filter['file_url']="test40";
        $filter['application']=0;
        $filter['visible']=2;
        $filter['add_date']='1980-01-01 00:00:00';
        $res=$this->dataSourceModel->getDataSources($filter,$and);
        $resu=$this->dataSourceModel->deleteAllProjectsDataSource($res[0]["id"]);
        $this->assertEquals($resu,true);
    }

    public function testDeleteAllDataSourcesProject(){
        $resu=$this->dataSourceModel->getProjectID();
        $res=$this->dataSourceModel->deleteAllDataSourcesProject($resu);
        $this->assertEquals($res,true);
    }
/**
    public function testrevokeAccess(){
        $res=$this->dataSourceModel->revokeAccess(1,1);
        $this->assertEquals($res,true);
    }
   */ 
    //-------------------------------------------------------------
   	//-------------------- UPDATE ---------------------------------
   	//-------------------------------------------------------------

    public function testUpdateDataSource(){
        $and = false;
        $filter['file_name']="test";
        $filter['file_url']="test40";
        $filter['application']=0;
        $filter['visible']=2;
        $filter['add_date']='1980-01-01 00:00:00';
        $res=$this->dataSourceModel->getDataSources($filter,$and);
        $dataSource['name']="testDataSourceModel";
        $dataSource['url']="testDataSource";
        $dataSource['appli']=1;
        $dataSource['config']="";
        $dataSource['visible']="";
        $resul=$this->dataSourceModel->getUserID();
        $resu=$this->dataSourceModel->updateDataSource($res[0]["id"],$resul,$dataSource);
        $this->assertEquals($resu,true);
    }

    public function testUpdateDataSource1(){
        $and = false;
        $filter['file_name']="test";
        $filter['file_url']="test40";
        $filter['application']=0;
        $filter['visible']=2;
        $filter['add_date']='1980-01-01 00:00:00';
        $res=$this->dataSourceModel->getDataSources($filter,$and);
        $dataSource['name']="testDataSourceModel";
        $dataSource['url']="testDataSource";
        $dataSource['appli']=1;
        $dataSource['config']="test";
        $dataSource['visible']="test";
        $resul=$this->dataSourceModel->getUserID();
        $resu=$this->dataSourceModel->updateDataSource($res[0]["id"],$resul,$dataSource);
        $this->assertEquals($resu,true);
    }
    
    public function testUpdateDataSourceUser(){
        $and = false;
        $filter['file_name']="test";
        $filter['file_url']="test40";
        $filter['application']=0;
        $filter['visible']=2;
        $filter['add_date']='1980-01-01 00:00:00';
        $res=$this->dataSourceModel->getDataSources($filter,$and);
        $dataSourceUser['read']="testDataSourceUser";
        $dataSourceUser['modify']="testDataSource";
        $dataSourceUser['remove']="testDataSource";
        $dataSourceUser['askAccess']=1;
        $resul=$this->dataSourceModel->getUserID();
        $resu=$this->dataSourceModel->updateDataSourceUser($res[0]["id"],$resul,$dataSourceUser);
        $this->assertEquals($resu,true);
    }

    public function testUpdateDataSourceProject(){
        $askAccess="1";
        $resu=$this->dataSourceModel->getDataSourceID();
        $resul=$this->dataSourceModel->getProjectID();
        $res=$this->dataSourceModel->updateDataSourceUser($resu,$resul,$askAccess);
        $this->assertEquals($res,true);
    }
/**
    public function testAcceptAccess(){
        $res=$this->dataSourceModel->acceptAccess(1,1);
        $this->assertEquals($res,true);
    }
    
    public function testRefuseAccess(){
        $res=$this->dataSourceModel->refuseAccess(1,1);
        $this->assertEquals($res,true);
    }
   */ 
    //-------------------------------------------------------------
   	//-------------------- SELECT ---------------------------------
   	//-------------------------------------------------------------

    /**
     * testGetVisibility() this method test the output of GetVisibility method: a data source based on its id
    */
    public function testGetVisibility()
    {
        $dataSourceID = $this->dataSourceModel->getDataSourceID();
        $res=$this->dataSourceModel->getVisibility($dataSourceID);
        $this->assertNotEquals($res,NULL);
    }
    
    public function testGetDataSource(){
        $resu=$this->dataSourceModel->getDataSourceID();
        $res =$this->dataSourceModel->getDataSource($resu);
        $this->assertNotEquals($res["id"],NULL);
    }

    public function testGetOwnedDataSources(){
        $resu=$this->dataSourceModel->getUserID();
        $res=$this->dataSourceModel->getOwnedDataSources($resu);
        $this->assertEquals($res["id"],NULL);
    }
/**
    public function testSearchDataSources(){
        $and = false;
        $filter['owner']="test";
        $filter['name']="test40";
        $res=$this->dataSourceModel->searchDataSources($filter,$and);
        $this->assertNotEquals($res[0]["id"],NULL);
    }
    */
    public function testGetDataSources(){
        $and = false;
        $filter['file_name']="test";
        $filter['file_url']="test40";
        $filter['application']=0;
        $filter['visible']=2;
        $filter['add_date']='1980-01-01 00:00:00';
        $res=$this->dataSourceModel->getDataSources($filter,$and);
        $this->assertNotEquals($res[0]["id"],NULL);
    }

    public function testGetDataSources1(){
        $and = false;
        $res=$this->dataSourceModel->getDataSources(" ",$and);
        $this->assertNotEquals($res[0]["id"],NULL);
    }
    
    public function testGetPersonalDataSources(){
        $resu=$this->dataSourceModel->getUserID();
        $res=$this->dataSourceModel->getPersonalDataSources($resu);
        $this->assertNotEquals($res[0]["id"],NULL);
    }
    
    public function testGetAccessDataSources(){
        $resu=$this->dataSourceModel->getAdvisorID();
        $res=$this->dataSourceModel->getAccessDataSources($resu);
        $this->assertNotEquals($res[0]["id"],NULL);
    }

    public function testGetAdvisors(){
        $resu=$this->dataSourceModel->getAdvisorID();
        $res=$this->dataSourceModel->getAdvisors($resu);
        $this->assertNotEquals($res[0]["id"],NULL);
    }
    
    public function testGetAccessibleDataSources(){
        $resu=$this->dataSourceModel->getAdvisorID();
        $res=$this->dataSourceModel->getAccessibleDataSources($resu);
        $this->assertNotEquals($res[0]["id"],NULL);
    }

    public function testGetUserDataSources(){
        $filter['file_name']="";
        $filter['f_read']="";
        $filter['f_modify']="";
        $filter['f_remove']="";
        $filter['access_state']=1;
        $filter['ask_date']="";
        $filter['file_url']="";
        $filter['application']=1;
        $filter['config']="";
        $filter['visible']="";
        $filter['add_date']="";
        $and=false;
        $res=$this->dataSourceModel->getUserDataSources(1,$filter,$and);
        $this->assertNotEquals($res[0]["id_file"],NULL);
    }
    
    public function testGetUserDataSources1(){
        $and=false;
        $resu=$this->dataSourceModel->getUserID();
        $res=$this->dataSourceModel->getUserDataSources($resu,$and);
        $this->assertNotEquals($res[0]["id_file"],NULL);
    }

    public function testGetDataSourceUsers(){
        $filter['user_name'] = "test2";
        $filter['user_firstName']="test3";
        $filter['access_state']=1;
        $filter['ask_date']='1980-01-01 00:00:00';
        $and=false;
        $resu=$this->dataSourceModel->getDataSourceID();
        $res=$this->dataSourceModel->getDataSourceUsers($resu,$filter,$and);
        $this->assertNotEquals($res[0]["id"],NULL);
    }
    
    public function testGetDataSourceUsers1(){
        $and = false;
        $resu=$this->dataSourceModel->getDataSourceID();
        $res=$this->dataSourceModel->getDataSourceUsers($resu,$and);
        $this->assertNotEquals($res[0]["id"],NULL);
    }

    public function testGetProjectDataSources(){
        $filter['file_name']="test10";
        $filter['file_url']="test11";
        $filter['application']="test12";
        $filter['config']="test13";
        $filter['visible']=1;
        $filter['add_date']='test14';
        $filter['access_state']=1;
        $filter['ask_date']='test15';
        $and=false;
        $resu=$this->dataSourceModel->getProjectID();
        $res=$this->dataSourceModel->getProjectDataSources($resu,$filter,$and);
        $this->assertNotEquals($res[0]["id_fichier"],NULL);
    }
    
    public function testGetProjectDataSources1(){
        $and = false;
        $resu=$this->dataSourceModel->getProjectID();
        $res=$this->dataSourceModel->getProjectDataSources($resu,$and);
        $this->assertNotEquals($res[0]["id_fichier"],NULL);
    }

    public function testGetDataSourceProjects(){
        $filter['project_name'] = "test20";
        $filter['ask_access'] = 1;
        $filter['ask_date'] = 'test21';
        $and=false;
        $resu=$this->dataSourceModel->getDataSourceID();
        $res=$this->dataSourceModel->getDataSourceProjects($resu,$filter,$and);
        $this->assertEquals($res[0]["id_fichier"],NULL);
    }
    
    public function testGetDataSourceProjects1(){
        $and=false;
        $resu=$this->dataSourceModel->getDataSourceID();
        $res=$this->dataSourceModel->getDataSourceProjects($resu,$and);
        $this->assertEquals($res[0]["id_fichier"],NULL);
    }
}

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
   	//-------------------- SELECT ---------------------------------
   	//-------------------------------------------------------------

    /**
     * testGetVisibility() this method test the output of GetVisibility method: a data source based on its id
    */
    public function testGetVisibility()
    {
        $dataSource = $this->dataSourceModel->getDataSourceID();
        $res=$this->dataSourceModel->getVisibility($dataSource);
        $this->assertNotEquals($res,false);
    }
    
    /**
    * testGetDataSource() this method tests the method getDataSource()
    */
    public function testGetDataSource(){
        $dataSourcID=$this->dataSourceModel->getDataSourceID();
        $res =$this->dataSourceModel->getDataSource($dataSourcID);
        $this->assertNotEquals($res,false);
    }

    /**
    * testGetOwnedDataSources() this method tests the method getOwnedDataSources()
    */
    public function testGetOwnedDataSources(){
        $dataSourceID=$this->dataSourceModel->getUserID();
        $res=$this->dataSourceModel->getOwnedDataSources($dataSourceID);
        $this->assertNotEquals($res,false);
    }
    
/**
    * testSearchDataSources() this method tests the method searchDataSources()
    */
    public function testSearchDataSources(){
        $and = false;
        $filter['owner']="test";
        $filter['name']="test40";
        $res=$this->dataSourceModel->searchDataSources($filter,$and);
        $this->assertNotEquals($res,false);
    }
    
    /**
    * testGetDataSources() this method tests the method getDataSources()
    */
    public function testGetDataSources(){
        $and = false;
        $filter['file_name']="test";
        $filter['file_url']=NULL;
        $filter['application']=0;
        $filter['visible']=2;
        $filter['add_date']='2019-04-28 16:28:51';
        $res=$this->dataSourceModel->getDataSources($filter,$and);
        $this->assertNotEquals($res,false);
    }

    /**
    * testGetDataSources1() this method tests the method getDataSources1()
    */
    public function testGetDataSources1(){
        $and = false;
        $res=$this->dataSourceModel->getDataSources(" ",$and);
        $this->assertNotEquals($res,false);
    }
    
    /**
    * testGetPersonalDataSources() this method tests the method getPersonalDataSources()
    */
    public function testGetPersonalDataSources(){
        $resu=$this->dataSourceModel->getUserID();
        $res=$this->dataSourceModel->getPersonalDataSources($resu);
        $this->assertNotEquals($res,false);
    }
    
    /**
    * testGetAccessDataSources() this method tests the method getAccessDataSources()
    */
    public function testGetAccessDataSources(){
        $advisorID=$this->dataSourceModel->getAdvisorID();
        $res=$this->dataSourceModel->getAccessDataSources($advisorID);
        $this->assertNotEquals($res,false);
    }

    /**
    * testGetAdvisors() this method tests the method getAdvisors()
    */
    public function testGetAdvisors(){
        $advisorID=$this->dataSourceModel->getAdvisorID();
        $res=$this->dataSourceModel->getAdvisors($advisorID);
        if(is_null($res['userid'])) $res='false';
        $this->assertNotEquals($res,false);
    }
    
    /**
    * testGetAccessibleDataSources() this method tests the method getAccessibleDataSources()
    */
    public function testGetAccessibleDataSources(){
        $resu=$this->dataSourceModel->getAdvisorID();
        $res=$this->dataSourceModel->getAccessibleDataSources($resu);
        if(is_null($res['id'])) $res='false';
        $this->assertNotEquals($res,false);
    }

    /**
    * testGetUserDataSources() this method tests the method getUserDataSources()
    */
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
        if(is_null($res['fileID'])) $res='false';
        $this->assertNotEquals($res,false);
    }
    
    /**
    * testGetUserDataSources1() this method tests the method getUserDataSources1()
    */
    public function testGetUserDataSources1(){
        $and=false;
        $resu=$this->dataSourceModel->getUserID();
        $res=$this->dataSourceModel->getUserDataSources($resu,$and);
        if(is_null($res['fileID'])) $res='false';
        $this->assertNotEquals($res,false);
    }

    /**
    * testGetDataSourceUsers() this method tests the method getDataSourceUsers()
    */
    public function testGetDataSourceUsers(){
        $filter['user_name'] = "test2";
        $filter['user_firstName']="test3";
        $filter['access_state']=1;
        $filter['ask_date']='1980-01-01 00:00:00';
        $and=false;
        $resu=$this->dataSourceModel->getDataSourceID();
        $res=$this->dataSourceModel->getDataSourceUsers($resu,$filter,$and);
        if(is_null($res['userID'])) $res='false';
        $this->assertNotEquals($res,false);
    }
    
    /**
    * testGetDataSourceUsers1() this method tests the method getDataSourceUsers1()
    */
    public function testGetDataSourceUsers1(){
        $and = false;
        $resu=$this->dataSourceModel->getDataSourceID();
        $res=$this->dataSourceModel->getDataSourceUsers($resu,$and);
        if(is_null($res['userID'])) $res='false';
        $this->assertNotEquals($res,false);
    }

    /**
    * testGetProjectDataSources() this method tests the method getProjectDataSources()
    */
    public function testGetProjectDataSources(){
        $filter['file_name']="test";
        $filter['file_url']="test";
        $filter['application']="test";
        $filter['config']="test";
        $filter['visible']=1;
        $filter['add_date']='test14';
        $filter['access_state']=1;
        $filter['ask_date']='test15';
        $and=false;
        $resu=$this->dataSourceModel->getProjetID();
        $res=$this->dataSourceModel->getProjectDataSources($resu,$filter,$and);
        if(is_null($res['fileID'])) $res='false';
        $this->assertNotEquals($res,false);
    }
    
    /**
    * testGetProjectDataSources1() this method tests the method getProjectDataSources1()
    */
    public function testGetProjectDataSources1(){
        $and = false;
        $resu=$this->dataSourceModel->getProjetID();
        $res=$this->dataSourceModel->getProjectDataSources($resu,$and);
        if(is_null($res['fileID'])) $res='false';
        $this->assertNotEquals($res,false);
    }

    /**
    * testGetDataSourceProjects() this method tests the method getDataSourceProjects()
    */
    public function testGetDataSourceProjects(){
        $filter['project_name'] = "test";
        $filter['ask_access'] = 1;
        $filter['ask_date'] = 'test21';
        $and=false;
        $resu=$this->dataSourceModel->getDataSourceID();
        $res=$this->dataSourceModel->getDataSourceProjects($resu,$filter,$and);
        if(is_null($res['project_ID'])) $res='false';
        $this->assertEquals($res,false);
    }
    
    /**
    * testGetDataSourceProjects1() this method tests the method getDataSourceProjects1()
    */
    public function testGetDataSourceProjects1(){
        $and=false;
        $resu=$this->dataSourceModel->getDataSourceID();
        $res=$this->dataSourceModel->getDataSourceProjects($resu,$and);
        if(is_null($res['project_ID'])) $res='false';
        $this->assertEquals($res,false);
    }
    
    //-------------------------------------------------------------
    //-------------------- INSERT ---------------------------------
    //-------------------------------------------------------------

    /**
    * testAddDataSourceApp() this method tests the method getAddDataSourceApp()
    */
    public function testAddDataSourceApp(){
        $dataSource['name']="test";
        $dataSource['visible']=2;
        $resu=$this->dataSourceModel->getUserID();
        $res =$this->dataSourceModel->addDataSourceApp($resu,$dataSource);
        $this->assertNotEquals($res,false);
    }

    /**
    * testAddDataSourceApp1() this method tests the method addDataSourceApp1()
    */
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

    /**
    * testAddDataSourceProject() this method tests the method addDataSourceProject()
    */
    public function testAddDataSourceProject(){
        $resu =$this->dataSourceModel->getDataSourceID();
        $resul=$this->dataSourceModel->getProjetID();
        $res = $this->dataSourceModel->addDataSourceProject($resu,$resul);
        $this->assertNotEquals($res,false);
    }

    /**
    * testAddDataSourceUser() this method tests the method addDataSourceUser()
    */
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
    * testAddAdvisor() this method tests the method addAdvisor()
    */
    public function testAddAdvisor(){
        $res=$this->dataSourceModel->addAdvisor(1,1,$dataSourceUser);
        $this->assertEquals($res,true);
    }
    
    /**
    * testAskAccess() this method tests the method askAccess()
    */
    public function testAskAccess(){
        $res=$this->dataSourceModel->askAccess(1,1);
        $this->assertEquals($res,true);
    }

    //-------------------------------------------------------------
   	//-------------------- UPDATE ---------------------------------
   	//-------------------------------------------------------------

    /**
    * testUpdateDataSource() this method tests the method updateDataSource()
    */
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

    /**
    * testUpdateDataSource1() this method tests the method updateDataSource1()
    */
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
    
    /**
    * testupdateDataSourceUser() this method tests the method updateDataSourceUser()
    */
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

    /**
    * testUpdateDataSourceProject() this method tests the method updateDataSourceProject()
    */
    public function testUpdateDataSourceProject(){
        $askAccess="1";
        $resu=$this->dataSourceModel->getDataSourceID();
        $resul=$this->dataSourceModel->getProjetID();
        $res=$this->dataSourceModel->updateDataSourceUser($resu,$resul,$askAccess);
        $this->assertEquals($res,true);
    }
    
    /**
    * testAcceptAccess() this method tests the method acceptAccess()
    */
    public function testAcceptAccess(){
        $res=$this->dataSourceModel->acceptAccess(1,1);
        $this->assertEquals($res,true);
    }
    
    /**
    * testRefuseAccess() this method tests the method refuseAccess()
    */
    public function testRefuseAccess(){
        $res=$this->dataSourceModel->refuseAccess(1,1);
        $this->assertEquals($res,true);
    }
    
    //-------------------------------------------------------------
   	//-------------------- DELETE ---------------------------------
   	//-------------------------------------------------------------

    /**
    * testDeleteDataSource() this method tests the method deleteDataSource()
    */
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

    /**
    * testDeleteUserDataSource() this method tests the method deleteUserDataSource()
    */
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

    /**
    * testDeleteDataSourceProject() this method tests the method deleteDataSourceProject()
    */
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

    /**
    * testDeleteAllDataSourcesUser() this method tests the method deleteAllDataSourcesUser()
    */
    public function testDeleteAllDataSourcesUser()
    {
        $resu=$this->dataSourceModel->getUserID();
        $res=$this->dataSourceModel->deleteAllDataSourcesUser($resu);
        $this->assertEquals($res,true);
    }

    /**
    * testDeleteAllUsersDataSource() this method tests the method deleteAllUsersDataSource()
    */
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

    /**
    * testDeleteAllProjectsDataSource() this method tests the method deleteAllProjectsDataSource()
    */
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

    /**
    * testDeleteAllDataSourcesProject() this method tests the method deleteAllDataSourcesProject()
    */
    public function testDeleteAllDataSourcesProject(){
        $resu=$this->dataSourceModel->getProjetID();
        $res=$this->dataSourceModel->deleteAllDataSourcesProject($resu);
        $this->assertEquals($res,true);
    }
    
    /**
    * testRevokeAccess() this method tests the method revokeAccess()
    */
    public function testRevokeAccess(){
        $res=$this->dataSourceModel->revokeAccess(1,1);
        $this->assertEquals($res,true);
    }
   
}

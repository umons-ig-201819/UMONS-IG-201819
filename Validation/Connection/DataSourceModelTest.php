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
        $res=$this->dataSourceModel->addDataSourceApp(2,$dataSource);
        $this->assertNotEquals($res,false);
    }

    public function testAddDataSourceApp1(){
        $dataSource['name']="test";
        $dataSource['url']='test40';
        $dataSource['appli']=0;
        $dataSource['config']=NULL;
        $dataSource['visible']=2;
        $res=$this->dataSourceModel->addDataSourceApp(2,$dataSource);
        $this->assertNotEquals($res,false);
    }
/**
    public function testAddDataSourceProject(){
        $askAccess=1;
        $res=$this->dataSourceModel->addDataSourceProject(1,1,$askAccess);
        $this->assertNotEquals($res,false);
    }
*/
    public function testAddFileUser(){
        $dataSourceUser['read']=0;
        $dataSourceUser['modify']=0;
        $dataSourceUser['remove']=0;
        $dataSourceUser['askAccess']=1;
        $res=$this->dataSourceModel->addFileUser(1,1,$dataSourceUser);
        $this->assertEquals($res,true);
    }

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
        $resu=$this->dataSourceModel->deleteDataSource(18);
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
        $resu=$this->dataSourceModel->deleteUserDataSource(1,$res[0]["id"]);
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
        $resu=$this->dataSourceModel->deleteDataSourceProject($res[0]["id"],1);
        $this->assertEquals($resu,true);
    }

    public function testDeleteAllDataSourcesUser()
    {
        $res=$this->dataSourceModel->deleteAllDataSourcesUser(1);
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
        $res=$this->dataSourceModel->deleteAllDataSourcesProject(1);
        $this->assertEquals($res,true);
    }

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
        $resu=$this->dataSourceModel->updateDataSource($res[0]["id"],1,$dataSource);
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
        $resu=$this->dataSourceModel->updateDataSource($res[0]["id"],1,$dataSource);
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
        $resu=$this->dataSourceModel->updateDataSourceUser($res[0]["id"],1,$dataSourceUser);
        $this->assertEquals($resu,true);
    }

     public function testUpdateDataSourceUser1(){
         $and = false;
        $filter['file_name']="test";
        $filter['file_url']="test40";
        $filter['application']=0;
        $filter['visible']=2;
        $filter['add_date']='1980-01-01 00:00:00';
        $res=$this->dataSourceModel->getDataSources($filter,$and);
         $res=$this->dataSourceModel->updateDataSourceUser($res[0]["id"],1);
         $this->assertEquals($res,true);
    }

    /**
    *Il n'y a pas de données dans fichier_projet
    public function testUpdateDataSourceProject(){
        $askAccess="1";
        $res=$this->dataSourceModel->updateDataSourceUser(1,1,$askAccess);
        $this->assertEquals($res,true);
    }
*/
    //-------------------------------------------------------------
   	//-------------------- SELECT ---------------------------------
   	//-------------------------------------------------------------

    public function testGetDataSource(){
        $res=$this->dataSourceModel->getDataSource(20);
        $this->assertNotEquals($res["id"],NULL);
    }

    public function testGetOwnedDataSources(){
        $res=$this->dataSourceModel->getOwnedDataSources(20);
        $this->assertEquals($res["id"],NULL);
    }

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

    public function testGetAccessibleDataSources(){
        $res=$this->dataSourceModel->getAccessibleDataSources(19);
        $this->assertNotEquals($res[0]["id"],NULL);
    }
/**
*Il n'y a pas de données dans utilisateurs_fichier
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
    */
/**
    public function testGetUserDataSources1(){
        $and=false;
        $res=$this->dataSourceModel->getUserDataSources(1,$and);
        $this->assertNotEquals($res[0]["id_file"],NULL);
    }
*/
    /**
    *Il n'y a pas de données dans utilisateur_fichier
    public function testGetDataSourceUsers(){
        $filter['user_name'] = "test2";
        $filter['user_firstName']="test3";
        $filter['access_state']=1;
        $filter['ask_date']='1980-01-01 00:00:00';
        $and=false;
        $res=$this->dataSourceModel->getDataSourceUsers(3,$filter,$and);
        $this->assertNotEquals($res[0]["id"],NULL);
    }
    */
/**
    public function testGetDataSourceUsers1(){
        $and = false;
        $res=$this->dataSourceModel->getDataSourceUsers(1,$and);
        $this->assertNotEquals($res[0]["id"],NULL);
    }
*/
    /**
    *Il n'y a pas de données dans fichier_projet
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
        $res=$this->dataSourceModel->getProjectDataSources(1,$filter,$and);
        $this->assertNotEquals($res[0]["id_fichier"],NULL);
    }
    */
/**
    public function testGetProjectDataSources1(){
        $and = false;
        $res=$this->dataSourceModel->getProjectDataSources(1,$and);
        $this->assertNotEquals($res[0]["id_fichier"],NULL);
    }
*/
    /**
    *Il n'y a pas de données dans fichier_projet
    public function testGetDataSourceProjects(){
        $filter['project_name'] = "test20";
        $filter['ask_access'] = 1;
        $filter['ask_date'] = 'test21';
        $and=false;
        $res=$this->dataSourceModel->getDataSourceProjects(1,$filter,$and);
        $this->assertEquals($res[0]["id_fichier"],NULL);
    }
    */
/**
    public function testGetDataSourceProjects1(){
        $and=false;
        $res=$this->dataSourceModel->getDataSourceProjects(1,$and);
        $this->assertEquals($res[0]["id_fichier"],NULL);
    }
    */
}

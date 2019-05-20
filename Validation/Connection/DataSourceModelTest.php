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

    /**
    * testAddDataSourceApp() this method tests the method getAddDataSourceApp()
    * addDataSourceApp() is a method for adding a file
	 * @param $userID is is the id of the owner of the data source
	 * @param $dataSource is an array containing the informations about the data source
	 * @param $dataSource ['name'] (required) is the name of the data source
	 * @param $dataSource ['visible'] (required) means if the data source have to be hidden (=2), visible (=1) or on demand (=0, default)
	 * @return new data source id if insert succeeded and FALSE if not
    */
    public function testAddDataSourceApp(){
        try{
            $dataSource['name']="test";
            $dataSource['visible']=2;
            $resu=$this->dataSourceModel->getUserID();
            $res =$this->dataSourceModel->addDataSourceApp($resu,$dataSource);
            $this->assertNotEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }

    /**
    * testAddDataSourceApp1() this method tests the method addDataSourceApp1()
    * addDataSourceApp() is a method for adding a file
	 * @param $userID is is the id of the owner of the data source
	 * @param $dataSource is an array containing the informations about the data source
	 * @param $dataSource ['name'] (required) is the name of the data source
	 * @param $dataSource ['url'] (optional) is the access url to the data source (default value=NULL)
	 * @param $dataSource ['appli'] (optional) means if the id is an application (1) or not (0) =default
	 * @param $dataSource ['config'] (optional) could be, for exemple, a JSON app configuration file
	 * @param $dataSource ['visible'] (required) means if the data source have to be hidden (=2), visible (=1) or on demand (=0, default)
	 * @return new data source id if insert succeeded and FALSE if not
    */
    public function testAddDataSourceApp1(){
        try{
            $dataSource['name']="test";
            $dataSource['url']='test40';
            $dataSource['appli']=0;
            $dataSource['config']=NULL;
            $dataSource['visible']=2;
            $resu=$this->dataSourceModel->getUserID();
            $res =$this->dataSourceModel->addDataSourceApp($resu,$dataSource);
            $this->assertNotEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }

    /**
    * testAddDataSourceProject() this method tests the method addDataSourceProject()
    * addDataSourceProject() is a method to link a data source to a project
	 * @param $dataSourceID (required) is the id of a data source
	 * @param $projectID (required) is the id of the project
	 * @return TRUE if insert succeeded and FALSE if not
    */
    /*public function testAddDataSourceProject(){
        try{
            $resu =$this->dataSourceModel->getDataSourceID();
            $resul=$this->dataSourceModel->getProjetID();
            $res = $this->dataSourceModel->addDataSourceProject($resu,$resul);
            $this->assertNotEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/

    /**
    * testAddDataSourceUser() this method tests the method addDataSourceUser()
    * addDataSourceUser() is a method for adding a data source for a user   
     * @param $fileID (required) is the id of a data source
     * @param $userID (required) is the id of a user
     * @param $fileUser (required) is an array containing the informations the types of access has a user for a data source
     * @param $fileUser ['read'] (required) means if a user may read a data source or not (0) = default
     * @param $fileUser ['modify'] (required) means if a user may modify a data source or not (0) = default
     * @param $fileUser ['remove'] (required) means if a user may remove a data source or not (0) = default
     * @return TRUE if insert succeeded and FALSE if not
    */
    /*public function testAddDataSourceUser(){
        try{
            $dataSourceUser['read']=0;
            $dataSourceUser['modify']=0;
            $dataSourceUser['remove']=0;
            $dataSourceUser['askAccess']=1;
            $resu =$this->dataSourceModel->getDataSourceID();
            $resul=$this->dataSourceModel->getUserID();
            $res = $this->dataSourceModel->addDataSourceUser($resu,$resul,$dataSourceUser);
            $this->assertEquals($res,true);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/
    
    /**
    * testAddAdvisor() this method tests the method addAdvisor()
    * @see AddAdvisor() for the data structure of returned files
    */
    public function testAddAdvisor(){
        $dataSourceUser = null;
        try{
            $res=$this->dataSourceModel->addAdvisor(1,$dataSourceUser);
            $this->assertEquals($res,true);
        }catch(Exception $e) { $this->assertTrue(false); }
    }
    
    /**
    * testAskAccess() this method tests the method askAccess()
    * @see AskAccess() for the data structure of returned files
    */
    public function testAskAccess(){
        try{
	    $resu=$this->dataSourceModel->getUserID();
	    $resul=$this->dataSourceModel->getDataSourceID();
            $res=$this->dataSourceModel->askAccess($resul,$resu);
            if(is_null($res['uf_id_invite'])) $res='false'
		    else $res='true';
            $this->assertEquals($res,true);
        }catch(Exception $e) { $this->assertTrue(false); }
    }

    //-------------------------------------------------------------
   	//-------------------- SELECT ---------------------------------
   	//-------------------------------------------------------------

    /**
     * testGetVisibility() this method test the output of GetVisibility method: a data source based on its id
      * getVisibility() this method returns the value of the visibility of the data source with its informations
    */
    public function testGetVisibility()
    {
        try{
            $dataSource = $this->dataSourceModel->getDataSourceID();
            $re=$this->dataSourceModel->getVisibility($dataSource);
            $this->assertNotEquals($re,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }
    
    /**
    * testGetDataSource() this method tests the method getDataSource()
    * getDataSource() this method returns a data source based on its id with its informations
     * <br> $response['id'] is the data source id
     * <br> $response['owner_id'] is the owner id
     * <br> $response['name']is the name of the data source
     * <br> $response['url'] is the url of the data source
     * <br> $response['application'] 0 for file and 1 for application
     * <br> $response['configuration'] is the configuration File
     * <br> $response['visible'] default visibility attribute for user files (0=hidden, 1=visible, 2=on demand)
     * <br> $response['add_date'] is the creation date of the data source in the database
    */
    public function testGetDataSource(){
        try{
            $dataSourcID=$this->dataSourceModel->getDataSourceID();
            $res =$this->dataSourceModel->getDataSource($dataSourcID);
            $this->assertNotEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }

    /**
    * testGetOwnedDataSources() this method tests the method getOwnedDataSources()
    * getOwnedDataSources() this method returns the data sources that belong to a user
     * @param $userID user id
     * @return datasources with the firstname and lastname of the owner
     * <br> $response['id'] is the data source id
     * <br> $response['file_name'] is the name of the data source
     * <br> $response['url'] is the URL of the data source
     * <br> $response['application'] 0 for file and 1 for application
     * <br> $response['configuration'] is the configuration File
     * <br> $response['visible'] default visibility attribute for user files (0=hidden, 1=visible, 2=on demand)
     * <br> $response['add_date'] is the creation date of the data source in the database
    */
 /*   public function testGetOwnedDataSources(){
        try{
            $dataSourceID=$this->dataSourceModel->getUserID();
            $resu=$this->dataSourceModel->getOwnedDataSources($dataSourceID);
            $this->assertNotEquals($resu,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/
    
/**
    * testSearchDataSources() this method tests the method searchDataSources()
    * @see searchDataSources() for the data structure of returned files
    */
    public function testSearchDataSources(){
	    try{
            $and = false;
            $filter['owner']="test";
            $filter['name']="test";
            $resul=$this->dataSourceModel->searchDataSources($filter,$and);
//            $this->assertTrue(array_key_exists('id',$res));
        	if(is_null($resul['id'])) $resul=false;
                $this->assertNotEquals($resul,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }
    
    /**
    * testGetDataSources() this method tests the method getDataSources()
    * getUserDataSources() is a method for searching the data sources of a user in the database
	* @param $filter is optional and is an array containing search criterions
	* @param $filter['file_name'] is optional and contains the name (can be partial) of searched data source(s) 
	* @param $filter['file_url'] is optional and contains the url of the searched data source(s) or not
	* @param $filter['application'] is optional and contains 1 if it's an application and 0 if not 
	* @param $filter['visible'] is optional and contains the default visible attribute for user data sources (0=hidden, 1=visible, 2=on demand)
	* @param $filter['add_date'] is optional and contains the creation date of searched data source(s)
	* @param $and is optional and is an boolean which is FALSE (default behavior) for processing the search query with OR operators and TRUE for AND operators
	* @return an array of files (ordered by date)
    */
    /*public function testGetDataSources(){
        try{
            $and = false;
            $filter['file_name']="test";
            $filter['file_url']=NULL;
            $filter['application']=0;
            $filter['visible']=1;
            $filter['add_date']='2019-04-28 16:28:51';
            $result=$this->dataSourceModel->getDataSources($filter,$and);
//            $this->assertTrue(array_key_exists('id',$res));
	    if(is_null($result['id'])) $result=false;
                $this->assertNotEquals($result,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/

    /**
    * testGetDataSources1() this method tests the method getDataSources1()
    * getUserDataSources() is a method for searching the data sources of a user in the database
	* @param $and is optional and is an boolean which is FALSE (default behavior) for processing the search query with OR operators and TRUE for AND operators
	* @return an array of files (ordered by date)
    */
    /*public function testGetDataSources1(){
        try{
            $and = false;
            $res=$this->dataSourceModel->getDataSources(null,$and);
//            $this->assertTrue(array_key_exists('id',$res));
        	if(is_null($res['id'])) $res= false;
                $this->assertNotEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/
    
    /**
    * testGetPersonalDataSources() this method tests the method getPersonalDataSources()
    * @see getPersonalDataSources() for the data structure of returned files
    */
    public function testGetPersonalDataSources(){
        try{
            $resu=$this->dataSourceModel->getUserID();
            $res=$this->dataSourceModel->getPersonalDataSources(($resu-3));
//            $this->assertTrue(array_key_exists('id',$res));
        	if(is_null($res['id'])) $res=false;
		else $res=true;
                $this->assertNotEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }
    
    /**
    * testGetAccessDataSources() this method tests the method getAccessDataSources()
    * @see getAccessDataSources() for the data structure of returned files
    */
    public function testGetAccessDataSources(){
        try{
            $advisorID=$this->dataSourceModel->getAdvisorID();
            $res=$this->dataSourceModel->getAccessDataSources($advisorID);
            $this->assertNotEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }

    /**
    * testGetAdvisors() this method tests the method getAdvisors()
    * @see getAdvisors() for the data structure of returned files
    */
    public function testGetAdvisors(){
        try{
            $advisorID=$this->dataSourceModel->getAdvisorID();
            $res=$this->dataSourceModel->getAdvisors($advisorID);
//            $this->assertTrue(array_key_exists('userid',$res));
            if(is_null($res['userid'])) $res='false';
            $this->assertNotEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }
    
    /**
    * testGetAccessibleDataSources() this method tests the method getAccessibleDataSources()
    * @see getAccessibleDataSources() for the data structure of returned files
    */
    public function testGetAccessibleDataSources(){
        try{
            $resu=$this->dataSourceModel->getAdvisorID();
            $res=$this->dataSourceModel->getAccessibleDataSources($resu);
//            $this->assertTrue(array_key_exists('id',$res));
            if(is_null($res['id'])) $res='false';
            $this->assertNotEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }

    /**
    * testGetUserDataSources() this method tests the method getUserDataSources()
    * @param $filter is optional and is an array containing search criterions
	* @param $filter['file_name'] is optional and contains the name (can be partial) of searched data source(s)
	* @param $filter['f_read'] is optional and contains the right to read the searched data source(s) or not
	* @param $filter['f_modify'] is optional and contains the right to modify the searched data source(s) or not 
	* @param $filter['f_remove'] is optional and contains the right to remove the searched data source(s) or not
	* @param $filter['access_state'] is optional and contains the access state (0=on demand, 1=OK, 2=KO) the searched data source(s) or not
	* @param $filter['ask_date'] is optional and contains the date when the user asked an access to the searched data source(s) or not
	* @param $filter['file_url'] is optional and contains the url of the searched data source(s) or not
	* @param $filter['application'] is optional and contains 1 if it's an application and 0 if not 
	* @param $filter['config'] is optional and contains the config file
	* @param $filter['visible'] is optional and contains the default visible attribute for user data sources (0=hidden, 1=visible, 2=on demand)
	* @param $filter['add_date'] is optional and contains the creation date of searched data source(s)
	* @param $and is optional and is an boolean which is FALSE (default behavior) for processing the search query with OR operators and TRUE for AND operators
	* @return an array of files (ordered by date)
    */
    /*public function testGetUserDataSources(){
        try{
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
//            $this->assertTrue(array_key_exists('fileID',$res));
            if(is_null($res['fileID'])) $res='false';
            $this->assertNotEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/
    
    /**
    * testGetUserDataSources1() this method tests the method getUserDataSources1()
	* @param $and is optional and is an boolean which is FALSE (default behavior) for processing the search query with OR operators and TRUE for AND operators
	* @return an array of files (ordered by date)
    */
    /*public function testGetUserDataSources1(){
        try{
            $and=false;
            $resu=$this->dataSourceModel->getUserID();
            $res=$this->dataSourceModel->getUserDataSources($resu,null,$and);
//            $this->assertTrue(array_key_exists('fileID',$res));
            if(is_null($res['fileID'])) $res='false';
            $this->assertNotEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/

    /**
    * testGetDataSourceUsers() this method tests the method getDataSourceUsers()
    * getDataSourceUsers() is a method for searching the users of a data source in the database
	* @param $filter is optional and is an array containing search criterions
	* @param $filter['user_name'] is optional and contains the lastname (can be partial) of searched user(s)
	* @param $filter['user_firstname'] is optional and contains the firstname (can be partial) of searched user(s)
	* @param $filter['access_state'] is optional and is a boolean which is for the access state (0 = asked, 1 OK, 2 KO)
	* @param $filter['ask_date'] is optional and contains  date when the user asked an access to the searched data source
	* @param $and is optional and is an boolean which is FALSE (default behavior) for processing the search query with OR operators and TRUE for AND operators
	* @return an array of data source(s) (ordered by date)
    */
   /* public function testGetDataSourceUsers(){
        try{
            $filter['user_name'] = "test2";
            $filter['user_firstName']="test3";
            $filter['access_state']=1;
            $filter['ask_date']='1980-01-01 00:00:00';
            $and=false;
            $resu=$this->dataSourceModel->getDataSourceID();
            $res=$this->dataSourceModel->getDataSourceUsers($resu,$filter,$and);
//            $this->assertTrue(array_key_exists('userID',$res));
            if(is_null($res['userID'])) $res='false';
            $this->assertNotEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/
    
    /**
    * testGetDataSourceUsers1() this method tests the method getDataSourceUsers1()
    * getDataSourceUsers() is a method for searching the users of a data source in the database
	* @param $and is optional and is an boolean which is FALSE (default behavior) for processing the search query with OR operators and TRUE for AND operators
	* @return an array of data source(s) (ordered by date)
    */
    /*public function testGetDataSourceUsers1(){
        try{
            $and = false;
            $resu=$this->dataSourceModel->getDataSourceID();
            $res=$this->dataSourceModel->getDataSourceUsers($resu,null,$and);
//            $this->assertTrue(array_key_exists('userID',$res));
            if(is_null($res['userID'])) $res='false';
            $this->assertNotEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/

    /**
    * testGetProjectDataSources() this method tests the method getProjectDataSources()
    * getProjectDataSources() is a method for searching the data sources of a project in the database
	* @param $filter is optional and is an array containing search criterions
	* @param $filter['file_name'] is optional and contains the name (can be partial) of searched data source(s)
	* @param $filter['file_url'] is optional and contains the url of the searched data source(s) or not
	* @param $filter['application'] is optional and contains 1 if it's an application and 0 if not 
	* @param $filter['config'] is optional and contains the config file
	* @param $filter['visible'] is optional and contains the default visible attribute for user data sources (0=hidden, 1=visible, 2=on demand)
	* @param $filter['add_date'] is optional and contains the creation date of searched data source(s)
    * @param $filter['access_state'] is optional and contains the access state (0=on demand, 1=OK, 2=KO) to the searched data source(s) or not
	* @param $filter['ask_date'] is optional and contains the date when asked an access to the searched data source(s) or not
	* @param $and is optional and is an boolean which is FALSE (default behavior) for processing the search query with OR operators and TRUE for AND operators
	* @return an array of data sources (ordered by date)
    */
    /*public function testGetProjectDataSources(){
        try{
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
//            $this->assertTrue(array_key_exists('fileID',$res));
            if(is_null($res['fileID'])) $res='false';
            $this->assertNotEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/
    
    /**
    * testGetProjectDataSources1() this method tests the method getProjectDataSources1()
    * getProjectDataSources() is a method for searching the data sources of a project in the database
	* @param $and is optional and is an boolean which is FALSE (default behavior) for processing the search query with OR operators and TRUE for AND operators
	* @return an array of data sources (ordered by date)
    */
    /*public function testGetProjectDataSources1(){
        try{
            $and = false;
            $resu=$this->dataSourceModel->getProjetID();
            $res=$this->dataSourceModel->getProjectDataSources($resu,null,$and);
//            $this->assertTrue(array_key_exists('fileID',$res));
            if(is_null($res['fileID'])) $res='false';
            $this->assertNotEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/

    /**
    * testGetDataSourceProjects() this method tests the method getDataSourceProjects()
    * getDataSourceProjects() is a method for searching the projects linked with a data source in the database
	* @param $filter is optional and is an array containing search criterions
	* @param $filter['project_name'] is optional and contains the name (can be partial) of searched project(s)
	* @param $filter['ask_access'] is optional and contains the access state (0=on demand, 1=OK, 2=KO) to the searched project(s)
	* @param $filter['ask_date'] is optional and contains the date when asked an access to the searched project(s)
	* @param $and is optional and is an boolean which is FALSE (default behavior) for processing the search query with OR operators and TRUE for AND operators
	* @return an array of files (ordered by date)
    */
  /*  public function testGetDataSourceProjects(){
        try{
            $filter['project_name'] = "test";
            $filter['ask_access'] = 1;
            $filter['ask_date'] = 'test21';
            $and=false;
            $resu=$this->dataSourceModel->getDataSourceID();
            $res=$this->dataSourceModel->getDataSourceProjects($resu,$filter,$and);
//            $this->assertTrue(array_key_exists('project_ID',$res));
            if(is_null($res['project_ID'])) $res='false';
            $this->assertEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/
    
    /**
    * testGetDataSourceProjects1() this method tests the method getDataSourceProjects1()
    * getDataSourceProjects() is a method for searching the projects linked with a data source in the database
	* @param $and is optional and is an boolean which is FALSE (default behavior) for processing the search query with OR operators and TRUE for AND operators
	* @return an array of files (ordered by date)
    */
    /*public function testGetDataSourceProjects1(){
        try{
            $and=false;
            $resu=$this->dataSourceModel->getDataSourceID();
            $res=$this->dataSourceModel->getDataSourceProjects($resu,null,$and);
//            $this->assertTrue(array_key_exists('project_ID',$res));
            if(is_null($res['project_ID'])) $res='false';
            $this->assertEquals($res,false);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/
	
	//-------------------------------------------------------------
   	//-------------------- UPDATE ---------------------------------
   	//-------------------------------------------------------------

    /**
    * testUpdateDataSource() this method tests the method updateDataSource()
    * updateDataSource() is a method for updating a specific data source
     * @param $userID is is the id of the owner of the data source
     * @param $dataSource is an array containing the informations about the data source
     * @param $dataSourceID is the id of the data source
     * @param $dataSource ['name'] (optional) is the new name of the data source
     * @param $dataSource ['url'] (optional) is the new access url to the data source (default value=NULL)
     * @param $dataSource ['appli'] (optional) means if the id is an application (1) or not (0) =default
     * @param $dataSource ['config'] (optional) could be, for exemple, a JSON app configuration file
     * @param $dataSource ['visible'] (optional) means if the data source have to be hidden (=2), visible (=1) or if it is accessible on request (=0)
     * @return TRUE if update succeeded and FALSE if not
    */
    public function testUpdateDataSource(){
        try{
/*            $and = false;
            $filter['file_name']="test";
            $filter['file_url']="test40";
            $filter['application']=0;
            $filter['visible']=2;
            $filter['add_date']='1980-01-01 00:00:00';
            $res=$this->dataSourceModel->getDataSources($filter,$and);*/
	    $res=$this->dataSourceModel->getDataSourceID();
            $dataSource['name']="testDataSourceModel";
            $dataSource['url']="testDataSource";
            $dataSource['appli']=1;
            $dataSource['config']="";
            $dataSource['visible']="";
            $resul=$this->dataSourceModel->getUserID();
//            $this->assertTrue(!is_null($res),true);
//            $this->assertTrue(count($res)>0,true);
            $resu=$this->dataSourceModel->updateDataSource($res,$resul,$dataSource);
            $this->assertEquals($resu,true);
        }catch(Exception $e) { $this->assertTrue(false); }
    }

    /**
    * testUpdateDataSource1() this method tests the method updateDataSource1()
    * @see updateDataSource() for the data structure of returned files
    */
    public function testUpdateDataSource1(){
        try{
/*            $and = false;
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
            $dataSource['visible']="test";*/
	    $res=$this->dataSourceModel->getDataSourceID();
            $resul=$this->dataSourceModel->getUserID();
 //           $this->assertTrue(!is_null($res),true);
 //           $this->assertTrue(count($res)>0,true);
            $resu=$this->dataSourceModel->updateDataSource($res,$resul,$dataSource);
            $this->assertEquals($resu,true);
        }catch(Exception $e) { $this->assertTrue(false); }
    }
    
    /**
    * testupdateDataSourceUser() this method tests the method updateDataSourceUser()
    * updateDataSourceUser() is a method for updating the access of a user to a data source
     * @param $dataSourceID contains the id of the data source
	 * @param $userID is the id of the user
     * @param $dataSourceUser ['read'] (optional) means if a user may read a data source or not (0) = default
	 * @param $dataSourceUser ['modify'] (optional) means if a user may modify a data source or not (0) = default
	 * @param $dataSourceUser ['remove'] (optional) means if a user may remove a data source or not (0) = default
	 * @param $dataSourceUser ['askaccess'] (optional) means if an access request is refused (2), if it is accepted (1) or if the request is made (0) = default
     * @return TRUE if update succeeded and FALSE if not
    */
    /*public function testUpdateDataSourceUser(){
        try{
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
//            $this->assertTrue(!is_null($res),true);
//            $this->assertTrue(count($res)>0,true);
//            $this->assertTrue(array_key_exists('id',$res[0]));
            $resu=$this->dataSourceModel->updateDataSourceUser($res[0]["id"],$resul,$dataSourceUser);
            $this->assertEquals($resu,true);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/

    /**
    * testUpdateDataSourceProject() this method tests the method updateDataSourceProject()
    * updateDataSourceProject() is a method for updating the access of a project to a data source
     * @param $dataSourceID contains the id of the the id of the data source
	 * @param $projectID is the ID of the project
	 * @param $askAccess (required) means if an access request is refused (2), if it is accepted (1) or if the request is made (0) = default
     * @return TRUE if update succeeded and FALSE if not
    */
    /*public function testUpdateDataSourceProject(){
        try{
            $askAccess="1";
            $resu=$this->dataSourceModel->getDataSourceID();
            $resul=$this->dataSourceModel->getProjetID();
            $res=$this->dataSourceModel->updateDataSourceUser($resu,$resul,$askAccess);
            $this->assertEquals($res,true);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/
    
    /**
    * testAcceptAccess() this method tests the method acceptAccess()
    * @see acceptAccess() for the data structure of returned files
    */
    public function testAcceptAccess(){
        try{
	    $resu=$this->dataSourceModel->getDataSourceID();
            $res=$this->dataSourceModel->acceptAccess($resu,1);
	    $resul=$this->dataSourceModel->getAccessUtilisateurFichier(1,$resu)
            $this->assertEquals($resul,1);
        }catch(Exception $e) { $this->assertTrue(false); }
    }
    
    /**
    * testRefuseAccess() this method tests the method refuseAccess()
    * @see refuseAccess() for the data structure of returned files
    */
    public function testRefuseAccess(){
        try{
	    $resu=$this->dataSourceModel->getDataSourceID();
            $res=$this->dataSourceModel->refuseAccess($resu,1);
	    $resul=$this->dataSourceModel->getAccessUtilisateurFichier(1,$resu)
            $this->assertEquals($resul,2);
        }catch(Exception $e) { $this->assertTrue(false); }
    }
    
        //-------------------------------------------------------------
   	//-------------------- DELETE ---------------------------------
   	//-------------------------------------------------------------

    /**
    * testDeleteDataSource() this method tests the method deleteDataSource()
    * deleteDataSource() delete a data source based on its id
     * @param $dataSourceID
     * @return a boolean (TRUE if deletion has been applied, FALSE if not)
    */
    public function testDeleteDataSource(){
        try{
/*            $and = true;
            $filter['file_name']="test";
            $filter['file_url']="test40";
            $filter['application']=0;
            $filter['visible']=2;
            $filter['add_date']='1980-01-01 00:00:00';
            $res=$this->dataSourceModel->getDataSources($filter,$and);*/
//            $this->assertTrue(!is_null($res),true);
//            $this->assertTrue(count($res)>0,true);
	    $res=$this->dataSourceModel->getDataSourceID();
            $resu=$this->dataSourceModel->deleteDataSource($res);
            $this->assertEquals($resu,true);
        }catch(Exception $e) { $this->assertTrue(false); }
    }

    /**
    * testDeleteUserDataSource() this method tests the method deleteUserDataSource()
    * deleteUserDataSource() remove a data source for a specific user
	 * @param $userID
	 * @param $dataSourceID
	 * @return a boolean (TRUE if deletion has been applied, FALSE if not)
    */
    /*public function testDeleteUserDataSource()
    {
        try{
            $and = true;
            $filter['file_name']="test";
            $filter['file_url']="test40";
            $filter['application']=1;
            $filter['visible']=1;
            $filter['add_date']='1980-01-01 00:00:00';
            $res=$this->dataSourceModel->getDataSources($filter,$and);
            $resul=$this->dataSourceModel->getUserID();
//            $this->assertTrue(!is_null($res),true);
//            $this->assertTrue(count($res)>0,true);
            $resu=$this->dataSourceModel->deleteUserDataSource($resul,$res[0]["id"]);
            $this->assertEquals($resu,true);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/

    /**
    * testDeleteDataSourceProject() this method tests the method deleteDataSourceProject()
    * deleteDataSourceProject() remove a data source for a specific project
	 * @param $dataSourceID
	 * @param $projID
	 * @return a boolean (TRUE if deletion has been applied, FALSE if not)
    */
    /*public function testDeleteDataSourceProject()
    {
        try{
            $and = true;
            $filter['file_name']="test";
            $filter['file_url']="test40";
            $filter['application']=0;
            $filter['visible']=2;
            $filter['add_date']='1980-01-01 00:00:00';
            $res=$this->dataSourceModel->getDataSources($filter,$and);
            $resul=$this->dataSourceModel->getProjetID();
//            $this->assertTrue(!is_null($res),true);
//            $this->assertTrue(count($res)>0,true);
            $resu=$this->dataSourceModel->deleteDataSourceProject($res[0]["id"],$resulID);
            $this->assertEquals($resu,true);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/

    /**
    * testDeleteAllDataSourcesUser() this method tests the method deleteAllDataSourcesUser()
    * deleteAllDataSourcesUser() remove all data sources for a specific user
     * @param $userID
     * @return a boolean (TRUE if deletion has been applied, FALSE if not)
    */
    public function testDeleteAllDataSourcesUser()
    {
        try{
            $resu=$this->dataSourceModel->getUserID();
            $res=$this->dataSourceModel->deleteAllDataSourcesUser($resu);
            $this->assertEquals($res,true);
        }catch(Exception $e) { $this->assertTrue(false); }
    }

    /**
    * testDeleteAllUsersDataSource() this method tests the method deleteAllUsersDataSource()
    * deleteAllUsersDataSource() remove all users for a specific data source
     * @param $dataSourceID
     * @return a boolean (TRUE if deletion has been applied, FALSE if not)
    */
    /*public function testDeleteAllUsersDataSource(){
        try{
            $and = true;
            $filter['file_name']="test";
            $filter['file_url']="test40";
            $filter['application']=0;
            $filter['visible']=2;
            $filter['add_date']='1980-01-01 00:00:00';
            $res=$this->dataSourceModel->getDataSources($filter,$and);
//            $this->assertTrue(!is_null($res),true);
//            $this->assertTrue(count($res)>0,true);
            $resu=$this->dataSourceModel->deleteAllUsersDataSource($res[0]["id"]);
            $this->assertEquals($resu,true);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/

    /**
    * testDeleteAllProjectsDataSource() this method tests the method deleteAllProjectsDataSource()
     * deleteAllProjectsDataSource() remove all projects for a specific data source
     * @param $dataSourceID
     * @return a boolean (TRUE if deletion has been applied, FALSE if not)
    */
    /*public function testDeleteAllProjectsDataSource(){
        try{
            $and = true;
            $filter['file_name']="test";
            $filter['file_url']="test40";
            $filter['application']=0;
            $filter['visible']=2;
            $filter['add_date']='1980-01-01 00:00:00';
            $res=$this->dataSourceModel->getDataSources($filter,$and);
//            $this->assertTrue(!is_null($res),true);
//            $this->assertTrue(count($res)>0,true);
            $resu=$this->dataSourceModel->deleteAllProjectsDataSource($res[0]["id"]);
            $this->assertEquals($resu,true);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/

    /**
    * testDeleteAllDataSourcesProject() this method tests the method deleteAllDataSourcesProject()
    * deleteAllDataSourcesProject() remove all data sources for a specific project
     * @param $projectID
     * @return a boolean (TRUE if deletion has been applied, FALSE if not)
    */
    /*public function testDeleteAllDataSourcesProject(){
        try{
            $resu=$this->dataSourceModel->getProjetID();
            $res=$this->dataSourceModel->deleteAllDataSourcesProject($resu);
            $this->assertEquals($res,true);
        }catch(Exception $e) { $this->assertTrue(false); }
    }*/
    
    /**
    * testRevokeAccess() this method tests the method revokeAccess()
    * @see revokeAccess() for the data structure of returned files
    */
    public function testRevokeAccess(){
        try{
	    $resu=$this->dataSourceModel->getDataSourceID();
            $res=$this->dataSourceModel->revokeAccess($resu,1);
	    $resul=$this->dataSourceModel->getAccessUtilisateurFichier(1,$resu)
            $this->assertEquals($resul,4);
        }catch(Exception $e) { $this->assertTrue(false); }
    }
   
}

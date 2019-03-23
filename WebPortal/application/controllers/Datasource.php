<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasource extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('DataSourceModel');
    }
    /*
     https://zeppelin.apache.org/docs/0.8.1/usage/rest_api/interpreter.html
     https://zeppelin.apache.org/docs/0.8.1/usage/rest_api/zeppelin_server.html
     https://zeppelin.apache.org/docs/0.8.1/usage/rest_api/notebook.html
     https://zeppelin.apache.org/docs/0.8.1/usage/rest_api/notebook_repository.html
     https://zeppelin.apache.org/docs/0.8.1/usage/rest_api/configuration.html
     https://zeppelin.apache.org/docs/0.8.1/usage/rest_api/credential.html
     https://zeppelin.apache.org/docs/0.8.1/usage/rest_api/helium.html
     */
    public function index($sourceID=-1){
        $sourceID = intval($sourceID);
        
        $sources = $this->DataSourceModel->getUserDataSources($this->session->UserID);
        
        $options = array(
            '0'         => 'Veuillez s&eacute;lectionner une source',
        );
        
        foreach($sources as $source){
            $options[$source['fileID']] = $source['file_name'];
        }
        
        if($sourceID >= 0 && array_key_exists($sourceID, $sources)){
            $notebook = $sources["$sourceID"]['file_url'];
            $json = file_get_contents('http://192.168.2.169:8080/api/notebook');
            $data = json_decode($json);
            print_r($data);
            
        }
        echo "Test 2\n";
        print_r(json_decode(file_get_contents("http://92.168.2.169:8080/api/notebook/2E5CQKJ2U")));
        
/*
 * {"status":"OK","message":"",
 *      "body":[
 *          {"name":"Zeppelin Tutorial/Basic Features (Spark)","id":"2A94M5J1Z"},
 *          {"name":"Zeppelin Tutorial/Matplotlib (Python • PySpark)","id":"2C2AUG798"},
 *          {"name":"Zeppelin Tutorial/R (SparkR)","id":"2BWJFTXKJ"},
 *          {"name":"Zeppelin Tutorial/Using Flink for batch processing","id":"2C35YU814"},
 *          {"name":"Zeppelin Tutorial/Using Mahout","id":"2BYEZ5EVK"},
 *          {"name":"Zeppelin Tutorial/Using Pig for querying data","id":"2C57UKYWR"},
 *          {"name":"test-access","id":"2E5MMRQK9"},
 *          {"name":"test-csv","id":"2E6UBUUT8"},
 *          {"name":"test-mariadb","id":"2E3GME58D"},
 *          {"name":"test-postgresql","id":"2E5CQKJ2U"},
 *          {"name":"test-python","id":"2E67ZW96V"},
 *          {"name":"test-rest","id":"2E6SRTGQJ"}
 *       ]
 * }

 */
        print_r();
        
        
        $data = array(
            'selected'          => $sourceID,
            'notebook_table'    => 'http://192.168.2.169:8080/#/notebook/2E6UBUUT8',
            'notebook_graph'    => 'http://192.168.2.169:8080/#/notebook/2E6UBUUT8/paragraph/20190217-060926_1012400790?asIframe',
            'options'           => $options
        );
        
        $this->load->view('header');
        $this->load->view('datasource',$data);
        $this->load->view('footer');
    }
    public function addSource(){
        if($this->input->post('action')){
            $userID                         = $this->session->UserID;
            $path_parts                     = pathinfo($_FILES["datafile"]["name"]);
            
            $config = array(
                'upload_path'          => "/var/nfs/general/$userID/",
                'allowed_types'        => 'csv|mdb|accdb',
                'max_size'             => 100,
                'file_ext_tolower'     => true,
                'detect_mime'          => true,
                'file_name'            => dechex(time()).'.'.strtolower($path_parts['extension'])
            );
            
            $this->load->library('upload', $config);
            
            /*
            if(!$this->upload->do_upload('userfile')){
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('upload_form', $error);
            }else{
                $data = array('upload_data' => $this->upload->data());
                $this->load->view('upload_success', $data);
            }*/
        }
        
        
        $this->load->view('header');
        $this->load->view('upload');
        $this->load->view('footer');
    }
    public function addAdvisor($advisorID=null){
    
    }
}

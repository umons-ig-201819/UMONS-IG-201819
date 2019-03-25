<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasource extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('DataSourceModel');
        $this->load->helper('zeppelin');
    }
    /*
     https://zeppelin.apache.org/docs/0.8.1/usage/rest_api/interpreter.html
     https://zeppelin.apache.org/docs/0.8.1/usage/rest_api/notebook.html
     */
    
    public function index($sourceID=''){
        $sources = $this->DataSourceModel->getAccessibleDataSources($this->session->UserID);
        
        $options = array(
            ''         => 'Veuillez s&eacute;lectionner une source',
        );
        
        foreach($sources as $source){
            $options[$source['url']] = $source['name'];
        }
        
        if(empty($sourceID) && !empty($this->input->post('datasource'))){
            $sourceID = $this->input->post('datasource');
        }
        
        if(!preg_match('/^[0-9a-zA-Z]+$/', $sourceID)) $sourceID = '';
        
        $url = null;
        
        if(!empty($sourceID) && array_key_exists($sourceID, $options)){
            $url = get_user_workspace($this->session->UserID,$sourceID);
        }

        $data = array(
            'selected'          => $sourceID,
            'url'               => $url,
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

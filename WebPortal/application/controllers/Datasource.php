<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasource extends CI_Controller {
    public function __construct(){
        parent::__construct();
        //$this->load->model('DataSourceModel');
    }
    public function index($sourceID=-1){
        $sourceID = intval($sourceID);
                
        $options = array(
            '0'         => 'Veuillez s&eacute;lectionner une source',
        );
        
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
            
            $config['upload_path']          = "/var/nfs/general/$userID/";
            $config['allowed_types']        = 'csv|mdb|accdb';
            $config['max_size']             = 100;
            $config['file_ext_tolower']     = true;
            $config['detect_mime']          = true;
            $config['file_name']            = dechex(time()).'.'.strtolower($path_parts['extension']);
            
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

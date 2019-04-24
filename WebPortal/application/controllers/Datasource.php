<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasource extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('DataSourceModel');
        $this->load->helper('zeppelin');
    }

    
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
        
        $url = array();
        
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
        $error = null;
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
            if(!file_exists($config['upload_path'])){
                mkdir($config['upload_path']);
            }
            
            $this->load->library('upload', $config);
            
            if(!$this->upload->do_upload('datafile')){
                $error = array('error' => $this->upload->display_errors());
            }else{
                $data = array('upload_data' => $this->upload->data());
                print_r($data);
                $error = $data;
                $data['upload_data']['file_ext'] = strtolower($data['upload_data']['file_ext']);
                if(strlen($data['upload_data']['file_ext'])>0){
                    $data['upload_data']['file_ext'] = substr($data['upload_data']['file_ext'],1);// remove initial dot (.)
                }
                $nodeName = "user/data-$userID-".$data['upload_data']['raw_name'];
                $path = $data['upload_data']['full_path'];
                if($data['upload_data']['file_ext'] == 'csv'){
                    print_r(create_csv_source($nodeName,"csv-$userID",$path));
                }elseif($data['upload_data']['file_ext'] == 'mdb' || $data['upload_data']['file_ext'] == 'accdb'){
                    create_access_source($nodeName,"access-$userID-".$data['upload_data']['raw_name'],$path);
                }
                // no else because already checked by CodeIgniter
                $this->DataSourceModel->addDataSourceApp($userID, array(
                    'name'      => $data['upload_data']['client_name'],
                    'visible'   => 0,
                    'url'       => TODO
                ));
            }
        }
        /*
         * Array ( [upload_data] => Array ( [file_name] => 5cc0a9ff.csv [file_type] => text/plain [file_path] => /var/nfs/general/2/ [full_path] => /var/nfs/general/2/5cc0a9ff.csv [raw_name] => 5cc0a9ff [orig_name] => 5cc0a9ff.csv [client_name] => test.csv [file_ext] => .csv [file_size] => 0.03 [is_image] => [image_width] => [image_height] => [image_type] => [image_size_str] => ) ) 
         * file_ext
         * 
         */
        
        
        $this->load->view('header');
        $this->load->view('upload', array('error' => $error));
        $this->load->view('footer');
    }
    public function addAdvisor($advisorID=null){
    
    }
}
